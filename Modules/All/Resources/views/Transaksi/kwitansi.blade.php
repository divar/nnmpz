<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
    .invoice-box {
        width: 310px;
        margin: auto;
        margin-top: 0;
        font-size: 11px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        transform: scale(0.514);
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

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
        /*width: 30px;*/
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
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

    @media only screen and (max-width: 600px) {
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
</style>
</head>
<body style="margin-top: -35px;">   
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="information"> 
                    <td colspan="2" align="center">
                            <strong>NanamiaPizza.com</strong><br>
                        <code>
                            Jl. MOSES GATOTKACA B9-17
                            Yogyakarta
                            <abbr>Phone :</abbr> (0274) 556-494
                        </code>
                    </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <kbd>
                        Invoice :  {{ $Transaksi[0]->no_kwitansi }}<br>
                        Created : {{ date(  'd F Y') }}<br>
                        Penerima : {{ $Transaksi[0]->penerima }}
                    </kbd>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <STRONG>Pesanan A.N : {{ $Transaksi[0]->pelanggan->nama }}</STRONG>
                </td>   
            </tr>
            <tr>
                <td colspan="2">
                    <table>
                        <tr class="heading">
                            <td width="35%">
                                Nama Menu
                            </td>
                            <td width="5%">
                                Qty
                            </td>
                            <td width="30%">
                                Harga
                            </td>
                            <td width="30%">
                                Subtotal
                            </td>
                        </tr>
                        {!! $i=0 !!}
                        @foreach ($DetailTransaksi as $val)
                        <tr class="item">
                            <td>
                                <em>{{ $val['menu']->nama_menu }}</em>
                                <kbd>#Addon</kbd>
                                <?php $totalModifier=0; $iii=0;?>
                                    <ul style="padding-left: 15px;margin-top:0px; font-size: 11px;">
                                    @foreach ($DetailTransaksi[$i]->addons as $value)
                                        <li><code>{{ $value->Addons->nama }}</code></li>
                                    <?php $totalModifier = $value->harga+$totalModifier; $iii++?>
                                    </ul>
                                @endforeach
                                <kbd>#Modifier</kbd>
                                <?php $totalModifier=0; $iii=0;?>
                                    <ul style="padding-left: 15px;margin-top:0px; font-size: 11px;">
                                    @foreach ($DetailTransaksi[$i]->modifier as $value)
                                        <li><code>{{ $value->modifier }}</code></li>
                                    <?php $totalModifier = $value->harga+$totalModifier; $iii++?>
                                @endforeach
                                    </ul>
                            </td>
                            <td>
                                {{ $val['jml'] }}
                            </td>
                            <td align="right">
                                {{ nominalKoma($val['harga'],true) }}
                                <br><kbd>&nbsp;</kbd>
                                <?php $totalModifier=0; $iii=0;?>
                                <ul style="padding-left: 15px;margin-top:0px; font-size: 11px;">
                                    @foreach ($DetailTransaksi[$i]->addons as $value)
                                    {{-- <li><code>{{ $value->harga }}</code></li> --}}
                                    <?php $totalModifier = $value->harga+$totalModifier; $iii++?>
                                    @endforeach
                                    <li>{{ nominalKoma($totalModifier,true) }}</li>
                                </ul>
                            </td>
                            <td align="right">
                                {{ nominalKoma($val['sub_total']+$totalModifier,true) }}
                            </td>
                        </tr>
                        {!! $i++ !!}
                        @endforeach
                        <tr class="item last">
                            <td colspan="3" align="right">
                                Tax
                            </td>

                            <td>
                                {{ nominalKoma($Transaksi[0]->ppn,true) }}
                            </td>
                        </tr>
                        <tr class="item last">
                            <td colspan="3" align="right">
                                Tarif Antar
                            </td>

                            <td>
                                {{ nominalKoma($Transaksi[0]->tarif_wilayah,true) }}
                            </td>
                        </tr>

                        <tr class="total">
                            <td colspan="3"></td>

                            <td>
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