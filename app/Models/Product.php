<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
class Product extends Model 
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $guarded = [];

    protected $casts = [
        'product_id' => 'integer',
        'is_active' => 'boolean',
        'base_price' => 'float',
        'thumbnail_image' => 'string'
    ];

//     public function setVariantsAttribute($value)
// {
//     $this->attributes['variants'] = is_string($value) ? json_decode($value, true) : $value;
// }

// public function setTagsAttribute($value)
// {
//     $this->attributes['tags'] = is_string($value) ? json_decode($value, true) : $value;
// }

}
