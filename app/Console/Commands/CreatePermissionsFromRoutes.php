<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use App\Models\RouteModel; // Adjust this if your model is named differently

class CreatePermissionsFromRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions based on named routes in the database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $this->info('Generating Permissions!!.');
        // Fetch all routes from the database
        $routes = RouteModel::get();

        // Loop through each route and create permission if it doesn't exist
        foreach ($routes as $route) {
            // Check if the permission already exists
            if (!Permission::where('name', $route->name)->exists()) {
                // If it doesn't exist, create the permission
                Permission::create(['name' => $route->name]);

            }
        }

        $this->info('Permissions for all routes processed successfully.');
    }
}
