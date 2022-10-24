<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id('driver_id');
            $table->unsignedBigInteger('nik_karyawan')->nullable();
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->string('no_polisi', 9);
            $table->string('qr_code', 30)->nullable();
            $table->boolean('pengendara');
            $table->string('jenis_kendaraan', 11);
            $table->timestamps();

            $table->foreign('nik_karyawan')->references('nik_karyawan')->on('employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('guest_id')->references('guest_id')->on('guests')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
