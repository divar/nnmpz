<?php

namespace Modules\All\Http\Controllers;

use Modules\All\Entities\Pelanggan;
use Modules\All\Entities\Transaksi;
use Modules\All\Entities\DetailTransaksi;
use Modules\All\Entities\Alamat;
use Modules\All\Entities\TarifWilayah;
use Modules\All\Entities\Size;
use Modules\All\Entities\ListMenu;
use Indonesia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
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
      return view('all::Transaksi.'.$view, $data);
    }

    public function index()
    {
        return $this->view('index');
    }
    public function tambahTransaksi()
    {
        $send['kabupaten']=Indonesia::findProvince(34, $with = ['cities'])->toArray();
        $send['TarifWilayah']=TarifWilayah::all();
        return $this->view('form',$send);
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
            $nama = (isset($r['nama'])?$r['nama']:'');
            $email = (isset($r['email'])?$r['email']:'');
            $no_hp = (isset($r['no_hp'])?$r['no_hp']:'');
            $alamat = (isset($r['alamat'])?$r['alamat']:'');
            $tarifwilayah = (isset($r['tarifwilayah'])?$r['tarifwilayah']:'');
            $datapelanggan = [
                'nama'=>$nama,
                'email'=>$email,
                'no_hp'=>$no_hp,
            ];
            $insertPelanggan = Pelanggan::create($datapelanggan);
            $dataAlamat = [
                'id_pelanggan'=>$insertPelanggan->id,
                'alamat'=>$alamat,
            ];
            $insertAlamat = Alamat::create($dataAlamat);
            $dataTransaksi = [
                'id_pelanggan'=>$insertPelanggan->id,
                'id_alamat'=>$insertAlamat->id,
                'id_tarif_wilayah'=>$tarifwilayah,
            ];
            $insertTransaksi = Transaksi::create($dataTransaksi);
            $grandtotal = 0;
            for($i=0;$i<$r['hide_count_menu'];$i++){
                $id_menu = (isset($r['id_menu'][$i])?$r['id_menu'][$i]:'');
                $harga = ListMenu::select('harga')->where('id',$id_menu)->whereNull('trash')->get()[0]->harga;;
                $jml = (isset($r['jml'][$i])?$r['jml'][$i]:0); 
                $keterangan = (isset($r['keterangan'][$i])?$r['keterangan'][$i]:''); 
                $dataDetailTransaksi = [
                    'id_transaksi'=> $insertTransaksi->id,
                    'id_menu'=> $id_menu,
                    'harga'=> $harga,
                    'jml'=> $jml,
                    'sub_total'=> $harga*$jml,
                    'keterangan'=> $keterangan,
                ];
                $insertDetailTransaksi = DetailTransaksi::create($dataDetailTransaksi);
                $sub_total = ($harga*$jml);
                $grandtotal = $grandtotal+$sub_total;
            }
            //update data yang belum terinput
            $insertPelanggan->id_alamat = $insertAlamat->id;
            $insertPelanggan->save();
            $insertTransaksi->total_harga = $grandtotal;
            $insertTransaksi->save();
            $return = 'sukses';
            if(!empty($r['return'])){
                $return = $r['return'];
            }
        } catch (Exception $e) {
            DB::rollBack();
            $return = 'gagal';
        }
        DB::commit();
        return redirect("all/cetaknota/$insertTransaksi->id");
    }

    public function cetakNota(Request $request, $id=3)
    {
        $sendNota['Transaksi'] = Transaksi::where('id',$id)->get();
        $sendNota['DetailTransaksi'] = DetailTransaksi::where('id_transaksi',$id)->get();
        return $this->view('kwitansi',$sendNota); 
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

    public function loadData()
    {
        $GLOBALS['nomor']=\Request::input('start',0)+1;
        $from=\Request::get('no',null);
        $from=date( 'Y-m-d H:i:s', strtotime( $from ));
        $to=\Request::get('to',null);
        $to=date( 'Y-m-d H:i:s', strtotime( $to ));
        $dataList = Transaksi::select('*')->where('created_at','>=',$from)->where('created_at','<=',$to);
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('nama',function($data){
          return $data->Pelanggan->nama;
        })
        ->addColumn('alamat',function($data){
          return $data->Alamat->alamat;
        })
        ->addColumn('tgl_lahir',function($data){
          return $data->no_hp;
        })
        ->addColumn('pesanan',function($data){
          $lm = DetailTransaksi::with('menu')->where('id_transaksi',$data->id); 
          $content = '';
          $lm = $lm->get();
          for ($i=0; $i < count($lm); $i++) { 
            $val = $lm[$i]->menu['nama_menu'];
              $content .= '<label class="label-default">'.($i+1).'. '.$val.'</label><br>'; 
          }
          return $content;
        })
        ->addColumn('tgl_pesan',function($data){
          return $data->created_at;
        })
        ->addColumn('no_hp',function($data){
          return $data->Pelanggan->no_hp;
        })
        ->rawColumns(['pesanan'])
        ->make(true);
    }
}
