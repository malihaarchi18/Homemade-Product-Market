<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable=[
    'name','user_id','email','phone','amount','address','status','transaction_id' ,'currency','seen_by_admin' ,
];
protected $guarded = [];

 public function cart()
    {
    	return $this->hasMany('App\Cart');
    }


  


   
}
