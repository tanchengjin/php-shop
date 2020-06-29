<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->json('address');
            $table->string('remark')->default('');
            $table->decimal('total_price',11,2);

            $table->string('payment_method')->nullable();
            $table->string('payment_no')->nullable();
            $table->dateTime('paid_at')->nullable();

            $table->string('refund_status')->default(\App\Models\Order::REFUND_STATUS_PENDING);
            $table->string('refund_no')->unique()->nullable();

            $table->string('ship_status')->default(\App\Models\Order::SHIP_STATUS_PENDING);
            $table->json('ship_data')->nullable();

            $table->boolean('closed')->default(0);
            $table->boolean('reviewed')->default(0);

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
        Schema::dropIfExists('orders');
    }
}
