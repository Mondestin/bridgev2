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
          <h1 align="center" class="m-0 text-dark">Paramètres </h1>
          <hr align="center" style="width: 10%">
         </div><!-- /.col -->
     </div><!-- /.row -->
 </div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container">
      <h3 class="card-title" style="margin-left: 45px">
        {{-- <strong>Information sur le consule</strong> --}}
      </h3><br>
       <div class="container row">
       	   <div class="form-group col-md-5 card-header card" >
              <label>Nom complet du consule <span class="text-danger">*</span></label>
              <form action="{{route('settings.update',1)}}" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="form-group">
                  <input type="text" class="form-control  @error('consule') is-invalid @enderror" id="consule" name="consule" placeholder="Ex: Bill Karter" value="{{$data->consule}}" readonly="readonly" required="required">
                  </div>
                  <div class="form-group right">
                  <a href="#" id="modifier" class="btn btn-primary">Modifier</a>
                  <button type="submit" id="save" class="btn btn-success" disabled="disabled">Sauvegarder</button>
                  </div>
              </form>

              <label class="">Mot de passe administrateur<span class="text-danger">*</span></label>
              <form action="{{route('settings.update',1)}}" method="POST" class="right">
                  @csrf
                  @method('PATCH')
                  <div class="form-group">
                   <input type="password" class="form-control  @error('admin_password') is-invalid @enderror" id="admin_password" name="admin_password" value="{{$data->admin_password}}" required="required">
                  </div
                  <div class="form-group right">
                  
                    <button type="submit" id="modifier" class="btn btn-primary right">Modifier le mot de passe</button>
                  
              </form> 
           </div>
           <div class="col-md-1">
           </div>
            <div class="col-md-5 card-header card">
              <form action="{{route('settings.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('POST')
                <label>Signature <span class="text-danger">*</span></label>
                  <div class="picture-container">
                  <div class="picture">
                      <img src="/uploads/sign/{{$data->avatar}}" class="picture-src" id="wizardPicturePreview" title=""/>
                      <input type="file" id="wizard-picture" name="avatar" class="form-control">
                  </div>
                  <h6>Signature</h6>
                </div>
                 <button type="submit" class="btn btn-success right">Sauvegarder</button>
              </form>
            </div>

       </div>

      	<!-- Frais de visas -->
      		<!-- <div class="card">
              <div class="card-header">
                <h3 class="card-title">Frais de Visas</h3>
                <a href="" class="btn btn-primary right" data-toggle="modal" data-target="#modal-visas">Modifier</a>
              </div>

              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Type</th>
                      <th>Frais</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Visa une entrée</td>
                      <td>{{$data->visas1}}</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Visa court séjour</td>
                      <td>{{$data->visas2}}</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Visa double entrées</td>
                      <td>{{$data->visas3}}</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Visa plusieurs entrées</td>
                      <td>{{$data->visas4}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div> -->
            <!--/ Frais de visas -->
            <h3 class="card-title" style="margin-left: 45px">
     <strong>Les frais des services consulaire</strong>
    </h3>

      	<!-- Autres Frais -->
        <div class="container row" style=" margin-left: 1%;">
      		<div class="card mt-5" style="margin-left: 3%;">
              <div class="card-header">
                <h3 class="card-title">Autres Frais</h3>
                <a href="" class="btn btn-primary right" data-toggle="modal" data-target="#modal-autres">Modifier</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Type</th>
                      <th>Frais</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Laissez-passer</td>
                      <td>{{$data->passer}}</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Acte de Naissance</td>
                      <td>{{$data->naissance}}</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Acte de Mariage</td>
                      <td>{{$data->mariage}}</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Acte de Décès</td>
                      <td>{{$data->deces}}</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Autorisation Parentale</td>
                      <td>{{$data->authorisation}}</td>
                    </tr>
                      <tr>
                      <td>6</td>
                      <td>Procuration</td>
                      <td>{{$data->procuration}}</td>
                    </tr>
                           <tr>
                      <td>7</td>
                      <td>Legalisation</td>
                      <td>{{$data->legalisations}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Autres Frais -->

             <!-- Frais de visas -->
      		<div class="card mt-5" style="margin-left: 3%;">
              <div class="card-header">
                <h3 class="card-title">Frais de Cartes Consulaire</h3>
                <a href="" class="btn btn-primary right" data-toggle="modal" data-target="#modal-cartes">Modifier</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Type</th>
                      <th>Frais</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Nouvelle</td>
                      <td>{{$data->carte1}}</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Renouvellement</td>
                      <td>{{$data->carte2}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Frais de visas -->

        </div>
    </div>
</div>
            <!-- CREATE VISAS FORM
     <div class="modal fade" id="modal-visas" style="display: none;" aria-modal="true">
        <div class="modal-dialog">
          <div class="modal-content">
         <form action="{{route('settings.update',1)}}" method="POST" class="form-horizontal">
         	@csrf
         	@method('PATCH')
            <div class="modal-body">
                <div class="card-body" style="padding: 0px!important">
                 <div class="form-group">
                    <label>Visa une entrée</label>
                    <input type="number" class="form-control  @error('visa1') is-invalid @enderror" placeholder="Entrer le prix" name="visas1" value="{{ $data->visas1}}" required="required">
                  </div>
  				  <div class="form-group">
                    <label>	Visa court séjour</label>
                    <input type="number" class="form-control  @error('visa2') is-invalid @enderror" placeholder="Entrer le prix" name="visas2" value="{{ $data->visas2}}" required="required">
                  </div>
                    <div class="form-group">
                    <label>Visa double entrée</label>
                    <input type="number" class="form-control  @error('visa3') is-invalid @enderror" placeholder="Entrer le prix" name="visas3" value="{{ $data->visas3}}" required="required">
                  </div>
                    <div class="form-group">
                    <label>Visa plusieurs entrées</label>
                    <input type="number" class="form-control  @error('visa4') is-invalid @enderror" placeholder="Entrer le prix" name="visas4" value="{{ $data->visas4}}" required="required">
                  </div>
                </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger right" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-success">Sauvegarder</button>
            </div>
             </form>
          </div>
        </div>
      </div> -->

            <!-- CREATE Autres FORM -->
     <div class="modal fade" id="modal-autres" style="display: none;" aria-modal="true">
        <div class="modal-dialog">
          <div class="modal-content">
         <form action="{{route('settings.update',1)}}" method="POST" class="form-horizontal">
         	@csrf
         	@method('PATCH')
            <div class="modal-body">
                <div class="card-body" style="padding: 0px!important">
                 <div class="form-group">
                    <label>Laissez-passer</label>
                    <input type="number" class="form-control  @error('passer') is-invalid @enderror" placeholder="Entrer le prix" name="passer" value="{{ $data->passer}}" required="required">
                  </div>
  				  <div class="form-group">
                    <label>	Acte de Naissance</label>
                    <input type="number" class="form-control  @error('naissance') is-invalid @enderror" placeholder="Entrer le prix" name="naissance" value="{{ $data->naissance}}" required="required">
                  </div>
                    <div class="form-group">
                    <label>	Acte de Mariage</label>
                    <input type="number" class="form-control  @error('mariage') is-invalid @enderror" placeholder="Entrer le prix" name="mariage" value="{{ $data->mariage}}" required="required">
                  </div>
                    <div class="form-group">
                    <label>Acte de Décès</label>
                    <input type="number" class="form-control  @error('deces') is-invalid @enderror" placeholder="Entrer le prix" value="{{ $data->deces}}"name="deces">
                  </div>
                      <div class="form-group">
                    <label>Procuration</label>
                    <input type="number" class="form-control  @error('procuration') is-invalid @enderror" placeholder="Entrer le prix" name="procuration" value="{{ $data->procuration}}" required="required">
                  </div>
                    <div class="form-group">
                    <label>Autorisation Parentale</label>
                    <input type="number" class="form-control  @error('authorisation') is-invalid @enderror" placeholder="Entrer le prix" name="authorisation" value="{{ $data->authorisation}}" required="required">
                  </div>
                       <div class="form-group">
                    <label>Legalisation</label>
                    <input type="number" class="form-control  @error('legalisations') is-invalid @enderror" placeholder="Entrer le prix" name="legalisations" value="{{ $data->legalisations}}" required="required">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger right" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-success">Sauvegarder</button>
            </div>
             </form>
          </div>
        </div>
      </div>


          <!-- CREATE Autres FORM -->
     <div class="modal fade" id="modal-cartes" style="display: none;" aria-modal="true">
        <div class="modal-dialog">
          <div class="modal-content">
         <form action="{{route('settings.update',1)}}" method="POST" class="form-horizontal">
         	@csrf
            @method('PATCH')
            <div class="modal-body">
                <div class="card-body" style="padding: 0px!important">
                 <div class="form-group">
                    <label>Nouvelle</label>
                    <input type="number" class="form-control  @error('carte1') is-invalid @enderror" placeholder="Entrer le prix" name="carte1" value="{{ $data->carte1}}" required="required">
                  </div>
  				  <div class="form-group">
                    <label>Renouvellement</label>
                    <input type="number" class="form-control  @error('carte2') is-invalid @enderror" placeholder="Entrer le prix" name="carte2" value="{{ $data->carte2}}" required="required">
                  </div>
                </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger right" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-success">Sauvegarder</button>
            </div>
             </form>
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
    $("#example1").DataTable();
     $("#toast-container").fadeOut(12000);

   $("#modifier").on('click', function(e){
   	e.preventDefault();
   	  $("#consule").removeAttr("readonly");
   	  $("#save").removeAttr("disabled");
   });

  });
</script>
<script type="text/javascript">
   // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });
   //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
  $(function () {
    $(".settings").addClass("active");
  });
</script>
@endsection
