<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tabelvis extends Model
{
    public $timestamps = true;
    protected $table = 'tabelvis';

    protected $fillable = ['tanggal', 'hari','jam','kode','jenis','wisatawan','jumlah','total'];
}
