@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title=(isset($Jalan)?'Edit':'Tambah').' Jalan')
@section('modalClass','min-width:90%;')
@section('sub-content')
<div class="content-wrapper">
@if(isset($Jalan))
<form action="{{ route('updateJalan') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
    <input type="hidden" name="id_jalan" value="{{ $Jalan->id }}">
@else
<form action="{{ route('createJalan') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@endif    
    <div class="container-fluid">
        <div class="col-md-12">
            {{-- <div class="panel panel-default"> --}}
                @if(!isset($Jalan))
                <div class="panel-heading">
                    <H3>{{ $title }}</H3>
                </div>
                @endif 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nama" class="col-md-3 col-form-label" >Nama Wilayah</label>
                            <div class="col-md-9">
                                <select class="form-control" name="wilayah">
                                    @foreach($tarifWilayah as $val)
                                        <option {{ isset($jalan)?($Jalan->id_tarif_wilayah==$val['id']?'selected':''):'' }} value="{{ $val['id'] }}">{{ $val['nama'] }}- Rp {{ $val['harga'] }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="jalan" class="col-md-3 col-form-label">Jalan</label>
                            <div class="col-md-9">
                                <input id="jalan" type="text" name="jalan" class="form-control" value="{{ isset($Jalan->nama)?$Jalan->nama:'' }}" placeholder="jalan">
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
