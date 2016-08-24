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

--
-- Contenu de la table `championship`
--

INSERT INTO `championship` (`championship_id`, `sport`, `country`, `level`, `name`, `year`) VALUES
(1, 'football', 'france', 1, 'Ligue 1 2016-2017', 2016),
(2, 'football', 'france', 1, 'Ligue 1 2017-2018', 2017),
(3, 'football', 'france', 2, 'Ligue 2 2016-2017', 2016),
(4, 'football', 'france', 1, 'Ligue 1 2015-2016', 2015),
(5, 'football', 'france', 2, 'Ligue 2 2015-2016', 2015);

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
(3, 27, NULL),
(3, 26, NULL),
(3, 34, NULL),
(3, 40, NULL),
(3, 22, NULL),
(3, 36, NULL),
(3, 25, NULL),
(3, 21, NULL),
(3, 28, NULL),
(3, 31, NULL),
(3, 37, NULL),
(3, 39, NULL),
(3, 35, NULL),
(3, 38, NULL),
(3, 33, NULL),
(3, 23, NULL),
(3, 24, NULL),
(3, 30, NULL),
(3, 29, NULL),
(3, 32, NULL),
(1, 4, NULL),
(1, 13, NULL),
(1, 8, NULL),
(1, 3, NULL),
(1, 19, NULL),
(1, 17, NULL),
(1, 10, NULL),
(1, 16, NULL),
(1, 9, NULL),
(1, 6, NULL),
(1, 12, NULL),
(1, 7, NULL),
(1, 15, NULL),
(1, 11, NULL),
(1, 2, NULL),
(1, 20, NULL),
(1, 5, NULL),
(1, 1, NULL),
(1, 14, NULL),
(1, 18, NULL),
(4, 4, NULL),
(4, 13, NULL),
(4, 8, NULL),
(4, 3, NULL),
(4, 25, NULL),
(4, 17, NULL),
(4, 10, NULL),
(4, 16, NULL),
(4, 9, NULL),
(4, 6, NULL),
(4, 7, NULL),
(4, 15, NULL),
(4, 2, NULL),
(4, 20, NULL),
(4, 5, NULL),
(4, 33, NULL),
(4, 1, NULL),
(4, 14, NULL),
(4, 18, NULL),
(4, 29, NULL),
(5, 27, NULL),
(5, 34, NULL),
(5, 40, NULL),
(5, 22, NULL),
(5, 36, NULL),
(5, 42, NULL),
(5, 19, NULL),
(5, 41, NULL),
(5, 21, NULL),
(5, 28, NULL),
(5, 31, NULL),
(5, 12, NULL),
(5, 11, NULL),
(5, 37, NULL),
(5, 39, NULL),
(5, 43, NULL),
(5, 38, NULL),
(5, 23, NULL),
(5, 30, NULL),
(5, 32, NULL);

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

--
-- Contenu de la table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `user_agent`, `timestamp`, `data`) VALUES
('1e867eaf522174cc6c19a21b4b3130d947518346', '192.168.1.4', '', 1471967879, '__ci_last_regenerate|i:1471964302;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 14:11:36";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}championship|s:1:"5";fixture|s:2:"13";'),
('1f4973a50835e190445ef50f196edccd8ec81b78', '192.168.1.4', '', 1472028537, '__ci_last_regenerate|i:1472025029;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 19:02:14";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}championship|s:1:"5";fixture|s:2:"12";'),
('243295d12b82d277cc890e2032896c0350cc50d1', '192.168.1.4', '', 1471945267, '__ci_last_regenerate|i:1471941791;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 10:35:02";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}championship|s:1:"4";'),
('4f1b3199c8ffad826a2dbebb939bca2dbef78e0d', '192.168.1.4', '', 1471871735, '__ci_last_regenerate|i:1471868281;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$.hBN4BCO6RfUm9PDrnG8SeNgzJoKkSgZE2cKFqzaT2hwyjkcRMdYm";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-22 13:15:34";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:34:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";}'),
('5f90543a20e12714f0690787db4e21fec581bc1e', '192.168.1.4', '', 1471954181, '__ci_last_regenerate|i:1471950641;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 11:50:54";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}championship|s:1:"4";'),
('5faad216077c6489cbbf33b5eee9751dee10b1bd', '192.168.1.4', '', 1471875444, '__ci_last_regenerate|i:1471871875;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$.hBN4BCO6RfUm9PDrnG8SeNgzJoKkSgZE2cKFqzaT2hwyjkcRMdYm";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-22 14:18:06";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:34:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";}'),
('75a60c25f27f241850b39718b8752b7be7ac6f09', '192.168.1.4', '', 1471945908, '__ci_last_regenerate|i:1471945388;user|O:8:"stdClass":15:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 11:43:11";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";s:18:"add_date_formatted";s:10:"26/11/2015";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}'),
('a31b2120c9b1ad0e8cabff8309414df2cbe04764', '192.168.1.4', '', 1471955948, '__ci_last_regenerate|i:1471954292;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 13:10:45";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}fixture|i:13;championship|s:1:"4";'),
('c78dfd56d9b363fefe1aabd4846bc0230e3ab4d3', '192.168.1.4', '', 1471941637, '__ci_last_regenerate|i:1471938265;championship|s:1:"4";user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 09:57:17";s:4:"hash";s:255:"yVlqrhIUeQEj0F1o9d8IO60ThF5W45EmotMhkMP9nbxc9DOya8i0PeZfdcvnlGoo7xCffvzA6DcCvF7iBdOVgQZiK4LXyE1u6rJNgWbJZtNRNRpzpQ7jXkWIUrdasX5LYcLFvwseUWTGkR3VCMAfw1aAUlBT2hoXqxlSdPeTw1mimCMtcrk4A6zLnHYwVxGRqnubbU8NOY7PJpma0OGKZqgY75NgHHBufzKrQ8ttG6y4vFJp83j2qV3ZWszywjI";s:9:"date_hash";s:19:"2016-08-23 10:27:12";s:5:"score";s:1:"0";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}'),
('dece5e92cc183307794706fb842017ad67c9febd', '192.168.1.4', '', 1471972671, '__ci_last_regenerate|i:1471971730;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 18:01:04";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}championship|s:1:"5";fixture|s:2:"12";'),
('e7eddd7501fc455503a8f4311f19e8eabbe1c06d', '192.168.1.4', '', 1471971660, '__ci_last_regenerate|i:1471968061;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-23 16:58:25";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:36:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";i:34;s:11:"add_fixture";i:35;s:12:"edit_fixture";}championship|s:1:"5";fixture|s:2:"12";'),
('ec1b1cb4a59afa1dc043b247ad67d32b7d29dd22', '192.168.1.4', '', 1471880565, '__ci_last_regenerate|i:1471879765;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-22 17:13:58";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:34:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";}'),
('f4d3c187b01cba359de36d080d79e358dc3a1285', '192.168.1.4', '', 1471878838, '__ci_last_regenerate|i:1471875596;user|O:8:"stdClass":14:{s:7:"user_id";s:1:"1";s:3:"acl";s:5:"admin";s:6:"active";s:1:"1";s:10:"first_name";s:9:"Stanislas";s:9:"last_name";s:6:"Brodin";s:9:"user_name";s:11:"Mist3rJingl";s:5:"email";s:26:"stanislas.brodin@gmail.com";s:8:"password";s:60:"$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O";s:8:"language";s:2:"fr";s:8:"add_date";s:19:"2015-11-26 10:26:11";s:15:"last_connection";s:19:"2016-08-22 16:19:59";s:4:"hash";N;s:9:"date_hash";N;s:5:"score";s:1:"0";}acl|a:34:{i:0;s:9:"admin_all";i:1;s:8:"add_user";i:2;s:10:"view_users";i:3;s:9:"view_user";i:4;s:9:"edit_user";i:5;s:13:"activate_user";i:6;s:15:"deactivate_user";i:7;s:12:"promote_user";i:8;s:11:"demote_user";i:9;s:7:"add_bet";i:10;s:9:"view_bets";i:11;s:8:"view_bet";i:12;s:8:"edit_bet";i:13;s:10:"delete_bet";i:14;s:10:"add_league";i:15;s:12:"view_leagues";i:16;s:11:"view_league";i:17;s:11:"edit_league";i:18;s:13:"delete_league";i:19;s:16:"add_championship";i:20;s:18:"view_championships";i:21;s:17:"view_championship";i:22;s:17:"edit_championship";i:23;s:19:"delete_championship";i:24;s:8:"add_team";i:25;s:10:"view_teams";i:26;s:9:"view_team";i:27;s:9:"edit_team";i:28;s:11:"delete_team";i:29;s:9:"add_match";i:30;s:11:"view_matchs";i:31;s:10:"view_match";i:32;s:10:"edit_match";i:33;s:12:"delete_match";}');

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

--
-- Contenu de la table `fixture`
--

INSERT INTO `fixture` (`fixture_id`, `fixture_name`, `fixture_championship_id`) VALUES
(10, '10ème journée', 4),
(11, '1ère journée', 1),
(1, '1ère journée', 4),
(12, '1ère journée', 5),
(2, '2ème journée', 4),
(13, '2ème journée', 5),
(3, '3ème journée', 4),
(4, '4ème journée', 4),
(5, '5ème journée', 4),
(6, '6ème journée', 4),
(7, '7ème journée', 4),
(8, '8ème journée', 4),
(9, '9ème journée', 4);

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

--
-- Contenu de la table `match`
--

INSERT INTO `match` (`match_id`, `team1_id`, `team2_id`, `score`, `result`, `date`, `fixture_id`) VALUES
(1, 38, 42, NULL, NULL, '2015-07-31 21:00:00', 12),
(2, 34, 22, NULL, NULL, '2015-07-31 21:00:00', 12),
(3, 27, 19, NULL, NULL, '2015-07-31 21:00:00', 12),
(4, 40, 28, NULL, NULL, '2015-07-31 21:00:00', 12),
(5, 39, 32, NULL, NULL, '2015-07-31 21:00:00', 12),
(6, 36, 23, NULL, NULL, '2015-07-31 21:00:00', 12),
(7, 37, 41, NULL, NULL, '2015-07-31 21:00:00', 12),
(8, 43, 21, NULL, NULL, '2015-07-31 21:00:00', 12),
(9, 12, 31, NULL, NULL, '2015-08-01 21:00:00', 12),
(10, 11, 30, NULL, NULL, '2015-08-03 21:00:00', 12);

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

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
(20, 'Nice'),
(21, 'Laval'),
(22, 'Brest'),
(23, 'Sochaux'),
(24, 'Strasbourg'),
(25, 'GFC Ajaccio'),
(26, 'Amiens'),
(27, 'AC Ajaccio'),
(28, 'Le Havre'),
(29, 'Troyes'),
(30, 'Tours FC'),
(31, 'Lens'),
(32, 'Valenciennes'),
(33, 'Reims'),
(34, 'Auxerre'),
(35, 'Orléans'),
(36, 'Clermont Foot'),
(37, 'Nîmes'),
(38, 'Red Star'),
(39, 'Niort'),
(40, 'Bourg-en-Bresse'),
(41, 'ETG'),
(42, 'Créteil'),
(43, 'Paris FC'),
(44, 'Bourg-Péronnas');

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

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `acl`, `active`, `first_name`, `last_name`, `user_name`, `email`, `password`, `language`, `add_date`, `last_connection`, `hash`, `date_hash`, `score`) VALUES
(1, 'admin', 1, 'Stanislas', 'Brodin', 'Mist3rJingl', 'stanislas.brodin@gmail.com', '$2y$10$dTT5wLyKV3OvFpNu3pAQQeu9g4HR6KU9FJuWt3LMKrMOmsqLP043O', 'fr', '2015-11-26 10:26:11', '2016-08-24 09:50:33', NULL, NULL, 0),
(7, 'user', 1, '', '', '', 'contact@sebastien-muller.Fr', '$2y$10$UPp.Vzd7PShqdaSD.4dcquPcGoI2N7Aj6YKmHkddlcWNqXiorCAYu', 'fr', '2016-06-23 13:40:12', '2016-06-23 13:40:41', NULL, NULL, 0),
(8, 'user', 1, '', '', '', 'test@test.com', '$2y$10$KjhIwJyRo2JDW.XAb13uy.gHBe8SDUUxCAwBAJID810CYeuxRF3Ny', 'fr', '2016-07-07 13:37:39', '2016-07-12 19:22:37', NULL, NULL, 0),
(9, 'user', 1, 'Test2', 'Test', '', 'test2@test.com', '$2y$10$UX6Qz6JapabUQfdiAJlNgOf/ReNaErmD9pjM1nZpLIzfAPFjqxZRe', 'fr', '2016-07-07 15:24:29', '2016-07-20 14:41:04', NULL, NULL, 0);

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
