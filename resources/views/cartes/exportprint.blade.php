<table>
    <thead>
    <tr>
          <th>N° de Citoyen</th>
          <th>Nom(s)</th>
          <th>Prénom(s)</th>
          <th>Date de naissance</th>
          <th>Lieu de naissance</th>
          <th>Sexe</th>
          <th>Adresse</th>
          <th>Profession</th>
          <th>Téléphone</th>
          <th>N° de la Carte</th>
          <th>Statut de la Carte</th>
          <th>Statut d'imprission'</th>
          <th>Date d'émission</th>
          <th>Date d'expiration</th>
          <th>Lien QR code</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $value)
        <tr>
            <td>{{ $value->citoyen_no }}</td>
            <td>{{ $value->surname }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->dob }}</td>
            <td>{{ $value->pofbirth }}</td>
            <td>{{ $value->sexe }}</td>
             <td>{{ $value->addressSecondCountry }}</td>
            <td>{{ $value->profession }}</td>
            <td>{{ $value->phone }}</td>
            <td>{{ $value->card_no }}</td>
            <td>{{ $value->card_status }}</td>
            <td>{{ $value->print_status }}</td>
            <td>{{date("d/m/Y", strtotime($value->date_emission))}}</td>
            <td>{{date("d/m/Y", strtotime($value->date_expiration))}}</td>
            <td>{{ $value->qr_link }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
