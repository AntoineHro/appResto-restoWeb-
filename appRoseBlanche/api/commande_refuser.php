<?php
    require_once '../page/script/connexion_dbh.php';

    $id_commande = $_GET['id_commande'];

    
    $stmt = $pdo->prepare("UPDATE Commandes SET idEtat=5 where idCommande=:id_commande");
    $stmt->execute([':id_commande' => $id_commande]);

    // requête API http://localhost/projet/appRoseBlanche/api/commande_refuser.php?id_commande= <-- on ajoute l'id de la commande

    // processus de notification 
?>