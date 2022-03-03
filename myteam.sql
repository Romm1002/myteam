-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : ipssisqmyteam.mysql.db
-- Généré le : jeu. 03 mars 2022 à 17:37
-- Version du serveur : 5.6.51-log
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ipssisqmyteam`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`ipssisqmyteam`@`%` PROCEDURE `bannir_utilisateur` (IN `id` INT)  BEGIN
	UPDATE utilisateurs SET actif = 0 WHERE idUtilisateur = id ;
END$$

CREATE DEFINER=`ipssisqmyteam`@`%` PROCEDURE `informations_utilisateur_connecte` (IN `id` INT)  BEGIN
	SELECT u.idUtilisateur, u.nom, u.prenom, u.dateNaiss, u.email, u.photoProfil, p.poste FROM utilisateurs AS u LEFT JOIN postes AS p USING (idposte) WHERE idUtilisateur = id;
END$$

CREATE DEFINER=`ipssisqmyteam`@`%` PROCEDURE `taches` (IN `p_id_projet` INT)  BEGIN
	SELECT * FROM tachesprojet WHERE idProjet = p_id_projet;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `affectations`
--

CREATE TABLE `affectations` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
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
-- Structure de la table `avertissement`
--

CREATE TABLE `avertissement` (
  `idAvertissement` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avertissement`
--

INSERT INTO `avertissement` (`idAvertissement`, `idUtilisateur`, `nombre`) VALUES
(2, 3, 2),
(3, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `chatprojet`
--

CREATE TABLE `chatprojet` (
  `idMessage` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `dateMessage` datetime NOT NULL,
  `message` text NOT NULL,
  `idProjet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chatprojet`
--

INSERT INTO `chatprojet` (`idMessage`, `idUtilisateur`, `dateMessage`, `message`, `idProjet`) VALUES
(9, 2, '2021-11-18 17:09:34', 'Bonjour', 1),
(15, 1, '2022-01-22 22:49:58', 'Message de test.', 2),
(16, 1, '2022-02-19 23:04:04', 'sdfgh', 1),
(17, 1, '2022-02-19 23:04:06', 'sdfgh', 1),
(18, 1, '2022-02-19 23:04:08', 'sdfgh', 1),
(19, 1, '2022-02-19 23:04:31', 'sdfgh', 1),
(20, 1, '2022-02-19 23:04:39', 'sdfgh', 1),
(21, 1, '2022-02-19 23:04:55', 'sdfgh', 1),
(22, 1, '2022-02-19 23:05:01', 'Bonjour', 1),
(23, 1, '2022-02-19 23:05:18', 'dtfyguh', 3);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `idEvenement` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `contenu` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `couleur` varchar(100) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`idEvenement`, `designation`, `contenu`, `date`, `heureDebut`, `heureFin`, `idUtilisateur`, `couleur`, `admin`) VALUES
(1, 'Pro', NULL, '2021-10-19', '08:00:00', '16:00:00', 23, '#c6cd25b3', 0),
(2, 'd', NULL, '2021-10-19', '08:00:00', '09:00:00', 23, '#4acd25b3', 0),
(3, 'ss', NULL, '2021-10-19', '14:00:00', '16:00:00', 23, '#e30e0eb3', 0),
(8, 'sss', NULL, '2022-02-21', '16:31:00', '18:31:00', 1, '#97c7eeb3', 0),
(9, 'test', NULL, '2022-02-27', '08:00:00', '08:00:00', 28, '#97c7eeb3', 1);

-- --------------------------------------------------------

--
-- Structure de la table `jaime`
--

CREATE TABLE `jaime` (
  `idUtilisateur` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jaime`
--

INSERT INTO `jaime` (`idUtilisateur`, `idPublication`) VALUES
(28, 8),
(1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`maintenance`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `idMessage` int(11) NOT NULL,
  `idUtilisateur` varchar(50) NOT NULL,
  `idReceveur` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `heure` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`idMessage`, `idUtilisateur`, `idReceveur`, `contenu`, `heure`) VALUES
(1, '2', '3', 'salut :)', '2022-03-01 14:53:09'),
(2, '2', '3', ':) :/ :( (: :p :o :\'(', '2022-03-01 14:53:29'),
(3, '2', '3', ':D', '2022-03-01 14:53:38'),
(4, '31', '2', ':)', '2022-03-01 15:08:53'),
(5, '31', '2', ':(', '2022-03-01 15:09:01'),
(6, '31', '2', 'jhjh', '2022-03-01 15:27:46'),
(7, '2', '3', 'x', '2022-03-02 11:57:43'),
(8, '2', '3', 'x', '2022-03-02 11:57:45'),
(9, '2', '3', 'x', '2022-03-02 11:57:47'),
(10, '2', '3', 'x', '2022-03-02 11:57:49'),
(11, '2', '3', 'x', '2022-03-02 11:57:51'),
(12, '2', '3', 'x', '2022-03-02 11:57:53'),
(13, '2', '3', 'x', '2022-03-02 11:57:55'),
(14, '2', '3', 'x', '2022-03-02 11:57:58');

-- --------------------------------------------------------

--
-- Structure de la table `messages_signales`
--

CREATE TABLE `messages_signales` (
  `idMessageSignaler` int(11) NOT NULL,
  `idMessage` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `traite` tinyint(1) NOT NULL DEFAULT '0',
  `idUtilisateur` int(11) NOT NULL,
  `idSignale` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages_signales`
--

INSERT INTO `messages_signales` (`idMessageSignaler`, `idMessage`, `message`, `traite`, `idUtilisateur`, `idSignale`) VALUES
(1, 40, 'bonjour', 1, 1, 2),
(2, 2, 'lmkjk', 0, 1, 2),
(3, 3, 'pùmkljhj', 1, 1, 2),
(4, 5, ':(', 0, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `participationprojet`
--

CREATE TABLE `participationprojet` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `participationprojet`
--

INSERT INTO `participationprojet` (`idProjet`, `idUtilisateur`) VALUES
(2, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `plannifications`
--

CREATE TABLE `plannifications` (
  `idPlannification` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `date` date NOT NULL,
  `ratio` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `plannifications`
--

INSERT INTO `plannifications` (`idPlannification`, `idUtilisateur`, `idProjet`, `date`, `ratio`) VALUES
(1, 1, 1, '2022-02-02', 0.5),
(2, 1, 2, '2022-02-17', 1),
(3, 1, 2, '2022-02-18', 1),
(4, 2, 1, '2022-02-22', 0.6),
(5, 1, 2, '2022-02-28', 1),
(6, 1, 1, '2022-03-02', 0.7),
(7, 1, 2, '2022-03-02', 1);

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

CREATE TABLE `postes` (
  `idposte` int(11) NOT NULL,
  `poste` text NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`idposte`, `poste`, `grade`) VALUES
(1, 'Employé(e)', 5),
(2, 'Administrateur', 10),
(3, 'Visiteur', 0),
(4, 'RH', 10),
(5, 'PDG', 10),
(6, 'DG', 10),
(7, 'Commercial(e)', 5),
(8, 'Développeur(euse)', 5);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
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
(1, 'Projet n°1 de test', 'Description de test du projet n°1 de test.', '2022-01-07', '2022-05-20', '../pages/images/projets/projet1.jpg', 0),
(2, 'Projet n°2', 'Description de test', '2021-11-14', '2021-11-16', '../pages/images/projets/projet2.jpg', 0),
(3, 'Projet MYTeam', 'Description du projet MYTeam', '2021-11-30', '2021-12-05', '../pages/images/projets/projet3.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `idPublication` int(11) NOT NULL,
  `contenuPublication` text NOT NULL,
  `datePublication` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `typePublication` varchar(50) NOT NULL,
  `jaime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`idPublication`, `contenuPublication`, `datePublication`, `idUtilisateur`, `typePublication`, `jaime`) VALUES
(15, 'iiii', '2022-03-01 15:03:03', 31, 'annonce', 0),
(16, ':) :( :/ :o :p :D', '2022-03-02 17:25:44', 2, 'simple', 0),
(5, 'Bonjour tous le monde !', '2022-02-03 09:36:46', 1, 'post', 1),
(4, 'Message de test', '2022-01-16 18:20:23', 5, 'post', 0),
(14, 'hashtag #coucou oiuhds', '2022-03-01 14:12:05', 2, 'simple', 0),
(8, 'ée\"r(-##', '2022-02-19 22:50:06', 1, 'annonce', 0),
(9, ':)', '2022-02-20 17:25:29', 1, 'simple', 0),
(13, 'contrat', '2022-02-28 12:11:43', 1, 'simple', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `idReponse` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL,
  `reponse` varchar(250) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`idReponse`, `idPublication`, `reponse`, `idUtilisateur`) VALUES
(2, 7, 'zaert', 1),
(3, 6, 'fuck le serveur', 1),
(4, 15, 'kkk', 31);

-- --------------------------------------------------------

--
-- Structure de la table `tachesprojet`
--

CREATE TABLE `tachesprojet` (
  `idTache` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `terminee` tinyint(1) NOT NULL,
  `idProjet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tachesprojet`
--

INSERT INTO `tachesprojet` (`idTache`, `libelle`, `terminee`, `idProjet`) VALUES
(1, 'Tâche numéro 1', 1, 1),
(2, 'Tâche numéro 2', 1, 1),
(3, 'Tache Numéro 3', 1, 1),
(4, 'tâche de test', 1, 2),
(5, 'MontreTest', 0, 2),
(6, 'Catégorie de test', 1, 1),
(7, 'uuuu', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
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
  `color` varchar(50) NOT NULL DEFAULT '#007add'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `dateNaiss`, `email`, `mdp`, `idposte`, `photoProfil`, `token`, `first_connexion`, `avertissements`, `actif`, `color`) VALUES
(1, 'admin', 'admin', '2002-02-10', 'admin@myteam.fr', '$2y$10$TPrrCP8/jTxphkwAaB.gVO74dOznkibUyQR8WvBS3w6tO59WOpU8.', 2, '../pages/images/avatar/1.jpg', '67d670d9123e6205f6076edb3a08f2', 0, 0, 1, ''),
(2, 'Accès', 'Utilisateur', '2002-01-10', 'utilisateur@myteam.fr', '$2y$10$rd0/xxiVMOq5WnXKXlM7j.PrOD5YBrQXR8k13Nesw85m/KEo30rtK', 2, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 0, '#007add'),
(3, 'Utilisateur', 'Numero1', '2002-10-10', 'numero1@myteam.fr', '$2y$10$MbTxzxavXzLdKU3N/fLEpeMb0i5Cr7QLVFInO.5.ala716MBGrRUe', 1, '../pages/images/avatar/photoProfil.jpg', NULL, 1, 0, 1, '#007add'),
(4, 'Utilisateur', 'Numero2', '2002-01-01', 'numero2@myteam.fr', '$2y$10$Q.mBzNdb9oHr.HOPwBn4X.r.kx8ABwxiVDm6tPWqtgAEyjLOotl1q', 1, '../pages/images/avatar/photoProfil.jpg', NULL, 1, 0, 1, '#007add'),
(5, 'Chau', 'Romain', '2002-01-20', 'romain.chaumont@hotmail.fr', '$2y$10$8Queu44GNgfMdN14xLNpdeRmbKK12vKQPr1UqILWpsNIp85jEUTnu', 2, '../pages/images/avatar/photoProfil.jpg', '3a466a5899faa582a805164ff9ffcf', 1, 0, 0, '#007add'),
(15, 'NOm2', 'Préom', '2022-01-31', 'oibujvhcgh@outlook.fr', '$2a$11$wTdPd.8CmJU0oGDK4hrMoOyF.zuEdQP3YhzgzyY.JEaRs1pRKvhmi', 2, '../pages/images/avatar/photoProfil.jpg', NULL, 1, 0, 1, '#007add'),
(17, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.to', '$2y$10$i6JJ034GRq7AzF.XooWWp.PzfLck52Ygw1sze2t9g8/SR4EYBcZ12', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(18, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.fd', '$2y$10$rTL/QSuEv3ICPYt7JJF48eSif0CkT7GQV69dYO8/VMsO7j7Kb.l9C', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(19, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.re', '$2y$10$l4fOsfdW9Awbvt0OMG1lUOSloTTfVDGGmHovYNKx0owanv8q3MkD6', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(20, 'Chaumont', 'Romain', '2002-10-31', 'romain.chaumont@hotmail.bv', '$2y$10$/C3C7/J.JZM6k4dJvMdECOQIq5bUUikuRQxzxmqNhVp06rFNi9wWy', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(21, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.az', '$2y$10$pMo4pOCd9mXLZ.dNAQ/ptu.Hf9DqAh/qOWLtqXkXNxvzXIVPa9iL2', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(22, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.vb', '$2y$10$EefAAtExoK63PEWhHraeReWDvkkpL9aWDEC73Lej7HBsrgWeN9j.K', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(23, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.xw', '$2y$10$q6DskdWuOpflJYPXL2T0NOk36Mt62HkajzKfd8aCykMJ.UY.lNnLe', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(24, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.frpm', '$2y$10$NvR3Cd4lvNz/RHc.6FTpYu1mQSMc6l2/ulFlWlUZ3HIR7PdETIfUa', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(25, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.kjhg', '$2y$10$uqKWYJ8daf3Bud.gMUX7FeHRzVyJHrlkqI80cXCEMhnlddZ6.v7Sm', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(26, 'Chaumont', 'Romain', '2002-02-10', 'romain.chaumont@hotmail.rtfeqgf', '$2y$10$d7G0tGvTi82SMT1XniosxObmX1RGiNgGa4wEh9Gx./b6gqkNlWwli', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(27, 'Chaumont', 'Romain', '2001-02-10', 'romain.chaumont@hotmail.qo', '$2y$10$t4An0vvNlBvkK35w623k.uml2Y2in1FfdneR/d62XB5eI1SpKEYPu', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(28, 'damien', 'DAMIEN', '2000-05-02', 'damien@myteam.Fr', '$2y$10$QKF6dN.RFdVV5BfQ1CdULeEEnBDvek7I7fcnc2SaLRs65.5QT6sCG', 7, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(29, 'Utilisateur', 'Visiteur', '2002-02-10', 'visiteur@myteam.fr', '$2y$10$sVT3gwS9Sd08tF/37J0w3ud9UbG/ORXXZRHjrW6ExjmRSN5fopAWu', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(30, 'Utilisateur', 'Employe', '2002-02-10', 'employe@myteam.fr', '$2y$10$MTSkUFNCV4VjzDne394U2.Uvq/I6vWTWjG6eN9qF7OX4iX1wyCVya', 1, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add'),
(31, 'Utilisateur', 'Admin', '2002-02-10', 'administrateur@myteam.fr', '$2y$10$pbEJxjax3qclW8zFhbDLouTO7o6LiB3EDCfPa/Eg205sVB4CScN/u', 2, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1, '#007add');

--
-- Déclencheurs `utilisateurs`
--
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

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectations`
--
ALTER TABLE `affectations`
  ADD PRIMARY KEY (`idProjet`,`idUtilisateur`);

--
-- Index pour la table `avertissement`
--
ALTER TABLE `avertissement`
  ADD PRIMARY KEY (`idAvertissement`);

--
-- Index pour la table `chatprojet`
--
ALTER TABLE `chatprojet`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`idEvenement`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `messages_signales`
--
ALTER TABLE `messages_signales`
  ADD PRIMARY KEY (`idMessageSignaler`);

--
-- Index pour la table `plannifications`
--
ALTER TABLE `plannifications`
  ADD PRIMARY KEY (`idPlannification`),
  ADD UNIQUE KEY `UQ_user_project_date` (`idUtilisateur`,`idProjet`,`date`),
  ADD KEY `IDX_user` (`idUtilisateur`),
  ADD KEY `IDX_project` (`idProjet`);

--
-- Index pour la table `postes`
--
ALTER TABLE `postes`
  ADD PRIMARY KEY (`idposte`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`idProjet`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`idPublication`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`idReponse`);

--
-- Index pour la table `tachesprojet`
--
ALTER TABLE `tachesprojet`
  ADD PRIMARY KEY (`idTache`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avertissement`
--
ALTER TABLE `avertissement`
  MODIFY `idAvertissement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `chatprojet`
--
ALTER TABLE `chatprojet`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `idEvenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `messages_signales`
--
ALTER TABLE `messages_signales`
  MODIFY `idMessageSignaler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `plannifications`
--
ALTER TABLE `plannifications`
  MODIFY `idPlannification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `idPublication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `idReponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tachesprojet`
--
ALTER TABLE `tachesprojet`
  MODIFY `idTache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
