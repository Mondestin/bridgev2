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
        <h1 align="center" class="m-0 text-dark">Profile de {{$user->name}}</h1>
       <hr align="center" style="width: 8%">
      </div><!-- /.col -->
  </div><!-- /.row -->
</div>
  <div class="container-fluid">
    <div class="row m-1">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="/uploads/users/{{$user->avatar}}"
                   alt="User profile picture">
            </div>
            <h3 class="profile-username text-center"><b>{{$user->name}}</b> </h3>
            <p class="text-muted text-center"><span class="fa fa-user-tie"></span> {{$user->status}}</p>
        
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-8">
        <div class="card card-outline card-primary">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <h4 class="m-2"><b>Information personnel</b></h4>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane">
                    <div>
                      <form method="POST" action="{{ route('userUpdate',$user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group ">
                          <label for="name" class="col-sm-2">Nom(s)</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" >
                          </div>
                        </div>
                        <div class="form-group ">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-12">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" >
                          </div>
                        </div>
                        <div class="form-group ">
                          <label for="inputName2" class="col-sm-2">Niveau d'accès</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control" value="{{ $user->level }}" readonly>
                          </div>
                        </div>
                        <div class="form-group ">
                          <label for="inputName2" class="col-sm-2">Avatar</label>
                          <div class="col-sm-12">
                            <input type="file" name="avatar" class="form-control" title="Entré votre avatar">
                          </div>
                        </div>
                        <div class="card-header p-2 mt-3">
                          <ul class="nav nav-pills">
                            <h4 class="m-1 bold"> <b>Information de Connexion</b> </h4>
                          </ul>
                        </div><!-- /.card-header -->
                        <div class="form-group mt-3">
                          <label for="inputSkills" class="col-sm-12 col-form-label">Mot de passe actuel</label>
                          <div class="col-sm-12">
                            <input type="password" class="form-control @error('password_actuel') is-invalid @enderror" name="password_actuel">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputSkills" class="col-sm-12 col-form-label">Nouveau Mot de passe</label>
                          <div class="col-sm-12">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                           @enderror
                          </div>
                        </div>
                        <div class="form-group ">
                          <label for="inputSkills" class="col-sm-12 col-form-label">Confirmer le Mot de passe</label>
                          <div class="col-sm-12">
                            <input id="password-confirm" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                          </div>
                        </div>
                        <div class="form-group mt-5">
                          <div class=" col-sm-12">
                            <button type="submit" class="btn btn-success float-right"><span class="fa fa-check"></span> Valider</button>
                          </div>
                        </div>
                      </form>
                    </div>
              </div>
            
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
@endsection
@section('scripts')
<script>
  $(function () {
    $(".users").addClass("active");
  });
</script>
@endsection