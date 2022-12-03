<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kodeqris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kodeqris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis');
            $table->string('kode');
            $table->string('tanggalb');
            $table->string('jamb');
            $table->string('status');
            $table->string('tanggals')->nullable();
            $table->string('jams')->nullable();
            $table->string('bys')->nullable();
            $table->string('noseri')->nullable();

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
        Schema::dropIfExists('kodeqris');
    }
}
