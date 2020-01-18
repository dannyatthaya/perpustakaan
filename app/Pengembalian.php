<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';
    protected $fillable = ['user_id', 'buku_id', 'tanggalkembali', 'tanggaldikembalikan', 'terlambat', 'denda'];
}
