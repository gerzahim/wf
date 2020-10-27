<?php

namespace App\Models;

use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function permissions(){
        //return $this->belongsToMany(Permission::class)->select(array('name'));
        //return $this->belongsToMany(Permission::class);
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }





    /*
        public function roles() {
        //return $this->belongsToMany(Role::class);
        //return $this->belongsToMany(Role::class,'roles_permissions');
        return $this->belongsToMany(Role::class,'users_roles');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'users_roles');
    }

    public function users2()
    {
        $userModel = User::class;
        return $this->belongsToMany($userModel, 'user_roles')
            ->select(app($userModel)->getTable().'.*')
            ->union($this->hasMany($userModel))->getQuery();
    }

    public function assign($permissions){
        return $this->permissions()->sync($permissions);
    }
    */

}

