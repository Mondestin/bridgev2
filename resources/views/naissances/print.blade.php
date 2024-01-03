  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="{{asset('../../images/logo1.png')}}" type="image/ico" />
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
<body>
  <!-- onload="window.print();" -->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
     <div class="container-fluid">
       <div class="card">
                <!-- Print acte de naissance -->
  <div class="card-body table-responsive" style="display: show;">
               <div style=" z-index: 1!imprtant; position: absolute;!important; margin-top: 43%; margin-left: 8%">
                <div class="container">
                <img src="{{asset('images/seaus.png')}}" width="92%" height="500px" style="opacity: 0.2";>
                  </div>
              </div>
       
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
                
                
          <div id="naissance" style="z-index: 2!important; position: relative!important;">
             <div class="container-fluid text-center">

                <div class="container" class="p-5" style="margin-top: 20%; margin-left: 14%">
                   <div class="col-md-12 text-center w-75">
                    <h2 class=" p-2" style="border: 4px solid #000; border-style: double;">
                      <strong>EXTRAIT D'ACTE DE NAISSANCE</strong>
                      <p class="mt-1" style=" font-size: 22px">Ref: <strong>{{$data->id}}</strong> </p>
                    </h2>
                      
                   </div>
               </div>
              <br><br>
             <div class="text-left" style="margin-left: 10%;">
                  <h5>Je sousigné(e): <strong>{{$emb->consule}}</strong></h5>
                  <h5>Fonction: <strong>Consul Général Honoraire du Bénin au Congo à Pointe-Noire</strong></h5>
                  <h5>Certifie avoir réçu la déclaration de naissance de: <strong>{{$data->surname}} </h5>
                  <h5>Prénom(s) de l'enfant: <strong>{{$data->name}}</strong> </h5>
                  <h5>Sexe: <strong>{{$data->sexe}}</strong> </h5>
                      <?php
                  $date="";
                     setlocale(LC_TIME, "fr_FR");

                  ?>
                  <h5>Né le: <strong>{{date("d-m-Y", strtotime($data->date_of_birth))}} à {{$data->time}}</h5>
                  <h5>A: {{$data->place}}</h5>
             </div>
             <div class="text-left" style="margin-left: 10%;">
                   <h5>Fils ou Fille de: </h5>
                  <div style="margin-left: 5%;">
                    <h5>Nom(s) et Pénom(s) du père: <strong>{{$data->f_name}}</strong> <strong>{{$data->f_surname}}</strong></h5>
                    <h5>Age: <strong>{{$data->f_age}}</strong></h5>
                    <h5>Domicile: <strong>{{$data->f_adress}}</strong></h5>
                    <h5>Nationalité: <strong>{{$data->f_nationality}}</strong></h5>
                    <h5>Profession: <strong>{{$data->f_profession}}</strong></h5>
                  </div>
             </div>
             <div class="text-left" style="margin-left: 10%;">
                 <h5>Et de:</h5>
                 <div style="margin-left: 5%;">
                   <h5>Nom(s) et Pénom(s) du mère: <strong>{{$data->m_name}}</strong> <strong>{{$data->m_surname}}</strong></h5>
                   <h5>Age: <strong>{{$data->m_age}}</strong></h5>
                   <h5>Domicile: <strong>{{$data->m_adress}}</strong></h5>
                   <h5>Nationalité: <strong>{{$data->m_nationality}}</strong></h5>
                   <h5>Profession: <strong>{{$data->m_profession}}</strong></h5>
                  </div>
              </div>
              <div class="text-left" style="margin-left: 10%;">
                 <h5>Déclarant:</h5>
                 <div style="margin-left: 5%;">
                   <h5>Relation: <strong>{{$data->relation}}</strong></h5>
                   <h5>Nom(s) et Pénom(s): <strong>{{$data->d_name}}</strong> <strong>{{$data->d_surname}}</strong></h5>
                   <h5>Age: <strong>{{$data->d_age}}</strong></h5>
                   <h5>Domicile: <strong>{{$data->d_adress}}</strong></h5>
                   <h5>Profession: <strong>{{$data->d_profession}}</strong></h5>
                  </div>
              </div>
              <br><br><br>
              <h5 class="text-left" style="padding-left: 15%!important;">Le Chef de Service </h5>
              <div class="right" style="padding-right: 10%!important;">
                   <?php
                  $date="";
                     setlocale(LC_TIME, "fr_FR");
                    $date = date('Y-m-d');
                  ?>

                <h5>Fait à Pointe-Noire, le {{date("d/m/Y", strtotime($date))}}</h5>
                <h5 style="margin-top: 34.5%;">Le Déclarant</h5>
              </div>

              <div class="text-left" style="margin-top: 15%;">
                {!! QrCode::size(100)->generate(route('verifNaiss',$data->id)) !!}
                <p><strong>NB:</strong> <i class="text-danger">Merci de vérifier l'authenticité de ce document</i></p>
              </div>
          </div>
          <div class="text-center">
            <img src="{{asset('images/pied.jpg')}}" width="42%" height="2px" style="opacity: 0.5; margin-left: 2%">
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
