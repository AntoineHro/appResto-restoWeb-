<?php

session_start();
include 'page/script/connexion_dbh.php';
include 'page/script/recuperationUtil_script.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/nav-barre.css">
</head>
<body style="background-image: url('image/background.png');">

<?php if (isset($_SESSION['idUtilisateur'])){?>
    <nav class="navbar">
          <input type="checkbox" id="menu-toggle" class="menu-toggle" />
            <label for="menu-toggle" class="menu-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </label>

            <div class="nav-links">
                <a href="page/panier.php">🛒</a>
                <a href="index.php" style="text-align: center;">Accueil</a>
                <a href="page/commander.php" style="text-align: center;">Menu</a>
                <a href="page/script/deconnexion_script.php" style="text-align: center;">Se déconnecter</a>         
            </div>
    </nav>

    <p>
        <h2 style="color: white; text-align: center;">Bienvenue sur le restaurant de Wallouz! <?= htmlspecialchars($user['login']); ?></h2>   
    </p>

<?php exit();} else {?>
    <nav class="navbar">
          <input type="checkbox" id="menu-toggle" class="menu-toggle" />
            <label for="menu-toggle" class="menu-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </label>

            <div class="nav-links">
                <a href="index.php" style="text-align: center;">Accueil</a>
                <a href="page/commander.php" style="text-align: center;">Menu</a>
                <a href="page/inscription.php" style="text-align: center;">S'inscrire</a>         
                <a href="page/connexion.php" style="text-align: center;">Se connecter</a>
            </div>
    </nav>

    <h2 style="color: white; text-align: center;">Bienvenue sur le restaurant de Wallouz!</h2>
    <p style="color: white; text-align: center;">Vous n'êtes pas connecté(e), veuillez vous inscrire ou vous connecter pour pouvoir accéder à notre Foire aux Questions</p>

<?php }?>
</body>
</html>