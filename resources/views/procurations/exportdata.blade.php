<table>
    <thead>
      <tr>
        <th>#</th>
        <th>Mandataire</th>
        <th>Bénéficiaire</th>
        <th>Bénéficiaire Contact</th>
        <th>Bénéficiaire Adresse</th>
        <th>Etablit le</th>
        <th>Statut</th>
    </tr>
    </thead>
    <tbody>
   <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr> 
                  <td>{{$no++}}</td>
                  <td>{{$value->citoyen_id}}</td>
                   <td>{{$value->b_surname}} {{$value->b_name}}</td>
                   <td>{{$value->b_contact}}</td>
                    <td>{{$value->b_adresse}}</td>
                    <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                   <td >
                    {{$value->status}}
                   </td>        
                </tr>
                 @endforeach 
    </tbody>
</table>
