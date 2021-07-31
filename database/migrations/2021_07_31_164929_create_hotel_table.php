<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel', function (Blueprint $table) {
            $table->id();
            $table->string('county');
            $table->string('country');
            $table->string('town');
            $table->text('description');
            $table->string('displayable_address');
            $table->string('image');
            $table->string('thumbnail')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->integer('number_of_bedrooms');
            $table->integer('number_of_bathrooms');
            $table->float('price');
            $table->string('property_type');
            $table->integer('rent_or_sale');
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
        Schema::dropIfExists('hotel');
    }
}
