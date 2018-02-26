<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
    .invoice-box {
        width: 130px;
        margin-right: 0px;
        margin-left: -4px;
        padding-right: -10px;
        padding-left: -10px;
        margin-top: 0;
        font-size: 6px;
        /*line-height: 15px;*/
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        /*transform: scale(0.514);*/
        position: absolute;
        transform-origin: 0 0;
    }

    .invoice-box table {
        width: 100%;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(1) {
        /*text-align: right;*/
        /*width: 4%;*/
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 6px;
        line-height: 20px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 100px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    @media section-to-print{
        position: absolute;
        left: 0;
        top: 0;
        width: 10px;
    }
</style>
</head>
<body style="margin-top: -35px;">   
    <div class="invoice-box" id="section-to-print">
        <table cellpadding="0" cellspacing="0" >
            <tr class="information"> 
                    <td colspan="2" align="center">
                        <center><strong>{{ config('app.name') }}</strong></center><br>
                        <code>
                            <center><strong>Jl. Mozes Gatotkaca B 9 – 17, Gejayan, Yogyakarta</strong></center>
                            <center><strong>0274 – 556494 / 549090</strong></center>
                            <center><strong>OP : {{ empty($Transaksi[0]->userinput->name)?'':$Transaksi[0]->userinput->name}}</strong></center>
                        </code>
                    </td>
            </tr>
            <tr>
                <td colspan="2">
                    <kbd>
                        <b>Invoice</b> &nbsp;:  {{ $Transaksi[0]->no_kwitansi }}<br>
                        <b>Created</b>  &nbsp;: {{ date(  'd F Y') }}<br>
                        <b>Pemesan</b> &nbsp;: {{ $Transaksi[0]->pelanggan->nama }}<br>
                        <b>Penerima</b> : {{ $Transaksi[0]->penerima }}<br>
                        <b>Alamat</b> &nbsp;&nbsp;: {{ $Transaksi[0]->alamat->alamat }}<br>
                        <b>Area</b> &nbsp;&nbsp;&nbsp;&nbsp;: {{ $Transaksi[0]->TarifWilayah->nama }} ~ {{ $Transaksi[0]->Jalan->nama }} ~ {{ $Transaksi[0]->Jenis->jenis }} 
                    </kbd>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                </td>   
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        {{-- <tr class="heading">
                            <td width="5%">
                                Qty
                            </td>
                            <td width="35%">
                                Nama Menu
                            </td>
                            <td width="30%">
                                Harga
                            </td> 
                            <td width="30%">
                                Subtotal
                            </td>
                        </tr> --}}
                        {!! $i=0 !!}
                        @foreach ($DetailTransaksi as $val)
                        <tr class="item">
                            <td width="3%">
                                {{ $val['jml'] }}
                                <div style="display: none;" align="right">
                                {{ nominalKoma($val['harga'],true) }}
                                <br><kbd>&nbsp;</kbd>
                                <?php $totalModifier=0; $iii=0;?>
                                <ul style="padding-left: 5%;margin-top:0px; font-size: 6px;">
                                    @foreach ($DetailTransaksi[$i]->addons as $value)
                                    {{-- <li><code>{{ $value->harga }}</code></li> --}}
                                    <?php $totalModifier = $value->harga+$totalModifier;$iii++;?>
                                    @endforeach
                                    <li>{{ nominalKoma($totalModifier,true) }}</li>
                                </ul>
                            </div>
                            </td>
                            <td width="50%">
                                <em>{{ $val['menu']->nama_menu }}</em><br>
                                <kbd style="padding-left: 1%;">#Addon</kbd>
                                <?php $totalModifier=0; $iii=0;?>
                                    <ul style="padding-left: 5px;margin-top:0px;margin-bottom:0px; font-size: 6px;">
                                    @foreach ($DetailTransaksi[$i]->addons as $value)
                                        <li style="margin-left: 5px;"><code>{{ $value->Addons->nama }}</code></li>
                                    <?php $totalModifier = $value->harga+$totalModifier; $iii++;?>
                                    @endforeach
                                    </ul>
                                <kbd style="padding-left: 1%;">#Modifier</kbd>
                                <?php $totalModifier=0; $iii=0;?>
                                    <ul style="padding-left: 5px;margin-top:0px;margin-bottom:0px; font-size: 6px;">
                                    @foreach ($DetailTransaksi[$i]->modifier as $value)
                                        <li style="margin-left: 5px;"><code>{{ $value->modifier }}</code></li>
                                    <?php $totalModifier = $value->harga+$totalModifier; $iii++;?>
                                    @endforeach
                                    </ul>
                            </td>
                            
                            
                            <td align="right" width="45%">
                                {{ nominalKoma($val['sub_total']+$totalModifier,true) }}
                            </td>
                        </tr>
                        {!! $i++ !!}
                        @endforeach
                        <tr class="item last">
                            <td colspan="2" align="right">
                                Tax
                            </td>

                            <td align="right">
                                {{ nominalKoma($Transaksi[0]->ppn,true) }}
                            </td>
                        </tr>
                        <tr class="item last">
                            <td colspan="2" align="right">
                                Tarif Antar
                            </td>

                            <td align="right">
                                {{ nominalKoma($Transaksi[0]->tarif_wilayah,true) }}
                            </td>
                        </tr>

                        <tr class="total">
                            <td colspan="2"></td>

                            <td align="right">
                               {{ nominalKoma($Transaksi[0]->total_harga, true) }}
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>

       </table>
    </div>
</body>
</html>