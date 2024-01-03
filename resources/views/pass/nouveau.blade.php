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
          <h1 align="center" class="m-0 text-dark">Fiche d'établissement de laissez-passer</h1>
          <hr align="center" style="width: 25%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="box-body no-pad">
     <div class="col-md-12">
      <div class="card card-primary card-outline">
        
<div class="row" style="margin-top: 2%; margin-left: 1%; border-radius: 10px;">
  <div class="col-md-4">
          <div class="form-group">
            <label for="Name">Choisir le Citoyen</label>
            <span class="red">*</span><br>
            <select class="form-control select2 citoyensSelect">
              <option hidden="hidden">Choisir un citoyen</option>
              @foreach ($citoyens as $key => $value)
                 <option value="{{$value->id}}">{{$value->citoyen_no}} | {{$value->surname}} | {{$value->name}}
                 </option>
              @endforeach 
            </select>
            <form id="selectForm" action="{{route('searchCitoyens')}}"> 
                 @csrf
                 <input type="text" name="id" value="" id="idS" style="display: none;"> 
            </form>
          </div>
  </div>
    <div class="col-md-4">
          <div class="form-group mt-4">
             <label for="Name"></label>
             <button class="btn btn-success" id="enableInputs"> <span class="fa fa-add"></span> Entrée directe </button>
          </div>
  </div>
</div>
 <form action="{{route('pass.store')}}"  method="POST">
    @csrf
    @method('POST')
      <div class="row padd">
        <input type="text" name="id_number" value="{{$data->citoyen_no  ?? ''}}" style="display: none;">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-info" aria-hidden="true">              
            </i>&nbsp;Information du citoyen
           </h3>         
        <div class="col-md-12 line_box">
                    <!-- PROFILE PICTURE -->
            <div class="row" style="margin-left: 32%;">
              <div class="col-sm-4 col-sm-offset-1">
                <div class="picture-container">
                  <div class="picture">
                      <img src="../uploads/citoyens/{{$data->avatar  ?? 'user.png'}}" class="picture-src"  title=""/>
                  </div>
                </div>
              </div>
          </div>
          <!--/ PROFILE PICTURE --> 
        <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $data->surname ?? '' }}" readonly="readonly">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prenom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name ?? ''}}" readonly="readonly">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="eye_color">Couleur des yeux</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('eye_color') is-invalid @enderror" name="eye_color" value="{{ $data->eye_color ?? '' }}" readonly="readonly">
          </div>
          <div class="form-group col-md-6">
            <label for="cheuveux">Cheveux</label>
            <span class="red">*</span>
            <input name="cheuveux" class="form-control @error('cheuveux') is-invalid @enderror" value="{{ $data->cheuveux ?? '' }}" readonly="readonly">           
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="Name">Signe particuliers</label>
            <span class="red">*</span>
            <input class="form-control @error('pa_sign') is-invalid @enderror" name="pa_sign" value="{{ $data->pa_sign ?? '' }}" style="height:70px;" readonly="readonly">
          </div>
        </div>
        </div>         
       </div><!-- end Left side elements -->

            <!-- right side elements -->

     <div class="col-md-6">
           <h3 class="box-title" style="margin-top: 2%;"> 
              <i class="fa fa-card" aria-hidden="true">               
              </i>&nbsp;Information du Lassez Passer 
            </h3>
      <div class="line_box">
                              <!-- Put inputs here --> 
        <div class="row">
          <div class="form-group col-md-6">
            <label for="type">Voyage</label>
            <span class="red">*</span>
            <input class="form-control" name="voyage" value="Un seul voyage aller" readonly="readonly">
          </div>
        <div class="form-group col-md-6">
            <label for="Name">Validité pièce</label>
            <span class="red"></span>
          <select class="form-control" name="validity" disabled="disabled">
          <option value="Pièce en cours de validité">Pièce en cours de validité</option>
          <option value="Pièce expirée">Pièce expirée</option>
          </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="card_status">Date d'émission</label>
            <span class="red">*</span>       
            <input type="date" class="form-control @error('date_emission') is-invalid @enderror" name="date_emission">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Date d'expiration</label>
            <span class="red"></span>
            <input type="date" class="form-control @error('date_expiration') is-invalid @enderror" name="date_expiration">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="Name">Accompagné de:</label>
            <span class="red"></span>
             <textarea class="form-control" placeholder="Entrez les noms de personnes qui accompagne le citoyen" name="link_with"></textarea>
          </div>
        </div>
     </div>

   </div><!-- end right side elements -->
  </div>
  <div class="box-footer text-right">
     <button type="submit" class="btn btn-success"><i class="fa-solid fa-file-arrow-down"></i> Enregistrer</button>&nbsp;&nbsp;
     <a href="{{route('pass.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Retour</a>
  </div>
</form>
</div>
</div>
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
        $(document).ready(function () {
            $('#enableInputs').on('click', function () {
               
                // Enable all inputs with the 'readonly' attribute within the specified scope
                $('.line_box input[readonly]').prop('readonly', false);
                $('.line_box select[disabled]').prop('disabled', false);
                $('.line_box textarea[readonly]').prop('readonly', false);
            });
        });
    </script>
<script>
  $(function () {
    $(".pass-card").addClass("active");
  });
</script>
@endsection