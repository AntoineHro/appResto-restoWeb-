-- Création de la base de données
CREATE DATABASE IF NOT EXISTS RoseBlanche;
USE RoseBlanche;

-- Table des utilisateurs
CREATE TABLE Utilisateurs (
   idUtilisateur INT PRIMARY KEY not null AUTO_INCREMENT,
   login VARCHAR(50) NOT NULL,
   email VARCHAR(100) NOT NULL,
   mdpUtilisateur VARCHAR(300)
);

-- Table des produits
CREATE TABLE Produits (
   idProduit INT PRIMARY KEY not null AUTO_INCREMENT,
   libProduit VARCHAR(50),
   prix_unitaire_ht DECIMAL(10,2)
);

-- Table des états de commande
CREATE TABLE Etat (
   idEtat int PRIMARY KEY not null AUTO_INCREMENT,
   libEtat VARCHAR(50)
);

-- Table des commandes
CREATE TABLE Commandes (
   idCommande INT PRIMARY KEY not null AUTO_INCREMENT,
   date_commande DATETIME,
   total_commande DECIMAL(10,2),
   est_sur_place BOOLEAN,
   idEtat int NOT NULL,
   idUtilisateur INT NOT NULL,
   FOREIGN KEY (idEtat) REFERENCES Etat(idEtat),
   FOREIGN KEY (idUtilisateur) REFERENCES Utilisateurs(idUtilisateur)
);

-- Table des lignes de commande 
CREATE TABLE LigneCommande (
   idCommande INT,
   idProduit INT,
   quantite INT,
   total_ht DECIMAL(8,2),
   PRIMARY KEY (idCommande, idProduit),
   FOREIGN KEY (idCommande) REFERENCES Commandes(idCommande),
   FOREIGN KEY (idProduit) REFERENCES Produits(idProduit)
);

