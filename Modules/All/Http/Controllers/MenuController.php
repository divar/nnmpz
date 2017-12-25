<?php

namespace Modules\All\Http\Controllers;

use Modules\All\Entities\ListMenu;
use Modules\All\Entities\Kategori;
use Modules\All\Entities\Size;
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
        $sendTambahMenu['kategori']= Kategori::select('*'); 
        $sendTambahMenu['size']=Size::all();
        return $this->view('form',$sendTambahMenu);
    }
    public function popUpMenu()
    {    
        $sendPopUpMenu['no']=\Request::get('no',null);
        $sendPopUpMenu['selectKategori'] = Kategori::all(); 
        return $this->view('popUpMenu',$sendPopUpMenu);
    }
    public function getSize()
    {    
        $id_kategori=\Request::get('id_kategori',null);
        $sendSize['size'] = ListMenu::select('sizes.id','sizes.nama')->join('sizes','sizes.id','list_menus.id_size')->where('list_menus.id_kategori',$id_kategori)->groupBy('sizes.id')->groupBy('sizes.nama')->get()->toArray(); 
        // $sendSize['size'] = \DB::select('SELECT S.* FROM list_menus lm JOIN sizes s on lm.id_size = s.id group by s.id'); 
        return  $sendSize;
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
            if(isset($r['pilihsize']) && $r['pilihsize']=="tidak"){
              $dataMenu = [
                'id_kategori'=>(isset($r['kategori'])?$r['kategori']:''),
                'nama_menu'=>(isset($r['nama'])?$r['nama']:''),
                'harga'=>(isset($r['harga'])?$r['harga']:''),
                'keterangan'=>(isset($r['keterangan'])?$r['keterangan']:''),
              ];
              $insertMenu = ListMenu::create($dataMenu);
            }else{
              $i=0;
              foreach ($r['xsize'] as $key => $value){
                // dd($key);
                $dataMenu = [
                'id_kategori'=>(isset($r['kategori'])?$r['kategori']:''),
                'nama_menu'=>(isset($r['nama'])?$r['nama']." ".$key:''),
                'harga'=>(isset($r['hargaSize'][$i])?$r['hargaSize'][$i]:''),
                'keterangan'=>(isset($r['keterangan'])?$r['keterangan']:''),
                'id_size'=> $value,
                ];
                $insertMenu = ListMenu::create($dataMenu);
                $i++;
              }
            }
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
    public function edit($id)
    {
        $sendEditMenu['Menu'] = ListMenu::find($id);
        $sendEditMenu['size']=Size::all();
        return $this->view('form',$sendEditMenu);
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
              'nama_menu'=> (isset($r['nama'])?$r['nama']:''),
              'harga'=> (isset($r['harga'])?$r['harga']:''),
              'keterangan'=>(isset($r['keterangan'])?$r['keterangan']:''),
              'id_kategori  '=>(isset($r['kategori'])?$r['kategori']:''),
              'id_size'=>(isset($r['id_size'])?$r['id_size']:''),
          ];
          $LM = ListMenu::find($r['id_menu']);
          $LM->update($dataUpdate);
      } catch (Exception $e) {    
          DB::rollBack();
      }
      DB::commit();
      return redirect('all/menu');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      DB::beginTransaction();
      try {
        $LM = ListMenu::find($id);
        $LM->trash='Y';
        $LM->save(); 
      }catch(Exception $e){
        DB::rollBack();
        return 'bad';
      }
      DB::commit();
        return 'ok';
    }

    public function getById()
    {
        $idmenu=\Request::get('id_menu',null);
        $send['dataList'] = ListMenu::select('*')->where('id',$idmenu)->whereNull('trash')->get()->toArray()[0];
        return $send;
    }

    public function loadData()
    {
        $GLOBALS['nomor']=\Request::input('start',0)+1;
        $from=\Request::get('from',null);
        $jenis=\Request::get('jenis',null);
        $ukuran=\Request::get('ukuran',null);
        $no=\Request::get('no',null);
        $dataList = ListMenu::select('*')->whereNull('trash');
        if(!empty($jenis) && $jenis != null && $jenis != ''){
          $dataList->where('id_kategori',$jenis);
        }
        if(!empty($ukuran) && $ukuran != null && $ukuran != ''){
          $dataList->where('id_size',$ukuran);
        }
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('action',function($data) use($from,$no) {
          if(empty($from)){
            $content = '<a href="'.url("all/menu/edit/$data->id").'" target="ajax-modal" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"> Edit</i></a> &nbsp;';
            $content .= '<button type="button" id-menu="'.$data->id.'" class="btn btn-danger btn-sm DeleteData"><i class="fa fa-trash-o"> Hapus</i></button>';
            return $content;
          }
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
        ->addColumn('ukuran',function($data){
          return $data->size->nama;
        })
        ->make(true);
    }
}
