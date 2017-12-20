<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'all', 'namespace' => 'Modules\All\Http\Controllers'], function()
{
    Route::get('/', 'AllController@index');
    Route::get('pelanggan/tambah', 'PelangganController@tambahPelanggan')->name('tambahPelanggan');
    Route::post('pelanggan/posttambah', 'PelangganController@store')->name('postTambahPelanggan');
    Route::get('pelanggan/load-data', 'PelangganController@loadData')->name('loaddataPelanggan');
    Route::get('pelanggan', 'PelangganController@index');

    Route::get('menu/tambah', 'MenuController@tambahMenu')->name('tambahMenu');
    Route::post('menu/posttambah', 'MenuController@store')->name('postTambahMenu');
    Route::get('menu/load-data', 'MenuController@loadData')->name('loaddataMenu');
    Route::get('menu', 'MenuController@index');
});
