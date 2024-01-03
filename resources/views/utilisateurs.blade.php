@extends('layouts.dashboard')
@section('header')
<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
          <h1 class="m-0 text-dark">Utilisateurs</h1>
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
  <div class="row">
   <h3 align="centered">Utilisateurs Panel</h3>
  </div>
  
  @include('auth.register')
@endsection