<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->integer('user_id');
            $table->integer('addr_id');
            $table->integer('coupon_id')->nullable();
            $table->float('discount')->default(0);
            $table->string('date');
            $table->string('type');
            $table->float('payment');
            $table->string('payment_type');
            $table->string('payment_token')->nullable();
            $table->boolean('payment_status')->default(0);
            $table->string('order_status')->default('Pending');

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
        Schema::dropIfExists('order');
    }
}
