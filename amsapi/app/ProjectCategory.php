<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $table = 'project_categories';

    
    public function createdBy(){
        return $this->belongsTo('App\User','created_by');
    }
    public function updatedBy(){
        return $this->belongsTo('App\User','updated_by');
    }
}
