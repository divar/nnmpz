<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'all', 'namespace' => 'Modules\All\Http\Controllers'], function()
{
    Route::get('/', 'AllController@index');
    Route::get('cetaknota/{id}', 'TransaksiController@cetakNota')->name('cetakNota');
    
    Route::get('pelanggan/tambah', 'PelangganController@tambahPelanggan')->name('tambahPelanggan');
    Route::post('pelanggan/posttambah', 'PelangganController@store')->name('postTambahPelanggan');
    Route::get('pelanggan/load-data', 'PelangganController@loadData');
    Route::get('pelanggan', 'PelangganController@index')->name('loaddataPelanggan');
 
    Route::get('menu/delete/{id}', 'MenuController@destroy')->name('hapusmenu');
    Route::get('menu/edit/{id}', 'MenuController@edit')->name('editmenu');
    Route::post('menu/postedit', 'MenuController@update')->name('updatemenu');
    Route::get('menu/getsize', 'MenuController@getSize')->name('menugetsize');
    Route::get('menu/getById', 'MenuController@getById')->name('menuGetById');
    Route::get('Menu/popUpMenu', 'MenuController@popUpMenu')->name('popupmenu');
    Route::get('menu/tambah', 'MenuController@tambahMenu')->name('tambahMenu');
    Route::post('menu/posttambah', 'MenuController@store')->name('postTambahMenu');
    Route::get('menu/load-data', 'MenuController@loadData');
    Route::get('menu', 'MenuController@index')->name('loaddataMenu');

    Route::get('transaksi/edit/{id}', 'TransaksiController@edit')->name('editTransaksi');
    Route::post('transaksi/postedit', 'TransaksiController@update')->name('postEditTransaksi');
    Route::get('transaksi/tambah', 'TransaksiController@tambahTransaksi')->name('tambahTransaksi');
    Route::post('transaksi/posttambah', 'TransaksiController@store')->name('postTambahTransaksi');
    Route::get('transaksi/load-data', 'TransaksiController@loadData');
    Route::get('transaksi', 'TransaksiController@index')->name('loaddataTransaksi');

    Route::get('TarifWilayah/delete/{id}', 'TarifWilayahController@destroy')->name('hapusTarifWilayah');
    Route::get('TarifWilayah/edit/{id}', 'TarifWilayahController@edit')->name('editTarifWilayah');
    Route::post('TarifWilayah/postedit', 'TarifWilayahController@update')->name('updateTarifWilayah');
    Route::get('TarifWilayah/tambah', 'TarifWilayahController@tambahTarifWilayah')->name('tambahTarifWilayah');
    Route::post('TarifWilayah/posttambah', 'TarifWilayahController@store')->name('postTambahTarifWilayah');
    Route::get('TarifWilayah/load-data', 'TarifWilayahController@loadData');
    Route::get('TarifWilayah', 'TarifWilayahController@index')->name('loaddataTarifWilayah');

    Route::get('jalan/delete/{id}', 'JalanController@destroy')->name('hapusjalan');
    Route::get('jalan/edit/{id}', 'JalanController@edit')->name('editJalan');
    Route::get('jalan/create', 'JalanController@create')->name('tambahJalan');
    Route::get('jalan/load-data', 'JalanController@loadData')->name('jalanloadData');
    Route::get('jalan', 'JalanController@index')->name('jalan');
    Route::post('jalan/posttambah', 'JalanController@store')->name('createJalan');
    Route::post('jalan/postedit', 'JalanController@update')->name('updateJalan');
});
