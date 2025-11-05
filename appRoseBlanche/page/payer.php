<?php
session_start();
include 'script/connexion_dbh.php';
include 'script/recuperationUtil_script.php';

$idCommande = $_SESSION['idCommande'] ?? null;

if (!$idCommande) {
    echo "Erreur : aucune commande en cours.";
    exit();
}

$stmt = $pdo->prepare("SELECT total_commande, est_sur_place FROM Commandes WHERE idCommande = ?");
$stmt->execute([$idCommande]);
$commande = $stmt->fetch();

if (!$commande) {
    echo "Erreur : commande introuvable.";
    exit();
}

$total_commande = $commande['total_commande'];
$est_sur_place = $commande['est_sur_place'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
    <link rel="stylesheet" href="../css/panier.css">
</head>
<body class="body">

<div style="text-align: center; color:white;">
    <h2>Paiement</h2>

    <p><strong>ID de la commande :</strong> 
        <?= htmlspecialchars($idCommande) ?></p>

    <p><strong>Total à payer :</strong> 
        <?= htmlspecialchars($total_commande) ?> €</p>

    <p><strong>Type de commande :</strong>
        <?= $est_sur_place ? 'Sur place' : 'À emporter' ?>
    </p>

    <form method="POST" action="confirmation.php" style="text-align:center;">

        <label>Numéro de carte :</label>
        <br>
        <input type="text" name="numero_carte" placeholder="Max. 16 chiffres" maxlength="16" required>
        <br>
        <br>

        <label>Nom sur la carte :</label>
        <br>
        <input type="text" name="nom_carte" maxlength="15" required>
        <br>
        <br>

        <label>Date expiration :</label>
        <br>
        <input type="date" name="expiration" required>
        <br>
        <br>

        <label>Code de sécurité :</label>
        <br>
        <input type="text" name="cvv" placeholder="Max. 3 chiffres" maxlength="3" required>
        <br>
        <br>

        <button type="submit" name="payer">Payer ✅</button>
        <br>
        <br>

        <p>Une petite faim ? <a href="commander.php">Revenir aux produits !</a></p>
    </form>
</div>

</body>
</html>
