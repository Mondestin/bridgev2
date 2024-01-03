@extends('layouts.app')
@section('links')
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
@endsection
@section('header')

@endsection
@section('content')
<div class="container" style="margin-top: 3%">
    <div class="row justify-content-center">
        <div id="text" class="col-md-10 text-center">
                <h1  class="text-white text-center" style="font-size: 50px">
                       Bienvenu sur le portail numérique <br>du Consulat Honoraire du Bénin <br>à Pointe-Noire
                    </h1>
                       <div align="center" class=" text-center">
                    <div>
                        <img src="{{asset('images/seaub.png')}}" alt="User" style="height: 250px; width: auto;"> 
                    </div>
                </div>
            <button id="button" class="btn btn-success p-2 mt-5 shadow" type="button" style="border-radius: 30px; width: 15%;">Connexion 
            <i class="fa-solid fa-arrow-right"></i>
            </button>
             <h6 class="mt-5 text-white">
                       @Bridge-PNR
                    </h6>
         </div>
       
        <div id="login" class="col-md-4" style="display: none;">
            <div class="card login-card logins">
                <div align="center" class="card-header text-center">
                    <h3>
                        <img src="{{asset('images/logo2.png')}}" class="logo-home" alt="User" height="50px;"> 
                    </h3>
                </div>
                <div class="card-body login-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email">{{ __('Utilisateur') }}</label>
                          
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" title="Veuillez remplir ce champ" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group row">
                            <label for="password">{{ __('Mot de passe') }}</label>                          
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Mot de passe" title="Veuillez remplir ce champ" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror      
                        </div>
                        <div class="form-group row mb-0">
                            
                                <button type="submit" class="btn btn-success submit-btn">
                                    {{ __('Se connecter') }}
                                </button>
                            <div class="col-md-5">
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
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- page script -->
<script>
$(function(){
    @if(Session::has('success'))
        Swal.fire({
        icon: 'success',
        title: 'Succès!',
        text: '{{ Session::get("success") }}'
    })
    @endif
});
@if(Session::has('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ Session::get("error") }}'
    })
@endif
</script>
<script>
  $(function () {
     $("#toast-container").fadeOut(12000);
       $("#button").click(function(){
    $("#text").fadeOut(800);
    $("#login").fadeIn(1000);
  });
  });
</script>
@endsection