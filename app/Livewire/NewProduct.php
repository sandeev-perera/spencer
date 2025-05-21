<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class NewProduct extends Component
{
    use WithFileUploads;
    public $selectedSection;
    public $show;
    public $product_id;
    public $name;
    public $description;
    public $category = "Men";
    public $availableBrands = ['Puma', "Nike", "Polo"];
    public $brand = "Puma";
    public $thumbnail_image;
    public $base_price;
    public $variants = [];
    public $tags;
    public $is_active = true;

    public function addVariant()
    {
        $this->variants[] = [
            'color' => '',
            'images'=>[''],
            'sub_variants' =>[
            [
            'size' => '',
            'stock_quantity' => '',
            'sku' => ''
            ]

            ]
        ];
    }

    public function addSubVariant($index){
        $this->variants[$index]["sub_variants"][]=
        [
            'size' => '',
            'stock_quantity' => '',
            'sku' => ''
        ]
        ;
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function removeSubVariant($index, $subindex){
        unset($this->variants[$index]['sub_variants'][$subindex]);
        $this->variants[$index]['sub_variants'] = array_values($this->variants[$index]['sub_variants']);
    }

    public function render()
    {
        Log::info($this->base_price);
        return view('livewire.new-product', [
            'selectedSection' => $this->selectedSection,
            'show' => $this->show
        ]);
    }

    public function save()
    {
       
        Log::info("Product ID: " . $this->product_id);

        // Store thumbnail image
        $thumbnailPath = null;
        if ($this->thumbnail_image) {
            $directory = "products/{$this->product_id}";
            Storage::disk('public')->makeDirectory($directory);
            $thumbnailPath = $this->thumbnail_image->storeAs($directory, 'thumbnail.jpg', 'public');
            Log::info('Thumbnail image stored at: ' . $thumbnailPath);
        }

        // Store variant images
        $variantData = $this->variants;
        Log::info('Variants data:', $variantData);
        foreach ($variantData as $index => $variant) {
            if (!empty($variant['images'])) {
                $color = trim(str_replace(['/', '\\', '..'], '', $variant['color'] ?? 'unknown'));
                $variantDirectory = "products/{$this->product_id}/variants/{$color}";
                Storage::disk('public')->makeDirectory($variantDirectory);
                Log::info("Variant directory created: " . $variantDirectory);
                $variantData[$index]['images'] = array_map(function ($image) use ($variantDirectory, $index) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs($variantDirectory, $filename, 'public');
                    Log::info("Variant image stored at index {$index}: " . $path);
                    return $path;
                }, $variant['images']);
            } else {
                Log::info("No images for variant at index {$index}");
            }
        }

        Log::info('Product Data:', [
            'product_id' => $this->product_id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'brand' => $this->brand,
            'thumbnail_image' => $this->thumbnail_image,
            'base_price' => $this->base_price,
            'variants' => $this->variants,
            'tags' => explode(',', $this->tags),
            'is_active' => $this->is_active,
        ]);
    }

}
