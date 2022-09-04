<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_setting', function (Blueprint $table) {
            $table->id();
            $table->boolean('verify_user')->default(1);
            $table->boolean('verify_user_mail')->default(1);
            $table->boolean('verify_user_sms')->default(1);
            $table->boolean('enable_notification')->default(1);
            $table->boolean('enable_mail')->default(1);
            $table->boolean('enable_sms')->default(1);
            $table->string('cloth_unit')->default('KG');
            $table->string('app_name')->nullable();
            $table->string('app_version')->nullable();
            $table->string('bg_img')->nullable();
            $table->string('color')->nullable();
            $table->string('no_data')->nullable();
            $table->string('device_token')->nullable();
            $table->string('white_logo')->nullable();
            $table->string('black_logo')->nullable();
            $table->string('color_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('splash_screen')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('mapkey')->nullable();
            $table->text('terms_of_use')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->text('app_id')->nullable();
            $table->text('api_key')->nullable();
            $table->text('auth_key')->nullable();
            $table->text('project_no')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('sender_email')->nullable();
            $table->string('twilio_acc_id')->nullable();
            $table->string('twilio_phone_no')->nullable();
            $table->string('twilio_auth_token')->nullable();
            $table->text('license_code')->nullable();
            $table->string('license_client_name')->nullable();
            $table->boolean('license_status')->default(0);

            $table->text('addr1')->nullable();
            $table->text('addr2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();

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
        Schema::dropIfExists('app_setting');
    }
}
