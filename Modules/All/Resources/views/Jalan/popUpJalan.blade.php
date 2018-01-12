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
                    <div class="clearfix">&nbsp;</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm table-hover" id="menu-table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>                                  
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
table = $('#menu-table').DataTable({
        stateSave: true,
        processing: true,
        // serverSide: true,
        pageLength:20,
        ajax: {
            url:"{{ url('all/jalan/load-data') }}",
                                data: function (d) {
                                    return $.extend( {}, d, {
                                        'from':'popup',
                                        'jenis':$('#kategoriMenu option:selected').val(),
                                        'ukuran':$('#size option:selected').val(),
                                } );

                                }
        },
        columns: [
            { data: 'action', name: 'action', searchable:false,orderable:true},
            { data: 'nama_wilayah', name: 'nama_wilayah', searchable:true,orderable:true},
            { data: 'nama', name: 'nama', searchable:false,orderable:true},
            { data: 'harga', name: 'harga', searchable:false,orderable:true},
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
        buttons: [
            { extend: 'colvis', className: 'btn btn-outline btn-custom-toolbar', text: '<i class="fa fa-th-list"></i>&nbsp;<span class="caret"></span>'}
        ],
        bFilter : true,
        bLengthChange : true, 
        "columnDefs": [ 
            { className: "center", "targets": [ 0,3 ] }
        ],
        // "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'fB>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
    });
$('.dt-buttons').appendTo('div.dataTables_filter');
$('#menu-table_filter').attr('style','float:none;');

</script>
@endpush
