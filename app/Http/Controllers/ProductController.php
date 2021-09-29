<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
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
        //$element->categories()->attach($request->categories, ['element_id' => $element->id]);
        //$element->boxes()->attach($request->boxes, ['element_id' => $element->id]);
    }
}
