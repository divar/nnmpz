<?php

namespace Modules\All\Http\Controllers;

use Modules\All\Entities\ListMenu;
use Modules\All\Entities\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
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
      return view('all::Menu.'.$view, $data);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->view('index');
    }
    public function tambahMenu()
    {
        $send['kategori']= Kategori::select('*');
    
        return $this->view('form',$send);
    }
    public function popUpMenu()
    {    
        $no['no']=\Request::get('no',null);
        $no['kategori'] = Kategori::all(); 
        return $this->view('popUpMenu',$no);
    }
    public function getSize()
    {    
        $no['kategori'] = Kategori::all(); 
        return $this->view('popUpMenu',$no);
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
            $dataMenu = [
                'id_kategori'=>(isset($r['kategori'])?$r['kategori']:''),
                'nama_menu'=>(isset($r['nama'])?$r['nama']:''),
                'harga'=>(isset($r['harga'])?$r['harga']:''),
                'keterangan'=>(isset($r['keterangan'])?$r['keterangan']:''),
            ];
            $insertMenu = ListMenu::create($dataMenu);
        } catch (Exception $e) {
            DB::rollBack();

        }
        DB::commit();
        return redirect('all/menu');
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

    public function getById()
    {
        $idmenu=\Request::get('id_menu',null);
        $send['dataList'] = ListMenu::select('*')->where('id',$idmenu)->get()->toArray()[0];
        return $send;
    }

    public function loadData()
    {
        $GLOBALS['nomor']=\Request::input('start',0)+1;
        $from=\Request::get('from',null);
        $jenis=\Request::get('jenis',null);
        $ukuran=\Request::get('ukuran',null);
        $no=\Request::get('no',null);
        $dataList = ListMenu::select('*');
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('action',function($data) use($from,$no) {
          return '<button id="pilih" class="btn btn-info" onclick="getMenuById('.$data->id.','.$no.')">Pilih</button>';
        })
        ->addColumn('nama',function($data){
          return $data->nama_menu;
        })
        ->addColumn('kategori',function($data){
          return $data->kategori['nama'];
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
