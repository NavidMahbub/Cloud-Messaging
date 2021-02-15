<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'product_category_id',
        'type',
        'block_no',
        'road_no',
        'plot_size',
        'image',
        'status',
        'sales_price',
        'purchase_price',
        'location',
    ];

    protected $table = 'products';

   public function productCategory(){
   		return $this->belongsTo('App\ProductCategory','product_category_id');
   }
}
