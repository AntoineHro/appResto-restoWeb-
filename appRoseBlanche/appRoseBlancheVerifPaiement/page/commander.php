<?php
session_start();
include 'script/connexion_dbh.php';
include 'script/recuperationUtil_script.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_panier'])) {
    $idProduit = $_POST['ajouter_panier'];

    if (isset($_SESSION['panier'][$idProduit])) {
        $_SESSION['panier'][$idProduit]++;
    } else {
        $_SESSION['panier'][$idProduit] = 1;
    }
    header('Location: commander.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../css/commander.css">
    <link rel="stylesheet" href="../css/nav-barre.css">
</head>
<body class="body">
    <?php if (isset($_SESSION['idUtilisateur'])) { include 'script/navbarre/navbarreCoP.php';?>

        <h2 style="color: white; text-align: center;">
          <?php echo "Bienvenue " . $user['login'] . ", ";?>
          Retrouvez-ici nos différents menus !</h2>
          <br>
        <p style="text-align: center;" >
          <a href="panier.php" class="price">Voir ma commande</a>
        </p>

<main class="menu-container">
    <div class="menu-container">
            <div class="menu-card">
                <h3>Le Simple Cheese</h3>
                <p>
                  <br>Pain brioché</br>
                  <br>Steak</br>
                  <br>Fromage</br>
                  <br>Salade</br>
                  <br>Tomate</br>
                </p>
              <form method="POST">
                <button type="submit" name="ajouter_panier" value="1" class="menu-link">🛒 9,99$</button>
              </form>
            </div>

            <div class="menu-card">
                <h3>Le Double Chesse</h3>
                <p>
                  <br>Pain brioché</br>
                  <br>Double steak</br>
                  <br>Double fromage</br>
                  <br>Salade</br>
                  <br>Tomate</br>
                </p>
              <form method="POST">
                <button type="submit" name="ajouter_panier" value="2" class="menu-link">🛒 11,99$</button>
              </form>
            </div>

            <div class="menu-card">
                <h3>Le Triple Cheese</h3>
                <p>
                  <br>Pain brioché</br>
                  <br>Triple steak</br>
                  <br>Triple fromage</br>
                  <br>Salade</br>
                  <br>Tomate</br>
                </p>
              <form method="POST">
                <button type="submit" name="ajouter_panier" value="3" class="menu-link">🛒 13,99$</button>
              </form>
            </div>

            <div class="menu-card">
                <h3>Le XXXL Cheese</h3>
                <p>
                  <br>Pain brioché</br>
                  <br>6 steak</br>
                  <br>6 fromage</br>
                  <br>Salade</br>
                  <br>Tomate</br>
                </p>
              <form method="POST">
                <button type="submit" name="ajouter_panier" value="4" class="menu-link">🛒 17,99$</button>
              </form>
            </div>
    </div>
</main>

<?php exit();} else { include 'script/navbarre/navbarreDecoP.php';?>
    <p>
      <h2 style="color: white; text-align: center;">
        Retrouvez-ici nos différents menus !
      </h2>
    </p>

<main class="menu-container">
    <div class="menu-container">
            <div class="menu-card">
                <h3>Le Simple Cheese</h3>
                <p>
                  <br>Pain brioché</br>
                  <br>Steak</br>
                  <br>Fromage</br>
                  <br>Salade</br>
                  <br>Tomate</br>
                </p>
                <div class="price">9,99$</div>
            </div>

            <div class="menu-card">
                <h3>Le Double Chesse</h3>
                <p>
                  <br>Pain brioché</br>
                  <br>Double steak</br>
                  <br>Double fromage</br>
                  <br>Salade</br>
                  <br>Tomate</br>
                </p>
                <div class="price">11,99$</div>
            </div>

            <div class="menu-card">
                <h3>Le Triple Cheese</h3>
                <p>
                  <br>Pain brioché</br>
                  <br>Triple steak</br>
                  <br>Triple fromage</br>
                  <br>Salade</br>
                  <br>Tomate</br>
                </p>
                <div class="price">13,99$</div>
            </div>

            <div class="menu-card">
                <h3>Le XXXL Cheese</h3>
                <p>
                  <br>Pain brioché</br>
                  <br>6 steak</br>
                  <br>6 fromage</br>
                  <br>Salade</br>
                  <br>Tomate</br>
                </p>
                <div class="price">17,99$</div>
            </div>
        </div>
</main>
<?php } ?>
</body>
</html>