<?php
// index.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - Restaurant Wallouz</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/nav-barre.css">
</head>
<body>

  <!-- Barre de navigation -->
  <nav class="navbar">
    <input type="checkbox" id="menu-toggle" class="menu-toggle" />
    <label for="menu-toggle" class="menu-icon">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </label>

    <div class="nav-links">
      <a href="page/panier.php">🛒</a>
      <a href="index.php">Accueil</a>
      <a href="page/commander.php">Menu</a>
      <a href="page/inscription.php">S'inscrire</a>         
      <a href="page/connexion.php">Se connecter</a>
    </div>
  </nav>

  <!-- Section héro -->
  <header class="hero">
    <div class="hero-content">
      <h1>Bienvenue chez <span>Wallouz</span> !</h1>
      <p>Découvrez nos burgers savoureux préparés avec passion, et profitez de la <strong>livraison rapide à domicile</strong> !</p>
      <div class="hero-buttons">
        <a href="page/commander.php" class="btn-primary">Commander maintenant</a>
        <a href="page/commander.php" class="btn-secondary">Voir le menu</a>
      </div>
    </div>
  </header>

  <!-- Section Livraison -->
  <section class="delivery">
    <h2>🚚 Livraison rapide & pratique</h2>
    <p>Pas envie de sortir ? Profitez de notre service de livraison express pour déguster nos burgers chez vous en toute tranquillité.</p>
    <div class="delivery-cards">
      <div class="card">
        
        <h3>Partout en ville</h3>
        <p>Nous livrons dans un large périmètre pour que tout le monde puisse profiter de nos spécialités.</p>
      </div>
      <div class="card">
        
        <h3>Rapidité garantie</h3>
        <p>Commandez en ligne et recevez vos plats chauds en moins de 30 minutes !</p>
      </div>
      <div class="card">
        
        <h3>Commande facile</h3>
        <p>Un site simple et rapide pour commander en quelques clics seulement.</p>
      </div>
    </div>
  </section>

  <!-- Section présentation -->
  <section class="about">
    <h2>🍴 Notre restaurant</h2>
    <p>Chez <strong>Wallouz</strong>, nous sélectionnons des ingrédients frais et de qualité pour vous offrir des repas authentiques et généreux. Que ce soit sur place, à emporter ou en livraison, nous sommes là pour régaler vos papilles.</p>
  </section>

  <!-- Section CTA -->
  <section class="cta">
    <h2>Prêt à vous régaler ?</h2>
    <a href="page/commander.php" class="btn-primary">Passez votre commande</a>
  </section>

  <!-- Footer -->
  <footer>
    <p>© <?php echo date("Y"); ?> Restaurant Wallouz - Tous droits réservés</p>
  </footer>

</body>
</html>
