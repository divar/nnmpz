@extends('layouts.app')

@section('content')
<?php
                                    // dd($kabupaten['cities']);
                                  ?>
<div class="content-wrapper">
<form action="{{ route('postTambahMenu') }}" method="POST" name="tambahMenu-form" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <H3>Tambah Menu</H3>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="clearfix">&nbsp;</div>
                <div class="row">
                <div class="clearfix">&nbsp;</div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label for="nama" class="col-md-3 col-form-label">Nama Menu</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Menu" required="required">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="Harga" class="col-md-3 col-form-label">Harga</label>
                            <div class="col-md-9">
                                <input id="harga" type="text" name="harga" class="form-control" placeholder="" required="required">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                                <input id="keterangan" type="text" name="keterangan" class="form-control" placeholder="keterangan">
                            </div>  
                        </div>
                        <div class="form-group row">
                            <label for="ategori" class="col-md-3 col-form-label">Kategori</label>
                            <div class="col-md-9">
                                <select id="kategori" name="kategori" class="form-control custom-select" disabled="disabled" required="required">
                                  <option selected>Kategori</option> 
                                </select>
                            </div>  
                        </div>
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
                $("#kategori").find('option').remove().end();
                $("#kategori").append('<option> kategori </option>');
            for(var i = 0; i < response.kategori.length; i++){
                
                $("#kategori").append('<option value="' + response.kategori[i]['id'] + '">' + response.kategori[i]['nama'] + '</option>');
            }
            $("#kategori").prop('disabled',false);
            }
        });
    }
</script>
@endpush
