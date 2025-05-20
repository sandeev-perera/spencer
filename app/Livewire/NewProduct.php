<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
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
            'size' => '',
            'stock_quantity' => '',
            'sku' => '',
            'images' => [''],
        ];
    }

    // public function addTag(){
    //     $this->
    // }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
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
