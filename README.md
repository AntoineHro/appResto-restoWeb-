# appRestoweb — Application de commande en ligne

Application web PHP de commande de repas pour le restaurant **Wallouz**, avec système d'authentification, panier, gestion des commandes et **logging des événements** (connexions / inscriptions) sur disque.

---

## 📋 Fonctionnalités

- **Inscription / Connexion** des utilisateurs avec hachage du mot de passe (`password_hash`)
- **Panier** : ajout de produits, suppression, calcul du total HT
- **Commande** : choix entre *sur place* (TVA 10 %) ou *à emporter* (TVA 5,5 %), avec calcul automatique via triggers MySQL
- **Paiement & confirmation** après validation du panier
- **API REST interne** (`/api/`) pour récupérer les commandes en attente au format JSON (usage back-office)
- **Logging sur disque** de toutes les tentatives de connexion et d'inscription (fichiers `log.txt`)

---

## 🗂️ Structure du projet

```
appRestoweb/
├── index.php                        # Page d'accueil
├── mpd.sql                          # Schéma de la base de données
├── insert.sql                       # Données initiales (produits, états…)
│
├── page/
│   ├── connexion.php                # Formulaire de connexion
│   ├── inscription.php              # Formulaire d'inscription
│   ├── panier.php                   # Affichage du panier
│   ├── commander.php                # Page de commande
│   ├── payer.php                    # Page de paiement
│   ├── confirmation.php             # Page de confirmation
│   ├── functionLOG.php              # Fonctions de logging sur disque
│   │
│   ├── filesIN/log.txt              # Logs d'inscription
│   ├── filesCO/log.txt              # Logs de connexion
│   │
│   └── script/
│       ├── connexion_dbh.php        # Connexion PDO à la BDD
│       ├── connexion_script.php     # Traitement POST connexion
│       ├── inscription_script.php   # Traitement POST inscription
│       ├── insertioncommande_script.php
│       ├── suppressionpannier_script.php
│       ├── recuperationUtil_script.php
│       ├── deconnexion_script.php
│       └── navbarre/                # Barres de navigation (connecté/déconnecté)
│
├── api/
│   ├── commandes_en_attente.php     # GET → JSON des commandes en attente
│   ├── commande_accepter.php
│   ├── commande_refuser.php
│   ├── commande_terminer.php
│   └── json/                        # Exemples de réponses JSON
│
├── css/                             # Feuilles de style par page
└── image/                           # Assets graphiques
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
| `Etat` | États possibles d'une commande (ex : en attente, acceptée…) |

### Triggers automatiques

Les **triggers MySQL** sur `LigneCommande` calculent automatiquement :
- le `total_ht` de chaque ligne (`quantité × prix_unitaire_ht`)
- le `total_commande` TTC de la commande en appliquant la TVA correspondante :
  - **10 %** pour une commande sur place
  - **5,5 %** pour une commande à emporter

---

## ⚙️ Installation

### Pré-requis

- PHP ≥ 8.0
- MySQL / MariaDB
- Serveur web local (XAMPP, WAMP, Laragon…)

### Étapes

1. **Cloner le dépôt** dans le dossier `htdocs` (ou équivalent) :
   ```bash
   git clone https://github.com/<utilisateur>/appRestoweb.git
   ```

2. **Créer la base de données** via phpMyAdmin ou en ligne de commande :
   ```bash
   mysql -u root -p < mpd.sql
   mysql -u root -p RoseBlanche2 < insert.sql
   ```

3. **Configurer la connexion BDD** dans `page/script/connexion_dbh.php` :
   ```php
   $host     = 'localhost';
   $dbname   = 'RoseBlanche2';
   $username = 'root';
   $password = '';   // adapter selon votre config
   ```

4. **Vérifier les permissions** sur les dossiers de logs :
   ```bash
   chmod 775 page/filesIN page/filesCO
   ```

5. Accéder à l'application : `http://localhost/appRestoweb/`

---

## 📝 Système de logging

Le fichier `page/functionLOG.php` enregistre dans deux fichiers texte :

| Fichier | Contenu |
|---------|---------|
| `page/filesCO/log.txt` | Connexions réussies et tentatives échouées |
| `page/filesIN/log.txt` | Inscriptions réussies et tentatives échouées |

**Format d'une entrée :**
```
login | *** | 2026-05-28 16:06:36.951679 | 127.0.0.1 | connexion | OK | connexion réussie |
```

Champs : `login | password masqué | horodatage | IP | opération | résultat | message`

> **Note :** Le mot de passe n'est **jamais** écrit en clair dans les logs (remplacé par `...`).

---

## 🔌 API interne

Accessible en GET, retourne du JSON (usage tableau de bord / back-office) :

| Endpoint | Description |
|----------|-------------|
| `api/commandes_en_attente.php` | Liste les commandes en attente avec détail des produits |
| `api/commande_accepter.php` | Passe une commande à l'état *acceptée* |
| `api/commande_refuser.php` | Passe une commande à l'état *refusée* |
| `api/commande_terminer.php` | Passe une commande à l'état *terminée* |

Exemple de réponse (`commandes_en_attente.php`) :
```json
[
  {
    "ID_cmd": 42,
    "Login": "Test",
    "Date": "2026-05-28 16:00:00",
    "Etat": "En attente",
    "NB_plats": 2,
    "Montant": "18.70",
    "Produits": [
      { "Plat": "Burger", "Quantite": 1 },
      { "Plat": "Frites", "Quantite": 1 }
    ]
  }
]
```

---

## 🔒 Sécurité

- Mots de passe hachés avec `password_hash()` / vérifiés avec `password_verify()`
- Requêtes SQL préparées via PDO (protection contre les injections SQL)
- Sorties HTML échappées avec `htmlspecialchars()`
- Logs : le mot de passe n'est jamais stocké en clair

> ⚠️ Pour un déploiement en production, penser à sécuriser les identifiants BDD (variables d'environnement), restreindre l'accès aux dossiers `filesIN` / `filesCO` et activer HTTPS.

---

## 🛠️ Technologies

- **Back-end :** PHP 8.x, PDO/MySQL
- **Base de données :** MariaDB 10.x
- **Front-end :** HTML5, CSS3 (vanilla)
- **Serveur :** Apache (XAMPP/WAMP)

---
