<?php

namespace Modules\Communication\Entities;

use Illuminate\Database\Eloquent\Model;

class Messaging extends Model
{
    protected $table = 'messagings';

    protected $fillable = [
        'id',
        'body',
        'name',
        'parent_id',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function contact(){
        return $this->belongsTo('App\Contact','user_id');
    }
}
