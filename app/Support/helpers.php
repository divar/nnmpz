<?php 
function nominal($nominal,$withRp=true){
    $rupiah = number_format($nominal, 0, ",", ".");
    if($withRp)
        $rupiah = "Rp " . $rupiah . ",-";
    return $rupiah;
}
function rupiahTanpaKoma($nominal,$withRp=true){
    $rupiah = number_format($nominal, 0, ",", ".");
    if($withRp)
        $rupiah = "Rp " . $rupiah ;
    return $rupiah;
}

function nominalKoma($nominal,$withRp=true){
        $pecah = explode('.',$nominal);
        if (empty($pecah[1])) {
            $rupiah = number_format($nominal, 0, ",", ".");
        }else {
            $rupiah = number_format($nominal, 2, ",", ".");
        }
    if($withRp)
        $rupiah = "Rp " . $rupiah ;
    return $rupiah;
}
function currencyToNumber($a){
    $b=str_replace(".", "", $a);
    return str_replace(",",".",$b);
}
function getNextNoKwitansi(){
    $temp = \Carbon\Carbon::createFromFormat('Y-m-d', date("Y-m-d"));
    $tgl_no_urut = $temp->format('dmY');

    $initial_no_seri = 'TR';

    $base_no_seri = strtoupper($initial_no_seri);
    $base_no_seri = $base_no_seri.$tgl_no_urut."-";

    $last_no_data = \DB::table('transaksis')->where('no_kwitansi', 'like', "%$base_no_seri%")->orderBy('created_at', 'desc')->first();

    if(isset($last_no_data->no_kwitansi) && !empty($last_no_data->no_kwitansi)){
        $last_no = $last_no_data->no_kwitansi;
        $int_last_no = substr($last_no, -3);
        $max_lengnth_no = strlen($int_last_no);
        //dd($int_last_no);
        // $next_no = $int_last_no+1;
        $int_last_no++;
        $next_no = $int_last_no;
        $diff_lengnth_no = $max_lengnth_no - strlen($next_no);
        $char_tambahan = '';
        for ($x = 1; $x <= $diff_lengnth_no; $x++) {
            $char_tambahan .='0';
        }
        $next_no =  $char_tambahan.$next_no;
        $next_no_seri = $base_no_seri.$next_no;

    }else{
        $next_no_seri = $base_no_seri.'001';
    }
    // dd($next_no_appointment);
    return $next_no_seri;
}
?>