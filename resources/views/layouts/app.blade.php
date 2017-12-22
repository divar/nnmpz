<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
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
    <!-- Datatable -->
    <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/DataTables-1.10.16/css/dataTables.foundation.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/DataTables-1.10.16/css/dataTables.jqueryui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/DataTables-1.10.16/css/dataTables.semanticui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/DataTables-1.10.16/css/jquery.dataTables.min.css') }}" rel="stylesheet">
</head>
<body class="sidenav-toggled">
    <div id="app">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.html">Nanamia Pizza</a>
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
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
              <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#pelanggan" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Pelanggan</span>
              </a>
              <ul class="sidenav-second-level collapse" id="pelanggan">
                <li>
                  <a href="{{ route('tambahPelanggan') }}">Tambah Data Pelanggan</a>
                </li>
                <li>
                  <a href="{{ url('all/menu') }}">Data Pelanggan</a>
                </li>
              </ul>
            </li>
            <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Pesanan">
              <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#pesanan" >
                <i class="fa fa-fw fa-area-chart"></i>
                <span class="nav-link-text">Pesanan</span>
              </a>
              <ul class="sidenav-second-level collapse" id="pesanan">
                <li>
                  <a href="#">Pesanan Pelanggan Baru</a>
                </li>
                <li>
                  <a href="#">Pesanan Pelanggan</a>
                </li>
              </ul>
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
            {{-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
              <a class="nav-link" href="tables.html">
                <i class="fa fa-fw fa-table"></i>
                <span class="nav-link-text">Menu</span>
              </a>
            </li> --}}
            {{-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
              <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-sitemap"></i>
                <span class="nav-link-text">Menu Levels</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseMulti">
                <li>
                  <a href="#">Second Level Item</a>
                </li>
                <li>
                  <a href="#">Second Level Item</a>
                </li>
                <li>
                  <a href="#">Second Level Item</a>
                </li>
                <li>
                  <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
                  <ul class="sidenav-third-level collapse" id="collapseMulti2">
                    <li>
                      <a href="#">Third Level Item</a>
                    </li>
                    <li>
                      <a href="#">Third Level Item</a>
                    </li>
                    <li>
                      <a href="#">Third Level Item</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li> --}}
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}">
                <i class="fa fa-fw fa-sign-out"></i>Logout
              </a>
            </li>
            {{-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-envelope"></i>
                <span class="d-lg-none">Messages
                  <span class="badge badge-pill badge-primary">12 New</span>
                </span>
                <span class="indicator text-primary d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">New Messages:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>David Miller</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>Jane Smith</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>John Doe</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all messages</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-bell"></i>
                <span class="d-lg-none">Alerts
                  <span class="badge badge-pill badge-warning">6 New</span>
                </span>
                <span class="indicator text-warning d-none d-lg-block">
                  <i class="fa fa-fw fa-circle"></i>
                </span>
              </a>
              <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">New Alerts:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-success">
                    <strong><i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                  </span>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">
                    This is an automated server response message. All systems are online.
                  </div>
                  </a>
                  <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-danger">
                    <strong>
                      <i class="fa fa-long-arrow-down fa-fw"></i>Status Update
                    </strong>
                  </span>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">This is an automated server response message. All systems are online.
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <span class="text-success">
                    <strong>
                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                  </span>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">This is an automated server response message. All systems are online.
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all alerts</a>
              </div>
            </li>
            <li class="nav-item">
              <form class="form-inline my-2 my-lg-0 mr-lg-2">
                <div class="input-group">
                  <input class="form-control" type="text" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="button">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </form>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li> --}}
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
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src='{{ asset('js/vfs_fonts.js') }}'></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    @yield('js')
    @stack('js')
</body>
</html>
