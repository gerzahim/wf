<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRolesAndPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function teams() {
        return $this->belongsToMany(Team::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

}
    /*
    public function hasAccess(array $permissions) {
        foreach($this->roles as $role){
            if($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public function getAvatarAttribute($value) {
        return $value ?? config('user.default_avatar', 'users/default.png');
    }

    public function setLocaleAttribute($value) {
        $this->settings = $this->settings->merge(['locale' => $value]);
    }

    public function getLocaleAttribute() {
        return $this->settings->get('locale');
    }
    */

