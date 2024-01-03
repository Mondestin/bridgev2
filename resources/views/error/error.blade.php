@extends('layouts.app')
@section('links')
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection
@section('header')
<!-- display success message -->
 @if ($message = Session::get('success'))
  <div id="toast-container" class="toast-top-right">
    <div class="toast toast-success" aria-live="polite" style="">
      <div class="toast-message">
          {{$message}}
      </div>
   </div>
 </div>
 @endif
 <!-- display error message -->
@if ($message = Session::get('error'))
  <div id="toast-container" class="toast-top-right">
    <div class="toast toast-error" aria-live="polite" style="">
      <div class="toast-message">
          {{$message}}
      </div>
   </div>
 </div>
 @endif
@endsection
@section('content')
<div class="container" style="margin-top: 5%">
    <div class="row justify-content-center">
        <div class="col-md-4 text-white" style="margin-top: 15%;margin-left: 20%;"> 
          <h1 class="text-white">404 ERROR</h1>
             <p>l'élement n'a pas été trouvé</p> 
             <a href="/home" class="btn btn-primary">retour</a>       
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- page script -->
<script>
  $(function () {
     $("#toast-container").fadeOut(12000);
  });
</script>
@endsection