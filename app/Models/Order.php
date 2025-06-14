<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "order";
    protected $guarded = [];
        protected $casts = [
        'user_id' => "string",
    ];
}