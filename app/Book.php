<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'tahun', 'sinopsis', 'cover', 'rak_id', 'penerbit', 'genre', 'stok', 'stok_now'];

    public function raks()
    {
        return $this->belongsTo('App\Rak', 'rak_id');
    }
}
