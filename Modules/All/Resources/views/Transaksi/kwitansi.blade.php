@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                </div>
                <div class="container">
    <div id="print-area" class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>NanamiaPizza.com</strong>
                        <br>
                        Jl. MOSES GATOTKACA B9-17
                        <br>
                        Yogyakarta
                        <br>
                        <abbr>Phone :</abbr> (0274) 556-494
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: {{ date('d F Y') }}</em>
                    </p>
                    <p>
                        <em>Receipt #: {{ $Transaksi[0]->no_kwitansi }}</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center"> 
                    <h3>Pesanan A.N : {{ $Transaksi[0]->pelanggan->nama }}</h3>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>QTY</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DetailTransaksi as $val)
                        <tr>
                            <td><em>{{ $val['menu']->nama_menu }}</em></td>
                            <td style="text-align: center"> {{ $val['jml'] }} </td>
                            <td align="right">{{ nominalKoma($val['harga'],true) }}</td>
                            <td align="right">{{ nominalKoma($val['sub_total'],true) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>   </td>
                            <td colspan="2" class="text-right">
                                <p><strong>Subtotal: </strong></p>
                                <p><strong>Tax 10%: </strong></p>
                            </td>
                            <td  align="right">
                            <p>
                                <strong>{{ nominalKoma($Transaksi[0]->total_harga,true) }}</strong>
                            </p>
                            <p>
                                <strong>{{ nominalKoma($Transaksi[0]->ppn,true) }}</strong>
                            </p></td>
                        </tr>
                        <tr>
                            <td colspan="4"  align="right">
                                <div class=" pull-right form-inline">
                                <h4><strong>Total: </strong></h4>
                                <h5><strong class="text-danger">
                                {{ nominalKoma($Transaksi[0]->total_harga+$Transaksi[0]->ppn,true) }}</strong></h5>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div>
                    {{-- <h1 style="text-align:center;">
                        Thank you for your order.
                    </h1>
                     --}}
                </div>
            </div>
        </div>
    </div>
                <div class="clearfix">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#print-area').printArea();
    });
</script>
@endpush
