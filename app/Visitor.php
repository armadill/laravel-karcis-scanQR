<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $timestamps = true;
    protected $table = 'visitor';
    protected $fillable = ['tanggal', 'hari','jam','jenis','harga'];
}
