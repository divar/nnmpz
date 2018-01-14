<?php

namespace Modules\All\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\All\Entities\Satuan;
use Illuminate\Routing\Controller;
use Indonesia; 
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SatuanController extends Controller
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
      return view('all::Satuan.'.$view, $data);
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
                'satuan'=> (isset($r['nama'])?$r['nama']:''),
                'user_input'=>Auth::user()->id,
            ];
            $createTarif = Satuan::create($dataCreate);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/Satuan');
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
        $send['Satuan']=Satuan::find($id);
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
                'satuan'=> (isset($r['nama'])?$r['nama']:''),
                'user_update'=> Auth::user()->id,
            ];
            $S = Satuan::find($r['id_satuan']);
            $S->update($dataUpdate);
        } catch (Exception $e) {    
            DB::rollBack();
        }
        DB::commit();
        return redirect('all/Satuan');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $Jl = Satuan::find($id);
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
        $dataList = Satuan::select('*')->whereNull('trash');
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('action',function($data){
          $content = '<a type="button" href="'.url("all/Satuan/edit/$data->id").'" target="ajax-modal" class="btn btn-primary btn-sm">Edit</a>&nbsp;&nbsp;';
          $content .= '<button type="button" id-satuan="'.$data->id.'" class="btn btn-danger btn-sm DeleteData"><i class="fa fa-trash-o"> Hapus</i></button>';
          return $content;
        })
        ->make(true);
    }
}
