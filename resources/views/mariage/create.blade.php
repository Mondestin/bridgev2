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
          <h1 align="center" class="m-0 text-dark">Etablissement d'Acte de Mariage</h1>
          <hr align="center" style="width: 25%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
<div class="card card-primary card-outline">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <div class="nav flex-column nav-tabs" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="false">Epoux & Epouse</a>
                  <a class="nav-link " id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="true">Témoins & Autres</a>
                </div>
              </div>
              <div class="col-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane fade active show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">

   <form action="{{route('mariage.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
                     
      <div class="row padd">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-user" aria-hidden="true">              
            </i>&nbsp;Information sur l'Epoux
           </h3>         
        <div class="col-md-12 line_box">
                 <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="mri_surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mri_surname') is-invalid @enderror" name="mri_surname" placeholder="Nom de l'Epoux" value="{{ old('mri_surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prenom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mri_name') is-invalid @enderror" name="mri_name" placeholder="Prenom de l'Epoux" value="{{ old('mri_name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="mri_profession">Profession</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mri_profession') is-invalid @enderror" name="mri_profession" placeholder="Profession" value="{{ old('mri_profession') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="sexe">Date de Naissance</label>
            <span class="red">*</span>
            <input type="date" class="form-control @error('mri_dob') is-invalid @enderror" name="mri_dob" placeholder="Date de Naissance" value="{{ old('mri_dob') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom du père</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mri_pere') is-invalid @enderror" name="mri_pere" placeholder="Nom du père" value="{{ old('mri_pere') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="situation">Nom de la mère</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mri_mere') is-invalid @enderror" name="mri_mere" placeholder="Nom de la mère" value="{{ old('mri_mere') }}">
          </div>
        </div>
         <div class="row">
          <div class="form-group col-md-6">
            <label for="Domicile">Domicile</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mri_domicile') is-invalid @enderror" name="mri_domicile" placeholder="Domicile" value="{{ old('mri_domicile') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="mri_auto_judi">Autorisation Judiciaire</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mri_auto_judi') is-invalid @enderror" name="mri_auto_judi" placeholder="Autorisation Judiciaire" value="{{ old('mri_auto_judi') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="mri_auto_parent">Autorisation Parentale</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('mri_auto_parent') is-invalid @enderror" name="mri_auto_parent" placeholder="Autorisation Parentale" value="{{ old('mri_auto_parent') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="dispense_age">Dispense d'Age</label>
            <span class="red">*</span>
            <input type="number" class="form-control @error('mri_dispense_age') is-invalid @enderror" name="mri_dispense_age" placeholder="Dispense d'Age" value="{{ old('mri_dispense_age') }}">
          </div>
        </div>
        </div>        
       </div>



          <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-user" aria-hidden="true">              
            </i>&nbsp;Information sur l'Epouse
           </h3>         
       <div class="col-md-12 line_box">
                 <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="fem_surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('fem_surname') is-invalid @enderror" name="fem_surname" placeholder="Nom de l'Epouse" value="{{ old('fem_surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prenom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('fem_name') is-invalid @enderror" name="fem_name" placeholder="Prenom de l'Epouse" value="{{ old('fem_name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="fem_profession">Profession</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('fem_profession') is-invalid @enderror" name="fem_profession" placeholder="Profession" value="{{ old('fem_profession') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="sexe">Date de Naissance</label>
            <span class="red">*</span>
            <input type="date" class="form-control @error('fem_dob') is-invalid @enderror" name="fem_dob" placeholder="Date de Naissance" value="{{ old('fem_dob') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom du père</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('fem_pere') is-invalid @enderror" name="fem_pere" placeholder="Nom du père" value="{{ old('fem_pere') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="situation">Nom de la mère</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('fem_mere') is-invalid @enderror" name="fem_mere" placeholder="Nom de la mère" value="{{ old('fem_mere') }}">
          </div>
        </div>
         <div class="row">
          <div class="form-group col-md-6">
            <label for="Domicile">Domicile</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('fem_domicile') is-invalid @enderror" name="fem_domicile" placeholder="Domicile" value="{{ old('fem_domicile') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="fem_auto_judi">Autorisation Judiciaire</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('fem_auto_judi') is-invalid @enderror" name="fem_auto_judi" placeholder="Autorisation Judiciaire" value="{{ old('fem_auto_judi') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="fem_auto_parent">Autorisation Parentale</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('fem_auto_parent') is-invalid @enderror" name="fem_auto_parent" placeholder="Autorisation Parentale" value="{{ old('fem_auto_parent') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="fem_dispense_age">Dispense d'Age</label>
            <span class="red">*</span>
            <input type="number" class="form-control @error('fem_dispense_age') is-invalid @enderror" name="fem_dispense_age" placeholder="Dispense d'Age" value="{{ old('fem_dispense_age') }}">
          </div>
        </div>
        </div>        
       </div>     
       </div><!-- end Left side elements -->
      </div>
      <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
      
      <div class="row padd">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-user" aria-hidden="true">              
            </i>&nbsp;1er Témoin
           </h3>         
        <div class="col-md-12 line_box">
                 <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="mri_surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t1_surname') is-invalid @enderror" name="t1_surname" placeholder="Nom" value="{{ old('t1_surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prenom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t1_name') is-invalid @enderror" name="t1_name" placeholder="Prenom" value="{{ old('t1_name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="t1_profession">Profession</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t1_profession') is-invalid @enderror" name="t1_profession" placeholder="Profession" value="{{ old('t1_profession') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="t1_domicile">Domicile</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t1_domicile') is-invalid @enderror" name="t1_domicile" placeholder="Domicile" value="{{ old('t1_domicile') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Majeur">Majeur</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t1_majeur') is-invalid @enderror" name="t1_majeur" placeholder="Majeur" value="{{ old('t1_majeur') }}">
          </div>
        </div>
        </div>        
       </div>
      <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-user" aria-hidden="true">              
            </i>&nbsp;2eme Témoin
           </h3>         
        <div class="col-md-12 line_box">
                 <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="mri_surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t2_surname') is-invalid @enderror" name="t2_surname" placeholder="Nom" value="{{ old('t2_surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prenom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t2_name') is-invalid @enderror" name="t2_name" placeholder="Prenom" value="{{ old('t2_name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="t2_profession">Profession</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t2_profession') is-invalid @enderror" name="t2_profession" placeholder="Profession" value="{{ old('t2_profession') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="t2_domicile">Domicile</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t2_domicile') is-invalid @enderror" name="t2_domicile" placeholder="Domicile" value="{{ old('t2_domicile') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Majeur">Majeur</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('t2_majeur') is-invalid @enderror" name="t2_majeur" placeholder="Majeur" value="{{ old('t2_majeur') }}">
          </div>
        </div>
        </div>        
       </div>

          <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-user" aria-hidden="true">              
            </i>&nbsp;Interprète
           </h3>         
        <div class="col-md-12 line_box">
                 <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="it_surname">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('it_surname') is-invalid @enderror" name="it_surname" placeholder="Nom" value="{{ old('it_surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prenom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('it_name') is-invalid @enderror" name="it_name" placeholder="Prenom" value="{{ old('it_name') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="it_profession">Profession</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('it_profession') is-invalid @enderror" name="it_profession" placeholder="Profession" value="{{ old('it_profession') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="it_domicile">Domicile</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('it_domicile') is-invalid @enderror" name="it_domicile" placeholder="Domicile" value="{{ old('it_domicile') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Majeur">Majeur</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('it_majeur') is-invalid @enderror" name="it_majeur" placeholder="Majeur" value="{{ old('it_majeur') }}">
          </div>
        </div>
        </div>        
       </div>

       <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-users" aria-hidden="true">              
            </i>&nbsp;Mariage
           </h3>         
        <div class="col-md-12 line_box">
                 <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="date_mariage">Date du Mariage</label>
            <span class="red">*</span>
            <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" name="date_mariage" placeholder="Date du Mariage" value="{{ old('date_mariage') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Heure du Mariage</label>
            <span class="red">*</span>
            <input type="time" class="form-control @error('heure_mariage') is-invalid @enderror" name="heure_mariage" placeholder="Heure du Mariage" value="{{ old('heure_mariage') }}">
          </div>
        </div>
        </div>        
       </div>
     </div>
  <div class="box-footer text-right">
    <button type="submit" class="btn btn-success shadow"><i class="fa-solid fa-file-arrow-down"></i> Enregistrer</button>&nbsp;&nbsp;
     <a href="{{route('mariage.index')}}" class="btn btn-primary shadow"><i class="fa-solid fa-arrow-left"></i> Retour</a>
  </div>
  </form> 
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.card -->
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
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
     $("#toast-container").fadeOut(12000);
  });
</script>
<script>
   $(function () {
    $(".pieces").addClass("menu-open");
    $(".nais1").addClass("active");
    $(".pieces1").addClass("active");
  });
</script>
@endsection