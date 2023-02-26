<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->json('mail_footer')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('copy_right_text')->default('@2022');
            $table->integer('pagination_number')->default(0);
            $table->string('count_by')->default('ip');
            $table->string('email');
            $table->string('demo_mode')->default('DeActive');
            $table->string('accept_cookie')->default('DeActive');
            $table->string('maintenance_mood')->default('DeActive');
            $table->json('currency_setup')->nullable();
            $table->text('frontend_loader')->nullable();
            $table->text('address')->nullable();
            $table->json('recaptcha')->nullable();
            $table->longText('social_media')->nullable();
            $table->json('social_login')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
