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
          <h1 align="center" class="m-0 text-dark">Gestion des Sorties de Caisse</h1>
          <hr align="center" style="width: 22%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
 <?php
                  $date="";
                     setlocale(LC_TIME, "fr_FR");

                  ?>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="card card-primary card-outline">
      <div class="container-fluid pl-4" style="background: #eee;">
        <h4 class="p-3">Sortie de caisse de: <span class="badge bg-primary">{{date("m-Y", strtotime($mois))}}

        </span> </h4>
        <div class="row col-md-12">
        <div class="col-md-9 pl-5 mb-4">
             <form action="{{route('findMonthSorties')}}" method="POST">
            @csrf
            @method('POST')
          <h6>Sélectionner le mois</h6>
            <div class="row">
                    <input type="month" class="form-control col-md-2" name="mois">
                <button class="btn btn-primary ml-2">
                  <span class="fa fa-search"></span>
                  Rechercher
                </button>
            </div>
        </form>
        </div>
      <div class="col-md-3">
        <a href="#" id="print" class="btn btn-primary">
          <span class="fa fa-print"></span>
          Imprimer la liste
        </a>
        <a href="#" class="btn btn-success " data-toggle="modal" data-target="#modal-emttre">
          <span class="fa fa-plus"></span>
          Nouvelle sortie
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
                  <th>Date Emission</th>
                  <th>Date Traité</th>
                  <th>Intitulé</th>
                  <th>Description</th>
                  <th>Montant</th>
                  <th>Commentaire</th>
                  <th>Statut</th>
                  <!--<th>Emit Par</th>-->

                  @if ((Auth::user()->level)=="super-admin" || (Auth::user()->level)=="admin")
                  <th>Options</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $no=1;  $bg_status="";?>
                 @foreach ($data as $key => $value)
                 <?php
                     //   <!--set the background of the status-->
                        if ($value->status=="en traitement") {
                             $bg_status="bg-warning";
                        }
                        elseif ($value->status=="Validé") {
                             $bg_status="bg-success";
                        }
                        elseif ($value->status=="Rejeté") {
                             $bg_status="bg-danger";
                        }
                    ?>
                <tr>
                 <td>{{$no++}}</td>
                  <td>{{date('d-m-Y', strtotime($value->created_at))}}</td>
                  <td>{{date('d-m-Y', strtotime($value->updated_at))}}</td>
                 <td>{{$value->title}}</td>
                  <td>{{$value->desc}}</td>
                  <td>{{$value->amount}}</td>
                  <td>{{$value->comment}}</td>
                  <td><span class="badge {{$bg_status}}">{{$value->status}}</span></td>
                  <!--<td>{{$value->emit_by}}</td>-->


                   @if ((Auth::user()->level)=="super-admin" || (Auth::user()->level)=="admin")
                  <td>
              <form action="{{route('sorties.destroy',$value->id)}}" method="post">

                        <a href="{{route('sorties.edit',$value->id)}}" class="btn btn-warning btn-sm" title="Modifier">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
                         @csrf
                         @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                          <i class="fa fa-trash" style="color: #fff;"></i>
                        </button>
                   </form>
                   </td>
                     @endif
                </tr>
                 @endforeach
                </tbody>
              </table>
            </div>


<!-- /.modal emit new-->
  <div class="modal fade" id="modal-emttre">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <form action="{{route('sorties.store')}}" method="POST">
              @csrf
              @method('POST')
            <div class="modal-header">
              <h4 class="modal-title">Nouvelle Emission de sortie</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-4">
                   <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Intitulé</label>
            <span class="red">*</span>
                <select name="title" class="form-control @error('title') is-invalid @enderror">
              <option  value="" hidden="hidden">Choisir l'intitulé</option>
              <option value="Paiement fature d'eau">Paiement fature d'eau</option>
              <option value="Paiement facture d'électricité">Paiement facture d'électricité</option>
              <option value="Achat carburant">Achat carburant</option>
              <option value="Achat matériels et produits d'entretien">Achat matériels et produits d'entretien</option>
              <option value="Achat fournitures de bureau">Achat fournitures de bureau</option>
              <option value="Achats petit matériel et outillage">Achats petit matériel et outillage</option>
              <option value="Achat d'étude et prestation de service">Achat d'étude et prestation de service</option>
              <option value="Achat services">Achat services</option>
              <option value="Achat travaux, matériel et équipement">Achat travaux, matériel et équipement</option>
              <option value="Transport de plis">Transport de plis</option>
              <option value="Voyage et déplacement">Voyage et déplacement</option>
              <option value="Transport administratif">Transport administratif</option>
              <option value="Entretien et rép des biens immobilié">Entretien et rép des biens immobilié</option>
              <option value="Assurance matériel de transport">Assurance matériel de transport</option>
              <option value="Asurances risques d'exploitation">Asurances risques d'exploitation</option>
              <option value="Autres primes d'assurances">Autres primes d'assurances</option>
              <option value="Frais téléphone">Frais téléphone</option>
              <option value="Frais internet">Frais internet</option>
              <option value="Frais bancaires">Frais bancaires</option>
              <option value="Honoraires">Honoraires</option>
              <option value="Rénumération personnel">Rénumération personnel</option>
              <option value="Primes sur salaire">Primes sur salaire</option>
              <option value="Frais de formation du personnel">Frais de formation du personnel</option>
              <option value="Frais de recrutement du personnel">Frais de recrutement du personnel</option>
              <option value="Receptions">Receptions</option>
              <option value="Frais de mission">Frais de mission</option>
              <option value="Impots et Taxes">Impots et Taxes</option>
              <option value="Taxe de roulage">Taxe de roulage</option>
              <option value="Droit douanes et frais dédouanement">Droit douanes et frais dédouanement</option>
              <option value="Taxes sur les véhicules de société">Taxes sur les véhicules de société</option>
              <option value="Autres droits d'enregistrement">Autres droits d'enregistrement</option>
              <option value="Autres amandes pénale et fiscale">Autres amandes pénale et fiscale</option>
              <option value="Autres impots et Taxes">Autres impots et Taxes</option>
              <option value="Charges diverses">Charges diverses</option>
              <option value="Dons et pourboires">Dons et pourboires</option>
              <option value="Primes et gratifications">Primes et gratifications</option>
              <option value="Aide sociale">Aide sociale</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label for="Name">Montant</label>
            <span class="red">*</span>
            <input type="number"  class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}">
          </div>

        </div>
                <div class="row">
           <div class="form-group col-md-12">
            <label for="Name">Description</label>
            <span class="red">*</span>
           <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" rows="4" cols="10">{{ old('desc') }}</textarea>
          </div>
        </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success"> <i class="fa-solid fa-file-arrow-down"></i> Emettre</button>
            </div>
            </form>
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
                    <h3 align="center" class="m-0 text-dark">LISTES DES SORTIES DE {{date('m-Y', strtotime($mois))}}</h3>
                    <hr align="center" style="width: 35%">
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table id="example2" class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                    <th>#</th>
                  <th>Intitulé</th>
                  <th>Description</th>
                  <th>Montant</th>
                  <th>Commentaire</th>
                  <th>Statut</th>
                  <th>Emit Par</th>
                  <th>Date Emission</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $val)
                <tr>
                  <td>{{$no++}}</td>
                 <td>{{$val->title}}</td>
                  <td>{{$val->desc}}</td>
                  <td>{{$val->amount}}</td>
                  <td>{{$val->comment}}</td>
                  <td>{{$val->status}}</td>
                  <td>{{$val->emit_by}}</td>
                    <td>{{date('m-Y', strtotime($val->created_at))}}</td>
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
    $(".caisse").addClass("menu-open");
    $(".caisse1").addClass("active");
    $(".sorties").addClass("active");
  });
</script>
@endsection
