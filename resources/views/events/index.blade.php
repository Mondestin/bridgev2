@extends('layouts.dashboard')
@section('links')
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection
@section('header')
@if ($message = Session::get('error'))
  <div id="toast-container" class="toast-top-right">
    <div class="toast toast-error" aria-live="polite" style="">
      <div class="toast-message">
          {{$message}}
      </div>
   </div>
 </div>
@endif
@if ($message = Session::get('success'))
  <div id="toast-container" class="toast-top-right">
    <div class="toast toast-success" aria-live="polite" style="">
      <div class="toast-message">
          {{$message}}
      </div>
   </div>
 </div>
@endif
<div class="content-header">
   <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-12">
          <h1 align="center" class="m-0 text-dark">Les événements</h1>
          <hr align="center" style="width: 15%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="card">
      <div class="container-fluid" style="background: #eee;">
      <div class="right">
        <a href="#" class="btn ad-btn btnc shadow" data-toggle="modal" data-target="#modal-default">
          <span class="fa fa-plus"></span>
          Nouveau
        </a>

      </div>
      </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive shadow">
              <table id="example1" class="table table-bordered table-striped table-sm dataTable" aria-describedby="example1_info" role="grid">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Titre</th>
                  <th>Description</th>
                  <th>Date de Création</th>
                  <th>Date de l'event</th>
                  <th>Type</th>
                  <th style="display: none;">Type</th>
                  <th>Créateur</th>
                  <th>Options</th>
                </tr>
                </thead>
               <tbody>
               	<?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr>
                 <td>{{$no++}}</td> 
                 <td>{{$value->titre}}</td> 
                  <td>{{$value->description}}</td>
                  <td>{{$value->created_at}}</td>   
                  <td>{{$value->event_date}}</td>
                  <td>{{$value->type}}</td>
                  <td style="display: none;">{{$value->id}}</td>
                  <td>{{$value->byUser}}</td>                            
                  <td>
                   <form action="{{route('events.destroy',$value->id)}}" method="post">
                        </a>
                        <a href="#" id="editEvt" class="btn btn-warning btn-sm" title="Modifier" data-toggle="modal" data-target="#modal-edit">
                          <i class="fa fa-pencil" style="color: #fff;"></i>
                        </a>
                         @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                          <i class="fa fa-trash" style="color: #fff;"></i>
                        </button>
                    </form>
                   </td>
                </tr>
                  @endforeach 
                </tbody>
              </table>
            </div>

            <!-- CREATE EVENT FORM -->
     <div class="modal fade" id="modal-default" style="display: none;" aria-modal="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nouveau Evénement</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
         <form action="{{route('events.store')}}" method="POST" class="form-horizontal">
         	@csrf
            <div class="modal-body">
                <div class="card-body" style="padding: 0px!important">
                 <div class="form-group">
                    <label>Titre</label>
                    <input type="text" class="form-control  @error('titre') is-invalid @enderror" placeholder="Enter titre" name="titre">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control  @error('description') is-invalid @enderror" placeholder="Faite une courte description" name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Date de l'événement</label>
                    <input type="date" class="form-control  @error('event_date') is-invalid @enderror" name="event_date">
                  </div>
                  <div class="form-group">
                  	 <label>Type</label>
	                    <select name="type" class="form-control @error('type') is-invalid @enderror" required="required">
	                          <option value="" hidden="">Type</option>
	                          <option value="Standard">Standard</option>
	                          <option value="Urgent">Urgent</option>
	                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger right" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-success">Créer</button>
            </div>
             </form>
          </div>
        </div>
      </div>
           <!-- EDIT EVENT FORM -->
     <div class="modal fade" id="modal-edit" style="display: none;" aria-modal="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Actualisé l'événement</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
         <form action="{{route('events.update', 7)}}" method="POST" class="form-horizontal">
         	@csrf
         	@method('PATCH')
            <div class="modal-body">
            	<input type="text" id="event_id" name="event_id" value="" style="display: none;">
                <div class="card-body" style="padding: 0px!important">
                 <div class="form-group">
                    <label>Titre</label>
                    <input type="text" id="titre" class="form-control" placeholder="Enter titre" name="titre">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" placeholder="Faite une courte description" id="description" name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Date de l'event</label>
                    <input type="date" class="form-control" id="event_date" name="event_date" value="11-05-2020">
                  </div>
                   <div class="form-group">
                  	 <label>Type</label>
	                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required="required">
	                          <option value="Standard">Standard</option>
	                          <option value="Urgent">Urgent</option>
	                    </select>
                   </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger right" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-success">Actualisé</button>
            </div>
             </form>
          </div>
        </div>
      </div>
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
<!-- page script -->
<script>
  $(function () {

     $("#toast-container").fadeOut(12000);
  });
</script>
<script>
  $(function () {
    $(".events").addClass("active");

     var table=$("#example1").DataTable();
     table.on("click", "#editEvt", function(){
      $tr=$(this).closest("tr");
      if ($($tr).hasClass("child")) {
          $tr=$tr.prev(".parent");
      }
      var data=table.row($tr).data();
      $("#titre").val(data[1]);
      $("#description").val(data[2]);
      $("#type").val(data[5]);
      $("#event_date").val(data[4]);
      $("#event_id").val(data[6]);
    });
  });
</script>

@endsection