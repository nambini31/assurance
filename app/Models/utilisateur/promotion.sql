-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 03 jan. 2024 à 15:31
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bricodb`
--

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_promotion` int(11) NOT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `unite_promo` varchar(6) DEFAULT NULL,
  `reduction` double DEFAULT NULL,
  `id_article` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `designation`, `date_debut`, `date_fin`, `unite_promo`, `reduction`, `id_article`) VALUES
(1, 'Black Friday', '2023-12-01', '2024-12-03', '%', 20, '1,2,3,4'),
(5, 'Independance Day', '2024-06-01', '2024-06-30', '%', 12, '16,17'),
(18, 'Halowins Day', '2024-01-10', '2024-01-26', '%', 17, '16,17'),
(38, 'Paque Promo', '2024-01-03', '2024-01-26', '%', 12, '16,17,19'),
(39, 'Valentins Day', '2024-01-03', '2024-01-27', '%', 1200, '16,17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promotion`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
