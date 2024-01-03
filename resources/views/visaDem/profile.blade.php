@extends('layouts.dashboard')
@section('header')
<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Profile du Demandeur</h1>
          <hr align="center" style="width: 15%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<div class="container-fluid">
   <div class="row" style="margin-bottom: 5%;">
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="margin-left: 15%;">
       <div class="profile-env shadow" style="border-radius: 10px;">
        <header class="row" style=" margin-left: 2%;">
          <div class="col-md-3">
            <center>
              <a href="#">
                <img src="/uploads/askers/{{$data->avatar}}" class="img-circle elevation-2" id="wizardPicturePreview" style="width: 90%; margin-top: 20%;">
              </a>
              <h3>
                {{$data->name}} {{$data->name}}        
              </h3>
              <br>
            </center>
          </div>
          <div class="col-md-9">
          <ul class="nav nav-tabs" style=" margin-right:4%;">
            <li class="active">
              <a href="#tab1" data-toggle="tab" class="btn btn-primary active" aria-expanded="true">
                <span class="visible-xs"><i class="entypo-home"></i></span>
                <span class="hidden-xs">Etat Civil</span>
              </a>
            </li>
            <li class="">
              <a href="#tab2" data-toggle="tab" class="btn btn-primary" aria-expanded="false">
                <span class="visible-xs"><i class="entypo-user"></i></span>
                <span class="hidden-xs">Signalement</span>
              </a>
            </li>
              <li class="">
              <a href="#tab3" data-toggle="tab" class="btn btn-primary" aria-expanded="false">
                <span class="visible-xs"><i class="entypo-user"></i></span>
                <span class="hidden-xs">Contacts</span>
              </a>
            </li>
              <li class="">
              <a href="#tab4" data-toggle="tab" class="btn btn-primary" aria-expanded="false">
                <span class="visible-xs"><i class="entypo-user"></i></span>
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
                      <strong>Prenom(s)</strong>
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
                   </tbody>
              </table>
            </div>
            <div class="tab-pane" id="tab2">
              <table class="table table-bordered table-striped" style="margin-top: 20px;">
                  <tbody>
                      <tr>
                        <td width="30%"><strong>Taille</strong></td>
                        <td>{{$data->taille}}</td>
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
                        <td width="30%"><strong>Numéro de la pièce</strong></td>
                        <td>{{$data->id_number}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Date d'émission</strong></td>
                        <td>{{$data->date_emission}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Date d'espiration</strong></td>
                        <td>{{$data->date_expiration}}</td>
                      </tr>
                      <tr>
                        <td width="30%"><strong>Lieu d'établissement</strong></td>
                        <td>{{$data->place_emission}}</td>
                      </tr>                    
                  </tbody>
                </table>
              </div>
        </div>
        </div>
      </header>
      </div>
              <a href="{{route('visa-demand.index')}}" class="btn btn-primary shadow" style="margin-left: 90%; margin-top: 2%;">Retour</a>
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
   $(function () {
    $(".askers00").addClass("menu-open");
    $(".askers0").addClass("active");
    $(".askers").addClass("active");
  });
</script>
@endsection