@extends('layouts.dashboard')
@section('links')
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection
@section('header')

<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Gestion des entrées</h1>
          <hr align="center" style="width: 15%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <!-- row 1 -->
<div class="container-fluid">

<!-- Autres Papiers -->
 <div class="col-md-12 card collapsed-card mr-4">
      <div class="container-fluid" style="background: #eee;">

      <div class="card-header">
          <h3 class="card-title">Autres Papiers</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
         <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="example3" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
            <thead>
            <tr>
              <th>#</th>
              <th>type</th>
              <th>Nom</th>
              <th>Net à Payé</th>
              <th>Statut</th>
              <th>Options</th>
            </tr>
            </thead>
            <tbody>
              <!-- naissance -->
            <?php $no=1; ?>
             @foreach ($naiss as $key => $value)
            <tr>
             <td>{{$no++}}</td>
              <td>Acte de Naissance</td>
              <td>{{$value->name}} {{$value->surname}}</td>
              <td>{{$naissance_fees}}</td>
              <td>{{$value->status}}</td>
              <td>
               <form action="{{route('naissa')}}" method="POST">
                  @csrf
                  @method('POST')
            <input type="text" name="name_child" value="{{$value->name}} {{$value->surname}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="fees" value="{{$naissance_fees}}" style="display: none;">

                <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                 <i class="fa-solid fa-check"></i> Validé le paiement
                </button>
                </form>
               </td>
            </tr>
             @endforeach
             <!-- deces -->
            <?php $no=1; ?>
             @foreach ($deces as $key => $value)
            <tr>
             <td>{{$no++}}</td>
              <td>Acte de Décès</td>
              <td>{{$value->name}} {{$value->surname}}</td>
              <td>{{$deces_fees}}</td>
              <td>{{$value->status}}</td>
              <td>
               <form action="{{route('dece')}}" method="POST">
                  @csrf
                  @method('POST')
                <input type="text" name="name_of_decease" value="{{$value->name}} {{$value->surname}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="fees" value="{{$deces_fees}}" style="display: none;">

                <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                  <i class="fa-solid fa-check"></i> Validé le paiement
                </button>
                </form>
               </td>
            </tr>
             @endforeach
              <!-- mariage  -->
             <?php $no=1; ?>
             @foreach ($mariage as $key => $value)
            <tr>
             <td>{{$no++}}</td>
              <td>Acte de Mariage</td>
              <td>{{$value->mri_surname}} & {{$value->fem_surname}}</td>
              <td>{{$mariage_fees}}</td>
              <td>{{$value->status}}</td>
              <td>
               <form action="{{route('maria')}}" method="POST">
                  @csrf
                  @method('POST')
                  <input type="text" name="names" value="{{$value->mri_surname}} {{$value->fem_surname}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="fees" value="{{$mariage_fees}}" style="display: none;">
                <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                 <i class="fa-solid fa-check"></i> Validé le paiement
                </button>
                </form>
               </td>
            </tr>
             @endforeach
             <!-- authorisation  -->
             <?php $no=1; ?>
             @foreach ($autho as $key => $value)
            <tr>
             <td>{{$no++}}</td>
              <td>Autorisation Parentale</td>
              <td>{{$value->surname}} {{$value->name}}</td>
              <td>{{$authorisation_fees}}</td>
              <td>{{$value->status}}</td>
              <td>
               <form action="{{route('authorisation')}}" method="POST">
                  @csrf
                  @method('POST')
                     <input type="text" name="id_number" value="{{$value->citoyen_no}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="fees" value="{{$authorisation_fees}}" style="display: none;">
                <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                 <i class="fa-solid fa-check"></i> Validé le paiement
                </button>
                </form>
               </td>
            </tr>
             @endforeach
                 <!-- Procuration  -->
             <?php $no=1; ?>
             @foreach ($procuration as $key => $value)
            <tr>
             <td>{{$no++}}</td>
              <td>Procuration</td>
              <td>{{$value->surname}} {{$value->name}}</td>
              <td>{{$procuration_fees}}</td>
              <td>{{$value->status}}</td>
              <td>
               <form action="{{route('procuration')}}" method="POST">
                  @csrf
                  @method('POST')
                     <input type="text" name="id_number" value="{{$value->citoyen_no}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="fees" value="{{$procuration_fees}}" style="display: none;">
                <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                 <i class="fa-solid fa-check"></i> Validé le paiement
                </button>
                </form>
               </td>
            </tr>
             @endforeach
                <!-- Procuration  -->
             <?php $no=1; ?>
             @foreach ($legalisations as $key => $value)
            <tr>
             <td>{{$no++}}</td>
              <td>Légalisations</td>
              <td>{{$value->surname}} {{$value->name}}</td>
              <td>{{$procuration_fees}}</td>
              <td>{{$value->status}}</td>
              <td>
               <form action="{{route('legalisations')}}" method="POST">
                  @csrf
                  @method('POST')
                    <input type="text" name="names" value="{{$value->type}}" style="display: none;">
                    <input type="text" name="id_number" value="{{$value->name}} {{$value->surname}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="fees" value="{{$legalisations_fees}}" style="display: none;">
                <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                 <i class="fa-solid fa-check"></i> Validé le paiement
                </button>
                </form>
               </td>
            </tr>
             @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
    <!-- row 2 -->
<div class="container-fluid">
  <!-- Lassez-Passer -->
   <div class="col-md-12 card collapsed-card  mr-4">
      <div class="container-fluid" style="background: #eee;">
      <div class="card-header">
          <h3 class="card-title">Lassez-Passer </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
         <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="example4" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
            <thead>
            <tr>
              <th>#</th>
              <th>N° Matricule</th>
              <th>Nom(s)</th>
              <th>Net à Payé</th>
              <th>Statut</th>
              <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1;?>
             @foreach ($pass as $key => $value)

            <tr>
             <td>{{$no++}}</td>
             <td>{{$value->citoyen_no}}</td>
              <td>{{$value->name}} {{$value->surname}}</td>
              <td>{{$pass_fees}}</td>
              <td>{{$value->status}}</td>
              <td>
              <form action="{{route('passCard')}}" method="POST">
                  @csrf
                  @method('POST')
                    <input type="text" name="names" value="{{$value->name}} {{$value->surname}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="id_number" value="{{$value->citoyen_no}}" style="display: none;">
                  <input type="text" name="fees" value="{{$pass_fees}}" style="display: none;">

                <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                  <i class="fa-solid fa-check"></i> Validé le paiement
                </button>
                </form>
               </td>
            </tr>
             @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
  <div class="container-fluid">
<!-- Cartes Consulaire -->
 <div class="col-md-12 card collapsed-card mr-4">
      <div class="container-fluid" style="background: #eee;">
      <div class="card-header">
          <h3 class="card-title"> Cartes Consulaire </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
         <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="example5" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
            <thead>
            <tr>
              <th>#</th>
              <th>N° Matricule</th>
              <th>Nom(s)</th>
              <th>Net à Payé</th>
              <th>Statut</th>
              <th>Options</th>
            </tr>
            </thead>
            <tbody>
              <!-- nouvelle carte -->
            <?php $no=1; ?>
             @foreach ($cards1 as $key => $value)
            <tr>
             <td>{{$no++}}</td>
             <td>{{$value->citoyen_no}}</td>
             <td>{{$value->name}} {{$value->surname}}</td>
              <td>{{$card1_fees}}</td>
              <td>{{$value->type}}</td>
              <td>
                <form action="{{route('consularCard')}}" method="POST">
                  @csrf
                  @method('POST')
                    <input type="text" name="names" value="{{$value->name}} {{$value->surname}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="id_number" value="{{$value->card_no}}" style="display: none;">
                  <input type="text" name="fees" value="{{$card1_fees}}" style="display: none;">

                  <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                  <i class="fa-solid fa-check"></i> Validé le paiement
                  </button>
                </form>
              </td>
            </tr>
             @endforeach
             <!-- renouvellement -->
            <?php $no=1; ?>
             @foreach ($cards2 as $key => $value)
            <tr>
             <td>{{$no++}}</td>
             <td>{{$value->citoyen_no}}</td>
             <td>{{$value->name}} {{$value->surname}}</td>
              <td>{{$card2_fees}}</td>
              <td>{{$value->type}}</td>
              <td>
                <form action="{{route('consularCardr')}}" method="POST">
                  @csrf
                  @method('POST')
                    <input type="text" name="names" value="{{$value->name}} {{$value->surname}}" style="display: none;">
                  <input type="text" name="id" value="{{$value->id}}" style="display: none;">
                  <input type="text" name="id_number" value="{{$value->citoyen_no}}" style="display: none;">
                  <input type="text" name="fees" value="{{$card2_fees}}" style="display: none;">

                  <button type="submit" class="btn btn-success btn-sm" title="Validé?">
                <i class="fa-solid fa-check"></i> Validé le paiement
                  </button>
                </form>
              </td>
            </tr>
             @endforeach
            </tbody>
          </table>
        </div>
    </div>

  </div>

<?php
                  $date="";
                     setlocale(LC_TIME, "fr_FR");
                    $date = Date('d-m-Y');
                  ?>

   <!-- Paiements that were already accepted -->
   <div class="card card-primary card-outline">
      <div class="container-fluid" style="background: #eee;">
      <div class="">
        <h4 class="p-3">Paiements Validés le <span class="badge bg-primary">{{date("d-m-Y", strtotime($date))}}</span>

          <a href="#" id="print" class="btn btn-primary btnc right">
          <span class="fa fa-print"></span>
          Imprimer la liste
        </a>
      <!--   <a href="#" data-toggle="modal" data-target="#bloque" class="btn btn-success btnc right">
          <span class="fa fa-search"></span>
          Recherche avancer
        </a> -->
        </h4>
      </div>
      </div>
     <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table id="example2" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
        <thead>
        <tr>
          <th>#</th>
          <th>Reference</th>
          {{-- <th>Citoyen</th> --}}
          <th>type</th>

          <th>Montant</th>
          <th>Statut</th>
          <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=1; ?>
         @foreach ($data as $key => $value)
        <tr>
         <td>{{$no++}}</td>
         <td>{{$value->dem_no}}</td>
         {{-- <td>{{$value->name}} {{$value->surname}}</td> --}}
          <td>{{$value->types}}</td>

          <td>{{$value->montant}} Fcfa</td>
          <td><span class="badge bg-success">{{$value->status}} </span></td>
                    <td>
                      {{-- --}}
                <a href="{{route('prinRecipts',$value->id)}}" class="btn btn-primary btn-sm btnprn" title="Imprimer le reçu">
                  <i class="fa fa-receipt" style="color: #fff;"></i>
                </a>

               </td>
        </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </div>
<!-- table to print -->
        <div class="card-body table-responsive" style="display: none;">
          <div id="example8">
               <div class="container-fluid text-center">
                 <div class="row mb-2">
                   <div class="col-sm-12">
                    <br><br>
                    <h3 align="center" class="m-0 text-dark">LISTES DES PAIEMENTS VALIDES LE {{date("d-m-Y", strtotime($date))}} </h3>
                    <hr align="center" style="width: 30%">
                    <h6 class="float-right mb-5">{{date("d-m-Y", strtotime(Date('d-m-Y')))}}</h6>
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Reference</th>
                  {{-- <th>Citoyen</th> --}}
                  <th>type</th>
                  <th>Montant</th>
                  <th>Statut</th>

                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$value->dem_no}}</td>
                  {{-- <td>{{$value->name}} {{$value->surname}}</td> --}}
                  <td>{{$value->types}}</td>
                  <td>{{$value->montant}} Fcfa</td>
                  <td>{{$value->status}}</td>

                </tr>
                 @endforeach
                </tbody>
              </table>
              </div>
          </div>
        <!--End  of table to print -->
</div>
 </section>
@endsection
@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- print js -->
<script src="../js/printThis.js"></script>
<!-- printPage -->
<script src="../../js/jquery.printPage.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $("#example2").DataTable();
    $("#example3").DataTable();
    $("#example4").DataTable();
    $("#example5").DataTable();
    $("#toast-container").fadeOut(12000);
    $("#print").click(function(){
      $("#example8").printThis({
          loadCSS: "{{asset('dist/css/adminlte.css')}}",
          removeInlineSelector: "",
          printDelay: 333,
           header: "CONSULAT GENERAL HONORAIRE DU BENIN  <br> <small>Pointe-Noire</small><br> <small>BP: 1216</small>",
          footer: "<small>Bridge PNR</small>",
           base: "http://127.0.0.1:8000/",
          doctypeString: '<!DOCTYPE html>',
      });
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function(){
$('.btnprn').printPage();
});
</script>
<script>
  $(function () {
    $(".caisse").addClass("menu-open");
    $(".caisse1").addClass("active");
    $(".caisse2").addClass("active");
  });
</script>
@endsection
