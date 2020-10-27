<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fill Roles with Permissions
        $customer_role  = Role::where('slug', 'customer')->first();
        $permission_ids = Permission::where('controller','tasks')->pluck('id')->all();
        $customer_role->permissions()->attach($permission_ids); //Relation defined in Model
    }
}
