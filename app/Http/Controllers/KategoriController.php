<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\All\Entities\AddOnMenu;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Modules\All\Entities\Kategori;
use Illuminate\Support\Facades\Auth;
use Modules\All\Entities\Satuan;

class KategoriController extends Controller
{
    public function getKategoriMenu(){
      $send['kategori']=Kategori::where('flag_addon','<>','Y')->whereNull('trash')->get()->toArray();
      return $send;
    }
    public function getKategoriAddon(){
    	$send['kategori']=Kategori::where('flag_addon','=','Y')->whereNull('trash')->get()->toArray();
    	return $send;
    }

    public function __construct()
    {
        // $this->middleware('permission:stok-opname-read', ['only' => ['index','create','loadData']]);
        // $this->middleware('permission:stok-opname-create', ['only' => ['create','store']]);
        // $this->middleware('permission:stok-opname-update', ['only' => ['edit','udate']]);
        // $this->middleware('permission:stok-opname-delete', ['only' => ['delete']]);
    }

    protected function view($view, $data = [])
    {
      return view('Kategori.'.$view, $data);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->view('index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $send['kategori'] = Kategori::where('flag_addon','Y');
        $send['Satuan']=Satuan::all();
        return $this->view('form',$send);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    	$r = $request->all();
    	DB::beginTransaction();
  		try {
        $dataCreate['nama']=isset($r['nama'])?$r['nama']:'';
        $dataCreate['flag_addon']=isset($r['addon']) && $r['addon']=='Y'?'Y':'N';
        $dataCreate['id_satuan']=(isset($r['id_satuan'])?$r['id_satuan']:'');
  			$dataCreate['user_input']= Auth::user()->id;
  			$createKategori = Kategori::create($dataCreate);	
  		} catch (Exception $e) {
  			DB::rollBack();
  		}
  		DB::commit();
  		return redirect('administrasi/kategori');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return $this->view('all::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
    	$send['Kategori']=Kategori::find($id);
        return $this->view('form',$send);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    	$r = $request->all();
    	// dd($r['addon']);
    	DB::beginTransaction();
		try {
			$dataUpdate = [
				'nama'=> isset($r['nama'])?$r['nama']:'',
        'id_satuan'=>(isset($r['id_satuan'])?$r['id_satuan']:''),
				'user_update'=> Auth::user()->id,
				'flag_addon'=> isset($r['addon'])?$r['addon']:'',
			];
			$createKategori = Kategori::where('id',$r['id_kategori']);
			$createKategori->update($dataUpdate);	
		} catch (Exception $e) {
			DB::rollBack();
		}
		DB::commit();
		return redirect('administrasi/kategori');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      DB::beginTransaction();
      try {
        $LM = Kategori::find($id);
        $LM->trash='Y';
        $LM->save(); 
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
        $from=\Request::get('from',null);
        $kategori=\Request::get('jenis',null);
        $no=\Request::get('no',null);

        $dataList = Kategori::select('*')->whereNull('trash');
        if(!empty($kategori) && $kategori != null && $kategori != ''){
          $dataList->where('id_kategori',$kategori);
        }
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('nama',function($data){
          return $data->nama;
        })
        ->addColumn('flag_add_on',function($data){
          $content = "";
          if ($data->flag_addon =='Y') {
          	$content = "Kategori Untuk Addon";
          } else {
          	$content = "Kategori Untuk Menu";
          }
          return $content;
        })
        ->addColumn('keterangan',function($data){
          return $data->keterangan;
        })
        ->addColumn('action',function($data) use($from,$no) {
            $content = '<a href="'.url("administrasi/kategori/edit/$data->id").'" target="ajax-modal" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"> Edit</i></a> &nbsp;';
            $content .= '<button type="button" id-kategori="'.$data->id.'" class="btn btn-danger btn-sm DeleteData"><i class="fa fa-trash-o"> Hapus</i></button>';
            return $content;
        })
        ->make(true);
    }

}
