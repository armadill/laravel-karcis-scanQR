<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodeqris extends Model
{
    public $timestamps = true;
    protected $table = 'kodeqris';

    protected $fillable = ['jenis', 'kode', 'tanggalb', 'jamb', 'status','tanggals','jams','bys','noseri'];
}
