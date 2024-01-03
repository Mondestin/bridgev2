
<table>
    <thead>
      <tr>
        <th>#</th>
        <th>Mandataire</th>
        <th>Relation avec le mandataire</th>
        <th>Bénéficiaire</th>
        <th>Bénéficiaire Contact</th>
        <th>Relation 2</th>
        <th>Enfant</th>
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
            <td>{{$value->relation_parent}}</td>
             <td>{{$value->b_surname}} {{$value->b_name}}</td>
             <td>{{$value->b_contact}}</td>
             <td>{{$value->relation_parent_2}}</td>
             <td>{{$value->child_surname}} {{$value->child_name}}</</td>
             <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
             <td >
               {{$value->status}}
             </td>
            </tr>
              @endforeach 
    </tbody>
</table>
