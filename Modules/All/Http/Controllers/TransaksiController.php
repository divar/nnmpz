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
use PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                'created_at'=>date('Y-m-d'),
            ];
            $insertPelanggan = Pelanggan::create($datapelanggan);
            $dataAlamat = [
                'id_pelanggan'=>$insertPelanggan->id,
                'alamat'=>$alamat,
                'created_at'=>date('Y-m-d'),
            ];
            $insertAlamat = Alamat::create($dataAlamat);
            $getNextNoKwitansi = getNextNoKwitansi();
            $dataTransaksi = [
                'id_pelanggan'=>$insertPelanggan->id,
                'id_alamat'=>$insertAlamat->id,
                'id_tarif_wilayah'=>$tarifwilayah,
                'no_kwitansi'=> $getNextNoKwitansi,
                'created_at'=>date('Y-m-d'),
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
                    'created_at'=>date('Y-m-d'),
                ];
                $insertDetailTransaksi = DetailTransaksi::create($dataDetailTransaksi);
                $sub_total = ($harga*$jml);
                $grandtotal = $grandtotal+$sub_total;
            }
            //update data yang belum terinput
            $insertPelanggan->id_alamat = $insertAlamat->id;
            $insertPelanggan->save();
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
        return redirect("all/cetaknota/$insertTransaksi->id");
    }

    public function cetakNota(Request $request, $id=3)
    {
        $sendNota['Transaksi'] = Transaksi::with('Pelanggan')->where('id',$id)->get();
        $sendNota['DetailTransaksi'] = DetailTransaksi::with('Menu')->where('id_transaksi',$id)->get();
        $height = count($sendNota['DetailTransaksi'])*45;
        $namafile = "D:\NOTA\Transaksi".$sendNota['Transaksi'][0]->no_kwitansi.".pdf";
        $pdf= PDF::loadView('all::Transaksi.kwitansi', $sendNota);
        $pdf = $pdf->setPaper(array(20,20,204,350+$height),'portrait')->setWarnings(false)->save($namafile);
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
        return $this->view('form-update',$send);
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
            $id_pelanggan = (isset($r['id_pelanggan'])?$r['id_pelanggan']:'');
            $id_alamat = (isset($r['id_alamat'])?$r['id_alamat']:'');
            $id_transaksi = (isset($r['id_transaksi'])?$r['id_transaksi']:'');
            $nama = (isset($r['nama'])? $r['nama']:'');
            $email = (isset($r['email'])?$r['email']:'');
            $no_hp = (isset($r['no_hp'])?$r['no_hp']:'');
            $alamat = (isset($r['alamat'])?$r['alamat']:'');
            $tarifwilayah = (isset($r['tarifwilayah'])?$r['tarifwilayah']:'');
            $datapelanggan = [
                'nama'=>$nama,
                'email'=>$email,
                'no_hp'=>$no_hp,
                'updated_at'=>date('Y-m-d'),
            ];
            $insertPelanggan = Pelanggan::find($id_pelanggan);
            $insertPelanggan->update($datapelanggan);
            $dataAlamat = [
                'id_pelanggan'=>$insertPelanggan->id,
                'alamat'=>$alamat,
                'updated_at'=>date('Y-m-d'),
            ];
            $insertAlamat = Alamat::find($id_alamat);
            $insertAlamat->update($dataAlamat);
            $dataTransaksi = [
                'id_pelanggan'=>$insertPelanggan->id,
                'id_alamat'=>$insertAlamat->id,
                'id_tarif_wilayah'=>$tarifwilayah,
                'updated_at'=>date('Y-m-d'),
            ];
            $insertTransaksi = Transaksi::find($id_transaksi);
            $insertTransaksi->update($dataTransaksi);
            $grandtotal = 0;
            for($i=0;$i<$r['hide_count_menu'];$i++){
                $id_detail_transaksi = (isset($r['id_detail_transaksi'][$i])?$r['id_detail_transaksi'][$i]:'');
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
                    'updated_at'=>date('Y-m-d'),
                ];
                $insertDetailTransaksi = DetailTransaksi::find($id_detail_transaksi);
                $insertDetailTransaksi->update($dataDetailTransaksi);
                $sub_total = ($harga*$jml);
                $grandtotal = $grandtotal+$sub_total;
            }
            //update data yang belum terinput
            $insertPelanggan->id_alamat = $insertAlamat->id;
            $insertPelanggan->save();
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
        ->addColumn('action',function($data){
          $content = '<a class="btn btn-primary btn-sm" href="'.url("all/transaksi/edit/$data->id").'"><i class="fa fa-pencil-square-o"> Edit</a>';
          return $content;
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
