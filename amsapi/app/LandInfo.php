<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandInfo extends Model
{
    protected $fillable = [
        'user_id',
        'owner_id',
        'amount',
        'land_amount',
        'location'
    ];

    protected $table = 'land_infos';

    public function owner(){
   		return $this->belongsTo('App\Contact','owner_id');
   	}
}
