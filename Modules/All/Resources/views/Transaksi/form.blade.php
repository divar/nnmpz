@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')

@section('sub-content')
<div class="content-wrapper">
<form action="{{ route('postTambahTransaksi') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <H3>Tambah Transaksi</H3>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clearfix">&nbsp;</div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <ul class="nav navbar-nav mr-auto">
                        <li id="tab_dt_pelanggan">
                            <a href="#tab_data_pelanggan" data-toggle="tab" class="nav-link loadtable" from="data_pelanggan" id="tab_data_pelanggan2">Data Pelanggan</a>
                        </li>
                        <li id="tab_menu">
                            <a href="#tab_input_menu" data-toggle="tab" class="nav-link loadtable" from="input_menu" id="tab_menu2">Tab Menu</a>
                        </li>
                    </ul>
                </nav>
                <div class="tab-content">
                    <div class="clearfix">&nbsp;</div>
                    <div class="tab-pane" id="tab_data_pelanggan">
                             <a href="javascript:window.print();">Print</a>
                        <div class="row">
                            <div class="clearfix">&nbsp;</div>
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="nama" class="col-md-3 col-form-label">Nama</label>
                                    <div class="col-md-9">
                                        <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama" required="required">
                                    </div>  
                                </div>
                                <div class="form-group row">
                                    <label for="no_hp" class="col-md-3 col-form-label">No Hp</label>
                                    <div class="col-md-9">
                                        <input id="no_hp" type="text" name="no_hp" class="form-control" placeholder="0821xxxxxx" required="required">
                                    </div>  
                                </div>
                                <div class="form-group d-none row">
                                    <label for="email" class="col-md-3 col-form-label">E-mail</label>
                                    <div class="col-md-9">
                                        <input id="email" type="email" name="email" class="form-control" placeholder="nanamia@nanamiapizza.com">
                                    </div>  
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-md-3 col-form-label">Alamat</label>
                                    <div class="col-md-9">
                                        <textarea id="alamat" class="form-control" name="alamat">
                                            
                                        </textarea>
                                    </div>  
                                </div>
                                <div class="form-group d-none row">
                                    <label for="kabupaten" class="col-md-3 col-form-label">Kabupaten</label>
                                    <div class="col-md-9">
                                        <select id="kabupaten" name="kabupaten" class="form-control daerahOption custom-select">
                                          <option selected>Kabupaten</option>
                                          @foreach ($kabupaten['cities'] as $data)
                                            <option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                          @endforeach
                                        </select>
                                    </div>  
                                </div>
                                <div class="form-group d-none row">
                                    <label for="kecamatan" class="col-md-3 col-form-label">Kecamatan</label>
                                    <div class="col-md-9">
                                        <select id="kecamatan" name="kecamatan" class="form-control daerahOption custom-select" disabled="disabled">
                                          <option selected>Kecamatan</option>
                                        </select>
                                    </div>  
                                </div>
                                <div class="form-group d-none row">
                                    <label for="kelurahan" class="col-md-3 col-form-label">Kelurahan</label>
                                    <div class="col-md-9">
                                        <select id="kelurahan" name="kelurahan" class="form-control daerahOption custom-select" disabled="disabled">
                                          <option selected>Kelurahan</option>
                                          <option value="1">One</option>
                                        </select>
                                    </div>  
                                </div>
                                <input type="hidden" name="provinsi" value="yogyakarta">
                                <input type="hidden" name="id_provinsi" value="34">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_input_menu">
                        <div class="clearfix">&nbsp;</div>
                        <button id="add_menu" type="button" class="btn btn-xs btn-success tambah_layanan" tujuan="detail-fisioterapi-table" from="fisioterapi"> <span title="tambah" class="glyphicon glyphicon-plus">Tambah Menu</span></button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="menu-table">
                                <thead>
                                  <tr>
                                      <td width="5%" align="middle"><h5>#</h5></td>
                                      <td width="35%" align="center"><h5>Nama Menu</h5></td>
                                      <td width="25%" align="center"><h5>Harga</h5></td>
                                      <td width="10%" align="center"><h5>Jumlah</h5></td>
                                      <td width="25%" align="center"><h5>total</h5></td>
                                  </tr>
                                </thead>
                                <tbody id="detail-data-table">
                                    <tr class="data_menu" id="data_ke-0" role="row">
                                        <td id="layanan_nama_place_0">
                                        </td>
                                        <td class="row">
                                            <div class="col-md-9"><input id="menu_0" type="text" name="menu[]" class="form-control" required="required"/><input type="hidden" id="idmenu_0" name="id_menu[]"/></div>
                                            <div class="col-md-2">&nbsp;<button type="button" class="btn btn-sm btn-info" onclick="showMenu(0)" title="Cari Menu"><i class="fa fa-search-plus"></i></button></div>
                                        </td>
                                        <td align="right">
                                            <label id="harga_0"><input type="hidden" id="harga_0" name="harga[]"/></label>
                                        </td>
                                        <td class="row">
                                            <div class="col-sm-9"><input id="qty_menu_0" untuk="0" type="number" required="required" name="jml[]" class="form-control qtyx"/></div>
                                        </td>
                                        <td align="right">
                                            <label id="total_0"></label>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot id="foot-data-table">
                                    <tr>
                                        <td colspan="4" align="right">
                                            <div class="form-inline pull-right">
                                                <label class="" for="tarifwilayah">Wilayah</label>
                                                <div class="col-md-2" id="tempattarifwilayah">
                                                    <select class="form-control" name="tarifwilayah" id="tarifwilayah"> 
                                                        @foreach ($TarifWilayah as $val)
                                                            <option value="{{ $val['id'] }}" harga="{{ $val['harga'] }}">{{ $val['nama'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td align="right"><label id="texttarifwilayah"><input type="hidden" id="grandtotal" name="grandtotal"></label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">Tax / PPN</td>
                                        <td align="right"><label id="textppn"><input type="hidden" id="textppn" name="ppn"></label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">Grand Total</td>
                                        <td align="right"><label id="textgrandtotal"><input type="hidden" id="grandtotal" name="grandtotal"></label></td>
                                    </tr>
                                </tfoot>
                                <input type="hidden" value="1" class="hide_count_menu" id="hide_count_menu" type="button" name="hide_count_menu"/>
                            </table>
                        </div>
                        <div class="pull-right">
                            <input type="submit" name="submit" value="Simpan Pesanan" class="btn btn-info">
                            <input type="submit" name="submit" value="Input Lagi" class="btn btn-info">
                        </div>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
    </div>
</form>
</div>

@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#tab_data_pelanggan2').click();
        $('#texttarifwilayah').html(addCommas($('#tarifwilayah option:selected').attr('harga')));
        $('#add_menu').on('click',function(){
            from=$(this).attr('id');
            count=$('#hide_count_menu').val();
            add_data_barang_to_table(count);
        });
        $('#menu-table').on('change','.qtyx',function(){
            count=$(this).attr('untuk');
            hitungPerbaris(count);
        });
        $('#menu-table').on('change','#tarifwilayah',function(){
            grandTotal();
        });
    });
    function add_data_barang_to_table(count){
        $('#hide_count_menu').val(parseInt(count)+1);
        $('<tr class="data_menu" id="data_ke-'+count+'" role="row">\n\
            <td id="layanan_nama_place_'+count+'">\n\
                <button id="'+count+'" class="delete_data_detail btn btn-xs btn-danger hapus" type="button" onclick="delete_data_table(\''+count+'\',\'new\')">\n\
                <span title="Batal" class="fa fa-trash"></span></button>\n\
            </td>\n\
            <td class="row"><div class="col-md-9"><input id="menu_'+count+'" type="text" name="menu[]" class="form-control" required="required"/><input type="hidden" id="idmenu_'+count+'" name="id_menu[]"/></div>\n\
            <div class="col-md-2">&nbsp;<button type="button" class="btn btn-sm btn-info" onclick="showMenu('+count+')" title="Cari Menu"><i class="fa fa-search-plus"></i></button></div></td>\n\
            <td align="right"><label id="harga_'+count+'"><input type="hidden" id="harga_'+count+'" name="harga[]"/></label></td>\n\
            <td class="row"><div class="col-sm-9"><input id="qty_menu_'+count+'" untuk="'+count+'" type="number" required="required" name="jml[]" class="form-control qtyx"/></div></td>\n\
            <td align="right"><label id="total_'+count+'"></label></td>\n\
        </tr>').appendTo('#detail-data-table');
    }
    function delete_data_table(no,stat){
        if(confirm("Anda yakin akan menghapus data ini?")){
            var count = $('#hide_count_menu').val();
            count = count-1;
            $('#hide_count_menu').val(count);
            $('#data_ke-'+no).detach();
            return false;
        }
    }
function hitungPerbaris(no){
    qty = currencyToNumber($('#qty_menu_'+no).val());
    harga = currencyToNumber($('#harga_'+no).val());
    total = qty*harga;
    $('#total_'+no).html(addCommas(total));
    grandTotal();
}
function grandTotal(){
    var count = $('#hide_count_menu').val();
    total=0;
    console.log(count);
    for(var i = 0; i < count; i++){
        total = total + currencyToNumber($('#total_'+i).html());
        console.log($('#total_'+i).html());
    }
    tarifwilayah = $('#tarifwilayah option:selected').attr('harga');
    gtotal = parseInt(total)+currencyToNumber(tarifwilayah);
    ppn = gtotal*0.1;
    gtotal = Math.round(gtotal*1.1);
    $('#texttarifwilayah').html(addCommas($('#tarifwilayah option:selected').attr('harga')));
    $('#textgrandtotal').html(addCommas(gtotal));
    $('#textppn').html(addCommas(ppn));
    $('#grandtotal').val(gtotal);
}
function getMenuById(idmenu,no){
    $.ajax({
            type: "GET",
            url: "{{ url("all/menu/getById") }}",
            data: {
                "id_menu":idmenu,
            },  
            dataType: 'json',
            success: function(response){
                $('#menu_'+no).val(response.dataList.nama_menu);
                $('#menu_'+no).prop('disabled',true);
                $('#idmenu_'+no).val(response.dataList.id);
                $('#harga_'+no).html(addCommas(response.dataList.harga));
                $('#harga_'+no).val(response.dataList.harga);
                $('#qty_menu_'+no).val(1);
                $('#total_'+no).html(addCommas(response.dataList.harga));
                $('.close').click();
                hitungPerbaris(no);
            }
        });
}
function showMenu(no){
    $('body').attr('class','sidenav-toggled');
    var url = "{{url('all/Menu/popUpMenu')}}";
    $('.modal-dialog').addClass('modal-lg');
    $('#myModelDialog').html('');

    $.ajax({
        url: url,
        data:{
          'ajax':1,
          'no':no,
        },
        cache: false,
        dataType: 'html',
        success: function(msg){
            $('#myModelDialog').on('shown.bs.modal', function () {
                // $('#layanan').focus();
            });

            $('#myModelDialog').html(msg);
            $('#myModelDialog').modal({backdrop: 'static'});
        },
        error: function(){
            $('#myModelDialog').html("request gagal dibuka");
            $('#myModelDialog').modal('show');
            console.log('gagal');
        }
    });
    return true;
}
</script>
<script language='javascript'>

</script>
@endpush
