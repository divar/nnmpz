@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <H3>Pelanggan</H3>
                </div>
                <div class="clearfix">&nbsp;</div>

                <div class="portlet-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ url('all/pelanggan/tambah') }}" class="btn btn-info btn-sm">
                                <span class="fa fa-fw fa-plus"></span> Tambah Data Pelanggan
                            </a>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm table-hover" id="pelanggan-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
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
 $(function() {
    $('#pelanggan-table').DataTable({
        stateSave: true,
        processing: true,
        // serverSide: true, 
        pageLength:20,
        // ajax: '{{ url('all/pelanggan/load-data') }}',
        ajax: {
            url:"{{ url('all/pelanggan/load-data') }}",
                                data: function (d) {
                                    return $.extend( {}, d, {
                                    
                                } );

                                }
        },
        columns: [
            { data: 'nomor', name: 'nomor',searchable:false,orderable:true},
            { data: 'nama', name: 'nama', searchable:false,orderable:true},
            { data: 'alamat', name: 'alamat', bSearchable:false,orderable:true},
            { data: 'no_hp', name: 'no_hp', searchable:true,orderable:true},
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
               text: '<i class="fa fa-refresh"></i>',
               className: 'btn btn-sm btn-info',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
                   // alert('Datatable reloaded!');
               }
            },
            { extend: 'excel', className: 'btn btn-sm btn-info',text: '<i class="fa fa-file-excel-o"></i>',
                exportOptions:{
                   columns:[0,1,2,3]
                }
            }

        ],
        bFilter : true,
        bLengthChange : true, 
        "columnDefs": [ 
            { className: "center", "targets": [ 0,1,2,3 ] }
        ],
        "dom": "<'row'<'col-md-6 col-sm-6'><'col-md-6 col-sm-6'fB>r><'table-scrollable't><'row'<'col-md-6 col-sm-6'i><'col-md-6 col-sm-6'p>>",
    });
    $('.dt-buttons').appendTo('div.dataTables_filter');
    $('#pelanggan-table_filter').attr('style','float:none;');
});

</script>
@endpush
