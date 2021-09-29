<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('products','App\Http\Controllers\ProductController@index');
Route::post('products','App\Http\Controllers\ProductController@store');

Route::post('upload','App\Http\Controllers\UploadController@store');
Route::delete('upload','App\Http\Controllers\UploadController@delete');

Route::get('temp_files','App\Http\Controllers\UploadController@temp_files_index');
Route::get('temp_files/{id}/delete','App\Http\Controllers\UploadController@temp_files_delete');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});