<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AssignRolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

        $routes = DB::table('routes')->pluck('name');

        // Create all permissions
        foreach ($routes as $route) {
            Permission::firstOrCreate(['name' => $route]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer']);

        // Assign all permissions to admin
        $adminRole->syncPermissions(Permission::all());

        // Assign specific permissions to editor
        $editorPermissions = ['articles.index', 'articles.create', 'articles.edit', 'articles.view'];
        foreach ($editorPermissions as $permission) {
            $perm = Permission::where('name', $permission)->first();
            if ($perm) {
                $editorRole->givePermissionTo($perm);
            }
        }

        // Assign specific permissions to viewer
        $viewerPermissions = ['404', 'settings'];
        foreach ($viewerPermissions as $permission) {
            $perm = Permission::where('name', $permission)->first();
            if ($perm) {
                $viewerRole->givePermissionTo($perm);
            }
        }

        // Assign roles to users
        $adminUser = User::find(1);
        $editorUser = User::find(2);
        $viewerUser = User::find(3);

        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
        if ($editorUser) {
            $editorUser->assignRole('editor');
        }
        if ($viewerUser) {
            $viewerUser->assignRole('viewer');
        }

        $this->command->info('Roles and permissions assigned successfully.');
    }
}
