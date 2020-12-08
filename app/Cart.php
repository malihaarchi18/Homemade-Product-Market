<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     protected $fillable=[
    'product_id','quantity','price','user_ip','user_id','stock',
];
 public function product()
    {
    	return $this->belongsTo(Product::class,'product_id');
    }
     public function image()
    {
    	return $this->belongsTo(ProductImage::class,'product_id');
    }

   public function quantity()
    {
    return $this->belongsTo(Product::class,'stock');
    }
    public function user()
    {
    return $this->belongsTo(User::class,'user_id');
    }

 
    


}