<?php

namespace Database\Seeders;
use App\Models\Team;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Jetstream;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer_role = Role::where('slug','developer')->first();
        $customer_role = Role::where('slug', 'customer')->first();
        $createTasks = Permission::where('slug','create-tasks')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();


        // Create New User
        $user1 = new User();
        $user1->name = 'Jhon Customer';
        $user1->email = 'customer@wf.com';
        $user1->password = bcrypt('secret');
        $user1->save();

        // From trait HasRolesAndPermissionsTrait
        $user1->roles()->attach($developer_role); //save in users_roles table , assign Role
        //$user1->permissions()->attach($createTasks); // save in users_permissions table

        // Creating Personal Team
        $user1->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user1->id,
            'name' => explode(' ', $user1->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));

        $user2 = new User();
        $user2->name = 'Mike Developer';
        $user2->email = 'developer@wf.com';
        $user2->password = bcrypt('secret');
        $user2->save();

        $user2->roles()->attach($customer_role);

        $user2->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user2->id,
            'name' => explode(' ', $user2->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));

    }
}
