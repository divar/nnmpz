@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title=(isset($Kategori)?'Edit':'Tambah').' Addon Menu')
@section('modalClass','min-width:70%;')
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
<div class="modal-body">
@if(isset($Kategori))
<form action="{{ route('updatekategori') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@else
<form action="{{ route('postTambahKategori') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@endif    
    <div class="container-fluid">
        <div class="col-md-12">
            {{-- <div class="panel panel-default"> --}}
                @if(!isset($Kategori) && Request::get('ajax')!=1)
                <div class="panel-heading">
                    <H3>{{ $title }}</H3>
                </div>
                @endif
                @if(isset($Kategori))
                <input type="hidden" name="id_kategori" value="{{$Kategori['id']}}">
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                <div class="clearfix">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nama" class="col-md-3 col-form-label">Nama Kategori</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Addon Menu" required="required" value="{{isset($Kategori['id'])?$Kategori['nama']:''}}">
                            </div>  
                        </div>
                        <div class="form-group row d-none">
                            <label for="size" class="col-md-3 col-form-label">Untuk</label>
                            <div class="col-md-9 d-flex d-none"> 
                                {{-- <label class="container">Daftar Menu
                                    <input type="radio" id="addonN" class="addon" {{ isset($Kategori)?( $Kategori->flag_addon!='Y'? 'checked="checked"':'' ) :'checked="checked"' }} name="addon" value="N">
                                    <span class="checkmark"></span>
                                </label> --}}
                                <label class="container">Daftar Addon
                                    <input type="radio" id="addonY" checked="checked" class="addon" value="Y" name="addon">
                                    <span class="checkmark"></span>
                                </label> 
                            </div>  
                        </div>
                        <div id="tempatSatuan" class="form-group row d-none">
                            <label for="Satuan" class="col-md-3 col-form-label">Satuan</label>
                            <div class="col-md-9">
                                <select id="satuan" name="id_satuan" class="form-control custom-select" >
                                    @foreach($Satuan as $val)
                                        <option value="{{ $val['id'] }}" {{ isset($Kategori['id_satuan']) && $Kategori['id_satuan']==$val['id']?'selected="selected"':'' }}>{{ $val['satuan'] }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div id="tempatjenismakanan" class="form-group row d-none">
                            <label for="jenis_makanan" class="col-md-3 col-form-label">jenis Makanan</label>
                            <div class="col-md-9">
                                <select id="jenis_makanan" name="id_jenis_makanan" class="form-control custom-select" >
                                    @foreach($jenis_makanan as $val)
                                        <option value="{{ $val['id'] }}" {{ isset($Kategori['id_jenis_makanan']) && $Kategori['id_jenis_makanan']==$val['id']?'selected="selected"':'' }}>{{ $val['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-3"><input id="submit" class="btn btn-info" type="submit" value="Simpan" name="submit"></div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</form>
</div>
@endsection

@push('js')
<script type="text/javascript"> 
    $(function() {
        $('#nama').focus();
    });
</script>
@endpush
