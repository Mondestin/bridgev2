<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <title>Bridge Nouveau mot de passe</title>
<body>

   <div class="container">
    <div class="container mt-5">
     <div class="card text-center col-md-6">
  <div class="card-body">
    <h3 class="card-title">Consulat Honoraire du Bénin à Pointe-Noire</h3>
    <p class=" mt-5">Bonjour {{ $user['name'] }},  <br> <br><br>voici votre nouveau mot de passe: </p>

    <p class="card-text mt-2"> <strong>Mot de passe: {{$user['pass']}}</strong></p>
    <a href="http://consulat-benin-pnr.org/login" class="btn btn-primary">Cliquer ici pour vous connecter</a>
  </div><br><br>
  <div class="card-footer text-danger">
    Celui-ci est strictement confidentiel et personnel. <br>
      Ne le partager surtout pas.
  </div>
    </div>
</div>
   </div>
</body>
</html>
