<?php

// namespace App\Livewire;

// use App\Models\Product;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;


// class Products extends Component
// {
//     public $category = "products";
//     public $number = 3;
//     public $selectedBrands = [];

//     public function render()
//     {

//         $products = Product::query()->
//         where('is_active', true);
//         Log::info("this works");
//         if ($this->category !== "products"){
//             $products = $products->where('category', ucfirst($this->category));
//         }
        
//         if (!empty($this->selectedBrands)) {
//             $products->whereIn('brand', $this->selectedBrands);
            
//         } 
//         $products = $products->get();
//         return view('livewire.products', compact('products'));

//     }

//     public function mount($category="products"){
//         Log::info($this->selectedBrands);
//         $category = strtolower($category);
//         $valid = ['men', 'women', 'boys', 'girls', 'products'];
//         if (!in_array($category, $valid)) abort(404);
//         $this->category = $category;
//     }

//     public function changeNumber(){
//         Log::info("Counter");
//         $this->number = 5;
//     }

// }

// namespace App\Livewire;

// use App\Models\Product;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;

// class Products extends Component
// {
//     public $category = "products";
//     public $number = 3;
//     // Make sure the property is properly initialized as an array
//     public $selectedBrands = [];

//     // Add property listeners to make sure Livewire is tracking changes properly
//     protected $listeners = ['brandSelectionChanged'];

//     public function render()
//     {
//         // Debug logging to check the state of selectedBrands
//         Log::info("selectedBrands in render: ", $this->selectedBrands);

//         $products = Product::query()->
//         where('is_active', true);
        
//         if ($this->category !== "products"){
//             $products = $products->where('category', ucfirst($this->category));
//         }
        
//         if (!empty($this->selectedBrands)) {
//             $products->whereIn('brand', $this->selectedBrands);
//         } 
        
//         $products = $products->get();
//         return view('livewire.products', compact('products'));
//     }

//     public function mount($category="products")
//     {
//         // Debug log what values we have during initialization
//         Log::info("Mounting with selectedBrands:", $this->selectedBrands);
        
//         $category = strtolower($category);
//         $valid = ['men', 'women', 'boys', 'girls', 'products'];
//         if (!in_array($category, $valid)) abort(404);
//         $this->category = $category;
//     }

//     public function changeNumber()
//     {
//         Log::info("Counter");
//         $this->number = 5;
//     }

//     // Add this method to track when a property is updated
//     public function updated($name, $value)
//     {
//         // This will help debug when properties change
//         Log::info("Property updated: {$name} = ", is_array($value) ? $value : [$value]);
        
//         if ($name === 'selectedBrands') {
//             Log::info("selectedBrands updated to:", $this->selectedBrands);
//         }
//     }

//     // Helper method to force refresh if needed
//     public function brandSelectionChanged()
//     {
//         // This method can be triggered manually if needed
//         Log::info("Brand selection changed event triggered");
//     }
// }



namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $category = "products";
    public $availableTags = ['top-seller', 'new-arriaval', 'sports', 'lightweight', 'featured'];
    public $availableBrands = ['Puma', "Nike", "Polo"];
    public $selectedBrands = [];
    public $selectedTags = [];

    public function render()
    {
        $products = Product::query()->
        where('is_active', true)->select( 'name', 'brand', 'thumbnail_image', 'base_price', 'product_id');
        
        if ($this->category !== "products"){
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

    public function mount($category="products")
    {
        $category = strtolower($category);
        $valid = ['men', 'women', 'boys', 'girls', 'products'];
        if (!in_array($category, $valid)) abort(404);
        $this->category = $category;
    }
}


// namespace App\Livewire;

// use App\Models\Product;
// use Illuminate\Support\Facades\Log;
// use Livewire\Component;


// class Products extends Component
// {
//     public $category = "products";
//     public $number = 3;
//     public $selectedBrands = [];
//     public $debugMessage = '';

//     // Tell Livewire which properties should trigger a re-render when updated
//     protected $queryString = ['selectedBrands'];

//     public function render()
//     {
        
//         $products = Product::query()
//             ->where('is_active', true);
        
//         if ($this->category !== "products"){
//             $products = $products->where('category', ucfirst($this->category));
//         }
        
//         // Explicitly check and log filter application
//         if (!empty($this->selectedBrands)) {
//             $products->whereIn('brand', $this->selectedBrands);
//         } else {
//             $this->debugMessage = 'No brand filters applied';
//         }
        
//         $products = $products->get();
//         Log::info('Query returned ' . $products->count() . ' products');
        
//         return view('livewire.products', [
//             'products' => $products,
//             'debugMessage' => $this->debugMessage
//         ]);
//     }

//     public function mount($category="products")
//     {
//         $category = strtolower($category);
//         $valid = ['men', 'women', 'boys', 'girls', 'products'];
//         if (!in_array($category, $valid)) abort(404);
//         $this->category = $category;
        
//         // Clear any existing filters on page load
//         $this->selectedBrands = [];
//     }

//     public function updatedSelectedBrands($value)
//     {
//         // Log when this event is triggered
//         Log::info('updatedSelectedBrands called with value: ', [$value]);
//         Log::info('Current selectedBrands: ', $this->selectedBrands);
//     }

//     public function hydrate()
//     {
//         // Triggered when the component is hydrated from a Livewire request
//         Log::info('Component hydrated');
//     }

//     public function dehydrate()
//     {
//         // Triggered when the component is dehydrated for a Livewire response
//         Log::info('Component dehydrated with selectedBrands: ', $this->selectedBrands);
//     }

//     public function changeNumber()
//     {
//         $this->number = 5;
//     }
    
//     // Testing method to manually set brands - can be used to verify component is working
//     public function setTestBrands($brand = 'Nike')
//     {
//         $this->selectedBrands = [$brand];
//         Log::info('Manually set selectedBrands to: ', $this->selectedBrands);
//     }
// }
