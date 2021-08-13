<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class refund extends Model
{
    protected $fillable=[
    'order_id','transaction_id','amount','reason','status'
];
}
