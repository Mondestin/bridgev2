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
          <h1 align="center" class="m-0 text-dark">Gestion des utilisateurs</h1>
          <hr align="center" style="width: 19%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="card card-primary card-outline">
      <div class="container-fluid" style="background: #eee;">
      <div class="right">
        <a href="#" id="print" class="btn btn-primary btnc">
          <span class="fa fa-print"></span>
          Imprimer la liste
        </a>
        <a href="{{route('users.create')}}" class="btn btn-success ">
          <span class="fa fa-plus"></span>
          Nouvelle entrée
        </a>

      </div>
      </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Photo</th>
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Responsabilité</th>
                  <th>Accès</th>
                  <th>Crée le </th>
                  <th>Dernière connection</th>
                  <th>Options</th>
                </tr>
                </thead>
               <tbody>
                <?php $no=1; \Carbon\Carbon::setLocale('fr')?>
                 @foreach ($data as $key => $value)
                <tr>
                 <td>{{$no++}}</td>
                 <td>
                  <div class="image">
                    <img src="uploads/users/{{$value->avatar}}" class="img-circles elevation-2" alt="User">
                   </div>
                  </td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->status}}</td>
                  <td>{{$value->level}}</td>
                  <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                  <td>
                    @if ($value->level=="admin" || $value->level=="standard" || $value->level=="caissier")
                    {{\Carbon\Carbon::parse($value->lastLogin)->diffForHumans()}}
                    @endif
                  </td>
                  <td>
                    <form action="{{route('users.destroy', $value->id)}}" method="post">
                        @if ($value->level=="admin" || $value->level=="standard" || $value->level=="caissier")
                        <a href="{{route('users.show', $value->id)}}" class="btn btn-success btn-sm" title="Profile">
                          <i class="fa fa-eye" style="color: #fff;"></i>
                        </a>
                        <a href="{{route('users.edit', $value->id)}}" class="btn btn-warning btn-sm" title="Modifier">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
                         @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                          <i class="fa fa-trash" style="color: #fff;"></i>
                        </button>
                        @endif
                    </form>
                   </td>
                </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
<!-- table to print -->
        <div class="card-body table-responsive" style="display: none;">
          <div id="example8">
               <div class="container-fluid text-center">

                 <div class="row mb-2">
                   <div class="col-sm-12">
                    <br><br>
                    <h3 align="center" class="m-0 text-dark">LISTES DES UTILISATEURS DE BRIDGE PNR</h3>
                    <hr align="center" style="width: 30%">
                   </div><!-- /.col -->
               </div><!-- /.row -->
              </div>
              <table class="table table-bordered table-striped table-sm dataTable " aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Responsabilité</th>
                  <th>Accès</th>
                  <th>Crée le </th>
                  <th>Dernière connection</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->status}}</td>
                  <td>{{$value->level}}</td>
                  <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                  <td>{{\Carbon\Carbon::parse($value->lastLogin)->diffForHumans()}}
                </tr>
                 @endforeach
                </tbody>
              </table>
              </div>
          </div>
        <!--End  of table to print -->


  </div>
</div>
 </section>
@endsection
@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- print js -->
<script src="../js/printThis.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
     $("#toast-container").fadeOut(12000);
    $("#print").click(function(){
      $("#example8").printThis({
          loadCSS: "{{asset('dist/css/adminlte.css')}}",
          removeInlineSelector: "",
          printDelay: 333,
          header: "CONSULAT GENERAL HONORAIRE DU BENIN  <br> <small>Pointe-Noire</small><br> <small>BP: 1216</small>",
          footer: "",
           base: "http://127.0.0.1:8000/",
          doctypeString: '<!DOCTYPE html>',
      });
    });
  });
</script>
<script>
  $(function () {
    $(".users").addClass("active");
  });
</script>
@endsection
