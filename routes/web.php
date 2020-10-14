<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin\DashboardAdminController@index');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'Admin\UserManagementController@index');
        Route::get('/create', 'Admin\UserManagementController@create');
        Route::post('/store', 'Admin\UserManagementController@store');
        Route::get('/{id}/edit', 'Admin\UserManagementController@edit');
        Route::put('/update/{id}', 'Admin\UserManagementController@update');
        Route::put('/pass/{id}', 'Admin\UserManagementController@pass');
        Route::delete('/{id}', 'Admin\UserManagementController@destroy');
    });
});

Route::group(['prefix' => 'karyawan'], function () {
    Route::get('/', 'Karyawan\DashboardKaryawanController@index');

    Route::group(['prefix' => 'rak'], function () {
        Route::get('/', 'Karyawan\RakManagementController@index');
        Route::get('/create', 'Karyawan\RakManagementController@create');
        Route::post('/store', 'Karyawan\RakManagementController@store');
        Route::get('/{id}/edit', 'Karyawan\RakManagementController@edit');
        Route::put('/update/{id}', 'Karyawan\RakManagementController@update');
        Route::put('/pass/{id}', 'Karyawan\RakManagementController@pass');
        Route::delete('/{id}', 'Karyawan\RakManagementController@destroy');
    });
});
