<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Qrcode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qrcode', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('tanggal');
            $table->string('jam');
            $table->string('hari');
            $table->string('kode');
            $table->string('total');
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
        Schema::dropIfExists('qrcode');
    }
}
