<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Color;
use App\Models\Size;
use App\Models\Style;
use App\Models\Type;
use App\Models\Manufacturer;
use App\Models\Production;
use App\Models\Surface;
use App\Models\Construct;
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
        return Product::with('colors', 'sizes', 'styles', 'types', 'manufacturers', 'surfaces', 'productions', 'constructs')->find($id);
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
        $product->constructs()->attach($request->construct, ['product_id' => $product->id]);
        $product->manufacturers()->attach($request->manufacturer, ['product_id' => $product->id]);
        $product->productions()->attach($request->production, ['product_id' => $product->id]);
        $product->styles()->attach($request->style, ['product_id' => $product->id]);
        $product->surfaces()->attach($request->surface, ['product_id' => $product->id]);
        $product->types()->attach($request->type, ['product_id' => $product->id]);
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
        $product->hit = $data['hit'];
        $product->discount = $data['discount'];
        $product->sale = $data['sale'];
        $product->special = $data['special'];
        $product->constructs()->detach();
        $product->constructs()->attach($request->construct, ['product_id' => $product->id]);
        $product->manufacturers()->detach();
        $product->manufacturers()->attach($request->manufacturer, ['product_id' => $product->id]);
        $product->productions()->detach();
        $product->productions()->attach($request->production, ['product_id' => $product->id]);
        $product->styles()->detach();
        $product->styles()->attach($request->style, ['product_id' => $product->id]);
        $product->surfaces()->detach();
        $product->surfaces()->attach($request->surface, ['product_id' => $product->id]);
        $product->types()->detach();
        $product->types()->attach($request->type, ['product_id' => $product->id]);
        $product->save();
    }

    public function color_item($id)
    {
        return Color::find($id);
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

    public function update_color($id, Request $request) {
        $data = request()->all();
        $color = Color::find($id);

        if(TemporaryFile::where('folder', $data['color_image'])->first()) {
            $temp_file = TemporaryFile::where('folder', $data['color_image'])->first();
            rename(public_path() . '/temp_uploads/' . $temp_file->folder . '/' . $temp_file->filename, public_path() . '/uploads/' . now()->timestamp . '_' . $temp_file->filename);
            rmdir(public_path('temp_uploads/' . $temp_file->folder));
            $temp_file->delete();
            $color->name = $data['color_name'];
            $color->price = $data['color_price'];
            $color->image = '/uploads/' . now()->timestamp . '_' . $temp_file->filename;
        } else {
            $color->name = $data['color_name'];
            $color->price = $data['color_price'];
            $color->image = $data['color_image'];
        }

        $color->save();
    }

    public function delete_color($id, Request $request) {
        $data = request()->all();
        $color = Color::find($id);
        $color->products()->detach();
        $color->delete();
    }

    public function add_color_image_store(Request $request) {
        if($request->hasFile('new_color_image') || $request->hasFile('edit_color_image')) {
            
            if($request->hasFile('new_color_image')) {
                $file = $request->file('new_color_image');
            }

            if($request->hasFile('edit_color_image')) {
                $file = $request->file('edit_color_image');
            }

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

    public function size_item($id)
    {
        return Size::find($id);
    }

    public function add_size($id, Request $request) {
        $data = request()->all();
        $product = Product::find($id);
        
        $size = new Size([
            'name' => $data['size_name'],
            'price' => $data['size_price'],
        ]);

        $size->save();
        $product->sizes()->attach($size->id, ['product_id' => $product->id]);
    }

    public function update_size($id, Request $request) {
        $data = request()->all();
        $size = Size::find($id);

        $size->name = $data['size_name'];
        $size->price = $data['size_price'];

        $size->save();
    }

    public function delete_size($id, Request $request) {
        $data = request()->all();
        $size = Size::find($id);
        $size->products()->detach();
        $size->delete();
    }

    public function styles_index()
    {
        return Style::all();
    }

    public function sizes_index()
    {
        return Size::all();
    }

    public function manufacturers_index()
    {
        return Manufacturer::all();
    }

    public function surfaces_index()
    {
        return Surface::all();
    }

    public function types_index()
    {
        return Type::all();
    }

    public function productions_index()
    {
        return Production::all();
    }

    public function constructs_index()
    {
        return Construct::all();
    }

    public function all_reviews()
    {
        return Review::all();
    }

    public function product_reviews($id, Request $request)
    {
        return Review::whereRelation('products', 'product_id', $id)->get();
    }

    public function add_review($id, Request $request)
    {
        $rules = [
            'review_name' => 'required',
            'review_text' => 'required',
            'review_star' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $data = request()->all();
        $product = Product::find($id);
        
        $review = new Review([
            'name' => $data['review_name'],
            'text' => $data['review_text'],
            'star' => $data['review_star'],
        ]);

        $review->save();
        $product->reviews()->attach($review->id, ['product_id' => $product->id]);
    }
}
