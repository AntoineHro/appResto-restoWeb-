<?php
session_start();
include 'script/connexion_dbh.php';
include 'script/recuperationUtil_script.php';

if (!isset($_SESSION['panier']) || !isset($_SESSION['idUtilisateur']) || !isset($_SESSION['idCommande'])) {
    header("Location: panier.php");
    exit();
}

$panier = $_SESSION['panier'];
$idUtilisateur = $_SESSION['idUtilisateur'];
$idCommande = $_SESSION['idCommande'];
$typeCommande = $_SESSION['type_commande'] ?? 'emporter';
$est_sur_place = ($typeCommande === 'sur_place') ? 1 : 0;

$newEtat = 4;

$updateStmt = $pdo->prepare("UPDATE Commandes SET idEtat = :newEtat WHERE idCommande = :idCommande");
$updateStmt->execute(['newEtat' => $newEtat, 'idCommande' => $idCommande ]);

$stmt = $pdo->prepare("SELECT total_commande, idEtat FROM Commandes WHERE idCommande = ?");
$stmt->execute([$idCommande]);
$commande = $stmt->fetch();

if (!$commande) {
    exit();
}

$total_commande = $commande['total_commande'];
$idEtat = $commande['idEtat'];


$stmt = $pdo->prepare("SELECT login FROM Utilisateurs WHERE idUtilisateur = ?");
$stmt->execute([$idUtilisateur]);
$user = $stmt->fetch();

$stmt = $pdo->prepare("SELECT libEtat FROM Etat WHERE idEtat = :idEtat");
$stmt->execute(['idEtat' => $newEtat]);
$statut = $stmt->fetchColumn();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="../css/confirmation.css">
</head>
<body class="body">

    <div class="confirmation" style="text-align: center;">
        <h3 style="text-align:center;">Merci pour votre commande <?= htmlspecialchars($user['login']) ?></h3>
        <p>
            Numéro de commande :
            <strong><?= $idCommande ?></strong>
            <br>

            Montant total TTC : 
            <strong><?= $total_commande ?> €</strong>
            <br>

            Type : 
            <strong><?= $est_sur_place ? 'Sur place' : 'À emporter' ?></strong>
            <br>
            
            Statut: 
            <strong><?= $statut ?></strong>
            <br>

            Vous recevrez-un mail dès qu'elle sera prête.
            <br>

            Revenir à l'accueil ?
            <a href="script/suppressionpannier_script.php">Cliquez ici</a>
        </p>
    </div>
</body>
</html>
