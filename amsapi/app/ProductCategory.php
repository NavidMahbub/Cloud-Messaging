<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'status',
    ];

    protected $table = 'product_categories';

    public function productCategory(){
   		return $this->hasMany('App\Product');
   	}
}
