<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vérification de la Carte d'Identité Consulaire</title>
  <!-- JQuery AJAX -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Own style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  <!-- overlayScrollbars -->
   <link rel="stylesheet" href="{{asset('dist/css/styles.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body>

<div class="container">
<div class="container">
<div class="container">
<div class="container">
  <div class="row mt-4">
                  <div class="col-sm-4">
                    <div class="position-relative p-3 bg-gray" style="height: auto;">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-success text-lg text-dark">
                          VALIDE CIC 
                        </div>
                      </div>
                      <img src="{{asset('uploads/citoyens')}}/{{$citoyen->avatar}}" class=" elevation-2" id="wizardPicturePreview" style="width: 20%;"><br /> <br /> 
                      N° du citoyen: <strong>{{$citoyen->citoyen_no}}</strong> <br /> 
                      Nom complet: <strong>{{$citoyen->surname}} {{$citoyen->name}}</strong> <br />
                      Date d'expiration: <strong>{{date('d-m-Y', strtotime($carte->date_expiration))}}</strong>
                    </div>
                  </div>

 </div>
 </div>
 </div>
 </div>




<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!--  jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
  <!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
 <!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>