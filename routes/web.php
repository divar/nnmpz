<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web','auth'], 'prefix' => 'administrasi'], function()
{
    Route::get('alamat/getKecamatan', 'DaerahController@getKecamatan')->name('getKecamatan');
    Route::get('alamat/getKelurahan', 'DaerahController@getKelurahan')->name('getKelurahan');
    Route::get('menu/getkategorimenu', 'KategoriController@getKategoriMenu')->name('getKategoriMenu');
    Route::get('menu/getkategoriAddon', 'KategoriController@getKategoriAddon')->name('getKategoriaddon');

    Route::get('kategori', 'KategoriController@index')->name('kategori');
    Route::get('kategori/delete/{id}', 'KategoriController@destroy')->name('hapusKategori');
    Route::get('kategori/tambah', 'KategoriController@create')->name('tambahKategori');
    Route::post('kategori/posttambah', 'KategoriController@store')->name('postTambahKategori');
    Route::get('kategori/edit/{id}', 'KategoriController@edit')->name('editkategori');
    Route::post('kategori/postedit', 'KategoriController@update')->name('updatekategori');
    Route::get('kategori/load-data', 'KategoriController@loadData')->name('loadDataKategori');
});