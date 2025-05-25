<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Cart extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "cart";

    protected $guarded = [];

        protected $casts = [
        'user_id' => "string",
    ];

}
