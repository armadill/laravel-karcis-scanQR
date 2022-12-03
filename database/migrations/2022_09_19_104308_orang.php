<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis');
            $table->string('tanggal');
            $table->string('hari');
            $table->string('jam');
            $table->string('jumlah');
            $table->string('bayar');
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
        Schema::dropIfExists('orang');
    }
}
