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
        Schema::create('db_sensor_bmp180', function (Blueprint $table) {
            $table->id();
            $table->string('device_token');
            $table->double('tekanan_udara');
            $table->double('tinggi_permukaan');
            $table->float('battery');
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
        Schema::dropIfExists('db_sensor_bmp180');
    }
};
