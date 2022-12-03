<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karcis extends Model
{
    public $timestamps = true;
    protected $table = 'karcis';

    protected $fillable = ['jenis', 'harga'];
}
