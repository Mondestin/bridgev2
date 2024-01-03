@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
              <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row" style="margin-left: 25%; margin-top: 10%;">
                            <div class="col-sm-4 col-sm-offset-1">
                                <div class="picture-container">
                                  <div class="picture">
                                      <img src="../uploads/users/user.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                      <input type="file" id="wizard-picture" name="avatar" class="form-control" title="Entré votre avatar">
                                  </div>
                                  
                                </div>
                              </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Entrer le nom"  autocomplete="name" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Entrer l'Email" value="{{ old('email') }}" autocomplete="email" placeholder-shown>

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
                 <!--        <div class="form-group row">
                            <div class="col-md-10">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Entrer le mot de passe" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmer le mot de passe"  autocomplete="new-password">
                            </div>
                        </div> -->
                      </div>
                    </div>
                    <hr>
                        <div class="form-group row mb-0">                            
                            <div class="col-md-6">
                                <a href="{{route('users.index')}}" class="btn btn-primary" style="width: 50%; margin-left: 25%;">
                                   <i class="fa-solid fa-arrow-left"></i> Retour
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" style="width: 50%; margin-left: 25%;">
                                   <i class="fa-solid fa-file-arrow-down"></i> Enregistrer
                                </button>
                            </div>
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