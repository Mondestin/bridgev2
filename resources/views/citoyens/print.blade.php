@extends('layouts.dashboard')
@section('links')
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="card ">
      <div class="container-fluid" >
        <h3>
          CONSULAT GENERAL HONORAIRE DU BENIN  <br> <small>Pointe-Noire</small><br> <small>BP: 1216</small>
        </h3>
      </div>
      <?php
      $date="";
         setlocale(LC_TIME, "fr_FR");
        $mois=Date('Y-m-d');
      ?>
               <div class="container-fluid text-center">
                 <div class="row mb-2">
                   <div class="col-md-12 mt-4">

                    <h1 align="center" class="">LISTES DES CITOYENS</h1>
                    <hr align="center" style="width: 15%">
                    <h6 class="float-right mb-5">{{date("d-m-Y", strtotime($mois))}}</h6>
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table class="table table-bordered table-striped table-sm dataTable " role="grid">
              <thead>
    <tr>
        <th>#</th>
        <th>N° Matricule</th>
        <th>Nom(s)</th>
        <th>Prénom(s)</th>
        <th>Date de Naissance</th>
        <th>Lieu de Naissance</th>
        <th>Sexe</th>
        <th>Profession</th>
        <th>Téléphone</th>
        <th>Statut ID</th>
    </tr>
    </thead>
    <tbody>
        <?php $no=1; $bg_status="";?>
         @foreach ($data as $key => $value)
        <tr>
         <td>{{$no++}}</td>
         <td>{{$value->citoyen_no}} </td>
          <td>{{$value->surname}}</td>
          <td>{{$value->name}}</td>
          <td>{{date("d-m-Y", strtotime($value->dob))}}</td>
          <td>{{$value->pofbirth}}</td>
          <td>{{$value->sexe}}</td>

          <td>{{$value->profession}}</td>
          <td>{{$value->phone}}</td>
          <td>{{$value->id_status}}</td>

        </tr>
         @endforeach
        </tbody>
        </table>
        </div>

  </div>
</div>

 </section>
@endsection
@section('scripts')
<script>
  $(function () {
    $(".citoyens0").addClass("menu-open");
    $(".citoyens1").addClass("active");
    $(".citoyens2").addClass("active");
  });
</script>
@endsection
