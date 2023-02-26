<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_service_id')->nullable();
            $table->string('minute')->nullable();
            $table->string('mb')->nullable();
            $table->string('sms')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('price', 16, 2)->nullable();
            $table->decimal('discount_price', 16, 2)->nullable();
            $table->longText('details')->nullable();
            $table->string('status')->default('Active');
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
        Schema::dropIfExists('package_lists');
    }
}
