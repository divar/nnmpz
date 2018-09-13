<?php

Route::group(['middleware' => ['web'], 'prefix' => 'nota', 'namespace' => 'Modules\All\Http\Controllers'], function(){
    Route::get('cetaknota/{id}', 'TransaksiController@cetakNota')->name('cetakNota');

});
Route::group(['middleware' => ['web','auth'], 'prefix' => 'all', 'namespace' => 'Modules\All\Http\Controllers'], function()
{
    Route::get('/', 'AllController@index');
    
    Route::get('pelanggan/tambah', 'PelangganController@tambahPelanggan')->name('tambahPelanggan');
    Route::post('pelanggan/posttambah', 'PelangganController@store')->name('postTambahPelanggan');
    Route::get('pelanggan/load-data', 'PelangganController@loadData');
    Route::get('pelanggan', 'PelangganController@index')->name('loaddataPelanggan');
    Route::get('pelanggan/alamat/tambah/{id}', 'PelangganController@createAlamat')->name('tambahAlamat');
    Route::post('pelanggan/alamat/posttambah', 'PelangganController@storeAlamat')->name('postTambahAlamat');
 
    Route::get('menu/delete/{id}', 'MenuController@destroy')->name('hapusmenu');
    Route::get('menu/edit/{id}', 'MenuController@edit')->name('editmenu');
    Route::post('menu/postedit', 'MenuController@update')->name('updatemenu');
    Route::get('menu/getsize', 'MenuController@getSize')->name('menugetsize');
    Route::get('menu/getkategori', 'MenuController@getKategori')->name('menugetkategori');
    Route::get('menu/getById', 'MenuController@getById')->name('menuGetById');
    Route::get('Menu/popUpMenu', 'MenuController@popUpMenu')->name('popupmenu');
    Route::get('menu/tambah', 'MenuController@tambahMenu')->name('tambahMenu');
    Route::post('menu/posttambah', 'MenuController@store')->name('postTambahMenu');
    Route::get('menu/load-data', 'MenuController@loadData');
    Route::get('menu', 'MenuController@index')->name('loaddataMenu');

    Route::get('transaksi/delete/{id}', 'TransaksiController@destroy')->name('hapusTransaksi');
    Route::get('transaksi/edit/{id}', 'TransaksiController@edit')->name('editTransaksi');
    Route::post('transaksi/postedit', 'TransaksiController@update')->name('postEditTransaksi');
    Route::get('transaksi/tambah', 'TransaksiController@tambahTransaksi')->name('tambahTransaksi');
    Route::get('transaksi/create-from/{id}', 'TransaksiController@create')->name('tambahTransaksiDari');
    Route::post('transaksi/posttambah', 'TransaksiController@store')->name('postTambahTransaksi');
    Route::get('transaksi/load-data', 'TransaksiController@loadData');
    Route::get('transaksi/load-data-laporan', 'TransaksiController@loadDataLaporan');
    Route::get('transaksi', 'TransaksiController@index')->name('loaddataTransaksi');
    Route::get('transaksi/laporan', 'TransaksiController@index2')->name('loaddataTransaksi-laporan');
    Route::get('transaksi/load-alamat', 'PelangganController@loadAlamat')->name('loadAlamat');

    Route::get('TarifWilayah/delete/{id}', 'TarifWilayahController@destroy')->name('hapusTarifWilayah');
    Route::get('TarifWilayah/edit/{id}', 'TarifWilayahController@edit')->name('editTarifWilayah');
    Route::post('TarifWilayah/postedit', 'TarifWilayahController@update')->name('updateTarifWilayah');
    Route::get('TarifWilayah/tambah', 'TarifWilayahController@tambahTarifWilayah')->name('tambahTarifWilayah');
    Route::post('TarifWilayah/posttambah', 'TarifWilayahController@store')->name('postTambahTarifWilayah');
    Route::get('TarifWilayah/load-data', 'TarifWilayahController@loadData');
    Route::get('TarifWilayah', 'TarifWilayahController@index')->name('loaddataTarifWilayah');

    Route::get('jalan/popUpJalan', 'JalanController@popUpJalan')->name('popupjalan');
    Route::get('jalan/getById', 'JalanController@getById')->name('jalanGetById');
    Route::get('jalan/delete/{id}', 'JalanController@destroy')->name('hapusjalan');
    Route::get('jalan/edit/{id}', 'JalanController@edit')->name('editJalan');
    Route::get('jalan/create', 'JalanController@create')->name('tambahJalan');
    Route::get('jalan/load-data', 'JalanController@loadData')->name('jalanloadData');
    Route::get('jalan', 'JalanController@index')->name('jalan');
    Route::post('jalan/posttambah', 'JalanController@store')->name('createJalan');
    Route::post('jalan/postedit', 'JalanController@update')->name('updateJalan');

    Route::get('addon/delete/{id}', 'AddOnController@destroy')->name('hapusaddon');
    Route::get('addon/edit/{id}', 'AddOnController@edit')->name('editaddon');
    Route::post('addon/postedit', 'AddOnController@update')->name('updateaddon');
    Route::get('addon/getById', 'AddOnController@getById')->name('addonGetById');
    Route::get('addon/popUpaddon', 'AddOnController@popUpAddon')->name('popupaddon');
    Route::post('addon/posttambah', 'AddOnController@store')->name('posttambahaddon');
    Route::get('addon/load-data', 'AddOnController@loadData');
    Route::get('addon/create', 'AddOnController@create')->name('tambahaddon');
    Route::get('addon', 'AddOnController@index')->name('addon');

    Route::get('Size/delete/{id}', 'SizeController@destroy')->name('hapusSize');
    Route::get('Size/edit/{id}', 'SizeController@edit')->name('editSize');
    Route::post('Size/postedit', 'SizeController@update')->name('updateSize');
    Route::get('Size/tambah', 'SizeController@create')->name('tambahSize');
    Route::post('Size/posttambah', 'SizeController@store')->name('postTambahSize');
    Route::get('Size/load-data', 'SizeController@loadData')->name('lodadatasize');
    Route::get('Size', 'SizeController@index')->name('loaddataSize');

    Route::get('Satuan/delete/{id}', 'SatuanController@destroy')->name('hapusSatuan');
    Route::get('Satuan/edit/{id}', 'SatuanController@edit')->name('editSatuan');
    Route::post('Satuan/postedit', 'SatuanController@update')->name('updateSatuan');
    Route::get('Satuan/tambah', 'SatuanController@create')->name('tambahSatuan');
    Route::post('Satuan/posttambah', 'SatuanController@store')->name('postTambahSatuan');
    Route::get('Satuan/load-data', 'SatuanController@loadData')->name('loadsatuan');
    Route::get('Satuan', 'SatuanController@index')->name('satuan');

    Route::get('JenisMakanan/delete/{id}', 'JenisMakananController@destroy')->name('hapusJenisMakanan');
    Route::get('JenisMakanan/edit/{id}', 'JenisMakananController@edit')->name('editJenisMakanan');
    Route::post('JenisMakanan/postedit', 'JenisMakananController@update')->name('updateJenisMakanan');
    Route::get('JenisMakanan/tambah', 'JenisMakananController@create')->name('tambahJenisMakanan');
    Route::post('JenisMakanan/posttambah', 'JenisMakananController@store')->name('postTambahJenisMakanan');
    Route::get('JenisMakanan/load-data', 'JenisMakananController@loadData')->name('lodadataJenisMakanan');
    Route::get('JenisMakanan', 'JenisMakananController@index')->name('indexJenisMakanan');

    Route::get('kurir/delete/{id}', 'KurirController@destroy')->name('hapusKurir');
    Route::get('kurir/edit/{id}', 'KurirController@edit')->name('editKurir');
    Route::post('kurir/postedit', 'KurirController@update')->name('updateKurir');
    Route::get('kurir/tambah', 'KurirController@create')->name('tambahKurir');
    Route::post('kurir/posttambah', 'KurirController@store')->name('postTambahKurir');
    Route::get('kurir/load-data', 'KurirController@loadData')->name('lodadataKurir');
    Route::get('kurir', 'KurirController@index')->name('indexKurir');

});
