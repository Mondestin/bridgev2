@extends('layouts.app')
@section('links')

@endsection
@section('header')
<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Liste des documents Légalisés</h1>
          <hr align="center" style="width: 16%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<div class="container-fluid">
             <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nom(s) et Prénom(s) du Citoyen</th>
                  <th>Diplome</th>
                  <th>Nom  de l'établissement</th>
                  <th>Lieu d'obtention</th>
                  <th>Date de délivrance</th>
                  <th>Etablit le</th>
                  <th>Statut</th>
                  
                </tr>
                </thead>
               <tbody>
                 <?php $no=1; $bg_status="";?>
                 @foreach ($data as $key => $value)
                <tr> 
                 <td>{{$no++}}</td>
                 <td>{{$value->name}} {{$value->surname}}</td>
                  <td>{{$value->type}}</td>
                  <td>{{$value->school_name}}</td>
                  <td>{{$value->date_delivrance}}</td>
                  <td>{{$value->place_emission}}</td>
                  <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                  <td>{{$value->status}}</td>        
                </tr>
                 @endforeach 
                </tbody>
              </table>
            </div>
</div>
@endsection
