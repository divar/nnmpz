<?php

namespace Modules\All\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
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
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportlaporanController implements FromCollection,ShouldAutoSize,WithHeadings
{
    private $from;
    private $to;
 
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    public function collection(){
        $satuan = Satuan::select('id','satuan')->get()->toArray();
        $dataTransaksi = Transaksi::select('*')->with('DetailTransaksi')->where('created_at','>=',$this->from." 00:00:00")->where('created_at','<=',$this->to." 23:59:59")->whereNull('trash')->get();
        $dataList = new Collection;
        // dd(count($dataTransaksi->toArray()));
        for ($i=0; $i < count($dataTransaksi->toArray()); $i++) {
            $detail_transaksi = $dataTransaksi[$i]->DetailTransaksi;
            $pesanan='';
            $modifier='';
            for ($x=0; $x < count($detail_transaksi); $x++){
                $pesanan .= ($x+1).'. '.$detail_transaksi[$x]->menu->nama_menu."\n";
                $addon = '';
                $lm = $detail_transaksi;
                // for ($xi=0; $xi < count($lm); $xi++) { 
                    $md = DetailAddOn::where('id_detail_transaksi',$lm[$x]['id'])->get();
                    if(count($md)>0){
                        for ($ii=0; $ii < count($md); $ii++) {
                            $val = $md[$ii]->Addons;
                            $addon .= 'Rp '.$x.'('.($ii+1).'). '.$val->nama."\n"; 
                        }
                    }
                    $md2 = Modifier::where('id_detail_transaksi',$lm[$x]['id'])->get();
                    if(count($md2)>0){
                        for ($ii=0; $ii < count($md2); $ii++) { 
                            $val2 = $md2[$ii]->modifier;
                            $modifier .= $x.'('.($ii+1).'). '.$val2."\n"; 
                        }
                    }
                // }
            }
            $columnPerTransaksi = [
                'nomor'=> $i+1 ,
                'nama'=> $dataTransaksi[$i]->Pelanggan->nama,
                'no_hp'=> $dataTransaksi[$i]->Pelanggan->no_hp ,
                'penerima'=> $dataTransaksi[$i]->penerima ,
                'pesanan'=> $pesanan ,
                'total'=> $dataTransaksi[$i]->total_harga,
                'tgl_pesan'=> Carbon::createFromFormat('Y-m-d H:i:s',$dataTransaksi[$i]->created_at)->format('d M Y'),
                'alamat'=> $dataTransaksi[$i]->Alamat->alamat,
                'pegawai'=> $dataTransaksi[$i]->userinput->name,
                'addon'=> $addon ,
                'modifier'=> $modifier,
                'kurir'=>!empty($dataTransaksi[$i]->id_kurir)?$dataTransaksi[$i]->Kurir->nama:'Nanamia'
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
        return $dataList;
    }
    public function headings(): array
    {
        $column = [
            '#',
            'Date',
            'nomor',
            'nama',
            'no_hp',
            'penerima',
            'pesanan',
            'total',
            'tgl_pesan',
            'alamat',
            'pegawai',
            'addon',
            'modifier',
            'kurir',
        ];
        $satuan = Satuan::select('id','satuan')->get()->toArray();
        for ($a=0; $a < count($satuan); $a++) {
            array_push($column, $satuan[$a]['satuan'] );
        }
        return $column;
    }
}
