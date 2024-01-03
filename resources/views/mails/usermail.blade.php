<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Bridge Nouveau Utilisateur</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
   <table style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 8px; overflow: hidden;">
      <tr>
         <td style="padding: 20px; text-align: center;">
             <img src="{{asset('images/logo.png')}}" alt="Logo" style="max-width: 200px;">
         </td>
      </tr>
      <tr>
         <td style="padding: 20px; text-align: center;">
            <p>Bonjour {{ $user['name'] }},</p>
            <p>Vous recevez ce message car vous avez été inscrit sur Bridge PNR par le Consulat Général Honoraire du Bénin à Pointe-Noire.</p>
            <p>Vos informations de connexion sont les suivantes:</p>
            <p><strong>Email:</strong> {{$user['email']}}</p>
            <p><strong>Mot de passe:</strong> {{$user['pass']}}</p>
            
            <a href="http://consulat-benin-pnr.org/login" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; text-align: center;">Connexion</a>
         </td>
      </tr>
      <tr>
         <td style="padding: 20px; text-align: center; color: #ff0000;">
            Veuillez noter que ces informations sont strictement confidentielles et personnelles. Ne les partagez en aucun cas.
         </td>
      </tr>
      <tr>
         <td style="padding: 20px; text-align: center; font-size: 12px; color: #888;">
            &copy; {{ date('Y') }} Consulat Général Honoraire du Bénin à Pointe-Noire. Tous droits réservés.
         </td>
      </tr>
   </table>
</body>
</html>

