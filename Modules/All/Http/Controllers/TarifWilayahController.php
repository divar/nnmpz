<?php

namespace Modules\All\Http\Controllers;

use Modules\All\Entities\TarifWilayah;
use Modules\All\Entities\Jenis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Indonesia; 
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TarifWilayahController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:stok-opname-read', ['only' => ['index','create','loadData']]);
        // $this->middleware('permission:stok-opname-create', ['only' => ['create','store']]);
        // $this->middleware('permission:stok-opname-update', ['only' => ['edit','udate']]);
        // $this->middleware('permission:stok-opname-delete', ['only' => ['delete']]);
    }

    protected function view($view, $data = [])
    {
      return view('all::TarifWilayah.'.$view, $data);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->view('index');
    }

    public function tambahTarifWilayah()
    {
        return $this->view('form');
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
          $dataTarif = [
              'nama'=> (isset($r['nama'])?$r['nama']:''),
              'harga'=> (isset($r['harga'])?$r['harga']:''),
              'keterangan'=> (isset($r['keterangan'])?$r['keterangan']:''),
              'user_input'=>Auth::user()->id,
          ];
          $createTarif = TarifWilayah::create($dataTarif);
          for ($i=0; $i < count($r['jenis']); $i++) { 
            $dataJenis = [
              'id_tarif_wilayah'=> $createTarif->id,
              'jenis'=> (isset($r['jenis'][$i])?$r['jenis'][$i]:''),
              'user_input'=>Auth::user()->id,
            ];
            $jenis = Jenis::create($dataJenis);
          }
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/TarifWilayah');
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
    public function edit($id)
    {
        $sendTarif['Tarifwilayah'] = TarifWilayah::find($id);
        $sendTarif['jenis'] = Jenis::where('id_tarif_wilayah',$id)->get();
        return $this->view('form',$sendTarif);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
          $r = $request->all();
          $dataUpdate = [
              'nama'=>$r['nama'],
              'harga'=>$r['harga'],
              'keterangan'=>$r['keterangan'],
              'user_update'=>Auth::user()->id,
          ];
          $Tw = Tarifwilayah::find($r['id_tarif_wilayah']);
          $Tw->update($dataUpdate);
          Jenis::where('id_tarif_wilayah',$r['id_tarif_wilayah'])->delete();
          for ($i=0; $i < count($r['jenis']); $i++) {
            $dataJenis = [
              'id_tarif_wilayah'=> $r['id_tarif_wilayah'],
              'jenis'=> (isset($r['jenis'][$i])?$r['jenis'][$i]:''),
              'user_input'=>Auth::user()->id,
            ];
            $jenis = Jenis::create($dataJenis);
          }
        } catch (Exception $e) {    
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/TarifWilayah');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      DB::beginTransaction();
      try {
        $TW = TarifWilayah::find($id);
        $TW->trash='Y';
        $TW->save(); 
      }catch(Exception $e){
        DB::rollBack();
        return 'bad';
      }
      DB::commit();
        return 'ok';
    }

    public function loadData()
    {
        $GLOBALS['nomor']=\Request::input('start',0)+1;
        $dataList = TarifWilayah::select('*')->whereNull('trash');
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('nama',function($data){
          return $data->nama;
        })
        ->addColumn('action',function($data){
          $content = '<a type="button" href="'.url("all/TarifWilayah/edit/$data->id").'" target="ajax-modal" class="btn btn-primary btn-sm">Edit</a>&nbsp;&nbsp;';
          $content .= '<button type="button" id-tarif="'.$data->id.'" class="btn btn-danger btn-sm DeleteData"><i class="fa fa-trash-o"> Hapus</i></button>';
          return $content;
        })
        ->addColumn('harga',function($data){
          return $data->harga;
        })
        ->addColumn('keterangan',function($data){
          return $data->keterangan;
        })
        ->make(true);
    }
}
