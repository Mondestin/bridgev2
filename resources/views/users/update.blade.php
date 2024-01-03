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
          <h1 align="center" class="m-0 text-dark">Actualisé L'utilisateur {{$data->name}}</h1>
          <hr align="center" style="width: 23%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
              <form method="POST" action="{{ route('users.update',$data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row" style="margin-left: 25%; margin-top: 15%;">
                            <div class="col-sm-4 col-sm-offset-1">
                                <div class="picture-container">
                                  <div class="picture">
                                      <img src="/uploads/users/{{$data->avatar}}" class="picture-src" id="wizardPicturePreview" title=""/>
                                      <input type="file" id="wizard-picture" name="avatar" class="form-control" value="{{$data->avatar}}" title="Entré votre avatar">
                                  </div>
                                  
                                </div>
                              </div>
                        </div>
                      </div>
                      <div class="col-md-6" style="padding-top: 5%;">
                        <div class="form-group row">
                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$data->name}}" placeholder="Entrer le nom"  autocomplete="name" autofocus>
                   
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Entrer l'Email" value="{{$data->email}}" autocomplete="email" placeholder-shown>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                            <select name="level" class="form-control @error('level') is-invalid @enderror" required="required">
                                  <option value="" hidden="">Accès</option>
                                  <option value="standard">Standard</option>
                                  <option value="admin">Admin</option>
                                  <option value="caissier">Caissier(e)</option>
                            </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required="required">
                                  <option value="" hidden="">Responsabilité</option>
                                  <option value="Directeur">Directeur</option>
                                  <option value="Secrétaire">Secrétaire</option>
                                  <option value="Caissier(e)">Caissier(e)</option>
                            </select>
                            </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                        <div class="form-group row mb-0 justify-content-end pr-5">                            
                                <a href="{{route('users.index')}}" class="btn btn-primary" >
                                     <i class="fa-solid fa-arrow-left"></i> Retour
                                </a>
                                <a href="{{route('userRestore', $data->id)}}" class="btn btn-warning text-white ml-2" >
                                    <i class="fa-solid fa-rotate-left"></i> Réinitialisé
                                </a>
                                <button type="submit" class="btn btn-success ml-2">
                                     <i class="fa-solid fa-check"></i> Validé
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
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
      $(".users").addClass("active");
    });
  </script>
@endsection