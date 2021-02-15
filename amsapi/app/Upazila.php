<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    protected $fillable = [
        'district_id',
        'dmp',
        'name',
        'bn_name'
    ];

    protected $table = 'upazilas';

    public function district()
    {
        return $this->belongsTo('App\District','district_id');
    }

    public function contact()
    {
        return $this->hasMany('App\Contact');
    }
}
