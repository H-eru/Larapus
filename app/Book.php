<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'tahun', 'sinopsis', 'cover', 'rak_id'];

    public function post()
    {
        return $this->belongsTo('App\Rak');
    }
}
