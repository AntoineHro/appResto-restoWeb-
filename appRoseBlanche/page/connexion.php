<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="../css/connexion.css">
  <link rel="stylesheet" href="../css/nav-barre.css">
</head>
<body>
  <div class="brand">BURGOUZZ<br>FACTORY</div>

  <div class="login-box">
    <h1>Se connecter</h1><br>

    <form method="post" action="script/connexion_script.php">
      <input type="text" name="login" placeholder="Entrez votre login" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <input type="submit" value="Connexion">
    </form>

    <br>
      <a href="inscription.php">S'inscrire?</a>

    <br>
      <a href="../index.php">Retour à l'accueil</a>
      
  </div>

</body>
</html>