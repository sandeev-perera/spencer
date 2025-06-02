<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;

class NewProduct extends Component
{
    use WithFileUploads;
    public $selectedSection;
    public $show;
    public $availableColors = [
        'white - WHT' => 'WHT',
        'black - BLK' => 'BLK',
        'green - GRN' => 'GRN',
        'red - RED' => "RED",
        'blue - BLU' => "BLU",
        'ash - ASH' => "ASH"
    ];

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
            ]
            ]
        ];
    }
    public function addSubVariant($index){
        $this->variants[$index]["sub_variants"][]=
        [
            'size' => '',
            'stock_quantity' => '',
        ];
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
        return view('livewire.new-product', [
            'selectedSection' => $this->selectedSection,
            'show' => $this->show
        ]);
    }

    public function save()
    {
        $exists = Product::where('product_id', (int)$this->product_id)->exists();
        if ($exists) {
            $this->addError('product_id', 'This Product ID is already in use.');
            return;
        }
        
        $this->validate([
            'product_id' => 'required|numeric|unique:products,product_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:50|',
            'thumbnail_image' => 'required|max:2048|mimes:png,jpeg,jpg,webp|image',
            'base_price' => 'required|numeric|min:0',
            'variants.*.color' => 'required',
            'variants.*.images' => 'array',
            'variants.*.images.*' => 'required|max:2048|mimes:png,jpeg,jpg,webp|image',
            'variants.*.sub_variants.*.size' => ['required', 'string', Rule::in(["S", "M", "L"])],
            'variants.*.sub_variants.*.stock_quantity' => 'nullable|numeric',
            'tags' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $thumbnailPath = null;
        if ($this->thumbnail_image) {
            $directory = "products/{$this->product_id}";
            Storage::disk('public')->makeDirectory($directory);
            $thumbnailPath = $this->thumbnail_image->storeAs($directory, 'thumbnail.jpg', 'public');
            $this->thumbnail_image = $thumbnailPath;
        }

        // Store variant images
        $variantData = $this->variants;
        foreach ($variantData as $index => $variant) {
                $color = $variant['color'] ?? 'unknown';
                if (!empty($variant['images'])) {
                    $variantDirectory = "products/{$this->product_id}/variants/{$color}";
                    Storage::disk('public')->makeDirectory($variantDirectory);
                    foreach ($variant['images'] as $imageIndex => $image) {
                        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                        $path = $image->storeAs($variantDirectory, $filename, 'public');
                        $variantData[$index]['images'][$imageIndex] = $path;
                    }
                } else {
                    Log::info("No images for variant at index {$index}");
                }
            //Generate SKU for each subVariant
            foreach ($variant['sub_variants'] as $subIndex => $subVariant) {
                $variantData[$index]['sub_variants'][$subIndex]['sku'] = $color . "-" . $subVariant['size'] . "-" . $this->product_id;
                $variantData[$index]['sub_variants'][$subIndex]['stock_quantity'] = isset($subVariant['stock_quantity']) ? (int)$subVariant['stock_quantity'] : 0;
            }
        }
        $this->variants = $variantData;
        $productData = [
            'product_id' => (int)$this->product_id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'brand' => $this->brand,
            'thumbnail_image' => $this->thumbnail_image,
            'base_price' => (float)$this->base_price,
            'variants' => $this->variants,
            'tags' => $this->tags ? explode(',', $this->tags) : [],
            'is_active' => $this->is_active,
        ];

        $product = Product::updateOrCreate(
            ['product_id' => (int)$this->product_id],
            $productData
        );

        if($product){
            session()->flash("message", "Product Added Successfully");
        }

        $this->reset(['product_id', 'name', 'description', 'category', 'brand', 'thumbnail_image', 'base_price', 'variants', 'tags']);
    }

}
