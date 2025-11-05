<?php
session_start();
include 'connexion_dbh.php';
include 'recuperationUtil_script.php';

if (!isset($_SESSION['panier']) || empty($_SESSION['panier']) || !isset($_SESSION['idUtilisateur'])) {
    header("Location: ../panier.php");
    exit();
}

$panier = $_SESSION['panier'];
$idUtilisateur = $_SESSION['idUtilisateur'];
$typeCommande = $_POST['type_commande'] ?? 'emporter';
$_SESSION['type_commande'] = $typeCommande;
$est_sur_place = $typeCommande === 'sur_place' ? 1 : 0;
$idEtat = 1;
$date_commande = date('Y-m-d H:i:s');


$stmt = $pdo->prepare("INSERT INTO Commandes (date_commande, total_commande, est_sur_place, idEtat, idUtilisateur) VALUES (?, 0, ?, ?, ?)");
$stmt->execute([$date_commande, $est_sur_place, $idEtat, $idUtilisateur]);
$idCommande = $pdo->lastInsertId();
$_SESSION['idCommande'] = $idCommande;

foreach ($panier as $idProduit => $quantite) {
    // Récupérer le prix unitaire
    $stmt = $pdo->prepare("SELECT prix_unitaire_ht FROM Produits WHERE idProduit = ?");
    $stmt->execute([$idProduit]);
    $produit = $stmt->fetch();

    if ($produit) {
        $prix_unitaire = $produit['prix_unitaire_ht'];
        $total_ht = $prix_unitaire * $quantite;
        $stmt = $pdo->prepare("INSERT INTO LigneCommande (idCommande, idProduit, quantite, total_ht) VALUES (?, ?, ?, ?)");
        $stmt->execute([$idCommande, $idProduit, $quantite, $total_ht]);
    }
}

header("Location: ../payer.php");
exit();
?>
