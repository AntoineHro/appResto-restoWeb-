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
<body>

<?php if (isset($_SESSION['idUtilisateur']) && isset($_SESSION['login'])) { include 'page/script/navbarre/navbarreCoI.php';?>

<div class="messageBVN">
    <h2>Bienvenue sur le restaurant de Wallouz! <?= htmlspecialchars($user['login']); ?></h2>   
</div>

<?php } else { include 'page/script/navbarre/navbarreDecoI.php';?>

<div class="messageBVN">
    <h2>Bienvenue sur le restaurant de Wallouz!</h2>
    <p>Vous n'êtes pas connecté(e), veuillez vous inscrire ou vous connecter pour commander.</p>
</div>

<?php }?>
</body>
</html>