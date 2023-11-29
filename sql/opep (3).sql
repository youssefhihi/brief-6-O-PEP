-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 29 nov. 2023 à 19:48
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `opep`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'hanging'),
(2, 'Succulents'),
(4, 'SKKS');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `plante_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `utilisateur_id`, `plante_id`) VALUES
(10, 128, 2);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_plante` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plante`
--

CREATE TABLE `plante` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `plante`
--

INSERT INTO `plante` (`id`, `nom`, `image`, `prix`, `categorie_id`) VALUES
(2, 'walida', './images/admin2.png', 49, 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nom` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `nom`) VALUES
(1, 'Admin'),
(2, 'Client');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `password`, `role_id`) VALUES
(109, 'qd', 'ezdz', 'dqdqs@gq.cis', '$2y$10$P3yFEV3gJAjjvXy.XbaK1.NNq0J6YYBqEZl5UMV.3DVe347HR1u/6', 2),
(115, 'ksdsd', 'jhdb', 'hqbdqs@gqs.co', '$2y$10$nQGQM45qpHfVohHZNFiwj.cFT1oBWnVD594VKdPK6oYm4Q1q1E1K.', 1),
(116, 'dksvndkjfksd', 'sdndksnkfsd', 'Hihji@gmail.com', '$2y$10$bMuJAjkVEicBxFKr0r1thuKXT6qclo5ldlqEVq7wmAtDN1589f66i', 2),
(117, 'dksvndkjfksd', 'sdndksnkfsd', 'Hiqhi@gmail.com', '$2y$10$NJIoIGyfNs9UKr5r8bVPR.AkhWrDUfsB8wDUtLqRYJuNYKMBgKi3G', 2),
(118, 'ssssssssssss', 'ssssssssssssssss', 'Hihhji@gmail.com', '$2y$10$CNB5gwYDFFu49eMTacdgQuLLHfbhlvBp53n9dm7WsDfVoAYHc81Ye', 1),
(119, 'fghjk', 'fghjkl', 'll5575sss982@gmail.com', '$2y$10$xPoT7uQ.aNw37c8pUrPxS.dFgOCUbg6KePXyAP0fpBMg3dI0F/qKO', 1),
(120, 'Youssef', 'Hihi', 'youssefhihi182@gmail.com', '$2y$10$5FUI0KGNFeht.v2mcRESqOmqi65NgnE14QkA1lNeTtJmMq5/9a/3q', 1),
(121, 'sivak', 'youssef', 'sivak@gmail.com', '$2y$10$hlyfJRrSYyNY1J3KrvUW0O4tFuSdi3ezoDxiVUx9jMbfxlrwSE7CS', 2),
(122, 'dksvndkjfksd', 'ssssssssssssssss', 'bbbb@gm.cj', '$2y$10$TOX8Ly7dbD2YapsLl2hRjOJhppihup.Ke8VE.E/7UJ0WydAS44Nx2', 1),
(124, 'aya', 'aya', 'aya@ndj.jsh', '$2y$10$Fsl6msph.ZU2xL9pLcrBJOfzoULShCvjbNXBI7n.rCuHck12yBo7W', 2),
(125, 'anwar', 'anwar', 'anwar@ff.hh', '$2y$10$F9DBIHVw87b4uTuGWrJYb.Ef1aBupeojka4vNOabqsxQbPI9F6NuS', 2),
(126, 'ana', 'ana', 'ana@gmail.com', '$2y$10$AL4qL6qOD9vvcvxUGY1c9OJVnOPJovGfjVS3uebtSeO6.1NT9.0QW', 2),
(128, 'Youssef', 'HAMID', 'HAMID@gmail.com', '$2y$10$mopopxLSb6e807W3SzO7kOBzzM7vyD4hFfHZe.NhgoU9cjiYy3346', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `plante_id` (`plante_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `panier_ibfk_2` (`id_plante`);

--
-- Index pour la table `plante`
--
ALTER TABLE `plante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorie_id` (`categorie_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `plante`
--
ALTER TABLE `plante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`plante_id`) REFERENCES `plante` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_plante`) REFERENCES `plante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `plante`
--
ALTER TABLE `plante`
  ADD CONSTRAINT `fk_categorie_id` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
