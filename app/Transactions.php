<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'users_id_anggota', 'books_id', 'durations', 'start_date', 'deadline', 'date_returned', 'status', 'penalty', 'operator', 'type'
    ];
}
