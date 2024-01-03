<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Carte Consulaire | Bridge Pointe-Noire</title>
  <style>
    body, p, h1, h2, h3, h4, h5, h6 {
      font-family: Arial, sans-serif;
      }
    /* Add any additional styles here if needed */
    .container {
      margin-top: 50px;
      position: relative;
    }

    /* Consular Card styling */
    .consulare-card {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
      position: relative;
      color: #000;
      width: 91.60mm;
      height: 53.98mm;
      margin-bottom: 10px;
      z-index: 1; /* Ensure cards are above QR code */
    }
    .consulare-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      opacity: 0.6;
    }
    

    .consulare-background img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .card-title {
      font-weight: bold;
      font-size: 0.85rem;
      text-align: center;
      margin-top: 10px;
    }

    .row {
      display: flex;
      margin-top: 10px;
    }

    .col-md-6 {
      flex: 0 0 50%;
      max-width: 50%;
    }

    .text-center {
      text-align: center;
    }

    .student-img {
      margin-top: 18px;
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 80px;
      height: 80px;
    }

    .card-body {
      text-align: center;
    }

    .data-label {
      font-weight: bold;
      font-size: 8px;
      margin: 0;
      padding: 1.5px;
    }

    .country-flag,
    .logo-image {
      position: absolute;
      width: 50px;
      height: auto;
      top: 13px;
    }

    .country-flag {
      left: 8px;
      
    }

    .logo-image {
      right: 8px;
    }

    /* Media query for printing */
    @media print {
      .consulare-background {
        display: block;
      }
      
      .d-print-none {
        display: none !important;
      }
    }
    .title-bleu {
      font-size: 1.2rem;
      font-weight: bold;
      color: #0254c3;
      text-align: center;
    }

    .title-small {
      font-size: 0.4rem;
      font-weight: bold;
      color: #012ea2;
      text-align: center;
      letter-spacing: 1.40px;
    }

    .title-medium {
      font-size: 0.8rem;
      font-weight: bold;
      color: black;
      text-align: center;
      letter-spacing: 0.52px;
    }
    .title-bleu,
    .title-small,
    .title-medium {
      margin: 0;
      padding: 0;
    }
    .upper{
      text-transform: uppercase;
    }x
    .capper{
      text-transform: capitalize;
    }
    .bold{
      font-weight: bold;
    }
    .title-small-back {
      font-size: 0.5rem;
      font-weight: bold;
      color: #000;
      text-align: center;
      
    }
    .title-medium-back {
      font-size: 0.6rem;
      font-weight: bold;
      color: black;
      text-align: center;
      
    }
    .qr-code {
      position: absolute;
      bottom: 0;
      left: 90%;
      top: 43%;
      transform: translateX(-50%);
      width: auto;
      height: 50px;
    }
    .signature{
      position: absolute;
      bottom: 0;
      left: 72%;
      top: 44%;
      transform: translateX(-50%);
      width: auto;
      height: 50px;
    }
  </style>
</head>
<body onload="window.print();">

<div class="container">
  <!-- Consular Card - Face A -->
  <div class="consulare-card">
    <div class="consulare-background">
      <img src="{{asset('images/bg_front.png')}}" alt="">
    </div>
    <img src="{{asset('images/drapeau.png')}}" class="country-flag" alt="Country Flag">
    <img src="{{asset('images/sceau.png')}}" class="logo-image" alt="Logo">
    <p class="title-bleu">REPUBLIQUE DU BENIN</p>
    <p class="title-small">CONSULAT GENERAL HONORAIRE A POINTE-NOIRE</p>
    <p class="title-medium">CARTE D'IDENTITE CONSULAIRE</p>


    <div class="row">
      <div class="col-md-4">
        <img src="{{asset('uploads/citoyens')}}/{{$avatar}}" class="student-img" alt="Student Image">
        <br>
        <p class="data-label">N° {{$card_no}}</p>
      </div>
      
      <div class="col-md-6" style="margin-left: 15px; margin-top: 18px; z-index: 0;">
        <div class="">
          <img src="code.png" class="qr-code" alt="QR Code Image">
          <div class="qr-code">
             {!! QrCode::size(50)->generate(route('verifCartes',$id)) !!}
          </div>
          <p class="data-label">Nom(s): </p>
          <p class="data-label upper bold">{{$surname}}</p>
          <p class="data-label">Prénom(s): </p>
          <p class="data-label capper bold">{{$name}}</p>
          <p class="data-label ">Né(e) le: &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  &nbsp&nbsp  A &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp &nbspSexe</p>
          <p class="data-label upper bold">{{$dob}} &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp {{$pofbirth}}  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  &nbsp&nbsp&nbsp  &nbsp&nbsp&nbsp 
          
          @if(\Illuminate\Support\Str::lower($sexe) === 'féminin')
          F
          @endif
          @if(\Illuminate\Support\Str::lower($sexe) === 'masculin')
          M
          @endif
          </p>
          <p class="data-label">Profession:</p>
          <p class="data-label upper bold">{{$profession}}</p>
          <p class="data-label">Adresse:</p>
          <p class="data-label upper bold">{{$address}}</p>
          <!-- Add other data labels and information -->
        </div>
      </div>
    </div>
  </div>
    <!-- QR Code Image -->


  <!-- Consular Card - Face B -->
  <div class="consulare-card">
    <div class="consulare-background">
      <img src="{{asset('images/bg_back.png')}}" alt="">
    </div>
    <p class="title-medium-back">CONSULAT GENERAL HONORAIRE DU BENIN AU CONGO</p>
    <p class="title-small-back">Pointe-Noire, BP 1216, Tel: 05 380 07 04</p>
    <div class="row">
         <div class="col-md-6" style="margin-left: 15px; margin-top: 18px; z-index: 0;">
          <p class="data-label">Téléphone: </p>
          <p class="data-label upper bold">{{$phone}}</p>
          <p class="data-label">Date de délivrance: </p>
          <p class="data-label capper bold">{{ date('d/m/Y', strtotime($date_emission))}}</p>
          <p class="data-label">Date d'expiration: </p>
          <p class="data-label capper bold">{{ date('d/m/Y', strtotime($date_expiration)) }}</p>
        </div>
        <div class="col-md-6" style="margin-left: 5px; margin-top: 25px; z-index: 0;">
          <p class="data-label">Le Consul Général Honoraire </p>
          <br><br> <br>
          <p class="data-label capper bold" style="padding-left: 10px;"> <i> {{$consul->consule}}</i></p>
        </div>
      </div>
      <div class="row" style="text-align: center;">
        <img src="{{asset('uploads/sign')}}/{{$consul->avatar}}" class="signature" alt="signature du Consul">
          <p class="" style="font-weight: bold; font-size: 5px; padding-left: 13%; padding-top: 5px;">
            Le consulat Général Honoraire de la Republique du Bénin au Congo certifie que le titulaire  de la <br>présente carte est 
          immatriculé auprès de lui et prie les services de police de bien vouloir lui <br>facilité la libre circulation, lui accorder  aide et protection 
          en cas de besoin.
        </p>
   

      </div>
    </div>
  </div>
</div>

</body>
</html>
