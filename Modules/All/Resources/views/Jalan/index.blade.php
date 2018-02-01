@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <H3>Data Jalan</H3>
                </div>
                <div class="clearfix">&nbsp;</div>

                <div class="portlet-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('tambahJalan') }}" class="btn btn-info btn-sm">
                                <span class="fa fa-fw fa-plus"></span> Tambah Jalan
                            </a>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm table-hover" id="jalan-table">
                            <thead>
                                <tr>
                                    <th width="15%">#</th>
                                    <th width="7%">No</th>
                                    <th>wilayah</th>
                                    <th>Jalan</th> 
                                    <th>Tarif</th>
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
        $('#jalan-table').on('click','.DeleteData',function(){
            id_jalan = $(this).attr('id-jalan');
            deleteData(id_jalan);
        });
    });
    $(function() {
        xtable = $('#jalan-table').DataTable({
            stateSave: true,
            processing: true,
        // serverSide: true,
        pageLength:20,
        ajax: {
            url:"{{ url('all/jalan/load-data') }}",
            data: function (d) {
                return $.extend( {}, d, {

                } );

            }
        },
        columns: [
        { data: 'action', name: 'action', searchable:false,orderable:true},
        { data: 'nomor', name: 'nomor', searchable:false,orderable:true},
        { data: 'nama_wilayah', name: 'wilayah', searchable:true,orderable:true}, 
        { data: 'nama', name: 'nama', searchable:true,orderable:true},
        { data: 'harga', name: 'harga', searchable:true,orderable:true},
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
        // buttons: [ 
        //     'excelHtml5',
        //     'csvHtml5',
        //     'pdfHtml5'
        // ],
        // dom: 'Bfrtip',
        buttons: [
            // 'csvHtml5',
            {
             text: '<i class="fa fa-refresh"> refresh</i>',
             className: 'btn btn-sm btn-info',
             action: function ( e, dt, node, config ) {
                 dt.ajax.reload();
                   // alert('Datatable reloaded!');
               }
           },
           { extend: 'excel', className: 'btn btn-sm btn-info',text: '<i class="fa fa-file-excel-o"> export</i>',
           exportOptions:{
             columns:[0,1]
         }
     }

     ],
        // bFilter : true,
        bLengthChange : true, 
        "columnDefs": [ 
        { className: "center", "targets": [ 0,1 ] }
        ],
        "dom": "<'row'<'col-md-6 col-sm-6'><'col-md-6 col-sm-6'fB>r><'table-scrollable't><'row'<'col-md-6 col-sm-6'i><'col-md-6 col-sm-6'p>>",
    });
        $('.dt-buttons').appendTo('div.dataTables_filter');
        $('#jalan-table_filter').attr('style','float:none;');
    });
    function deleteData(id_jalan){
        $.ajax({
            type: "GET",
            url: "{{ url('all/jalan/delete') }}/"+id_jalan,
            data: {

            },  
            dataType: 'json',
            success: function(response){

            }
        });
        xtable.ajax.reload();
    }
</script>
@endpush