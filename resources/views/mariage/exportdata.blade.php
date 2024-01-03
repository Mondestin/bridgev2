<table>
    <thead>
      <tr>
        <th>#</th>
        <th>Nom et Prénom Epoux</th>
        <th>Nom et Prénom Epouse</th>
        <th>Profession Epoux</th>
        <th>Profession Epouse</th>
        <th>Etablit le</th>
        <th>Statut</th>
    </tr>
    </thead>
    <tbody>
   <?php $no=1; ?>
        @foreach ($data as $key => $value)
      <tr> 
        <td>{{$no++}}</td>
        <td>{{$value->mri_name}} {{$value->mri_surname}}</td>
         <td>{{$value->fem_name}} {{$value->fem_surname}}</td>
         <td>{{$value->mri_profession}}</td>
         <td>{{$value->fem_profession}}</td>
          <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
          <td>{{$value->status}}</td>        
      </tr>
        @endforeach 
    </tbody>
</table>
