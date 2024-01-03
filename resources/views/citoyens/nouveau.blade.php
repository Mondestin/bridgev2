@extends('layouts.dashboard')
@section('links')
  <!-- bootstrap-datetimepicker -->
<link href="../dist/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<!-- <link href="../css/gsdk-bootstrap-wizard.css" rel="stylesheet"> -->
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection
@section('header')

<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Fiche d'enregistrement d'un Citoyen</h1>
          <hr align="center" style="width: 30%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="container-fluid">
   <form action="{{route('citoyens.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="box-body no-pad">
     <div class="col-md-12">
      <div class="card card-primary card-outline">
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
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" placeholder="Nom du citoyen" value="{{ old('surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Prénom du citoyen" value="{{ old('name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label for="dob">Date de Naissance</label>
            <span class="red">*</span>
            <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" placeholder="Date de Naissance" value="{{ old('dob') }}">
          </div>
          <div class="form-group col-md-3">
            <label for="sexe">Sexe</label>
            <span class="red">*</span>
            <select name="sexe" class="form-control @error('sexe') is-invalid @enderror">
                @if(old('sexe'))
                 <option value="{{ old('sexe') }}" selected hidden>{{ old('sexe') }}</option>
                @endif
              <option value="" hidden>Choisir le sexe</option>
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
            <label for="Name">Profession</label>
            <span class="red">*</span>
            <input type="text" class="form-control  @error('profession') is-invalid @enderror" name="profession" placeholder="Profession" value="{{ old('profession') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Coutume</label>
            <span class="red"></span>
            <input type="text" class="form-control @error('coutume') is-invalid @enderror" name="coutume" placeholder="Coutume" value="{{ old('coutume') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom du père</label>
            <span class="red"></span>
            <input type="text" class="form-control @error('father') is-invalid @enderror" name="father" placeholder="Nom du père" value="{{ old('father') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Nom de la mère</label>
            <span class="red"></span>
            <input type="text" class="form-control @error('mother') is-invalid @enderror" name="mother" placeholder="Nom de la mère" value="{{ old('mother') }}">
          </div>
        </div>
        </div>
       </div><!-- end Left side elements -->

            <!-- right side elements -->
     <div class="col-md-6">
           <h3 class="box-title">
              <i class="fa fa-exclamation" aria-hidden="true">
              </i>&nbsp;Signalements
            </h3>
       <div class="line_box">
                              <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-4">
            <label for="Name">Taille(cm)</label>
            <span class="red">*</span>
            <input type="number" class="form-control numbers @error('taille') is-invalid @enderror" name="taille" placeholder="Taille" value="{{ old('taille') }}">
          </div>
          <div class="form-group col-md-4">
            <label for="Name">Couleur des yeux</label>
            <span class="red">*</span>
            <input type="text" class="form-control numbers @error('eye_color') is-invalid @enderror" name="eye_color" placeholder="Couleur des yeux" value="{{ old('eye_color') }}">
          </div>
          <div class='form-group col-md-4 '>
            <label for="Name">Cheveux</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('cheuveux') is-invalid @enderror" placeholder="Cheveux" name="cheuveux" value="{{ old('cheuveux') }}">
          </div>
        </div>
        <div class="row">
          <div class='form-group col-md-12'>
            <label for="Name">Signes particulers</label>
            <span class="red"></span>
            <textarea type="text" class="form-control @error('pa_sign') is-invalid @enderror"  placeholder="Signes particulers"  name="pa_sign">{{ old('pa_sign') }}</textarea>
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
            <span class="red"></span>
            <input type="text" class="form-control @error('addressFirstCountry') is-invalid @enderror" name="addressFirstCountry" placeholder="Addresse Pays d'origine" value="{{ old('addressFirstCountry') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Addresse Pays d'acceuil</label>
            <span class="red"></span>
            <input type="text" class="form-control @error('addressSecondCountry') is-invalid @enderror" name="addressSecondCountry" placeholder="Addresse Pays d'acceuil" value="{{ old('addressSecondCountry') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Tuteur</label>
            <span class="red"></span>
            <input type="text" class="form-control @error('tuteur') is-invalid @enderror" name="tuteur" placeholder="Tuteur" value="{{ old('tuteur') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Téléphone</label>
            <span class="red">*</span>
            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Téléphone" value="{{ old('phone') }}">
          </div>
        </div>
           <div class="row">
          <div class="form-group col-md-12">
            <label for="Name">Email</label>
            <span class="red"></span>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}">
          </div>
        </div>
        </div>
    <br>
        <h3 class="box-title">
              <i class="fa fa-user" aria-hidden="true">
              </i>&nbsp; Pièce d'Identité Présenté
            </h3>
      <div class="line_box">
      <!-- Put inputs here -->
      <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Statut de l'identité</label>
            <span class="red">*</span>
               <select name="id_status" class="form-control @error('id_status') is-invalid @enderror">
                  @if(old('id_status'))
                 <option value="{{ old('id_status') }}">{{ old('id_status') }}</option>
                @endif
             
              <option hidden="" value="">Choisir le statut</option>
              <option value="Confirmée">Confirmé</option>
              <option value="Non confirmée">Non confirmé</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Type de la pièce</label>
            <span class="red">*</span>
               <select name="id_type" class="form-control @error('id_type') is-invalid @enderror">
                @if(old('id_type'))
                 <option value="{{ old('id_type') }}">{{ old('id_type') }}</option>
                @endif
              <option hidden="" value="">Choisir le type</option>
              <option value="Passport">Passport</option>
              <option value="CNI">CNI</option>
               <option value="CIP">CIP</option>
              <option value="Acte de Naissance">Acte de Naissance</option>
              <option value="Extrait d'Acte de Naissance">Extrait d'Acte de Naissance</option>
              
            </select>
          </div>
        </div>
      <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Numéro de la pièce</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" placeholder="Numero de la pièce" value="{{ old('id_number') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Date d'établissement</label>
            <span class="red">*</span>
            <input type="date"  class="form-control @error('date_emission') is-invalid @enderror" name="date_emission" placeholder="Date d'établissement" value="{{ old('date_emission') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Date d'expiration</label>
            <span class="red">*</span>
            <input type="date"  class="form-control @error('date_expiration') is-invalid @enderror" name="date_expiration" placeholder="Date d'expiration" value="{{ old('date_expiration') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Lieu d'établissement</label>
            <span class="red">*</span>
           <input type="text" class="form-control @error('place_emission') is-invalid @enderror" name="place_emission" placeholder="Lieu d'établissement" value="{{ old('place_emission') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Télécharger le document (JPG, JPEG, PNG)</label>
            <span class="red">*</span>
            <input type="file"  class="form-control @error('id_doc') is-invalid @enderror m-3" name="id_doc" placeholder="Date d'expiration" value="{{ old('doc_file') }}">
          </div>
        </div>
        </div>
     </div>
   </div><!-- end right side elements -->
  </div>
  <div class="box-footer text-right">
     <button type="submit" class="btn btn-success"><i class="fa-solid fa-file-arrow-down"></i> Enregistrer</button>&nbsp;&nbsp;
     <a href="{{route('citoyens.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Retour</a>
  </div>
</div>
</div>
</form>
</div>

@endsection
@section('scripts')
<!-- bootstrap-datetimepicker -->
<script src="../dist/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>


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
    $(".citoyens0").addClass("menu-open");
    $(".citoyens1").addClass("active");
    $(".citoyens22").addClass("active");
  });
</script>
@endsection
