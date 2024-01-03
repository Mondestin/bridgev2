@extends('layouts.dashboard')
@section('links')
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
 <!-- DataTables -->
 @include('layouts.datatablestyles')
@endsection
@section('header')
<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Gestion des Citoyens</h1>
          <hr align="center" style="width: 17%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="card card-primary card-outline mb-5">
      <div class="container-fluid" style="background: #eee;">
<br>

      <div class="row p-3">

      <div class="row col-md-12">

        <div class="col-md-6 mb-3">
          <form id="filterForm" action="{{route('findCitoyenRange')}}" method="POST">
            @csrf
            <h5 class="ml-3">Sélectionnez les dates</h5>
            <div class="row ml-4">

               <h6>DU</h6>
          <div class="input-group col-md-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" name="date1" class="form-control float-right" required>
          </div>
            <h6>AU</h6>
          <div class="input-group col-md-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="date" name="date2" class="form-control float-right" required>
          </div>
                    <button type="submit" id="sumbiFilter" class="btn btn-primary">
             <span class="fa fa-search"></span>
            Rechercher
          </button>
            </div>
        </form>
         </div>

           <div class="col-md-6 text-right">
            <a href="{{route('printCitoyens')}}" class="btn btn-primary ml-3 btnprn">
              <span class="fa fa-print"></span>
              Imprimer la liste
            </a>
            <a href="{{route('getExcel')}}" class="btn btn-success" title="Exporter la liste en Excel">
              <i class="fa-solid fa-file-excel"></i>
              Exporter la liste en Excel
            </a>
            <a href="{{route('citoyens.create')}}" class="btn btn-success">
              <span class="fa fa-plus"></span>
              Nouvelle entrée
            </a>
           </div>
      </div>
      </div>
      </div>
           <div class="container-fluid table-responsive">
                <div class="col-md-12 mt-5 mb-5">
                    <table class="table table-bordered" id="datatable">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>N° Matricule</th>
                        <th>Nom(s)</th>
                        <th>Prénom(s)</th>
                        <th>Date de Naissance</th>
                        <th>Lieu de Naissance</th>
                        <th>Sexe</th>
                        <th>Profession</th>
                        <th>Téléphone</th>
                        <th>Statut ID</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; $bg_status="";?>
                         @foreach ($data as $key => $value)
                            <?php
                              $bg_status=$value->id_status=="Non confirmée" ? "bg-warning" : "bg-success";
                            ?>
                        <tr>
                         <td>{{$no++}}</td>
                         <td>{{$value->citoyen_no}} </td>
                          <td>{{$value->surname}}</td>
                          <td>{{$value->name}}</td>
                          <td>{{date("d-m-Y", strtotime($value->dob))}}</td>
                          <td>{{$value->pofbirth}}</td>
                          <td>{{$value->sexe}}</td>

                          <td>{{$value->profession}}</td>
                          <td>{{$value->phone}}</td>
                          <td><span class="badge {{$bg_status}}">{{$value->id_status}}</span></td>
                          <td>
                            <a class="btn btn-success btn-sm" href="{{route('citoyens.show',$value->id)}}"title="Profile"><i class="fa fa-eye m-r-5"></i></a>
                            <a class="btn btn-warning btn-sm text-white" href="{{route('citoyens.edit',$value->id)}}" title="Modifier"><i class="fa fa-pencil m-r-5"></i> </a>
                           
                                    @if ((Auth::user()->level)=="super-admin" || (Auth::user()->level)=="admin")
                                    <a class="btn btn-danger btn-sm delete" href="#" data-id="{{$value->id}}" title="Supprimer"><i class="fa fa-trash m-r-5"></i> </a>
                                    @endif

                           </td>
                        </tr>
                         @endforeach
                        </tbody>
                      </table>
                </div>
             </div>
  </div>
</div>
<br>
 </section>
@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- DataTables -->
@include('layouts.datatablescripts')
<!-- printPage -->
<script src="../../js/jquery.printPage.js"></script>

<script type="text/javascript">
  $(document).ready( function () {
  $.ajaxSetup({
  headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  var table = $('#datatable').DataTable({
  "pageLength":10,
  "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"Tout"]],
    order: [[0, 'desc']]
  });



//   handle delete event
  $('body').on('click', '.delete', async function () {
   var id = $(this).data('id');
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger ml-2'
    },
    buttonsStyling: false
  })
   const {value: password}= await swalWithBootstrapButtons.fire({
          title: 'Etes vous sure?',
          text: "Cette action est définitive",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Oui, supprimer!',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Non, annuler',
          input: 'password',
        inputPlaceholder: 'Entrez le mot de passe administrateur',
        confirmButtonColor: '#3085d6',
        inputValidator: (value) => {
          if (!value) {
            return 'Ce champ est requis'
          }
          else{
            // ajax
          $.ajax({
            type:"DELETE",
            url: "{{ url('citoyens') }}"+'/'+id,
            data: { id: id, password: value},
            dataType: 'json',
            success: function(res){
              console.log(res);
              if(res['success']){
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                Toast.fire({
                  icon: 'success',
                  title: res['success']
                      })
              }
                if(res['error']){
                swalWithBootstrapButtons.fire(
                        'Woops!',
                         res['error'],
                        'error'
                    )
              }
              var oTable = $('#datatable').dataTable();
              oTable.fnDraw(false);
            }
          });
          }
      }
        });
     });
  });
</script>
<script type="text/javascript">
$(document).ready(function(){
$('.btnprn').printPage();
});
</script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<script>
  $(function () {
     $("#gestionscitoyens-table").addClass("table-bordered table-striped");

  });
</script>

<script>
  $(function () {
    $(".citoyens0").addClass("menu-open");
    $(".citoyens1").addClass("active");
    $(".citoyens2").addClass("active");
  });
</script>
@endsection
