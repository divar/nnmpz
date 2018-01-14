@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title=(isset($addOn)?'Edit':'Tambah').' Addon Menu')
@section('modalClass','min-width:90%;')
@section('sub-content')
<style>
/* The container */
.container {
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
.container input {
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
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
</style>
<div class="content-wrapper">
@if(isset($addOn))
<form action="{{ route('updateaddon') }}" method="POST" name="editAddOn-form" enctype="multipart/form-data">
@else
<form action="{{ route('posttambahaddon') }}" method="POST" name="tambahAddOn-form" enctype="multipart/form-data">
@endif
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                @if(!isset($addOn))
                    <H3>Tambah Add On</H3>
                @else
                    <input type="hidden" name="id_addon" value="{{ $addOn['id'] }}">
                @endif 
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                <div class="panel-body">&nbsp;</div>
                    <div class="col-md-7">
                        <div class="form-group row">
                            <label for="nama" class="col-md-3 col-form-label">Nama Add On addOn</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Add On" required="required" value="{{ isset($addOn)?$addOn['nama']:'' }}">
                            </div>  
                        </div>
                        <div id="tempatHarga" class="form-group row">
                            <label for="Harga" class="col-md-3 col-form-label">Harga</label>
                            <div class="col-md-9">
                                <input id="harga" type="number" name="harga" class="form-control" placeholder="" required="required" value="{{ isset($addOn)?$addOn['harga']:'' }}">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                                <input id="keterangan" type="text" name="keterangan" class="form-control" placeholder="keterangan" value="{{ isset($addOn)?$addOn['keterangan']:'' }}">
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
        getKategoriMenu();
    });
    function getKategoriMenu(){
        $.ajax({
            type: "GET",
            url: "{{ url("administrasi/menu/getkategoriAddon") }}",
            data: {
                
            },
            dataType: 'json',
            success: function(response){
                var editAddOn = "{{ isset($addOn)?'ya':'tidak' }}";
                var id_kategori = "{{ isset($addOn)?$addOn['id_kategori']:'tidakditemukan' }}";
                $("#kategori").find('option').remove().end();
            for(var i = 0; i < response.kategori.length; i++){ 
                if(editAddOn=='ya' && id_kategori!='tidakditemukan' && id_kategori==response.kategori[i]['id']){
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
