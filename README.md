# 🌹 appRestoweb — Application de commande en ligne

Application web PHP de commande de repas pour le restaurant restoWeb, avec système d'authentification, panier, paiement par carte bancaire (fictive) et gestion des commandes.

---

## 📋 Fonctionnalités

- **Inscription / Connexion** des utilisateurs avec hachage du mot de passe (`password_hash`)
- **Catalogue** de burgers consultable sans compte, commandable une fois connecté
- **Panier** : ajout de produits, suppression, choix *sur place* ou *à emporter*
- **Paiement par carte** : formulaire avec numéro, nom, CVV et date d'expiration
- **Validation serveur** des données de carte avant insertion en base
- **Confirmation** de commande avec numéro, montant TTC et statut
- **API REST interne** (`/api/`) pour le back-office du restaurateur (commandes en attente, accepter, refuser, terminer)

---

## 🗂️ Structure du projet

```
appRestoweb/
├── index.php
├── mpd.sql                          # Schéma de la base de données
├── insert.sql                       # Données initiales (produits, états, utilisateurs)
│
├── page/
│   ├── connexion.php
│   ├── inscription.php
│   ├── commander.php                # Catalogue des produits + ajout au panier
│   ├── panier.php                   # Récapitulatif + choix sur place / à emporter
│   ├── payer.php                    # Formulaire de paiement + affichage des erreurs
│   ├── confirmation.php             # Validation carte + insertion commande + récap
│   │
│   └── script/
│       ├── connexion_dbh.php
│       ├── connexion_script.php
│       ├── inscription_script.php
│       ├── insertioncommande_script.php
│       ├── suppressionpannier_script.php
│       ├── recuperationUtil_script.php
│       ├── deconnexion_script.php
│       └── navbarre/
│
├── api/
│   ├── commandes_en_attente.php
│   ├── commande_accepter.php
│   ├── commande_refuser.php
│   ├── commande_terminer.php
│   └── json/
│
├── css/
└── image/
```

---

## 🗄️ Base de données

**Nom :** `RoseBlanche2` — MariaDB / MySQL

| Table | Description |
|-------|-------------|
| `Utilisateurs` | Comptes utilisateurs (login, email, mot de passe haché) |
| `Produits` | Catalogue des plats (libellé, prix unitaire HT) |
| `Commandes` | En-tête de commande (date, total TTC, type, état, utilisateur) |
| `LigneCommande` | Détail par produit (quantité, total HT) |
| `Etat` | 8 états possibles d'une commande (initialisée → servie) |

### Produits disponibles

| Produit | Prix HT |
|---------|---------|
| Le Simple Cheese | 9,99 € |
| Le Double Cheese | 11,99 € |
| Le Triple Cheese | 13,99 € |
| Le XXL Triple Monstre | 17,99 € |

### Triggers automatiques

Les **triggers MySQL** sur `LigneCommande` calculent automatiquement :
- le `total_ht` de chaque ligne (`quantité × prix_unitaire_ht`)
- le `total_commande` TTC selon le type :
  - **10 %** de TVA pour une commande sur place
  - **5,5 %** de TVA pour une commande à emporter

---

## 💳 Validation du paiement

Dans `confirmation.php`, les données de carte sont vérifiées côté serveur avant toute insertion :

| Champ | Règle |
|-------|-------|
| Numéro de carte | Exactement 16 chiffres |
| Nom sur la carte | Lettres et espaces uniquement |
| CVV | Exactement 3 chiffres |
| Date d'expiration | Doit être postérieure à aujourd'hui |

En cas d'erreur, les messages sont stockés en session et l'utilisateur est redirigé vers `payer.php` pour corriger. La commande n'est insérée en base qu'une fois tous les champs valides.

---

## 🔄 Flux utilisateur

```
Accueil → Commander → Panier → [Valider ma commande]
    → payer.php (saisie carte + résumé HT)
        → confirmation.php (validation serveur)
            ├── Erreurs → retour payer.php (messages affichés)
            └── OK → insertion BDD → page de confirmation
```

---

## 🔌 API interne

Accessible en GET, retourne du JSON (usage back-office restaurateur) :

| Endpoint | Description |
|----------|-------------|
| `api/commandes_en_attente.php` | Liste les commandes en attente avec détail des produits |
| `api/commande_accepter.php` | Passe une commande à l'état *en préparation* |
| `api/commande_refuser.php` | Passe une commande à l'état *abandonnée* |
| `api/commande_terminer.php` | Passe une commande à l'état *prête* |

---

## ⚙️ Installation

### Pré-requis

- PHP ≥ 8.0
- MySQL / MariaDB
- Serveur web local (XAMPP, WAMP, Laragon…)

### Étapes

1. **Cloner le dépôt** dans le dossier `htdocs` :
   ```bash
   git clone https://github.com/<utilisateur>/appRestoweb.git
   ```

2. **Créer la base de données** :
   ```bash
   mysql -u root -p < mpd.sql
   mysql -u root -p RoseBlanche2 < insert.sql
   ```

3. **Configurer la connexion BDD** dans `page/script/connexion_dbh.php` :
   ```php
   $host     = 'localhost';
   $dbname   = 'RoseBlanche2';
   $username = 'root';
   $password = '';
   ```

4. Accéder à l'application : `http://localhost/appRestoweb/`

### Comptes de test

| Login | Email | Mot de passe |
|-------|-------|-------------|
| Test | test@ql.com | *(voir insert.sql)* |
| testn2 | test@lim.fr | *(voir insert.sql)* |

---

## 🔒 Sécurité

- Mots de passe hachés avec `password_hash()` / `password_verify()`
- Requêtes SQL préparées via PDO (protection contre les injections SQL)
- Sorties HTML échappées avec `htmlspecialchars()`
- Validation des données de paiement côté serveur avant tout accès à la BDD
- Vérification de session avant chaque action sensible

> ⚠️ Pour un déploiement en production : sécuriser les identifiants BDD (variables d'environnement), activer HTTPS et remplacer le formulaire de carte par une passerelle certifiée (Stripe, PayPlug…).

---

## 🛠️ Technologies

- **Back-end :** PHP 8.x, PDO/MySQL
- **Base de données :** MariaDB 10.x
- **Front-end :** HTML5, CSS3 (vanilla)
- **Serveur :** Apache (XAMPP/WAMP)
