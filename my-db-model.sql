-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 19 avr. 2021 à 13:25
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `e_shop_21`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `description`, `price`, `hours`, `image`, `categorie_id`) VALUES
(1, 'Algos', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo ut quaerat perferendis reiciendis quam velit dicta molestiae itaque dignissimos, cumque facere laudantium qui optio at, numquam, animi aliquam repudiandae. Distinctio.', 100, 10, 'http://via.placeholder.com/640x360', 2),
(2, 'Dojos', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo ut quaerat perferendis reiciendis quam velit dicta molestiae itaque dignissimos, cumque facere laudantium qui optio at, numquam, animi aliquam repudiandae. Distinctio.', 150, 15, 'http://via.placeholder.com/640x360', 2),
(3, 'PHP & MySql', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo ut quaerat perferendis reiciendis quam\r\n                velit dicta molestiae itaque dignissimos, cumque facere laudantium qui optio at, numquam, animi aliquam\r\n                repudiandae. Distinctio.', 140, 20, 'http://via.placeholder.com/640x360', 2),
(4, 'REACT.JS', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo ut quaerat perferendis reiciendis quam\r\n                velit dicta molestiae itaque dignissimos, cumque facere laudantium qui optio at, numquam, animi aliquam\r\n                repudiandae. Distinctio.', 140, 20, 'http://via.placeholder.com/640x360', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(1, 'frontend'),
(2, 'backend');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_id`) VALUES
(4, 'plop', '64a4e8faed1a1aa0bf8bf0fc84938d25', 1),
(6, 'plopinette', '64a4e8faed1a1aa0bf8bf0fc84938d25', 2);

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `article_id`) VALUES
(11, 4, 4),
(12, 4, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_article_categorie` (`categorie_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_role` (`role_id`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_wishlist_user` (`user_id`),
  ADD KEY `FK_wishlist_article` (`article_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_article_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FK_wishlist_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_wishlist_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);