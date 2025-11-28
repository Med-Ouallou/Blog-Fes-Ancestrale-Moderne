<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Since no auth, password is nullable and not used

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}