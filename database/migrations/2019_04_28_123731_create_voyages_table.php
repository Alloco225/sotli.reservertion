<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('voyages')){
            Schema::create('voyages', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->date('date');
                $table->integer('places')->default(40);
                // also gotta add de car plate number but gonna do that later
    
                $table->unsignedBigInteger('depart_id')->nullable();
                $table->foreign('depart_id')->references('id')->on('departs')->onDelete('set null');
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
        Schema::dropIfExists('voyages');
    }
}
