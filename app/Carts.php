<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $fillable = [
        'users_id', 'books_id', 'durations', 'operator', 'type'
    ];

    protected $attributes = [
        'users_id' => '',
    ];
}
