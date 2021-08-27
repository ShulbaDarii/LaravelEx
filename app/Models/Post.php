<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function commentars()
    {
        return $this->hasMany(Commentar::class,'post_id','id');
    }
}
