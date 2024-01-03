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
          <h1 align="center" class="m-0 text-dark">Autorisations Parentale</h1>
          <hr align="center" style="width: 20%">
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
          <div class="row col-md-12 p-4">
            <div class="col-md-7 mb-3">
              <form action="{{route('findAuthoRange')}}" method="POST">
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
                  <a href="{{route('getExcelAuto')}}" class="btn btn-success" title="Exporter la liste en Excel">
                    <i class="fa-solid fa-file-excel"></i>
                    Exporter la liste en Excel
                  </a>
                  <a href="{{route('authorisations.create')}}" class="btn btn-success">
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
                  <th>Mandataire</th>
                  <th>Relation 1</th>
                  <th>Bénéficiaire</th>
                  <th>Bénéficiaire Contact</th>
                  <th>Relation 2</th>
                  <th>Enfant</th>
                  <th>Etablit le</th>
                  <th>Expire le</th>
                  <th>Statut</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
              <?php $no=1;
                 $bg_status="";
                ?>
                 @foreach ($auths as $key => $value)
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
                 <td>{{$value->citoyen_id}}</td>
                 <td>{{$value->relation_parent}}</td>
                  <td>{{$value->b_surname}} {{$value->b_name}}</td>
                  <td>{{$value->b_contact}}</td>
                  <td>{{$value->relation_parent_2}}</td>
                  <td>{{$value->child_surname}} {{$value->child_name}}</</td>
                  <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                  <td>{{date("d-m-Y", strtotime($value->b_id_expire))}}</td>
                  <td >
                    <span class="badge {{$bg_status}}">{{$value->status}}</span>
                  </td>
                  <td>
                      <form action="{{route('authorisations.destroy',$value->id)}}" method="post">

                        <a href="{{route('authorisations.edit',$value->id)}}" class="btn btn-warning btn-sm mr-1" title="Modifier">
                        <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
                        @if ($value->status == "Validé")
                            <a href="{{route('printAutorisation',$value->id)}}" class="btn btn-primary btn-sm btnprn mr-1" title="Imprimer">
                          <i class="fa fa-print" style="color: #fff;"></i>
                        </a>
                        @endif
                         @if ((Auth::user()->level)=="super-admin" || (Auth::user()->level)=="admin")

                         @csrf
                         @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                          <i class="fa fa-trash" style="color: #fff;"></i>
                        </button>
                       </form>
                       @endif

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
                    <h3 align="center" class="m-0 text-dark">LISTES DES AUTORISATIONS PARENTALES</h3>
                    @else
                    <h3 align="center" class="m-0 text-dark">LISTES DES AUTORISATIONS PARENTALES DU {{date("d-m-Y", strtotime($date1))}} AU {{date("d-m-Y", strtotime($date2))}}</h3>

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
                  <th>Demandeur</th>
                  <th>Relation 1</th>
                  <th>Bénéficiaire</th>
                  <th>Bénéficiaire Contact</th>
                  <th>Relation 2</th>
                  <th>Enfant</th>
                  <th>Expire le</th>
                  <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($auths as $key => $value)
                 <td>{{$no++}}</td>
                 <td>{{$value->citoyen_id}}</td>
                 <td>{{$value->relation_parent}}</td>
                  <td>{{$value->b_surname}} {{$value->b_name}}</td>
                  <td>{{$value->b_contact}}</td>
                  <td>{{$value->relation_parent_2}}</td>
                  <td>{{$value->child_surname}} {{$value->child_name}}</</td>
                  <td>{{date("d-m-Y", strtotime($value->b_id_expire))}}</td>
                  <td >
                    {{$value->status}}
                  </td>
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
           footer: "Bridge PNR",
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
    $(".auth").addClass("active");
    $(".pieces1").addClass("active");
  });
</script>
@endsection
