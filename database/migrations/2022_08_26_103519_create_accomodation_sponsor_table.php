<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccomodationSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accomodation_sponsor', function (Blueprint $table) {
            $table->unsignedBigInteger('accomodation_id');
            $table->foreign('accomodation_id')
                ->references('id')
                ->on('accomodations');

            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')
                ->references('id')
                ->on('sponsors');

            $table->primary(['accomodation_id', 'sponsor_id']); 

            $table->dateTime('start_time');
            $table->dateTime('end_time');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accomodation_sponsor');
    }
}
