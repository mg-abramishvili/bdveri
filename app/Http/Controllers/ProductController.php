<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Color;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products_index()
    {
        return Product::all();
    }

    public function product_item($id)
    {
        return Product::with('colors')->find($id);
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

    public function add_color($id, Request $request) {
        $data = request()->all();
        $product = Product::find($id);

        $temp_file = TemporaryFile::where('folder', $data['color_image'])->first();
        
        rename(public_path() . '/temp_uploads/' . $temp_file->folder . '/' . $temp_file->filename, public_path() . '/uploads/' . now()->timestamp . '_' . $temp_file->filename);
        rmdir(public_path('temp_uploads/' . $temp_file->folder));
        $temp_file->delete();
        
        $color = new Color([
            'name' => $data['color_name'],
            'price' => $data['color_price'],
            'image' => '/uploads/' . now()->timestamp . '_' . $temp_file->filename
        ]);

        $color->save();
        $product->colors()->attach($color->id, ['product_id' => $product->id]);
    }

    public function add_color_image_store(Request $request) {
        if($request->hasFile('new_color_image')) {
            $file = $request->file('new_color_image');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->move(public_path() . '/temp_uploads/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }
}
