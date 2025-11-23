<?php
namespace Database\Seeders;

use App\Models\Delete;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // Page::factory(5)->create();
        try {
            // Check if the 'users' table exists
            if (DB::getSchemaBuilder()->hasTable('users')) {
                // Check if the superadmin user exists
                if (!User::where('email', 'subedigokul119@gmail.com')->exists()) {
                    // Create the superadmin user if it does not exist
                    $user = User::create([
                        'id'       => 1,
                        'name'     => 'Gokul Subedi',
                        'email'    => 'subedigokul119@gmail.com',
                        'password' => Hash::make('password'),
                    ]);
                } else {
                    // Retrieve the existing user
                    // $user = User::where('email', 'subedigokul119@gmail.com')->first();
                    $user = User::where('email', 'subedigokul119@gmail.com')->first();
                }
            } else {
                Log::error("The 'users' table does not exist.");
            }

            // Check if the 'roles' table exists
            if (DB::getSchemaBuilder()->hasTable('roles')) {
                // Check if the superadmin role exists
                if (!Role::where('name', 'superadmin')->exists()) {
                    $role = Role::create([
                        'id'         => 1,
                        'name'       => 'superadmin',
                        'guard_name' => 'web',
                    ]);
                } else {
                    // Retrieve the existing role
                    $role = Role::where('name', 'superadmin')->first();
                }

                // Assign the superadmin role to the user if not already assigned
                if (isset($user) && !$user->hasRole('superadmin')) {
                    $user->assignRole('superadmin');
                }
            } else {
                Log::error("The 'roles' table does not exist.");
            }
        } catch (\Exception $e) {
            Log::error('Error during user and role creation: ' . $e->getMessage());
        }
    }
}
