@extends('layouts.dashboard')
@section('links')
  <!-- DataTables -->
  @include('layouts.datatablestyles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">



@endsection
@section('header')

<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Cartes d'Identité Consulaire</h1>
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
        <div class="col-md-5 mb-3">
          <form action="{{route('findCarteRange')}}" method="POST">
            @csrf
            @method('POST')
            <h5 class="ml-3">Sélectionnez les dates</h5>
            <div class="row ml-4">

               <h6>DU</h6>
          <div class="input-group col-md-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" name="date1" class="form-control float-right" required>
          </div>
            <h6>AU</h6>
          <div class="input-group col-md-4">
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

      <div class="col-md-7 p-2 text-right">
          <a href="#" id="print" class="btn btn-primary btnc ">
              <span class="fa fa-print"></span>
              Imprimer la liste
            </a>
            <a href="{{route('getExcelCartesPrint')}}" class="btn btn-success" title="Exporter la liste en Excel">
                <i class="fa-solid fa-file-excel"></i>
                  Exporter pour impréssion
                </a>
            <a href="{{route('getExcelCartes')}}" class="btn btn-success" title="Exporter la liste en Excel">
            <i class="fa-solid fa-file-excel"></i>
              Exporter la liste en Excel
            </a>
            <a href="{{route('cartes.create')}}" class="btn btn-success">
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
                  <th>N° de la Carte</th>
                  <th>N° Matricule</th>
                  <th>Citoyen</th>
                  <th>Date de délivrance</th>
                  <th>Date d'expiration</th>
                  <th>Statut</th>
                  <th>Type de carte</th>
                  <th>impréssion</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1;
                 $bg_status="";
                 $msg="Carte bloquée"

                ?>
                 @foreach ($data as $key => $value)
                   <?php
                     if($value->date_blocked==null)
                     {
                     //   <!--set the background of the status-->
                        if ($value->card_status=="En saisie") {
                             $bg_status="bg-warning";
                        }
                        elseif ($value->card_status=="Validée") {
                             $bg_status="bg-success";
                        }
                        elseif ($value->card_status=="Rejet") {
                             $bg_status="bg-danger";
                        }

                     }
                     else{

                         $bg_status="bg-danger";

                     }

                ?>
                <tr>
                 <td>{{$no++}}</td>
                  <td>{{$value->card_no}}</td>
                 <td>{{$value->citoyen_no}}</td>
                 <td>{{$value->surname}} {{$value->name}} </td>
                  <td> {{date("d-m-Y", strtotime($value->date_emission))}}</td>
                  <td> {{date("d-m-Y", strtotime($value->date_expiration))}}</td>
                  <td >
                    <span class="badge {{$bg_status}}">
                        @if($value->date_blocked==null)
                         {{$value->card_status}}
                        @else
                          {{$msg}}
                        @endif

                    </span>
                  </td>
                  <td>{{$value->type}}</td>
                  <td >
                    <span class="badge {{$value->print_status=='Imprimée' ? 'bg-primary' : 'bg-warning'}}">
                         {{$value->print_status}}
                    </span>
                  </td>
                  <td>

                       <form action="{{route('cartes.destroy',$value->id)}}" method="post">
                           <!--imprimer-->
                           @if($value->status=="Validée")
                            <a href="{{route('carteView',$value->id)}}" class="btn btn-primary btn-sm mr-1 btnprn" title="Imprimer la carte">
                            <i class="fa fa-print" style="color: #fff;"></i>
		                  	</a>
		                  	@endif
		                  	<!--modifier-->
		                  	<a href="{{route('cartes.edit',$value->id)}}" class="btn btn-warning btn-sm mr-1" title="Modifier">
		                  	<i class="fa fa-pencil" style="color: #fff;"></i>
		                  	</a>
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
                <div style="z-index: 2!imprtant; position: relative!important;">
               <div class="container-fluid text-center">
                 <div class="row mb-2">
                   <div class="col-sm-12">
                    <br><br>
                    @if (empty($date1))
                    <h3 align="center" class="m-0 text-dark">LISTES DES CARTES CONSULAIRES</h3>
                    @else
                    <h3 align="center" class="m-0 text-dark">LISTES DES CARTES CONSULAIRES DU {{date("d-m-Y", strtotime($date1))}} AU {{date("d-m-Y", strtotime($date2))}}</h3>
                    @endif
                    <hr align="center" style="width: 35%">
                    <h6 class="float-right mb-5">{{date("d-m-Y", strtotime(Date('d-m-Y')))}}</h6>
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table id="example2" class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Reference</th>
                  <th>Citoyen</th>
                  <th>Date de delivrance</th>
                  <th>Date d'expiration</th>
                  <th>Type de carte</th>
                  <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr>
                 <td>{{$no++}}</td>
                 <td>{{$value->card_no}}</td>
                 <td>{{$value->name}} {{$value->surname}}</td>
                  <td>{{$value->date_emission}}</td>
                  <td>{{$value->date_expiration}}</td>
                  <td>{{$value->type}}</td>
                  <td>{{$value->card_status}}</td>
                </tr>
                 @endforeach
                </tbody>
              </table>
              </div>
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
<!-- printPage -->
<script src="../../js/jquery.printPage.js"></script>

<!-- print js -->
<script src="../js/printThis.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.btnprn').printPage();
});
</script>
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
<script>
  $(function () {
    $(".cardsc").addClass("active");
  });
</script>
@endsection
