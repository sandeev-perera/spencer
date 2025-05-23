<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Inventory extends Component
{
    use WithPagination;
    public $selectedSection;
    public $show;

    public $search = '';

    public $showEditSection = false;
    public $editingProduct = [];

    public function editSection($id){
        $product = Product::firstWhere('product_id', $id);
        $this->editingProduct = $product->toArray();
        $this->showEditSection = true;
    }

    public function cancalEdit(){
        $this->showEditSection = false;
        $this->editingProduct = [];
    }

    public function render()
    {
        if(!empty($this->search)){
            $products = Product::query()
        ->where(function ($query) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('product_id', 'like', "%{$this->search}%")
                ->orWhere('brand', 'like', "%{$this->search}%")
                ->orWhere('variants.sub_variants.sku', 'like', "%{$this->search}%");
        })
        ->paginate(10);
        }
        else{
            $products = Product::select(['product_id', 'name', 'base_price', 'category', 'variants', 'brand'])->paginate(10);
        }
        
        return view('livewire.inventory', [
            'products' => $products,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updateProduct(){
        $this->validate([
        'editingProduct.name' => 'required|string|max:255',
        'editingProduct.description' => 'nullable|string',
        'editingProduct.base_price' => 'required|numeric|min:0',
        'editingProduct.is_active' => 'boolean',
        'editingProduct.variants.*.sub_variants.*.stock_quantity' => 'required|numeric|min:0'
        ]);

        $product = Product::find($this->editingProduct['id']);
        Log::info("Product is ". $product);

        $product->update($this->editingProduct);
        session()->flash('message', 'Product edited successfully!');
        $this->cancalEdit();
    }
}
