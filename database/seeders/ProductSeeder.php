<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
            'product_id'=> 5003,
            'name' => 'Nike Air Max',
            'description' => 'Comfortable and stylish running shoes',
            'category' => 'Men',
            'brand' => 'Nike',
            'thumbnail_image' => '/images/nike-air-max/thumb.jpg',
            'base_price'=> 12000,
            'variants' => [
                [
                    'color' => 'Red',
                    'size' => 'M',
                    'stock_quantity' => 15,
                    'sku' => 'RED-M-5003',
                    'images' => [                        
                        '/images/nike-air-max/red-1.jpg',
                        '/images/nike-air-max/red-2.jpg',
                    ]
                ],
                [
                    'color' => 'Blue',
                    'size' => 'L',
                    'stock_quantity' => 10,
                    'sku' => 'BLUE-L-5003',
                    'images' => [
                        '/images/nike-air-max/blue-1.jpg',
                        '/images/nike-air-max/blue-2.jpg',
                    ]
                ]
            ],
            'tags' => ['new-arrival', 'top-seller'],
            'is_active' => true, 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'product_id' => 5004,
            'name' => 'Puma Sky Blaze',
            'description' => 'Lightweight breathable sneakers',
            'category' => 'Women',
            'brand' => 'Puma',
            'thumbnail_image' => '/images/puma-sky-blaze/thumb.jpg',
            'base_price' => 9800,
            'variants' => [
                [
                    'color' => 'Blue',
                    'size' => 'S',
                    'stock_quantity' => 12,
                    'sku' => 'BLU-S-5004',
                    'images' => [
                        '/images/puma-sky-blaze/blue-1.jpg',
                        '/images/puma-sky-blaze/blue-2.jpg',
                    ]
                ],
                [
                'color' => 'Blue',
                'size' => 'M',
                'stock_quantity' => 14,
                'sku' => 'BLU-M-5004',
                'images' => [
                    '/images/puma-sky-blaze/blue-1.jpg',
                    '/images/puma-sky-blaze/blue-2.jpg',
                ]
                ],
                [
                    'color' => 'Black',
                    'size' => 'S',
                    'stock_quantity' => 14,
                    'sku' => 'BLK-S-5004',
                    'images' => [
                        '/images/puma-sky-blaze/blue-1.jpg',
                        '/images/puma-sky-blaze/blue-2.jpg',
                    ]
                ]



            ],
            'tags' => ['lightweight', 'featured'],
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'product_id' => 5005,
            'name' => 'Polo Street Tread',
            'description' => 'Comfort meets style for everyday use',
            'category' => 'Boys',
            'brand' => 'Polo',
            'thumbnail_image' => '/images/polo-street-tread/thumb.jpg',
            'base_price' => 7300,
            'variants' => [
                [
                    'color' => 'Green',
                    'size' => 'S',
                    'stock_quantity' => 18,
                    'sku' => 'GRN-S-5005',
                    'images' => [
                        '/images/polo-street-tread/green-1.jpg',
                        '/images/polo-street-tread/green-2.jpg',
                    ]
                ]
            ],
            'tags' => ['kids', 'streetwear'],
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'product_id' => 5006,
            'name' => 'Nike Motion Run',
            'description' => 'Engineered for fast-paced runners',
            'category' => 'Men',
            'brand' => 'Nike',
            'thumbnail_image' => '/images/nike-motion-run/thumb.jpg',
            'base_price' => 11800,
            'variants' => [
                [
                    'color' => 'Black',
                    'size' => 'L',
                    'stock_quantity' => 14,
                    'sku' => 'BLK-L-5006',
                    'images' => [
                        '/images/nike-motion-run/black-1.jpg',
                        '/images/nike-motion-run/black-2.jpg',
                    ]
                ]
            ],
            'tags' => ['speed', 'runner'],
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
        
    }
}
