@extends('layouts.dashboard')
@section('links')
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection
@section('header')

<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Brouillard de caisse</h1>
          <hr align="center" style="width: 10%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content --> 
 <?php 
                  $date="";
                     setlocale(LC_TIME, "fr_FR");
                    $mois=Date('Y-m-d');
                  ?>
<section class="content">
  <div class="container-fluid">

           <div class="card card-primary card-outline">
           
        <div class="container-fluid" style="background: #eee;">
      
        <h4 class="p-3">Brouillard de caisse du: <span class="badge bg-primary">{{date("d-m-Y", strtotime($date1))}}</span> Au <span class="badge bg-primary">{{date("d-m-Y", strtotime($date2))}}</span></h4>
          <div class="col-md-12">
            <form action="{{route('findMonthRange')}}" method="POST">
            @csrf
            @method('POST')
            <h5 class="ml-3">Sélectionnez les dates</h5>
            <div class="row ml-4">

               <h6>DU</h6>
          <div class="input-group col-md-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" name="date1" class="form-control float-right">
          </div>
            <h6>AU</h6>
          <div class="input-group col-md-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" name="date2" class="form-control float-right">
          </div>
                    <button type="submit" class="btn btn-primary">
             <span class="fa fa-search"></span>
            Rechercher
          </button>
            </div>
         

        </form>
        <a href="#" id="print" class="btn btn-primary btnc  right">
          <span class="fa fa-print"></span>
          Imprimer le brouillard
        </a>
          </div>
      </div>
       <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm dataTable mt-4">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Libellés</th>
                  <th>Entrées</th>
                  <th>Sorties</th>
                  <th>Solde</th>
                </tr>
                </thead>
                <tbody>
                        <?php 
                       $total=0;
                       $total_in=0;
                       $total_out=0;
                    ?>
                 @foreach ($data as $key => $value)
                  
                <tr> 
                 <td>{{date("d-m-Y", strtotime($value->updated_at))}}</td>
                 <td>
                   @if (($value->types) == "Validé")
                     {{$value->dem_no}}
                   @else
                    {{$value->types}} N° {{$value->dem_no}}
                   @endif
                 </td>
                 @if ($value->types == "Validé")
                   <td></td>
                   <td><small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        
                      </small>{{$value->montant}}</td>
                 @else
                   <td><small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                     
                      </small>{{$value->montant}}</td>
                   <td></td>
                 @endif
                 <td>
                        <?php 
 
                        if ($value->types=="Validé") {
                             $total =($total-$value->montant);
                              $total_out=$total_out+$value->montant;
                        }
                        else{
                             ($total=$total+$value->montant);
                             $total_in=$total_in+$value->montant;;
                        }
                    ?>
                    {{$total}}
                </td>
                </tr> 
                @endforeach 
                <tr>
                  <td>
                      <b><h4>Total </h4></b>
                  </td>
                 <td></td>
              <td>
                    <b><h4>{{$total_in}} Fcfa</h4></b>
                  </td>
                    <td>
                     <b><h4>{{$total_out}} Fcfa</h4></b>
                  </td>
                  <td>
                      <b><h4>
                       <?php 
                        $bg_status="";
                     //   <!--set the background of the status-->
                        if ($total<0) {
                             $bg_status="bg-danger";
                        }
                        elseif (($total>0) && ($total<100000)) {
                             $bg_status="bg-warning";
                        }
                        elseif ($total>100000) {
                             $bg_status="bg-success";
                        }
                    ?>

                        <span class="badge {{$bg_status}}">{{$total}} Fcfa</span></h4></b>
                  </td>
                </tr>
                </tbody>
              </table>
                </div>
            </div>
            <!-- /.card-header -->
         </div>
<div style="display: none;">
            <div id="brouilard" class="card-body table-responsive">

                <div class="container-fluid text-center">
                   <h6 class="float-right mb-5">{{date("d-m-Y", strtotime($mois))}}</h6>
                        <h2 class="mt-5">
                          BROUILLARD DE CAISSE DU {{date("d-m-Y", strtotime($date1))}} AU {{date("d-m-Y", strtotime($date2))}}
                        </h2>
                </div>
              <table id="example1" class="table table-bordered table-striped table-sm dataTable mt-4">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Libellés</th>
                  <th>Entrées</th>
                  <th>Sorties</th>
                  <th>Solde</th>
                </tr>
                </thead>
                <tbody>
                        <?php 
                       $total=0;
                       $total_in=0;
                       $total_out=0;
                    ?>
                 @foreach ($data as $key => $value)
                  
                <tr> 
                 <td>{{date("d-m-Y", strtotime($value->updated_at))}}</td>
                 <td>
                   @if (($value->types) == "Validé")
                     {{$value->dem_no}}
                   @else
                    {{$value->types}} N° {{$value->dem_no}}
                   @endif
                 </td>
                 @if ($value->types == "Validé")
                   <td></td>
                   <td><small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        
                      </small>{{$value->montant}}</td>
                 @else
                   <td><small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                     
                      </small>{{$value->montant}}</td>
                   <td></td>
                 @endif
                 <td>
                        <?php 
                           
                            
                        if ($value->types=="Validé") {
                             $total =($total-$value->montant);
                              $total_out=$total_out+$value->montant;
                        }
                        else{
                             ($total=$total+$value->montant);
                             $total_in=$total_in+$value->montant;;
                        }
                    ?>
                    {{$total}} 
                </td>
                </tr> 
                @endforeach 
                <tr>
                  <td>
                      <b><h4>Total </h4></b>
                  </td>
                 <td></td>
              <td>
                    <b><h4>{{$total_in}} Fcfa</h4></b>
                  </td>
                    <td>
                     <b><h4>{{$total_out}} Fcfa</h4></b>
                  </td>
                  <td>
                      <b><h4>
                        {{$total}} Fcfa</h4></b>
                  </td>
                </tr>
                </tbody>
              </table>
              <div class="container-fluid text-center mt-4">
                        <h5>
                          Arrêté le présent brouillard de caisse à la somme de: <b>{{$total}} Fcfa</b>
                        </h5>
                </div>
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
      $("#brouilard").printThis({       
           loadCSS: "{{asset('dist/css/adminlte.css')}}",                               
          removeInlineSelector: "", 
          printDelay: 333,               
           header: "CONSULAT GENERAL HONORAIRE DU BENIN  <br> <small>Pointe-Noire</small><br> <small>BP: 1216</small> <br><br>", 
           footer: "Bridge PNR",                   
           base: "http://127.0.0.1:8000/",                     
          doctypeString: '<!DOCTYPE html>',    
      });
    });
  });
</script>
<script>
   $(function () {
    $(".caisse").addClass("menu-open");
    $(".caisse1").addClass("active");
    $(".rapports").addClass("active");
  });
</script>
@endsection