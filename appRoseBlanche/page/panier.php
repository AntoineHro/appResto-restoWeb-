<?php

session_start();
include 'script/connexion_dbh.php';
include 'script/recuperationUtil_script.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menus</title>
    <link rel="stylesheet" href="../css/panier.css">
    <link rel="stylesheet" href="../css/nav-barre.css">
</head>
<body class="body">
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
                    <a href="panier.php">🛒</a>
                    <a href="../index.php" style="text-align: center;">Accueil</a>
                    <a href="commander.php" style="text-align: center;">Menu</a>
                    <a href="script/deconnexion_script.php" style="text-align: center;">Se déconnecter</a>         
                </div>
        </nav>

        <p>
            <h2 style="color: white; text-align: center;">Retrouvez-ici votre commande! <?= htmlspecialchars($user['login']);?></h2>
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
                <a href="../index.php" style="text-align: center;">Accueil</a>
                <a href="commander.php" style="text-align: center;">Menu</a>
                <a href="connexion.php" style="text-align: center;">S'inscrire</a>         
                <a href="inscription.php" style="text-align: center;">Se connecter</a>
            </div>
    </nav>

    <h2 style="color: white; text-align: center;">Retrouvez-ici votre commande!</h2>
    <h3 style="color: white; text-align: center;">Attention ! Il faut être connecté pour pouvoir passer commande !</h3>

    <?php } ?>
</body>
</html>