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
          <h1 align="center" class="m-0 text-dark">Gestion du Stock des {{$data->category}}</h1>
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
            <div class="card col-md-4 mx-auto shadow">
                <div class="card-body">
              <form method="POST" action="{{ route('stocks.update', $data->id) }}" class="needs-validation" novalidate>
                        @csrf
                         @method('PATCH')
                 <div class="row">
                      <div class="col-md-12 justfy-content-center">
                        <div class="form-group ">
                            <div class="col-md-10">
                              <label>Stock Initial</label>
                                <input type="text" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ $data->start}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                              <label>Entrées</label>
                                <input  type="text" class="form-control @error('entering') is-invalid @enderror" name="entering" value="{{ $data->entering }}">
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                              <label>Obserrvations</label>
                                <textarea class="form-control @error('obs') is-invalid @enderror" name="obs">{{ $data->obs }}</textarea> 
                               
                            </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                        <div class="form-group row mb-0">                            
                            <div class="col-md-6">
                                <a href="{{route('stocks.index')}}" class="btn btn-primary" style="width: 50%; margin-left: 25%;">
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