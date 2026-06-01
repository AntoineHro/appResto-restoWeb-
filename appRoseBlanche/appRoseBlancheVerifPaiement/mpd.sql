-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2025 at 09:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS RoseBlanchePaiement;
USE RoseBlanchePaiement;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RoseBlanche`
--

-- --------------------------------------------------------

--
-- Table structure for table `Commandes`
--

CREATE TABLE `Commandes` (
  `idCommande` int(11) NOT NULL,
  `date_commande` datetime DEFAULT NULL,
  `total_commande` decimal(10,2) DEFAULT NULL,
  `est_sur_place` tinyint(1) DEFAULT NULL,
  `idEtat` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Etat`
--

CREATE TABLE `Etat` (
  `idEtat` int(11) NOT NULL,
  `libEtat` varchar(50) DEFAULT NULL,
  `descriptif` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Etat`
--

INSERT INTO `Etat` (`idEtat`, `libEtat`, `descriptif`) VALUES
(1, 'initialisée', 'le client est en train de choisir sa commande'),
(2, 'finalisée', 'le choix de la commande est terminé et validé'),
(3, 'calculée', 'le total de la commande est calculé et en attente de paiement'),
(4, 'en attente', 'la commande est payée et en attente de préparation par le restaurateur'),
(5, 'abandonnée', 'la commande est refusée par le restaurateur'),
(6, 'en préparation', 'la commande est acceptée et en cours de préparation par le restaurateur'),
(7, 'prête', 'la commande est prête et en attente d être récupérée par le client'),
(8, 'servie', 'la commande a été récupérée par le client');

-- --------------------------------------------------------

--
-- Table structure for table `LigneCommande`
--

CREATE TABLE `LigneCommande` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `total_ht` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `LigneCommande`
--
DELIMITER $$
CREATE TRIGGER `after_insert_lignecommande` AFTER INSERT ON `LigneCommande` FOR EACH ROW BEGIN
    DECLARE v_total_ht DECIMAL(10, 2);
    DECLARE v_est_sur_place BOOLEAN;
    DECLARE v_tva DECIMAL(5, 3);
    
    SELECT SUM(total_ht) INTO v_total_ht FROM lignecommande
    WHERE idCommande = NEW.idCommande;
    
    SELECT est_sur_place INTO v_est_sur_place FROM commandes
    WHERE idCommande = NEW.idCommande;

    IF v_est_sur_place = 1 THEN
        SET v_tva = 1.1;
    ELSE
        SET v_tva = 1.055;
    END IF;

    UPDATE commandes
    SET total_commande = v_total_ht * v_tva
    WHERE idCommande = NEW.idCommande;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_lignecommande` AFTER UPDATE ON `LigneCommande` FOR EACH ROW BEGIN
    DECLARE v_total_ht DECIMAL(10, 2);
    DECLARE v_est_sur_place BOOLEAN;
    DECLARE v_tva DECIMAL(5, 3);
    
    SELECT SUM(total_ht) INTO v_total_ht FROM lignecommande
    WHERE idCommande = NEW.idCommande;
    
    SELECT est_sur_place INTO v_est_sur_place FROM commandes
    WHERE idCommande = NEW.idCommande;

    IF v_est_sur_place = 1 THEN
        SET v_tva = 1.1;
    ELSE
        SET v_tva = 1.055;
    END IF;

    UPDATE commandes
    SET total_commande = v_total_ht * v_tva
    WHERE idCommande = NEW.idCommande;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_lignecommande` BEFORE INSERT ON `LigneCommande` FOR EACH ROW BEGIN
    DECLARE v_prix_ht DECIMAL(10,2);
    
    SELECT prix_unitaire_ht INTO v_prix_ht
    FROM produits 
    WHERE idProduit = NEW.idProduit;
    
    SET NEW.total_ht = NEW.quantite * v_prix_ht;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_lignecommande` BEFORE UPDATE ON `LigneCommande` FOR EACH ROW BEGIN
    DECLARE v_prix_ht DECIMAL(10,2);
    
    SELECT prix_unitaire_ht INTO v_prix_ht
    FROM produits 
    WHERE idProduit = NEW.idProduit;
    
    SET NEW.total_ht = NEW.quantite * v_prix_ht;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Produits`
--

CREATE TABLE `Produits` (
  `idProduit` int(11) NOT NULL,
  `libProduit` varchar(50) DEFAULT NULL,
  `prix_unitaire_ht` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Produits`
--

INSERT INTO `Produits` (`idProduit`, `libProduit`, `prix_unitaire_ht`) VALUES
(1, 'le simple cheese', 9.99),
(2, 'le double cheese', 11.99),
(3, 'le triple cheese', 13.99),
(4, 'le XXL triple monstre', 17.99);

-- --------------------------------------------------------

--
-- Table structure for table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdpUtilisateur` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Commandes`
--
ALTER TABLE `Commandes`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `idEtat` (`idEtat`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `Etat`
--
ALTER TABLE `Etat`
  ADD PRIMARY KEY (`idEtat`);

--
-- Indexes for table `LigneCommande`
--
ALTER TABLE `LigneCommande`
  ADD PRIMARY KEY (`idCommande`,`idProduit`),
  ADD KEY `idProduit` (`idProduit`);

--
-- Indexes for table `Produits`
--
ALTER TABLE `Produits`
  ADD PRIMARY KEY (`idProduit`);

--
-- Indexes for table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Commandes`
--
ALTER TABLE `Commandes`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `Etat`
--
ALTER TABLE `Etat`
  MODIFY `idEtat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Produits`
--
ALTER TABLE `Produits`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Commandes`
--
ALTER TABLE `Commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`idEtat`) REFERENCES `Etat` (`idEtat`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateurs` (`idUtilisateur`);

--
-- Constraints for table `LigneCommande`
--
ALTER TABLE `LigneCommande`
  ADD CONSTRAINT `lignecommande_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `Commandes` (`idCommande`),
  ADD CONSTRAINT `lignecommande_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `Produits` (`idProduit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
