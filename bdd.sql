-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 17 mars 2022 à 11:01
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myteam`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `bannir_utilisateur`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `bannir_utilisateur` (IN `id` INT)  BEGIN
	UPDATE utilisateurs SET actif = 0 WHERE idUtilisateur = id ;
END$$

DROP PROCEDURE IF EXISTS `informations_utilisateur_connecte`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `informations_utilisateur_connecte` (IN `id` INT)  BEGIN
	SELECT u.idUtilisateur, u.nom, u.prenom, u.dateNaiss, u.email, u.photoProfil, p.poste FROM utilisateurs AS u LEFT JOIN postes AS p USING (idposte) WHERE idUtilisateur = id;
END$$

DROP PROCEDURE IF EXISTS `taches`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `taches` (IN `p_id_projet` INT)  BEGIN
	SELECT * FROM tachesprojet WHERE idProjet = p_id_projet;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `affectations`
--

DROP TABLE IF EXISTS `affectations`;
CREATE TABLE IF NOT EXISTS `affectations` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idProjet`,`idUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `affectations`
--

INSERT INTO `affectations` (`idProjet`, `idUtilisateur`) VALUES
(1, 1),
(1, 6),
(2, 3),
(3, 2),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `allowed_ips`
--

DROP TABLE IF EXISTS `allowed_ips`;
CREATE TABLE IF NOT EXISTS `allowed_ips` (
  `idUtilisateur` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `allowed_ips`
--

INSERT INTO `allowed_ips` (`idUtilisateur`, `ip`) VALUES
(1, '::1');

-- --------------------------------------------------------

--
-- Structure de la table `avertissement`
--

DROP TABLE IF EXISTS `avertissement`;
CREATE TABLE IF NOT EXISTS `avertissement` (
  `idAvertissement` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  PRIMARY KEY (`idAvertissement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avertissement`
--

INSERT INTO `avertissement` (`idAvertissement`, `idUtilisateur`, `nombre`) VALUES
(2, 3, 2),
(3, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `banned_ips`
--

DROP TABLE IF EXISTS `banned_ips`;
CREATE TABLE IF NOT EXISTS `banned_ips` (
  `idBannedIp` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`idBannedIp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chatprojet`
--

DROP TABLE IF EXISTS `chatprojet`;
CREATE TABLE IF NOT EXISTS `chatprojet` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `dateMessage` datetime NOT NULL,
  `message` text NOT NULL,
  `idProjet` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chatprojet`
--

INSERT INTO `chatprojet` (`idMessage`, `idUtilisateur`, `dateMessage`, `message`, `idProjet`) VALUES
(9, 2, '2021-11-18 17:09:34', 'Bonjour', 1),
(15, 1, '2022-01-22 22:49:58', 'Message de test.', 2),
(16, 1, '2022-02-27 19:20:54', 'test', 1),
(17, 1, '2022-02-28 00:37:36', 'oi', 1),
(18, 1, '2022-02-28 00:45:59', 'test', 1),
(19, 1, '2022-02-28 00:46:02', 'oui', 1),
(20, 1, '2022-02-28 00:46:09', 'ca c\'est sympa quand meme nan', 1),
(21, 1, '2022-02-28 00:46:43', 'j\'aim oui oui oui', 1),
(22, 1, '2022-02-28 00:50:46', 'test', 1),
(23, 27, '2022-02-28 00:58:32', 'v', 1),
(24, 27, '2022-02-28 02:02:25', 'test', 1),
(25, 1, '2022-02-28 02:04:15', 'test', 1),
(26, 1, '2022-02-28 02:07:31', 'test', 1),
(27, 1, '2022-02-28 02:07:34', 'ok', 1),
(28, 1, '2022-02-28 02:07:52', 'ok', 1),
(29, 1, '2022-02-28 17:28:08', 'test', 1),
(30, 1, '2022-02-28 23:18:38', 'oui', 1),
(31, 1, '2022-02-28 23:18:41', '', 1),
(32, 1, '2022-02-28 23:18:41', '', 1),
(33, 1, '2022-02-28 23:18:41', '', 1),
(34, 1, '2022-02-28 23:18:42', '', 1),
(35, 1, '2022-02-28 23:18:43', '', 1),
(36, 1, '2022-02-28 23:18:43', '', 1),
(37, 1, '2022-03-04 08:40:11', 'rrr', 4);

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

DROP TABLE IF EXISTS `conges`;
CREATE TABLE IF NOT EXISTS `conges` (
  `idConge` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `raison` varchar(255) NOT NULL,
  PRIMARY KEY (`idConge`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`idConge`, `idUtilisateur`, `dateDebut`, `dateFin`, `commentaire`, `status`, `raison`) VALUES
(5, 1, '2022-03-19', '2022-03-20', '', 2, '-'),
(6, 1, '2022-03-25', '2022-03-29', 'JE PARS A MARBELLA', 2, '-'),
(7, 1, '2022-03-19', '2022-03-30', 'JE PARS BOIRE UN MALIBU COCO AVEC CORENTIN', 1, 'OK BG');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `couleur` varchar(100) NOT NULL DEFAULT '#97c7eeb3',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEvenement`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`idEvenement`, `designation`, `date`, `heureDebut`, `heureFin`, `idUtilisateur`, `couleur`, `admin`) VALUES
(52, 'test1', '2022-02-23', '12:00:00', '13:00:00', 15, '#97c7eeb3', 1),
(51, 'test1', '2022-02-23', '12:00:00', '13:00:00', 5, '#97c7eeb3', 1),
(50, 'test1', '2022-02-23', '12:00:00', '13:00:00', 1, '#97c7eeb3', 1),
(49, 'test1', '2022-02-23', '12:00:00', '13:00:00', 4, '#97c7eeb3', 1),
(48, 'test1', '2022-02-23', '12:00:00', '13:00:00', 3, '#97c7eeb3', 1),
(47, 'test2', '2022-02-22', '12:00:00', '13:00:00', 5, '#97c7eeb3', 1),
(46, 'test2', '2022-02-22', '12:00:00', '13:00:00', 1, '#97c7eeb3', 1),
(45, 'test2', '2022-02-22', '12:00:00', '13:00:00', 4, '#97c7eeb3', 1),
(44, 'test2', '2022-02-22', '12:00:00', '13:00:00', 3, '#97c7eeb3', 1),
(43, 'test1', '2022-02-22', '10:00:00', '10:00:00', 1, '#97c7eeb3', 1),
(42, 'test1', '2022-02-22', '10:00:00', '10:00:00', 4, '#97c7eeb3', 1),
(41, 'test1', '2022-02-22', '10:00:00', '10:00:00', 3, '#97c7eeb3', 1),
(62, 'ui', '2022-02-23', '08:00:00', '08:00:00', 1, '#97c7eeb3', 1),
(59, 'test2', '2022-02-20', '10:00:00', '10:00:00', 1, '#97c7eeb3', 1),
(61, 'test', '2022-02-23', '08:00:00', '08:00:00', 3, '#97c7eeb3', 1),
(37, 'test1000', '2022-02-26', '08:00:00', '08:00:00', 4, '#97c7eeb3', 1),
(36, 'test1000', '2022-02-26', '08:00:00', '08:00:00', 3, '#97c7eeb3', 1),
(34, 'test1', '2022-02-26', '13:00:00', '14:00:00', 3, '#97c7eeb3', 1),
(35, 'test1', '2022-02-26', '13:00:00', '14:00:00', 4, '#97c7eeb3', 1),
(63, 'test', '2022-02-23', '08:00:00', '08:00:00', 4, '#97c7eeb3', 1),
(64, 'g', '2022-02-23', '08:00:00', '08:00:00', 3, '#97c7eeb3', 1),
(65, 'f', '2022-02-23', '08:00:00', '08:00:00', 3, '#97c7eeb3', 1),
(66, 'test2', '2022-02-20', '10:00:00', '10:00:00', 3, '#97c7eeb3', 1),
(67, 'test', '2022-02-23', '09:34:00', '09:34:00', 1, '#ed5454b3', 0),
(68, 'test', '2022-03-14', '13:57:00', '13:57:00', 1, '#97c7eeb3', 0);

-- --------------------------------------------------------

--
-- Structure de la table `jaime`
--

DROP TABLE IF EXISTS `jaime`;
CREATE TABLE IF NOT EXISTS `jaime` (
  `idUtilisateur` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jaime`
--

INSERT INTO `jaime` (`idUtilisateur`, `idPublication`) VALUES
(1, 8),
(1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `logs_connexion`
--

DROP TABLE IF EXISTS `logs_connexion`;
CREATE TABLE IF NOT EXISTS `logs_connexion` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logs_connexion`
--

INSERT INTO `logs_connexion` (`idLog`, `idUtilisateur`, `date`, `ip`) VALUES
(1, 1, '2022-03-17 09:30:02', '::1'),
(2, 1, '2022-03-17 09:46:58', '::1'),
(3, 1, '2022-03-17 10:49:11', '::1');

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `maintenance` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`maintenance`) VALUES
(0);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` varchar(50) NOT NULL,
  `idReceveur` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `heure` datetime DEFAULT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages_signales`
--

DROP TABLE IF EXISTS `messages_signales`;
CREATE TABLE IF NOT EXISTS `messages_signales` (
  `idMessageSignaler` int(11) NOT NULL AUTO_INCREMENT,
  `idMessage` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `traite` tinyint(1) NOT NULL DEFAULT '0',
  `idUtilisateur` int(11) NOT NULL,
  `idSignale` int(11) NOT NULL,
  PRIMARY KEY (`idMessageSignaler`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participationprojet`
--

DROP TABLE IF EXISTS `participationprojet`;
CREATE TABLE IF NOT EXISTS `participationprojet` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `participationprojet`
--

INSERT INTO `participationprojet` (`idProjet`, `idUtilisateur`) VALUES
(2, 1),
(1, 3),
(1, 4),
(1, 1),
(4, 4),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `plannifications`
--

DROP TABLE IF EXISTS `plannifications`;
CREATE TABLE IF NOT EXISTS `plannifications` (
  `idPlannification` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `date` date NOT NULL,
  `ratio` float NOT NULL,
  PRIMARY KEY (`idPlannification`),
  UNIQUE KEY `UQ_user_project_date` (`idUtilisateur`,`idProjet`,`date`),
  KEY `IDX_user` (`idUtilisateur`),
  KEY `IDX_project` (`idProjet`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `plannifications`
--

INSERT INTO `plannifications` (`idPlannification`, `idUtilisateur`, `idProjet`, `date`, `ratio`) VALUES
(1, 1, 1, '2022-02-02', 0.5),
(2, 1, 2, '2022-02-17', 1),
(3, 1, 2, '2022-02-18', 1),
(4, 2, 1, '2022-02-22', 0.6),
(38, 1, 4, '2022-03-16', 1);

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

DROP TABLE IF EXISTS `postes`;
CREATE TABLE IF NOT EXISTS `postes` (
  `idposte` int(11) NOT NULL,
  `poste` text NOT NULL,
  `grade` int(11) NOT NULL,
  PRIMARY KEY (`idposte`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`idposte`, `poste`, `grade`) VALUES
(1, 'Employé(e)', 5),
(2, 'Administrateur', 10),
(3, 'Visiteur', 0),
(4, 'RH', 6),
(5, 'PDG', 10),
(6, 'DG', 10),
(7, 'Commercial(e)', 5),
(8, 'Développeur(euse)', 5),
(0, 'clow', 0);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `idProjet` int(11) NOT NULL,
  `nomProjet` varchar(100) NOT NULL,
  `descriptionProjet` text NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `image` varchar(250) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`idProjet`, `nomProjet`, `descriptionProjet`, `dateDebut`, `dateFin`, `image`, `archive`) VALUES
(1, 'Projet n°1 de test', 'Description de test du projet n°1 de test.', '2022-01-07', '2022-05-20', '../pages/images/projets/projet1.jpg', 1),
(2, 'Projet n°2', 'Description de test', '2021-11-14', '2021-11-16', '../pages/images/projets/projet2.jpg', 1),
(3, 'Projet MYTeam', 'Description du projet MYTeam', '2021-11-30', '2021-12-05', '../pages/images/projets/projet3.jpg', 0),
(4, 'test', 'test', '2022-02-25', '2022-02-27', '../pages/images/projets/projet4.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

DROP TABLE IF EXISTS `publications`;
CREATE TABLE IF NOT EXISTS `publications` (
  `idPublication` int(11) NOT NULL AUTO_INCREMENT,
  `contenuPublication` text NOT NULL,
  `datePublication` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `typePublication` varchar(50) NOT NULL,
  `jaime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPublication`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`idPublication`, `contenuPublication`, `datePublication`, `idUtilisateur`, `typePublication`, `jaime`) VALUES
(6, 'ANNONCE : Une panne de serveur a eu lieu vers 9h00. #panne', '2022-02-03 09:37:20', 1, 'annonce', 12),
(5, 'Bonjour tous le monde !', '2022-02-03 09:36:46', 1, 'post', 0),
(4, 'Message de test', '2022-01-16 18:20:23', 5, 'post', 0),
(7, 'test', '2022-02-19 23:33:06', 1, 'simple', 1),
(8, 'test', '2022-02-19 23:33:15', 1, 'simple', 1),
(9, 'OKOK', '2022-03-13 13:34:27', 1, 'simple', 0),
(10, 'plpl', '2022-03-13 13:34:33', 1, 'simple', 0),
(11, 'dd', '2022-03-13 13:36:31', 1, 'simple', 0),
(12, 'dd', '2022-03-13 13:36:31', 1, 'simple', 0),
(37, 'dddd', '2022-03-16 14:08:58', 1, 'simple', 0),
(38, 'dddd', '2022-03-16 14:08:58', 1, 'simple', 0),
(39, 'ffff', '2022-03-16 14:09:07', 1, 'simple', 0),
(40, 'ffff', '2022-03-16 14:09:07', 1, 'simple', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `idReponse` int(11) NOT NULL AUTO_INCREMENT,
  `idPublication` int(11) NOT NULL,
  `reponse` varchar(250) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idReponse`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tachesprojet`
--

DROP TABLE IF EXISTS `tachesprojet`;
CREATE TABLE IF NOT EXISTS `tachesprojet` (
  `idTache` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idTacheParent` int(11) DEFAULT NULL,
  `terminee` int(11) NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`idTache`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tachesprojet`
--

INSERT INTO `tachesprojet` (`idTache`, `libelle`, `idProjet`, `idUtilisateur`, `idTacheParent`, `terminee`, `dateFin`) VALUES
(1, 'tâche de test', 4, 1, NULL, 1, '2022-03-16'),
(2, 'Test', 4, 4, 1, 0, '2022-03-31'),
(3, 'MontreTest', 4, 2, 2, 0, '2022-03-31');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateNaiss` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `idposte` int(11) NOT NULL,
  `photoProfil` varchar(250) NOT NULL DEFAULT 'https://st3.depositphotos.com/4111759/13425/v/600/depositphotos_134255634-stock-illustration-avatar-icon-male-profile-gray.jpg',
  `token` varchar(255) DEFAULT NULL,
  `first_connexion` tinyint(1) DEFAULT '1',
  `avertissements` int(11) NOT NULL DEFAULT '0',
  `actif` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `dateNaiss`, `email`, `mdp`, `idposte`, `photoProfil`, `token`, `first_connexion`, `avertissements`, `actif`) VALUES
(1, 'admi', 'admi', '2002-02-10', 'admin@myteam.fr', '$2y$10$EFVZjWWkMsqYSd2L9T.MfeAToUG94S5LgUy04/jPMs00aAD/yFfJ6', 4, '../pages/images/avatar/photoProfil.jpg', '67d670d9123e6205f6076edb3a08f2', 0, 3, 0),
(2, 'Accès', 'Utilisateur', '2002-01-10', 'utilisateur@myteam.fr', '$2y$10$sdMmx1kqSZvuYL.q38Igcew1tfStr9nR2ya.v056XuDr.BkPMPzKu', 2, '../pages/images/avatar/photoProfil.jpg', NULL, 1, 0, 1),
(3, 'Utilisateur', 'Numero1', '2002-10-10', 'numero1@myteam.fr', '$2y$10$MbTxzxavXzLdKU3N/fLEpeMb0i5Cr7QLVFInO.5.ala716MBGrRUe', 5, '../pages/images/avatar/photoProfil.jpg', NULL, 1, 0, 1),
(4, 'Utilisateur', 'Numero2', '2002-01-01', 'numero2@myteam.fr', '$2y$10$Q.mBzNdb9oHr.HOPwBn4X.r.kx8ABwxiVDm6tPWqtgAEyjLOotl1q', 1, '../pages/images/avatar/photoProfil.jpg', NULL, 1, 0, 0),
(5, 'Chau', 'Romain', '2002-01-20', 'romain.chaumont@hotmail.fr', '$2y$10$8Queu44GNgfMdN14xLNpdeRmbKK12vKQPr1UqILWpsNIp85jEUTnu', 2, '../pages/images/avatar/photoProfil.jpg', '3a466a5899faa582a805164ff9ffcf', 1, 0, 0),
(15, 'NOm2', 'Préom', '2022-01-31', 'oibujvhcgh@outlook.fr', '$2a$11$wTdPd.8CmJU0oGDK4hrMoOyF.zuEdQP3YhzgzyY.JEaRs1pRKvhmi', 7, '../pages/images/avatar/photoProfil.jpg', NULL, 1, 6, 0),
(30, 'test', 'test', '2000-02-02', 'test@mail.fr', '$2a$11$NhnyLGzSaT8uPkCd1vhoPeNzsLB.xqZ0PdojzpJvSdEnRQFcaVx.m', 0, '../pages/images/avatar/photoProfil.jpg', NULL, 1, 4, 0),
(26, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.rtfeqgf', '$2y$10$d7G0tGvTi82SMT1XniosxObmX1RGiNgGa4wEh9Gx./b6gqkNlWwli', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 0),
(27, 'Damien', 'Damien', '2000-05-02', 'damien@myteam.fr', '$2y$10$GWgsqSiKuI5JAq4gynwWsuHPNsYa43SEBx0usx0EAM0ZoyXGzcSO2', 2, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 3, 0),
(31, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.tb', '$2y$10$Oc2OOXyKNRH3ExHQPzsAbex5IiiBxaDgMzwL4WSxeusPvXa2zuBMS', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(32, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.hg', '$2y$10$8KCXD/6lJRmSi9ZryIgmj.LsauwNARMTFOCfu3PFYWpdEJXu8kL0C', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(33, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.sq', '$2y$10$deF2kNlXkfmwU3E0xXSpFOphmH.wLBrkujUYxVomKOIxs1h9P.7XC', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(34, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmai.fr', '$2y$10$PSrjOk4AmxDML.2bkFMdKuXBBq9FvGCHJkEk/3by2mJZi1GcntzCi', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(35, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotma.fr', '$2y$10$Z8.fUrW7ryw6da08y4FG.O0FTnhZ2D45pQdapNEx5lFUS8l0tAXZ2', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(36, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@homail.fr', '$2y$10$yB2pq7VQOJIBFVOniLt.v.1QnVcasWbwUszx4yihWJu5KEZ1vj2.u', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(37, 'Chaumont', 'Romain', '2002-02-10', 'romain.cumont@hotmail.fr', '$2y$10$QAgR9fgKDqEYyXcb/9AhOefXwH8OPbF/UhsS1/3mgBkfNe.Ctfr.S', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(154, 'CompteTest', 'CompteTest', '2002-02-10', 'test@test.com', '$2y$10$4yKStJxDFoEKF0uZiVOTVO1PI7urjPO.DinrY5lv7CyLEn7O2nNTS', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1);

--
-- Déclencheurs `utilisateurs`
--
DROP TRIGGER IF EXISTS `after_update_utilisateurs`;
DELIMITER $$
CREATE TRIGGER `after_update_utilisateurs` BEFORE UPDATE ON `utilisateurs` FOR EACH ROW BEGIN
	IF NEW.avertissements > 2 THEN
    	SET NEW.actif = 0;
	END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_delete_utilisateurs`;
DELIMITER $$
CREATE TRIGGER `before_delete_utilisateurs` BEFORE DELETE ON `utilisateurs` FOR EACH ROW BEGIN
	DELETE FROM affectations WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM avertissement WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM evenements WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM jaime WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM participationprojet WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM plannifications WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM publications WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM reponses WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM chatprojet WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM messagerie WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM messages_signales WHERE idUtilisateur = OLD.idUtilisateur;
END
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
