<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class,'assign_roles','user_id','role_id');
    }

    public function hasAccess(array $permissions) : bool 
    {
        foreach($this->roles as $role)
        {
            if($this->hasRole($permissions)){
                return true;
            }
        }
        return false;
    }

    public function hasRole($roleSlug)
    {
        return $this->roles()->where('slug',$roleSlug)->count()==1;
    }

    public function commentars()
    {
        return $this->hasMany(Commentar::class,'user_id','id');
    }
}
