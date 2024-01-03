@extends('layouts.dashboard')
@section('links')

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
          <h1 align="center" class="m-0 text-dark">Actualisé la Carte d'Identité Consulaire</h1>
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
 <form action="{{route('cartes.update',$id)}}"  method="POST">
    @csrf
    @method('PATCH')
      <div class="row padd">
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
           <h3 class="box-title">
              <i class="fa fa-card" aria-hidden="true">
              </i>&nbsp;Carte Consulaire
            </h3>
       <div class="line_box">
                              <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="date_emission">Date de délivrance</label>
            <span class="red">*</span>
            <input type="date" class="form-control numbers @error('date_emission') is-invalid @enderror" name="date_emission" value="{{ $date_emission }}" required="required">
          </div>
          <div class="form-group col-md-6">
            <label for="date_expiration">Date d'expiration</label>
            <span class="red"></span>
            <input type="date" class="form-control numbers @error('date_expiration') is-invalid @enderror" name="date_expiration" value="{{ $date_expiration }}" required="required">
          </div>
        </div>
     </div>
           <h3 class="box-title" style="margin-top: 2%;">
              <i class="fa fa-card" aria-hidden="true">
              </i>&nbsp;Carte Information
            </h3>
      <div class="line_box">
                              <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="type">Type</label>
            <span class="red">*</span>
            <select class="form-control @error('type') is-invalid @enderror" name="type" required="required">
              <option value="{{ $type }}" hidden="hidden">{{ $type }}</option>
              <option value="Nouvelle Carte">Nouvelle Carte</option>
              <option value="Renouvellement">Renouvellement</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Validité pièce</label>
            <span class="red"></span>
            <select class="form-control" name="validity" required="required">
          <option value="{{ $validity }}" hidden="hidden">{{ $validity }}</option>
          <option value="Pièce expirée">Pièce expirée</option>
          </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label for="card_status">Statut de la Carte</label>
            <span class="red">*</span>
            <select class="form-control @error('card_status') is-invalid @enderror" name="card_status" required="required">
              <option value="{{ $card_status }}" hidden="hidden">{{ $card_status }}</option>
              {{-- <option value="Validée">Validée</option> --}}
              <option value="Rejet">Rejet</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Impréssion statut</label>
            <span class="red"></span>
            <select class="form-control" name="print_status" required="required"
            @if ($print_status=="Imprimée")
                disabled
            @endif>
           <option value="{{ $print_status }}" hidden="hidden">{{ $print_status }}</option>
          <option value="Non imprimée">Non imprimée</option>
          <option value="Imprimée">Imprimée</option>
          </select>
          </div>
        </div>
     </div>
             <h3 class="box-title" style="margin-top: 2%;">
              <i class="fa fa-card" aria-hidden="true">
              </i>&nbsp;Intérruption de la Carte
            </h3>
      <div class="line_box">
                              <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-1">
            <input type="checkbox" id="checkbox" name="check" class="form-control" {{ $date_blocked ? 'checked' : '' }}>
          </div>
           <div class="form-group col-md-11">
             <h6>Voulez vous intérronpre cette carte?</h6>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="card_status">Date d'éffet</label>
            <span class="red">*</span>
            <input type="date" id="dateCanceled" class="form-control" name="date_blocked" value="{{$date_blocked}}" disabled="disabled">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Motif</label>
            <span class="red"></span>
            <textarea class="form-control @error('motif') is-invalid @enderror" name="motif" id="motif" placeholder="Enter le motif d'intéruption de la carte" disabled="disabled">{{$motif}}</textarea>
          </div>
        </div>
     </div>
   </div><!-- end right side elements -->
  </div>
</div>
</div>
   <div class="box-footer text-right">
     <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Validé</button>&nbsp;&nbsp;
     <a href="{{route('cartes.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Retour</a>
  </div>
  </form>
</div>
</div>
@endsection
@section('scripts')

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

     //handle the checkbox
    $('#checkbox').click(function(e){
        $('#dateCanceled').attr('disabled',!this.checked);
        $('#motif').attr('disabled',!this.checked);
        $('#dateCanceled').val("");
        $('#motif').val("");

    });
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
    $(".cardsc").addClass("active");
  });
</script>
<!-- -->
@endsection
