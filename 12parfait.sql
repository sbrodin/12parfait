--
-- Structure de la table `bet`
--

CREATE TABLE IF NOT EXISTS `bet` (
  `bet_id` int(11) unsigned NOT NULL,
  `match_id` int(11) NOT NULL,
  `score` varchar(255) NOT NULL,
  `result` set('1','N','2') NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `championship`
--

CREATE TABLE IF NOT EXISTS `championship` (
  `championship_id` int(11) unsigned NOT NULL,
  `sport` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `championship`
--

INSERT INTO `championship` (`championship_id`, `sport`, `country`, `level`, `name`, `year`) VALUES
(1, 'football', 'france', 1, 'Ligue 1 2016-2017', 2016),
(2, 'football', 'france', 1, 'Ligue 1 2017-2018', 2017);

-- --------------------------------------------------------

--
-- Structure de la table `championship_team`
--

CREATE TABLE IF NOT EXISTS `championship_team` (
  `championship_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `championship_team`
--

INSERT INTO `championship_team` (`championship_id`, `team_id`, `group`) VALUES
(1, 1, NULL),
(1, 3, NULL),
(1, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `league`
--

CREATE TABLE IF NOT EXISTS `league` (
  `league_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL
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
  `match_id` int(11) unsigned NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `score` varchar(255) DEFAULT NULL,
  `result` set('1','N','2') DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `team`
--

INSERT INTO `team` (`team_id`, `name`) VALUES
(1, 'Rennes'),
(2, 'Nantes'),
(3, 'Caen'),
(4, 'Angers'),
(5, 'Paris SG'),
(6, 'Marseille'),
(7, 'Monaco'),
(8, 'Bordeaux'),
(9, 'Lyon'),
(10, 'Lille'),
(11, 'Nancy'),
(12, 'Metz'),
(13, 'Bastia'),
(14, 'Saint-Etienne'),
(15, 'Montpellier'),
(16, 'Lorient'),
(17, 'Guingamp'),
(18, 'Toulouse'),
(19, 'Dijon'),
(20, 'Nice');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL,
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
  `score` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `acl`, `active`, `first_name`, `last_name`, `user_name`, `email`, `password`, `language`, `add_date`, `last_connection`, `hash`, `date_hash`, `score`) VALUES
(1, 'admin', 1, 'Stanislas', 'Brodin', 'Mist3rJingl', 'stanislas.brodin@gmail.com', '$2y$10$.hBN4BCO6RfUm9PDrnG8SeNgzJoKkSgZE2cKFqzaT2hwyjkcRMdYm', 'fr', '2015-11-26 10:26:11', '2016-07-13 14:33:44', NULL, NULL, 0),
(7, 'user', 1, '', '', '', 'contact@sebastien-muller.Fr', '$2y$10$UPp.Vzd7PShqdaSD.4dcquPcGoI2N7Aj6YKmHkddlcWNqXiorCAYu', 'fr', '2016-06-23 13:40:12', '2016-06-23 13:40:41', NULL, NULL, 0),
(8, 'user', 1, '', '', '', 'test@test.com', '$2y$10$KjhIwJyRo2JDW.XAb13uy.gHBe8SDUUxCAwBAJID810CYeuxRF3Ny', 'fr', '2016-07-07 13:37:39', '2016-07-12 19:22:37', NULL, NULL, 0),
(9, 'user', 1, 'Test2', 'Test', '', 'test2@test.com', '$2y$10$UX6Qz6JapabUQfdiAJlNgOf/ReNaErmD9pjM1nZpLIzfAPFjqxZRe', 'fr', '2016-07-07 15:24:29', '2016-07-07 15:27:03', NULL, NULL, 0);

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

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bet`
--
ALTER TABLE `bet`
  ADD PRIMARY KEY (`bet_id`);

--
-- Index pour la table `championship`
--
ALTER TABLE `championship`
  ADD PRIMARY KEY (`championship_id`),
  ADD UNIQUE KEY `sport` (`sport`,`country`,`level`,`year`);

--
-- Index pour la table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_activity_idx` (`timestamp`);

--
-- Index pour la table `league`
--
ALTER TABLE `league`
  ADD PRIMARY KEY (`league_id`);

--
-- Index pour la table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`match_id`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bet`
--
ALTER TABLE `bet`
  MODIFY `bet_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `championship`
--
ALTER TABLE `championship`
  MODIFY `championship_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `league`
--
ALTER TABLE `league`
  MODIFY `league_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `match`
--
ALTER TABLE `match`
  MODIFY `match_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
