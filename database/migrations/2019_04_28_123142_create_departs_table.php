<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('departs')){
            Schema::create('departs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->time('heure');

                $table->unsignedBigInteger('itineraire_id');
                $table->foreign('itineraire_id')->references('id')->on('itineraires')->onDelete('cascade');
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
        Schema::dropIfExists('departs');
    }
}
