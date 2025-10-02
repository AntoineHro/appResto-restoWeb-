<?php

session_start();
include 'script/connexion_dbh.php';
include 'script/recuperationUtil_script.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menus.css">
    <link rel="stylesheet" href="../css/nav-barre.css">
    <title>Menu</title>
</head>
<body>
<body class="body">
    <?php if (isset($_SESSION['idUtilisateur'])){?>
        <nav class="navbar">
              <input type="checkbox" id="menu-toggle" class="menu-toggle" />
                <label for="menu-toggle" class="menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </label>

                <div class="nav-links">
                    <a href="panier.php">🛒</a>
                    <a href="../index.php" style="text-align: center;">Accueil</a>
                    <a href="commander.php" style="text-align: center;">Menu</a>
                    <a href="script/deconnexion_script.php" style="text-align: center;">Se déconnecter</a>         
                </div>
        </nav>

        <p>
            <h2 style="color: white; text-align: center;">Retrouvez-ici nos différents menus ! <?= htmlspecialchars($user['login']);?></h2>
        </p>

  <main class="menu-container">
    <section class="menu-item">
      <h2>LE SIMPLE CHEESE</h2>
      <ul>
        <li>pain brioché</li>
        <li>steak</li>
        <li>salade</li>
        <li>fromage</li>
        <li>tomate</li>
      </ul>
      <div class="price">9,99€</div>
    </section>

    <section class="menu-item">
      <h2>LE DOUBLE CHEESE</h2>
      <ul>
        <li>double steak</li>
        <li>salade</li>
        <li>tomate</li>
        <li>double fromage</li>
      </ul>
      <div class="price">11,99€</div>
    </section>

    <section class="menu-item">
      <h2>LE TRIPPLE CHEESE</h2>
      <ul>
        <li>triple steak</li>
        <li>salade</li>
        <li>tomate</li>
        <li>triple frommage</li>
      </ul>
      <div class="price">13,99€</div>
    </section>

    <section class="menu-item">
      <h2>LE XXXL CHEESE <br> TRIPPLE MONSTRE</h2>
      <ul>
        <li>6 steaks</li>
        <li>salade</li>
        <li>tomate</li>
        <li>6fromages</li>
      </ul>
      <div class="price">17,99€</div>
    </section>
  </main>

<?php exit();} else {?>

    <nav class="navbar">
          <input type="checkbox" id="menu-toggle" class="menu-toggle" />
            <label for="menu-toggle" class="menu-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </label>

            <div class="nav-links">
                <a href="../index.php" style="text-align: center;">Accueil</a>
                <a href="commander.php" style="text-align: center;">Menu</a>
                <a href="connexion.php" style="text-align: center;">S'inscrire</a>         
                <a href="inscription.php" style="text-align: center;">Se connecter</a>
            </div>
    </nav>

  <main class="menu-container">
    <section class="menu-item">
      <h2>LE SIMPLE CHEESE</h2>
      <ul>
        <li>pain brioché</li>
        <li>steak</li>
        <li>salade</li>
        <li>fromage</li>
        <li>tomate</li>
      </ul>
      <div class="price">9,99€</div>
    </section>

    <section class="menu-item">
      <h2>LE DOUBLE CHEESE</h2>
      <ul>
        <li>double steak</li>
        <li>salade</li>
        <li>tomate</li>
        <li>double fromage</li>
      </ul>
      <div class="price">11,99€</div>
    </section>

    <section class="menu-item">
      <h2>LE TRIPPLE CHEESE</h2>
      <ul>
        <li>triple steak</li>
        <li>salade</li>
        <li>tomate</li>
        <li>triple frommage</li>
      </ul>
      <div class="price">13,99€</div>
    </section>

    <section class="menu-item">
      <h2>LE XXXL CHEESE <br> TRIPPLE MONSTRE</h2>
      <ul>
        <li>6 steaks</li>
        <li>salade</li>
        <li>tomate</li>
        <li>6fromages</li>
      </ul>
      <div class="price">17,99€</div>
    </section>
  </main>

    <?php } ?>
</body>
</html>