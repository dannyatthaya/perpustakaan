<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $fillable = ['user_id', 'books_id', 'date_return', 'date_returning', 'due', 'fine'];

    public function books()
    {
        return $this->belongsTo('App\Books');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
