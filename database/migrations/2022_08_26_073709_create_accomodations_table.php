<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accomodations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('set null');

            $table->string('title');
            $table->string('picture');
            $table->unsignedTinyInteger('number_of_rooms');
            $table->unsignedTinyInteger('number_of_beds');
            $table->unsignedTinyInteger('number_of_bathrooms');
            $table->unsignedSmallInteger('square_meters')->nullable();
            $table->unsignedSmallInteger('price_per_night');
            $table->boolean('visible');
            $table->string('address');
            $table->decimal('lat', 7,5);
            $table->decimal('lon', 8,5);
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

        Schema::dropIfExists('accomodations'); 
        
        
        
    }
}
