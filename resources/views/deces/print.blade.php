<!DOCTYPE html>
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
<body onload="window.print();" >
  <!---->
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
     <div class="container-fluid">
       <div class="card">
           <?php
            
                  $date="";
                     setlocale(LC_TIME, "fr_FR");
                    $date = date('Y-m-d');
                  ?>
                <!-- Print acte de DECES -->
  <div class="card-body table-responsive" style="display: show;">
    @include("layouts.partials.entete")>
                
                
          <div id="naissance" style="z-index: 2!important; position: relative!important;">
             <div class="container-fluid text-center">

                <div class="container" class="p-5" style="margin-top: 20%; margin-left: 14%">
                   <div class="col-md-12 text-center w-75">
                    <h2 class=" p-2" style="border: 4px solid #000; border-style: double;">
                      <strong>EXTRAIT D'ACTE DE DECES</strong>
                      <p class="mt-1" style=" font-size: 22px">Ref: <strong>{{$data->id}}</strong> </p>
                    </h2>
                      
                   </div>
               </div>
              <br><br>
             <div class="text-left" style="margin-left: 17%;">
                  <h5>Je sousigné(e): <strong>{{$emb->consule}}</strong></h5>
                  <h5>Fonction: <strong>Consul du Benin au Congo</strong></h5>
                  <h5>Certifie avoir récu la déclaration de décès de:</h5>
                  <h5>Nom(s) et Prénom(s) du défunt: <strong>{{$data->surname}}</strong>  <strong>{{$data->name}}</strong> </h5>
                  <h5>Sexe: <strong>{{$data->sexe}}</strong> </h5>
                  <h5>Date et lieu de naissance: <strong>{{date("d-m-Y", strtotime($data->date_of_birth))}}</strong> à <strong>{{$data->place}}</strong></h5>
                  <h5>Domicile: <strong>{{$data->domicile}}</strong></h5>
                  <h5>Profession: <strong>{{$data->profession}}</strong></h5>
                  <h5>Situation matrimonile: <strong>{{$data->situation}}</strong></h5>
                  <h5>Nom(s) et Prénom(s) du conjoint: <strong>{{$data->surname}}</strong>  <strong>{{$data->name}}</strong></h5>
                  <h5>Date et heure de décès: <strong>{{date("d-m-Y", strtotime($data->deces_date))}}</strong>  <strong>{{$data->heure_deces}}</strong>  à <strong>{{$data->place_deces}}</strong></h5>
             
                  <h5>Date de déclaration: <strong>{{ date("d-m-Y", strtotime($data->declare_date))}}</strong></h5>
             </div>
             <div class="text-left" style="margin-left: 17%;">
                   <h5>Fils ou Fille de: </h5>
                  <div style="margin-left: 5%;">
                  <h5>Nom(s) et Pénom(s) du père: <strong>{{$data->f_name}}</strong> <strong>{{$data->f_surname}}</strong></h5>
                    <h5>Domicile: <strong>{{$data->f_adress}}</strong></h5>
                  </div>
             </div>
             <div class="text-left" style="margin-left: 17%;">
                 <h5>Et de:</h5>
                 <div style="margin-left: 5%;">
                   <h5>Nom(s) et Pénom(s) du mère: <strong>{{$data->m_name}}</strong> <strong>{{$data->m_surname}}</strong></h5>
                   <h5>Domicile: <strong>{{$data->m_adress}}</strong></h5>
                  </div>
              </div>
              <div class="text-left" style="margin-left: 17%;">
                 <h5>Déclarant:</h5>
                 <div style="margin-left: 5%;">
                   <h5>Nom(s) et Pénom(s): <strong>{{$data->d_name}}</strong> <strong>{{$data->d_surname}}</strong></h5>
                   <h5>Age: <strong>{{$data->d_age}}</strong></h5>
                   <h5>Domicile: <strong>{{$data->d_adress}}</strong></h5>
                   <h5>Profession: <strong>{{$data->d_profession}}</strong></h5>
                   <h5>Relation: <strong>{{$data->relation}}</strong></h5>
                  </div>
              </div>
              <br><br>
              <h5 class="text-left" style="padding-left: 18%!important;">Le Chef de Service </h5>
              <div class="right" style="padding-right: 20%!important;">
                  
                <h5>Fait à Pointe-Noire, le {{date("d-m-Y", strtotime($date))}}</h5>
                <h5 style="margin-top: 34.5%;">Le Déclarant</h5>
              </div>
              <div class="text-left" style="margin-top: 15%;">
                {!! QrCode::size(100)->generate(route('verifDeces',$data->id)) !!}
                <p><strong>NB:</strong> <i class="text-danger">Merci de vérifier l'authenticité de ce document</i></p>
              </div>
          </div>
          <div class="text-center">
            <img src="{{asset('images/pied.jpg')}}" width="42%" height="2px" style="opacity: 0.5";>
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
