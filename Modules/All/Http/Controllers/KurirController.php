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
    public function edit(Request $request, $id)
    {
        $send['Kurir'] = Kurir::find($id);
        return $this->view('form',$send);
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
                'nama'=> (isset($r['nama'])?$r['nama']:''),
                'persen'=> (isset($r['persen'])?$r['persen']:''),
            ];
            $Kurir = Kurir::find($r['id_kurir']);
            $Kurir->update($dataUpdate);
        } catch (Exception $e) {    
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/kurir');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        DB::beginTransaction();
        try {
          $Kurir = Kurir::find($id);
          $Kurir->trash='Y';
          $Kurir->save(); 
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
          $content = '<a id="edit" target="ajax-modal" class="btn btn-info" href="'.url("all/kurir/edit/$data->id").'">Edit</a>';
          $content .= '&nbsp; <button id="hapus" class="btn btn-danger hapus" id-kurir="'.$data->id.'">hapus</button>';
          return $content;
        })
        ->make(true);
    }

    protected function view($view, $data = [])
    {
      return view('all::Kurir.'.$view, $data);
    }
}
