<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Nanamia Pizza') }}</title>

  <!-- Styles -->
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/gijgo.min.css') }}" rel="stylesheet">
  <!-- Datatable -->
  <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('datatables/DataTables-1.10.16/css/dataTables.foundation.min.css') }}" rel="stylesheet">
  <link href="{{ asset('datatables/DataTables-1.10.16/css/dataTables.jqueryui.min.css') }}" rel="stylesheet">
  <link href="{{ asset('datatables/DataTables-1.10.16/css/dataTables.semanticui.min.css') }}" rel="stylesheet">
  <link href="{{ asset('datatables/DataTables-1.10.16/css/jquery.dataTables.min.css') }}" rel="stylesheet">
  @yield('css')
  @stack('css')
</head>
<body class="sidenav-toggled">
  <div id="app">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Master">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#datamaster" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-cog"></i>
              <span class="nav-link-text">Data Master</span>
            </a>
            <ul class="sidenav-second-level collapse" id="datamaster">
              <li>
                <a href="{{ route('loaddataTarifWilayah') }}">Tarif Area</a>
              </li>
              <li>
                <a href="{{ route('jalan') }}">Area</a>
              </li>
              <li>
                <a href="{{ route('kategori') }}">Kategori</a>
              </li>
              <li>
                <a href="{{ route('addon') }}">Add On Menu</a>
              </li>
              <li>
                <a href="{{ route('satuan') }}">Satuan</a>
              </li>
              <li>
                <a href="{{ route('loaddataSize') }}">Size</a>
              </li>
            </ul>
          </li>
          {{-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pelanggan">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#pelanggan" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Pelanggan</span>
            </a>
            <ul class="sidenav-second-level collapse" id="pelanggan">
              <li>
                <a href="{{ route('tambahPelanggan') }}">Tambah Data Pelanggan</a>
              </li>
              <li>
                <a href="{{ url('all/pelanggan') }}">Data Pelanggan</a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="transaksi">
            <a class="nav-link" href="{{ route('loaddataTransaksi') }}">
              <i class="fa fa-fw fa-table"></i>
              <span class="nav-link-text">Pemesanan</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Laporan">
            <a class="nav-link" href="{{ route('loaddataTransaksi-laporan') }}">
              <i class="fa fa-fw fa-table"></i>
              <span class="nav-link-text">Laporan</span>
            </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#menu" >
              <i class="fa fa-fw fa-table"></i>
              <span class="nav-link-text">Menu</span>
            </a>
            <ul class="sidenav-second-level collapse" id="menu">
              <li>
                <a href="{{ route('tambahMenu') }}">Tambah Menu</a>
              </li>
              <li>
                <a href="{{ url('all/menu') }}">Data Menu</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              {{-- <a class="nav-link" href="{{ route('logout') }}">
                <i class="fa fa-fw fa-sign-out"></i>Logout
              </a> --}}
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-sign-out"></i>Logout</a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </li>
          </ul>
        </div>
      </nav>
      <div class="col-md-8 col-md-offset-2">&nbsp;
      </div>
      <div class="col-md-8 col-md-offset-2">&nbsp;
      </div>
      <div class="col-md-8 col-md-offset-2">&nbsp;
      </div>
      <div class="modal fade" id="myModelDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      @yield('content')
    </div>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/fungsitambahan.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('js/sb-admin-charts.min.js') }}"></script> --}}
    <!-- Data Table -->
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/DataTables-1.10.16/js/dataTables.foundation.min.js') }}"></script>
    <script src="{{ asset('datatables/DataTables-1.10.16/js/dataTables.jqueryui.min.js') }}"></script>
    <script src="{{ asset('datatables/DataTables-1.10.16/js/dataTables.semanticui.min.js') }}"></script>
    <script src="{{ asset('datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/DataTables-1.10.16/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatables/DataTables-1.10.16/js/buttons.colVis.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src='{{ asset('js/vfs_fonts.js') }}'></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script> 
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <script type="text/javascript">
      $('body').delegate('a[target=ajax-modal],button[target=ajax-modal]','click',function(){
        var url = $(this).attr('href');
        ajaxModal(url,$(this));
        return false;
      });

      $('body').delegate('a[target=print],button[target=print],form[onsubmit=print],a.print','click',function(){
        var url = $(this).attr('href');
        window.open(url,'popUpWindow','height=600,width=900,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        return false;
      });
      $('body').delegate('.tt-input','click',function(){
        $(this).attr('autocomplete', 'off');
      });

      $('body').delegate('a[target=ajax-modal],button[target=ajax-modal]','click',function(event){
        event.preventDefault();
      });
      function ajaxModal(url,el){
        $('#myModelDialog').css({'width':''});

          if($(el).hasClass('modal-max')){
           $('#myModelDialog').addClass('modal-max');
           $('#myModelDialog').css({'width':'900px'});
           console.log('tess');
         }
         if($(el).hasClass('modal-1200')){
          $('#myModelDialog').css({'width':'1200px'});
          $('.modal-dialog').css({'width':'1200px'});
          console.log('tess');
        }

        $('#myModelDialog').html();
        $.ajax({
          url: url,
          data:'ajax=1',
          cache: false,
          dataType: 'html',
          success: function(msg){
            $('#myModelDialog').html(msg);
            $('#myModelDialog').modal({backdrop: 'static'});
          },
          error: function(){
            $('#myModelDialog').html("request gagal dibuka");
            $('#myModelDialog').modal('show');
            console.log('gagal');
          }
        });
        return true;
      }
function confirmDeleteDialog(dialogText,el){
  bootbox.confirm(dialogText, function(result) {
    if(result){
      $(el).parents('form').submit();
    }
  });
  return false;
}

function alertDanger(title,desc){
  jQuery.gritter.add({
    title: title,
    text: desc,
    class_name: 'growl-danger',
      // image: 'images/screen.png',
      sticky: false,
      time: ''
    });
}
function alertSuccess(title,desc){
  jQuery.gritter.add({
    title: title,
    text: desc,
    class_name: 'growl-success',
      // image: 'images/screen.png',
      sticky: false,
      time: ''
    });
}

$(function(){

  $('.table').on('click', '.hapus', function(e){
    if($(this).data('method') === 'delete') {
      e.preventDefault();
      $("#hapus-data .delete-me").attr('action', $(this).attr('href'));
      if($(this).attr('message')!=null)
        $('#pesan-dialog').html($(this).attr('message'));
      $('#hapus-data').removeData();
      $("#hapus-data").modal('show');
    }
  });

  $('.hapus').on('click', function (event) {
    if($(this).data('method') === 'delete') {
      event.preventDefault();
      $("#hapus-data .delete-me").attr('action', $(this).attr('href'));
      if($(this).attr('message')!=null)
        $('#pesan-dialog').html($(this).attr('message'));
      $('#hapus-data').removeData();
      $("#hapus-data").modal('show');
    }
  });

    //check all data table selected
    $(".check_all").click(function() {
      var check_semua = this.checked;
      $(".checkall").each(function()
      {
        this.checked = check_semua;
      });

    });

    // confirm delete all begin
    $('.aksi').click(function(event) {
      event.preventDefault();
      var title = $(this).children(':selected').data('title');
      var content = $(this).children(':selected').data('content');
      $('.modal-title').html(title);
      $('.modal-body p').html(content);
    });


    $('.delete-event').click(function(event) {
      event.preventDefault();

      $('#event-delete').modal('show');

      $('.yes').click(function(event) {
        console.log("kesini berhasil");
        $('#dell_all').submit();
        $('#event-delete').modal('toggle');
      });
    });
    // end

    $('.close').click(function(){
      $('.ext').hide();
    });


    // $(".valid").validate();
    // $(".reset").validate();

    // $("#tags").val();
    // $("#tags").tagsinput();

  });
var toastCount=0;
function alertToastr(message,titleParam,typeGroup){
  var shortCutFunction = typeGroup;
  var msg = message;
  var title = titleParam || '';
  var toastIndex = toastCount++;

  toastr.options = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-bottom-right",
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  if ($('#addBehaviorOnToastClick').prop('checked')) {
    toastr.options.onclick = function () {
      alert('You can perform some custom action after a toast goes away');
    };
  }

  if (!msg) {
    msg = getMessage();
  }

  $("#toastrOptions").text("Command: toastr[" + shortCutFunction + "](\"" + msg + (title ? "\", \"" + title : '') + "\")\n\ntoastr.options = " + JSON.stringify(toastr.options, null, 2));

                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;
                if ($toast.find('#okBtn').length) {
                  $toast.delegate('#okBtn', 'click', function () {
                    alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                    $toast.remove();
                  });
                }
                if ($toast.find('#surpriseBtn').length) {
                  $toast.delegate('#surpriseBtn', 'click', function () {
                    alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                  });
                }

                $('#clearlasttoast').click(function () {
                  toastr.clear($toastlast);
                });
              }

            </script>
            @yield('js')
            @stack('js')
          </body>
          </html>
