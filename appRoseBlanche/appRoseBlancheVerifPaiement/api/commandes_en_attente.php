<?php
    require_once '../page/script/connexion_dbh.php';

    // Pour avoir toutes les commandes
    $stmt = $pdo->prepare("SELECT c.idCommande, c.idUtilisateur, u.login, c.date_commande, e.libEtat, count(lc.quantite) as nbPlats, c.total_commande
                           FROM Etat e
                           JOIN Commandes c on e.idEtat = c.idEtat
                           JOIN Utilisateurs u on c.idUtilisateur = u.idUtilisateur
                           JOIN LigneCommande lc on c.idCommande = lc.idCommande
                           JOIN Produits p on lc.idProduit = p.idProduit
                           WHERE e.idEtat = 4 OR e.idEtat = 6
                           GROUP by idCommande");
    $stmt->execute();
    $commandes = $stmt->fetchAll();


    foreach ($commandes as $c){
        $commande =
        [
            "ID_cmd" => $c['idCommande'],
            "ID_user" => $c['idUtilisateur'],
            "Login" => $c['login'],
            "Date" => $c['date_commande'],
            "Etat" => $c['libEtat'],
            "NB_plats" => $c['nbPlats'],
            "Montant" => $c['total_commande'],
            "Produits" => []
        ];

    // Pour avoir le détails par commande
    $stmt = $pdo->prepare("SELECT lc.idCommande, p.idProduit, p.libProduit, lc.quantite
                                  FROM Produits p
                                  JOIN LigneCommande lc on lc.idProduit = p.idProduit
                                  WHERE lc.idCommande =:idCommande");
    $stmt->execute(['idCommande' => $c['idCommande']]);
    $produits = $stmt->fetchAll();

        foreach ($produits as $p){
            $commande["Produits"][]= 
            [
                "ID-produit" => $p['idProduit'],
                "Plat" => $p['libProduit'],
                "Quantite" => $p['quantite']
            ];
        }
        
        $tableau[] = $commande;
    }
    
    
    $json = json_encode($tableau, JSON_PRETTY_PRINT);
    header("Content-type: application/json; charset=utf-8");
    echo $json;

    // requête API http://localhost/projet/appRoseBlanche/api/commandes_en_attente.php
?>