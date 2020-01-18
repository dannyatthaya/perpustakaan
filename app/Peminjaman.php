<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = ['tanggalpinjam', 'user_id', 'buku_id', 'tanggalkembali'];
}
