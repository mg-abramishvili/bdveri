<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductReviewTable extends Migration
{
    public function up()
    {
        Schema::create('product_review', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('review_id');
        });
    }

    public function down()
    {
        //
    }
}
