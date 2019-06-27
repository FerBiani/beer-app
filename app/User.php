<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function phones() {
        return $this->hasMany('App\Phone');
    }

    public function favoriteBeers() {
        return $this->hasMany('App\FavoriteBeer');
    }

}
