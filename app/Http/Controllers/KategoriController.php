<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\All\Entities\Kategori;

class KategoriController extends Controller
{
    public function getKategoriMenu(){
    	$send['kategori']=Kategori::select('*')->get()->toArray();
    	return $send;
    }
}
