-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Mer 24 Août 2016 à 11:14
-- Version du serveur :  5.6.23-log
-- Version de PHP :  5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stanislas_veille_12parfait`
--

-- --------------------------------------------------------

--
-- Structure de la table `bet`
--

CREATE TABLE IF NOT EXISTS `bet` (
  `bet_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `score` varchar(255) NOT NULL,
  `result` set('1','N','2') NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`bet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `championship`
--

CREATE TABLE IF NOT EXISTS `championship` (
  `championship_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sport` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`championship_id`),
  UNIQUE KEY `sport` (`sport`,`country`,`level`,`year`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `championship_team`
--

CREATE TABLE IF NOT EXISTS `championship_team` (
  `championship_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL DEFAULT '',
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `last_activity_idx` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fixture`
--

CREATE TABLE IF NOT EXISTS `fixture` (
  `fixture_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fixture_name` varchar(255) NOT NULL,
  `fixture_championship_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`fixture_id`),
  UNIQUE KEY `fixture_name` (`fixture_name`,`fixture_championship_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `league`
--

CREATE TABLE IF NOT EXISTS `league` (
  `league_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`league_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `league_championship`
--

CREATE TABLE IF NOT EXISTS `league_championship` (
  `league_id` int(11) NOT NULL,
  `championship_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE IF NOT EXISTS `match` (
  `match_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `score` varchar(255) DEFAULT NULL,
  `result` set('1','N','2') DEFAULT NULL,
  `date` datetime NOT NULL,
  `fixture_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`match_id`),
  UNIQUE KEY `team1_id` (`team1_id`,`team2_id`,`fixture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `acl` set('admin','moderator','user') NOT NULL,
  `active` tinyint(1) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `user_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `language` set('fr','en') NOT NULL DEFAULT 'fr',
  `add_date` datetime NOT NULL,
  `last_connection` datetime DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `date_hash` datetime DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user_bet`
--

CREATE TABLE IF NOT EXISTS `user_bet` (
  `user_id` int(11) NOT NULL,
  `bet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user_league`
--

CREATE TABLE IF NOT EXISTS `user_league` (
  `user_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `role` set('leader','follower') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
