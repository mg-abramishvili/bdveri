<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('products','App\Http\Controllers\ProductController@products_index');
Route::get('product/{id}','App\Http\Controllers\ProductController@product_item');
Route::post('products','App\Http\Controllers\ProductController@products_store');
Route::post('product/{id}/update','App\Http\Controllers\ProductController@product_update');

Route::post('product/{id}/add_color','App\Http\Controllers\ProductController@add_color');
Route::post('product/add_color_image_upload','App\Http\Controllers\ProductController@add_color_image_store');
Route::get('color/{id}','App\Http\Controllers\ProductController@color_item');
Route::post('color/{id}/update','App\Http\Controllers\ProductController@update_color');
Route::get('color/{id}/delete','App\Http\Controllers\ProductController@delete_color');

Route::post('product/{id}/add_size','App\Http\Controllers\ProductController@add_size');
Route::get('size/{id}','App\Http\Controllers\ProductController@size_item');
Route::post('size/{id}/update','App\Http\Controllers\ProductController@update_size');
Route::get('size/{id}/delete','App\Http\Controllers\ProductController@delete_size');

Route::get('sizes','App\Http\Controllers\ProductController@sizes_index');
Route::get('styles','App\Http\Controllers\ProductController@styles_index');
Route::get('manufacturers','App\Http\Controllers\ProductController@manufacturers_index');
Route::get('surfaces','App\Http\Controllers\ProductController@surfaces_index');
Route::get('productions','App\Http\Controllers\ProductController@productions_index');
Route::get('types','App\Http\Controllers\ProductController@types_index');
Route::get('constructs','App\Http\Controllers\ProductController@constructs_index');

Route::get('product/{id}/reviews','App\Http\Controllers\ProductController@product_reviews');
Route::get('reviews','App\Http\Controllers\ProductController@all_reviews');
Route::post('product/{id}/add_review','App\Http\Controllers\ProductController@add_review');

Route::post('upload','App\Http\Controllers\UploadController@store');
Route::delete('upload','App\Http\Controllers\UploadController@delete');

Route::get('temp_files','App\Http\Controllers\UploadController@temp_files_index');
Route::get('temp_files/{id}/delete','App\Http\Controllers\UploadController@temp_files_delete');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});