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
        Schema::create('kuantitas_air_realtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('titik_pantau_id');
            $table->double('ketinggian');
            $table->double('kecepatan');
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
        Schema::dropIfExists('kuantitas_air_realtimes');
    }
};
