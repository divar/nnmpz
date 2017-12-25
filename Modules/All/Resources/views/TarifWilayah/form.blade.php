@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title=(isset($Tarifwilayah)?'Edit':'Tambah').' Tarif Wilayah')
@section('modalClass','min-width:90%;')
@section('sub-content')
<div class="content-wrapper">
@if(isset($Tarifwilayah))
<form action="{{ route('updateTarifWilayah') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@else
<form action="{{ route('postTambahTarifWilayah') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@endif    
    <div class="container-fluid">
        <div class="col-md-12">
            {{-- <div class="panel panel-default"> --}}
                @if(!isset($Tarifwilayah))
                <div class="panel-heading">
                    <H3>{{ $title }}</H3>
                </div>
                @endif
                @if(isset($Tarifwilayah))
                <input type="hidden" name="id_tarif_wilayah" value="{{$Tarifwilayah['id']}}">
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                <div class="clearfix">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nama" class="col-md-3 col-form-label" >Nama Wilayah</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Wilayah" required="required" value="{{isset($Tarifwilayah['id'])?$Tarifwilayah['nama']:''}}">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="Harga" class="col-md-3 col-form-label">Harga</label>
                            <div class="col-md-9">
                                <input id="harga" type="text" name="harga" class="form-control" placeholder="" required="required" value="{{isset($Tarifwilayah['id'])?$Tarifwilayah['harga']:''}}">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                                <input id="keterangan" type="text" name="keterangan" class="form-control" placeholder="keterangan" value="{{isset($Tarifwilayah['id'])?$Tarifwilayah['keterangan']:''}}">
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
