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
            $table->float('suhu')->nullable();
            $table->float('tds')->nullable();
            $table->string('warna')->nullable();
            $table->float('tss')->nullable();
            $table->float('ph')->nullable();
            $table->float('bod')->nullable();
            $table->float('cod')->nullable();
            $table->float('do')->nullable();
            $table->float('phospat')->nullable();
            $table->float('nitrat')->nullable();
            $table->float('amonia')->nullable();
            $table->float('arsen')->nullable();
            $table->float('kobalt')->nullable();
            $table->float('boron')->nullable();
            $table->float('selenium')->nullable();
            $table->float('kadium')->nullable();
            $table->float('tembaga')->nullable();
            $table->float('timbal')->nullable();
            $table->float('merkuri')->nullable();
            $table->float('seng')->nullable();
            $table->float('sianida')->nullable();
            $table->float('flourida')->nullable();
            $table->float('khlorin')->nullable();
            $table->float('nitrit')->nullable();
            $table->float('belerang')->nullable();
            $table->float('klorida')->nullable();
            $table->float('minyak')->nullable();
            $table->float('sulfat')->nullable();
            $table->float('phenol')->nullable();
            $table->float('deterjen')->nullable();
            $table->float('n_total')->nullable();
            $table->float('nikel')->nullable();
            $table->float('total_koliform')->nullable();
            $table->float('fecal_kolifom')->nullable();
            $table->float('ika')->nullable();
            $table->float('ipj')->nullable();
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
