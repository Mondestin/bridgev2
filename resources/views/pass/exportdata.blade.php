<table>
<thead>
    <tr>
        <th>#</th>
        <th>Reference</th>
        <th>Citoyen</th>
        <th>Date de delivrance</th>
        <th>Date d'expiration</th>
        <th>Voyage</th>
        <th>Validitée</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php $no=1; ?>
        @foreach ($data as $key => $value)
    <tr> 
        <td>{{$no++}}</td>
        <td>{{$value->id_number}}</td>
        <td>{{$value->name}} {{$value->surname}}</td>
        <td>{{date("d-m-Y", strtotime($value->date_emission))}}</td>
        <td>{{date("d-m-Y", strtotime($value->date_expiration))}}</td>
        <td>{{$value->voyage}}</td>
        <td>{{$value->validity}}</td>
        <td>{{$value->status}}</td>                
    </tr>
        @endforeach 
    </tbody>
</table>
