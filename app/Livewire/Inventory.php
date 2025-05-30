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

    public function editSection($id)
    {
        $product = Product::firstWhere('product_id', $id);
        $this->editingProduct = $product->toArray();
        $this->showEditSection = true;
    }

    public function cancalEdit()
    {
        $this->showEditSection = false;
        $this->editingProduct = [];
    }

    public function render()
    {
        if (!empty($this->search)) {
            $products = Product::query()
                ->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('product_id', 'like', "%{$this->search}%")
                        ->orWhere('brand', 'like', "%{$this->search}%")
                        ->orWhere('variants.sub_variants.sku', 'like', "%{$this->search}%");
                })
                ->paginate(4);
        } else {
            $products = Product::select(['product_id', 'name', 'base_price', 'category', 'variants', 'brand'])->paginate(4);
        }

        return view('livewire.inventory', [
            'products' => $products,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updateProduct()
    {
        $this->validate([
            'editingProduct.name' => 'required|string|max:255',
            'editingProduct.description' => 'nullable|string',
            'editingProduct.base_price' => 'required|numeric|min:0',
            'editingProduct.is_active' => 'boolean',
            'editingProduct.variants.*.sub_variants.*.stock_quantity' => 'required|numeric|min:0'
        ]);

        $product = Product::find($this->editingProduct['id']);

        if (isset($this->editingProduct['variants']) && is_array($this->editingProduct['variants'])) {
        foreach ($this->editingProduct['variants'] as $index => &$variant) {
            if (isset($variant['sub_variants']) && is_array($variant['sub_variants'])) {
                foreach ($variant['sub_variants'] as $subIndex => &$subVariant) {
                    $subVariant['stock_quantity'] = isset($subVariant['stock_quantity'])? (int)$subVariant['stock_quantity']: 0;
                }
            }
        }
        unset($variant, $subVariant);
    }

        $this->editingProduct['base_price'] = (float)$this->editingProduct['base_price'];
        $product->update($this->editingProduct);
        session()->flash('message', 'Product edited successfully!');
        $this->cancalEdit();
    }
}
