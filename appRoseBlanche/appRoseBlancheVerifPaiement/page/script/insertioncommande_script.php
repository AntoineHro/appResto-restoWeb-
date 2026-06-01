<?php
session_start();
include 'connexion_dbh.php';
include 'recuperationUtil_script.php';

if (!isset($_SESSION['panier']) || empty($_SESSION['panier']) || !isset($_SESSION['idUtilisateur'])) {
    header("Location: ../panier.php");
    exit();
}

$_SESSION['type_commande'] = $_POST['type_commande'] ?? 'emporter';

header("Location: ../payer.php");
exit();
?>
