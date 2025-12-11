# 🍽️ Application Web - Resto

Une application web simple pour la gestion d’un restaurant : affichage du menu, inscription/connexion des utilisateurs, gestion du panier et des commandes.

## 🚀 Fonctionnalités
- Page d’accueil avec présentation du restaurant
- Page menu avec présentation et mise en valeur des produits proposés 
- Système d’inscription et de connexion utilisateur  
- Gestion des commandes : ajout au panier, paiement(factice), validation 
- Base de données SQL pour stocker les utilisateurs et les commandes  
- Interface en PHP/CSS avec images  

## 📂 Structure du projet
```
appRoseBlanche/
│── index.php              # Page d'accueil
│── mpd.sql                # Modèle physique de données (base SQL)
│── insert.sql             # script d'insertion sql
│
├── css/                   # Styles CSS
│   ├── commander.css
│   ├── confirmation.css
│   ├── connexion.css
│   ├── historique.css
│   ├── index.css
│   ├── inscription.css
│   ├── nav-barre.css
│   ├── panier.css
│   └── payer.css
│   
│
├── image/                 # Ressources graphiques
│   ├── background.png
│   ├── burger1.png
│   └── panier.png
│
│
├── api/                   # API pour resto Swing
│   ├── commande_en_attente.php
│   ├── commande_accepter.php
│   ├── commande_refuser.php
│   ├── commande_terminer.php
│   └── json
│       └── commande_en_attente_ex_representatif.json #juste un exemple de representation de ce que retourne la requete
│
│
├── page/                  # Pages secondaires       
│   ├── commander.php
│   ├── confirmation.php
│   ├── connexion.php
│   ├── inscription.php
│   ├── panier.php
│   ├── payer.php
│   └── script/              # Scripts backend
│       ├── connexion_dbh.php
│       ├── connexion_script.php
│       ├── deconnexion_script.php
│       ├── inscription_script.php
│       ├── insertioncommande_script.php
│       ├── recuperationUtil_script.php
│       ├── suppressionpannier_script.php
│       └── navbarre/
│            ├── navbarreCoI.php
│            ├── navbarreCoP.php
│            ├── navbarreDecoI.php
│            └── navbarreDecoP.php
│   
```

## 🛠️ Installation

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/ton-compte/appResto-restoWeb.git
   cd appResto-restoWeb/appRoseBlanche
   ```

2. **Configurer la base de données :**
   - Importer le fichier `mpd.sql` directement (c'est un script de création et de peuplement)  :
     ```sql
     SOURCE appRoseBlanche/mpd.sql;
     ```
   - Importer le fichier `insert.sql` directement (c'est un script de peuplement pour les jeux de tests)  :
     ```sql
     SOURCE appRoseBlanche/insert.sql;
     ```

3. **Lancer le serveur PHP :**
   ```bash
   php -S localhost:8000
   ```
   Puis ouvrir [http://localhost:8000](http://localhost:8000) dans le navigateur.

## 🔑 Identifiants de test
<table>
  <thead>
    <tr>
      <th><mark>Nom utilisateur</mark></th>
      <th><mark>Mot de passe</mark></th>
      <th><mark>Fonction</mark></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Test</td>
      <td>test</td>
      <td>Utilisateur de test pour vérifier que l'application tourne bien.</td>
    </tr>
     <tr>
        <td>testn2</td>
        <td>test</td>
        <td>Second utilisateur de test pour vérifier que les fonctions de commandes/paiement/confirmation marchent.</td>
     </tr>
  </tbody>
</table>


## 📌 Prérequis
- PHP >= 7.4  
- MySQL/MariaDB  
- Un serveur local type [XAMPP](https://www.apachefriends.org) ou [Laragon](https://laragon.org)

## ✨ Améliorations futures
- Ajout d’un espace administrateur pour gérer les menus et commandes (restoSwing).
- Mise en place d'un css responsive. 🐱
