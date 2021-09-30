<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ColorProductTable extends Migration
{
    public function up()
    {
        Schema::create('color_product', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('color_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('color_product');
    }
}
