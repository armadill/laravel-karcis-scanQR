<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mqrcode extends Model
{
    public $timestamps = true;
    protected $table = 'qrcode';

    protected $fillable = ['tanggal', 'jam', 'hari', 'kode', 'total','nama'];
}
