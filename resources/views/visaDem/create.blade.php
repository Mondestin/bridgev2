@extends('layouts.dashboard')
@section('links')
  <!-- bootstrap-datetimepicker -->
<link href="../dist/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<!-- <link href="../css/gsdk-bootstrap-wizard.css" rel="stylesheet"> -->
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection
@section('header')
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
          <h1 align="center" class="m-0 text-dark">Fiche d'enregistrement d'un Demandeur de Visa</h1>
          <hr align="center" style="width: 50%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="container-fluid">
   <form action="{{route('visa-demand.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="box-body no-pad">
     <div class="col-md-12">
      <div class="card card-info shadow">
      <div class="row padd">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-info" aria-hidden="true">              
            </i>&nbsp;Etat Civil
           </h3>         
        <div class="col-md-12 line_box">
                    <!-- PROFILE PICTURE -->
            <div class="row" style="margin-left: 35%;">
              <div class="col-sm-4 col-sm-offset-1">
                <div class="picture-container">
                  <div class="picture">
                      <img src="/images/users/user.png" class="picture-src" id="wizardPicturePreview" title=""/>
                      <input type="file" id="wizard-picture" name="avatar" class="form-control">
                  </div>
                  <h6>Photo</h6>
                </div>
              </div>
          </div>
          <!--/ PROFILE PICTURE --> 
                 <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" placeholder="Nom du demandeur" value="{{ old('surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prenom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Prenom du demandeur" value="{{ old('name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label for="dob">Date de Naissance</label>
            <span class="red">*</span>
            <input type="text" id="myDatepicker2" class="form-control @error('dob') is-invalid @enderror" name="dob" placeholder="Date de Naissance" value="{{ old('dob') }}">
          </div>
          <div class="form-group col-md-3">
            <label for="sexe">Sexe</label>
            <span class="red">*</span>
            <select name="sexe" class="form-control @error('sexe') is-invalid @enderror" required="required">
              <option hidden="">Sexe</option>
              <option value="Masculin">Masculin</option>
              <option value="Féminin">Féminin</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="Name">Nationalité</label>
            <span class="red">*</span>
          <select name="nationality" class="form-control @error('nationality') is-invalid @enderror">
              <option value="Béninoise">Béninoise</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="Name">Lieu de Naissance</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('pofbirth') is-invalid @enderror" name="pofbirth" placeholder="Lieu de Naissance" value="{{ old('pofbirth') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom du père</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('father') is-invalid @enderror" name="father" placeholder="Nom du père" value="{{ old('father') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Nom de la mère</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mother') is-invalid @enderror" name="mother" placeholder="Nom de la mère" value="{{ old('mother') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Profession</label>
            <span class="red">*</span>
            <input type="text" class="form-control  @error('profession') is-invalid @enderror" name="profession" placeholder="Profession" value="{{ old('profession') }}">
          </div>
        </div>  

        </div>         
       </div><!-- end Left side elements -->

            <!-- right side elements -->
     <div class="col-md-6">
           <h3 class="box-title"> 
              <i class="fa fa-exclamation" aria-hidden="true">               
              </i>&nbsp;Signalement 
            </h3>
       <div class="line_box">
                              <!-- Put inputs here --> 
        <div class="row">
          <div class="form-group col-md-4">
            <label for="Name">Taille(m)</label>
            <span class="red">*</span>
            <input type="text" class="form-control numbers @error('taille') is-invalid @enderror" name="taille" placeholder="Ex: 1.80m" value="{{ old('taille') }}">
          </div>
          <div class="form-group col-md-4">
            <label for="Name">Couleur des yeux</label>
            <span class="red">*</span>
            <input type="text" class="form-control numbers @error('eye_color') is-invalid @enderror" name="eye_color" placeholder="Couleur des yeux" value="{{ old('eye_color') }}">
          </div>
          <div class='form-group col-md-4 '>
            <label for="Name">Cheuveux</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('cheuveux') is-invalid @enderror" placeholder="Cheuveux"  name="cheuveux">
          </div>
        </div>
        <div class="row">
          <div class='form-group col-md-12'>
            <label for="Name">Signes particulers</label>
            <span class="red">*</span>
            <textarea type="text" class="form-control @error('pa_sign') is-invalid @enderror"  placeholder="Signes particulers"  name="pa_sign"></textarea> 
          </div>
        </div>
     </div>
<br>
        <h3 class="box-title"> 
              <i class="fa fa-phone" aria-hidden="true">               
              </i>&nbsp; Contacts
            </h3>
      <div class="line_box">
      <!-- Put inputs here --> 
      <div class="row">                     
      <div class="form-group col-md-6">
            <label for="Name">Addresse Pays d'origine</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('addressFirstCountry') is-invalid @enderror" name="addressFirstCountry" placeholder="Addresse Pays d'origine" value="{{ old('addressFirstCountry') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Addresse Pays d'acceuil</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('addressSecondCountry') is-invalid @enderror" name="addressSecondCountry" placeholder="Addresse Pays d'acceuil" value="{{ old('addressSecondCountry') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Tuteur</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('tuteur') is-invalid @enderror" name="tuteur" placeholder="Tuteur" value="{{ old('tuteur') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Téléphone</label>
            <span class="red">*</span>
            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Téléphone" value="{{ old('phone') }}">
          </div>
        </div>   
        </div>   
    <br>
        <h3 class="box-title"> 
              <i class="fa fa-user" aria-hidden="true">               
              </i>&nbsp; Pièce d'Indentité Présenté
            </h3>
      <div class="line_box">
      <!-- Put inputs here --> 
      <div class="row">                     
      <div class="form-group col-md-6">
            <label for="Name">Numero de la pièce</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" placeholder="Numero de la pièce" value="{{ old('id_number') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Date d'établissement</label>
            <span class="red">*</span>
            <input type="text" id="myDatepicker3" class="form-control @error('date_emission') is-invalid @enderror" name="date_emission" placeholder="Date d'établissement" value="{{ old('date_emission') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Date d'expiration</label>
            <span class="red">*</span>
            <input type="text" id="myDatepicker4" class="form-control @error('date_expiration') is-invalid @enderror" name="date_expiration" placeholder="Date d'expiration" value="{{ old('date_expiration') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Lieu d'établissement</label>
            <span class="red">*</span>
           <input type="text" class="form-control @error('place_emission') is-invalid @enderror" name="place_emission" placeholder="Lieu d'établissement" value="{{ old('place_emission') }}">
          </div>
        </div>   
        </div>
    <br>
        <h3 class="box-title"> 
              <i class="fa fa-cc-visa" aria-hidden="true">               
              </i>&nbsp; Information sur le visa
            </h3>
      <div class="line_box">
      <!-- Put inputs here --> 
      <div class="row">                     
         <div class="form-group col-md-6">
            <label for="type">Type de Visa</label>
            <span class="red">*</span>
            <select class="form-control @error('type') is-invalid @enderror" name="type" id="visa_type">
              <option value="" hidden="hidden">Choisir le type</option>
              <option value="Transit">Visa transit</option>
              <option value="Court séjour">Visa court séjour</option>
              <option value="Double entrée">Visa double entrée</option>
              <option value="Entrée multiple">Visa entrée multiple</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="durée">Durée en jours</label>
            <span class="red">*</span>
            <input type="text" name="durée" class="form-control" readonly="readonly" id="temps" value="">
          </div>
        </div>
        </div>

     </div>
   </div><!-- end right side elements -->
  </div>
  <div class="box-footer text-right">
     <button type="submit" class="btn btn-success shadow">Ajouter</button>&nbsp;&nbsp;
     <a href="{{route('visa-demand.index')}}" class="btn btn-primary shadow">Retour</a>
  </div>
</div>
</div>
</form>     
</div>
</div>
@endsection
@section('scripts')
<!-- bootstrap-datetimepicker -->    
<script src="../dist/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/js/visa-logic.js"></script>
<script>
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#myDatepicker3').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#myDatepicker4').datetimepicker({
        format: 'YYYY-MM-DD'
    });
</script>
<script type="text/javascript">
   // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    }); 
   //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
  $(function () {
    $("#example1").DataTable();
     $("#toast-container").fadeOut(12000);
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