<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delivary extends Model
{
    //
      protected $fillable=[
    'order_id','status','delivered_by','delivary_time','signature',
];
}
