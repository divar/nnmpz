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
            <div class="row">
                <div class="col-md-7">
                    <div class="table-responsive">
                        <button class="btn btn-primary" type="button" id="tambahJenis">Tambah Jenis</button>
                        <table class="table table-striped table-hover" id="jenis-table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center">Jenis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($jenis))
                                @for ($i = 0; $i < count($jenis); $i++)
                                <tr id="data_ke-{{ $i }}" role="row">
                                    <td>
                                        <button class="btn delete btn-danger" type="button" no="{{ $i }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" name="id_jenis[]" id="id_jenis_{{ $i }}" required="required" value="{{ isset($jenis)?$jenis[$i]->id:'' }}">
                                        <input type="text" class="form-control" name="jenis[]" id="jenis_{{ $i }}" required="required" value="{{ isset($jenis)?$jenis[$i]->jenis:'' }}">
                                    </td>
                                </tr>
                                @endfor
                                @endif
                                <input type="hidden" value="{{ isset($jenis)?$i:0 }}" id="HC">
                            </tbody>
                        </table>
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
    $(function() {
        $('#nama').focus();
        $('#tambahJenis').on('click', function(){
            count = $('#HC').val();
            add_jenis_to_table(count);
            $('#HC').val(parseInt(count)+1);
        });
        $('#jenis-table').on('click',".delete",function(){
            no = $(this).attr('no');
            console.log(no);
            delete_data_table(no);
        });
    });
    function delete_data_table(no){
        if(confirm("Anda yakin akan menghapus data ini?")){
            // var count = $('#hide_count_menu').val();
            $('#data_ke-'+no).detach();
            return false;
        }
    }
    function add_jenis_to_table(count){
        $('<tr id="data_ke-'+count+'" role="row">\n\
            <td>\n\
                <button class="btn delete btn-danger" no="'+count+'" type="button"><i class="fa fa-trash"></i></button>\n\
            </td>\n\
            <td>\n\
                <input type="text" class="form-control" name="jenis[]" id="jenis_'+count+'" required="required">\n\
            </td>\n\
        </tr>').appendTo('#jenis-table')
    }
</script>
@endpush
