@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title=(isset($Kurir)?'Edit':'Tambah').' Kurir')
@section('modalClass','min-width:60%;height:auto;')
@section('sub-content')
<div class="modal-body">
@if(isset($Kurir))
<form action="{{ route('updateKurir') }}" method="POST" name="tambahKurir-form" enctype="multipart/form-data">
@else
<form action="{{ route('postTambahKurir') }}" method="POST" name="tambahKurir-form" enctype="multipart/form-data">
@endif    
    <div class="container-fluid">
        <div class="col-md-12">
            @if(!isset($Kurir) && Request::get('ajax')!=1)
            <div class="panel-heading">
                <H3>{{ $title }}</H3>
            </div>
            @endif
            @if(isset($Kurir))
            <input type="hidden" name="id_kurir" value="{{ $Kurir['id'] }}">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="clearfix">&nbsp;</div>
            <div class="row">
            <div class="clearfix">&nbsp;</div>
                <div class="col-md-9">
                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label">Nama Kurir</label>
                        <div class="col-md-9">
                            <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Kurir" required="required" value="{{isset($Kurir['id'])?$Kurir['nama']:''}}">
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label">Persen</label>
                        <div class="col-md-9">
                            <input id="persen" type="number" name="persen" min="0" max="100" class="form-control" placeholder="%" required="required" value="{{isset($Kurir['id'])?$Kurir['persen']:''}}">
                        </div>  
                    </div>
                </div>
                <div class="col-xs-2"><input id="submit" class="btn btn-info" type="submit" value="Simpan" name="submit"></div>
            </div>
        </div>
    </div>
</form>
</div>
<div class="modal-body">&nbsp;</div>
@endsection

@push('js')
<script type="text/javascript"> 
    $(document).ready(function(){
        $('#nama').focus();
        $('#persen').on('keypress change',function(){
            if( $(this).val() > 100){
                $(this).val('');
            }
        });
    });
</script>
@endpush
