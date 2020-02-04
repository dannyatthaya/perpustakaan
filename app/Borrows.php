<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    protected $fillable = ['date_borrow', 'user_id', 'book_id', 'date_return'];
}
