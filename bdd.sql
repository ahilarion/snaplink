--
-- Structure de la table `urls`
--

CREATE TABLE `urls` (
  `uuid` char(36) NOT NULL,
  `user_uuid` char(36) DEFAULT NULL,
  `long_url` text,
  `short_url` varchar(255) DEFAULT NULL,
  `click_count` int(11) DEFAULT '0',
  `disabled` tinyint(1) DEFAULT '0',
  `link_type` enum('url','file') DEFAULT 'url',
  `file_name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `urls`
--
DELIMITER $$
CREATE TRIGGER `before_insert_urls` BEFORE INSERT ON `urls` FOR EACH ROW SET NEW.uuid = IFNULL(NEW.uuid, UUID())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `uuid` char(36) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `users`
--
DELIMITER $$
CREATE TRIGGER `before_insert_users` BEFORE INSERT ON `users` FOR EACH ROW SET NEW.uuid = IFNULL(NEW.uuid, UUID())
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `user_uuid` (`user_uuid`),
  ADD KEY `uuid_index` (`uuid`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `uuid_index` (`uuid`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `urls`
--
ALTER TABLE `urls`
  ADD CONSTRAINT `urls_ibfk_1` FOREIGN KEY (`user_uuid`) REFERENCES `users` (`uuid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
