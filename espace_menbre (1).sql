-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 03 juin 2022 à 14:30
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espace_menbre`
--

-- --------------------------------------------------------

--
-- Structure de la table `annee_scolaire`
--

DROP TABLE IF EXISTS `annee_scolaire`;
CREATE TABLE IF NOT EXISTS `annee_scolaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `annee` varchar(255) NOT NULL,
  `id_menbre` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_enseignant` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_time_publication` datetime NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `contenu`, `date_time_publication`, `photo`) VALUES
(1, 'e.bg', 'salut tout le monde\r\n', '2021-06-26 17:55:32', ''),
(2, 'original', 'pressse toi t\'es trop lent je voudrais é,erger jé', '2021-06-26 21:00:53', ''),
(3, 'original', 'pressse toi t\'es trop lent je voudrais é,erger jé', '2021-06-26 21:12:51', ''),
(4, 'monde phantaisie', 'le fleau c\'est moi', '2021-06-27 17:53:31', ''),
(5, 'module 2', 'le serveur web', '2021-06-27 17:58:37', ''),
(6, 'fantasy inspiration', 'monstre des tenebres ravageant tout sur son passage', '2021-07-05 22:53:36', ''),
(7, 'fantasy inspiration', 'monstre des tenebres ravageant tout sur son passage', '2021-07-05 23:24:59', ''),
(8, 'ali', 'philipe price', '2021-07-05 23:33:58', ''),
(9, 'yuri', 'bienvevu', '2021-07-06 09:51:39', ''),
(10, 'original', 'contenu', '2021-07-07 01:54:55', ''),
(11, '', '', '0000-00-00 00:00:00', ''),
(12, '', '', '0000-00-00 00:00:00', ''),
(13, '', '', '0000-00-00 00:00:00', ''),
(14, '', '', '0000-00-00 00:00:00', ''),
(15, 'e.bg', 'contenu', '2021-07-07 01:59:09', '40 citations de philo à connaître pour le bac.docx'),
(16, 'e.bg', 'contenu', '2021-07-07 02:00:01', '40 citations de philo à connaître pour le bac.docx'),
(17, 'monde phantaisie', 'mode connue sois la domination', '2021-08-14 15:51:21', 'Lunacy, illustratrice_concept artiste.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `authentification`
--

DROP TABLE IF EXISTS `authentification`;
CREATE TABLE IF NOT EXISTS `authentification` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) DEFAULT NULL,
  `user_password` text,
  `user_registerDate` datetime DEFAULT NULL,
  `user_admin` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auto`
--

DROP TABLE IF EXISTS `auto`;
CREATE TABLE IF NOT EXISTS `auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `naissance` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `sexe` varchar(2) NOT NULL,
  `session` varchar(255) NOT NULL,
  `date_enreg` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `auto`
--

INSERT INTO `auto` (`id`, `first`, `last`, `age`, `naissance`, `lieu`, `sexe`, `session`, `date_enreg`) VALUES
(1, 'feder', 'sia', 22, '2001-02-03', 'belgique', 'M', 'SEPTEMBRE', '2021-12-18 12:30:12');

-- --------------------------------------------------------

--
-- Structure de la table `check_up`
--

DROP TABLE IF EXISTS `check_up`;
CREATE TABLE IF NOT EXISTS `check_up` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `check_up`
--

INSERT INTO `check_up` (`id`, `nom`) VALUES
(1, 'permis auto-ecole'),
(2, 'formation + emploi');

-- --------------------------------------------------------

--
-- Structure de la table `cycle`
--

DROP TABLE IF EXISTS `cycle`;
CREATE TABLE IF NOT EXISTS `cycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `duree` varchar(100) NOT NULL,
  `date_en` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cycle`
--

INSERT INTO `cycle` (`id`, `nom`, `duree`, `date_en`) VALUES
(1, 'DQP', '1', '2021-11-29 16:37:23'),
(2, 'BTS', '2', '2022-03-13 22:29:54');

-- --------------------------------------------------------

--
-- Structure de la table `dashboard_admin`
--

DROP TABLE IF EXISTS `dashboard_admin`;
CREATE TABLE IF NOT EXISTS `dashboard_admin` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dashboard_admin`
--

INSERT INTO `dashboard_admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(255) NOT NULL,
  `last` varchar(250) NOT NULL,
  `pseudo` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `date_en` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `departement` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(30) NOT NULL,
  `first_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `autre` text NOT NULL,
  `date_en` datetime NOT NULL,
  `unique_id` smallint(6) NOT NULL,
  `diplome` varchar(255) NOT NULL,
  `sexe` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `naissance` varchar(30) NOT NULL,
  `lieu` varchar(30) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `status` varchar(11) NOT NULL,
  `session` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `pseudo`, `first_en`, `last_en`, `email`, `filiere`, `autre`, `date_en`, `unique_id`, `diplome`, `sexe`, `age`, `naissance`, `lieu`, `ville`, `pass`, `status`, `session`) VALUES
(1, 'paul', 'paul', 'father', 'paul@yahoo.com', 'webmaster(BAC MIN)', ' hlkaklfa', '2021-12-20 08:04:13', 57, 'BTS PRO', 'M', 42, '4200-04-03', 'yaounde', 'douala', '$2y$11$CKaAhUzwApEUJqdbCgV7w.WwNrd8xabiHA.y9liiQABFMqCxJL1Pu', '', 'SEPTEMBRE'),
(2, 'elio', 'eliote', 'gims', 'eliote@yahoo.com', 'webmaster(BAC MIN)', ' nno moire...', '2022-03-13 22:42:48', 44, 'License PRO', 'M', 35, '2000-03-10', 'yaounde', 'yaounde', '$2y$11$64U2BJ8edlEJUGZ5SFy5RORsPn3AD/FvtNccqtPvFCwwWdfrgeM8K', '', 'SEPTEMBRE');

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`code`, `nom`, `email`, `photo`) VALUES
(17, 'victor', 'dollarressam@gmail.com', 'golem _Destroer_, Maria Trepalina.png'),
(18, 'vuitu', 'mvemvearnoldjunior@gmail.com', 'Gallery ‘Épouvantables Fantômes’ _ Élian Black\'Mor __ Road Book.jfif'),
(19, 'paul', 'mashashie@yahoo.com', 'Digital Art by Eve Ventrue _ Cuded.jfif'),
(20, 'paul', 'mashashie@yahoo.com', 'Digital Art by Eve Ventrue _ Cuded.jfif'),
(21, 'paul', 'mashashie@yahoo.com', 'Digital Art by Eve Ventrue _ Cuded.jfif'),
(22, 'paul', 'mashashie@yahoo.com', 'Digital Art by Eve Ventrue _ Cuded.jfif'),
(23, 'paul', 'mashashie@yahoo.com', 'Digital Art by Eve Ventrue _ Cuded.jfif'),
(24, 'paul', 'mashashie@yahoo.com', 'Digital Art by Eve Ventrue _ Cuded.jfif'),
(25, 'paul', 'mashashie@yahoo.com', 'Digital Art by Eve Ventrue _ Cuded.jfif'),
(26, 'paul', 'mashashie@yahoo.com', 'rain.png');

-- --------------------------------------------------------

--
-- Structure de la table `filtre`
--

DROP TABLE IF EXISTS `filtre`;
CREATE TABLE IF NOT EXISTS `filtre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mot` varchar(255) NOT NULL,
  `rp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `filtre`
--

INSERT INTO `filtre` (`id`, `mot`, `rp`) VALUES
(1, 'salut', ''),
(2, 'bonjour', ''),
(3, 'salut', 's*lut'),
(4, 'bonjour', 'b**jour');

-- --------------------------------------------------------

--
-- Structure de la table `holiday`
--

DROP TABLE IF EXISTS `holiday`;
CREATE TABLE IF NOT EXISTS `holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday` varchar(255) NOT NULL,
  `date_holiday` varchar(255) NOT NULL,
  `jour` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `holiday`
--

INSERT INTO `holiday` (`id`, `holiday`, `date_holiday`, `jour`) VALUES
(2, 'anniversaire du roi', '06/09/2021', '');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matiere` varchar(255) NOT NULL,
  `scolarite` int(11) NOT NULL,
  `temps` datetime NOT NULL,
  `cycle` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `matiere`, `scolarite`, `temps`, `cycle`) VALUES
(1, 'webmaster(BAC MIN)', 50000, '2021-11-29 16:38:01', 'DQP'),
(2, 'Genie Logiciel', 150000, '2022-03-13 22:30:46', 'BTS');

-- --------------------------------------------------------

--
-- Structure de la table `menbre`
--

DROP TABLE IF EXISTS `menbre`;
CREATE TABLE IF NOT EXISTS `menbre` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `niveau` varchar(250) NOT NULL,
  `specialite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` int(11) NOT NULL,
  `naissance` date NOT NULL,
  `lieu` varchar(30) NOT NULL,
  `sexe` char(1) NOT NULL,
  `password` text NOT NULL,
  `confirm` int(1) NOT NULL,
  `matricule` varchar(30) NOT NULL,
  `date_enreg` datetime NOT NULL,
  `session` varchar(30) NOT NULL,
  `confirmkey` varchar(255) NOT NULL,
  `residence` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `cycle` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `menbre`
--

INSERT INTO `menbre` (`id`, `first`, `last`, `photo`, `email`, `pseudo`, `niveau`, `specialite`, `age`, `naissance`, `lieu`, `sexe`, `password`, `confirm`, `matricule`, `date_enreg`, `session`, `confirmkey`, `residence`, `status`, `unique_id`, `cycle`) VALUES
(1, 'koa essama', 'PAUL', 'michael.jpg', 'qwe@yahoo.com', 'paul', 'BAC SCI', 'webmaster(BAC MIN)', 34, '2001-05-04', 'paris', 'M', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '21pula4168', '2021-11-29 16:39:31', 'SEPTEMBRE', '7ru aeol ipl9 a ouiellrp0au eolrilp 7elu palrio 7i pollre ua6ri eopl lau4rlie uopa l7ae i rllpou5la p ierlou7aliolpr u e3perla o lui6lialp  oeru', '', 'hors ligne', 238004004, ''),
(2, 'alexandra kaloft', 'laura speelchechk', 'mike.jpg', 'laura@yahoo.com', 'laura', 'BAC SCI', 'webmaster(BAC MIN)', 22, '2001-02-03', 'russie', 'F', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '21aalur1741', '2021-12-16 05:53:11', 'SEPTEMBRE', '5po euarill 0 aleou irpl8ulao ei lpr7ril ul apeo8i l leurpoa6l aeuoipl r7iloul a rep2pl r lieuoa9poil l euar1  aroieulpl1elpa  irolu3iuoalrp  le', '', 'hors ligne', 477529946, ''),
(3, 'pUAL', 'LORENNW', '\'Hyouka - Chitanda _ Oreki\' Poster by Lawliet1568.jfif', 'feder@yahoo.com', 'feder', 'PLUS..', 'webmaster(BAC MIN)', 22, '2001-02-03', 'YAOUNDE', 'M', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '22drefe1132', '2022-02-15 20:43:59', 'SEPTEMBRE', '1eaiolp u rl3pl l ioeura6p oealiur l1 ou eilralp4o elpu ailr8la ur eopil9larp  oeiul4e polur lai3lreu  lioap1 lelrp oaui3 aillpuer o7e pllouia r', '', 'hors ligne', 1332405042, ''),
(5, 'chris paul', 'allen', 'profile-avatar.jpg', 'chris@yahoo.com', 'chris', 'BAC SCI', 'webmaster(BAC MIN)', 23, '2022-03-15', 'yaounde', 'M', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '22crshi9262', '2022-03-13 22:15:17', 'SEPTEMBRE', '3iualorp  le8ai lurol ep5 oplearui l4lp aio lreu5plrie  aoul4lp leru aio6e lpo iraul3 li laeprou5pla  riuloe2lpi e ruola8arll ieo up4iulp oea lr', '', 'hors ligne', 791947009, ''),
(6, 'eder', 'aloys', 'mail-avatar.jpg', 'chris2@yahoo.com', 'palon', 'BAC', 'Genie Logiciel', 20, '1999-07-10', 'yaounde', 'M', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '22olpna3052', '2022-03-13 23:21:04', 'OCTOBRE', '0ul eirlo ap9leoluapr  i1 rleuia lpo5p  uolirlea7 reuoi lpla5peal u liro3puriol  lae7uoa l ieprl2epo aliul r0ie  opurlal9u lrilp oea9uoa le lpir', '', 'hors ligne', 1539446308, ''),
(7, 'father', 'paul', 'eǝ.png', 'paul@gmail.com', 'lmao', 'BAC SCI', 'Genie Logiciel', 22, '2003-05-04', 'yaounde', 'M', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '22aoml4511', '2022-04-11 06:24:34', 'SEPTEMBRE', '0aellr pu io8aeplui orl 2ieula  plro9poral  leui5ipouear l l5paul re oli2olal iu pre6rpi euoll a1u laolrpei 3iap l ouerl4 iuarolpe l4  erpolailu', '', 'hors ligne', 216788553, '');

-- --------------------------------------------------------

--
-- Structure de la table `menbres`
--

DROP TABLE IF EXISTS `menbres`;
CREATE TABLE IF NOT EXISTS `menbres` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `outcoming_id` int(11) NOT NULL,
  `temps` datetime NOT NULL,
  `message` text NOT NULL,
  `first` varchar(255) NOT NULL,
  `grade` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `outcoming_id`, `temps`, `message`, `first`, `grade`) VALUES
(1, 2, '2022-03-13 22:24:34', 'hey group', ' ', 'root');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `id_expediteur`, `id_destinataire`, `message`) VALUES
(1, 4, 4, 'bonjour zaz j\'aurais besoin d\'un tireur d\'elite pour tuer paul'),
(2, 4, 2, 'bonjour zaz j\'aurais besoin d\'un tireur d\'elite pour tuer paul'),
(3, 2, 2, 'salut'),
(4, 1, 2, 'bonjour le roi\r\n'),
(5, 1, 2, 'bonjour le roi'),
(6, 2, 1, 'mdrrr gros t\'es un ouf haha'),
(7, 2, 1, 'salut a tous '),
(8, 1, 4, 'victor mdrr tu delire c\'est trop ptn '),
(9, 1, 2, 'bonjour le roi comment allez-vous aujourdh\'ui\r\n'),
(10, 5, 6, 'eh paul!!'),
(11, 6, 5, 'hi felisa cv?'),
(12, 2, 1, 'oppopoppoppooo'),
(13, 2, 18, 'bonjour le nouveau c\'est  le roi'),
(14, 18, 2, 'ballec fdp'),
(15, 1, 18, 'bonjour toi cava?'),
(16, 2, 11, 'sasas'),
(17, 19, 17, 'bonjour janis'),
(18, 19, 16, 'sghdjkls;\'d'),
(19, 19, 16, 'sgfhjkl;\'lkjhgfdsfghjkl;kjhgfdsfghjkl;kjhgfds'),
(20, 19, 17, 'hjkl;lmn'),
(21, 24, 20, 'salut kureo suis un grand fan'),
(22, 20, 24, 'hmm'),
(23, 25, 20, 'salut frr'),
(24, 20, 25, 'salut jeremia'),
(25, 25, 20, 'j\'essaie de te joindre depuis mdrr mais t\'es ou encule?'),
(26, 44, 44, 'eh salut comment tu vas?\r\n'),
(27, 6, 67, './'),
(28, 76, 10, 'ehh\r\n\r\n'),
(29, 76, 6, 'n j lj jhbbjhb '),
(30, 76, 10, 'hjgjhjhhvjhfkjhfu'),
(31, 53, 6, 'yo\r\n'),
(32, 1, 2, 'yo\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `incoming_id` int(11) NOT NULL,
  `outcoming_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `tem` datetime NOT NULL,
  `lu` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `incoming_id`, `outcoming_id`, `msg`, `tem`, `lu`) VALUES
(2, 238004004, 477529946, 'hey hey', '0000-00-00 00:00:00', 0),
(3, 477529946, 238004004, 'hey bgette', '0000-00-00 00:00:00', 0),
(4, 238004004, 477529946, 'paul??', '0000-00-00 00:00:00', 0),
(5, 477529946, 238004004, 'bonjour', '0000-00-00 00:00:00', 0),
(6, 238004004, 1332405042, 'rh', '0000-00-00 00:00:00', 0),
(7, 477529946, 1332405042, 'youhou', '0000-00-00 00:00:00', 0),
(8, 477529946, 238004004, 'c\'etait quoi le mot de passe de l\'admin l\'aurtre jour ptdrr ? stp frero  :))', '0000-00-00 00:00:00', 0),
(9, 238004004, 791947009, 'hey', '0000-00-00 00:00:00', 0),
(10, 477529946, 791947009, 'hi', '0000-00-00 00:00:00', 0),
(11, 1332405042, 791947009, 'ohaho', '0000-00-00 00:00:00', 0),
(12, 238004004, 791947009, 'hey hey', '0000-00-00 00:00:00', 0),
(13, 477529946, 791947009, 'hou hou', '0000-00-00 00:00:00', 0),
(14, 238004004, 1539446308, 'hi paul', '0000-00-00 00:00:00', 0),
(15, 238004004, 216788553, 'sm,d', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `mobile_numbers`
--

DROP TABLE IF EXISTS `mobile_numbers`;
CREATE TABLE IF NOT EXISTS `mobile_numbers` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile_number` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=verified, 0=not verified',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `module` varchar(30) NOT NULL,
  `credit` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `temps` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `module`, `credit`, `unique_id`, `specialite`, `temps`) VALUES
(1, 'mathematiques', 4, 98, 'webmaster(BAC MIN)', '2021-12-08 04:44:24');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(30) NOT NULL,
  `note` int(11) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `temps` timestamp NOT NULL,
  `module` varchar(255) NOT NULL,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `matricule`, `note`, `specialite`, `session`, `pseudo`, `temps`, `module`, `first`, `last`) VALUES
(1, '21pula4168', 18, 'webmaster(BAC MIN)', 'SEPTEMBRE', 'paul', '2022-03-13 22:17:42', 'mathematiques', 'koa essama', 'PAUL');

-- --------------------------------------------------------

--
-- Structure de la table `note_decision`
--

DROP TABLE IF EXISTS `note_decision`;
CREATE TABLE IF NOT EXISTS `note_decision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `note1` int(11) NOT NULL,
  `note2` int(11) NOT NULL,
  `decision` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_expe` int(11) NOT NULL,
  `id_rec` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_en` datetime NOT NULL,
  `titre` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `categorie` varchar(30) NOT NULL,
  `date_note` datetime NOT NULL,
  `user` tinyint(1) NOT NULL,
  `user_message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `id_expe`, `id_rec`, `message`, `date_en`, `titre`, `tag`, `categorie`, `date_note`, `user`, `user_message`) VALUES
(1, 238004004, 477529946, '', '2021-12-16 05:56:57', '', '', '', '0000-00-00 00:00:00', 0, ''),
(2, 238004004, 477529946, '', '2021-12-18 12:37:43', '', '', '', '0000-00-00 00:00:00', 0, ''),
(3, 477529946, 238004004, '', '2021-12-18 12:38:23', '', '', '', '0000-00-00 00:00:00', 0, ''),
(4, 238004004, 477529946, '', '2021-12-18 12:40:32', '', '', '', '0000-00-00 00:00:00', 0, ''),
(5, 477529946, 238004004, '', '2022-02-03 23:41:39', '', '', '', '0000-00-00 00:00:00', 0, ''),
(6, 238004004, 1332405042, '', '2022-02-15 20:57:03', '', '', '', '0000-00-00 00:00:00', 0, ''),
(7, 477529946, 1332405042, '', '2022-02-15 20:57:21', '', '', '', '0000-00-00 00:00:00', 0, ''),
(8, 477529946, 238004004, '', '2022-02-23 10:05:38', '', '', '', '0000-00-00 00:00:00', 0, ''),
(9, 238004004, 791947009, '', '2022-03-13 22:18:47', '', '', '', '0000-00-00 00:00:00', 0, ''),
(10, 477529946, 791947009, '', '2022-03-13 22:18:56', '', '', '', '0000-00-00 00:00:00', 0, ''),
(11, 1332405042, 791947009, '', '2022-03-13 22:19:07', '', '', '', '0000-00-00 00:00:00', 0, ''),
(12, 238004004, 791947009, '', '2022-03-13 22:37:22', '', '', '', '0000-00-00 00:00:00', 0, ''),
(13, 477529946, 791947009, '', '2022-03-13 22:37:36', '', '', '', '0000-00-00 00:00:00', 0, ''),
(14, 238004004, 1539446308, '', '2022-03-13 23:23:10', '', '', '', '0000-00-00 00:00:00', 0, ''),
(15, 238004004, 216788553, '', '2022-04-13 10:38:56', '', '', '', '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `notif_en`
--

DROP TABLE IF EXISTS `notif_en`;
CREATE TABLE IF NOT EXISTS `notif_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `categorie` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `tag` varchar(30) NOT NULL,
  `date_note` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menbre` int(11) NOT NULL,
  `menbre_nom` varchar(255) NOT NULL,
  `menbre_mail` varchar(255) NOT NULL,
  `date_paiement` datetime NOT NULL,
  `txnid` varchar(255) NOT NULL,
  `montant` float NOT NULL,
  `n_card` varchar(30) NOT NULL,
  `card_cvv` varchar(30) NOT NULL,
  `card_month` varchar(30) NOT NULL,
  `card_year` varchar(30) NOT NULL,
  `bank_info_transaction` text NOT NULL,
  `method_paiement` varchar(30) NOT NULL,
  `status_paiement` varchar(30) NOT NULL,
  `id_paiement` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id`, `id_menbre`, `menbre_nom`, `menbre_mail`, `date_paiement`, `txnid`, `montant`, `n_card`, `card_cvv`, `card_month`, `card_year`, `bank_info_transaction`, `method_paiement`, `status_paiement`, `id_paiement`) VALUES
(1, 1, 'koa essama PAUL', 'qwe@yahoo.com', '2021-12-08 05:47:16', '', 40000, '', '', '', '', '&lt;p&gt;les chefs de terre a terre les dirigents&amp;nbsp;&lt;/p&gt;\r\n', 'Depot bancaire', 'effectue', 1638938836),
(2, 1, 'koa essama PAUL', 'qwe@yahoo.com', '2021-12-08 05:49:34', '', 30000, '', '', '', '', 'asdasd', 'Depot bancaire', 'effectue', 1638938974);

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

DROP TABLE IF EXISTS `pension`;
CREATE TABLE IF NOT EXISTS `pension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `solde` double NOT NULL,
  `reste` int(11) NOT NULL,
  `temps` timestamp NOT NULL,
  `tranche1` varchar(20) NOT NULL,
  `complete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pension`
--

INSERT INTO `pension` (`id`, `matricule`, `pseudo`, `session`, `filiere`, `solde`, `reste`, `temps`, `tranche1`, `complete`) VALUES
(1, '21wqre0274', 'qwer', 'SEPTEMBRE', 'web master(BAC MIN)', 50000, 0, '2021-10-20 12:09:06', 'TRANCHE 1', 0),
(2, '21wqre0274', 'qwer', 'SEPTEMBRE', 'Genie Logiciel', 100000, 0, '2021-10-20 12:09:47', 'TRANCHE 2', 0),
(3, '21wqre0274', 'qwer', 'SEPTEMBRE', 'web master(BAC MIN)', 1000, 0, '2021-10-20 12:11:08', 'TRANCHE 2', 1),
(4, '21wqre0274', 'qwer', 'SEPTEMBRE', 'web master(BAC MIN)', 2000, 0, '2021-10-20 12:15:17', 'TRANCHE 2', 1),
(5, '21wqre0274', 'qwer', 'SEPTEMBRE', 'web master(BAC MIN)', 1200, 0, '2021-10-20 12:19:42', 'TRANCHE 1', 1),
(6, '21wqre0274', 'qwer', 'SEPTEMBRE', 'web master(BAC MIN)', 12333, 0, '2021-10-20 12:20:02', 'TRANCHE 2', 1),
(7, '21ktncier0341', 'netrick', 'SEPTEMBRE', 'web master(BAC MIN)', 20000, 0, '2021-10-28 11:04:13', 'TRANCHE 1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `reponse` text NOT NULL,
  `id_menbre` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `mv1` varchar(30) NOT NULL,
  `mv2` varchar(30) NOT NULL,
  `mv3` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sanction`
--

DROP TABLE IF EXISTS `sanction`;
CREATE TABLE IF NOT EXISTS `sanction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `absence` int(11) NOT NULL,
  `sanction` varchar(30) NOT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `matricule` varchar(255) NOT NULL,
  `temps` timestamp NOT NULL,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  `jour` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sanction`
--

INSERT INTO `sanction` (`id`, `absence`, `sanction`, `pseudo`, `matricule`, `temps`, `first`, `last`, `jour`) VALUES
(1, 0, 'avertissement 1', 'chris', '22crshi9262', '2022-03-13 21:27:11', 'chris paul', 'allen', '0000-00-00'),
(2, 4, '', 'chris', '22crshi9262', '2022-03-13 21:27:43', 'chris paul', 'allen', '2022-03-10');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_details` text NOT NULL,
  `logo` varchar(30) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `favicon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deux_titre` varchar(50) NOT NULL,
  `affiche_admin` float NOT NULL,
  `affiche_etudiant` float NOT NULL,
  `affiche_enseignant` float NOT NULL,
  `affiche_ins` float NOT NULL,
  `n_1` int(11) NOT NULL,
  `n_2` int(11) NOT NULL,
  `n_3` int(11) NOT NULL,
  `n_4` int(11) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `newsletter` float NOT NULL,
  `author` varchar(10) NOT NULL,
  `n_name1` varchar(20) NOT NULL,
  `n_name2` varchar(20) NOT NULL,
  `n_name3` varchar(20) NOT NULL,
  `n_name4` varchar(20) NOT NULL,
  `copy` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `politique` text NOT NULL,
  `apropos` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `bank_details`, `logo`, `titre`, `favicon`, `deux_titre`, `affiche_admin`, `affiche_etudiant`, `affiche_enseignant`, `affiche_ins`, `n_1`, `n_2`, `n_3`, `n_4`, `localisation`, `phone`, `newsletter`, `author`, `n_name1`, `n_name2`, `n_name3`, `n_name4`, `copy`, `email`, `politique`, `apropos`) VALUES
(1, 'Bank Name: CCA Bank\r\nNuméro de compte: 1222320234444\r\nBranch Name: Cm Branch\r\nPays: Cameroun', '', 'ICI LES MURS SONT MOISIS LA SONORITE', '', '', 1, 1, 1, 1, 0, 0, 0, 0, '', '', 1, '', '', '', '', '', '', '', '<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;<span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\"><span style=\"box-sizing: border-box; font-weight: 700;\">Paul&nbsp;</span></span>vous a fait briller lors de vos journ&eacute;es sp&eacute;ciales sp&eacute;cialement pour les belles femmes. Notre objectif a toujours &eacute;t&eacute; de VOUS c&eacute;l&eacute;brer! Pour tirer le meilleur de vous, nous avons apport&eacute; une vaste collection, que vous assistiez &agrave; une f&ecirc;te, &agrave; un mariage et &agrave; tous ces &eacute;v&eacute;nements qui n&eacute;cessitent une robe WOW.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp; &nbsp;<span style=\"box-sizing: border-box; font-weight: 700; background-color: rgb(255, 255, 0);\">&Agrave; propos de nou</span><span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\">s</span></p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;Paul est un nouveau site de shopping de mode qui propose des produits de mode tendance &agrave; des prix addictifs. Nous pensons que la mode n&#39;est pas ce que vous portez mais ce que vous ressentez, donc en gardant cela &agrave; l&#39;esprit, nous vous avons propos&eacute; des v&ecirc;tements de cr&eacute;ateurs comprenant une large gamme de mod&egrave;les, de styles et d&#39;imprim&eacute;s pour r&eacute;pondre &agrave; toutes vos humeurs, caprices et fantaisies.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Notre vision</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Notre vision est de &laquo; pr&eacute;senter la beaut&eacute; en vous avec votre beau sourire &raquo; au monde avec la meilleure exp&eacute;rience de magasinage en ligne. Nous avons tri&eacute; sur le volet la collection de v&ecirc;tements pour femmes qui leur conviennent en fonction de leur type de corps, de leur teint, de leur budget et de leurs pr&eacute;f&eacute;rences en mati&egrave;re de style. Nous visons &agrave; offrir &agrave; nos clients une exp&eacute;rience d&#39;achat saine et tendance en temps r&eacute;el, en leur fournissant toutes les informations dont ils ont besoin concernant la coupe, le confort, le tissu et tout ce qui les pr&eacute;occupe pour chaque produit de nos collections, &agrave; travers des tableaux de tailles. Comprend &eacute;galement l&#39;introduction de nouveaux mod&egrave;les, styles et cat&eacute;gories ainsi que toute la mode qui se passe.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Pourquoi&nbsp;<span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\">Paul</span></p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Paul propose une large collection de saris, kurta kurtis, v&ecirc;tements, robes, hauts, leggings et plus encore. Toute la collection de notre site est enti&egrave;rement compos&eacute;e de v&ecirc;tements de cr&eacute;ateurs mis &agrave; jour avec les nouvelles tendances et le look du march&eacute; avec le plus grand catalogue de mode f&eacute;minine. Nous continuons d&#39;am&eacute;liorer notre technologie et notre assortiment de produits pour nous assurer que chaque femme profite de l&#39;exp&eacute;rience d&#39;achat la plus agr&eacute;able.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Nous nous assurons que vous obtenez les meilleures tenues de qualit&eacute; avec une politique de retour et d&#39;&eacute;change sans tracas. Nous nous assurons que ce que vous voyez est exactement ce que vous obtenez !</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Garantie de prix bas</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Si vous trouvez un prix inf&eacute;rieur sur une robe que nous proposons en ligne, nous l&#39;&eacute;galerons !</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Support client 24h/24 et 7j/7</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">E-Mail &acirc;&trade;&yen; Texte &acirc;&trade;&yen; Appel</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Nous sommes l&agrave; pour vous 24h/24 et 7j/7 en ligne et par t&eacute;l&eacute;phone.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Taille et couleur.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Nous proposons une gamme de couleurs et de tailles.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Livraison internationale</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Malheureusement, non. Nous fournissons notre service uniquement au cameroun.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Nous serions ravis de d&eacute;velopper notre activit&eacute; &agrave; l&#39;international bient&ocirc;t.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Retours faciles.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Vous avez achet&eacute; une tenue mais souhaitez la rendre ? Nous avons une politique de retour facile de 3 jours. Veuillez nous envoyer un e-mail &agrave;&nbsp;<span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\">mashashie@yahoo.com</span>&nbsp;pour plus de d&eacute;tails.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Des robes de r&ecirc;ve pour toutes les occasions</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\">Paul</span>&nbsp;propose tous soigneusement tri&eacute;s sur le volet par nos stylistes. Si vous &ecirc;tes int&eacute;ress&eacute; par un mod&egrave;le en particulier, veuillez nous envoyer un e-mail, nous ferons de notre mieux pour vous offrir la robe que vous aimez.</p>\r\n\r\n<blockquote>\r\n<h2 style=\"margin-left: 40px;\">&nbsp;&nbsp;&nbsp;&nbsp;<em><strong>Toutes nos transactions sont v&eacute;rifi&eacute;es et avec les normes de s&eacute;curit&eacute; les plus &eacute;lev&eacute;es. De plus, il y a aussi beaucoup &agrave; faire gr&acirc;ce &agrave; des offres et des cadeaux passionnants r&eacute;guliers, alors faites passer le mot et r&eacute;f&eacute;rez-nous &agrave; tout le monde de votre famille, amis et coll&egrave;gues et obtenez r&eacute;compens&eacute; pour cela. Et pour couronner le tout, vous pouvez partager votre exp&eacute;rience utilisateur en publiant des avis. N&#39;attendez plus Inscrivez-vous avec nous maintenant! commencez &agrave; traquer, commencez &agrave; acheter et commencez &agrave; aimer et commencez &agrave; pr&eacute;senter la beaut&eacute; en vous.</strong></em></h2>\r\n</blockquote>\r\n', '<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;<span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\"><span style=\"box-sizing: border-box; font-weight: 700;\">Paul&nbsp;</span></span>vous a fait briller lors de vos journ&eacute;es sp&eacute;ciales sp&eacute;cialement pour les belles femmes. Notre objectif a toujours &eacute;t&eacute; de VOUS c&eacute;l&eacute;brer! Pour tirer le meilleur de vous, nous avons apport&eacute; une vaste collection, que vous assistiez &agrave; une f&ecirc;te, &agrave; un mariage et &agrave; tous ces &eacute;v&eacute;nements qui n&eacute;cessitent une robe WOW.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp; &nbsp;<span style=\"box-sizing: border-box; font-weight: 700; background-color: rgb(255, 255, 0);\">&Agrave; propos de nou</span><span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\">s</span></p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;Paul est un nouveau site de shopping de mode qui propose des produits de mode tendance &agrave; des prix addictifs. Nous pensons que la mode n&#39;est pas ce que vous portez mais ce que vous ressentez, donc en gardant cela &agrave; l&#39;esprit, nous vous avons propos&eacute; des v&ecirc;tements de cr&eacute;ateurs comprenant une large gamme de mod&egrave;les, de styles et d&#39;imprim&eacute;s pour r&eacute;pondre &agrave; toutes vos humeurs, caprices et fantaisies.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Notre vision</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Notre vision est de &laquo; pr&eacute;senter la beaut&eacute; en vous avec votre beau sourire &raquo; au monde avec la meilleure exp&eacute;rience de magasinage en ligne. Nous avons tri&eacute; sur le volet la collection de v&ecirc;tements pour femmes qui leur conviennent en fonction de leur type de corps, de leur teint, de leur budget et de leurs pr&eacute;f&eacute;rences en mati&egrave;re de style. Nous visons &agrave; offrir &agrave; nos clients une exp&eacute;rience d&#39;achat saine et tendance en temps r&eacute;el, en leur fournissant toutes les informations dont ils ont besoin concernant la coupe, le confort, le tissu et tout ce qui les pr&eacute;occupe pour chaque produit de nos collections, &agrave; travers des tableaux de tailles. Comprend &eacute;galement l&#39;introduction de nouveaux mod&egrave;les, styles et cat&eacute;gories ainsi que toute la mode qui se passe.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Pourquoi&nbsp;<span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\">Paul</span></p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Paul propose une large collection de saris, kurta kurtis, v&ecirc;tements, robes, hauts, leggings et plus encore. Toute la collection de notre site est enti&egrave;rement compos&eacute;e de v&ecirc;tements de cr&eacute;ateurs mis &agrave; jour avec les nouvelles tendances et le look du march&eacute; avec le plus grand catalogue de mode f&eacute;minine. Nous continuons d&#39;am&eacute;liorer notre technologie et notre assortiment de produits pour nous assurer que chaque femme profite de l&#39;exp&eacute;rience d&#39;achat la plus agr&eacute;able.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Nous nous assurons que vous obtenez les meilleures tenues de qualit&eacute; avec une politique de retour et d&#39;&eacute;change sans tracas. Nous nous assurons que ce que vous voyez est exactement ce que vous obtenez !</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Garantie de prix bas</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Si vous trouvez un prix inf&eacute;rieur sur une robe que nous proposons en ligne, nous l&#39;&eacute;galerons !</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Support client 24h/24 et 7j/7</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">E-Mail &acirc;&trade;&yen; Texte &acirc;&trade;&yen; Appel</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Nous sommes l&agrave; pour vous 24h/24 et 7j/7 en ligne et par t&eacute;l&eacute;phone.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Taille et couleur.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Nous proposons une gamme de couleurs et de tailles.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Livraison internationale</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Malheureusement, non. Nous fournissons notre service uniquement au cameroun.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Nous serions ravis de d&eacute;velopper notre activit&eacute; &agrave; l&#39;international bient&ocirc;t.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Retours faciles.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Vous avez achet&eacute; une tenue mais souhaitez la rendre ? Nous avons une politique de retour facile de 3 jours. Veuillez nous envoyer un e-mail &agrave;&nbsp;<span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\">mashashie@yahoo.com</span>&nbsp;pour plus de d&eacute;tails.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">Des robes de r&ecirc;ve pour toutes les occasions</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"box-sizing: border-box; background-color: rgb(255, 255, 0);\">Paul</span>&nbsp;propose tous soigneusement tri&eacute;s sur le volet par nos stylistes. Si vous &ecirc;tes int&eacute;ress&eacute; par un mod&egrave;le en particulier, veuillez nous envoyer un e-mail, nous ferons de notre mieux pour vous offrir la robe que vous aimez.</p>\r\n\r\n<p style=\"box-sizing: border-box; font-family: Poppins; margin: 0px 0px 10px; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;Toutes nos transactions sont v&eacute;rifi&eacute;es et avec les normes de s&eacute;curit&eacute; les plus &eacute;lev&eacute;es. De plus, il y a aussi beaucoup &agrave; faire gr&acirc;ce &agrave; des offres et des cadeaux passionnants r&eacute;guliers, alors faites passer le mot et r&eacute;f&eacute;rez-nous &agrave; tout le monde de votre famille, amis et coll&egrave;gues et obtenez r&eacute;compens&eacute; pour cela. Et pour couronner le tout, vous pouvez partager votre exp&eacute;rience utilisateur en publiant des avis. N&#39;attendez plus Inscrivez-vous avec nous maintenant! commencez &agrave; traquer, commencez &agrave; acheter et commencez &agrave; aimer et commencez &agrave; pr&eacute;senter la beaut&eacute; en vous.</p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `site_users`
--

DROP TABLE IF EXISTS `site_users`;
CREATE TABLE IF NOT EXISTS `site_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_last` varchar(255) NOT NULL,
  `user_password` text NOT NULL,
  `user_admin` tinyint(4) NOT NULL,
  `naissance` date NOT NULL,
  `pays` varchar(30) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `apropos` text NOT NULL,
  `grade` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `site_users`
--

INSERT INTO `site_users` (`id`, `user_name`, `user_last`, `user_password`, `user_admin`, `naissance`, `pays`, `occupation`, `email`, `mobile`, `apropos`, `grade`, `pseudo`, `unique_id`, `status`, `photo`) VALUES
(1, '', '', '$2y$11$VG7AelIGKmNbW8BwDcV7m.Hdl622m5XPMFtCSLnLe2QJShG4dPsbi', 1, '0000-00-00', '', '', 'eden@yahoo.com', '', '', 'root', 'eden', 0, '', ''),
(2, '', '', '$2y$11$hIZZ3jBkHQxrZp6Jt4Zp1e4iLhNq5PVzBAJONmgDi4jBtxXxywvkq', 1, '0000-00-00', '', '', 'paul@yahoo.com', '', '', 'root', 'paul', 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `social`
--

DROP TABLE IF EXISTS `social`;
CREATE TABLE IF NOT EXISTS `social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `liens` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `social`
--

INSERT INTO `social` (`id`, `nom`, `icon`, `liens`) VALUES
(1, 'tweeter', '<a href=\"#\" class=\"twitter\"><i class=\"bx bxl-twitter\"></i></a>', 'https://www.facebook.com/pg/CFPAM/posts/'),
(2, 'facebook', '<a href=\"#\" class=\"facebook\"><i class=\"bx bxl-twitter\"></i></a>', 'https://www.facebook.com/pg/CFPAM/posts/'),
(3, 'yahoo', '', ''),
(4, 'whatsApp', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(20) NOT NULL,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `addresse` varchar(30) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `heures` int(11) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `date_debut` datetime NOT NULL,
  `password` text NOT NULL,
  `confirm` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `matricule`, `first`, `last`, `email`, `addresse`, `sexe`, `heures`, `specialite`, `date_debut`, `password`, `confirm`) VALUES
(1, '21STA5341', 'mashashie', 'paul', 'mashashie@yahoo.com', 'ekounou', 'M', 0, 'webmaster(BAC MIN)', '2021-12-08 05:43:04', '3e06306a698fa852172813a2fab35ffa1534b89e', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
