
<style>
.invoice-box {
    max-width: 800px;
    margin: auto;
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
    transform: scale(0.70);
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

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <!-- <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <!--{{-- <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;"> --}}--
                        </td>
                        
                        <td>
                            Invoice :  {{ $Transaksi[0]->no_kwitansi }}<br>
                            Created : {{ date('d F Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
         -->
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <address>
                                <strong>NanamiaPizza.com</strong>
                                <br>
                                Jl. MOSES GATOTKACA B9-17
                                <br>
                                Yogyakarta
                                <br>
                                <abbr>Phone :</abbr> (0274) 556-494
                            </address>
                        </td>
                        <td>
                            Invoice :  {{ $Transaksi[0]->no_kwitansi }}<br>
                            Created : {{ date('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">
                            <h3>Pesanan A.N : {{ $Transaksi[0]->pelanggan->nama }}</h3>
                        </td>   
                    </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <tr class="heading">
                        <td width="50%">
                            Nama Menu
                        </td>
                        <td>
                            Qty
                        </td>
                        <td width="20%">
                            Harga
                        </td>
                        <td width="20%">
                            Subtotal
                        </td>
                    </tr>
                    @foreach ($DetailTransaksi as $val)
                    <tr class="item">
                        <td>
                            <em>{{ $val['menu']->nama_menu }}</em>
                        </td>
                        <td>
                            {{ $val['jml'] }}
                        </td>
                        <td align="right">
                            {{ nominalKoma($val['harga'],true) }}
                        </td>
                        <td align="right">
                            {{ nominalKoma($val['sub_total'],true) }}
                        </td>
                    </tr>
                    @endforeach
                    <tr class="item last">
                        <td colspan="3" align="right">
                            Tax
                        </td>
                        
                        <td>
                            $10.00
                        </td>
                    </tr>
                    
                    <tr class="total">
                        <td colspan="3"></td>
                        
                        <td>
                           Total: $385.00
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
    </table>
</div>