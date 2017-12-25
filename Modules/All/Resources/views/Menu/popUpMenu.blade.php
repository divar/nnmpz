@extends(Request::get('ajax') ? 'layouts.modal':'layouts.content')
@section('title', $title='Daftar Menu')
@section('modalClass','min-width:90%;')
@section('sub-content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="clearfix">&nbsp;</div>

                <div class="portlet-body" style="display: block;">
                    <div class="">
                        <div class="form-group form-inline">
                            <label class="" for="kategoriMenu">jenis menu</label>
                            <div class="col-md-2" id="tempatKategoriMenu">
                                <select class="form-control" name="kategori_menu" id="kategoriMenu"> 
                                    @foreach ($selectKategori as $val)
                                        <option value="{{ $val['id'] }}">{{ $val['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="" id="labeltempatSize" for="tempatSize">Size</label>
                            <div class="col-md-2" id="tempatSize">
                                <select class="form-control" name="size" id="size"> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm table-hover" id="menu-table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function(){
    getSize();
    $('#kategoriMenu').on('change',function(){ 
        getSize();
    });
    $('#size').on('change',function(){ 
        table.ajax.reload();
    }); 
});

table = $('#menu-table').DataTable({
        stateSave: true,
        processing: true,
        // serverSide: true,
        pageLength:20,
        // ajax: '{{ url('all/pelanggan/load-data') }}',
        ajax: {
            url:"{{ url('all/menu/load-data') }}",
                                data: function (d) {
                                    return $.extend( {}, d, {
                                        'from':'popup',
                                        'no':'{{ $no }}',
                                        'jenis':$('#kategoriMenu option:selected').val(),
                                        'ukuran':$('#size option:selected').val(),
                                } );

                                }
        },
        columns: [
            { data: 'action', name: 'action', searchable:false,orderable:true},
            { data: 'nama', name: 'nama', searchable:true,orderable:true},
            { data: 'kategori', name: 'kategori', searchable:false,orderable:true},
            { data: 'harga', name: 'harga', searchable:false,orderable:true},
            { data: 'keterangan', name: 'keterangan', searchable:false,orderable:true},
        ],
        language: {
            lengthMenu : '{{ "Menampilkan _MENU_ data" }}',
            zeroRecords : '{{ "Data tidak ditemukan" }}' ,
            info : '{{ "_PAGE_ dari _PAGES_ halaman" }}',
            infoEmpty : '{{ "Data tidak ditemukan" }}',
            infoFiltered : '{{ "(Penyaringan dari _MAX_ data)" }}',
            loadingRecords : '{{ "Memuat data dari server" }}' ,
            processing :'{{ "Memuat data data" }}',
            search : '{{ "&nbsp;&nbsp;&nbsp; Pencarian:" }}',
            paginate : {
                first :     '{{ "<" }}' ,
                last :      '{{ ">" }}' ,
                next :      '{{ "Selanjutnya" }}',
                previous :  '{{ "Sebelumnya" }}'
            }
        },
        bFilter : true,
        bLengthChange : true, 
        "columnDefs": [ 
            { className: "center", "targets": [ 0,1 ] }
        ],
        // "dom": "<'row'<'col-md-6 col-sm-6'><'col-md-6 col-sm-6'fB>r><'table-scrollable't><'row'<'col-md-6 col-sm-6'i><'col-md-6 col-sm-6'p>>",
    });
$('.dt-buttons').appendTo('div.dataTables_filter');
$('#menu-table_filter').attr('style','float:none;');


function getSize(){ 
    $.ajax({
        type: "GET",
        url: "{{ route('menugetsize') }}",
        data: {
            "id_kategori":$('#kategoriMenu option:selected').val(),
        },  
        dataType: 'json',
        success: function(response){
            if(response.size.length>0){
                $('#labeltempatSize').attr('class','');
                $('#tempatSize').attr('class','col-md-2');
                $('#size').attr('name','size');

                $("#size").find('option').remove().end(); 
                for(var i = 0; i < response.size.length; i++){ 
                    $("#size").append('<option value="' + response.size[i]['id'] + '">' + response.size[i]['nama'] + '</option>');
                }
            }else {
                $('#labeltempatSize').attr('class','d-none');
                $('#tempatSize').attr('class','d-none');
                $('#size').attr('name','');
                $("#size").find('option').remove().end();
                $("#size").append('<option value="all">all</option>'); 
            }
            table.ajax.reload();
        }
    });
}
</script>
@endpush
