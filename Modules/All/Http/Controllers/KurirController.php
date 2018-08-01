<?php

namespace Modules\All\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\All\Entities\Kurir;
use Yajra\Datatables\Datatables;
use DB;
class KurirController extends Controller
{
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
        try {
            $r = $request->all();
              $dataMenu = [
                'nama'=>(isset($r['nama'])?$r['nama']:''),
                'persen'=>(isset($r['persen'])?$r['persen']:''),
              ];
              $insertMenu = Kurir::create($dataMenu);
        } catch (Exception $e) {
            DB::rollBack();

        }
        DB::commit();
        return redirect('all/kurir');
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
        $sendEditMenu['Menu'] = ListMenu::find($id);
        $sendEditMenu['size']=Size::all();
        $sendEditMenu['Satuan']=Satuan::all();
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
                'id_satuan'=>(isset($r['id_satuantunggal'])?$r['id_satuantunggal']:''),
                'keterangan'=>(isset($r['keterangan'])?$r['keterangan']:''),
                'id_kategori  '=>(isset($r['kategori'])?$r['kategori']:''),
                'id_size'=>(isset($r['id_size'])?$r['id_size']:null),
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
    public function destroy()
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

    public function loadData()
    {
        $GLOBALS['nomor']=\Request::input('start',0)+1;
        $from=\Request::get('from',null);
        $jenis=\Request::get('jenis',null);
        $ukuran=\Request::get('ukuran',null);
        $no=\Request::get('no',null);
        $dataList = Kurir::select('*')->whereNull('trash'); 
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
          return '<button id="pilih" class="btn btn-info" onclick="getMenuById('.$data->id.','.$no.')">Pilih</button>';
        })
        ->make(true);
    }

    protected function view($view, $data = [])
    {
      return view('all::Kurir.'.$view, $data);
    }
}
