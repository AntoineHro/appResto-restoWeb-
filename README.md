# 🍽️ Application Web - Resto

Une application web simple pour la gestion d’un restaurant : affichage du menu, inscription/connexion des utilisateurs, gestion du panier et des commandes.

## 🚀 Fonctionnalités
- Page d’accueil avec présentation du restaurant  
- Système d’inscription et de connexion utilisateur  
- Gestion des commandes (ajout au panier, validation)  
- Base de données SQL pour stocker les utilisateurs et les commandes  
- Interface en PHP/CSS avec images  

## 📂 Structure du projet
```
appRoseBlanche/
│── index.php              # Page d'accueil
│── mpd.sql                # Modèle physique de données (base SQL)
│
├── css/                   # Styles CSS
│   ├── connexion.css
│   ├── index.css
│   ├── inscription.css
│   ├── menus.css
│   ├── nav-barre.css
│   └── panier.css
│
├── image/                 # Ressources graphiques
│   ├── background.png
│   ├── burger1.png
│   └── panier.png
│
├── page/                  # Pages secondaires
│   ├── connexion.php
│   ├── inscription.php
│   ├── commander.php
│   ├── panier.php
│   └── script/            # Scripts backend
│       ├── connexion_dbh.php
│       ├── connexion_script.php
│       ├── deconnexion_script.php
│       ├── inscription_script.php
│       └── recuperationUtil_script.php
```

## 🛠️ Installation

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/ton-compte/appResto-restoWeb.git
   cd appResto-restoWeb/appRoseBlanche
   ```

2. **Configurer la base de données :**
   - Créer une base de données MySQL/MariaDB.  
   - Importer le fichier `mpd.sql` :
     ```sql
     SOURCE appRoseBlanche/mpd.sql;
     ```
   - Adapter les identifiants de connexion à la BDD dans `page/script/connexion_dbh.php`.

3. **Lancer le serveur PHP :**
   ```bash
   php -S localhost:8000
   ```
   Puis ouvrir [http://localhost:8000](http://localhost:8000) dans le navigateur.

## 🔑 Identifiants de test
Si fournis dans `mpd.sql`, importer les données de test. Sinon, créer un compte via la page d’inscription.

## 📌 Prérequis
- PHP >= 7.4  
- MySQL/MariaDB  
- Un serveur local type [XAMPP](https://www.apachefriends.org) ou [Laragon](https://laragon.org)

## ✨ Améliorations possibles
- Ajout d’un espace administrateur pour gérer les menus et commandes.  
- Système de paiement en ligne.  
- Interface responsive (mobile-first).  
