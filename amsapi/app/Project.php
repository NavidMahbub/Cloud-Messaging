<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'project_category_id',
        'type',
        'block_no',
        'road_no',
        'plot_size',
        'image',
        'status',
        'sales_price',
        'purchase_price',
        'location',
        'created_by',
        'updated_by'
    ];

    protected $table = 'projects';

   public function projectCategory(){
   		return $this->belongsTo('App\ProjectCategory','project_category_id');
   }
   public function createdBy(){
        return $this->belongsTo('App\User','created_by');
   }
   public function updatedBy(){
        return $this->belongsTo('App\User','updated_by');
   }
}
