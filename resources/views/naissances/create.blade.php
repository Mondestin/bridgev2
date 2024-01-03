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
          <h1 align="center" class="m-0 text-dark">Etablissement d'un Acte de Naissance</h1>
          <hr align="center" style="width: 30%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="container-fluid">
   <form action="{{route('naissances.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="box-body no-pad">
     <div class="col-md-12">
      <div class="card card-primary card-outline">
      <div class="row padd">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-user" aria-hidden="true">              
            </i>&nbsp;Information sur l'enfant
           </h3>         
        <div class="col-md-12 line_box">
                 <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" placeholder="Nom de l'enfant" value="{{ old('surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Prénom de l'enfant" value="{{ old('name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label for="dob">Date de Naissance</label>
            <span class="red">*</span>
            <input type="date" id="myDatepicker2" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" placeholder="Date de Naissance" value="{{ old('date_of_birth') }}">
          </div>
          <div class="form-group col-md-3">
            <label for="sexe">Sexe</label>
            <span class="red">*</span>
            <select name="sexe" class="form-control @error('sexe') is-invalid @enderror">
              <option  value="" hidden="hidden">Sexe</option>
              <option value="Masculin">Masculin</option>
              <option value="Féminin">Féminin</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="Name">Heure</label>
            <span class="red">*</span>
             <input type="time" name="time" class="form-control @error('time') is-invalid @enderror">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="Name">Lieu de Naissance</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('place') is-invalid @enderror" name="place" placeholder="Lieu de Naissance" value="{{ old('place') }}">
          </div>
        </div>
        </div><br>
              <h3 class="box-title"> 
              <i class="fa fa-info" aria-hidden="true">               
              </i>&nbsp; Information sur le Père
            </h3>
      <div class="line_box">
      <!-- Put inputs here --> 
        <div class="row">
          <div class="form-group col-md-6">
            <label for="f_surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('f_surname') is-invalid @enderror" name="f_surname" placeholder="Nom du Père" value="{{ old('f_surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="f_name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('f_name') is-invalid @enderror" name="f_name" placeholder="Prénom du Père" value="{{ old('f_name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="f_age">Age</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('f_age') is-invalid @enderror" name="f_age" placeholder="Age du Père" value="{{ old('f_age') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="f_profession">Proféssion</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('f_profession') is-invalid @enderror" name="f_profession" placeholder="Profession du Père" value="{{ old('f_profession') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="f_adress">Domicile</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('f_adress') is-invalid @enderror" name="f_adress" placeholder="Domicile du Père" value="{{ old('f_adress') }}">
          </div>
           <div class="form-group col-md-6">
            <label for="f_nationality">Nationalité</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('f_nationality') is-invalid @enderror" name="f_nationality" placeholder="Nationalité du Père" value="{{ old('f_nationality') }}">
          </div>

        </div>   
        </div>   
    <br>         
       </div><!-- end Left side elements -->

            <!-- right side elements -->
     <div class="col-md-6">
              <h3 class="box-title"> 
              <i class="fa fa-info" aria-hidden="true">               
              </i>&nbsp; Information sur la Mère
            </h3>
      <div class="line_box">
      <!-- Put inputs here --> 
        <div class="row">
          <div class="form-group col-md-6">
            <label for="m_surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('m_surname') is-invalid @enderror" name="m_surname" placeholder="Nom de la  Mère" value="{{ old('f_surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="m_name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('m_name') is-invalid @enderror" name="m_name" placeholder="Prénom de la  Mère" value="{{ old('m_name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="m_age">Age</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('m_age') is-invalid @enderror" name="m_age" placeholder="Age de la  Mère" value="{{ old('m_age') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="m_profession">Proféssion</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('m_profession') is-invalid @enderror" name="m_profession" placeholder="Profession de la Mère" value="{{ old('m_profession') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="m_adress">Domicile</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('m_adress') is-invalid @enderror" name="m_adress" placeholder="Domicile du Mère" value="{{ old('m_adress') }}">
          </div>
           <div class="form-group col-md-6">
            <label for="m_nationality">Nationalité</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('m_nationality') is-invalid @enderror" name="m_nationality" placeholder="Nationalité de la Mère" value="{{ old('m_nationality') }}">
          </div>
        </div>   
        </div>
        <br>
                   <!-- right side elements -->
    
              <h3 class="box-title"> 
              <i class="fa fa-info" aria-hidden="true">               
              </i>&nbsp; Information sur le Déclarant
            </h3>
      <div class="line_box">
      <!-- Put inputs here --> 
        <div class="row">
          <div class="form-group col-md-6">
            <label for="d_surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('d_surname') is-invalid @enderror" name="d_surname" placeholder="Nom du Déclarant" value="{{ old('d_surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="d_name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('d_name') is-invalid @enderror" name="d_name" placeholder="Prénom du Déclarant" value="{{ old('d_name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="d_age">Age</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('d_age') is-invalid @enderror" name="d_age" placeholder="Age du Déclarant" value="{{ old('d_age') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="d_profession">Proféssion</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('d_profession') is-invalid @enderror" name="d_profession" placeholder="Proféssion du Déclarant" value="{{ old('d_profession') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="d_adress">Domicile</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('d_adress') is-invalid @enderror" name="d_adress" placeholder="Domicile du Déclarant" value="{{ old('d_adress') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Realtion">Rélation</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('relation') is-invalid @enderror" name="relation" placeholder="Rélation avec l'enfant" value="{{ old('relation') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="declare_date">Date de Déclaration</label>
            <span class="red">*</span>
            <input type="date" class="form-control @error('declare_date') is-invalid @enderror" name="declare_date" value="{{ old('declare_date') }}">
          </div>
        </div>        
     </div>    
     </div>

   </div><!-- end right side elements -->
  </div>
  <div class="box-footer text-right">
     <button type="submit" class="btn btn-success shadow"><i class="fa-solid fa-file-arrow-down"></i> Enregistrer</button>&nbsp;&nbsp;
     <a href="{{route('naissances.index')}}" class="btn btn-primary shadow"><i class="fa-solid fa-arrow-left"></i> Retour</a>
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
    $(".pieces").addClass("menu-open");
    $(".nais").addClass("active");
    $(".pieces1").addClass("active");
  });
</script>
@endsection