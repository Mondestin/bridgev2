<table>
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
   <?php $no=1; ?>
        @foreach ($data as $key => $value)
      <tr> 
        <td>{{$no++}}</td>
        <td>{{$value->name}} {{$value->surname}}</td>
         <td>{{$value->type}}</td>
         <td>{{$value->school_name}}</td>
         <td>{{$value->date_delivrance}}</td>
         <td>{{$value->place_emission}}</td>
          <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
          <td >
          {{$value->status}}
          </td>        
      </tr>
        @endforeach 
    </tbody>
</table>
