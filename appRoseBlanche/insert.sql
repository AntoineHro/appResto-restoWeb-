--
-- Dumping data for table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`idUtilisateur`, `login`, `email`, `mdpUtilisateur`) VALUES
(1, 'Test', 'test@ql.com', '$2y$10$zGc.JlVVl9Zkr64FHiGv9O1RcDAi4OxerF2Fhf7ecenHjlUMSPjyS'),
(2, 'testn2', 'test@lim.fr', '$2y$10$HLCONRPyo/X5yYUlqZ6Ey.ylTucESMg0IV.4E3X4bc5oaObAmb8s6');

--
-- Dumping data for table `LigneCommande`
--

INSERT INTO `LigneCommande` (`idCommande`, `idProduit`, `quantite`, `total_ht`) VALUES
(61, 3, 2, 27.98);

--
-- Dumping data for table `Commandes`
--

INSERT INTO `Commandes` (`idCommande`, `date_commande`, `total_commande`, `est_sur_place`, `idEtat`, `idUtilisateur`) VALUES
(61, '2025-10-20 13:55:40', 30.78, 1, 4, 1);
