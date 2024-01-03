@extends('layouts.dashboard')
@section('links')
 
@endsection
@section('header')
<!-- display success message -->
 @if ($message = Session::get('success'))
  <div id="toast-container" class="toast-top-right">
    <div class="toast toast-success" aria-live="polite" style="">
      <div class="toast-message">
          {{$message}}
      </div>
   </div>
 </div>
 @endif
<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">CONSULAT GENERAL HONORAIRE DU BENIN A POINTE-NOIRE</h1>
          <hr align="center" style="width: 50%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row p-5">
    <!-- Small boxes (Stat box) -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success ">
              <div class="inner">
                <h3>{{$citoyens}}</h3>
                <p>GESTION DES CITOYENS</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="/citoyens" class="small-box-footer">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" style="color: #fff!important;">
              <div class="inner">
                <h3>{{$pass}}</h3>
                <p>LAISSEZ PASSER</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-text"></i>
              </div>
              <a href="/pass" class="small-box-footer" style="color: #fff!important;">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$cards}}</h3>
                <p>CARTES D'IDENTITE CONSULAIRE</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="/cartes" class="small-box-footer">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- =============================================2============== -->
          <!--<br><br><br><br><br><br><br>-->
            <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-pink ">
              <div class="inner">
                <h3>{{$maria}}</h3>
                <p>ACTES DE MARIAGE</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-group"></i>
              </div>
              <a href="/mariage" class="small-box-footer">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>{{$nais}}</h3>
                <p>ACTES DE NAISSANCE</p>
              </div>
              <div class="icon">
                <i class="fa fa-child"></i>
              </div>
              <a href="/naissances" class="small-box-footer">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" style="color: #fff!important;">
              <div class="inner">
                <h3>{{$deces}}</h3>
                <p>ACTES DE DECES</p>
              </div>
              <div class="icon">
                <i class="fa fa-ambulance"></i>
              </div>
              <a href="/deces" class="small-box-footer" style="color: #fff!important;">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success" style="color: #fff!important;">
              <div class="inner">
                <h3>{{$auto}}</h3>
                <p>AUTORISATIONS</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-file"></i>
              </div>
              <a href="/authorisations" class="small-box-footer" style="color: #fff!important;">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          
           <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success" style="color: #fff!important;">
              <div class="inner">
                <h3>{{$pro}}</h3>
                <p>PROCURATIONS</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-file"></i>
              </div>
              <a href="/procurations" class="small-box-footer" style="color: #fff!important;">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
           <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success" style="color: #fff!important;">
              <div class="inner">
                <h3>{{$leg}}</h3>
                <p>LEGALISATIONS</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-file"></i>
              </div>
              <a href="/legalisations" class="small-box-footer" style="color: #fff!important;">Plus info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      <br><br>

            <!-- TO DO List -->
            <div class="card mt-5 col-md-6">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                   Statistiques du mois en cours
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                        <!-- TO DO List -->
            <div class="card mt-5 col-md-5 ml-3">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Statistiques des Cartes Consulaire du mois en cours
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <canvas id="myChart2" style="width:100%;max-width:1900px"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
        <?php $no=121; ?>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
var xValues = ["Citoyens", "Laissez-Passer", "Naissances", "Mariages", "Décès","Autorisations", "Procurations", "Légalisations"];
var yValues = [{{$citoyens_month}}, {{$pass_month}}, {{$nais_month}}, {{$maria_month}}, {{$deces_month}}, {{$auto_month}}, {{$pro_month}}, {{$leg_month}}];
var barColors = ["green", "orange","teal","pink","red","blue","cyan","brown"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: ""
    }
  }

});
</script>

<script>
var xValues = ["Sorties", "En Stock"];
var yValues = [{{$count_cards}}, {{($stock_total-$count_cards)}}];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart2", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: ""
    }
  }
});
</script>
<script>
  $(function () {
    $(".home0").addClass("menu-open");
    $(".home1").addClass("active");
    $(".home2").addClass("active");
  });
</script>
@endsection