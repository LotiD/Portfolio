-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 oct. 2023 à 16:43
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mon_portfolio_2`
--

-- --------------------------------------------------------

--
-- Structure de la table `accueil`
--

CREATE TABLE `accueil` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `accroche` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `apercu_titre_1` varchar(255) DEFAULT NULL,
  `apercu_accroche_1` text DEFAULT NULL,
  `apercu_description_1` text DEFAULT NULL,
  `apercu_titre_2` varchar(255) DEFAULT NULL,
  `apercu_accroche_2` text DEFAULT NULL,
  `apercu_description_2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `accueil`
--

INSERT INTO `accueil` (`id`, `nom`, `prenom`, `accroche`, `description`, `apercu_titre_1`, `apercu_accroche_1`, `apercu_description_1`, `apercu_titre_2`, `apercu_accroche_2`, `apercu_description_2`) VALUES
(1, 'Loti modif', 'Didier', 'Les temps changent le monde évolue.', 'Je suis un aspirant développeur full-stack. Passionné par le dessin et récemment je me lance dans l\'art digital.', 'Qui suis-je ?', 'Cliquez pour me connaître un peu mieux !', 'Vous pourrez aussi avoir mon CV à la fin.', 'Portfolio', 'Vous pouvez trouvez mes travaux ici.', 'Dessins, projets, code. Vous y trouverez un peu de tout ici.');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `accroche` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `accroche`) VALUES
(1, 'Vous pouvez me contacter juste en dessous.');

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `slogan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cv`
--

INSERT INTO `cv` (`id`, `slogan`) VALUES
(1, 'Les temps changent, le monde évolue.');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `nom` varchar(255) NOT NULL,
  `annee_debut` year(4) NOT NULL,
  `annee_fin` year(4) DEFAULT NULL,
  `description` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`nom`, `annee_debut`, `annee_fin`, `description`, `id`) VALUES
('BUT MMI', 2021, 2024, 'Le Bachelor Universitaire Technologique est une formation pluridisciplinaire. m', 1),
('Baccalauréat Générale Spé Maths - NSI', 2019, 2021, 'Je fais partie de la 1ère génération qui a passé le nouveau bac.', 2);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `nom`, `prenom`, `email`, `contenu`, `type`, `date_creation`) VALUES
(1, 'LOTI', 'DIDIER', 'processeurciboulot@gmail.com', 'yegqkfeglquygeqkufkyugefukyqgfukygqkyuegukgk', 'etudiant', '2023-04-13 22:06:01'),
(3, 'Test', 'Test', 'processeurciboulot@gmail.com', 'ftgyhujifctgvbhkotrdfybkl', 'professionnel', '2023-04-14 13:45:40'),
(4, 'Test', 'Test', 'processeurciboulot@gmail.com', 'ftgyhujifctgvbhkotrdfybkl', 'professionnel', '2023-04-14 13:47:25'),
(5, 'Roch', 'Annadour&eacute;', 'processeurciboulot@gmail.com', 'gyfeyugfugyfegefyugzugz', 'professionnel', '2023-04-14 13:59:27');

-- --------------------------------------------------------

--
-- Structure de la table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `accroche` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `portfolio`
--

INSERT INTO `portfolio` (`id`, `accroche`) VALUES
(1, 'Code, dessins, projets y a de tout');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` int(11) NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `nom_projet`, `description`, `image`) VALUES
(7, 'Projet 1', 'Ceci est le projet 1', 'uploads/3 aimee.jpg'),
(9, 'Projet 2', 'Ceci est le projet 2', 'uploads/14 Kaneki.jpg'),
(11, 'Projet 4', 'Ceci est le projet 4', 'uploads/3 aimee.jpg'),
(12, 'Roch', 'Annadouré', 'uploads/17 Naruto sasuke sakura.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE `skills` (
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `skills`
--

INSERT INTO `skills` (`titre`, `description`, `id`) VALUES
('Développement Web', 'Je pratique de l\'HTML,CSS, JS et notamment du PHP. J\'ai eu l\'occasion d\'utiliser REACT et Node.js', 1),
('Création Numérique', 'Lors de mon BUT j\'ai pu concevoir différents visuels selon les attentes des différents clients', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accueil`
--
ALTER TABLE `accueil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accueil`
--
ALTER TABLE `accueil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
