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
          <h1 align="center" class="m-0 text-dark">Actualisé le Visa</h1>
          <hr align="center" style="width: 15%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="box-body no-pad">
     <div class="col-md-12">
      <div class="card card-info shadow">
 <form action="{{route('visas.update', $dem_no)}}"  method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
      <div class="row padd">
        <input type="text" name="id_number" value="{{$dem_no}}" style="display: none;">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-info" aria-hidden="true">              
            </i>&nbsp;Information
           </h3>         
        <div class="col-md-12 line_box">
                    <!-- PROFILE PICTURE -->
            <div class="row" style="margin-left: 35%;">
              <div class="col-sm-4 col-sm-offset-1">
                <div class="picture-container">
                  <div class="picture">
                      <img src="/uploads/askers/{{$avatar }}" class="picture-src" id="wizardPicturePreview" title=""/>
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
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $surname }}" readonly="readonly">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prenom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $name }}" readonly="readonly">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="eye_color">Couleur des yeux</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('eye_color') is-invalid @enderror" name="eye_color" value="{{ $eye_color }}" readonly="readonly">
          </div>
          <div class="form-group col-md-6">
            <label for="cheuveux">Cheuveux</label>
            <span class="red">*</span>
            <input name="cheuveux" class="form-control @error('cheuveux') is-invalid @enderror" value="{{ $cheuveux }}" readonly="readonly">           
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <label for="Name">Signe particuliers</label>
            <span class="red">*</span>
            <input class="form-control @error('pa_sign') is-invalid @enderror" name="pa_sign" value="{{ $pa_sign }}" style="height:70px;" readonly="readonly">
          </div>
        </div>
        </div>         
       </div><!-- end Left side elements -->
            <!-- right side elements -->
     <div class="col-md-6">
           <h3 class="box-title"> 
              <i class="fa fa-card" aria-hidden="true">               
              </i>&nbsp;Information sur le visa
            </h3>
       <div class="line_box">
                              <!-- Put inputs here --> 
        <div class="row">
          <div class="form-group col-md-6">
            <label for="type">Type de Visa</label>
            <span class="red">*</span>
            <select class="form-control @error('type') is-invalid @enderror" name="type" id="visa_type">
              <option value="{{ $type }}" hidden="hidden">{{ $type }}</option>
              <option value="Transit">Visa transit</option>
              <option value="Court séjour">Visa court séjour</option>
              <option value="Double entrée">Visa double entrée</option>
              <option value="Entrée multiple">Visa entrée multiple</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="durée">Durée en jours</label>
            <span class="red">*</span>
            <input type="text" name="durée" class="form-control" readonly="readonly" id="temps" value="{{ $durée }}">
          </div>
        </div>
         <div class="row">
          <div class="form-group col-md-6">
            <label for="date_emission">Date de délivrance</label>
            <span class="red">*</span>
            <input type="date" class="form-control numbers @error('date_emission') is-invalid @enderror" name="date_emission" value="{{ $date_emission }}">
          </div>
          <div class="form-group col-md-6">
            <label for="depart">Date de départ</label>
            <span class="red">*</span>
            <input type="date" class="form-control numbers @error('depart') is-invalid @enderror" id="dateDepart" name="depart" value="{{ $depart }}"> 
          </div>
        </div>
         <div class="row">
          <div class="form-group col-md-6">
            <label for="date_expiration">Date d'expiration</label>
            <span class="red">*</span>
            <input type="text" class="form-control numbers" id="date_expirations"  value="{{ $date_expiration }}" readonly="readonly">
               <input type="text" id="date_expiration" name="date_expiration" value="{{ $date_expiration }}" style="display: none;">
          </div>
          <div class="form-group col-md-6">
            <label for="status_visa">Status du visa</label>
            <span class="red">*</span>
            <select class="form-control" name="" disabled="disabled">
              <option value="{{ $status_visa }}">{{ $status_visa }}</option>
            </select>
            <input type="text" name="status_visa" value="{{ $status_visa }}" style="display: none;">
          </div>
        </div>
     </div>
    
           <h3 class="box-title" style="margin-top: 2%;"> 
              <i class="fa fa-card" aria-hidden="true">               
              </i>&nbsp;Information générale sur le voyage 
            </h3>
      <div class="line_box">
                              <!-- Put inputs here --> 
        <div class="row">
          <div class="form-group col-md-6">
            <label for="passport_no">N° Passport</label>
            <span class="red">*</span>
            <input type="text" class="form-control" name="passport_no" readonly="readonly" value="{{$id_number}}">
          </div>
          <div class="form-group col-md-6">
            <label for="deliver_place">Lieu de délivrance</label>
            <span class="red"></span>
           <input type="text" class="form-control" name="deliver_place"  readonly="readonly" value="{{$deliver_place}}">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label for="motif">Motif</label>
            <span class="red">*</span>
           <textarea class="form-control" name="motif" placeholder="motif du voyage">{{$motif ?? ''}}</textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Accompagné de </label>
            <span class="red"></span>
               <textarea class="form-control" name="go_wirh" placeholder="Entrez les personnes qui vous accompagnent">{{$go_wirh ?? ''}}</textarea>
          </div>
        </div>
     </div>
   </div><!-- end right side elements -->
  </div>
</div>
</div>
   <div class="box-footer text-right">
     <button type="submit" class="btn btn-primary shadow">Actualisé</button>&nbsp;&nbsp;
     <a href="{{route('visas.index')}}" class="btn btn-info shadow">Retour</a>
  </div>
  </form>
</div>
</div>
@endsection
@section('scripts')
<!-- bootstrap-datetimepicker -->    
<script src="../dist/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/js/visa-logic.js"></script>
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
    $(".askers00").addClass("menu-open");
    $(".askers0").addClass("active");
    $(".askers").addClass("active");
  });
</script>
<!-- -->
@endsection