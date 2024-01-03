<table>
    <thead>
    <tr>
          <th>N° de Citoyen</th>
          <th>Nom(s)</th>
          <th>Prénom(s)</th>
          <th>Date de Naissance</th>
          <th>Lieu de Naissance</th>
          <th>Sexe</th>
          <th>Profession</th>
          <th>Coutume</th>
          <th>Père</th>
          <th>Mère</th>
          <th>Taille</th>
          <th>Coleur des yeux</th>
          <th>cheuveux</th>
          <th>Signe particulier</th>
          <th>Adresse au Bénin</th>
          <th>Adresse au Congo</th>
          <th>Tuteur</th>
          <th>Téléphone</th>
          <th>Email</th>
          <th>N° de ID</th>
          <th>Type ID</th>
          <th>Statut ID</th>
          <th>Date d'émission</th>
          <th>Date d'expiration</th>
          <th>Lieu d'émission</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $value)
        <tr>
            <td>{{ $value->citoyen_no }}</td>
            <td>{{ $value->surname }}</td>
            <td>{{ $value->name }}</td>
            <td>{{date("d-m-Y", strtotime($value->dob))}}</td>
            <td>{{ $value->pofbirth }}</td>
            <td>{{ $value->sexe }}</td>
            <td>{{ $value->profession }}</td>
            <td>{{ $value->coutume }}</td>
            <td>{{ $value->father }}</td>
            <td>{{ $value->mother }}</td>
            <td>{{ $value->taille }}</td>
            <td>{{ $value->eye_color }}</td>
            <td>{{ $value->cheuveux }}</td>
            <td>{{ $value->pa_sign }}</td>
            <td>{{ $value->addressFirstCountry }}</td>
            <td>{{ $value->addressSecondCountry }}</td>
            <td>{{ $value->tuteur }}</td>
            <td>{{ $value->phone }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->id_number }}</td>
            <td>{{ $value->id_type }}</td>
            <td>{{ $value->id_status}}</td>
            <td>{{date("d-m-Y", strtotime($value->date_emission ))}}</td>
            <td>{{date("d-m-Y", strtotime($value->date_expiration ))}}</td>
            <td>{{ $value->place_emission }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
