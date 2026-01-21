-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 21 jan. 2026 à 19:59
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
-- Base de données : `sitetomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `image` varchar(250) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `author`, `title`, `description`, `status`, `image`, `user_id`, `created_at`, `deleted_at`) VALUES
(4, 'zineb', 'Milk & honey', 'Le livre \"Milk and Honey\" de Rupi Kaur est une collection de poésie et de prose qui explore des thèmes profonds tels que la survie, l’amour, la perte, l’abus et la féminité. Rupi Kaur partage son parcours à travers la douleur, la guérison et l’acceptation de soi. En fin de compte, elle montre que la douceur existe même dans les expériences amères. Le livre se déroule en quatre chapitres, chacun se concentrant sur différents aspects de la douleur émotionnelle. Les lecteurs se lancent dans une exploration de moments dévastateurs, contrastés par des moments de douceur.', 1, 'image4.jpg', 4, '2025-12-22 18:08:57', '2026-01-08 15:42:09'),
(5, 'Elabaster', 'Ester', 'Le livre d\'Esther est un récit historique qui se déroule dans l\'empire perse, où les Juifs d\'exil sont dispersés. L\'histoire suit Esther, une Juive qui est choisie par le roi Assuérus pour devenir reine, et son cousin Mardochée, qui refuse de se prosterner devant le vizir Haman, qui projette d\'exterminer tous les Juifs du royaume. Esther, après avoir été informée du complot par Mardochée, persuade le roi d\'annuler l\'édit et sauve ainsi la population juive. Ce livre est un exemple de la providence divine et de la capacité d\'une seule personne à changer des vies et des nations.', 1, 'uploads/livres/148cb48c72e2e322179d9ba90dec84fc.jpg', 5, '2025-12-22 17:51:32', NULL),
(6, 'Beth', 'Wabi', 'Le livre \"Wabi Sabi\" de Beth Kempton explore le concept japonais du wabi sabi, qui est une réponse intuitive à la beauté qui reflète la véritable nature de la vie. Ce concept esthétique et spirituel met en avant l\'imperfection, l\'impermanence et l\'incomplétude des choses. Le livre propose des étapes pratiques pour appliquer le wabi sabi dans la vie quotidienne, comme simplifier son espace et sa vie pour plus de beauté, se reconnecter avec la nature pour trouver l\'équilibre et la sagesse, et adopter un état d\'esprit qui nous permet de trouver le contentement dans le moment présent.', 1, 'uploads/livres/c5fde35cbd38ce2884bdbbd692bed60a.jpg', 6, '2025-12-22 18:06:11', NULL),
(7, 'Nathan Williams', 'The Kinfolk Table', 'The Kinfolk Table : Recipes for Small Gatherings est un livre de cuisine visuellement époustouflant qui met l\'accent sur la simplicité et la beauté de la cuisine, accompagnées d\'histoires personnelles. De nombreux lecteurs apprécient son attrait esthétique et la nature invitante des recettes, qui conviennent à des réunions décontractées plutôt qu\'à des préparations de repas élaborées. Cependant, certains expriment leur déception quant à l\'accent mis sur le style de vie plutôt que sur la nourriture, estimant que le livre manque de substance et de diversité dans son contenu.', 1, 'image2.jpg', 7, '2025-12-22 18:01:38', NULL),
(9, 'el hammouti', 'zineb', 'une histoire', 1, 'image4.jpg', 4, '2026-01-08 15:59:01', '2026-01-13 23:51:42'),
(10, 'natacha', 'la nuit des temps', 'la nuit des temps', 1, 'image4.jpg', 4, '2026-01-09 17:27:42', '2026-01-14 22:18:09'),
(11, 'Mark Manson', 'The Subtle Art Of Not Giving', 'Le message du livre consiste à donner la priorité à ce qui est important, à laisser de côté le futile et à trouver un bonheur authentique. Il allie humour, récits de la vie réelle et conseils pratiques pour vous aider à découvrir vos valeurs fondamentales.', 1, 'uploads/livres/366543b967daae85ea2a30fffff289db.jpg', 4, '2026-01-13 08:43:03', NULL),
(12, 'Meik Wiking', 'Hygge', 'Le hygge est un art de vivre\r\nPour « survivre » à l\'hiver danois, ils ont développé une stratégie axée sur le coconning et la simplicité : matières douillettes, éclairages chaleureux, feu de cheminée et moments de partage en famille ou entre amis autour d\'un bon dîner, d\'un goûter ou d\'une tasse de thé.', 1, 'uploads/livres/55c089793097af3dfebef46274261673.jpg', 6, '2026-01-13 15:31:27', NULL),
(13, 'Freida McFadden', 'la femme de ménage', 'La Femme de ménage fait partie d\'une série. Le roman raconte l\'histoire de Milly, une jeune femme sortie de prison qui se fait embaucher comme bonne à tout faire dans une famille aisée. Une situation qui se présente tout d\'abord comme une chance, avant que sa patronne ne se révèle finalement instable et toxique.', 1, 'uploads/livres/8da60c4321a4ab2998ee17a888c6070b.jpg', 4, '2026-01-14 21:36:03', NULL),
(14, 'Louis-Philippe Dalembert', 'Milwaukee Mission', 'Milwaukee Blues souhaite en effet reconstruire l’histoire de l’homme assassiné, évoquer plus généralement par ce biais le sort des Noirs dans la société américaine et espérer, dans un final impétueux lors de l’enterrement de la victime, un avenir où les petits-enfants des protagonistes seraient « d’abord des êtres humains, avant que d’être états-uniens, juifs, haïtiens, noirs, blancs ».', 1, 'uploads/livres/c9fd82dbf59de8e42807db5d13405993.jpg', 6, '2026-01-14 22:05:43', NULL),
(15, 'emilie', 'la femme de ménage', 'la fe hj', 0, 'uploads/livres/2cf73cfa5048229ced85b99214af1e19.jpg', 4, '2026-01-16 09:09:22', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user1_id` int(10) UNSIGNED NOT NULL,
  `user2_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `created_at`, `user1_id`, `user2_id`) VALUES
(1, '2026-01-12 11:49:17', 1, 2),
(2, '2026-01-12 11:52:49', 4, 5),
(3, '2026-01-12 21:50:09', 4, 6),
(4, '2026-01-14 22:27:22', 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text DEFAULT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `conversation_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `content`, `sender_id`, `conversation_id`, `created_at`) VALUES
(1, 'super! ton livre', 4, 2, '2026-01-12 17:10:29'),
(2, 'coucou', 6, 3, '2026-01-12 21:51:01'),
(3, 'ton livre est super', 6, 3, '2026-01-12 22:15:48'),
(4, 'salut', 4, 3, '2026-01-13 08:44:23'),
(5, 'coucou', 4, 3, '2026-01-13 15:22:03'),
(6, 'coucou', 6, 3, '2026-01-13 17:14:50'),
(7, 'coucou', 6, 3, '2026-01-13 17:15:27');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `pseudo`, `created_at`) VALUES
(4, 'zineb@outlook.fr', '$2y$10$ZHEA.SNDeJ/zuLQSrDz10ek5xNIuNiVKD2WSd0E.Bp9sg7T7w/hIq', 'zineb', '2026-01-02 00:00:00'),
(5, 'adel@outlook.fr', '$2y$10$WYrWEre78CFUZGUj5M8rn.mDRiI.qI9Tc8LqltD7vXhlm8c1a6tde', 'adel', '2026-01-02 00:00:00'),
(6, 'lola@outlook.fr', '$2y$10$PEcn8wAf3UUk2R5tPIpQtu.AdvlpgFm7fgpM/B2Eh8rfk4.iKuoMO', 'lola', '2026-01-02 00:00:00'),
(8, 'alex@outlook.fr', '$2y$10$OuG1UlwozyY.2UqTDzRjQOS0ED5xNl5/hyUZHQvV8CPGHExfdXdVK', 'alexandre', '2026-01-08 00:00:00'),
(9, 'emilie@outlook.fr', '$2y$10$6dhOVb.uCvLl2BEIRboCi.WYcSrcw1VpKpGfxxAcua1shtH399ppS', 'emilie', '2026-01-14 00:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
