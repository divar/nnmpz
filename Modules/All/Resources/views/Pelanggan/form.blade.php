@extends('layouts.app')

@section('content')
<?php
                                    // dd($kabupaten['cities']);
                                  ?>
<div class="content-wrapper">
<form action="{{ route('postTambahPelanggan') }}" method="POST" name="tambahPelanggan-form" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <H3>Tambah Data Pelanggan</H3>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clearfix">&nbsp;</div>
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
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label">E-mail</label>
                            <div class="col-md-9">
                                <input id="email" type="email" name="email" class="form-control" placeholder="nanamia@nanamiapizza.com">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-3 col-form-label">Alamat</label>
                            <div class="col-md-9">
                                <textarea id="alamat" class="form-control" name="alamat"></textarea>
                            </div>  
                        </div>
                        <div class="form-group row">
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
                        <div class="form-group row">
                            <label for="kecamatan" class="col-md-3 col-form-label">Kecamatan</label>
                            <div class="col-md-9">
                                <select id="kecamatan" name="kecamatan" class="form-control daerahOption custom-select" disabled="disabled">
                                  <option selected>Kecamatan</option>
                                </select>
                            </div>  
                        </div>
                        <div class="form-group row">
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
                    <div class="col-md-3"><input id="submit" class="btn btn-info" type="submit" value="Simpan" name="submit"></div>
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
        $('.daerahOption').on('change',function(){
            from=$(this).attr('id');
            if(from=='kabupaten'){
                getKecamatan();
            }else if(from=='kecamatan'){
                getKelurahan();
            }
        });
    });
    function getKecamatan(){
        $.ajax({
            type: "GET",
            url: "{{ url("administrasi/alamat/getKecamatan") }}",
            data: {
                "id_kabupaten":$('#kabupaten option:selected').val(),
            },  
            dataType: 'json',
            success: function(response){
                $("#kecamatan").find('option').remove().end();
                $("#kecamatan").append('<option> Kecamatan </option>');
            for(var i = 0; i < response.districts.length; i++){
                
                $("#kecamatan").append('<option value="' + response.districts[i]['id'] + '">' + response.districts[i]['name'] + '</option>');
            }
            $("#kecamatan").prop('disabled',false);
            }
        });
    }
    function getKelurahan(){
        $.ajax({
            type: "GET",
            url: "{{ url("administrasi/alamat/getKelurahan") }}",
            data: {
                "id_kecamatan":$('#kecamatan option:selected').val(),
            },  
            dataType: 'json',
            success: function(response){
                $("#kelurahan").find('option').remove().end();
                $("#kelurahan").append('<option> Kelurahan </option>');
            for(var i = 0; i < response.villages.length; i++){
                
                $("#kelurahan").append('<option value="' + response.villages[i]['id'] + '">' + response.villages[i]['name'] + '</option>');
            }
            $("#kelurahan").prop('disabled',false);
            }
        });
    }
</script>
@endpush
