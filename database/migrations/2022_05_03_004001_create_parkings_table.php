<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->string('kode_parkir');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('blok_id');
            $table->unsignedBigInteger('fault_id')->nullable();
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->string('petugas_out')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('driver_id')->references('driver_id')->on('drivers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('blok_id')->references('blok_id')->on('bloks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('fault_id')->references('fault_id')->on('faults')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkings');
    }
}
