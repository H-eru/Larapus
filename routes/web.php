<?php

use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('index');
});

Route::get('login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::get('register', function () {
    return view('register');
})->middleware('guest')->name('register');

Route::get('search', 'HomeController@search');
Route::post('search', 'HomeController@find');
Route::get('show', 'HomeController@show');
Route::get('list', 'HomeController@list');

// Authentication & registration
Route::post('register', 'AuthController@register');
Route::post('authenticate', 'AuthController@authenticate');
Route::get('logout', 'AuthController@logout');

// Admin Dashboard
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Admin\DashboardAdminController@index');

    Route::put('user/pass/{id}', 'Admin\UserManagementController@pass');
    Route::resources([
        'rak' => 'Admin\RakManagementController',
        'book' => 'Admin\BookController',
        'user' => 'Admin\UserManagementController'
    ]);
});

// Karyawan Dashboard
Route::group(['prefix' => 'karyawan', 'middleware' => ['auth', 'karyawan']], function () {
    Route::get('/', 'Karyawan\DashboardKaryawanController@index');

    Route::post('pinjam/{id}/addCart', 'Karyawan\CartController@addCart');
    Route::resources([
        'user' => 'Karyawan\AnggotaController',
        'pinjam' => 'Karyawan\CartController',
    ]);

    // Route::group(['prefix' => 'user'], function () {
    //     Route::get('/', 'Karyawan\AnggotaController@index');
    //     Route::get('/create', 'Karyawan\AnggotaController@create');
    //     Route::post('/store', 'Karyawan\AnggotaController@store');
    //     Route::get('/{id}/edit', 'Karyawan\AnggotaController@edit');
    //     Route::put('/update/{id}', 'Karyawan\AnggotaController@update');
    //     Route::put('/pass/{id}', 'Karyawan\AnggotaController@pass');
    //     Route::delete('/{id}', 'Karyawan\AnggotaController@destroy');
    // });
});
