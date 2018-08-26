@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <H3>Data Kurir</H3>
                </div>
                <div class="clearfix">&nbsp;</div>

                <div class="portlet-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('tambahKurir') }}" target="ajax-modal" class="btn btn-info btn-sm">
                                <span class="fa fa-fw fa-plus"></span> Tambah Kurir
                            </a>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm table-hover" id="Kurir-table">
                            <thead>
                                <tr>
                                    <th width="15%">#</th>
                                    <th width="7%">No</th>
                                    <th>Jenis Makanan</th>
                                    <th>Persen ( % )</th>
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
    $('#Kurir-table').on('click','.hapus',function(){
        id = $(this).attr('id-kurir');
        deleteData(id);
    });
});
var xtable;
 $(function() {
    xtable = $('#Kurir-table').DataTable({
        stateSave: true,
        processing: true,
        // serverSide: true,
        pageLength:20,
        ajax: {
            url:"{{ route('lodadataKurir') }}",
                                data: function (d) {
                                    return $.extend( {}, d, {
                                    
                                } );

                                }
        },
        columns: [
            { data: 'action', name: 'action', searchable:false,orderable:true},
            { data: 'nomor', name: 'nomor', searchable:false,orderable:true},
            { data: 'nama', name: 'nama', searchable:true,orderable:true}, 
            { data: 'persen', name: 'persen', searchable:true,orderable:true}, 
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
    $('#Kurir-table_filter').attr('style','float:none;');
});
function deleteData(id){
    var v = confirm('Anda yakin akan menghapus data ini ?');
    if(v){
    $.ajax({
        type: "GET",
        url: "{{ url('all/kurir/delete') }}/"+id,
        data: {
                        
        },  
        dataType: 'json',
        success: function(response){
        }
    });
    xtable.ajax.reload();
}
}
</script>
@endpush
