<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $fillable = ['user_id', 'book_id', 'date_return', 'date_returning', 'due', 'fine'];
}
