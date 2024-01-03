@extends('layouts.dashboard')
@section('links')
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection
@section('header')
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
          <h1 align="center" class="m-0 text-dark">Listes des Extraits d'Actes de Naissances</h1>
          <hr align="center" style="width: 25%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="card">
      <div class="container-fluid" style="background: #eee;">
      <div class="right">
        <a href="{{route('mariage.create')}}" class="btn ad-btn btnc">
          <span class="fa fa-plus"></span>
          Nouvelle entrée
        </a>
        <a href="#" id="print" class="btn btn-primary btnc shadow">
          <span class="fa fa-print"></span>
          Imprimé le tableau
        </a>
      </div>
      </div>
             <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nom(s) & Prénom(s) Epoux</th>
                  <th>Nom(s) & Prénom(s) Epouse</th>
                  <th>Profession Epoux</th>
                  <th>Profession Epouse</th>
                  <th>Statut</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; $bg_status="";?>
                 @foreach ($data as $key => $value)
                    <?php 
                     //   <!--set the background of the status-->
                        if ($value->status=="en traitement") {
                             $bg_status="bg-warning";
                        }
                        elseif ($value->status=="Validé") {
                             $bg_status="bg-success";
                        }
                        elseif ($value->status=="Rejet") {
                             $bg_status="bg-danger";
                        }
                    ?>
                <tr> 
                 <td>{{$no++}}</td>
                 <td>{{$value->mri_name}} {{$value->mri_surname}}</td>
                  <td>{{$value->fem_name}} {{$value->fem_surname}}</td>
                  <td>{{$value->mri_profession}}</td>
                  <td>{{$value->fem_profession}}</td>
                  <td><span class="badge {{$bg_status}}">{{$value->status}}</span></td>          
                  <td>
              <form action="{{route('mariage.destroy',$value->id)}}" method="post">
                        <a href="#" class="btn btn-success btn-sm" title="Profile" style="display: none;">
                          <i class="fas fa-eye" ></i>
                        </a>
                        <a href="{{route('mariage.edit',$value->id)}}" class="btn btn-warning btn-sm" title="Modifier">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
                        <?php if ($value->status=="Validé"): ?>
                            <a href="#" class="btn btn-primary btn-sm" title="Imprimer" data-toggle="modal" data-target="#bloque">
                          <i class="fa fa-print" style="color: #fff;"></i>
                        </a>
                        <?php endif ?>
                         @csrf
                         @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Effacer">
                          <i class="fa fa-trash" style="color: #fff;"></i>
                        </button>
                   </form>
                   </td>
                </tr>
                 @endforeach 
                </tbody>
              </table>
            </div>
 <!-- table to print -->
        <div class="card-body table-responsive" style="display: none;">
          <div id="example3">
               <div class="container-fluid text-center">
              
                 <div class="row mb-2">
                   <div class="col-sm-12">
                    <br><br>
                    <h3 align="center" class="m-0 text-dark">LISTES DES EXTRAITS D'ACTE DE NAISSANCE</h3>
                    <hr align="center" style="width: 35%">
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table id="example2" class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                   <th>#</th>
                  <th>Nom(s) & Prénom(s) Epoux</th>
                  <th>Nom(s) & Prénom(s) Epouse</th>
                  <th>Profession Epoux</th>
                  <th>Profession Epouse</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr> 
                  <td>{{$no++}}</td>
                  <td>{{$value->mri_name}} {{$value->mri_surname}}</td>
                  <td>{{$value->fem_name}} {{$value->fem_surname}}</td>
                  <td>{{$value->mri_profession}}</td>
                  <td>{{$value->fem_profession}}</td>
                  <td>{{$value->status}}</td>              
                </tr>
                 @endforeach 
                </tbody>
              </table>
              </div>
          </div>
        <!--End  of table to print -->
  </div> 
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
<script>
  $(function () {
    $("#example1").DataTable();
     $("#toast-container").fadeOut(12000);
        $("#print").click(function(){
      $("#example3").printThis({       
          loadCSS: "{{asset('dist/css/adminlte.css')}}",                             
          removeInlineSelector: "", 
          printDelay: 333,               
          header: "CONSULAT GENERAL HONORAIRE DU BENIN  <br> <small>Pointe-Noire</small><br> <small>BP: 1216</small>",
          footer: "",                   
           base: "http://127.0.0.1:8000/",                     
          doctypeString: '<!DOCTYPE html>',    
      });
    });
  });
</script>
<script>
   $(function () {
    $(".pieces").addClass("menu-open");
    $(".nais1").addClass("active");
    $(".pieces1").addClass("active");
  });
</script>
@endsection