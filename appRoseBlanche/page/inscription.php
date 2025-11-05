<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>S'inscrire</title>
  <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>
  <div class="brand">Rose<br>Blanche</div>

  <div class="login-box">
    <h1>S'inscrire</h1><br> 

    <form method="post" action="script/inscription_script.php">

      <input type="email" name="email" placeholder="E-mail" required>

      <input type="text" name="login" placeholder="Login" required>

      <input type="password" name="password" placeholder="mot de passe" required>

      <input type="submit" value="S'inscrire">

    </form>

    <p>Vous avez un compte ?
      <a href="connexion.php">Se connecter</a>
    </p>
    
    <p>Revenir à l'accueil ? 
      <a href="../index.php">Cliquez ici !</a>
    </p>

  </div>

</body>
</html>

