<?php
session_start();
include 'script/connexion_dbh.php';
include 'script/recuperationUtil_script.php';

// insertion au clic "Payer"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payer'])) {

    if (!isset($_SESSION['panier']) || empty($_SESSION['panier']) || !isset($_SESSION['idUtilisateur'])) {
        header("Location: panier.php");
        exit();
    }

    $numero_carte = $_POST['numero_carte'];
    $nom_carte = $_POST['nom_carte'];
    $cvv = $_POST['cvv'];
    $expiration = $_POST['expiration'];

    $erreurs = [];
    if (mb_strlen($numero_carte) != 16){
        $erreurs[] = "Veuillez re tapez vos numéros de carte.";
    }
    if (!preg_match('/^[a-zA-Z\s]+$/', $nom_carte)) {
        $erreurs[] = "Veuillez re tapez votre nom.";
    }
    if (mb_strlen($cvv) != 3){
        $erreurs[] = "Veuillez re tapez votre numéro CVV.";
    }
    if ($expiration < date('Y-m-d')) {
        $erreurs[] = "Veuillez re tapez votre date d'expiration.";
    }

    $_SESSION['erreurs'] = $erreurs;

    if(count($_SESSION['erreurs']) == 0){
        $panier = $_SESSION['panier'];
        $idUtilisateur = $_SESSION['idUtilisateur'];
        $typeCommande  = $_SESSION['type_commande'] ?? 'emporter';
        $est_sur_place = ($typeCommande === 'sur_place') ? 1 : 0;
        $date_commande = date('Y-m-d H:i:s');

        // Insérer la commande (total calculé par le trigger après les lignes)
        $stmt = $pdo->prepare("INSERT INTO Commandes (date_commande, total_commande, est_sur_place, idEtat, idUtilisateur) VALUES (?, 0, ?, 4, ?)");
        $stmt->execute([$date_commande, $est_sur_place, $idUtilisateur]);
        $idCommande = $pdo->lastInsertId();

        // Insérer les lignes (les triggers calculent total_ht et mettent à jour total_commande)
        foreach ($panier as $idProduit => $quantite) {
            $stmt = $pdo->prepare("INSERT INTO LigneCommande (idCommande, idProduit, quantite, total_ht) VALUES (?, ?, ?, 0)");
            $stmt->execute([$idCommande, $idProduit, $quantite]);
        }

        $_SESSION['idCommande'] = $idCommande;
        unset($_SESSION['panier']);

        header("Location: confirmation.php");
        exit();

    } else {
        header("Location: payer.php");
        exit();
    }
} 

if (!isset($_SESSION['idCommande'])) {
  header("Location: panier.php");
  exit();
}  

$idCommande    = $_SESSION['idCommande'];
$typeCommande  = $_SESSION['type_commande'] ?? 'emporter';
$est_sur_place = ($typeCommande === 'sur_place') ? 1 : 0;

$stmt = $pdo->prepare("SELECT total_commande FROM Commandes WHERE idCommande = ?");
$stmt->execute([$idCommande]);
$commande = $stmt->fetch();
$total_commande = $commande['total_commande'];

$stmt = $pdo->prepare("SELECT libEtat FROM Etat WHERE idEtat = 4");
$stmt->execute();
$statut = $stmt->fetch();
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
        <h3>Merci pour votre commande <?= htmlspecialchars($user['login']) ?></h3>
        <p>
            Numéro de commande : <strong><?= $idCommande ?></strong><br>
            Montant total TTC : <strong><?= $total_commande ?> €</strong><br>
            Type : <strong><?= $est_sur_place ? 'Sur place' : 'À emporter' ?></strong><br>
            Statut : <strong><?= htmlspecialchars($statut['libEtat']) ?></strong><br><br>
            Vous recevrez un mail dès qu'elle sera prête.<br><br>
            Revenir à l'accueil ? <a href="script/suppressionpannier_script.php">Cliquez ici</a>
        </p>
    </div>

</body>
</html>
