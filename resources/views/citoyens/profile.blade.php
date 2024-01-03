@extends('layouts.dashboard')
@section('header')
<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Profil du Citoyen</h1>
          <hr align="center" style="width: 15%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<div class="container-fluid">
   <div class="row p-3" style="margin-bottom: 5%;">
      <div class="col-md-12 col-lg-12">
       <div class="Profil-env" style="border-radius: 10px;">
        <header class="row" style=" margin-left: 2%;">
          <div class="col-md-3">
            <center>
              <!--<a href="#">-->
                    <img src="{{asset('uploads/citoyens')}}/{{$data->avatar}}" class="elevation-2"  style="width: 90%; margin-top: 20%;">
              <!--</a>-->
              <h3 class="mt-3">
                {{$data->surname}} {{$data->name}} <br>
                   {{$data->citoyen_no}}
              </h3>
              <a href="{{asset('uploads/citoyens')}}/{{$data->avatar}}" class="btn btn-info btn-sm" download><span class="fa fa-download"></span> Télécharger l'image</a>
              <br>
            </center>
          </div>
          <div class="col-md-7">
          <ul class="nav nav-tabs" style=" margin-right:4%;">
            <li class="active">
              <a href="#tab1" data-toggle="tab" class="btn btn-primary active" aria-expanded="true">
                <i class="fa-solid fa-user"></i>
                <span class="hidden-xs">Etat Civil</span>
              </a>
            </li>
            <li class="">
              <a href="#tab2" data-toggle="tab" class="btn btn-primary" aria-expanded="false">
                <i class="fa-solid fa-exclamation"></i>
                <span class="hidden-xs">Signalement</span>
              </a>
            </li>
              <li class="">
              <a href="#tab3" data-toggle="tab" class="btn btn-primary" aria-expanded="false">
               <i class="fa-solid fa-address-book"></i>
                <span class="hidden-xs">Contacts</span>
              </a>
            </li>
              <li class="">
              <a href="#tab4" data-toggle="tab" class="btn btn-primary" aria-expanded="false">
                <i class="fa-solid fa-id-badge"></i>
                <span class="hidden-xs">Pièce d'identité présentée</span>
              </a>
            </li>
          </ul>

          <div class="tab-content" style=" margin-right:4%;">
            <div class="tab-pane active" id="tab1">
           <table class="table table-bordered table-striped" style="margin-top: 20px;">
                <tbody>
                   <tr>
                    <td width="0%">
                      <strong>Nom(s)</strong>
                    </td>
                    <td>{{$data->surname}}</td>
                  </tr>
                    <tr>
                    <td width="30%">
                      <strong>Prénom(s)</strong>
                    </td>
                    <td>{{$data->name}}</td>
                  </tr>
                    <tr>
                    <td width="30%">
                      <strong>Sexe</strong>
                    </td>
                    <td>{{$data->sexe}}</td>
                  </tr>
                  <tr>
                    <td width="30%">
                      <strong>Date de naissance</strong>
                    </td>
                    <td>{{$data->dob}}</td>
                  </tr>
                    <tr>
                    <td width="30%">
                      <strong>Lieu de naissance</strong>
                    </td>
                    <td>{{$data->pofbirth}}</td>
                  </tr>
                    <tr>
                    <td width="30%">
                      <strong>Nom du Père</strong>
                    </td>
                    <td>{{$data->father}}</td>
                  </tr>
                   <tr>
                    <td width="30%">
                      <strong>Nom de la Mère</strong>
                    </td>
                    <td>{{$data->mother}}</td>
                  </tr>
                    <tr>
                    <td width="30%">
                      <strong>Profession</strong>
                    </td>
                    <td>{{$data->profession}}</td>
                  </tr>
                    <tr>
                    <td width="30%">
                      <strong>Coutume</strong>
                    </td>
                    <td>{{$data->coutume}}</td>
                  </tr>
                   </tbody>
              </table>
            </div>
            <div class="tab-pane" id="tab2">
              <table class="table table-bordered table-striped" style="margin-top: 20px;">
                  <tbody>
                      <tr>
                        <td width="30%"><strong>Taille</strong></td>
                        <td>{{$data->taille}}  cm</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Couleur des yeux</strong></td>
                        <td>{{$data->eye_color}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Cheuveux</strong></td>
                        <td>{{$data->cheuveux}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Signes particuliers</strong></td>
                        <td>{{$data->pa_sign}}</td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="tab3">
              <table class="table table-bordered table-striped" style="margin-top: 20px;">
                  <tbody>
                      <tr>
                        <td width="30%"><strong>Adresse Pays d'Origine</strong></td>
                        <td>{{$data->addressFirstCountry}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Adresse Pays d'Acceuil</strong></td>
                        <td>{{$data->addressSecondCountry}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Tuteur</strong></td>
                        <td>{{$data->tuteur}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Téléphone</strong></td>
                        <td>{{$data->phone}}</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            <div class="tab-pane" id="tab4">
              <table class="table table-bordered table-striped" style="margin-top: 20px;">
                  <tbody>
                 
                      <tr>
                        <td width="30%"><strong>Statut ID</strong></td>
                        <td>{{$data->id_status}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Numéro de la pièce</strong></td>
                        <td>{{$data->id_number}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Date d'émission</strong></td>
                        <td>{{$data->date_emission}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Date d'expiration</strong></td>
                        <td>{{$data->date_expiration}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Lieu d'établissement</strong></td>
                        <td>{{$data->place_emission}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Document ID</strong></td>
                        <td>
                            @if (!empty($data->id_doc))
                                <a href="{{asset('uploads/citoyens/ids')}}/{{$data->id_doc}}" target="_blank" class="btn btn-success btn-sm">
                                    <span class="fa fa-eye"></span> Voir le document
                                </a>
                            @else
                            @endif
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
        </div>
        </div>
      </header>
      </div>
      <div class="container">
      <div class="row mt-4 right">
          	 <a href="#" id="print" class="btn btn-primary ">
					<span class="fa fa-print"></span>
					Imprimer ce Profil
				</a>
              <a href="{{route('citoyens.index')}}" class="btn btn-primary ml-2" ><i class="fa-solid fa-arrow-left"></i> Retour</a>
      </div>
      </div>
      </div>

           <!-- div to print -->
        <div class="card-body table-responsive" style="display: none;">
          <div id="example3">
               <div class="container-fluid text-center">
                 <div class="row mb-2">
                <div class="col-sm-12">
                    <!--<br><br>-->
                    <h3 align="center" class="m-0 text-dark">Profil du citoyen</h3>
                    <hr align="center" style="width: 24%">
                   </div><!-- /.col -->
        </div>


      <div class="row">
          <div class="col-md-4 text-center">
                <img src="{{asset('uploads/citoyens')}}/{{$data->avatar}}" class="elevation-2" id="wizardPicturePreview" style="width: 20%;">
              <h3 class="mt-4">
                 {{$data->citoyen_no}}
              </h3>
          </div>

          <div class=" col-md-8">
            <div class="col-md-4">
                <table class="table table-bordered table-striped" >
                <tbody>
                   <tr>
                    <td>
                      <strong>Nom(s)</strong>
                    </td>
                    <td>{{$data->surname}}</td>
                  </tr>
                    <tr>
                    <td>
                      <strong>Prénom(s)</strong>
                    </td>
                    <td>{{$data->name}}</td>
                  </tr>
                    <tr>
                    <td>
                      <strong>Sexe</strong>
                    </td>
                    <td>{{$data->sexe}}</td>
                  </tr>
                  <tr>
                    <td>
                      <strong>Date de naissance</strong>
                    </td>
                    <td>{{$data->dob}}</td>
                  </tr>
                    <tr>
                    <td>
                      <strong>Lieu de naissance</strong>
                    </td>
                    <td>{{$data->pofbirth}}</td>
                  </tr>
                    <tr>
                    <td>
                      <strong>Nom du Père</strong>
                    </td>
                    <td>{{$data->father}}</td>
                  </tr>
                   <tr>
                    <td>
                      <strong>Nom de la Mère</strong>
                    </td>
                    <td>{{$data->mother}}</td>
                  </tr>
                    <tr>
                    <td>
                      <strong>Profession</strong>
                    </td>
                    <td>{{$data->profession}}</td>
                  </tr>
                    <tr>
                    <td>
                      <strong>Coutume</strong>
                    </td>
                    <td>{{$data->coutume}}</td>
                  </tr>
                      <tr>
                        <td><strong>Taille</strong></td>
                        <td>{{$data->taille}}</td>
                      </tr>
                      <tr>
                        <td><strong>Couleur des yeux</strong></td>
                        <td>{{$data->eye_color}}</td>
                      </tr>
                      <tr>
                        <td><strong>Cheveux</strong></td>
                        <td>{{$data->cheuveux}}</td>
                      </tr>
                      <tr>
                        <td><strong>Signes particuliers</strong></td>
                        <td>{{$data->pa_sign}}</td>
                      </tr>
                      <tr>
                        <td><strong>Adresse Pays d'Origine</strong></td>
                        <td>{{$data->addressFirstCountry}}</td>
                      </tr>
                      <tr>
                        <td><strong>Adresse Pays d'Acceuil</strong></td>
                        <td>{{$data->addressSecondCountry}}</td>
                      </tr>
                      <tr>
                        <td><strong>Tuteur</strong></td>
                        <td>{{$data->tuteur}}</td>
                      </tr>
                      <tr>
                        <td><strong>Téléphone</strong></td>
                        <td>{{$data->phone}}</td>
                      </tr>
                      <tr>
                        <td><strong>Numéro de la pièce</strong></td>
                        <td>{{$data->id_number}}</td>
                      </tr>
                      <tr>
                        <td><strong>Date d'émission</strong></td>
                        <td>{{$data->date_emission}}</td>
                      </tr>
                      <tr>
                        <td><strong>Date d'espiration</strong></td>
                        <td>{{$data->date_expiration}}</td>
                      </tr>
                      <tr>
                        <td><strong>Lieu d'établissement</strong></td>
                        <td>{{$data->place_emission}}</td>
                      </tr>
                  </tbody>
                </table>
         </div>

                </div>
        </div>
        </div>


               </div>
              </div>

              </div>
          </div>
        <!--End  of div to print -->


    </div>
</div>
@endsection
@section('scripts')
<!-- print js -->
<script src="{{asset('js/printThis.js')}}"></script>
<script>
  $(function () {
    $(".citoyens0").addClass("menu-open");
    $(".citoyens1").addClass("active");
    $(".citoyens2").addClass("active");
  });
</script>
<script>
  $(function () {
    var table=$("#example1");
     $("#toast-container").fadeOut(12000);

    table.on("click", ".delete", function(){
      $tr=$(this).closest("tr");
      if ($($tr).hasClass("child")) {
          $tr=$tr.prev(".parent");
      }
      var data=table.row($tr).data();
        $("#control2").val(data[1]);

    });
    $("#print").click(function(){
      $("#example3").printThis({
          loadCSS: "{{asset('dist/css/AdminlLTE.css')}}",
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
@endsection
