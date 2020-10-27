<?php

namespace App\Traits;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Collection;

trait HasRolesAndPermissionsTrait {

    /**
     * Validate if auth user has any role
     * $user->hasAnyRole('developer') );
     * $user->hasAnyRole( ['developer', 'manager'] );
     * @param mixed ...$roles
     * @return bool
     */
    public function hasAnyRole(... $roles ) {
        // $this->roles roles extend from user Model
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Validate if auth user has permission to
     * @param $permission_slug
     * @return bool
     */
    public function hasPermissionTo( $permission_slug)
    {
        foreach ($this->roles as $role) { // evaluate each role
            if ( $role->permissions->contains('slug', $permission_slug) ){
                return true;
            }
        }
        return false;
    }

    /**
     * Authorize only for roles given in array
     * $request->user()->authorizeRoles(['employee', 'manager']);
     * @param mixed ...$roles
     */
    public function authorizeRoles(... $roles) {
        if (is_array($roles)) {
            if( $this->hasAnyRole($roles) ) {
                return abort(401, 'This action is unauthorized.');
            }
        }
    }



    /**
     * Validate if user given has role
     * @param User $user
     * @param $role_slug
     * @return bool
     */
    public function hasRoleUserGiven( $role_slug, User $user ) {
        return $user->roles->contains('slug', $role_slug);
    }


    /**
     *  Validate is user given has Permission Through Role
     * @param $permission_slug
     * @param User $user
     * @return bool
     */
    public function hasPermissionToUserGiven( $permission_slug, User $user)
    {
        $permission_id = Permission::where('slug',$permission_slug)->pluck('id')->first();
        if ($permission_id) {
            foreach ($user->roles as $role) { // get roles from users_roles table
                foreach ($role->permissions as $permission) { // get permissions from roles_permissions table
                    if ($permission_id == $permission->pivot->permission_id) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param array $permissions
     * @return mixed
     */
    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug',$permissions)->get();
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }


    /**
     * @param mixed ...$permissions
     * @return HasRolesAndPermissionsTrait
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

}
