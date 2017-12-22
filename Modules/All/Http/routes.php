<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'all', 'namespace' => 'Modules\All\Http\Controllers'], function()
{
    Route::get('/', 'AllController@index');
    Route::get('pelanggan/tambah', 'PelangganController@tambahPelanggan')->name('tambahPelanggan');
    Route::post('pelanggan/posttambah', 'PelangganController@store')->name('postTambahPelanggan');
    Route::get('pelanggan/load-data', 'PelangganController@loadData');
    Route::get('pelanggan', 'PelangganController@index')->name('loaddataPelanggan');

    Route::get('menu/getsize', 'MenuController@getSize')->name('menugetsize');
    Route::get('menu/getById', 'MenuController@getById')->name('menuGetById');
    Route::get('Menu/popUpMenu', 'MenuController@popUpMenu')->name('popupmenu');
    Route::get('menu/tambah', 'MenuController@tambahMenu')->name('tambahMenu');
    Route::post('menu/posttambah', 'MenuController@store')->name('postTambahMenu');
    Route::get('menu/load-data', 'MenuController@loadData');
    Route::get('menu', 'MenuController@index')->name('loaddataMenu');

    Route::get('transaksi/tambah', 'TransaksiController@tambahTransaksi')->name('tambahTransaksi');
    Route::post('transaksi/posttambah', 'TransaksiController@store')->name('postTambahTransaksi');
    Route::get('transaksi/load-data', 'TransaksiController@loadData');
    Route::get('transaksi', 'TransaksiController@index')->name('loaddataTransaksi');
});
