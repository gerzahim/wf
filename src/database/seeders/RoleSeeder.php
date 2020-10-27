<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Administrator';
        $role->slug = 'admin';
        $role->save();

        $role = new Role();
        $role->name = 'Developer';
        $role->slug = 'developer';
        $role->save();

        $role = new Role();
        $role->name = 'Operator';
        $role->slug = 'operator';
        $role->save();

        $role = new Role();
        $role->name = 'Customer';
        $role->slug = 'customer';
        $role->save();


    }
}
