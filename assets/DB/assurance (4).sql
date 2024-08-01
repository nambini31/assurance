-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 août 2024 à 10:07
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
  `description` text DEFAULT NULL,
  `ispaye` tinyint(1) NOT NULL DEFAULT 1,
  `motifBloque` text DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `nom_membre`, `contact_membre`, `email_membre`, `description`, `ispaye`, `motifBloque`, `etat`, `created_at`, `updated_at`) VALUES
(1, 'KUBO MADAGASCAR', '0344681572', 'nicotahindraza310501@gmail.com', 'gfgfgf', 1, NULL, 1, '2024-05-03 21:56:57', '2024-05-03 21:56:57'),
(2, 'NOVA', '0344681572', 'ARLETO SOCIETY', 'gfgf', 0, 'tsy nahavoaloa trosa', 1, '2024-05-03 21:59:47', '2024-05-04 16:34:44'),
(4, 'SCORE MADAGASCAR', 'fdsfdsfds', 'fdfdfds', NULL, 1, NULL, 1, '2024-05-03 21:59:54', '2024-05-04 16:34:55'),
(5, 'LEADER PRICE', 'fdsfds', 'fdsfds', NULL, 0, 'societé fa rava', 1, '2024-05-03 21:59:58', '2024-05-04 16:35:03'),
(6, 'fdfd', 'fdfd', 'fdfd', NULL, 1, NULL, 1, '2024-05-03 22:02:50', '2024-05-03 22:05:27'),
(7, 'nikoooo', '121212', 'hgffhfgh545', 'gfgfg', 0, 'tsy nahavoaloa tsosa', 1, '2024-05-03 22:03:01', '2024-07-01 18:32:36'),
(8, 'hghgggffgfgf', 'hghg', 'hghg', NULL, 1, NULL, 0, '2024-05-03 22:03:13', '2024-06-28 18:18:12'),
(9, 'SUPPREME CENTER', 'gfgfg', 'gfgf', NULL, 0, 'tsy nandoa trosa 3mois', 0, '2024-05-03 22:05:21', '2024-06-28 18:18:08'),
(10, 'gfggfgfg', 'gfgfghhhhh', '', NULL, 1, NULL, 0, '2024-05-03 22:05:32', '2024-06-28 18:17:59'),
(11, 'nicotahindraza310501@gmail.com', '0344681572', 'trtr', NULL, 1, NULL, 0, '2024-05-04 21:32:09', '2024-06-28 18:18:03'),
(12, 'essai ', '031452555', 'nicotahindraza310501@gmail.com', 'nico121d212sd', 0, NULL, 0, '2024-06-28 18:18:28', '2024-06-28 18:26:54'),
(13, 'fdfdfd', 'fdfdfd', 'fdfdfd', 'nao leroa cgccgd', 1, 'kokookoo', 0, '2024-06-28 18:27:00', '2024-06-29 06:48:02');

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
-- Structure de la table `rapportexamenmedical`
--

CREATE TABLE `rapportexamenmedical` (
  `ExamenId` int(11) NOT NULL,
  `etablissement` text DEFAULT NULL,
  `genre` varchar(45) DEFAULT NULL,
  `nomPrenom` varchar(45) DEFAULT NULL,
  `dateNaiss` date DEFAULT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `dateExamen` date DEFAULT NULL,
  `docteurExamen` varchar(45) DEFAULT NULL,
  `poids` varchar(45) DEFAULT NULL,
  `taille` varchar(45) DEFAULT NULL,
  `TAG` varchar(45) DEFAULT NULL,
  `IMC` varchar(45) DEFAULT NULL,
  `TAD` varchar(45) DEFAULT NULL,
  `avantCorrectionOD` varchar(45) DEFAULT NULL,
  `avantCorrectionOG` varchar(45) DEFAULT NULL,
  `apresCorrectionOD` varchar(45) DEFAULT NULL,
  `apresCorrectionOG` varchar(45) DEFAULT NULL,
  `acuiteAuditive` varchar(45) DEFAULT NULL,
  `antecedentMedicauxPersonnels` longtext DEFAULT NULL,
  `antecedentMedicauxFamiliaux` tinytext DEFAULT NULL,
  `antecedentChirurgicaux` longtext DEFAULT NULL,
  `antecedentGynecoObsetrique` longtext DEFAULT NULL,
  `aspectSainAgeIndique` varchar(4) DEFAULT NULL,
  `malformationMutilations` varchar(4) DEFAULT NULL,
  `commentairesAspectGeneral` text DEFAULT NULL,
  `goitre` varchar(4) DEFAULT NULL,
  `languePharynxAmygdalesAnormale` varchar(4) DEFAULT NULL,
  `affectionYeux` varchar(4) DEFAULT NULL,
  `affectionAuditif` varchar(4) DEFAULT NULL,
  `commentaireORL_OPHTALMOLOGIE` longtext DEFAULT NULL,
  `affectionBuccoDentaire` varchar(4) DEFAULT NULL,
  `etatDentaire` varchar(45) DEFAULT NULL,
  `commentaireStomatologieque` longtext DEFAULT NULL,
  `respiratoireLimite` varchar(4) DEFAULT NULL,
  `percussionAnormales` varchar(4) DEFAULT NULL,
  `ausculationAnormaux` varchar(4) DEFAULT NULL,
  `voixVoilee` varchar(4) DEFAULT NULL,
  `commentairesRespiratoire` longtext DEFAULT NULL,
  `bruitsCoeuModifie` varchar(4) DEFAULT NULL,
  `souffleCardiaque` varchar(4) DEFAULT NULL,
  `poulesInferieursPercus` varchar(4) DEFAULT NULL,
  `souffleArteresCervicales` varchar(4) DEFAULT NULL,
  `commentairesCardioVasculaire` longtext DEFAULT NULL,
  `palpationPathologique` varchar(4) DEFAULT NULL,
  `hepatomegalie` varchar(4) DEFAULT NULL,
  `splenomegalie` varchar(4) DEFAULT NULL,
  `hernie` varchar(4) DEFAULT NULL,
  `hemorroide` varchar(4) DEFAULT NULL,
  `commentairesDigestif` longtext DEFAULT NULL,
  `alcoolismeTabagisme` varchar(4) DEFAULT NULL,
  `antecedentsOrganesGenito` varchar(4) DEFAULT NULL,
  `indicesAffectionOrganesGenitauxM` varchar(4) DEFAULT NULL,
  `gynecomastie` varchar(4) DEFAULT NULL,
  `indicesAffectionOrganesGenitauxF` varchar(4) DEFAULT NULL,
  `modificationAnormalSeins` varchar(4) DEFAULT NULL,
  `commentairesGenitoUrinaire` longtext DEFAULT NULL,
  `urineAspect` longtext DEFAULT NULL,
  `urineAlbumine` longtext DEFAULT NULL,
  `urineGlucose` longtext DEFAULT NULL,
  `urineLEU` longtext DEFAULT NULL,
  `urineNIT` longtext DEFAULT NULL,
  `urineSG` longtext DEFAULT NULL,
  `urinePH` longtext DEFAULT NULL,
  `urinePRO` longtext DEFAULT NULL,
  `urineKET` longtext DEFAULT NULL,
  `urineURO` longtext DEFAULT NULL,
  `reflexePupillaires` varchar(4) DEFAULT NULL,
  `signesDystonie` varchar(4) DEFAULT NULL,
  `troublesPsychique` varchar(4) DEFAULT NULL,
  `commentairesSystemeNerveux` longtext DEFAULT NULL,
  `ictereCyanose` varchar(4) DEFAULT NULL,
  `eruptionUlcerationKyste` varchar(4) DEFAULT NULL,
  `ganglionsLymphatiques` varchar(4) DEFAULT NULL,
  `cicatricesTatouages` varchar(4) DEFAULT NULL,
  `tophusXanthome` varchar(4) DEFAULT NULL,
  `commentairespeau` longtext DEFAULT NULL,
  `affectionOs` varchar(4) DEFAULT NULL,
  `commentairesSquelette` longtext DEFAULT NULL,
  `repercussionProffessionelles` varchar(4) DEFAULT NULL,
  `commentairesRepercussionProfessionnelles` longtext DEFAULT NULL,
  `etatSanteConsidere` varchar(45) DEFAULT NULL,
  `remarquesSpeciales` longtext DEFAULT NULL,
  `villeExamen` varchar(50) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `etatExamen` int(11) NOT NULL DEFAULT 0 COMMENT '0:enttente validation docteur; 1: validée;',
  `isDeleted` int(11) NOT NULL DEFAULT 1 COMMENT '0: supprimé; 1:nom'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rapportexamenmedical`
--

INSERT INTO `rapportexamenmedical` (`ExamenId`, `etablissement`, `genre`, `nomPrenom`, `dateNaiss`, `profession`, `adresse`, `dateExamen`, `docteurExamen`, `poids`, `taille`, `TAG`, `IMC`, `TAD`, `avantCorrectionOD`, `avantCorrectionOG`, `apresCorrectionOD`, `apresCorrectionOG`, `acuiteAuditive`, `antecedentMedicauxPersonnels`, `antecedentMedicauxFamiliaux`, `antecedentChirurgicaux`, `antecedentGynecoObsetrique`, `aspectSainAgeIndique`, `malformationMutilations`, `commentairesAspectGeneral`, `goitre`, `languePharynxAmygdalesAnormale`, `affectionYeux`, `affectionAuditif`, `commentaireORL_OPHTALMOLOGIE`, `affectionBuccoDentaire`, `etatDentaire`, `commentaireStomatologieque`, `respiratoireLimite`, `percussionAnormales`, `ausculationAnormaux`, `voixVoilee`, `commentairesRespiratoire`, `bruitsCoeuModifie`, `souffleCardiaque`, `poulesInferieursPercus`, `souffleArteresCervicales`, `commentairesCardioVasculaire`, `palpationPathologique`, `hepatomegalie`, `splenomegalie`, `hernie`, `hemorroide`, `commentairesDigestif`, `alcoolismeTabagisme`, `antecedentsOrganesGenito`, `indicesAffectionOrganesGenitauxM`, `gynecomastie`, `indicesAffectionOrganesGenitauxF`, `modificationAnormalSeins`, `commentairesGenitoUrinaire`, `urineAspect`, `urineAlbumine`, `urineGlucose`, `urineLEU`, `urineNIT`, `urineSG`, `urinePH`, `urinePRO`, `urineKET`, `urineURO`, `reflexePupillaires`, `signesDystonie`, `troublesPsychique`, `commentairesSystemeNerveux`, `ictereCyanose`, `eruptionUlcerationKyste`, `ganglionsLymphatiques`, `cicatricesTatouages`, `tophusXanthome`, `commentairespeau`, `affectionOs`, `commentairesSquelette`, `repercussionProffessionelles`, `commentairesRepercussionProfessionnelles`, `etatSanteConsidere`, `remarquesSpeciales`, `villeExamen`, `createdAt`, `updatedAt`, `etatExamen`, `isDeleted`) VALUES
(8, 'GMS', 'M', 'Jp', '0000-00-00', '', '', '2024-07-15', 'Dr Santatra', '', '', '', '', '', '', '', '', '', 'Mauvaise', '', '', '', '', 'Non', 'Non', '', 'Non', 'Non', 'Non', 'Non', '', 'Non', NULL, '', 'Non', 'Non', 'Non', 'Non', '', 'Non', 'Non', 'Non', 'Non', '', 'Non', 'Non', 'Non', 'Non', 'Non', '', 'Non', 'Non', NULL, 'Non', NULL, 'Non', '', '', '', '', '', '', '', '', '', '', '', 'Non', 'Non', 'Non', '', 'Non', 'Non', 'Non', 'Non', 'Non', '', 'Non', '', 'Non', 'Existe-t-il une répercussion des occupations proffessionnells ou autres sur létat de santé ?', 'MEDIOCRE', '', 'Toliara', '2024-07-21 08:54:02', '2024-07-26 19:02:33', 0, 0),
(9, 'GMS', 'Mlle', 'biby Be', '2024-07-19', 'Agent de Sécurité', 'yu', '2024-07-21', 'Dr Julia', '63.6 00 kg', '1.70 m', '10.6', '', '11.5', '10', '10', '', '', 'Bonne', 'dfdf dfdf', 'dfdf dfdf', 'dfdf dfdf', 'fdf dfdf', 'Oui', 'Oui', 'fdfdf dfdf', 'Oui', 'Oui', 'Oui', 'Oui', 'dfdf dfdfdf', 'Oui', NULL, 'dfdf ddfdf', 'Oui', 'Oui', 'Oui', 'Oui', 'fdfd dfdf', 'Oui', 'Oui', 'Oui', 'Oui', '', 'Oui', 'Oui', 'Oui', 'Oui', 'Oui', 'dfdf dfdf', 'Oui', 'Oui', 'Oui', 'Oui', 'Oui', 'Oui', 'dfdfd dfdfdf', 'doire', 'Nég', 'Nég', '2+', 'Nég', '1.020', '6', 'Nég', 'Nég', 'Nég', 'Oui', 'Oui', 'Oui', 'SYSTEME NERVEUX', 'Oui', 'Oui', 'Oui', 'Oui', 'Oui', 'PEAU', 'Oui', '', 'Oui', '', 'BON', 'REMARQUES SPECIALES ET SUGGESTIONS DU MEDCIN\r\n', 'Tana', '2024-07-21 03:42:22', '2024-07-26 19:02:02', 0, 0),
(12, 'GMS', NULL, 'biby Be', '0000-00-00', '', '', '2024-07-21', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', 'BON', '', 'Toliara', '2024-07-22 10:11:36', '2024-07-30 09:34:17', 0, 1),
(13, '', NULL, 'biby Be', '0000-00-00', '', '', '2024-07-22', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', 'MEDIOCRE', '', '', '2024-07-22 10:15:27', '2024-07-22 11:16:03', 1, 1),
(14, 'GMS', 'Mlle', 'biby Be', '2024-01-25', 'Agent de Sécurité', 'yu', '2024-07-22', 'Dr Santatra', '63.6 00 kg', '1.70 m', '10.6', '120', '11.5', '10', '2', '', '', 'Sourde', '', '', '', '', 'Oui', 'Oui', '', NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '', 'Oui', NULL, 'Oui', NULL, '', 'Oui', 'Oui', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'doire', 'Nég', 'Nég', '2+', 'Nég', '1.020', '6', 'Nég', 'Nég', 'Nég', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', 'BON', '', 'Toliara', '2024-07-22 14:55:15', '2024-07-30 09:36:46', 0, 1),
(15, 'GMS', NULL, 'biby Be', '0000-00-00', '', '', '2024-07-30', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', NULL, '', '', '2024-07-30 09:57:39', '2024-07-30 09:57:39', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `roleId` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`roleId`, `name`) VALUES
(1, 'Phychiste'),
(2, 'Parametre'),
(3, 'Docteur'),
(4, 'Infirmier'),
(5, 'SuperAdmin');

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
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `titulaire`
--

INSERT INTO `titulaire` (`titulaireId`, `membreId`, `numCarte`, `nom`, `prenom`, `genre`, `dateNaiss`, `telephone`, `cin`, `fonction`, `adresse`, `dateEmbauche`, `dateDebauche`, `photo`, `isActif`, `etat`, `email`, `nomPrenomConjoint`, `dateNaissConjoint`, `telephoneConjoint`, `genreConjoint`, `createdAt`, `updatedAt`) VALUES
(9, 1, '', '', '', 'homme', '0000-00-00', '', 0, '', '', '0000-00-00', '0000-00-00', NULL, 1, 1, '', '', '0000-00-00', '', 'homme', '2024-07-01 20:44:43', '2024-07-01 20:44:43'),
(10, 1, '', '', '', 'homme', '0000-00-00', '', 0, '', '', '0000-00-00', '0000-00-00', '_20240701215708.png', 1, 1, '', '', '0000-00-00', '', 'homme', '2024-07-01 21:57:08', '2024-07-01 21:57:08'),
(11, 1, '', '', '', 'homme', '0000-00-00', '', 0, '', '', '0000-00-00', '0000-00-00', '_20240701220011.png', 1, 1, '', '', '0000-00-00', '', 'homme', '2024-07-01 22:00:11', '2024-07-01 22:00:11'),
(12, 1, '', '', '', 'homme', '0000-00-00', '', 0, '', '', '0000-00-00', '0000-00-00', '_20240701220157.png', 1, 1, '', '', '0000-00-00', '', 'homme', '2024-07-01 22:01:57', '2024-07-01 22:01:57'),
(13, 2, '', 'Pierre ', '', 'homme', '0000-00-00', '', 0, '', '', '0000-00-00', '0000-00-00', 'Pierre _20240702092040.png', 1, 1, '', '', '0000-00-00', '', 'homme', '2024-07-02 09:20:40', '2024-07-02 09:20:40'),
(14, 0, '', 'Pierre ', '', 'homme', '0000-00-00', '', 0, '', '', '0000-00-00', '0000-00-00', 'Pierre _20240702092240.png', 1, 1, '', '', '0000-00-00', '', 'homme', '2024-07-02 09:22:40', '2024-07-02 09:22:40'),
(15, 0, '', 'Pierre', '', 'homme', '0000-00-00', '', 0, '', '', '0000-00-00', '0000-00-00', 'Pierre_20240702092323.png', 1, 1, '', '', '0000-00-00', '', 'homme', '2024-07-02 09:23:23', '2024-07-02 09:23:23');

-- --------------------------------------------------------

--
-- Structure de la table `typemedecin`
--

CREATE TABLE `typemedecin` (
  `idTypeMedecin` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `typemedecin`
--

INSERT INTO `typemedecin` (`idTypeMedecin`, `name`) VALUES
(1, 'Generaliste'),
(2, 'Dentiste');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(255) DEFAULT NULL,
  `prenom_user` varchar(255) DEFAULT NULL,
  `mdp_user` varchar(255) NOT NULL,
  `roleId` int(11) NOT NULL,
  `idTypeMedecin` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 1 COMMENT '1:active ; 0:inactive',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom_user`, `prenom_user`, `mdp_user`, `roleId`, `idTypeMedecin`, `etat`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Tahindrazans', 'moltens', 'admin', 1, NULL, 1, NULL, '2024-06-30 14:19:39', '20240629212335_Tahindraza way'),
(2, 'Tahindrazan', 'molten', 'nico1234', 1, NULL, 1, NULL, '2024-06-29 21:10:34', '20240629211034_Tahindrazan'),
(3, 'Fortuna', 'fortuna', 'dtAdmin1234', 5, NULL, 1, NULL, '2024-06-29 21:23:59', '20240629212359_nico'),
(4, 'A.', 'HASINAInfi', '1321', 4, NULL, 1, NULL, NULL, 'icon.jpg'),
(5, 'R.', 'RONALD', '1234', 3, 1, 1, NULL, NULL, 'icon.jpg'),
(6, ' ', 'DOLLIN', '200317', 3, 2, 1, NULL, NULL, 'icon.jpg'),
(7, 'Tahindraza', 'molten', 'nico1234', 1, NULL, 0, '2024-06-29 20:57:15', '2024-06-29 21:03:18', '20240629205715_Tahindraza'),
(8, 'Tahindraza', 'geroc', 'milliard2024', 1, NULL, 1, '2024-06-29 21:02:52', '2024-06-29 21:02:52', 'icon.jpg'),
(9, 'Tahindraza', 'molten', 'nico1234', 1, NULL, 0, '2024-06-29 21:03:42', '2024-06-29 21:08:15', '20240629210342_Tahindraza'),
(10, 'Tahindrazan', 'molten', 'nico1234', 1, NULL, 0, '2024-06-29 21:08:56', '2024-06-29 21:09:08', '20240629210856_Tahindrazan'),
(11, 'Tahindrazapp', 'geroc', 'nico', 3, 2, 0, '2024-06-29 21:25:11', '2024-06-29 21:46:09', '20240629214359_Tahindrazapp'),
(12, 'Tahindraza', 'gerocp', 'nico', 1, NULL, 1, '2024-06-29 21:46:38', '2024-06-30 14:19:52', '20240630141952_Tahindraza');

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
  ADD PRIMARY KEY (`enfantId`),
  ADD KEY `titulaire` (`tiitulaireId`);

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
-- Index pour la table `rapportexamenmedical`
--
ALTER TABLE `rapportexamenmedical`
  ADD PRIMARY KEY (`ExamenId`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleId`);

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
-- Index pour la table `typemedecin`
--
ALTER TABLE `typemedecin`
  ADD PRIMARY KEY (`idTypeMedecin`);

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
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `rapportexamenmedical`
--
ALTER TABLE `rapportexamenmedical`
  MODIFY `ExamenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id_specialite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `titulaire`
--
ALTER TABLE `titulaire`
  MODIFY `titulaireId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `typemedecin`
--
ALTER TABLE `typemedecin`
  MODIFY `idTypeMedecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enfant`
--
ALTER TABLE `enfant`
  ADD CONSTRAINT `titulaire` FOREIGN KEY (`tiitulaireId`) REFERENCES `titulaire` (`titulaireId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
