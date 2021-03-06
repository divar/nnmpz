<?php

namespace Modules\All\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\All\Entities\Jalan;
use Modules\All\Entities\TarifWilayah;
use Modules\All\Entities\Jenis;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JalanController extends Controller
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
      return view('all::Jalan.'.$view, $data);
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
        $tarifWilayah = TarifWilayah::where('trash','<>','Y')->orWhereNull('trash')->get();
        return $this->view('form',['tarifWilayah'=>$tarifWilayah]);
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
            $id_user = Auth::user()->id;
            $dataJalan=[
                'id_tarif_wilayah'=>$r['wilayah'], 
                'nama'=>$r['jalan'],
                'user_input'=>$id_user,
            ];
            $insertJalan = Jalan::create($dataJalan);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/jalan');
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
    public function edit($id, Request $request)
    {
        $send['Jalan'] = Jalan::find($id);
        // dd($send['Jalan']);
        $send['tarifWilayah'] = TarifWilayah::where('trash','<>','Y')->orWhereNull('trash')->get()->merge(
          TarifWilayah::where('id',Jalan::find($id)->get()->pluck('id_tarif_wilayah'))->get()
        )->toArray();
        // dd($send['tarifWilayah']);
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
                'id_tarif_wilayah'=> (isset($r['wilayah'])?$r['wilayah']:''),
                'nama'=> (isset($r['jalan'])?$r['jalan']:''),
            ];
            $Jl = Jalan::find($r['id_jalan']);
            $Jl->update($dataUpdate);
        } catch (Exception $e) {    
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/jalan');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $Jl = Jalan::find($id);
            $Jl->trash='Y';
            $Jl->save();
        }catch(Exception $e){
            DB::rollBack();
            return 'bad';
        }
        DB::commit();
        return 'ok';
    }

    public function popUpJalan()
    {
      return $this->view('popUpJalan');
    }

    public function getById()
    {
        $id_jalan=\Request::get('id_jalan',null);
        $send['dataList'] = Jalan::select('*')->with('tarifWilayah')->where('id',$id_jalan)->whereNull('trash')->get()->toArray()[0];
        return $send;
    }

    public function loadData()
    {
        $GLOBALS['nomor']=\Request::input('start',0)+1;
        $from=\Request::get('from',null);
        
        $dataList = Jalan::whereNull('trash')->orderBy('id','ASC');
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('nama_wilayah',function($data){
          return $data->tarifWilayah->nama;
        })
        ->addColumn('harga',function($data){
          return $data->tarifWilayah->harga;
        })
        ->addColumn('action',function($data) use($from) { 
          $content = '';
          if($from != 'popup'){
            $content .='<a href="'.url('all/jalan/edit/'.$data->id).'" target="ajax-modal" class="btn btn-sm btn-info"> <i class="fa fa-pencil"> Edit</i> </a> &nbsp;';
            $content .= '<button type="button" id-jalan="'.$data->id.'" class="btn btn-danger btn-sm DeleteData"><i class="fa fa-trash-o"> Hapus</i></button>';
          }
          if ($from == 'popup') {
            $jenis = Jenis::where('id_tarif_wilayah',$data->tarifWilayah->id)->get();
            for ($i=0; $i < count($jenis); $i++) {
              $content .= '<button type="button" onclick="getJalanById('.$data->id.','.$jenis[$i]->id.','."'".$jenis[$i]->jenis."'".')" class="btn btn-primary btn-sm m-1"> '.$jenis[$i]->jenis.' </button>';
            }
          }
          return $content;
        })
        ->make(true);
    }
}
