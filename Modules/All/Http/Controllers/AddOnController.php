<?php

namespace Modules\All\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\All\Entities\AddOnMenu;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Modules\All\Entities\Kategori;
use Illuminate\Support\Facades\Auth;

class AddOnController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:stok-opname-read', ['only' => ['index','create','loadData']]);
        // $this->middleware('permission:stok-opname-create', ['only' => ['create','store']]);
        // $this->middleware('permission:stok-opname-update', ['only' => ['edit','udate']]);
        // $this->middleware('permission:stok-opname-delete', ['only' => ['delete']]);
    }
    public function popUpAddon()
    {    
        $sendPopUpMenu['no']=\Request::get('no',null);
        $sendPopUpMenu['kategori'] = Kategori::select('kategoris.id','kategoris.nama')->join('add_on_menus','add_on_menus.id_kategori','=','kategoris.id')->where('flag_addon','Y')->groupBy('id','nama')->get(); 
        return $this->view('popUpAddon',$sendPopUpMenu);
    }
    protected function view($view, $data = [])
    {
      return view('all::AddOn.'.$view, $data);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $send['kategori'] = Kategori::select('kategoris.id','kategoris.nama')->join('add_on_menus','add_on_menus.id_kategori','=','kategoris.id')->where('kategoris.flag_addon','Y')->groupBy('kategoris.nama','kategoris.id')->get();
        return $this->view('index',$send);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // $send['kategori'] = Kategori::where('flag_addon','Y')->where('trash','<>','Y')->get();
        // dd($send['kategori']);
        return $this->view('form');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $r=$request->all();
        try {
            $nama = $r['nama'];
            $harga = $r['harga'];
            $keterangan = $r['keterangan'];
            $kategori = $r['kategori'];
            $dataCreate = [
                'nama'=>$nama,
                'harga'=>$harga,
                'keterangan'=>$keterangan,
                'id_kategori'=>$kategori,
                'user_input'=>Auth::user()->id,
            ];
            $insertAddOn = AddOnMenu::create($dataCreate);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/addon');
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
        $send['addOn'] = AddOnMenu::find($id);
        return $this->view('form',$send);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $r=$request->all();
        DB::beginTransaction();
        try {
            $nama = $r['nama'];
            $harga = $r['harga'];
            $keterangan = $r['keterangan'];
            $kategori = $r['kategori'];
            $dataUpdate = [
                'nama'=>$nama,
                'harga'=>$harga,
                'keterangan'=>$keterangan,
                'id_kategori'=>$kategori,
                'user_update'=>Auth::user()->id,
            ];
            $updateAddOn = AddOnMenu::where('id',$r['id_addon'])->update($dataUpdate);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/addon');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $LM = AddOnMenu::find($id);
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

        $dataList = AddOnMenu::select('*')->whereNull('trash');

        if(!empty($kategori) && $kategori != null && $kategori != ''){
          $dataList->where('id_kategori',$kategori);
        }
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('kategori',function($data){
          return $data->Kategori->nama;
        })
        ->addColumn('action',function($data) use($from,$no) {
            $content='';
            if ($from!='popup') {
                $content .= '<a href="'.url("all/addon/edit/$data->id").'" target="ajax-modal" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"> Edit</i></a> &nbsp;';
                $content .= '<button type="button" id-addon="'.$data->id.'" class="btn btn-danger btn-sm DeleteData"><i class="fa fa-trash-o"> Hapus</i></button>';
            }else{
                $content .= '<button type="button" no="'.$no.'" id-addon="'.$data->id.'" nama-addon="'.$data->nama.'" harga-addon="'.$data->harga.'" class="btn btn-primary btn-sm pilihAddon"><i class="fa fa-pencil"> Pilih</i></button>';
            }
            return $content;
        })
        ->make(true);
    }
}
