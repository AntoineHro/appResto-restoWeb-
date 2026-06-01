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

--
-- Dumping data for table `Produits`
--

INSERT INTO `Produits` (`idProduit`, `libProduit`, `prix_unitaire_ht`) VALUES
(1, 'le simple cheese', 9.99),
(2, 'le double cheese', 11.99),
(3, 'le triple cheese', 13.99),
(4, 'le XXL triple monstre', 17.99);

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
