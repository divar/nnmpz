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
?>