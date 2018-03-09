<?php

namespace Modules\All\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\All\Entities\JenisMakanan;
class JenisMakananController extends Controller
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
      return view('all::JenisMakanan.'.$view, $data);
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
            $dataCreate = [
                'nama'=> (isset($r['nama'])?$r['nama']:''),
                'user_input'=>Auth::user()->id,
            ];
            $createTarif = JenisMakanan::create($dataCreate);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/JenisMakanan');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return $this->view('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $send['JenisMakanan']=JenisMakanan::find($id);
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
                'user_update'=> Auth::user()->id,
            ];
            $S = JenisMakanan::find($r['id_jenis_makanan']);
            $S->update($dataUpdate);
        } catch (Exception $e) {    
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/JenisMakanan');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $Jl = JenisMakanan::find($id);
            $Jl->trash='Y';
            $Jl->save();
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
        $dataList = JenisMakanan::select('*')->whereNull('trash');
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('nama',function($data){
          return $data->nama;
        })
        ->addColumn('action',function($data){
          $content = '<a type="button" href="'.url("all/JenisMakanan/edit/$data->id").'" target="ajax-modal" class="btn btn-primary btn-sm">Edit</a>&nbsp;&nbsp;';
          $content .= '<button type="button" id-jenis_makanan="'.$data->id.'" class="btn btn-danger btn-sm DeleteData"><i class="fa fa-trash-o"> Hapus</i></button>';
          return $content;
        })
        ->make(true);
    }
}