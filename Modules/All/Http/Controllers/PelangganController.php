<?php

namespace Modules\All\Http\Controllers;

use Modules\All\Entities\Pelanggan;
use Modules\All\Entities\Alamat;
use Indonesia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        // $this->middleware('permission:stok-opname-read', ['only' => ['index','create','loadData']]);
        // $this->middleware('permission:stok-opname-create', ['only' => ['create','store']]);
        // $this->middleware('permission:stok-opname-update', ['only' => ['edit','udate']]);
        // $this->middleware('permission:stok-opname-delete', ['only' => ['delete']]);
    }

    protected function view($view, $data = [])
    {
      return view('all::Pelanggan.'.$view, $data);
    }

    public function index()
    {
        return $this->view('index');
    }
    public function tambahPelanggan()
    {
        $send['kabupaten']=Indonesia::findProvince(34, $with = ['cities'])->toArray();
    
        return $this->view('form',$send);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('all::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $r = $request->all();
            $dataPelanggan = [
                'nama'=>$r['nama'],
                'no_hp'=>$r['no_hp'],
                'email'=>(isset($r['email'])?$r['email']:''),
            ];
            $insertPelanggan = Pelanggan::create($dataPelanggan);
            $dataAlamat = [
                'id_pelanggan'=>$insertPelanggan->id,
                'alamat'=>(isset($r['alamat'])?$r['alamat']:''),
                'kelurahan'=>(isset($r['kelurahan'])?$r['kelurahan']:''),
                'kecamatan'=>(isset($r['kecamatan'])?$r['kecamatan']:''),
                'kabupaten'=>(isset($r['kabupaten'])?$r['kabupaten']:''),
                'provinsi'=>(isset($r['id_provinsi'])?$r['id_provinsi']:''),
            ];
            $insertAlamat = Alamat::create($dataAlamat);
            $insertPelanggan->update(['id_alamat'=>$insertAlamat->id]);
        } catch (Exception $e) {
            DB::rollBack();

        }
        DB::commit();
        return redirect('loaddataPelanggan');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('all::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('all::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
    public function loadData()
    {
        $GLOBALS['nomor']=\Request::input('start',0)+1;
        $dataList = Pelanggan::select('*');
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('nama',function($data){
          return $data->nama;
        })
        ->addColumn('alamat',function($data){
          return $data->alamat['alamat'];
        })
        ->addColumn('no_hp',function($data){
          return $data->no_hp;
        })
        ->make(true);
    }
}
