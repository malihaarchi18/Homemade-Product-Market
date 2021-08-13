<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
     protected $fillable=[
    'product_id','user_id',
];

   public function product()
    {
    	return $this->belongsTo(Product::class,'product_id');
    }
     public function image()
    {
    	return $this->belongsTo(ProductImage::class,'product_id');
    }

}
