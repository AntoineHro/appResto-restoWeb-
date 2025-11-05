<?php
session_start();

unset($_SESSION['panier']);
unset($_SESSION['idCommande']);
unset($_SESSION['type_commande']);

header("Location: ../../index.php");
exit();

?>