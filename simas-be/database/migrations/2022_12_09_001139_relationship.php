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
        Schema::table('kualitas_airs', function (Blueprint $table) {
            $table->foreign('titik_pantau_id')->references('id')->on('titik_pantaus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('waktu_sampling_id')->references('id')->on('waktu_samplings')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('kuantitas_airs', function (Blueprint $table) {
            $table->foreign('titik_pantau_id')->references('id')->on('titik_pantaus')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('foto_titik_pantaus', function (Blueprint $table) {
            $table->foreign('titik_pantau_id')->references('id')->on('titik_pantaus')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
