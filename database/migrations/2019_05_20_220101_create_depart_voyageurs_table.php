<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartVoyageursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depart_voyageurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('depart_id');
            $table->unsignedBigInteger('voyageur_id');
            $table->date('date');
            $table->integer('places');
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
        Schema::dropIfExists('depart_voyageurs');
    }
}
