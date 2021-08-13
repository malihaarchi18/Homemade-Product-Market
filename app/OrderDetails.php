<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //
    protected $fillable=[
    'product_id','quantity','order_no','user_id',
];
protected $guarded = [];

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
    	return $this->belongsTo(Cart::class,'product_id');
    }

      public function order()
    {
        return $this->belongsTo(Order::class,'order_no');
    }


   //
    



}
