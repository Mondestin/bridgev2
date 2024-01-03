<table>
    <thead>
      <tr>
      <th>#</th>
      <th>Nom(s) & Prénom(s)</th>
      <th>Sexe</th>
      <th>Date de Naissance</th>
      <th>Nom(s) & Prénom(s) Père</th>
      <th>Nom(s) & Prénom(s) Mère</th>
      <th>Déclarant</th>
      <th>Status</th>
    </tr>
    </thead>
    <tbody>
   <?php $no=1; ?>
                 @foreach ($data as $key => $value)
                <tr> 
                  <td>{{$no++}}</td>
                 <td>{{$value->name}} {{$value->surname}}</td>
                  <td>{{$value->sexe}}</td>
                  <td>{{date("d-m-Y", strtotime($value->date_of_birth))}}</td>
                  <td>{{$value->f_name}} {{$value->f_surname}}</td>
                  <td>{{$value->m_name}} {{$value->m_surname}}</td>
                  <td>{{$value->d_name}} {{$value->d_surname}}</td>
                   <td>{{$value->status}}</td>                   
                </tr>
                 @endforeach 
    </tbody>
</table>
