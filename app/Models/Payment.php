<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Payment extends Model
{
   protected $connection = 'mongodb';
   protected $collection = "payment";
    protected $guarded = [];
        protected $casts = [
        'user_id' => "string",
        'order_id'=> "string"
    ];
}
