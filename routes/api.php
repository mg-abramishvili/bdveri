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

Route::post('upload','App\Http\Controllers\UploadController@store');
Route::delete('upload','App\Http\Controllers\UploadController@delete');

Route::get('temp_files','App\Http\Controllers\UploadController@temp_files_index');
Route::get('temp_files/{id}/delete','App\Http\Controllers\UploadController@temp_files_delete');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});