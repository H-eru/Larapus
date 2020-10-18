<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $fillable = ['kode_rak', 'nama_rak'];

    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
