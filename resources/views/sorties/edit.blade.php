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
          <h1 align="center" class="m-0 text-dark">Gestion de la Sortie {{$data->title}} émise par {{$data->emit_by}}</h1>
          <hr align="center" style="width: 18%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="col-md-12">
            <div class="card col-md-8 mx-auto shadow">
                <div class="card-body">
   <div class="">
             <form action="{{route('sorties.update', $data->id)}}" method="POST">
              @csrf
              @method('PATCH')
            <div class=" p-4">
                   <div class="row">
          <div class="form-group col-md-6">
            <label for="Name">Intitulé</label>
            <span class="red">*</span>
            <input type="text"  class="form-control @error('title') is-invalid @enderror" name="title" value="{{$data->title}}" readonly>
          </div>

          <div class="form-group col-md-3">
            <label for="Name">Montant</label>
            <span class="red">*</span>
            <input type="number"  class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{$data->amount}}">
          </div>
                  <div class="form-group col-md-3">
            <label for="status">Statut</label>
            <span class="red">*</span>
           <select name="status" class="form-control @error('status') is-invalid @enderror" required="required">
                                  <option value="Validé">Validé</option>
                                  <option value="Rejeté">Rejeté</option>
                            </select>
          </div>
        </div>
                <div class="row">
          
           <div class="form-group col-md-12">
            <label for="comment">Commentaire</label>
            <span class="red">*</span>
           <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" rows="4" cols="10">{{$data->comment}}</textarea> 
          </div>
        </div>
            </div>
            <div class="modal-footer">
              <div class="col-md-6">
                                <a href="{{route('sorties.index')}}" class="btn btn-primary" style="width: 50%; margin-left: 25%;">
                                   <i class="fa-solid fa-arrow-left"></i> Retour
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" style="width: 50%; margin-left: 25%;">
                                   <i class="fa-solid fa-check"></i> Validé
                                </button>
                            </div>
            </div>
            </form> 
          </div>
          <!-- /.modal-content -->
                </div>
            </div>
        </div>
</div>
 </section>
@endsection
@section('scripts')
<script>
   $(function () {
    $(".stocks").addClass("active");
  });
</script>
@endsection