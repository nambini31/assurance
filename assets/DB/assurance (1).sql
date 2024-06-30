-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 30 juin 2024 à 16:44
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `assurance`
--

-- --------------------------------------------------------

--
-- Structure de la table `cabinet`
--

CREATE TABLE `cabinet` (
  `id_cabinet` int(11) NOT NULL,
  `nom_cabinet` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1 COMMENT '1 : actif , 2 : inactif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cabinet`
--

INSERT INTO `cabinet` (`id_cabinet`, `nom_cabinet`, `etat`, `created_at`, `updated_at`) VALUES
(1, 'Salle 088', 1, '2024-05-03 17:29:40', '2024-05-03 18:06:18'),
(2, 'jujuj', 1, NULL, NULL),
(3, 'Salle 02', 1, '2024-05-03 17:29:52', '2024-05-03 18:06:13');

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE `consultation` (
  `consultationId` int(11) NOT NULL,
  `titulaireId` int(11) NOT NULL,
  `docteurId` int(11) NOT NULL,
  `typeConsultationId` int(11) NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date DEFAULT NULL,
  `isFinished` int(11) NOT NULL DEFAULT 0 COMMENT '0 : encours ;\r\n1 : terminée'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detailconsultation`
--

CREATE TABLE `detailconsultation` (
  `detailConsultationId` int(11) NOT NULL,
  `consultationId` int(11) NOT NULL,
  `motif` text DEFAULT NULL,
  `personneMalade` varchar(50) DEFAULT NULL COMMENT 'titulaire ; conjointe ; enfant',
  `nomPersonneMalade` varchar(50) DEFAULT NULL,
  `etat` int(11) NOT NULL COMMENT '0:supprimé ; 1:non supprimé',
  `isFinished` int(11) NOT NULL DEFAULT 0,
  `dateParametre` date DEFAULT NULL,
  `dateDocteur` date DEFAULT NULL,
  `temperature` varchar(10) DEFAULT NULL,
  `tension` varchar(10) DEFAULT NULL,
  `poids` varchar(10) DEFAULT NULL,
  `douleur` text NOT NULL,
  `descriptionDouleur` text DEFAULT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detailmedicament`
--

CREATE TABLE `detailmedicament` (
  `detailMedicamentId` int(11) NOT NULL,
  `medicamentId` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `matin` varchar(50) DEFAULT NULL,
  `midi` varchar(50) DEFAULT NULL,
  `soir` varchar(50) DEFAULT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `docteur`
--

CREATE TABLE `docteur` (
  `docteurId` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enfant`
--

CREATE TABLE `enfant` (
  `enfantId` int(11) NOT NULL,
  `tiitulaireId` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `genre` varchar(6) NOT NULL,
  `dateNaiss` date DEFAULT NULL,
  `isActif` int(11) NOT NULL DEFAULT 1 COMMENT '0 : ne doit plus profité à cause du limite d''age .\r\n1 : doit profité(-20)',
  `etat` int(11) NOT NULL DEFAULT 1 COMMENT '0 : supprimé ;\r\n1 : non supprimé',
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `id_medecin` int(11) NOT NULL,
  `nom_medecin` varchar(255) NOT NULL,
  `id_specialite` int(11) NOT NULL,
  `id_cabinet` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1 COMMENT '1 : actif \r\n0: inactif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id_medecin`, `nom_medecin`, `id_specialite`, `id_cabinet`, `etat`, `created_at`, `updated_at`) VALUES
(7, '121212', 6, 1, 1, '2024-05-03 20:23:04', '2024-05-03 20:23:24'),
(1, 'Nico radoko', 8, 1, 1, '2024-05-03 20:14:06', '2024-05-04 21:31:56'),
(2, 'Nico radoko', 6, 1, 1, '2024-05-03 20:14:14', '2024-05-07 00:00:00'),
(8, 'fdfdf', 8, 1, 1, '2024-05-03 20:23:16', '2024-05-03 20:23:16'),
(9, 'Nico radoko', 5, 1, 1, '2024-05-04 21:31:53', '2024-05-04 21:31:53');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `nom_membre` varchar(255) NOT NULL,
  `contact_membre` varchar(20) NOT NULL,
  `email_membre` varchar(100) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `nom_membre`, `contact_membre`, `email_membre`, `etat`, `created_at`, `updated_at`) VALUES
(1, 'KUBO MADAGASCAR', '0344681572', 'nicotahindraza310501@gmail.com', 1, '2024-05-03 21:56:57', '2024-05-03 21:56:57'),
(2, 'NOVA', '0344681572', 'ARLETO SOCIETY', 1, '2024-05-03 21:59:47', '2024-05-04 16:34:44'),
(4, 'SCORE MADAGASCAR', 'fdsfdsfds', 'fdfdfds', 1, '2024-05-03 21:59:54', '2024-05-04 16:34:55'),
(5, 'LEADER PRICE', 'fdsfds', 'fdsfds', 1, '2024-05-03 21:59:58', '2024-05-04 16:35:03'),
(6, 'fdfd', 'fdfd', 'fdfd', 0, '2024-05-03 22:02:50', '2024-05-03 22:05:27'),
(7, 'nikoooo', '121212', 'hgffhfgh545', 0, '2024-05-03 22:03:01', '2024-05-03 22:04:12'),
(8, 'hghgggffgfgf', 'hghg', 'hghg', 0, '2024-05-03 22:03:13', '2024-05-03 22:05:25'),
(9, 'SUPPREME CENTER', 'gfgfg', 'gfgf', 1, '2024-05-03 22:05:21', '2024-05-04 16:35:14'),
(10, 'gfggfgfg', 'gfgfghhhhh', '', 0, '2024-05-03 22:05:32', '2024-05-04 16:35:17'),
(11, 'nicotahindraza310501@gmail.com', '0344681572', 'trtr', 1, '2024-05-04 21:32:09', '2024-05-04 21:32:09');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int(11) NOT NULL,
  `numero_patient` varchar(20) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `sexe` varchar(5) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `etat` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `numero_patient`, `nom`, `prenom`, `adresse`, `sexe`, `telephone`, `email`, `service`, `etat`, `created_at`, `updated_at`, `id_membre`) VALUES
(6, 'E0002', 'Aio', 'Aia', 'Tsimenatse II', '', '0349867852', 'joyce@gmail.com', 'Service Inforamtique', 'Non Assure', '2024-05-04 17:15:49', '2024-05-04 17:15:49', 1),
(5, 'E0001', 'Joels', 'Solofos', 'Tsimenatse', '', '0348975640', 'zahoavao@gmail.com', 'Service Inforamtique', 'Assure', '2024-05-04 17:15:49', '2024-05-04 17:15:49', 1);

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `id_specialite` int(11) NOT NULL,
  `nom_specialite` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1 COMMENT '1 : actif\r\n0 : inactif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id_specialite`, `nom_specialite`, `etat`, `created_at`, `updated_at`) VALUES
(5, 'nico', 1, '2024-05-03 19:28:37', '2024-05-03 19:28:37'),
(3, 'alefa leroa bro', 1, '2024-05-03 19:27:15', '2024-05-03 19:28:46'),
(8, 'fdfdfd', 1, '2024-05-03 19:29:30', '2024-05-03 20:42:10'),
(6, 'kokokoko', 1, '2024-05-03 19:29:09', '2024-05-03 19:29:09'),
(9, 'lklklklk', 1, '2024-06-07 10:55:06', '2024-06-07 10:55:06');

-- --------------------------------------------------------

--
-- Structure de la table `titulaire`
--

CREATE TABLE `titulaire` (
  `titulaireId` int(11) NOT NULL,
  `membreId` int(11) NOT NULL,
  `numCarte` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `genre` varchar(6) NOT NULL,
  `dateNaiss` date NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `cin` int(11) NOT NULL,
  `fonction` varchar(50) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `dateEmbauche` date NOT NULL,
  `dateDebauche` date DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `isActif` int(11) NOT NULL DEFAULT 1 COMMENT '0 : ne doit plus profiteé ; \r\n1 : doit profité',
  `etat` int(11) NOT NULL DEFAULT 1 COMMENT '0:supprimé ;\r\n1: non supprimé',
  `email` varchar(50) DEFAULT NULL,
  `nomPrenomConjoint` varchar(50) DEFAULT NULL,
  `dateNaissConjoint` date DEFAULT NULL,
  `telephoneConjoint` varchar(50) DEFAULT NULL,
  `genreConjoint` varchar(6) DEFAULT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp(),
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `titulaire`
--

INSERT INTO `titulaire` (`titulaireId`, `membreId`, `numCarte`, `nom`, `prenom`, `genre`, `dateNaiss`, `telephone`, `cin`, `fonction`, `adresse`, `dateEmbauche`, `dateDebauche`, `photo`, `isActif`, `etat`, `email`, `nomPrenomConjoint`, `dateNaissConjoint`, `telephoneConjoint`, `genreConjoint`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'E23', 'rkoto', 'biby', 'homme', '2015-06-03', '222222', 789546698, 'dveloppeur', 'anketa bas toliara', '2021-06-09', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, '2024-06-29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(255) DEFAULT NULL,
  `prenom_user` varchar(255) DEFAULT NULL,
  `mdp_user` varchar(255) NOT NULL,
  `role_user` varchar(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1 COMMENT '1:active ; 0:inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom_user`, `prenom_user`, `mdp_user`, `role_user`, `etat`, `created_at`, `updated_at`, `image`) VALUES
(1, 'R.', 'GEROC', 'milliard2024', 'admin', 1, NULL, NULL, '20240122134129_G-brico'),
(2, 'Tahindraza', 'molten', 'nico1234', 'simple', 0, NULL, NULL, '20240122151400_Tahindraza'),
(3, 'nico', 'nico', 'nico', 'simple', 1, NULL, NULL, 'icon.jpg'),
(4, 'A.', 'HASINA', '1321', 'admin', 1, NULL, NULL, 'icon.jpg'),
(5, 'R.', 'RONALD', '25864', 'simple', 1, NULL, NULL, 'icon.jpg'),
(6, ' ', 'DOLLIN', '200317', 'simple', 1, NULL, NULL, 'icon.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cabinet`
--
ALTER TABLE `cabinet`
  ADD PRIMARY KEY (`id_cabinet`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`consultationId`);

--
-- Index pour la table `detailconsultation`
--
ALTER TABLE `detailconsultation`
  ADD PRIMARY KEY (`detailConsultationId`);

--
-- Index pour la table `detailmedicament`
--
ALTER TABLE `detailmedicament`
  ADD PRIMARY KEY (`detailMedicamentId`);

--
-- Index pour la table `docteur`
--
ALTER TABLE `docteur`
  ADD PRIMARY KEY (`docteurId`);

--
-- Index pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD PRIMARY KEY (`enfantId`);

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id_medecin`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id_specialite`);

--
-- Index pour la table `titulaire`
--
ALTER TABLE `titulaire`
  ADD PRIMARY KEY (`titulaireId`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cabinet`
--
ALTER TABLE `cabinet`
  MODIFY `id_cabinet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `consultationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detailconsultation`
--
ALTER TABLE `detailconsultation`
  MODIFY `detailConsultationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detailmedicament`
--
ALTER TABLE `detailmedicament`
  MODIFY `detailMedicamentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `docteur`
--
ALTER TABLE `docteur`
  MODIFY `docteurId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enfant`
--
ALTER TABLE `enfant`
  MODIFY `enfantId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `id_medecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id_specialite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `titulaire`
--
ALTER TABLE `titulaire`
  MODIFY `titulaireId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
