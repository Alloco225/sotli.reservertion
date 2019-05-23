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
                $table->unsignedBigInteger('depart');
                $table->unsignedBigInteger('destination');
                $table->integer('tarif');
                $table->time('duree')->nullable();
                $table->timestamps();

                $table->index('depart');
                $table->index('destination');
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
