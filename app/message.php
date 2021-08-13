<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
        protected $fillable=[
    'first_name','last_name','email','contact_no','subject','message'
];
}
