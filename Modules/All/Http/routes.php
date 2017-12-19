<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'all', 'namespace' => 'Modules\All\Http\Controllers'], function()
{
    Route::get('/', 'AllController@index');
    Route::get('pelanggan', 'PelangganController@index');
    Route::get('pelanggan/load-data', 'PelangganController@loadData')->name('loaddata');
});
