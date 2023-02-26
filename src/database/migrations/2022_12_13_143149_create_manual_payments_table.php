<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_payments', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('gateway_name');
            $table->decimal('minimum_amount',16,4)->nullable();
            $table->decimal('maximum_amount',16,4)->nullable();
            $table->decimal('fixed_charge',16,4)->nullable();
            $table->decimal('percent_charge',16,4)->nullable();
            $table->longText('instruction')->nullable();
            $table->json('info')->nullable();
            $table->enum('status',['DeActive','Active'])->default('Active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('manual_payments');
    }
}
