<?php
namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $category = "products";
    public $availableTags = ['top-seller', 'new-arrival', 'sports', 'lightweight', 'featured'];
    public $availableBrands = ['Puma', "Nike", "Polo"];
    public $selectedBrands = [];
    public $selectedTags = [];

    public function render()
    {
        $products = Product::query()->
            where('is_active', true)->select('name', 'brand', 'thumbnail_image', 'base_price', 'product_id');

        if ($this->category !== "products") {
            $products = $products->where('category', ucfirst($this->category));
        }

        if (!empty($this->selectedTags)) {
            $products->whereIn('tags', $this->selectedTags);
        }

        if (!empty($this->selectedBrands)) {
            $products->whereIn('brand', $this->selectedBrands);
        }
        $products = $products->get();
        return view('livewire.products', compact('products'));
    }

    public function mount($category = "products")
    {
        $category = strtolower($category);
        $valid = ['men', 'women', 'boys', 'girls', 'products'];
        if (!in_array($category, $valid))
            abort(404);
        $this->category = $category;
    }
}
