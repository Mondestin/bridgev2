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
          <h1 align="center" class="m-0 text-dark">Actualisé le laissez-passer</h1>
          <hr align="center" style="width: 20%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="box-body no-pad">
     <div class="col-md-12">
      <div class="card card-primary card-outline">
        
 <form action="{{route('pass.update',$id)}}"  method="POST">
    @csrf
    @method('PATCH')
      <div class="row padd">
        <input type="text" name="id_number" value="{{$id_number}}" style="display: none;">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-info" aria-hidden="true">              
            </i>&nbsp;Information du citoyen
           </h3>         
        <div class="col-md-12 line_box">
                    <!-- PROFILE PICTURE -->
            <div class="row" style="margin-left: 35%;">
              <div class="col-sm-4 col-sm-offset-1">
                <div class="picture-container">
                  <div class="picture">
                      <img src="/uploads/citoyens/{{$avatar}}" class="picture-src" id="wizardPicturePreview" title=""/>
                  </div>
                  <h6>Photo</h6>
                </div>
              </div>
          </div>
          <!--/ PROFILE PICTURE --> 
        <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $surname}}" readonly="readonly">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $name}}" readonly="readonly">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="eye_color">Couleur des yeux</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('eye_color') is-invalid @enderror" name="eye_color" value="{{ $eye_color}}" readonly="readonly">
          </div>
          <div class="form-group col-md-6">
            <label for="cheuveux">Cheveux</label>
            <span class="red">*</span>
            <input name="cheuveux" class="form-control @error('cheuveux') is-invalid @enderror" value="{{ $cheuveux}}" readonly="readonly">           
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="Name">Signe particuliers</label>
            <span class="red">*</span>
            <input class="form-control @error('pa_sign') is-invalid @enderror" name="pa_sign" value="{{ $pa_sign}}" style="height:70px;" readonly="readonly">
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
            <input class="form-control" name="voyage" value="Un seul voyage aller" readonly="readonly" value="{{$voyage}}">
          </div>
        <div class="form-group col-md-6">
            <label for="Name">Validité pièce</label>
            <span class="red"></span>
          <select class="form-control" name="validity" disabled="disabled">
             <option value="{{ $validity}}">{{ $validity}}</option>
          <option value="Pièce en cours de validité"></option>
          <option value="Pièce expirée">Pièce expirée</option>
          </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="card_status">Date d'émission</label>
            <span class="red">*</span>       
            <input type="date" class="form-control" name="date_emission" value="{{ $date_emission}}">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Date d'expiration</label>
            <span class="red"></span>
            <input type="date" class="form-control" name="date_expirations" value="{{ $date_expiration}}">
            <input type="date" class="form-control" name="date_expiration" value="{{ $date_expiration}}" style="display: none;">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="Name">Accompagné de:</label>
            <span class="red"></span>
             <textarea class="form-control" placeholder="Entrez les noms de personnes qui accompagne le citoyen" name="link_with">{{ $link_with}}</textarea>
          </div>
        </div>
     </div>

   </div><!-- end right side elements -->
  </div>
  <div class="box-footer text-right">
     <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Validé</button>&nbsp;&nbsp;
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
  $(function () {
    $(".pass-card").addClass("active");
  });
</script>
@endsection