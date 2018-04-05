@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title=(isset($Tarifwilayah)?'Edit':'Tambah').' Menu')
@section('modalClass','min-width:90%;')
@section('sub-content')
<style>
/* The container */
.radio-pilih-container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 15px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.radio-pilih-container input {
    position: absolute;
    opacity: 0;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.radio-pilih-container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.radio-pilih-container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.radio-pilih-container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.radio-pilih-container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
</style>
<div class="content-wrapper">
@if(isset($Menu))
<form action="{{ route('updatemenu') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@else
<form action="{{ route('postTambahMenu') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@endif
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                @if(!isset($Menu))
                    <H3>Tambah Daftar Menu</H3>
                @else
                    <input type="hidden" name="id_menu" value="{{ $Menu['id'] }}">
                @endif 
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                <div class="panel-body">&nbsp;</div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label for="nama" class="col-md-3 col-form-label">Nama Menu</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Menu" required="required" value="{{ isset($Menu)?$Menu['nama_menu']:'' }}">
                            </div>  
                        </div>
                        @if(isset($Menu))
                        <div class="form-group row">
                            <label for="Ukuran" class="col-md-3 col-form-label">Ukuran</label>
                            <div class="col-md-9">
                                <select id="ukuran" name="id_size" class="form-control custom-select" >
                                    <option value="">Menu yang tidak mempunyai Ukuran</option>
                                    @foreach($size as $val)
                                        <option value="{{ $val['id'] }}" {{ isset($Menu['id_size']) && $Menu['id_size']==$val['id']?'selected="selected"':'' }}>{{ $val['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        @endif
                        @if(!isset($Menu))
                        <div class="form-group row">
                            <label for="size" class="col-md-3 col-form-label">Ukuran</label>
                            <div class="col-md-9"> 
                                <label class="radio-pilih-container">Tidak
                                    <input type="radio" id="pilihsizetidak" class="pilihsize" checked="checked" name="pilihsize" value="tidak">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-pilih-container">Ya
                                    <input type="radio" id="pilihsizeya" class="pilihsize" value="ya" name="pilihsize">
                                    <span class="checkmark"></span>
                                </label>
                            </div>  
                        </div>
                        @endif
                        <div id="tempatSatuan" class="form-group row">
                            <label for="Satuan" class="col-md-3 col-form-label">Satuan</label>
                            <div class="col-md-9">
                                <select id="satuan" name="id_satuantunggal" class="form-control custom-select" >
                                    @foreach($Satuan as $val)
                                        <option value="{{ $val['id'] }}" {{ isset($Menu['id_satuan']) && $Menu['id_satuan']==$val['id']?'selected="selected"':'' }}>{{ $val['satuan'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="tempatHarga" class="form-group row">
                            <label for="Harga" class="col-md-3 col-form-label">Harga</label>
                            <div class="col-md-9">
                                <input id="harga" type="number" name="harga" class="form-control" placeholder="" required="required" value="{{ isset($Menu)?$Menu['harga']:'' }}">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                                <input id="keterangan" type="text" name="keterangan" class="form-control" placeholder="keterangan" value="{{ isset($Menu)?$Menu['keterangan']:'' }}">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-md-3 col-form-label">Kategori</label>
                            <div class="col-md-9">
                                <select id="kategori" name="kategori" class="form-control custom-select" disabled="disabled" required="required">
                                  <option selected>Kategori</option> 
                                </select>
                            </div>  
                        </div>
                        <div class="col-md-3"><input id="submit" class="btn btn-info" type="submit" value="Simpan" name="submit"></div>
                    </div>
                    <div class="col-md-7 d-none" id="tempatTambahSize">
                        <button id="add_size" type="button" class="btn btn-xs btn-success tambah_layanan" tujuan="detail-size-table" from="menu">
                            <span title="tambah" class="glyphicon glyphicon-plus">Tambah size</span>
                        </button>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered table-hover" id="size-table">
                                <thead>
                                  <tr>
                                      <td width="5%" align="middle"><h5>#</h5></td>
                                      <td width="35%" align="center"><h5>Ukuran</h5></td>
                                      <td width="25%" align="center"><h5>Harga</h5></td> 
                                      <td width="35%" align="center"><h5>satuan</h5></td> 
                                  </tr>
                                </thead>
                                <tbody id="detail-data-table"> 
                                </tbody> 
                                <input type="hidden" value="0" class="hide_count_size" id="hide_count_size" type="button" name="hide_count_size"/>
                            </table>
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
        $('#add_size').on('click',function(){
            from=$(this).attr('id');
            batas = {{ count($size) }};
            count=$('#hide_count_size').val();
            if(count < batas){
                add_data_barang_to_table(count);                
            }
        });
        $('#detail-data-table').on('click','.hagia',function(){
             tujuan = $(this).attr('tujuan');
            console.log(tujuan);
             $('.rdx_'+tujuan).prop('checked', false);
             $(this).prop('checked', true);
        });
        $('.pilihsize').on('click',function(){
            pilihsize = $(this).val(); 
            if(pilihsize == 'ya'){
                $('#tempatTambahSize').attr('class','col-md-6');
                $('#add_size').click();
                $('#tempatHarga').attr('class','form-group row d-none');
                $('#tempatSatuan').attr('class','form-group row d-none');
                $('#harga').prop('required',null);
            }else{
                $('#tempatHarga').attr('class','form-group row');
                $('#tempatSatuan').attr('class','form-group row');
                $('#harga').prop('required',true);
                $('#tempatTambahSize').attr('class','col-md-6 d-none');
                $('.data_size').detach();
                $('#hide_count_size').val(0);
            }
        });
        $('#menu-table').on('change','.qtyx',function(){
            count=$(this).attr('untuk');
            hitungPerbaris(count);
        });
        $('#menu-table').on('change','#tarifwilayah',function(){
            grandTotal();
        });
        getKategoriMenu();
    });
    function getKategoriMenu(){
        $.ajax({
            type: "GET",
            url: "{{ url("administrasi/menu/getkategorimenu") }}",
            data: {
                
            },
            dataType: 'json',
            success: function(response){
                var editMenu = "{{ isset($Menu)?'ya':'tidak' }}";
                var id_kategori = "{{ isset($Menu)?$Menu['id_kategori']:'tidakditemukan' }}";
                $("#kategori").find('option').remove().end();
            for(var i = 0; i < response.kategori.length; i++){ 
                if(editMenu=='ya' && id_kategori!='tidakditemukan' && id_kategori==response.kategori[i]['id']){
                    selected = 'selected="selected"';
                }else{
                    selected = '';
                }
                $("#kategori").append('<option value="' + response.kategori[i]['id'] + '" '+selected+'>' + response.kategori[i]['nama'] + '</option>');
            }
            $("#kategori").prop('disabled',false);
            }
        });
    }
    function add_data_barang_to_table(count){
        $('#hide_count_size').val(parseInt(count)+1);
        if(count<1){
            $('<tr class="data_size" id="data_ke-'+count+'" role="row">\n\
                <td id="layanan_nama_place_'+count+'">\n\
                </td>\n\
                <td id="size">\n\
                <div class="row">@foreach($size as $val) <div class="col-md-4"> <label class="radio-pilih-container ">{{ $val['nama'] }}<input type="radio" tujuan="'+count+'" class="hagia rdx_'+count+'" name="xsize[{{ $val['nama'] }}]" value="{{ $val['id'] }}"><span class="checkmark"></span></label> </div> @endforeach</div>\n\
                </td>\n\
                <td align="right"><input type="number" id="hargaSize_'+count+'" class="form-control" name="hargaSize[]"></td>\n\
                <td>\n\
                    <div id="tempatSatuan" class="form-group row">\n\
                        <div class="col-md-12">\n\
                            <select id="satuan_'+count+'" name="id_satuan[]" class="form-control custom-select" >\n\
                                @foreach($Satuan as $val)\n\
                                    <option value="{{ $val['id'] }}" {{ isset($Menu['id_satuan']) && $Menu['id_satuan']==$val['id']?'selected="selected"':'' }}>{{ $val['satuan'] }}</option>\n\
                                @endforeach\n\
                            </select>\n\
                        </div>\n\
                    </div>\n\
                </td>\n\
            </tr>').appendTo('#detail-data-table');
        }else{
            $('<tr class="data_size" id="data_ke-'+count+'" role="row">\n\
                <td id="layanan_nama_place_'+count+'">\n\
                    <button id="'+count+'" class="delete_data_detail btn btn-xs btn-danger hapus" type="button" onclick="delete_data_table(\''+count+'\',\'new\')">\n\
                    <span title="Batal" class="fa fa-trash"></span></button>\n\
                </td>\n\
                <td id="size">\n\
                <div class="row">@foreach($size as $val) <div class="col-md-4"><label class="radio-pilih-container ">{{ $val['nama'] }}<input type="radio" class="hagia rdx_'+count+'" tujuan="'+count+'" name="xsize[{{ $val['nama'] }}]" value="{{ $val['id'] }}"><span class="checkmark"></span></label> </div> @endforeach</div>\n\
                </td>\n\
                <td align="right"><input type="number" id="hargaSize_'+count+'" class="form-control" name="hargaSize[]" required="required"></td>\n\
                <td>\n\
                    <div id="tempatSatuan" class="form-group row">\n\
                        <div class="col-md-12">\n\
                            <select id="satuan" name="id_satuan[]" class="form-control custom-select" >\n\
                                @foreach($Satuan as $val)\n\
                                    <option value="{{ $val['id'] }}" {{ isset($Menu['id_satuan']) && $Menu['id_satuan']==$val['id']?'selected="selected"':'' }}>{{ $val['satuan'] }}</option>\n\
                                @endforeach\n\
                            </select>\n\
                        </div>\n\
                    </div>\n\
                </td>\n\
            </tr>').appendTo('#detail-data-table');
        }
    }
    function delete_data_table(no,stat){
        if(confirm("Anda yakin akan menghapus data ini?")){
            var count = $('#hide_count_size').val();
            count = count-1;
            $('#hide_count_size').val(count);
            $('#data_ke-'+no).detach();
            return false;
        }
    }
</script>
@endpush
