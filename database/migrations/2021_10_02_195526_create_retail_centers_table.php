<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetailCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retail_centers', function (Blueprint $table) {
            $table->id('uniqueID')->unique();
            $table->string('type');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('shipped_items', function (Blueprint $table) {
            $table->id('itemNumber');
            $table->integer('weight');
            $table->string('dimensions');
            $table->integer('insuranceAmount');
            $table->string('destination');
            $table->date('finalDeliveryDate');
            $table->unsignedBigInteger('uniqueID')->nullable();
            $table->timestamps();

            $table->foreign('uniqueID')->references('uniqueID')->on('retail_centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retail_centers');
    }
}
