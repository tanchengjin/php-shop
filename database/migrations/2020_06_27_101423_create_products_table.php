<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('set null');
            $table->string('title');
            #保存商品的最低价
            $table->decimal('price',10,2);
            $table->string('description');
            $table->unsignedBigInteger('sold_count')->default(0);
            $table->unsignedBigInteger('review_count')->default(0);
            $table->float('ratting')->default(5);
            $table->boolean('on_sale')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
