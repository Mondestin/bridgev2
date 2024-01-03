@extends('layouts.dashboard')
@section('links')
<!-- DataTables -->
@include('layouts.datatablestyles')
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection
@section('header')

<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Actes de Décès</h1>
          <hr align="center" style="width: 13%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="card card-primary card-outline">
      <div class="container-fluid" style="background: #eee;">


                     <div class="row col-md-12 p-2">
            <div class="col-md-7 mb-3">
              <form action="{{route('findDecesRange')}}" method="POST">
                @csrf
                @method('POST')
                <h5 class="ml-3">Sélectionnez les dates</h5>
                <div class="row ml-4">

                  <h6>DU</h6>
              <div class="input-group col-md-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input type="date" name="date1" class="form-control float-right" required>
              </div>
                <h6>AU</h6>
              <div class="input-group col-md-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input type="date" name="date2" class="form-control float-right" required>
              </div>
                        <button type="submit" class="btn btn-primary">
                <span class="fa fa-search"></span>
                Rechercher
              </button>
                </div>
            </form>
            </div>
           <div class="col-md-5 float-right">
                <a href="#" id="print" class="btn btn-primary btnc">
                  <span class="fa fa-print"></span>
                  Imprimer la liste
                </a>
                  <a href="{{route('getExcelDeces')}}" class="btn btn-success" title="Exporter la liste en Excel">
                  <i class="fa-solid fa-file-excel"></i>
                  Exporter la liste en Excel
                </a>

                <a href="{{route('deces.create')}}" class="btn btn-success">
                  <span class="fa fa-plus"></span>
                  Nouvelle entrée
                </a>
              </div>
            </div>
      </div>
             <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nom(s) & Prénom(s)</th>
                  <th>Sexe</th>
                  <th>Date de Naissance</th>
                  <th>Date de Décès</th>
                  <th>Date de déclaration</th>
                  <th>Le déclarant</th>
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
                 <td>{{$value->name}} {{$value->surname}}</td>
                  <td>{{$value->sexe}}</td>
                    <td>{{date("d-m-Y", strtotime($value->date_of_birth))}}</td>
                  <td>{{date("d-m-Y", strtotime($value->deces_date))}}</td>
                  <td>{{date("d-m-Y", strtotime($value->declare_date))}}</td>
                  <td>{{$value->d_name}} {{$value->d_surname}}</td>
                  <td><span class="badge {{$bg_status}}">{{$value->status}}</span></td>
                  <td>
                  <form action="{{route('deces.destroy',$value->id)}}" method="post">
                        <a href="#" class="btn btn-success btn-sm" title="Profile" style="display: none;">
                          <i class="fas fa-eye" ></i>
                        </a>
                        <a href="{{route('deces.edit',$value->id)}}" class="btn btn-warning btn-sm" title="Modifier">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
                        <?php if ($value->status=="Validé"): ?>

                            <a href="{{route('deces.show',$value->id)}}" class="btn btn-primary btn-sm btnprn" title="Imprimer">
                          <i class="fa fa-print" style="color: #fff;"></i>
                        </a>
                        <?php endif ?>
                        @if ((Auth::user()->level)=="super-admin" || (Auth::user()->level)=="admin")
                         @csrf
                         @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                          <i class="fa fa-trash" style="color: #fff;"></i>
                        </button>
                        @endif
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
                    @if (empty($date1))
                    <h3 align="center" class="m-0 text-dark">LISTES DES ACTES DE DECES</h3>
                    @else
                    <h3 align="center" class="m-0 text-dark">LISTES DES ACTES DE DECES DU {{date("d-m-Y", strtotime($date1))}} AU {{date("d-m-Y", strtotime($date2))}}</h3>

                    @endif
                    <hr align="center" style="width: 30%">
                    <h6 class="float-right mb-5">{{date("d-m-Y", strtotime(Date('d-m-Y')))}}</h6>
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table id="example2" class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nom(s) & Prénom(s)</th>
                  <th>Sexe</th>
                  <th>Date de Naissance</th>
                  <th>Date de Décès</th>
                       <th>Date de déclaration</th>
                  <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$value->name}} {{$value->surname}}</td>
                  <td>{{$value->sexe}}</td>
                    <td>{{date("d-m-Y", strtotime($value->date_of_birth))}}</td>
                    <td>{{date("d-m-Y", strtotime($value->deces_date))}}</td>
                    <td>{{date("d-m-Y", strtotime($value->declare_date))}}</td>
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
@include('layouts.datatablescripts')
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- print js -->
<script src="../js/printThis.js"></script>
<!-- printPage -->
<script src="../../js/jquery.printPage.js"></script>
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
<script type="text/javascript">
$(document).ready(function(){
$('.btnprn').printPage();
});
</script>
<script>
   $(function () {
    $(".pieces").addClass("menu-open");
    $(".nais2").addClass("active");
    $(".pieces1").addClass("active");
  });
</script>
@endsection
