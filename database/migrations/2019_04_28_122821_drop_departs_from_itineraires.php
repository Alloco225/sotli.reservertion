<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDepartsFromItineraires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itineraires', function (Blueprint $table) {
            //
            $table->dropColumn('depart_1');
            $table->dropColumn('depart_2');
            $table->dropColumn('depart_3');
            $table->dropColumn('depart_dernier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itineraires', function (Blueprint $table) {
            $table->time('depart_1')->default('06:00:00');
            $table->time('depart_2')->nullable();
            $table->time('depart_3')->nullable();
            $table->time('depart_dernier')->nullable()->default('20:00:00');
        });
    }
}
