<?php

namespace Database\Seeders;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'Manage users';
        $manageUser->slug = 'manage-users';
        $manageUser->controller = 'users';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Delete users';
        $manageUser->slug = 'delete-users';
        $manageUser->controller = 'users';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'Create Tasks';
        $createTasks->slug = 'create-tasks';
        $createTasks->controller = 'tasks';
        $createTasks->save();

        $createTasks = new Permission();
        $createTasks->name = 'Delete Tasks';
        $createTasks->slug = 'delete-tasks';
        $createTasks->controller = 'tasks';
        $createTasks->save();


        // Permissions From Controller and Methods
        /*
        $permission_ids = []; // an empty array of stored permission IDs
        // iterate though all routes
        foreach (Route::getRoutes()->getRoutes() as $key => $route)
        {
            // get route action
            $action = $route->getActionname();
            // separating controller and method
            $_action = explode('@',$action);

             $controller = $_action[0];
             $method = end($_action);

             // check if this permission is already exists
             $permission_check = Permission::where(
                 ['controller'=>$controller, 'method'=>$method]
             )->first();

            if(!$permission_check){
             $permission = new Permission;
             $permission->name = $method;
             $permission->controller = $controller;
             $permission->method = $method;
             $permission->slug = $method;
             $permission->save();
             // add stored permission id in array
             $permission_ids[] = $permission->id;
            }
        }


        // find admin role.
        $admin_role = Role::where('slug','admin')->first();
        // attached all permissions to admin role
        $admin_role->permissions()->attach($permission_ids);
        */
    }
}
