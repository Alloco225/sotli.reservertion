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
                $table->timestamps();
                $table->integer('places')->default(40);
                // also gotta add de car plate number but gonna do that later

                $table->index('itineraire_id');
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
