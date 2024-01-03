@extends('layouts.dashboard')
@section('links')
  <!-- bootstrap-datetimepicker -->
<link href="../dist/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.css">
@endsection
@section('header')

<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Nouvelle Légalisation</h1>
          <hr align="center" style="width: 16%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="box-body no-pad">
     <div class="col-md-12">
      <div class="card card-primary card-outline">
        

 <form action="{{route('legalisations.store')}}"  method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
      <div class="row padd">
        <input type="text" name="id_number" value="{{$data->citoyen_no  ?? ''}}" style="display: none;">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-info" aria-hidden="true">              
            </i>&nbsp;Information sur le Citoyen
           </h3>         
        <div class="col-md-12 line_box">

        <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')}}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="phone">Téléphone</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <span class="red">*</span>
            <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">           
          </div>
        </div>
        </div>         
       </div><!-- end Left side elements -->
            <!-- right side elements -->
     <div class="col-md-6">
           <h3 class="box-title"> 
              <i class="fa fa-info" aria-hidden="true">              
            </i>            
              &nbsp;Information sur le Diplome
            </h3>
       <div class="line_box">
            <div class="row">
          <div class="form-group col-md-6">
            <label for="school_name">Nom de l'établissement</label>
            <span class="red">*</span>
            <input type="text" class="form-control numbers @error('school_name') is-invalid @enderror" name="school_name" value="{{ old('school_name') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="type_legalisation">Type de légalisation</label>
            <span class="red">*</span>
            <select name="type_legalisation" class="form-control @error('type_legalisation') is-invalid @enderror">
                @if(old('type_legalisation'))
                 <option value="{{ old('type_legalisation') }}" selected hidden>{{ old('type_legalisation') }}</option>
                @endif
              <option  value="" hidden="hidden">Choisir le type</option>
              <option value="Copie Conforme">Copie Conforme</option>
              <option value="Signature">Signature</option>
            </select>
           
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="place_emission">Délivré à</label>
            <span class="red">*</span>
            <input type="text" class="form-control numbers @error('place_emission') is-invalid @enderror" name="place_emission" value="{{ old('place_emission') }}">
          </div>
          <div class="form-group col-md-6">
            <label for="type">Type de document</label>
            <span class="red">*</span>
            <input type="text" class="form-control numbers @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="date_delivrance">Date de délivrance</label>
            <span class="red">*</span>
            <input type="date" class="form-control numbers @error('date_delivrance') is-invalid @enderror" name="date_delivrance" value="{{ old('date_delivrance') }}">
          </div>
           <div class="form-group col-md-6">
            <label for="document">Télécharger le document (JPG, JPEG, PNG)</label>
            <span class="red">*</span>
            <input type="file" class="form-control numbers @error('document') is-invalid @enderror" name="document">
          </div>
        </div>
     </div>
    

   </div><!-- end right side elements -->
  </div>

   <div class="box-footer text-right">
     <button type="submit" class="btn btn-success"><i class="fa-solid fa-file-arrow-down"></i> Enregistrer</button>&nbsp;&nbsp;
     <a href="{{route('legalisations.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Retour</a>
  </div>
  </form>
</div>
</div>
@endsection
@section('scripts')
<!-- bootstrap-datetimepicker -->    
<script src="../dist/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>

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
     $("#toast-container").fadeOut(12000);
  });
</script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.citoyensSelect').change(function(e){
    var value= $(this).val();
     $('#idS').val(value);
       $('#selectForm').submit();
    });
    
  })
</script>   
<script>
  $(function () {
    $(".legalisations").addClass("active");
    $(".pieces").addClass("menu-open");
    $(".pieces1").addClass("active");
  });
</script>
<!-- -->
@endsection