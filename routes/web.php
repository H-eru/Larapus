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

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'Admin\UserManagementController@index');
        Route::get('/create', 'Admin\UserManagementController@create');
        Route::post('/store', 'Admin\UserManagementController@store');
        Route::get('/{id}/edit', 'Admin\UserManagementController@edit');
        Route::put('/update/{id}', 'Admin\UserManagementController@update');
        Route::put('/pass/{id}', 'Admin\UserManagementController@pass');
        Route::delete('/{id}', 'Admin\UserManagementController@destroy');
        Route::post('/search', 'Admin\UserManagementController@search');
        Route::get('/{id}/show', 'Admin\UserManagementController@show');
    });

    // Route::get('/book/search', 'Admin\BookController@search');
    Route::resources([
        'rak' => 'Admin\RakManagementController',
        'book' => 'Admin\BookController'
    ]);
});

// Karyawan Dashboard
Route::group(['prefix' => 'karyawan', 'middleware' => ['auth', 'karyawan']], function () {
    Route::get('/', 'Karyawan\DashboardKaryawanController@index');

    Route::resources([
        'user' => 'Karyawan\AnggotaController',
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
