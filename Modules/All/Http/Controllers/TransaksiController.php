<?php

namespace Modules\All\Http\Controllers;

use Modules\All\Entities\Pelanggan;
use Modules\All\Entities\Transaksi;
use Modules\All\Entities\DetailTransaksi;
use Modules\All\Entities\DetailAddOn;
use Modules\All\Entities\Alamat;
use Modules\All\Entities\TarifWilayah;
use Modules\All\Entities\Size;
use Modules\All\Entities\ListMenu;
use Indonesia;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
    public function index2()
    {
        return $this->view('index-laporan');
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
    public function create($id)
    {
        $send['kabupaten']=Indonesia::findProvince(34, $with = ['cities'])->toArray();
        $send['TarifWilayah']=TarifWilayah::all();
        $send['Pelanggan'] = Pelanggan::find($id);
        return $this->view('form',$send);
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
            $nama_penerima = (isset($r['nama_penerima'])?$r['nama_penerima']:'');
            $email = (isset($r['email'])?$r['email']:'');
            $no_hp = (isset($r['no_hp'])?$r['no_hp']:'');
            $alamat = (isset($r['alamat'])?$r['alamat']:'');
            $id_jalan = intval(isset($r['id_jalan'])?$r['id_jalan']:'');
            $id_alamat = (isset($r['id_alamat'])?$r['id_alamat']:'');
            $id_pelanggan = (isset($r['id_pelanggan'])?$r['id_pelanggan']:'');
            $tarifwilayah = (isset($r['id_tarifwilayah'])?$r['id_tarifwilayah']:'');
            $harga_tarif_wilayah = (isset($r['harga_tarif_wilayah'])?$r['harga_tarif_wilayah']:'');
            $userinput = Auth::user()->id;
            $created_at = date('Y-m-d');
            if(isset($id_pelanggan) && empty($id_pelanggan)){
                $datapelanggan = [
                    'nama'=>$nama,
                    'email'=>$email,
                    'no_hp'=>$no_hp,
                    'user_input'=>$userinput,
                    'created_at'=>$created_at,
                ];
                $insertPelanggan = Pelanggan::create($datapelanggan);
                $id_pelanggan = $insertPelanggan->id;

                $dataAlamat = [
                    'id_pelanggan'=> $id_pelanggan,
                    'alamat'=>$alamat,
                    'id_jalan'=>$id_jalan,
                    'user_input'=> $userinput,
                    'created_at'=>$created_at,
                ];
                $insertAlamat = Alamat::create($dataAlamat);
                $id_alamat = $insertAlamat->id;
            }else{
                $insertPelanggan=Pelanggan::find($id_pelanggan);
            }

            $getNextNoKwitansi = getNextNoKwitansi();
            
            $dataTransaksi = [
                'id_pelanggan'=>$id_pelanggan,
                'id_alamat'=>$id_alamat,
                'id_jalan'=>$id_jalan,
                'penerima'=>$nama_penerima,
                'id_tarif_wilayah'=>$tarifwilayah,
                'no_kwitansi'=> $getNextNoKwitansi,
                'user_input'=> $userinput,
                'created_at'=>$created_at,
            ];
            $insertTransaksi = Transaksi::create($dataTransaksi);
            $grandtotal = 0;
            for($i=0;$i<count($r['count_menu']);$i++){
                $nama_baris = $r['count_menu'][$i];
                $baris = $r[$nama_baris];
                $id_menu = (isset($baris['id_menu'])?$baris['id_menu']:'');
                $harga = ListMenu::select('harga')->where('id',$id_menu)->whereNull('trash')->get()[0]->harga;;
                $jml = (isset($baris['jml'])?$baris['jml']:0); 
                $keterangan = (isset($baris['keterangan'])?$baris['keterangan']:''); 
                $dataDetailTransaksi = [
                    'id_transaksi'=> $insertTransaksi->id,
                    'id_menu'=> $id_menu,
                    'harga'=> $harga,
                    'jml'=> $jml,
                    'sub_total'=> $harga*$jml,
                    'keterangan'=> $keterangan,
                    'user_input'=> $userinput,
                    'created_at'=>$created_at,
                ];
                $insertDetailTransaksi = DetailTransaksi::create($dataDetailTransaksi);
                $id_dt = $insertDetailTransaksi->id;
                $total_harga_addon = 0;
                if (isset($baris['id_addon'])) {
                    $id_addon = $baris['id_addon'];
                    $itemharga_addon = $baris['itemharga_addon'];
                    $total_harga_addon = array_sum($baris['itemharga_addon']);
                    for ($z=0; $z < count($baris['id_addon']) ; $z++) { 
                        $dataDetailAddon = [
                            'id_detail_transaksi'=>$id_dt,
                            'id_add_on'=>$id_addon[$z],
                            'harga'=>$itemharga_addon[$z],
                            'user_input'=>$userinput,
                            'created_at'=>$created_at,
                        ];
                        $insertDetailAddOn = DetailAddOn::create($dataDetailAddon);
                    }
                }
                $sub_total = (($harga+$total_harga_addon)*$jml);
                $grandtotal = $grandtotal+$sub_total;
            }
            // dd($id_alamat);
            //update data yang belum terinput
            $insertPelanggan->id_alamat = $id_alamat;
            $insertPelanggan->save();
            $insertTransaksi->total_harga = ($grandtotal+$harga_tarif_wilayah)*1.1;
            $insertTransaksi->ppn = ($grandtotal+$harga_tarif_wilayah)*0.1;
            $insertTransaksi->tarif_wilayah = $harga_tarif_wilayah;
            $insertTransaksi->id_jalan = $id_jalan;
            $insertTransaksi->save();
            $return = 'sukses';
            if(!empty($r['submit']) && $r['submit']== 'Input Lagi'){
                $return = $r['submit'];
            }
        } catch (Exception $e) {
            DB::rollBack();
            $return = 'gagal';
            // , 'id'=>$insertTransaksi->id
        }
        DB::commit();
        if($return == 'Input Lagi'){
            return redirect('all/transaksi/tambah')->with('return',$return)->with('id',$insertTransaksi->id);
        }else{
            return redirect('all/transaksi')->with('return',$return)->with('id',$insertTransaksi->id);
        }
    }

    public function cetakNota(Request $request, $id=0)
    {
        $sendNota['Transaksi'] = Transaksi::with('Pelanggan')->where('id',$id)->get();
        $sendNota['DetailTransaksi'] = DetailTransaksi::with('Menu')->where('id_transaksi',$id)->get();
        $height = PDF::loadView('all::Transaksi.kwitansi', $sendNota)->getDomPDF()->getCanvas()->get_height();
        $namafile = "D:\NOTA\Transaksi".$sendNota['Transaksi'][0]->no_kwitansi.".pdf";
        $pdf= PDF::loadView('all::Transaksi.kwitansi', $sendNota);
        $pdf = $pdf->setPaper(array(20,20,204,($height*0.514)),'portrait')->setWarnings(false)->save($namafile);
        return $pdf->stream($namafile);
        // return redirect('all/transaksi');
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
        $send['kabupaten']=Indonesia::findProvince(34, $with = ['cities'])->toArray();
        $send['TarifWilayah']=TarifWilayah::all();
        $send['Transaksi']=Transaksi::find($id);
        $send['Pelanggan']=Pelanggan::find($send['Transaksi']->id_pelanggan);
        $send['Alamat']=Alamat::find($send['Transaksi']->id_alamat);
        $send['DetailTransaksi']=DetailTransaksi::with('menu')->where('id_transaksi',$send['Transaksi']->id)->get(); 
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
            // dd($r);
            $nama = (isset($r['nama'])?$r['nama']:'');
            $nama_penerima = (isset($r['nama_penerima'])?$r['nama_penerima']:'');
            $email = (isset($r['email'])?$r['email']:'');
            $no_hp = (isset($r['no_hp'])?$r['no_hp']:'');
            $alamat = (isset($r['alamat'])?$r['alamat']:'');
            $id_transaksi = (isset($r['id_transaksi'])?$r['id_transaksi']:'');
            $id_jalan = intval(isset($r['id_jalan'])?$r['id_jalan']:'');
            $id_alamat = (isset($r['id_alamat'])?$r['id_alamat']:'');
            $id_pelanggan = (isset($r['id_pelanggan'])?$r['id_pelanggan']:'');
            $tarifwilayah = (isset($r['id_tarifwilayah'])?$r['id_tarifwilayah']:'');
            $harga_tarif_wilayah = (isset($r['harga_tarif_wilayah'])?$r['harga_tarif_wilayah']:'');
            $user_update = Auth::user()->id;
            $created_at = date('Y-m-d');
            $dataTransaksi = [
                'id_alamat'=>$id_alamat,
                'penerima'=> $nama_penerima,
                'id_tarif_wilayah'=>$tarifwilayah,
                'user_update'=>$user_update,
                'updated_at'=>date('Y-m-d'),
            ];
            $insertTransaksi = Transaksi::find($id_transaksi);
            $insertTransaksi->update($dataTransaksi);
            $grandtotal = 0;
            for($i=0;$i<count($r['count_menu']);$i++){
                $nama_baris = $r['count_menu'][$i];
                $baris = $r[$nama_baris];
                $id_detail_transaksi = (isset($baris['id_detail_transaksi'])?$baris['id_detail_transaksi']:'');
                $id_menu = (isset($baris['id_menu'])?$baris['id_menu']:'');
                $harga = ListMenu::select('harga')->where('id',$id_menu)->whereNull('trash')->get()[0]->harga;;
                $jml = (isset($baris['jml'])?$baris['jml']:0); 
                $keterangan = (isset($baris['keterangan'])?$baris['keterangan']:''); 
                $dataDetailTransaksi = [
                    'id_transaksi'=> $id_transaksi,
                    'id_menu'=> $id_menu,
                    'harga'=> $harga,
                    'jml'=> $jml,
                    'sub_total'=> $harga*$jml,
                    'keterangan'=> $keterangan,
                    'user_update'=>$user_update,
                    'created_at'=>$created_at,
                ];
                $insertDetailTransaksi = DetailTransaksi::where('id',$id_detail_transaksi)->update($dataDetailTransaksi);
                $id_dt = $id_detail_transaksi;
                $total_harga_addon = 0;
                DetailAddOn::where('id_detail_transaksi',$id_dt)->delete();
                if (isset($baris['id_addon'])){
                    $id_addon = $baris['id_addon'];
                    $itemharga_addon = $baris['itemharga_addon'];
                    $total_harga_addon = array_sum($baris['itemharga_addon']);
                    for ($z=0; $z < count($baris['id_addon']) ; $z++) { 
                        $dataDetailAddon = [
                            'id_detail_transaksi'=>$id_dt,
                            'id_add_on'=>$id_addon[$z],
                            'harga'=>$itemharga_addon[$z],
                            'user_update'=>$user_update,
                            'created_at'=>$created_at,
                        ];
                        $insertDetailAddOn = DetailAddOn::create($dataDetailAddon);
                    }
                }
                $sub_total = (($harga+$total_harga_addon)*$jml);
                $grandtotal = $grandtotal+$sub_total;
            }
            //update data yang belum terinput
            $insertTransaksi->total_harga = $grandtotal*1.1;
            $insertTransaksi->ppn = $grandtotal*0.1;
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
        return redirect("all/transaksi");
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
        $from=\Request::get('from',null);
        $laporan=\Request::get('laporan',null);
        $from=Carbon::createFromFormat('d-m-Y', $from);
        $from=$from->format('Y-m-d');
        $to=\Request::get('to',null);
        $to=Carbon::createFromFormat('d-m-Y', $to);
        $to=$to->format('Y-m-d');
        $dataList = Transaksi::select('*')->where('created_at','>=',$from." 00:00:00")->where('created_at','<=',$to." 23:59:59");
        return Datatables::of($dataList)
        ->addColumn('nomor',function(){
          return $GLOBALS['nomor']++;
        })
        ->addColumn('nama',function($data){
          return $data->Pelanggan->nama;
        })
        ->addColumn('action',function($data) use($laporan) {
        if(empty($laporan)){
          $content = '<a class="btn btn-primary btn-sm m-1" href="'.url("all/transaksi/edit/$data->id").'"><i class="fa fa-pencil-square-o"></i>Edit</a>';
          $content .= '<a class="btn btn-primary btn-sm m-1" href="'.url("all/transaksi/create-from/$data->id_pelanggan").'"><i class="fa fa-pencil-square-o"></i> Order</a>';
          return $content;
        }
          return '';
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
        ->addColumn('total',function($data){
            $nominal = nominalKoma($data->total_harga+$data->ppn,true);
          return $nominal;
        })
        ->addColumn('no_hp',function($data){
          return $data->Pelanggan->no_hp;
        })
        ->rawColumns(['pesanan','action'])
        ->make(true);
    }
}
