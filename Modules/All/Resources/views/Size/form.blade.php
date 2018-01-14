@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title=(isset($Size)?'Edit':'Tambah').' Size')
@section('modalClass','min-width:60%;height:auto;')
@section('sub-content')
<div class="modal-body">
@if(isset($Size))
<form action="{{ route('updateSize') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@else
<form action="{{ route('postTambahSize') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
@endif    
    <div class="container-fluid">
        <div class="col-md-12">
            @if(!isset($Size) && Request::get('ajax')!=1)
            <div class="panel-heading">
                <H3>{{ $title }}</H3>
            </div>
            @endif
            @if(isset($Size))
            <input type="hidden" name="id_kategori" value="{{$Size['id']}}">
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="clearfix">&nbsp;</div>
            <div class="row">
            <div class="clearfix">&nbsp;</div>
                <div class="col-md-9">
                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label">Nama Size</label>
                        <div class="col-md-9">
                            <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Size" required="required" value="{{isset($Size['id'])?$Size['nama']:''}}">
                        </div>  
                    </div> 
                </div>
                <div class="col-md-2"><input id="submit" class="btn btn-info" type="submit" value="Simpan" name="submit"></div>
            </div>
        </div>
    </div>
</form>
</div>
<div class="modal-body">&nbsp;</div>
@endsection

@push('js')
<script type="text/javascript"> 
    $(function() {
        $('#nama').focus();
    });
</script>
@endpush
