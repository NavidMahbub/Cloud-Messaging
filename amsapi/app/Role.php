<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'permissions',
        'permissions2',
        'created_by',
        'updated_by'
    ];

    protected $table = 'roles';
}
