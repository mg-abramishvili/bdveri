<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products_index()
    {
        return Product::all();
    }

    public function product_item($id)
    {
        return Product::find($id);
    }

    public function products_store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'base_price' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $data = request()->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->base_price = $data['base_price'];
        $product->old_price = $data['old_price'];
        $product->description = $data['description'];
        $product->save();
    }

    public function product_update($id, Request $request)
    {
        $rules = [
            'name' => 'required',
            'base_price' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $data = request()->all();
        $product = Product::find($id);
        $product->name = $data['name'];
        $product->base_price = $data['base_price'];
        $product->old_price = $data['old_price'];
        $product->description = $data['description'];
        $product->save();
    }
}
