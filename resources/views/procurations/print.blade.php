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
  <!-- -->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
     <div class="container-fluid">
       <div class="card">
                <!-- Print PROCURATION -->
  <div class="card-body table-responsive" style="display: show;">
          @include("layouts.partials.entete")
                
          <div id="naissance" style="z-index: 2!important; position: relative!important;">
             <div class="container-fluid text-center">

                <div class="container" class="p-5" style="margin-top: 20%; margin-left: 14%">
                   <div class="col-md-12 text-center w-75">
                    <h2 class=" p-2" style="border: 4px solid #000; border-style: double;">
                      <strong>PROCURATION</strong>
                      <p class="mt-1" style=" font-size: 22px">Ref: <strong>{{$data->id}}</strong> </p>
                    </h2>
                      
                   </div>
               </div>
               
               <br><br>
             <div class="text-left" style="margin-left: 11.5%;">
                  <h4>Je sousigné(e): <strong>{{$datas->surname}} {{$datas->name}}</strong></h4>
                  <h4>Domicilié (e) à: <strong>{{$datas->addressSecondCountry}} </h4>
                  <h4>Profession: <strong>{{$datas->profession}}</strong> </h4>
                  <h4>Immatriculé dans nos livres sous le numéro: <strong>{{$data->citoyen_id}}</strong> </h4>
                   <h4>Détenteur de la Carte d'Identité Consulaire n°: <strong>{{$dCard->card_no}}</strong> </h4>
                  

                  <h4 class="mt-4 mb-4"> <i>Jouissant de la plénitude de mes facultés, de corps, d'esprit et en vertu des liens nous unissant avec le mandataire,</i> </h4>
             </div>
             <div class="text-left" style="margin-left: 7%;">
                  <h2 class="mt-4 mb-4" style="margin-left: 23%;"><i><u>Donne procuration de mes pouvoirs à: </u></i> </h2>
                  
                  <div style="margin-left: 5%;">
                    <h4>Mme / Mr: <strong>{{$data->b_surname}}</strong> <strong>{{$data->b_name}}</strong></h4>
                    <h4>Détenteur de Passport/ CNI n°: <strong>{{$data->b_id_number}}</strong></h4>
                    <h4>Délivrée à: <strong>{{$data->b_id_etablit}}</strong> expira le: <strong> 
                      <?php 
                          $date = date("d-m-Y", strtotime($data->b_id_expire));
                         echo $date;
                  ?></strong>

                </h4>
                  </div>
             </div>
             <div class="text-left" style="margin-left: 8%;">
               <h2 class="mt-4 mb-4" style="margin-left: 40%;"><i><u>Aux fins de:</u></i></h2>
                 <div class=" mb-5" style="margin-left: %;">
                   <h4 class="text-center pl-5 pr-5"><strong class="m-3">{{$data->pouvoir}}</strong></h4>
                  </div>

                  <h4 class="mt-3 mb-3" style="margin-left: 4.5%;">En foi de quoi, je leur délivre la présente procuration pour servir et valoir ce que de <br>droit /.</h4>
              </div>
  
              <br>
              <h5 class="text-left" style="padding-left: 15%!important;">Le Chef de Service </h5>
              <div class="right" style="padding-right: 10%!important;">
                   <?php 
                  $date="";
                     setlocale(LC_TIME, "fr_FR");
                    $date = date('Y-m-d');
                  ?>
                <h5>Fait à Pointe-Noire, le {{date("d-m-Y", strtotime($date))}}</h5>
                <h5 style="margin-top: 34.5%;">Le Mandant</h5>
              </div>
              <div class="text-left" style="margin-top: 25%;">
                {!! QrCode::size(100)->generate("Ce document est valide") !!}
                <p><strong>NB:</strong> <i class="text-danger">Merci de vérifier l'authenticité de ce document</i></p>
              </div>
          </div>
         
         @include("layouts.partials.footer")
         
      </div>
       <br><br><br><br><br><br>
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
