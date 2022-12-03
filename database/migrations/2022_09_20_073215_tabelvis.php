<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tabelvis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabelvis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tanggal');
            $table->string('hari');
            $table->string('jam');
            $table->string('kode');
            $table->string('jenis');
            $table->string('wisatawan');
            $table->string('jumlah');
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
        Schema::dropIfExists('tabelvis');
    }
}
