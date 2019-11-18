-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 nov. 2019 à 21:42
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
-- Base de données :  `bde`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_article` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `prix` decimal(12,2) NOT NULL,
  `id_Categorie` int(11) NOT NULL,
  `url` varchar(150) COLLATE utf8_bin NOT NULL,
  `id_centre` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Article_Categorie_FK` (`id_Categorie`),
  KEY `id_centre` (`id_centre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom_article`, `description`, `prix`, `id_Categorie`, `url`, `id_centre`, `deleted`) VALUES
(1, 'Cape obvijevan', 'Cet objet polymorphe établit une relation de prédateur ou de symbiote avec les capes inanimées. (Vous devez nourrir cette cape vivante en lui donnant à manger d\'autres capes. Vous pouvez lui donner un nouveau repas toutes les douze heures.)', '4000.00', 1, 'assets/img/products/capeobji.png', 1, 0),
(2, 'Chapeau obvijevan', 'Cet objet polymorphe établit une relation de prédateur ou de symbiote avec les couvres-chef inanimés. (Vous devez nourrir ce chapeau vivant en lui donnant à manger d\'autres chapeaux. Vous pouvez lui donner un nouveau repas toutes les douze heures.)', '6000.00', 1, 'assets/img/products/chapeauobji.png', 1, 0),
(3, 'Eau de Cristaline', 'Pack de 6x1.5L d\'eau de Cristaline', '2.00', 2, 'assets/img/products/cristaline.jpg', 1, 0),
(4, 'Canette Ice Tea', 'Canette d\'Ice Tea de 33cl', '0.69', 2, 'assets/img/products/ice_tea.jpg', 1, 0),
(5, 'Twix', 'Un biscuit choco-caramel !', '0.40', 3, 'assets/img/products/twix.jpg', 1, 0),
(6, 'Kinder Bueno White', 'Kid Gut Blanco', '0.70', 3, 'assets/img/products/kinder_bueno_white.jpg', 1, 0),
(7, 'Pantalon chino', 'L\'incontournable chino décliné en version \'fitted\' dans un beau twill de coton stretch ultra confortable. À porter roulotté pour un petit look smart au top ! Le futal des vainqueurs !', '20.99', 4, 'assets/img/products/chino.jpg', 1, 0),
(8, 'Manteau femme', 'Une doudoune au motif ultra-tendance !', '40.00', 4, 'assets/img/products/manteau_femme.jpg', 1, 0),
(9, 'English for dummies', 'English grammar for dummies !', '10.00', 5, 'assets/img/products/english_for_dummies.jpg', 1, 0),
(10, 'Sticker Logo BDE', 'Sticker du logo du BDE du Cesi Reims', '1.00', 5, 'assets/img/products/Logo CESI rouge.png', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `article_commande`
--

DROP TABLE IF EXISTS `article_commande`;
CREATE TABLE IF NOT EXISTS `article_commande` (
  `id` int(11) NOT NULL,
  `id_Commande` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_Commande`),
  KEY `article_commande_Commande0_FK` (`id_Commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `article_commande`
--

INSERT INTO `article_commande` (`id`, `id_Commande`, `qte`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 3, 2),
(3, 12, 1),
(4, 2, 6),
(4, 6, 2),
(4, 9, 2),
(5, 2, 4),
(5, 5, 3),
(5, 10, 3),
(6, 2, 1),
(6, 3, 1),
(6, 7, 2),
(7, 3, 2),
(8, 3, 1),
(9, 3, 1),
(9, 8, 1),
(10, 2, 2),
(10, 4, 3),
(10, 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Obvijevan'),
(2, 'Boisson'),
(3, 'Snack'),
(4, 'Vêtement'),
(5, 'Fournitures');

-- --------------------------------------------------------

--
-- Structure de la table `centre`
--

DROP TABLE IF EXISTS `centre`;
CREATE TABLE IF NOT EXISTS `centre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `centre`
--

INSERT INTO `centre` (`id`, `nom`) VALUES
(1, 'Reims'),
(2, 'Nanterre'),
(3, 'Strasbourg'),
(4, 'Nancy'),
(5, 'Arras'),
(6, 'Oran');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `id_User` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Commande_User_FK` (`id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `date`, `etat`, `id_User`) VALUES
(1, '2019-11-15', 1, 6),
(2, '2019-11-16', 1, 1),
(3, '2019-11-16', 1, 1),
(4, '2019-11-17', 1, 1),
(5, '2019-11-17', 0, 1),
(6, '2019-11-17', 1, 1),
(7, '2019-11-17', 0, 1),
(8, '2019-11-17', 0, 1),
(9, '2019-11-18', 0, 1),
(10, '2019-11-18', 0, 1),
(11, '2019-11-18', 0, 1),
(12, '2019-11-18', 0, 1),
(13, '2019-11-18', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` longtext COLLATE utf8_bin NOT NULL,
  `signale` tinyint(1) NOT NULL DEFAULT '0',
  `id_Photo` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Commentaire_Photo_FK` (`id_Photo`),
  KEY `Commentaire_User0_FK` (`id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `commentaire`, `signale`, `id_Photo`, `id_User`, `deleted`) VALUES
(1, 'OUCH', 0, 2, 1, 0),
(2, 'Ça a dû faire mal !', 0, 2, 6, 0),
(3, 'Bois une guérison', 0, 2, 5, 0),
(4, 'Bon rétablissement', 0, 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payant` tinyint(1) NOT NULL,
  `prix` float NOT NULL,
  `nom` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `logo` varchar(50) COLLATE utf8_bin NOT NULL,
  `recurrent` int(11) NOT NULL DEFAULT '0',
  `signale` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `id_centre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Event_Centre_FK` (`id_centre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `payant`, `prix`, `nom`, `description`, `date`, `logo`, `recurrent`, `signale`, `deleted`, `id_centre`) VALUES
(1, 0, 0, 'Tournoi de Badminton', 'Le BDE organise un Tournoi de Badminton le jeudi 14 Novembre au Gymnase Paul Fort. \r\n- 18h à 20h\r\n- Equipe de 2 personnes faites sur place !\r\n- Places limitées', '2019-11-14', 'assets/img/events/tournoi bad.png', 0, 0, 0, 1),
(2, 0, 0, 'Tournoi Futsal', 'Un tournoi de futsal au gymnase du collège Paul Fort\r\n- Le jeudi 28 novembre de 18h à 20h', '2019-11-28', 'assets/img/events/tournoi fut.jpg', 0, 0, 0, 1),
(3, 1, 20, 'Lancer de Hache', 'Le BDE organise une soirée lancer de hache !', '2019-11-21', 'assets/img/events/tournoi hache.png', 0, 0, 0, 1),
(4, 1, 1, 'Soirée jeux vidéo', 'Ramenez vos jeux de société, consoles, ... Et n\'oubliez surtout pas d\'installer vos jeux et de faire vos mises à jour ! \r\nSi vous prenez vos consoles, prévenez nous à l\'inscription.', '2019-11-15', 'assets/img/events/Soiree_jeux.png', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `event_user`
--

DROP TABLE IF EXISTS `event_user`;
CREATE TABLE IF NOT EXISTS `event_user` (
  `id` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_User`),
  KEY `event_user_User0_FK` (`id_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `event_user`
--

INSERT INTO `event_user` (`id`, `id_User`) VALUES
(4, 1),
(1, 2),
(2, 2),
(1, 3),
(3, 3),
(1, 4),
(2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) COLLATE utf8_bin NOT NULL,
  `signale` tinyint(1) NOT NULL DEFAULT '0',
  `id_Event` int(11) NOT NULL,
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Photo_Event_FK` (`id_Event`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `url`, `signale`, `id_Event`, `deleted`) VALUES
(1, 'assets/img/events/epaule1.png', 0, 1, 0),
(2, 'assets/img/events/epaule2.png', 0, 1, 0),
(3, 'assets/img/events/DSC_1348.jpg', 0, 4, 0),
(4, 'assets/img/events/DSC_1349.jpg', 0, 4, 0),
(5, 'assets/img/events/DSC_1352.jpg', 0, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `droit` int(11) NOT NULL DEFAULT '0',
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` tinytext COLLATE utf8_bin NOT NULL,
  `id_Centre` int(11) NOT NULL,
  `token` tinytext COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `User_Centre_FK` (`id_Centre`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `droit`, `email`, `password`, `id_Centre`, `token`) VALUES
(1, 'Pihet', 'Jérôme', 2, 'jerome.pihet@viacesi.fr', '$2y$10$o9qAhcSCPNnWlW7RAyErsOSRqnOFT46eOTQJBKarvJeoLR4M3G5ii', 1, NULL),
(2, 'Benazouzi', 'Sofiane', 2, 'sofiane.benazouzi@viacesi.fr', '$2y$10$.B0cOalHTNnLbJqUUDDov.68Fz6dFdaWVf1FpLZMUsB6apRzeHTFG', 1, ''),
(3, 'Etchart', 'Florian', 2, 'florian.etchart@viacesi.fr', '$2y$10$U37A3fQAoLc2dUz/twF4zOE5UmsMe/m9yRoQxS/0uD2wNnm/6ewxe', 1, ''),
(4, 'Basset', 'Adrien', 2, 'adrien.basset@viacesi.fr', '$2y$10$cb5GtKb38SIiJIkBPfFHTeIDbfX9vgiLGCSl7l2PMyhOlbrK3AY3G', 1, ''),
(5, 'Bourg Palette', 'Sacha', 1, 'pokemon@viacesi.fr', '$2y$10$MlZTulvAp8TkbvDBNQeBHOx.Lw7oDJTU1heTEogIy0h2lIoZo2c0O', 1, ''),
(6, 'Chris', 'de Naire', 0, 'bonta@viacesi.fr', '$2y$10$PgSV.tit9plPUPFGHCXE.uzda6lnJw9jbejOqfRETN.4QRUz.jxDe', 1, ''),
(7, 'Musk', 'Elon', 2, 'elon.musk@viacesi.fr', '$2y$10$ipi2Nvv0NsSkt10RUJyGm.BaXTlP9aqVquEhmsv1ppwpanuwLTSG.', 5, ''),
(8, 'Dupont', 'Jean', 1, 'jean.dupont@viacesi.fr', '$2y$10$YsvU.qTElqfrtXKTYoD/tO9PQAGsskreozSAVqu7OTeY/7Z60Zw.K', 5, ''),
(9, 'Diels', 'George', 0, 'george.diels@viacesi.fr', '$2y$10$GqlTzMWTcpbGQIBsXUZArObVw9AmwXVL7WHuvziFke1osBk7/N7AS', 5, '');

-- --------------------------------------------------------

--
-- Structure de la table `user_article`
--

DROP TABLE IF EXISTS `user_article`;
CREATE TABLE IF NOT EXISTS `user_article` (
  `id` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_User`),
  KEY `user_article_User0_FK` (`id_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user_article`
--

INSERT INTO `user_article` (`id`, `id_User`, `qte`) VALUES
(1, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_photo`
--

DROP TABLE IF EXISTS `user_photo`;
CREATE TABLE IF NOT EXISTS `user_photo` (
  `id` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_User`),
  KEY `user_photo_User0_FK` (`id_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user_photo`
--

INSERT INTO `user_photo` (`id`, `id_User`) VALUES
(2, 1),
(1, 6),
(2, 6);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `Article_Categorie_FK` FOREIGN KEY (`id_Categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `id_centre` FOREIGN KEY (`id_centre`) REFERENCES `centre` (`id`);

--
-- Contraintes pour la table `article_commande`
--
ALTER TABLE `article_commande`
  ADD CONSTRAINT `article_commande_Article_FK` FOREIGN KEY (`id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `article_commande_Commande0_FK` FOREIGN KEY (`id_Commande`) REFERENCES `commande` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `Commande_User_FK` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `Commentaire_Photo_FK` FOREIGN KEY (`id_Photo`) REFERENCES `photo` (`id`),
  ADD CONSTRAINT `Commentaire_User0_FK` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `Event_Centre_FK` FOREIGN KEY (`id_centre`) REFERENCES `centre` (`id`);

--
-- Contraintes pour la table `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_Event_FK` FOREIGN KEY (`id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `event_user_User0_FK` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `Photo_Event_FK` FOREIGN KEY (`id_Event`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `User_Centre_FK` FOREIGN KEY (`id_Centre`) REFERENCES `centre` (`id`);

--
-- Contraintes pour la table `user_article`
--
ALTER TABLE `user_article`
  ADD CONSTRAINT `user_article_Article_FK` FOREIGN KEY (`id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `user_article_User0_FK` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_photo`
--
ALTER TABLE `user_photo`
  ADD CONSTRAINT `user_photo_Photo_FK` FOREIGN KEY (`id`) REFERENCES `photo` (`id`),
  ADD CONSTRAINT `user_photo_User0_FK` FOREIGN KEY (`id_User`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
