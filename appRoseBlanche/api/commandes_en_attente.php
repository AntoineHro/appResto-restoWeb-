<?php
    require_once '../page/script/connexion_dbh.php';

    $idEtat = 4;

    $stmt = $pdo->prepare("SELECT * FROM Commandes WHERE idEtat=:idEtat");
    $stmt->execute([':idEtat' => $idEtat]);
    $commandes = $stmt->fetchAll();

    foreach ($commandes as $c){
        $tableau[] = 
        [
            "idCommande: " => $c['idCommande'],
            "date_commande: " => $c['date_commande'],
            "total_commande: " => $c['total_commande'],
            "est_sur_place ? 1 = oui / 0 = non" => $c['est_sur_place'],
            "idEtat" => $c['idEtat'],
            "idUtilisateur: " => $c['idUtilisateur']
        ];
    }

    $json = json_encode($tableau,JSON_PRETTY_PRINT);
    header("Content-type: application/json; charset=utf-8");
    echo $json;

    // requête API http://localhost/projet/appRoseBlanche/api/commandes_en_attente.php
?>