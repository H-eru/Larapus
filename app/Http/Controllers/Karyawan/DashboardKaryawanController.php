<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardKaryawanController extends Controller
{
    public function index()
    {
        return view('karyawan/index');
        // $date = Carbon::now();
        // $daysToAdd = 11;
        // $date->addDays($daysToAdd);
        // return $date->toDateString();
    }
}
