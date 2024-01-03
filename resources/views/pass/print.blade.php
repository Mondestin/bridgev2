<!doctype html>
<html lang="fr">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="{{asset('images/logo1.png')}}" type="image/ico" />
   <title>Consulat Honoraire du Bénin à Pointe-Noire </title>
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
<body onload="window.print();">
  <!-- -->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
     <div class="container-fluid">
       <div class="card">
                <!-- Print acte de naissance -->
  <div class="card-body table-responsive" style="display: show;">
               <div style=" z-index: 1!important; position: absolute;!important; margin-top: 43%; margin-left: 8%;">
                <div class="container">
                <img src="{{asset('images/seaus.png')}}" width="92%" height="500px" style="opacity: 0.2;"; >
                  </div>
              </div> 

              <div>
              <div class="right text-right">
                <h5>
                  <br>
                  <i>Tél: +242 05 380 07 04</i><br> 
                  <i>BP: 1216 - Pointe-Noire</i><br> 
                  <i>avenue Charles de Gaulle</i><br> 
                  <i>consulatgeneraldubenin.pnr@gmail.com</i><br> 
                </h5>
              </div>
                <div class="left text-center">
                   <img src="{{asset('images/en_tete.jpg')}}"  height="130px">
                </div>
                </div>
                
            <div class="text-center" id="naissance" style="z-index: 2!important; position: absolute!important;">
            <div class="container-fluid text-center">
              
                 <div class="container" class="p-5" style="margin-top: 25%; margin-left: 18%">
                   <div class="col-md-12 text-center w-75">
                    <h2 class=" p-2" style="border: 4px solid #000; border-style: double;">
                      <strong>LAISSEZ-PASSER</strong>
                        <p style="padding-right: 4%; font-size: 22px" >N°: <strong>{{$data->id}}/{{ Date('Y') - 2000}}</strong> </p> 
                    </h2> 
                                                 
                   
                  </div>
               
                  </div>
                <?php 
                  $date="";
                     setlocale(LC_TIME, "fr_FR");
                    $date = date('Y-m-d');
                  ?>
               <br><br><br><br><br><br><br><br>
             <div class="text-left" style="margin-left: 14.5%;">
              <h4 class="right">
                  <img src="/uploads/citoyens/{{$data->avatar}}"  height="210px" width="210px">
              </h4>
              <br><br>
                  <h3>Nom(s): <strong>{{ $data->surname ? $data->surname : '-'}}</strong></h3>
                  <h3>Prénom(S): <strong>{{ $data->name}}</strong> </h3>
                  <h3>Sexe: <strong>{{ $data->sexe}}</strong> </h3>
                  <h3>Lieu de naissance: <strong><strong>{{ $data->pofbirth}}</strong></strong> </h3>
                   <h3>Date de naissance: <strong>{{strftime(" %d %B %G", strtotime($data->dob))}}</strong></h3>
                   <h3>Taille: <strong> {{ $data->taille ? $data->taille : '-'}} cm</strong></h3>
                   <h3>Couleur des yeux: <strong>{{ $data->eye_color ? $data->eye_color : '-'}}</strong></h3>
                   <h3>Signe particulier: <strong>{{ $data->pa_sign ? $data->pa_sign : '-'}}</strong></h3>
                  <h3>Nationalité: <strong>{{ $data->nationality}}</strong></h3>
                   <h3>Numéro matricule: <strong>{{ $data->citoyen_no}}</strong></h3>
                  <h3>Adresse au Bénin: <strong>{{ $data->addressFirstCountry ? $data->addressFirstCountry : '-'}}</strong></h3>
                  <h3>Motif: <strong>{{ $data->voyage}}</strong></h3>
                  <h3>Date d'expiration: <strong>{{date("d-m-Y", strtotime($data->date_expiration))}}</strong></h3>
                  
             </div>
     <br><br><br> <br>
             
              <div class="right" style="padding-right: 14%!important;">
               
                <h4 class="mb-5">Fait à Pointe-Noire, le {{date("d-m-Y", strtotime($date))}}</h4>
                <h4 style="margin-top: 34.5%;">Le Chef de Service</h4>
              </div>
              <div class="text-left" style="margin-top: 22%;">
                {!! QrCode::size(100)->generate("Ce document est valide") !!}
                <p><strong>NB:</strong> <i class="text-danger">Merci de vérifier l'authenticité de ce document</i></p>
              </div>
      
          </div>
          <div class="text-center">
            <img src="{{asset('images/pied.jpg')}}" width="42%" height="2px" style="opacity: 0.5; margin-left: 18%">
          </div>
      </div>
 </div>
       </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
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
