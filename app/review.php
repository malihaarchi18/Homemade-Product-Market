<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $fillable=[
    'user_id','user_name','product_id','slug','review'
];
}
