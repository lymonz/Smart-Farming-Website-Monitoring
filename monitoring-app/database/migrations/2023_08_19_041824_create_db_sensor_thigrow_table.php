<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_sensor_thigrow', function (Blueprint $table) {
            $table->id();
            $table->string('device_token');
            $table->integer('kelembaban_tanah_th');
            $table->integer('kelembaban_tanah_sm');
            $table->integer('kelembaban_udara');
            $table->float('i_cahaya');
            $table->float('battery');
            $table->float('temperature');
            $table->string('kadar_garam');
            $table->timestamps();

            $table->foreign('device_token')->references('token')->on('db_device')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db_sensor_thigrow');
    }
};
