<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{

    protected $fillable = [
        'number', 'user_id'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('User');
    }

    //MUTATORS
    public function setAttributeNumber($val) {
        return $this->attributes['number'] = str_replace(['(', ')', '-', ' '], '', $val);
    }

}
