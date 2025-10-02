<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'script/connexion_script.php';
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

      <input type="password" name="password" placeholder="mot de passe" required>

      <input type="submit" value="Connexion">
    </form>

    <p>Pas de compte ? <a href="inscription.php">S'inscrire</a></p>
    <p>Revenir à l'accueil ? <a href="../index.php">Cliquez ici !</a></p>
  </div>

</body>
</html>
