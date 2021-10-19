-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 16 juil. 2021 à 19:02
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mydbpdo`
--

-- --------------------------------------------------------

--
-- Structure de la table `banques`
--

DROP TABLE IF EXISTS `banques`;
CREATE TABLE IF NOT EXISTS `banques` (
  `id_banque` int(11) NOT NULL AUTO_INCREMENT,
  `nom_banque` varchar(30) NOT NULL,
  PRIMARY KEY (`id_banque`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `banques`
--

INSERT INTO `banques` (`id_banque`, `nom_banque`) VALUES
(1, 'Attijari'),
(2, 'Banque populaire'),
(3, 'BMCE'),
(4, 'CIH');

-- --------------------------------------------------------

--
-- Structure de la table `carte_banquaires`
--

DROP TABLE IF EXISTS `carte_banquaires`;
CREATE TABLE IF NOT EXISTS `carte_banquaires` (
  `id_carte_banquaire` int(11) NOT NULL AUTO_INCREMENT,
  `numero_carte_banquaire` varchar(16) DEFAULT NULL,
  `Nom_prop_carte_banquaire` varchar(30) DEFAULT NULL,
  `id_commande` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_carte_banquaire`),
  KEY `FK_carte_banquaires_commandes_id_commandes` (`id_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carte_banquaires`
--

INSERT INTO `carte_banquaires` (`id_carte_banquaire`, `numero_carte_banquaire`, `Nom_prop_carte_banquaire`, `id_commande`) VALUES
(1, '1245784653232258', 'RIDA.ELBARDAI-ETU', 3),
(2, '25453254', 'RIDA.ELBARDAI-ETU', 4),
(3, '25453254', 'RIDA.ELBARDAI-ETU', 5),
(4, '25453254', 'RIDA.ELBARDAI-ETU', 6),
(5, '25453254', 'RIDA.ELBARDAI-ETU', 7),
(6, '25453254', 'RIDA.ELBARDAI-ETU', 8),
(7, '25453254', 'RIDA.ELBARDAI-ETU', 9);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(30) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Telephones'),
(2, 'Ordinateurs Portables'),
(3, 'Tablettes'),
(4, 'Ordinateurs De Bureau'),
(5, 'Accessoires et gadgets'),
(6, 'Consoles'),
(7, 'Appareil photos'),
(8, 'Televisions'),
(9, 'Images & Son');

-- --------------------------------------------------------

--
-- Structure de la table `cheques`
--

DROP TABLE IF EXISTS `cheques`;
CREATE TABLE IF NOT EXISTS `cheques` (
  `id_cheque` int(11) NOT NULL AUTO_INCREMENT,
  `montant_cheque` float DEFAULT NULL,
  `date_encaissement` varchar(30) NOT NULL,
  `id_commande` int(11) DEFAULT NULL,
  `id_banque` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cheque`),
  KEY `FK_cheques_id_commandes` (`id_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cheques`
--

INSERT INTO `cheques` (`id_cheque`, `montant_cheque`, `date_encaissement`, `id_commande`, `id_banque`) VALUES
(1, 1500, '26-15-2012', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_etat` int(11) NOT NULL,
  `id_livraison` int(11) NOT NULL,
  `date_commande` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type_paiement` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `FK_commandes_etats_id_etat` (`id_etat`),
  KEY `FK_commandes_livraisons_id_livraisons` (`id_livraison`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id_commande`, `id_utilisateur`, `id_etat`, `id_livraison`, `date_commande`, `type_paiement`) VALUES
(1, 2, 2, 4, '2021-07-15 21:21:02', 'chèque'),
(2, 2, 1, 2, '2021-07-15 21:25:26', 'espèce'),
(3, 5, 1, 2, '2021-07-15 21:47:00', 'carte bleu'),
(4, 2, 1, 4, '2021-07-16 10:53:22', 'carte bleu'),
(5, 2, 1, 1, '2021-07-16 10:53:48', 'carte bleu'),
(6, 2, 1, 1, '2021-07-16 10:54:53', 'carte bleu'),
(7, 2, 1, 1, '2021-07-16 10:56:38', 'carte bleu'),
(8, 2, 1, 1, '2021-07-16 10:57:05', 'carte bleu'),
(9, 2, 1, 1, '2021-07-16 11:03:33', 'carte bleu'),
(10, 2, 1, 3, '2021-07-16 11:06:08', 'espèce');

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id_compte` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` char(1) DEFAULT NULL,
  `date_inscrip` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_compte`),
  KEY `utilisateur_dans_compte` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `login`, `password`, `type`, `date_inscrip`, `id_utilisateur`) VALUES
(1, 'admin', 'admin', 'A', '2021-07-15 20:59:22', 2),
(2, 'toto', 'toto', 'C', '2021-07-15 21:11:58', 3),
(4, 'rida', 'rida', 'C', '2021-07-15 21:43:30', 5);

-- --------------------------------------------------------

--
-- Structure de la table `especes`
--

DROP TABLE IF EXISTS `especes`;
CREATE TABLE IF NOT EXISTS `especes` (
  `id_espece` int(11) NOT NULL AUTO_INCREMENT,
  `montant_espece` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  PRIMARY KEY (`id_espece`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `especes`
--

INSERT INTO `especes` (`id_espece`, `montant_espece`, `id_commande`) VALUES
(1, 199, 2),
(2, 156454, 10);

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

DROP TABLE IF EXISTS `etats`;
CREATE TABLE IF NOT EXISTS `etats` (
  `id_etat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etat` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_etat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etats`
--

INSERT INTO `etats` (`id_etat`, `nom_etat`) VALUES
(1, 'paye'),
(2, 'en cours de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` varchar(30) NOT NULL,
  `email_fournisseur` varchar(32) NOT NULL,
  `telephone_fournisseur` int(14) NOT NULL,
  PRIMARY KEY (`id_fournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id_fournisseur`, `nom_fournisseur`, `email_fournisseur`, `telephone_fournisseur`) VALUES
(1, 'toto', 'toto@mail.ma', 56789),
(2, 'momo', 'momo@mail.ma', 12354);

-- --------------------------------------------------------

--
-- Structure de la table `lignes_comandes`
--

DROP TABLE IF EXISTS `lignes_comandes`;
CREATE TABLE IF NOT EXISTS `lignes_comandes` (
  `id_l_cmd` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `id_cmd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_l_cmd`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignes_comandes`
--

INSERT INTO `lignes_comandes` (`id_l_cmd`, `nom`, `prix`, `id_produit`, `qte`, `id_cmd`) VALUES
(1, 'iphone XS MAX', '8000.00', 4, 1, 1),
(2, 'Hp Elitebook', '5000.00', 8, 2, 1),
(3, 'AlienWare', '12000.00', 11, 1, 2),
(4, 'Macbook pro', '25000.00', 13, 1, 2),
(5, 'iphone XS MAX', '8000.00', 4, 1, 3),
(6, 'watch', '1000.00', 9, 2, 3),
(7, 'watch', '1000.00', 9, 1, 4),
(8, 'watch', '1000.00', 9, 2, 5),
(9, 'Hp Elitebook', '5000.00', 8, 1, 6),
(10, 'watch', '1000.00', 9, 1, 6),
(11, 'latitude DELL', '3500.00', 5, 1, 7),
(12, 'Hp Elitebook', '5000.00', 8, 1, 7),
(13, 'iphone XS MAX', '8000.00', 4, 1, 8),
(14, 'Macbook pro', '25000.00', 13, 1, 8),
(15, 'iphone XS MAX', '8000.00', 4, 2, 9),
(16, 'latitude DELL', '3500.00', 5, 1, 9),
(17, 'PlayStation 4', '5000.00', 15, 2, 10);

-- --------------------------------------------------------

--
-- Structure de la table `livraisons`
--

DROP TABLE IF EXISTS `livraisons`;
CREATE TABLE IF NOT EXISTS `livraisons` (
  `id_livraison` int(11) NOT NULL AUTO_INCREMENT,
  `type_livraison` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_livraison`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livraisons`
--

INSERT INTO `livraisons` (`id_livraison`, `type_livraison`) VALUES
(1, 'non choisis'),
(2, 'à domicile'),
(3, 'point de livraison'),
(4, 'passer au magazin');

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

DROP TABLE IF EXISTS `marques`;
CREATE TABLE IF NOT EXISTS `marques` (
  `id_marque` int(11) NOT NULL AUTO_INCREMENT,
  `nom_marque` varchar(30) NOT NULL,
  PRIMARY KEY (`id_marque`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id_marque`, `nom_marque`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Microsoft'),
(4, 'Sony'),
(5, 'Hp'),
(6, 'Dell'),
(7, 'Huawei'),
(8, 'Logitech');

-- --------------------------------------------------------

--
-- Structure de la table `modeles`
--

DROP TABLE IF EXISTS `modeles`;
CREATE TABLE IF NOT EXISTS `modeles` (
  `id_modele` int(11) NOT NULL AUTO_INCREMENT,
  `nom_modele` varchar(30) NOT NULL,
  `id_marque` int(11) NOT NULL,
  PRIMARY KEY (`id_modele`),
  KEY `marque_dans_modele` (`id_marque`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `modeles`
--

INSERT INTO `modeles` (`id_modele`, `nom_modele`, `id_marque`) VALUES
(1, 'iPhone', 1),
(2, 'iPad', 1),
(3, 'Galaxy S10', 2),
(4, 'Tab7', 2),
(5, 'iMac', 1),
(6, 'Macbook', 1),
(7, 'iWatch', 1),
(8, 'iTv', 1),
(9, ' Galaxy Note', 2),
(10, 'Galaxy S20', 2),
(11, 'Air Buds', 2),
(12, 'Samsung TV', 2),
(13, 'Galaxy 5G', 2),
(14, 'SurfacePro', 3),
(15, 'Specter', 3),
(16, 'EliteBook', 5),
(17, 'XBox360', 3),
(18, 'Windows10', 3),
(19, 'PlayStation5', 4),
(20, 'PlayStation4', 4),
(21, 'PlayStation3', 4),
(22, 'Smart TV', 4),
(23, 'speakers-SONY', 4),
(24, 'MX900', 8),
(25, 'Optical Mouse V2	', 8),
(26, 'LX7 Cordless Optical Mouse	', 8),
(27, 'VX Revolution	', 8),
(28, 'Bluetooth Mouse M555b	', 8),
(29, 'Inspiron', 6),
(30, 'Vostro', 6),
(31, 'Alien Ware', 6),
(32, 'Latitude', 6),
(33, 'OptiPlex', 6),
(34, 'Nova', 7),
(35, 'P30', 7),
(36, 'Watch3 pro', 7),
(37, 'MateBook 20', 7),
(38, 'airBuds', 7);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `nom_photo` varchar(128) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_photo`),
  KEY `id_produits_dans_photos` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_photo`, `nom_photo`, `id_produit`) VALUES
(4, 'iphone-12-purple-select-2021.jpg', 4),
(5, 'ld0005743720_1_4.jpg', 4),
(6, 'product-1582154415.jpg', 5),
(7, 'product-1594223626.jpg', 5),
(13, '15891818721_thumb.jpg', 8),
(14, '16129192067102.jpg', 9),
(15, 'apple-watch-series-5-gps.jpg', 9),
(16, 'images (1).jpg', 10),
(17, 'images (2).jpg', 10),
(18, 'images.jpg', 11),
(19, 'laptop-dell-E7440_03-prix-189000fcfa.png', 11),
(20, 'images.jpg', 12),
(21, 'apple-macbook-air-2020-m1-frandroid.png', 13),
(22, 'ld0005527844_2.jpg', 13),
(23, '152137-laptops-review-apple-macbook-pro-2020-review-image1-pbzm4ejvvs.jpg', 14),
(24, 'manette-ps4-dualshock-4-0-v2-jet-black-playstati.jpg', 15),
(25, 'sony-ps4-pro-1to.jpg', 15),
(26, 'sony-ps4-slim-.jpg', 15),
(27, 'ld0005527844_2.jpg', 16),
(28, 'apple-watch-series-5-gps.jpg', 17),
(29, 'ld0005743720_1_4.jpg', 18);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(30) NOT NULL,
  `description_produit` text NOT NULL,
  `prix_produit` decimal(10,2) NOT NULL,
  `taux_promotion_produit` int(3) NOT NULL DEFAULT '0',
  `quantite_produit` int(4) NOT NULL DEFAULT '0',
  `id_modele` int(11) NOT NULL,
  `id_fournisseur` int(11) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `modele_dans_produits` (`id_modele`),
  KEY `fournisseur_dans_produits` (`id_fournisseur`),
  KEY `categorie_dans_produits` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `taux_promotion_produit`, `quantite_produit`, `id_modele`, `id_fournisseur`, `id_categorie`) VALUES
(4, 'iphone XS MAX', 'L\'iPhone 12 Pro Max est le modèle grand-format haut de gamme de la 14e génération de smartphone d\'Apple annoncé le 13 octobre 2020. Il est équipé d\'un écran de 6,7 pouces OLED HDR 60 Hz, d\'un triple capteur photo avec ultra grand-angle et téléobjectif (x5 optique) et d\'un SoC Apple A14 Bionic compatible 5G (sub-6 GHz).', '8000.00', 20, 5, 1, NULL, 1),
(5, 'latitude DELL', 'PC portable\r\n8 RAM\r\n1000Go\r\nGris', '3500.00', 0, 22, 32, NULL, 2),
(6, 'macBook', 'grisi716 RAM1To', '25900.00', 9, 9, 6, NULL, 2),
(8, 'Hp Elitebook', '1000Go\r\nSSD\r\nNvidea', '5000.00', 0, 0, 16, NULL, 2),
(9, 'watch', 'watch', '1000.00', 0, 0, 36, NULL, 5),
(10, 'OptiPlex', 'Xeon', '7999.99', 0, 0, 33, NULL, 4),
(11, 'AlienWare', 'toto', '12000.00', 0, 6, 31, NULL, 2),
(12, 'pc', '8 RAM\r\n1024Go', '3500.00', 0, 0, 24, NULL, 4),
(13, 'Macbook pro', 'i7gris16Go', '25000.00', 0, 1, 6, NULL, 2),
(14, 'PC', '161014\r\ndfd\r\ndfqd', '6000.00', 0, 0, 32, NULL, 2),
(15, 'PlayStation 4', 'Noir\r\nPlaystation', '5000.00', 0, 10, 20, NULL, 6),
(16, 'PC', 'qsdfsfsfdq', '9000.00', 0, 0, 15, NULL, 2),
(17, 'iWatch', 'montre', '2000.00', 0, 0, 7, NULL, 5),
(18, 'iphone 12 pro max', '256Go', '13000.00', 0, 0, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(30) DEFAULT NULL,
  `prenom_utilisateur` varchar(30) DEFAULT NULL,
  `email_utilisateur` varchar(30) DEFAULT NULL,
  `adresse_utilisateur` varchar(64) DEFAULT NULL,
  `numero_utilisateur` varchar(14) DEFAULT NULL,
  `sexe_utilisateur` char(1) DEFAULT NULL,
  `date_naissance` date NOT NULL DEFAULT '1970-01-01',
  `photo_utilisateur` varchar(128) DEFAULT NULL,
  `etat` int(1) NOT NULL DEFAULT '0',
  `id_compte` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `FK_utilisateurs_comptes_id_compte` (`id_compte`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `email_utilisateur`, `adresse_utilisateur`, `numero_utilisateur`, `sexe_utilisateur`, `date_naissance`, `photo_utilisateur`, `etat`, `id_compte`) VALUES
(2, 'admin', 'admin', 'rb.99@hotmail.fr', 'administrataion', '0123456789', 'm', '1970-01-15', '3.jpg', 1, 1),
(3, 'toto', 'toto', 'toto@toto.ma', 'mohammedia', '122222222', 'm', '2020-02-12', '4.jpg', 1, 2),
(5, 'El Bardai', 'Rida', 'rida_elbardai@um5.ac.ma', 'LOT SAID HAJJI N 1640, ROUTE DE KENITRA', '0642294502', 'M', '2002-06-12', 'id-photo2.jpg', 1, 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `carte_banquaires`
--
ALTER TABLE `carte_banquaires`
  ADD CONSTRAINT `FK_carte_banquaires_commandes_id_commandes` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`);

--
-- Contraintes pour la table `cheques`
--
ALTER TABLE `cheques`
  ADD CONSTRAINT `FK_cheques_id_commandes` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commande`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_commandes_etats_id_etat` FOREIGN KEY (`id_etat`) REFERENCES `etats` (`id_etat`),
  ADD CONSTRAINT `FK_commandes_livraisons_id_livraisons` FOREIGN KEY (`id_livraison`) REFERENCES `livraisons` (`id_livraison`);

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `utilisateur_dans_compte` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `modeles`
--
ALTER TABLE `modeles`
  ADD CONSTRAINT `marque_dans_modele` FOREIGN KEY (`id_marque`) REFERENCES `marques` (`id_marque`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `id_produits_dans_photos` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `categorie_dans_produits` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `fournisseur_dans_produits` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseurs` (`id_fournisseur`),
  ADD CONSTRAINT `modele_dans_produits` FOREIGN KEY (`id_modele`) REFERENCES `modeles` (`id_modele`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `FK_utilisateurs_comptes_id_compte` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`id_compte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
