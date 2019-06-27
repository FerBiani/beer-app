<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class FavoriteBeer extends Model
{
    protected $table = 'favorite_beers';

    protected $fillable = [
        'beer_id', 'user_id'
    ];

    public $timestamps = false;

}
