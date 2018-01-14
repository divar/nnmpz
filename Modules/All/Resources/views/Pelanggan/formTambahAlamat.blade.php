@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title=(isset($Jalan)?'Edit':'Tambah').' Jalan')
@section('modalClass','min-width:60%;')
@section('sub-content')
<div class="modal-body">
<form action="{{ route('postTambahAlamat') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="col-md-12"> 
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="clearfix">&nbsp;</div>
                <div class="col-md-12 mr-auto ml-auto">
                    <div class="form-group row">
                        <label for="jalan" class="col-md-3 col-form-label">Jalan</label>
                        <div class="col-md-9">
                            <input type="hidden" name="id_pelanggan" value="{{ $id_pelanggan }}">
                            <textarea class="form-control" name="alamats"></textarea>
                        </div>  
                    </div>
                    <div class="col-md-3 pull-right"><input id="submit" class="btn btn-info" type="submit" value="Simpan" name="submit"></div>
                </div>
            </div> 
            <div class="mb-xl-5"></div>
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
