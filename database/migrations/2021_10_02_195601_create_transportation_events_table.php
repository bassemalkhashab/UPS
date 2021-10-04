<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportationEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportation_events', function (Blueprint $table) {
            $table->id('scheduleNumber');
            $table->string('type');
            $table->string('deliveryRoute');
            $table->timestamps();
        });
        
        Schema::create('shippings', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('itemNumber')->nullable();
            $table->unsignedBigInteger('scheduleNumber')->nullable();
            $table->timestamps();

            $table->unique(['itemNumber', 'scheduleNumber']);

            $table->foreign('itemNumber')->references('itemNumber')->on('shipped_items');
            $table->foreign('scheduleNumber')->references('scheduleNumber')->on('transportation_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transportation_events');
    }
}
