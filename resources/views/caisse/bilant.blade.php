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
          <h1 align="center" class="m-0 text-dark">Statistiques des Ventes</h1>
          <hr align="center" style="width: 20%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
<div class="card shadow card-primary card-outline">
              <div class="card-header border-0">
                <div class="card-tools">
                  Total des Ventes: <h4><strong>{{$total}}</strong> FrcFa</h4>
                </div>
          <a href="#" id="print" class="btn btn-primary btnc shadow left">
          <span class="fa fa-print"></span>
          Imprimé
        </a>
              </div>
   
              <div class="card-body">
                <table class="table table-bordered table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Type</th>
                    <th>Prix Unitaire</th>
                    <th>Vendu</th>
                    <th>Montant Total</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      Acte de Naissance
                    </td>
                    <td>{{$data->naissance}}</td>
                    <td>
                      {{$no_naissance}}
                    </td>
                    <td>
                        <strong>{{$naissance_total }}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Acte de Mariage
                    </td>
                    <td>{{$data->mariage}}</td>
                    <td>
                      {{$no_mariage}}
                    </td>
                    <td>
                      <strong>{{$mariage_total }}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Acte de Décès
                    </td>
                    <td>{{$data->deces}}</td>
                    <td>
                        {{$no_deces }}
                    </td>
                    <td>
                       <strong>{{$deces_total }}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Lassez-Passer
                    </td>
                    <td>{{$data->passer}}</td>
                    <td>
                         {{$no_pass_card }}        
      
                    </td>
                    <td>
                        <strong>{{$cards_total }}</strong> FrcFa
                    </td>
                  </tr>
                   <tr>
                    <td>
                      Visa de transit
                    </td>
                    <td>{{$data->visas1}}</td>
                    <td>
                         {{$no_transit}}
                    </td>
                    <td>
                         <strong>{{$transit_total}}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                     <td>
                      Visa Court Séjour
                    </td>
                    <td>{{$data->visas2}}</td>
                    <td>
                        {{$no_court}}
                    </td>
                    <td>
                         <strong>{{$court_total}}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Visa Double Entrée 
                    </td>
                    <td>{{$data->visas3}}</td>
                    <td>
                       {{$no_entre}}
                    </td>
                    <td>
                        <strong>{{$entre_total}}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Visa Mulitiple Entrée 
                    </td>
                    <td>{{$data->visas4}}</td>
                    <td>
                        {{$no_multiple }}
                    </td>
                    <td>
                       <strong>{{$multiple_total }}</strong> FrcFa 
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Nouvelle Carte Consulaire
                    </td>
                    <td>{{$data->carte1}}</td>
                    <td>
                       {{$no_con_card}}
                    </td>
                    <td>
                       <strong>{{$consular_total}}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Renouvellement Carte Consulaire
                    </td>
                    <td>{{$data->carte2}}</td>
                      <td>
                       {{$no_con_card1}}
                    </td>
                    <td>
                       <strong>{{$consular_total1}}</strong> FrcFa
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>


<!-- table to print -->
        <div class="card-body table-responsive" style="display: none;">
          <div id="example8">
               <div class="container-fluid text-center">
                <img src="images/seau.png" height="100px;">
                 <div class="row mb-2">
                   <div class="col-sm-12">
                    <br><br>
                    <h3 align="center" class="m-0 text-dark">STATISTIQUES DES VENTES</h3>
                    <hr align="center" style="width: 30%">
                   </div><!-- /.col -->
               </div><!-- /.row -->

              <table class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Prix Unitaire</th>
                    <th>Vendu</th>
                    <th>Montant Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                      Acte de Naissance
                    </td>
                    <td>{{$data->naissance}}</td>
                    <td>
                      {{$no_naissance}}
                    </td>
                    <td>
                        <strong>{{$naissance_total }}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Acte de Mariage
                    </td>
                    <td>{{$data->mariage}}</td>
                    <td>
                      {{$no_mariage}}
                    </td>
                    <td>
                      <strong>{{$mariage_total }}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Acte de Décès
                    </td>
                    <td>{{$data->deces}}</td>
                    <td>
                        {{$no_deces }}
                    </td>
                    <td>
                       <strong>{{$deces_total }}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Lassez-Passer
                    </td>
                    <td>{{$data->passer}}</td>
                    <td>
                         {{$no_pass_card }}        
      
                    </td>
                    <td>
                        <strong>{{$cards_total }}</strong> FrcFa
                    </td>
                  </tr>
                   <tr>
                    <td>
                      Visa de transit
                    </td>
                    <td>{{$data->visas1}}</td>
                    <td>
                         {{$no_transit}}
                    </td>
                    <td>
                         <strong>{{$transit_total}}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                     <td>
                      Visa Court Séjour
                    </td>
                    <td>{{$data->visas2}}</td>
                    <td>
                        {{$no_court}}
                    </td>
                    <td>
                         <strong>{{$court_total}}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Visa Double Entrée 
                    </td>
                    <td>{{$data->visas3}}</td>
                    <td>
                       {{$no_entre}}
                    </td>
                    <td>
                        <strong>{{$entre_total}}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Visa Mulitiple Entrée 
                    </td>
                    <td>{{$data->visas4}}</td>
                    <td>
                        {{$no_multiple }}
                    </td>
                    <td>
                       <strong>{{$multiple_total }}</strong> FrcFa 
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Nouvelle Carte Consulaire
                    </td>
                    <td>{{$data->carte1}}</td>
                    <td>
                       {{$no_con_card}}
                    </td>
                    <td>
                       <strong>{{$consular_total}}</strong> FrcFa
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Renouvellement Carte Consulaire
                    </td>
                    <td>{{$data->carte2}}</td>
                      <td>
                       {{$no_con_card1}}
                    </td>
                    <td>
                       <strong>{{$consular_total1}}</strong> FrcFa
                    </td>
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
               <div class="card-tools right">
                  Total des Ventes: <h3><strong>{{$total}}</strong> Fcfa</h3>
                </div>
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
<script>
  $(function () {
     $("#toast-container").fadeOut(12000);
    $("#print").click(function(){
      $("#example8").printThis({       
          loadCSS: "{{asset('dist/css/AdminLTE.css')}}",                             
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
    $(".caisse").addClass("active");
  });
</script>
@endsection