<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    protected $fillable = ['date_borrow', 'user_id', 'books_id', 'date_return'];

    public function books()
    {
        return $this->belongsTo('App\Books');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
