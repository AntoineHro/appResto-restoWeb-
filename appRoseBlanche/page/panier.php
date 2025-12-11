<?php
session_start();
include 'script/connexion_dbh.php';
include 'script/recuperationUtil_script.php';


$panier = $_SESSION['panier'] ?? [];
$type_commande = $_SESSION['type_commande'] ?? 'emporter';
$total_general = 0;

// Supprimer un produit du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $idASupprimer = $_POST['supprimer'];
    unset($_SESSION['panier'][$idASupprimer]);
    header("Location: panier.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="../css/panier.css">
    <link rel="stylesheet" href="../css/nav-barre.css">
    <link rel="stylesheet" href="../css/panier.css">
</head>
<body class="body">
<?php if (isset($_SESSION['idUtilisateur'])){ include 'script/navbarre/navbarreCoP.php';?>

    <h2 style="color: white; text-align: center;">Voici votre panier, <?php echo $user['login']; ?> !</h2>


<div class="center-container">
    <div class="tableau">
    <table border="1">
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

    <?php foreach ($panier as $idProduit => $quantite):
            $stmt = $pdo->prepare("SELECT libProduit, prix_unitaire_ht FROM Produits WHERE idProduit = ?");
            $stmt->execute([$idProduit]);
            $produit = $stmt->fetch();

            $total_ligne = $produit['prix_unitaire_ht'] * $quantite;
            $total_general += $total_ligne;
        ?>
        <tr>
            <td><?php echo$produit['libProduit'] ?></td>
            <td><?php echo $quantite ?></td>
            <td><?php echo $produit['prix_unitaire_ht'] ?> €</td>
            <td><?php echo $total_ligne ?> €</td>
            <td>
                <form method="POST" style="display:inline;">
                    <button type="submit" name="supprimer" value="<?= $idProduit ?>">Retirer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

        <tr>
            <td colspan="3">
                <strong>Total général Hors taxe</strong>
            </td>
            <td colspan="2">
                <strong><?php echo $total_general . "€" . " h.t"; ?></strong>
            </td>
        </tr>
    </table>

    <form method="POST" style="text-align: center;" action="script/insertioncommande_script.php">
        <label>
            <input type="radio" name="type_commande" value="sur_place" checked> Manger sur place
        </label>
        <label>
            <input type="radio" name="type_commande" value="emporter"> À emporter
        </label>
        <br><br>
        <button type="submit" name="valider_commande">✅ Valider ma commande</button>
    </form>
    </div>
</div>

<?php } else { include 'script/navbarre/navbarreDecoP.php';?>

    <h2 style="color: white; text-align: center;">Bienvenue sur le restaurant de Wallouz!</h2>
    <p style="color: white; text-align: center;">Vous n'êtes pas connecté(e), veuillez vous inscrire ou vous connecter pour commander.</p>

<?php }?>
</body>
</html>
