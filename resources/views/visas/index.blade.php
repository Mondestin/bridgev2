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
@if ($message = Session::get('error'))
  <div id="toast-container" class="toast-top-right">
    <div class="toast toast-error" aria-live="polite" style="">
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
          <h1 align="center" class="m-0 text-dark">Listes des Visas</h1>
          <hr align="center" style="width: 15%">
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
        <a href="{{route('visas.create')}}" class="btn ad-btn btnc shadow">
          <span class="fa fa-plus"></span>
          Nouveau
        </a>
        <a href="#" id="print" class="btn btn-primary btnc shadow">
          <span class="fa fa-print"></span>
          Imprimé
        </a>
      </div>
      </div>
                      <!-- /.card-header -->
            <div class="card-body table-responsive shadow">
              <table id="example1" class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>N° de demande</th>
                  <th>Nom(s) & Prénom(s)</th>
                  <th>N° de passport</th>
                  <th>Type de visa</th>
                   <th>Durée</th>
                  <th>Date de délivrance</th>
                  <th>Date de départ</th>
                  <th>Validité</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr> 
                  <td>{{$no++}}</td>
                  <td>{{$value->dem_no}}</td>
                  <td>{{$value->surname}} {{$value->name}}</td>
                  <td>{{$value->passport_no}}</td>
                  <td>{{$value->type}}</td>
                  <td>{{$value->durée}}</td>
                  <td>{{$value->date_emission}}</td>
                  <td>{{$value->depart}}</td>
                  <td>{{$value->status_visa}}</td>               
                  <td>
                     <form action="{{route('visas.destroy', $value->dem_no)}}" method="post">
                        <a href="{{route('visas.edit', $value->dem_no)}}" class="btn btn-warning btn-sm" title="Modifier">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
                        <?php if ($value->dem_status=="Etablit"): ?>
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
                <img src="images/seaus.png" height="100px;">
                 <div class="row mb-2">
                   <div class="col-sm-12">
                    <br><br>
                    <h3 align="center" class="m-0 text-dark">LISTES DES VISAS</h3>
                    <hr align="center" style="width: 15%">
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table id="example2" class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>N° de demande</th>
                  <th>Nom(s) & Prénom(s)</th>
                  <th>N° de passport</th>
                  <th>Type de visa</th>
                   <th>Durée</th>
                  <th>Date de délivrance</th>
                  <th>Date de départ</th>
                  <th>Validité</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr> 
                   <td>{{$no++}}</td>
                  <td>{{$value->dem_no}}</td>
                  <td>{{$value->surname}} {{$value->name}}</td>
                  <td>{{$value->passport_no}}</td>
                  <td>{{$value->type}}</td>
                  <td>{{$value->durée}}</td>
                  <td>{{$value->date_emission}}</td>
                  <td>{{$value->depart}}</td>
                  <td>{{$value->status_visa}}</td>                  
                </tr>
                 @endforeach 
                </tbody>
              </table>
              </div>
          </div>
        <!--End  of table to print -->
            <!-- /.card-body -->
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
          loadCSS: "{{asset('dist/css/AdminLTE.css')}}",                             
          removeInlineSelector: "", 
          printDelay: 333,               
          header: "Bridge | Benin <br> <small>Pointe-Noire</small>",  
          footer: "",                   
           base: "http://127.0.0.1:8000/",                     
          doctypeString: '<!DOCTYPE html>',    
      });
    });
  });
</script>
<script>
   $(function () {
    $(".askers00").addClass("menu-open");
    $(".askers0").addClass("active");
    $(".askers1").addClass("active");
  });
</script>
@endsection