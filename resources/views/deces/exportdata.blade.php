<table>
    <thead>
    <tr>
      <th>Nom(s) et Prénom(s)</th>
      <th>Sexe</th>
      <th>Date de Naissance</th>
      <th>Date de Décès</th>
      <th>Date de déclaration</th>
      <th>Statut</th>
    </tr>          
  </thead>
<tbody>
    @foreach ($data as $key => $value)
    <tr> 
      <td>{{$value->name}} {{$value->surname}}</td>
      <td>{{$value->sexe}}</td>
      <td>{{date("d-m-Y", strtotime($value->date_of_birth))}}</td>
      <td>{{date("d-m-Y", strtotime($value->deces_date))}}</td>
      <td>{{date("d-m-Y", strtotime($value->declare_date))}}</td> 
      <td>{{$value->status}}</td>          
    </tr>
     @endforeach 
    </tbody>
</table>
