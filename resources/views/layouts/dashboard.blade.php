<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('images/logo1.png')}}" type="image/ico" />
    <title>{{env('APP_NAME')}} Pointe-Noire </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
  <!-- JQuery AJAX -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Own style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  <!-- overlayScrollbars -->
   <link rel="stylesheet" href="{{asset('dist/css/styles.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
 <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      @yield('links')

</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed">

  <div class="wrapper">

  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu show" style="border-radius: 50%!important;">
        <a href="#" class="nav-link dropdown-toggle p-3" data-toggle="dropdown">
          <img src="/uploads/users/{{ Auth::user()->avatar }}"
               class="user-image img-circle" alt="User Image" style="border: 1px solid #6633CC!important;">
               {{ Auth::user()->name }} <span class="right caret"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right hide" >
          <!-- User image -->
          <li class="user-header blue">
            <img src="/uploads/users/{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="User Image">
            <p>
              {{ Auth::user()->name }}
              <small>{{ Auth::user()->status }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('users.show',Auth::user()->id) }}" class="btn btn-default btn-flat border"> <span class="fa fa-user-cog"></span> Profile</a>
            <a href="#" class="btn btn-default btn-flat float-right border"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fa-solid fa-right-from-bracket"></i> Déconnection</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
       @include('layouts.dash_nav')
  <!-- End Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #fff!important;">
    <!--<br>-->
    <!--    <div class="callout callout-warning ml-5 mt-6 mr-5">-->
    <!--    <marquee>-->
    <!--      <span class="badge badge-"> <h5><i class="fas fa-warning"></i> Période de formation en cours, veuillez attendre le lancement de la plateforme pour établir des documents officiels. Tous les documents établis durant cette période ne seront pas pris en compte lors du lancement.</h5> </span>  -->
    <!--    </marquee>-->
    <!--    </div>-->

    <!-- Content Header (Page header) -->
      @yield('header')
      <!-- /.container-fluid -->
  </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        @yield('content')

    </section>

                <!-- CREATE BLOQUE EVENT -->
     <div class="modal fade" id="bloque" style="display: none;" aria-modal="true">
        <div class="modal-dialog">
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <h3><i class="icon fas fa-info"></i> Info!</h3>
                <h6>Cette fonctionnalité sera disponble bientôt</h6>
              </div>
        </div>
      </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   <div class="float-right d-none d-sm-inline-block">
    Copyright &copy; {{Date('Y')}} <strong><a href="https://www.phoenone.com" target="_blank">Phoenone</a>.</strong>
    Tous droits reservés.

      <b>Version</b> 1.0.9
    </div>
  </footer>

</div>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!--  jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
  <!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
 <!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script>
$(function(){
    @if(Session::has('success'))
        Swal.fire({
        icon: 'success',
        title: 'Succès!',
        text: '{{ Session::get("success") }}'
    })
    @endif
});
@if(Session::has('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ Session::get("error") }}'
    })
@endif
</script>
  @yield('scripts')
</body>
</html>
