-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 02 mai 2026 à 12:44
-- Version du serveur : 8.0.45
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `authentification_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `action_logs`
--

CREATE TABLE `action_logs` (
  `id` int NOT NULL,
  `action` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `details` text,
  `target_user_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `action_logs`
--

INSERT INTO `action_logs` (`id`, `action`, `created_at`, `details`, `target_user_id`, `user_id`) VALUES
(1, 'create user', '2026-05-01 20:16:49', 'utilisateur technicien créé', 3, 1),
(2, 'update active', '2026-05-01 20:21:25', 'active agent modifié', 2, 1),
(3, 'update active', '2026-05-01 20:21:27', 'active agent modifié', 2, 1),
(4, 'update active', '2026-05-01 20:21:28', 'active agent modifié', 2, 1),
(5, 'update active', '2026-05-02 08:09:48', 'active technicien modifié', 3, 1),
(6, 'update active', '2026-05-02 08:09:53', 'active technicien modifié', 3, 1),
(7, 'update user', '2026-05-02 08:11:32', 'utilisateur agent modifié', 2, 1),
(8, 'update user', '2026-05-02 08:11:38', 'utilisateur agent modifié', 2, 1),
(9, 'update user', '2026-05-02 08:11:48', 'utilisateur agent modifié', 2, 1),
(10, 'create user', '2026-05-02 08:17:04', 'utilisateur Nico123456! créé', 4, 1),
(11, 'update user', '2026-05-02 08:17:23', 'utilisateur Nico123456! modifié', 4, 1),
(12, 'update user', '2026-05-02 08:17:29', 'utilisateur Nico123456! modifié', 4, 1),
(13, 'delete user', '2026-05-02 08:18:33', 'utilisateur Nico123456! supprimé', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'agent'),
(2, 'technicien'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `mail` varchar(150) NOT NULL,
  `login` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `role_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `active`, `mail`, `login`, `password`, `created_at`, `last_login`, `role_id`) VALUES
(1, 'root', 'root', 1, 'root@gmail.com', 'root', '$2y$12$iLYTCWY4nD8iuQ7spVx0xeuUM0SB4sr8StRU4qMcLvey4qlWqC0cy', '2026-05-01 20:12:47', '2026-05-02 08:01:58', 3),
(2, 'agent', 'agent', 1, 'agent@gmail.com', 'agent', '$2y$10$YvD6ArUNZRzyuhULCR07IuFzcd4rtyYhVY3aNe/nrO6makTHObSQO', '2026-05-01 20:14:19', NULL, 1),
(3, 'technicien', 'technicien', 1, 'technicien@gmail.com', 'technicien', '$2y$10$jQAexCib14zlS8ZIIYJ98OOrjk0srMhh1jpDlwSlTVfVeUiq9a0sq', '2026-05-01 20:16:49', NULL, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
