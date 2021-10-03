<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->decimal('base_price')->default('0');
            $table->decimal('old_price')->nullable();
            $table->boolean('hit')->nullable();
            $table->boolean('discount')->nullable();
            $table->boolean('sale')->nullable();
            $table->boolean('special')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
