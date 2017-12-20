<?php

namespace App\Http\Controllers;
use Indonesia;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    public function getKecamatan(){
    	$id_kabupaten = \Request::input('id_kabupaten');
    	$kecamatan=Indonesia::findCity($id_kabupaten, $with = ['districts'])->toArray();
    	return $kecamatan;
    }
    public function getKelurahan(){
    	$id_kecamatan = \Request::input('id_kecamatan');
    	$kelurahan=Indonesia::findDistrict($id_kecamatan, $with = ['villages'])->toArray();
    	return $kelurahan;
    }
}
