<?php
session_start();
include 'script/connexion_dbh.php';
include 'script/recuperationUtil_script.php';

if (!isset($_SESSION['panier']) || empty($_SESSION['panier']) || !isset($_SESSION['idUtilisateur'])) {
    header("Location: panier.php");
    exit();
}

$panier = $_SESSION['panier'];
$typeCommande  = $_SESSION['type_commande'] ?? 'emporter';
$est_sur_place = $typeCommande === 'sur_place' ? 1 : 0;

$total_ht = 0;
foreach ($panier as $idProduit => $quantite) {
    $stmt = $pdo->prepare("SELECT prix_unitaire_ht FROM Produits WHERE idProduit = ?");
    $stmt->execute([$idProduit]);
    $produit = $stmt->fetch();
    if ($produit) {
        $total_ht += $produit['prix_unitaire_ht'] * $quantite;
    }
}

// affichage des erreurs
$erreurs = $_SESSION['erreurs'] ?? [];
unset($_SESSION['erreurs']); // on vide après lecture

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
    <link rel="stylesheet" href="../css/payer.css">
</head>
<body class="body">

<div class="paiement-card">
    <h2>Paiement</h2>

    <div class="paiement-resume">
        <p><strong>Type :</strong> <?= $est_sur_place ? 'Sur place' : 'À emporter' ?></p>
        <p class="paiement-total"><strong>Total HT :</strong> <?= $total_ht ?> €</p>
    </div>

    <form method="POST" action="confirmation.php">
        <?php
            foreach($erreurs as $erreur){
                echo $erreur;
            }
        ?>
        <div class="form-group">
            <label for="numero_carte">Numéro de carte</label>
            <input type="text" id="numero_carte" name="numero_carte" placeholder="16 chiffres" maxlength="16" required>
        </div>

        <div class="form-group">
            <label for="nom_carte">Nom sur la carte</label>
            <input type="text" id="nom_carte" name="nom_carte" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="expiration">Date d'expiration</label>
                <input type="date" id="expiration" name="expiration" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv"
                       placeholder="3 chiffres" maxlength="3" required>
            </div>
        </div>

        <button type="submit" name="payer" class="btn-payer">Payer</button>

    </form>

    <p class="paiement-retour">
        Une petite faim ? <a href="commander.php">Revenir aux produits</a>
    </p>
</div>

</body>
</html>
