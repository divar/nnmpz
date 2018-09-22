<?php

namespace Modules\All\Http\Controllers;

use Modules\All\Entities\Pelanggan;
use Modules\All\Entities\Transaksi;
use Modules\All\Entities\DetailTransaksi;
use Modules\All\Entities\Modifier;
use Modules\All\Entities\DetailAddOn;
use Modules\All\Entities\Alamat;
use Modules\All\Entities\TarifWilayah;
use Modules\All\Entities\Size;
use Modules\All\Entities\Satuan;
use Modules\All\Entities\ListMenu;
use Modules\All\Entities\Kurir;
use Indonesia;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Facades\Excel;
use Modules\All\Http\Controllers\ExportlaporanController;
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
        $send['satuan'] =  Satuan::select('id')->first()->count();
        $send['satuan2'] =  Satuan::select('satuan')->get()->toArray();
        $send['Kurir'] = Kurir::where('trash','<>','Y')->orWhereNull('trash')->get();
        return $this->view('index-laporan',$send);
    }
    public function tambahTransaksi()
    {
        $send['kabupaten']=Indonesia::findProvince(34, $with = ['cities'])->toArray();
        $send['TarifWilayah']=TarifWilayah::all();
        $send['Kurir'] = Kurir::where('trash','<>','Y')->orWhereNull('trash')->get();
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
        $send['Kurir'] = Kurir::where('trash','<>','Y')->orWhereNull('trash')->get();
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
            // dd($r);
            $nama = (isset($r['nama'])?$r['nama']:'');
            $nama_penerima = (isset($r['nama_penerima'])?$r['nama_penerima']:'');
            $email = (isset($r['email'])?$r['email']:'');
            $no_hp = (isset($r['no_hp'])?$r['no_hp']:'');
            $alamat = (isset($r['alamat'])?$r['alamat']:'');
            $kurir = isset($r['kurir'])?$r['kurir']:null;
            $pajak_kurir = isset($r['nilai_kurir'])?$r['nilai_kurir']:null;
            $flag_kurir = isset($r['kurir'])?'1':'0';
            $id_jenis = intval(isset($r['id_jenis'])?$r['id_jenis']:'');
            $id_jalan = intval(isset($r['id_jalan'])?$r['id_jalan']:'');
            $id_alamat = (isset($r['id_alamat'])?$r['id_alamat']:'');
            $id_pelanggan = (isset($r['id_pelanggan'])?$r['id_pelanggan']:'');
            $tarifwilayah = (isset($r['id_tarifwilayah']) && !empty($r['id_tarifwilayah'])?$r['id_tarifwilayah']:null);
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
                'id_jenis'=>$id_jenis,
                'penerima'=>$nama_penerima,
                'id_tarif_wilayah'=>$tarifwilayah,
                'no_kwitansi'=> $getNextNoKwitansi,
                'id_kurir'=> $kurir,
                'flag_kurir'=> $flag_kurir,
                'pajak_kurir'=> $pajak_kurir,
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
                if (isset($baris['id_addon'])){
                    $total_harga_addon = array_sum($baris['itemharga_addon']);
                }else{
                    $total_harga_addon = 0;
                }
                $dataDetailTransaksi = [
                    'id_transaksi'=> $insertTransaksi->id,
                    'id_menu'=> $id_menu,
                    'harga'=> $harga,
                    'jml'=> $jml,
                    'sub_total'=> ($harga+ $total_harga_addon)*$jml,
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
                if (isset($baris['modifier'])) {
                    $modifier = $baris['modifier'];
                    for ($z=0; $z < count($baris['modifier']) ; $z++) { 
                        $dataDetailAddon = [
                            'id_detail_transaksi'=>$id_dt,
                            'modifier'=>$modifier[$z],
                            'user_input'=>$userinput,
                            'created_at'=>$created_at,
                        ];
                        $insertModifier = Modifier::create($dataDetailAddon);
                    }
                }
                $sub_total = (($harga+$total_harga_addon)*$jml);
                $grandtotal = $grandtotal+$sub_total;
            }
            // dd($id_alamat);
            //update data yang belum terinput
            $insertPelanggan->id_alamat = $id_alamat;
            $insertPelanggan->save();
            $insertTransaksi->total_harga = (($grandtotal+$harga_tarif_wilayah)*1.1)+$pajak_kurir;
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
        // session(['id'=>$insertTransaksi->id]);
        // Auth::logout();
        return redirect("nota/cetaknota/$insertTransaksi->id");
        // return redirect('/all/transaksi')->with('id',$insertTransaksi->id);
        if($return == 'Input Lagi'){
            // return redirect('all/transaksi/tambah')->with('return',$return)->with('id',$insertTransaksi->id);
        }else{
            // return redirect('all/transaksi')->with('return',$return)->with('id',$insertTransaksi->id);
        }
    }

    public function items($jml,$name,$price,$RpSign=true) {
        $rightCols = 10;
        $midCols = 25;
        $leftCols = 3;
        /*if($RpSign) {
            $midCols = $midCols / 2 - $rightCols / 2;
        }*/

        // $vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
        // $name = str_replace($vowels, "", $name);
        // if(strlen($name)>17){
        //     $name = substr($name, 0, 17);
        // }

        $left = str_pad($jml, $leftCols) ;
        $mid = str_pad($name, $midCols) ;
        
        
        $sign = ($RpSign ? 'Rp ' : '');
        $right = str_pad($sign.$price, $rightCols, ' ', STR_PAD_LEFT);
        return "\n$left$mid$right";
    }
    public function addonDanModifier($nama = '') {
        $rightCols = 5;
        $midCols = 28;
        $leftCols = 5;
        
        /*$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
        $nama = str_replace($vowels, "", $nama);
        if(strlen($nama)>17){
            $nama = substr($nama, 0, 17);
        }*/

        $left = str_pad('', $leftCols) ;
        $mid = str_pad($nama, $midCols) ;
        
        $right = str_pad(' ', $rightCols, ' ', STR_PAD_LEFT);

        return "\n$left$mid$right";
    }
    public function footerKwitansi($nama = '', $value='') {
        $rightCols = 24;
        $leftCols = 14;
        
        $left = str_pad($nama, $leftCols, ' ', STR_PAD_LEFT);
        $right = str_pad($value, $rightCols, ' ', STR_PAD_LEFT);

        return "\n$left $right";
    }
    public function printReceipt($id=0){
        $Transaksi = Transaksi::with('Pelanggan')->with('Alamat')->where('id',$id)->get();
        $DetailTransaksi = DetailTransaksi::with('Menu')->with('addons')->with('modifier')->where('id_transaksi',$id)->get();
        $operator = empty($Transaksi[0]->userinput->name)?'':$Transaksi[0]->userinput->name;
        // Enter the share name for your USB printer here
        //$connector = "POS-58";
        //$connector = new WindowsPrintConnector("POS-58");
        $connector = new WindowsPrintConnector("COM3");
        /* Print a "Hello world" receipt" */
        $printer = new Printer($connector);
        /* Name of shop */
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->setFont(Printer::FONT_A);
        // $printer->setTextSize(1,1);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setEmphasis(true);
        $printer->setPrintLeftMargin(0);
        $printer->text("Nanamia Pizzeria\n");
        $printer->feed();
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->setFont(Printer::FONT_C);
        // $printer->setTextSize(1,1);
        // $printer->text("Traditional Pizza for Modern People\n");
        $printer->feed();
        //Informasi Alamat
        $printer->text("\n".env('APP_ALAMAT_BARIS1', "Jl. Mozes Gatotkaca B 9 - 17,"));
        $printer->text("\n".env('APP_ALAMAT_BARIS2', "Gejayan, Yogyakarta"));
        $printer->text("\n".env('APP_ALAMAT_BARIS3', "0274 - 556494 / 549090"));
        $printer->text("\nOP : $operator");
        //Informasi transaksi
        $printer->feed();

        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->setTextSize(1,1);
        $printer->setEmphasis(true);
        $printer->text("\nInvoice  : ".$Transaksi[0]->no_kwitansi);
        $printer->text("\nCreated  : ".date('H.i'));
        $printer->text("\nPemesan  : ".$Transaksi[0]->pelanggan->nama);
        $printer->text("\nPenerima : ".$Transaksi[0]->penerima);
        if(empty($Transaksi[0]->id_kurir)){
            $printer->text("\nNo.Hp    : ".$Transaksi[0]->Pelanggan->no_hp);
            $printer->text("\nArea     : ".$Transaksi[0]->TarifWilayah->nama);
            $printer->text("\nAlamat   : ".$Transaksi[0]->alamat->alamat);
        }
        $printer->feed();
        $i=0;
        
        $printer->selectPrintMode(Printer::MODE_FONT_B);
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->setTextSize(1,1);
        $printer->setEmphasis(true);
        $total_yang_dipesan = 0;
        foreach ($DetailTransaksi as $val) {
            $totalAddons=0; $iii=0;
            foreach ($DetailTransaksi[$i]->addons as $value){
                $totalAddons = $value->harga+$totalAddons; $iii++;
            }
            $totalModifier=0; $iii=0;
            foreach ($DetailTransaksi[$i]->modifier as $value){
                $totalModifier = $value->harga+$totalModifier; $iii++;
            }

            $printer->text($this->items($val['jml'],$val['menu']->nama_menu,nominalKoma($val['sub_total'],false)));
            $total_yang_dipesan += $val['jml'];
            $totalAddons=0; $iii=0;
            foreach ($DetailTransaksi[$i]->addons as $value){
                if($iii==0){
                    $printer->text("\n".str_pad('#Addon', 32));
                }
                $printer->text($this->addonDanModifier($value->Addons->nama.'- Rp'.$value->Addons->harga));
                $totalAddons = $value->harga+$totalAddons; $iii++;
            }
            $totalModifier=0; $iii=0;
            foreach ($DetailTransaksi[$i]->modifier as $value){
                if($iii==0){
                    $printer->text("\n".str_pad('#Modifier', 32));
                }
                $printer->text($this->addonDanModifier($value->modifier));
                $totalModifier = $value->harga+$totalModifier; $iii++;
            }

            $i++;
        }
        $printer->feed(); 
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->setEmphasis(true);

        $printer->text($this->footerKwitansi('Subtotal',nominalKoma($Transaksi[0]->total_harga-$Transaksi[0]->ppn-$Transaksi[0]->pajak_kurir, true)));
        $printer->text($this->footerKwitansi('Total Pesanan',$total_yang_dipesan));
        $printer->text($this->footerKwitansi('PPN/Gov Tax 10%','Rp '.nominalKoma($Transaksi[0]->ppn,false)));
        $printer->text($this->footerKwitansi('Tarif Wilayah',nominalKoma($Transaksi[0]->tarif_wilayah,true)));
        $printer->text($this->footerKwitansi('Tax Away Charge',nominalKoma($Transaksi[0]->pajak_kurir,true)));
        $printer->text($this->footerKwitansi('Total',nominalKoma($Transaksi[0]->total_harga, true)));
        
        $printer->feed(); 

        /* Cut the receipt and open the cash drawer */
        $printer->cut();
        $printer->pulse();
        /* Close printer */
        $printer->close();
    }

    public function cetakNota(Request $request, $id=0)
    {
        $sendNota['Transaksi'] = Transaksi::with('Pelanggan')->with('Alamat')->where('id',$id)->get();
        $sendNota['DetailTransaksi'] = DetailTransaksi::with('Menu')->with('addons')->with('modifier')->where('id_transaksi',$id)->get();
        try {
            if($sendNota['Transaksi'][0]['flag_kurir']==1){
                for ($i=0; $i < 3; $i++) { 
                    $this->printReceipt($id);
                }
                return redirect('/');
                // return $this->printReceipt($id);
                // return $this->pdfPrint($sendNota);
            }else{
                /*for ($i=0; $i < 1; $i++) { 
                }*/
                 $this->printReceipt($id);
                return redirect('/');
                // return $this->pdfPrint($sendNota);
            }
        } catch (Exception $e) {
            // $message = "Couldn't print to this printer: " . $e->getMessage() . "\n";
            // return false;
        }

        // $DT = DetailTransaksi::with('addons')->with('modifier')->where('id_transaksi',$id)->get();
        // $modifier = DetailTransaksi::with('modifier')->where('id_transaksi',$id)->get();
        
        // return redirect('all/transaksi');
    }
    public function pdfPrint($sendNota){
        $jml_modifier= 0;
        $jml_addon= 0;
        $jml=0;
        for ($i=0; $i < count($sendNota['DetailTransaksi']); $i++) { 
            $jml_modifier = $jml_modifier+count($sendNota['DetailTransaksi'][$i]->modifier)*15;
            $jml_addon = $jml_addon+count($sendNota['DetailTransaksi'][$i]->addons)*15;
            $jml = $jml+$jml_modifier+$jml_addon+45+10+2;
        }
        // $jml_baris = count($sendNota['DetailTransaksi'])*56;
        // $jml_modifier= $jml_modifier*15;
        // $jml_addon= $jml_addon*15;

        $height = 230+$jml+2;
        $width = PDF::loadView('all::Transaksi.kwitansi', $sendNota)->getDomPDF()->getCanvas()->get_width();
        $namafile = "D:\NOTA\Transaksi".$sendNota['Transaksi'][0]->no_kwitansi.".pdf";
        $pdf= PDF::loadView('all::Transaksi.kwitansi', $sendNota);
        $pdf = $pdf->setPaper(array(20,20,150,$height),'portrait')->setWarnings(false)->save($namafile);
        return $pdf->download($namafile);
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
        $send['Kurir']=Kurir::where('trash','<>','Y')->orWhereNull('trash')->get();
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
            $nama                   = (isset($r['nama'])?$r['nama']:'');
            $nama_penerima          = (isset($r['nama_penerima'])?$r['nama_penerima']:'');
            $email                  = (isset($r['email'])?$r['email']:'');
            $no_hp                  = (isset($r['no_hp'])?$r['no_hp']:'');
            $alamat                 = (isset($r['alamat'])?$r['alamat']:'');
            $id_transaksi           = (isset($r['id_transaksi'])?$r['id_transaksi']:'');
            $id_jalan               = intval(isset($r['id_jalan'])?$r['id_jalan']:'');
            $id_alamat              = (isset($r['id_alamat'])?$r['id_alamat']:'');
            $id_pelanggan           = (isset($r['id_pelanggan'])?$r['id_pelanggan']:'');
            $tarifwilayah           = (isset($r['id_tarifwilayah']) && !empty($r['id_tarifwilayah'])?$r['id_tarifwilayah']:null);
            $harga_tarif_wilayah    = (isset($r['harga_tarif_wilayah'])?$r['harga_tarif_wilayah']:'');
            $kurir                  = isset($r['kurir'])?$r['kurir']:null;
            $pajak_kurir            = isset($r['nilai_kurir'])?$r['nilai_kurir']:null;
            $flag_kurir             = isset($r['kurir'])?'1':'0';
            $user_update            = Auth::user()->id;
            $created_at             = date('Y-m-d');
            $id_jenis               = intval(isset($r['id_jenis'])?$r['id_jenis']:'');
            $id_jalan               = intval(isset($r['id_jalan'])?$r['id_jalan']:'');
            $dataTransaksi = [
                'id_alamat'=>$id_alamat,
                'penerima'=> $nama_penerima,
                'id_tarif_wilayah'=>$tarifwilayah,
                'id_kurir'=>$kurir,
                'id_jalan'=>$id_jalan,
                'id_jenis'=>$id_jenis,
                'pajak_kurir'=>$pajak_kurir,
                'flag_kurir'=>$flag_kurir,
                'user_update'=>$user_update,
                'updated_at'=>date('Y-m-d'),
            ];
            $insertTransaksi = Transaksi::find($id_transaksi);
            $insertTransaksi->update($dataTransaksi);
            $grandtotal = 0;
            DetailTransaksi::where('id_transaksi',$id_transaksi)->delete();
            // dd($r['baris_4']['jml']);
            for($i=0;$i<count($r['count_menu']);$i++){
                $nama_baris = $r['count_menu'][$i];
                $baris = $r[$nama_baris];
                $id_detail_transaksi = (isset($baris['id_detail_transaksi'])?$baris['id_detail_transaksi']:'');
                $id_menu = (isset($baris['id_menu'])?$baris['id_menu']:'');
                $harga = ListMenu::select('harga')->where('id',$id_menu)->whereNull('trash')->get()[0]->harga;;
                $jml = (isset($baris['jml'])?$baris['jml']:0); 
                $keterangan = (isset($baris['keterangan'])?$baris['keterangan']:''); 
                if (isset($baris['id_addon'])){
                    $total_harga_addon = array_sum($baris['itemharga_addon']);
                }else{
                    $total_harga_addon = 0;
                }
                $dataDetailTransaksi = [
                    'id_transaksi'=> $id_transaksi,
                    'id_menu'=> $id_menu,
                    'harga'=> $harga,
                    'jml'=> $jml,
                    'sub_total'=> ($harga+$total_harga_addon)*$jml,
                    'keterangan'=> $keterangan,
                    'user_input'=>$user_update,
                    'user_update'=>$user_update,
                    'created_at'=>$created_at,
                ];
                $insertDetailTransaksi = DetailTransaksi::create($dataDetailTransaksi);
                $id_dt = $insertDetailTransaksi->id;
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
                Modifier::where('id_detail_transaksi',$id_dt)->delete();
                if (isset($baris['modifier'])) {
                    $modifier = $baris['modifier'];
                    for ($z=0; $z < count($baris['modifier']) ; $z++) { 
                        $dataDetailAddon = [
                            'id_detail_transaksi'=>$id_dt,
                            'modifier'=>$modifier[$z],
                            'user_input'=>$user_update,
                            'created_at'=>$created_at,
                        ];
                        $insertModifier[] = Modifier::create($dataDetailAddon);
                    }
                }
                $sub_total = (($harga+$total_harga_addon)*$jml);
                $grandtotal = $grandtotal+$sub_total;
            }
            //update data yang belum terinput
            $insertTransaksi->total_harga = (($grandtotal+$harga_tarif_wilayah)*1.1)+$pajak_kurir;
            $insertTransaksi->ppn = ($grandtotal+$harga_tarif_wilayah)*0.1;
            $insertTransaksi->tarif_wilayah = $harga_tarif_wilayah;
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
        // session(['id'=>$insertTransaksi->id]);
        
        // Auth::logout();
        // dd($insertTransaksi->id);
        // return redirect('/logouts')->with('id',$insertTransaksi->id);
        return redirect("nota/cetaknota/$insertTransaksi->id");
        return redirect("all/transaksi")->with('return',$return)->with('id',$insertTransaksi->id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
          $T = Transaksi::find($id);
          $T->trash='Y';
          $T->save();
          $DT = DetailTransaksi::where('id_transaksi',$id)->update(['trash'=>'Y']);
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
        $search=\Request::input('search',null);
        $columns=\Request::input('columns',null);
        $from=\Request::get('from',null);
        $laporan=\Request::get('laporan',null);
        $from=Carbon::createFromFormat('d-m-Y', $from);
        $from=$from->format('Y-m-d');
        $to=\Request::get('to',null);
        $to=Carbon::createFromFormat('d-m-Y', $to);
        $to=$to->format('Y-m-d');
        $dataList = Transaksi::select('transaksis.*','pelanggans.no_hp')->join('pelanggans','pelanggans.id','transaksis.id_pelanggan')->with('DetailTransaksi')->where('transaksis.created_at','>=',$from." 00:00:00")->where('transaksis.created_at','<=',$to." 23:59:59")->whereNull('transaksis.trash');
        if(!empty($search['value'])&&isset($search)&&$search['value']!=''){
            foreach ($columns as $value) {
                if ($value['searchable']=='true') {
                    $dataList=$dataList->where($value['name'],'like','%'.$search['value'].'%');
                }
            }
        }
        $dataList=$dataList->orderBy('transaksis.created_at','desc');
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
          if(empty($data->id_kurir)){
              $content .= '<a class="btn btn-primary btn-sm m-1" href="'.url("all/transaksi/create-from/$data->id_pelanggan").'"><i class="fa fa-pencil-square-o"></i> Order</a>';
          }
          $content .= '<button class="btn btn-danger btn-sm m-1" onclick="deleteData('.$data->id.');"><i class="fa fa-pencil-square-o"></i>delete</button>';
          return $content;
        }
          return '';
        })
        ->addColumn('alamat',function($data){
          return $data->Alamat->alamat;
        })
        ->addColumn('pesanan',function($data){
          $lm = DetailTransaksi::with('menu')->where('id_transaksi',$data->id); 
          $content = '';
          $lm = $lm->get();
          for ($i=0; $i < count($lm); $i++) { 
            $val = $lm[$i]->menu['nama_menu'];
            $val2 = $lm[$i]->menu->kategori->satuan->satuan;
              $content .= '<label class="label-default">'.($i+1).'. '.$val.'</label><br>'; 
          }
          return $content;
        })
        ->addColumn('tgl_pesan',function($data){
          return $data->created_at;
        })
        ->addColumn('penerima',function($data){
          return $data->penerima;
        })
        ->addColumn('total',function($data){
            $nominal = nominalKoma($data->total_harga,true);
          return $nominal;
        })
        /*->addColumn('no_hp',function($data){
          return $data->Pelanggan->no_hp;
        })*/
        ->addColumn('pegawai',function($data){
          return $data->userinput->name;
        })
        ->addColumn('kurir',function($data){
          return empty($data->Kurir->nama)?'Nanamia':$data->Kurir->nama;
        })
        ->addColumn('modifier',function($data){
            $lm = DetailTransaksi::where('id_transaksi',$data->id); 
            $content = '';
            $lm = $lm->get();
            for ($i=0; $i < count($lm); $i++) { 
                $md = Modifier::where('id_detail_transaksi',$lm[$i]['id'])->get();
                for ($ii=0; $ii < count($md); $ii++) { 
                    $val = $md[$ii]->modifier;
                    $content .= '<label class="label-default">'.($ii+1).'. '.$val.'</label><br>'; 
                }
            }
            return $content;
        })
        ->addColumn('addon',function($data){
           $lm = DetailTransaksi::where('id_transaksi',$data->id); 
            $content = '';
            $lm = $lm->get();
            for ($i=0; $i < count($lm); $i++) { 
                $md = DetailAddOn::where('id_detail_transaksi',$lm[$i]['id'])->get();
                for ($ii=0; $ii < count($md); $ii++) { 
                    $val = $md[$ii]->Addons;
                    $content .= '<label class="label-default">'.($ii+1).'. '.$val->nama.'</label><br>'; 
                }
            }
            return $content;
        })
        ->rawColumns(['pesanan','action','modifier','addon'])
        ->make(true);
    }

    public function loadDataLaporan()
    {
        $GLOBALS['no']=\Request::input('start',1);
        $skip= \Request::input('start',1);
        $GLOBALS['length']=\Request::input('length',1);
        // $skip = $skip-($skip>9?$GLOBALS['length']:0);
        $from=\Request::get('from',null);
        $from=Carbon::createFromFormat('d-m-Y', $from)->format('Y-m-d');
        $to=\Request::get('to',null);
        $to=Carbon::createFromFormat('d-m-Y', $to)->format('Y-m-d');

        $satuan = Satuan::select('id','satuan')->get()->toArray();
        $total_record =count(Transaksi::select('*')->with('DetailTransaksi')->where('created_at','>=',$from." 00:00:00")->where('created_at','<=',$to." 23:59:59")->whereNull('trash')->get()->toArray());
        $dataTransaksi = Transaksi::select('*')->with('DetailTransaksi')->where('created_at','>=',$from." 00:00:00")->where('created_at','<=',$to." 23:59:59")->whereNull('trash')->skip($skip)->limit($GLOBALS['length'])->get();
        // dd($dataTransaksi);
        $dataList = new Collection;
        // dd(count($dataTransaksi->toArray()));
        for ($i=0; $i < $skip+count($dataTransaksi->toArray()); $i++) {
            if ($i<$skip) {
                $columnPerTransaksi = [
                    'nama'=>'',
                    'nomor'=>'',
                    'no_hp'=>'',
                    'penerima'=>'',
                    'pesanan'=>'',
                    'total'=>'',
                    'tgl_pesan'=>'',
                    'alamat'=>'',
                    'pegawai'=>'',
                    'addon'=>'',
                    'modifier'=>'',
                ];
                for ($a=0; $a < count($satuan); $a++) {
                    $jmlsatuan = 0;
                    
                    $columnPerTransaksi[$satuan[$a]['satuan']] = $jmlsatuan;
                }
                $dataList->push($columnPerTransaksi);
            }else{
                $detail_transaksi = $dataTransaksi[$i-$skip]->DetailTransaksi;
                $pesanan='';
                $modifier='';
                for ($x=0; $x < count($detail_transaksi); $x++){
                    $pesanan .= ($x+1).'. '.$detail_transaksi[$x]->menu->nama_menu.'<br>';
                    $addon = '';
                    $lm = $detail_transaksi;
                    // for ($xi=0; $xi < count($lm); $xi++) { 
                        $md = DetailAddOn::where('id_detail_transaksi',$lm[$x]['id'])->get();
                        if(count($md)>0){
                            for ($ii=0; $ii < count($md); $ii++) {
                                $val = $md[$ii]->Addons;
                                $addon .= 'Rp. <label class="label-default">'.$x.'('.($ii+1).'). '.$val->nama.'</label><br>'; 
                            }
                        }
                        $md2 = Modifier::where('id_detail_transaksi',$lm[$x]['id'])->get();
                        if(count($md2)>0){
                            for ($ii=0; $ii < count($md2); $ii++) { 
                                $val2 = $md2[$ii]->modifier;
                                $modifier .= '<label class="label-default">'.$x.'('.($ii+1).'). '.$val2.'</label><br>'; 
                            }
                        }
                    // }
                }
                $columnPerTransaksi = [
                    'nama'=> $dataTransaksi[$i-$skip]->Pelanggan->nama,
                    'nomor'=> $i+1 ,
                    'no_hp'=> $dataTransaksi[$i-$skip]->Pelanggan->no_hp ,
                    'penerima'=> $dataTransaksi[$i-$skip]->penerima ,
                    'pesanan'=> $pesanan ,
                    'total'=> '<div class="pull-right">'.$dataTransaksi[$i-$skip]->total_harga."</div>",
                    'tgl_pesan'=> Carbon::createFromFormat('Y-m-d H:i:s',$dataTransaksi[$i-$skip]->created_at)->format('d M Y'),
                    'alamat'=> $dataTransaksi[$i-$skip]->Alamat->alamat,
                    'pegawai'=> $dataTransaksi[$i-$skip]->userinput->name,
                    'addon'=> $addon ,
                    'modifier'=> $modifier
                ];
                for ($a=0; $a < count($satuan); $a++) {
                    $jmlsatuan = 0;
                    for ($x=0; $x < count($detail_transaksi); $x++){
                        if($satuan[$a]['id'] == $detail_transaksi[$x]->menu->id_satuan){
                            $jmlsatuan=$jmlsatuan+1;
                        }
                    }
                    $columnPerTransaksi[$satuan[$a]['satuan']] = $jmlsatuan;
                }
                $dataList->push($columnPerTransaksi);
            }
        }
        // dd($dataList);
        return Datatables::of($dataList)
        
        ->addColumn('kurir',function($data){
          return empty($data->Kurir->nama)?'Nanamia':$data->Kurir->nama;
        })
        ->rawColumns(['pesanan','action','modifier','addon','total'])
        ->setTotalRecords($total_record)
        ->make(true);
    }
    public function excel(Request $request){
        $from=$request->get('from',null);
        $from=Carbon::createFromFormat('d-m-Y',$from)->format('Y-m-d');
        $to=$request->get('to',null);
        $to=Carbon::createFromFormat('d-m-Y', $to)->format('Y-m-d');
        
        return Excel::download(new ExportlaporanController($from, $to), 'laporan'.$from.'-'.$to.'.xlsx');
    }
}
