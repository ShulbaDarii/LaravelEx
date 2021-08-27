<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'slug',
        'permissions'
    ];

    protected $cats = [
        'permissions' => 'array'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class,'assign_roles','role_id','user_id');
    }

    public function hasAccess(array $permissions) : bool 
    {
        foreach($permissions as $permission)
        {
            if($this->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return $this->permissions[$permission] ?? false;
    }
}
