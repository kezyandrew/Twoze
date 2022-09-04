<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_setting', function (Blueprint $table) {
            $table->id();
            $table->boolean('cod')->default(1);
            $table->boolean('paypal')->default(0);
            $table->boolean('razorpay')->default(0);
            $table->boolean('stripe')->default(0);
            $table->boolean('paystack')->default(0);
            $table->text('paypal_sandbox_key')->nullable();
            $table->text('paypal_production_key')->nullable();
            $table->text('stripe_public_key')->nullable();
            $table->text('stripe_secret_key')->nullable();
            $table->text('razorpay_public_key')->nullable();
            $table->text('razorpay_secret_key')->nullable();
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
        Schema::dropIfExists('payment_setting');
    }
}
