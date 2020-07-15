<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentSupportImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_support_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('description',255)->nullable();
            $table->boolean('enable')->default(1);
            $table->unsignedBigInteger('weight')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_support_images');
    }
}
