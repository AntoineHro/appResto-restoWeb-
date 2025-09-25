<?php
// register.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>S'inscrire</title>
  <link rel="stylesheet" href="../css/register.css">
</head>
<body>

  <div class="brand">BURGOUZZ<br>FACTORY</div>

  <div class="login-box">
    <h1>S'inscrire</h1><br>

    <!-- Envoi du formulaire vers register_process.php -->
    <form method="post" action="register_process.php">
      <input type="text" name="login" placeholder="Login" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <input type="submit" value="S'inscrire">
    </form>

    
    <a href="../index.php" class="bouton-2">Se connecter</a>

    <a href="../index.php" class="bouton-2">Revenir à l'accueil</a>
  </div>

</body>
</html>
