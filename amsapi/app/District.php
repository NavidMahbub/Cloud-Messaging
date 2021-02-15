<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name',
        'bn_name',
        'lat',
        'lon',
        'website'
    ];

    protected $table = 'districts';

    public function upazila()
    {
        return $this->hasMany('App\Upazila');
    }

    public function contact()
    {
        return $this->hasMany('App\Contact');
    }
}

