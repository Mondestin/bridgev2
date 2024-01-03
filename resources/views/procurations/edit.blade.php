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
          <h1 align="center" class="m-0 text-dark">Actualisé la Procuration</h1>
          <hr align="center" style="width: 17%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="container-fluid">
    <div class="box-body no-pad">
     <div class="col-md-12">
      <div class="card card-primary card-outline">

 <form action="{{route('procurations.update', $data->id)}}"  method="POST">
    @csrf
    @method('PATCH')
      <div class="row padd">
        <input type="text" name="id_number" value="{{$data->citoyen_id}}" style="display: none;">
       <!-- Left side elements -->
        <div class="col-md-6">
           <h3 class="box-title"> 
            <i class="fa fa-info" aria-hidden="true">              
            </i>&nbsp; Le demandeur
           </h3>         
        <div class="col-md-12 line_box">
        <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $datas->surname ?? '' }}" readonly="readonly">
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $datas->name ?? ''}}" readonly="readonly">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="adresse">Adresse</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ $datas->address ?? '' }}" readonly="readonly">
          </div>
          <div class="form-group col-md-6">
            <label for="profession">Proféssion</label>
            <span class="red">*</span>
            <input name="profession" class="form-control @error('profession') is-invalid @enderror" value="{{ $datas->profession ?? '' }}" readonly="readonly">           
          </div>
        </div>
             <div class="row">
          <div class="form-group col-md-6">
            <label for="contact">Contact</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ $datas->phone ?? '' }}" readonly="readonly">
          </div>
             <div class="form-group col-md-6">
            <label for="card_no">N° de carte consulaire</label>
            <span class="red">*</span>
            <input name="card_no" class="form-control @error('card_no') is-invalid @enderror" value="{{ $datas->card_no ?? '' }}" readonly="readonly">           
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="c_number">N° de citoyen</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('c_number') is-invalid @enderror" name="c_number" value="{{ $data->citoyen_id ?? '' }}" readonly="readonly">
          </div>
        </div>
        </div> 
                  <h3 class="box-title mt-4"> 
              <i class="fa fa-info" aria-hidden="true">                  
              </i>&nbsp; Le bénéficiaire
            </h3>
       <div class="line_box">
                              <!-- Put inputs here --> 
        <!-- Put inputs here -->
        <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Nom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('b_surname') is-invalid @enderror" name="b_surname" value="{{ $data->b_surname ?? '' }}" >
          </div>
          <div class="form-group col-md-6">
            <label for="Name">Prénom(s)</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('b_name') is-invalid @enderror" name="b_name" value="{{ $data->b_name ?? ''}}" >
          </div>
        </div>
        <div class="row">
          
          <div class="form-group col-md-6">
            <label for="b_id_number">N° de CNI/Passsport</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('b_id_number') is-invalid @enderror" name="b_id_number" value="{{ $data->b_id_number ?? '' }}">
          </div>
          <div class="form-group col-md-6">
            <label for="b_id_etablit">Etablit à</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('b_id_etablit') is-invalid @enderror" name="b_id_etablit" value="{{ $data->b_id_etablit ?? '' }}" >
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="b_id_expire">Expire le</label>
            <span class="red">*</span>
            <input type="date" class="form-control @error('b_id_expire') is-invalid @enderror" name="b_id_expire" value="{{ $data->b_id_expire}}" >
          </div>
          <div class="form-group col-md-6">
            <label for="contact">Téléphone</label>
            <span class="red">*</span>
            <input type="number" class="form-control @error('b_contact') is-invalid @enderror" name="b_contact" value="{{ $data->b_contact ?? '' }}">
          </div>
         
        </div>
           <div class="row">
           <div class="form-group col-md-12">
            <label for="adresse">Adresse</label>
            <span class="red">*</span>
            <input type="text" class="form-control @error('b_adresse') is-invalid @enderror" name="b_adresse" value="{{ $data->b_adresse ?? '' }}" >
          </div>
        </div>
     </div>
       </div><!-- end Left side elements -->
            <!-- right side elements -->
     <div class="col-md-6">
           <h3 class="box-title" style="margin-top: 2%;"> 
               <i class="fa fa-info" aria-hidden="true">               
              </i>&nbsp; Pouvoir Autorisé
            </h3>
      <div class="line_box">
                              <!-- Put inputs here --> 
        <div class="row">
          <div class="form-group col-md-12">
            <label for="pouvoir">Aux fin de:</label>
            <span class="red">*</span>
            <textarea class="form-control @error('pouvoir') is-invalid @enderror" name="pouvoir" rows="11" cols="50">{{$data->pouvoir}}</textarea> 
          </div>
        </div>
     </div>
   </div><!-- end right side elements -->
  </div>
   <div class="box-footer text-right">
     <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Validé</button>&nbsp;&nbsp;
     <a href="{{route('procurations.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Retour</a>
  </div>
  </form>
</div>
</div>
</div>
@endsection
@section('scripts')
<!-- bootstrap-datetimepicker -->    
<script src="../dist/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
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
    $(".pieces").addClass("menu-open");
    $(".procurations").addClass("active");
    $(".pieces1").addClass("active");
  });
</script>
<!-- -->
@endsection