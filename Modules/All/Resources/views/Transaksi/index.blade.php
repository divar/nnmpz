@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <H3>Data Layanan Pesan Antar</H3>
                </div>
                <div class="clearfix">&nbsp;</div>

                <div class="portlet-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ url('all/transaksi/tambah') }}" class="btn btn-info btn-sm">
                                <span class="fa fa-fw fa-plus"></span> Tambah Pesanan
                            </a>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="row">
                        <div class='col-sm-2'>
                            <input type="text" value="{{ date('d-m-Y') }}" id="fromdate" readonly class="date-picker">
                        </div>
                        <div class="col-md-2">
                            <input type="text" value="{{ date('d-m-Y') }}" id="todate" readonly class="date-picker">
                        </div>
                        <div class="col-md-2">
                            <button onclick="refresh()" class="btn btn-info" type="button">Cari</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm table-hover" id="menu-table">
                            <thead>
                                <tr>
                                    <th width="7%">#</th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Penerima</th>
                                    <th>Pesanan</th>
                                    <th>Total</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Alamat</th>
                                    <th>pegawai</th>
                                    <th>Kurir</th>
                                    <th>Addon</th>
                                    <th>Modifier</th>
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
    var table;
$(document).ready(function(){
    @if(session('id'))
        open('{{ url('nota/cetaknota') }}/{{ session('id') }}','_blank'); 
        document.getElementById('logout-form').submit();
        {{-- open('{{ url('/logout') }}','_self');  --}}
    @endif
});
today = {{ date('d-m-Y') }};
 $("#fromdate").datepicker({format: 'dd-mm-yyyy',uiLibrary: 'bootstrap4',iconsLibrary: 'fontawesome',maxDate: today});
 $("#todate").datepicker({format: 'dd-mm-yyyy',uiLibrary: 'bootstrap4',iconsLibrary: 'fontawesome',maxDate: today});
function refresh(){
    table.ajax.reload();
}
 $(function() {
    table = $('#menu-table').DataTable({
        // stateSave: true,
        processing: true,
        serverSide: true,
        pageLength:10,
        // "iDisplayLength": 10,
        // ajax: '{{ url('all/pelanggan/load-data') }}',
        ajax: {
            url:"{{ url('all/transaksi/load-data') }}",
                                data: function (d) {
                                    return $.extend( {}, d, {
                                    'from':$('#fromdate').val(),
                                    'to':$('#todate').val(),
                                } );

                                }
        },
        columns: [
            { data: 'action', name: 'action', searchable:false,orderable:true},
            { data: 'nomor', name: 'nomor', searchable:false,orderable:true},
            { data: 'nama', name: 'nama', searchable:false,orderable:true},
            { data: 'no_hp', name: 'pelanggans.no_hp', searchable:true,orderable:true},
            { data: 'penerima', name: 'penerima', searchable:false,orderable:true},
            { data: 'pesanan', name: 'pesanan', searchable:false,orderable:true},
            { data: 'total', name: 'total', searchable:false,orderable:true},
            { data: 'tgl_pesan', name: 'tgl_pesan', searchable:false,orderable:true},
            { data: 'alamat', name: 'alamat', searchable:false,orderable:true},
            { data: 'pegawai', name: 'pegawai', searchable:false,orderable:true},
            { data: 'kurir', name: 'kurir', searchable:false,orderable:true},
            { data: 'addon', name: 'addon', searchable:false,orderable:false},
            { data: 'modifier', name: 'modifier', searchable:false,orderable:false},
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
           {
               text: '<i class="fa fa-refresh reloads"> refresh</i>',
               className: 'btn btn-sm btn-info',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
                   // alert('Datatable reloaded!');
               }
            },
            { extend: 'excel', className: 'btn btn-sm btn-info',text: '<i class="fa fa-file-excel-o"> export excel</i>',
                exportOptions:{
                   columns:[0,1,2,3,4,5,7,8,9]
                }
            }

        ],
        // bFilter : true,
        bLengthChange : true, 
        "columnDefs": [ 
            { className: "center", "targets": [ 0,6 ] }
        ],
        "dom": "<'row'<'col-md-6 col-sm-6'><'col-md-6 col-sm-6'fB>r><'table-scrollable't><'row'<'col-md-6 col-sm-6'i><'col-md-6 col-sm-6'p>>",
    });
    $('.dt-buttons').appendTo('div.dataTables_filter');
    $('#menu-table_filter').attr('style','float:none;');
});
function deleteData(id){
    var v = confirm('Anda yakin akan menghapus data ini ?');
    if(v){
        $.ajax({
            type: "GET",
            url: "{{ url('all/transaksi/delete') }}/"+id,
            data: {
                            
            },  
            dataType: 'json',
            success: function(response){
                
            }
        });
            $('.reloads').click();
        table.ajax.reload();
    }
}
</script>
@endpush
