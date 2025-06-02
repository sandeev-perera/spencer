<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductsApiController extends Controller
{
    public function index(){
        return response()->json(Product::all());
    }
    public function show($id){
        $product = Product::where('product_id', (int)$id)->first();
        return $product ? response()->json($product) : response()->json(['message' => "not found"], 404);
    }

    public function store(Request $request){
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }
}
