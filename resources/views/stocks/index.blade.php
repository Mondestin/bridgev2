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
          <h1 align="center" class="m-0 text-dark">Gestion des Stocks</h1>
          <hr align="center" style="width: 15%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
 <?php 
                  $date="";
                     setlocale(LC_TIME, "fr_FR");
                    
                  ?>
<section class="content">
  <div class="container-fluid">

           <div class="card card-primary card-outline">
        <div class="container-fluid" style="background: #eee;">
      
        <h4 class="p-3">Mouvement de stocks de: <span class="badge bg-primary">{{date("m-Y", strtotime($mois))}}</span> </h4>
          
        <div class="row col-md-12 pl-4">
          <div class="col-md-7 mb-3">
            <form action="{{route('findMonth')}}" method="POST">
              @csrf
              @method('POST')
              <p class="ml-3">Sélectionnez les dates</p>
              <div class="row ml-4">
            <div class="input-group col-md-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type="month" name="mois" class="form-control float-right" required>
            </div>
            <button type="submit" class="btn btn-primary">
              <span class="fa fa-search"></span>
              Rechercher
            </button>
              </div>
          </form>
          </div>
          <div class="col-md-5 float-right">
            <a href="#" class="btn ad-btn btnc right" data-toggle="modal" data-target="#new-stock">
              <span class="fa fa-plus"></span>
              Entrer un stock
             </a>
              <a href="#" id="print" class="btn btn-primary btnc right">
                <span class="fa fa-print"></span>
                Imprimer la liste
              </a>
            </div>
                </div>
      </div>
      </div>
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped table-sm dataTable mt-5">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Categorie</th>
                  <th>Sock Initial </th>
                  <th>Entrées</th>
                  <th>Date</th>
                  <th>Observations</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; $bg_status="";?>
                 @foreach ($stocks as $key => $value)
                <tr> 
                 <td>{{$no++}}</td>
                  <td>{{$value->category}}</td>
                  <td>{{$value->start}}</td>
                  <td>{{$value->entering}}</td>
                  <td>{{date('d-m-Y', strtotime($value->created_at))}}</td>
                  <td>{{$value->obs}}</td>
                  <td>
                     <form action="{{route('stocks.destroy', $value->id)}}" method="post">
                        
                        <a href="{{route('stocks.edit', $value->id)}}" class="btn btn-warning btn-sm" title="Modifier">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
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
            <!-- /.card-header -->
         </div>
<div class="container"> 
  <h4 class="mt-3">Billant du stock de: <span class="badge bg-primary">{{date("m-Y", strtotime($mois))}}</span>
  </div>
           <div class="row mb-5">
                 <!-- /.card-header -->
            <div class="card-body table-responsive col-md-12">
              <table class="table table-bordered table-striped table-sm dataTable">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Categorie</th>
                  <th>Sock Initial </th>
                  <th>Entrées</th>
                  <th>Total</th>
                  <th>Stock Présent</th>
                  <th>Sorties</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; $bg_status="";?>
                 @foreach ($data as $key => $value)
                <tr> 
                 <td>{{$no++}}</td>
                  <td>{{$value->category}}</td>
                  <td>{{$value->start}}</td>
                  <td>{{$value->entering}}</td>
                  <td>{{$value->entering+$value->start}}</td>
                   <td><h3><span class="badge bg-warning">{{($value->entering+$value->start)-$count_cards}}</span></h3></td>
                   <td><h3><span class="badge bg-success">{{$count_cards}}</span></h3></td>
                </tr>
                 @endforeach 
                </tbody>
              </table>
            </div>
         </div>

  <div class="modal fade" id="new-stock">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nouveau Stock</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('stocks.store') }}" class="needs-validation" novalidate>
                        @csrf
                 <div class="row">
                      <div class="col-md-12 justfy-content-center">
                         <div class="form-group">
                           <div class="col-md-10">
                            <label>Categorie</label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror" required="required">
                                  <option value="Cartes Consulaire">Cartes Consulaire</option>
                            </select>
                       </div>
                            </div>
                        <div class="form-group ">
                            <div class="col-md-10">
                              <label>Stock Initial</label>
                                <input type="number" class="form-control @error('start') is-invalid @enderror" name="start" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                              <label>Entrées</label>
                                <input  type="number" class="form-control @error('entering') is-invalid @enderror" name="entering" value="">
                               
                            </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                        <div class="form-group row mb-0">                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success float-right">
                                   <i class="fa-solid fa-file-arrow-down"></i> Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
  
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- table to print -->
   <div class="card-body table-responsive" style="display: none;">
          <div id="example3">
               <div class="container-fluid text-center">
              
                 <div class="row mb-2">
                   <div class="col-sm-12">
                    <br><br>
                    <h3 align="center" class="m-0 text-dark">Liste des mouvement de stocks de: {{date("d-m-Y", strtotime($mois))}}</h3>
                    <hr align="center" style="width: 35%">
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table id="example3" class="table table-bordered table-striped table-sm dataTable mt-4 mb-5">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Categorie</th>
                  <th>Sock Initial </th>
                  <th>Entrées</th>
                  <th>Date</th>
                  <th>Observations</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; $bg_status="";?>
                 @foreach ($stocks as $key => $value)
                <tr> 
                 <td>{{$no++}}</td>
                  <td>{{$value->category}}</td>
                  <td>{{$value->start}}</td>
                  <td>{{$value->entering}}</td>
                  <td>{{date('d-m-Y', strtotime($value->created_at))}}</td>
                      <td>{{$value->obs}}</td>
                </tr>
                 @endforeach 
                </tbody>
              </table>
        <!--End  of table to print -->
        <div class="container"> 
          <h4 class="mt-3">Billant du stock de: {{date("d-m-Y", strtotime($mois))}}</h4>
          </div>
        <table class="table table-bordered table-striped table-sm dataTable mt-5">
          <thead>
          <tr>
            <th>#</th>
            <th>Categorie</th>
            <th>Sock Initial </th>
            <th>Entrées</th>
            <th>Total</th>
            <th>Stock Présent</th>
            <th>Sorties</th>
          </tr>
          </thead>
          <tbody>
          <?php $no=1; $bg_status="";?>
           @foreach ($data as $key => $value)
          <tr> 
           <td>{{$no++}}</td>
            <td>{{$value->category}}</td>
            <td>{{$value->start}}</td>
            <td>{{$value->entering}}</td>
            <td>{{$value->entering+$value->start}}</td>
             <td><h3>{{($value->entering+$value->start)-$count_cards}}</h3></td>
             <td><h3>{{$count_cards}}</h3></td>
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
           footer: "Bridge PNR",                   
           base: "http://127.0.0.1:8000/",                     
          doctypeString: '<!DOCTYPE html>',    
      });
    });
  });
</script>
<script>
   $(function () {
    $(".stocks").addClass("active");
  });
</script>
@endsection