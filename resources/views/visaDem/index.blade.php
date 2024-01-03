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
          <h1 align="center" class="m-0 text-dark">Listes des Demandeurs de Visa</h1>
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
        <a href="{{route('visa-demand.create')}}" class="btn ad-btn btnc">
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
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>Photo</th>
                  <th>Matricule</th>
                  <th>Nom(s)</th>
                  <th>Prenom(s)</th>
                  <th>Sexe</th>
                  <th>Date de naissance</th>
                  <th>Nationalité</th>
                  <th>Type</th>
                  <th>Statut</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr> 
                 <td>
                  <div class="image">
                    <img src="uploads/askers/{{$value->avatar}}" class="img-circles elevation-2" alt="User">
                   </div>                   
                  </td>
                  <td>{{$no++}}</td>
                  <td>{{$value->surname}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->sexe}}</td>
                  <td>{{$value->dob}}</td>
                  <td>{{$value->nationality}}</td>
                  <td>{{$value->type}}</td>
                  <td>{{$value->dem_status}}</td>                
                  <td>
                     <form action="{{route('visa-demand.destroy', $value->id)}}" method="post">
                        <a href="{{route('visa-demand.show', $value->id)}}" class="btn btn-success btn-sm" title="Profile">
                          <i class="fa fa-eye" ></i>
                        </a>
                        <a href="{{route('visa-demand.edit', $value->id)}}" class="btn btn-warning btn-sm" title="Modifier">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
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
                    <h3 align="center" class="m-0 text-dark">LISTES DES DEMANDEURS DE VISAS</h3>
                    <hr align="center" style="width: 35%">
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table id="example2" class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>Matricule</th>
                  <th>Nom(s)</th>
                  <th>Prenom(s)</th>
                  <th>Sexe</th>
                  <th>Date de naissance</th>
                  <th>Nationalité</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Contact</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr> 
                  <td>{{$no++}}</td>
                  <td>{{$value->surname}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->sexe}}</td>
                  <td>{{$value->dob}}</td>
                  <td>{{$value->nationality}}</td>
                  <td>{{$value->type}}</td>
                  <td>{{$value->dem_status}}</td>
                  <td>{{$value->phone}}</td>                   
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
<!-- page script -->
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
    $(".askers").addClass("active");
  });
</script>
@endsection