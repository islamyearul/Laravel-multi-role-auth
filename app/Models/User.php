<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
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
     * The attributes that should be cast.
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

   
    public static function getPermissionGroupName(){
        $permission_group = DB::table('permissions')->select('group_name as name')->groupBy('group_name')->get();
        return $permission_group;
    }
    
    public static function getPermissionByGroupName($GroupName){
        // $permissionName = DB::table('permissions')->select('name')->groupBy('name')->get();

        $permissionName = Permission::where('group_name', $GroupName)->get();

        return $permissionName;
    }

    public static function roleHasPermission($role, $permissions){
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;

        }

}
