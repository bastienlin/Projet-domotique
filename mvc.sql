-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 20 juin 2019 à 15:51
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `actionneur`
--

DROP TABLE IF EXISTS `actionneur`;
CREATE TABLE IF NOT EXISTS `actionneur` (
  `idActionneur` int(11) NOT NULL AUTO_INCREMENT,
  `etat` int(1) NOT NULL DEFAULT '0',
  `id_capteur` int(45) NOT NULL,
  `seuil` int(11) DEFAULT NULL,
  `heure` date DEFAULT NULL,
  `type_action` int(11) DEFAULT NULL,
  PRIMARY KEY (`idActionneur`),
  UNIQUE KEY `idActionneur_UNIQUE` (`idActionneur`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actionneur`
--

INSERT INTO `actionneur` (`idActionneur`, `etat`, `id_capteur`, `seuil`, `heure`, `type_action`) VALUES
(17, 0, 16, NULL, NULL, NULL),
(3, 1, 2, NULL, NULL, NULL),
(12, 0, 1, 20, NULL, NULL),
(5, 1, 4, NULL, NULL, NULL),
(6, 1, 5, NULL, NULL, NULL),
(15, 0, 14, NULL, NULL, NULL),
(14, 0, 15, NULL, NULL, NULL),
(16, 1, 9, NULL, NULL, NULL),
(19, 1, 20, NULL, NULL, NULL),
(22, 1, 23, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

DROP TABLE IF EXISTS `capteur`;
CREATE TABLE IF NOT EXISTS `capteur` (
  `id_capteur` int(11) NOT NULL AUTO_INCREMENT,
  `capteur_type` varchar(45) NOT NULL,
  `idPieces` int(20) NOT NULL,
  PRIMARY KEY (`id_capteur`),
  UNIQUE KEY `id_capteur` (`id_capteur`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `capteur`
--

INSERT INTO `capteur` (`id_capteur`, `capteur_type`, `idPieces`) VALUES
(9, 'lumiere', 3),
(16, 'securite', 3),
(23, 'lumiere', 1),
(1, 'temperature', 1),
(20, 'securite', 1);

-- --------------------------------------------------------

--
-- Structure de la table `donnees_capteur`
--

DROP TABLE IF EXISTS `donnees_capteur`;
CREATE TABLE IF NOT EXISTS `donnees_capteur` (
  `idDonnees_capteur` int(30) NOT NULL AUTO_INCREMENT,
  `valeur` int(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_capteur` varchar(45) NOT NULL,
  PRIMARY KEY (`idDonnees_capteur`),
  UNIQUE KEY `idDonnées_capteur_UNIQUE` (`idDonnees_capteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `laboratoire`
--

DROP TABLE IF EXISTS `laboratoire`;
CREATE TABLE IF NOT EXISTS `laboratoire` (
  `idLaboratoire` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idLaboratoire`),
  UNIQUE KEY `idLaboratoire_UNIQUE` (`idLaboratoire`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `laboratoire`
--

INSERT INTO `laboratoire` (`idLaboratoire`, `nom`) VALUES
(1, 'Labo 1'),
(0, 'Domisep'),
(2, 'Labo 2');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idMessages` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(45) DEFAULT NULL,
  `type_de_message` date DEFAULT NULL,
  PRIMARY KEY (`idMessages`),
  UNIQUE KEY `idMessages_UNIQUE` (`idMessages`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pieces`
--

DROP TABLE IF EXISTS `pieces`;
CREATE TABLE IF NOT EXISTS `pieces` (
  `idPieces` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `id_laboratoire` varchar(45) NOT NULL,
  `type_piece` varchar(45) NOT NULL DEFAULT 'analyse',
  PRIMARY KEY (`idPieces`),
  UNIQUE KEY `idPièces_UNIQUE` (`idPieces`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pieces`
--

INSERT INTO `pieces` (`idPieces`, `nom`, `id_laboratoire`, `type_piece`) VALUES
(1, 'Labo 1', '1', 'analyse'),
(3, 'Prelevement 1', '1', 'prelevement'),
(4, 'Reserve', '1', 'reserve'),
(5, 'Prelevement 2', '1', 'prelevement');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(45) NOT NULL,
  `mot_de_passe` varchar(128) NOT NULL,
  `adresse_mail` varchar(45) NOT NULL,
  `type_employe` varchar(45) NOT NULL DEFAULT 'personnel',
  `idLaboratoire` int(11) DEFAULT '0',
  PRIMARY KEY (`idUtilisateurs`),
  UNIQUE KEY `idUtilisateurs_UNIQUE` (`idUtilisateurs`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateurs`, `nom_utilisateur`, `mot_de_passe`, `adresse_mail`, `type_employe`, `idLaboratoire`) VALUES
(44, 'Antoine de Barruel', 'b33069ae241e8f133ddb7596a7278a340889d2c2f92d93f86f3a850b330fd452148d69609c34c2ac8bcaa86ddea22bfe4cd998057d73742f84c2593d7bc4255c', 'antoine.de.barruel@outlook.fr', 'gestionnaire', 1),
(33, 'Utilisateur 3', 'a0f2372c863fb7483c1dfb27ba5120faa2cf92d3b1f87fd11cd6e72646a5fd7786d8f1e1feba5b4d7e6f99fb7546240000e457c3579096f59f2d2438472101dd', 'utilisateur3@mail.com', 'administrateur', 0),
(34, 'Utilisateur 2', 'a0f2372c863fb7483c1dfb27ba5120faa2cf92d3b1f87fd11cd6e72646a5fd7786d8f1e1feba5b4d7e6f99fb7546240000e457c3579096f59f2d2438472101dd', 'utilisateur2@mail.com', 'gestionnaire', 1),
(35, 'Utilisateur 1', 'a0f2372c863fb7483c1dfb27ba5120faa2cf92d3b1f87fd11cd6e72646a5fd7786d8f1e1feba5b4d7e6f99fb7546240000e457c3579096f59f2d2438472101dd', 'utilisateur1@mail.com', 'personnel', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
