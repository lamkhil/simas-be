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
        Schema::create('kualitas_airs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('titik_pantau_id');
            $table->foreignId('user_id');
            $table->foreignId('waktu_sampling_id');
            $table->double('suhu')->nullable();
            $table->double('tds')->nullable();
            $table->double('warna')->nullable();
            $table->double('tss')->nullable();
            $table->double('ph')->nullable();
            $table->double('bod')->nullable();
            $table->double('cod')->nullable();
            $table->double('do')->nullable();
            $table->double('phospat')->nullable();
            $table->double('nitrat')->nullable();
            $table->double('amonia')->nullable();
            $table->double('arsen')->nullable();
            $table->double('kobalt')->nullable();
            $table->double('boron')->nullable();
            $table->double('selenium')->nullable();
            $table->double('kadium')->nullable();
            $table->double('tembaga')->nullable();
            $table->double('timbal')->nullable();
            $table->double('merkuri')->nullable();
            $table->double('seng')->nullable();
            $table->double('sianida')->nullable();
            $table->double('flourida')->nullable();
            $table->double('khlorin')->nullable();
            $table->double('nitrit')->nullable();
            $table->double('belerang')->nullable();
            $table->double('klorida')->nullable();
            $table->double('minyak')->nullable();
            $table->double('sulfat')->nullable();
            $table->double('phenol')->nullable();
            $table->double('deterjen')->nullable();
            $table->double('n_total')->nullable();
            $table->double('nikel')->nullable();
            $table->double('total_koliform')->nullable();
            $table->double('fecal_kolifom')->nullable();
            $table->double('ika')->nullable();
            $table->double('ipj')->nullable();
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
        Schema::dropIfExists('kualitas_airs');
    }
};
