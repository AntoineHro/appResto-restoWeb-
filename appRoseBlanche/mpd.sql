-- Création de la base de données
CREATE DATABASE IF NOT EXISTS RoseBlanche;
USE RoseBlanche;
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
  `libEtat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Etat`
--

INSERT INTO `Etat` (`idEtat`, `libEtat`) VALUES
(1, 'Confirmer'),
(2, 'En cours de préparation'),
(3, 'Terminer');

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
(1, 'le_simple_cheese', 9.99),
(2, 'le_double_cheese', 11.99),
(3, 'le_triple_cheese', 13.99),
(4, 'le_xxl_cheese_tripple_monstre', 17.99);

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
-- Dumping data for table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`idUtilisateur`, `login`, `email`, `mdpUtilisateur`) VALUES
(1, 'Test', 'test@ql.com', '$2y$10$zGc.JlVVl9Zkr64FHiGv9O1RcDAi4OxerF2Fhf7ecenHjlUMSPjyS');

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
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Etat`
--
ALTER TABLE `Etat`
  MODIFY `idEtat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Produits`
--
ALTER TABLE `Produits`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
