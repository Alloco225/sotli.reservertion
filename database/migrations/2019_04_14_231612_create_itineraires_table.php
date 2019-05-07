<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItinerairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('itineraires')){
            Schema::create('itineraires', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('ville_depart');
                $table->foreign('ville_depart')->references('id')->on('villes')->onDelete('cascade');
                $table->unsignedBigInteger('ville_arrivee');
                $table->foreign('ville_arrivee')->references('id')->on('villes')->onDelete('cascade');
                $table->integer('prix')->default(1500);
                $table->time('depart_1')->default('06:00:00');
                $table->time('depart_2')->nullable();
                $table->time('depart_3')->nullable();
                $table->time('depart_dernier')->nullable()->default('20:00:00');
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
        Schema::dropIfExists('itineraires');
    }
}
