<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyageVoyageursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('voyage_voyageurs')){
            Schema::create('voyage_voyageurs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('voyage_id');
                $table->foreign('voyage_id')->references('id')->on('voyages');
                $table->unsignedBigInteger('voyageur_id');
                $table->foreign('voyageur_id')->references('id')->on('users');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voyage_voyageurs');
    }
}
