<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orang extends Model
{
    public $timestamps = true;
    protected $table = 'orang';

    protected $fillable = ['jenis', 'tanggal', 'hari', 'jam', 'jumlah','bayar'];
}
