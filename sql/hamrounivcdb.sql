-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : hamrounivcdb.mysql.db
-- Généré le :  mar. 02 juil. 2019 à 18:46
-- Version du serveur :  5.6.43-log
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hamrounivcdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `services` varchar(256) DEFAULT NULL,
  `amount` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `bill` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bills`
--

INSERT INTO `bills` (`id`, `number`, `services`, `amount`, `date`, `status`, `user_id`, `bill`) VALUES
(13, 198732, 'Sport', '189', '2019-05-01', 1, 2, '1696373057.pdf'),
(17, 134, 'Sport', '29', '2019-06-06', 1, 2, '721217393.pdf'),
(19, 10, 'Etudes', '299', '2019-07-07', 1, 22, '5bd73c47f740c79cbdeb1d5887a93527.pdf'),
(20, 11, 'Brocante', '19', '2018-06-01', 1, 22, 'bc2ff19b6b721c6e781bdf58f3b4b4f7.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Voirie'),
(3, 'Signalisation'),
(4, 'Espaces verts'),
(5, 'Propreté'),
(6, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `choices`
--

CREATE TABLE `choices` (
  `id` int(11) NOT NULL,
  `content` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `choices`
--

INSERT INTO `choices` (`id`, `content`) VALUES
(1, 'Voirie'),
(2, 'Signalisation'),
(3, 'Espaces verts'),
(4, 'Propreté'),
(5, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `summary` text,
  `content` longtext,
  `published_at` date NOT NULL,
  `is_published` tinyint(4) NOT NULL DEFAULT '1',
  `image` varchar(256) DEFAULT NULL,
  `video` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `summary`, `content`, `published_at`, `is_published`, `image`, `video`) VALUES
(11, 'Dragon Ball Super - Broly', 'Aucun résumé', 'Il s’agit d’une toute nouvelle histoire. La terre est en paix après « le tournoi du pouvoir ». Ayant compris qu’il y avait encore des personnes extrêmement fortes à travers l’univers, Goku a décidé de viser encore plus haut et de ne pas perdre son temps en continuant à s’entraîner. C’est alors qu’un jour, un saiyan que Goku et Vegeta n’avaient encore jamais vu s’est présenté devant eux, Broly. Alors que « la race Saiyan » était sensée s’être éteinte avec l’explosion de la planète Vegeta, que fait-il donc sur Terre? Revenu des enfers, Freezer est également impliqué, et la rencontre de ces 3 saiyans ayant eu un destin totalement différent va mener à un féroce combat…', '2019-05-27', 1, '1366082978.jpg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/fgvRxG4cCHs\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>'),
(13, '24h - Volley pour tous !', 'Aucun résumé', '<p><span style=\"font-size: 14pt;\">Venez relever le d&eacute;fi de jouer un match de 24 heures non-stop en relais ! Pour tous&middot;tes, petits&middot;es et grands&middot;es. Seule ou entre amis.es.</span></p>', '2019-06-14', 1, '1212709801.jpg', NULL),
(14, 'LAND ART aux Murs à Pêches', 'Aucun résumé', '<p><span style=\"font-size: 14pt;\">&Agrave; l\'initiative de l\'association TIGE* et en partenariat avec la Ville, le Centre Tignous d\'Art Contemporain et les associations pr&eacute;sentes sur le site, une quinzaine d\'artistes plasticiens investit le site naturel des Murs &agrave; P&ecirc;ches en proposant aux promeneurs une lecture de la nature originale et &eacute;volutive au fil des saisons...</span></p>', '2019-04-06', 1, '1536751812.jpg', NULL),
(15, 'Lancement de l\'appel à projet 2019 \"solidarité internationale\"', 'Aucun résumé', '<div>\r\n<p><span style=\"font-size: 14pt;\">La ville de Montreuil lance la 10 &egrave;me &eacute;dition de l\'appel &agrave; projets \"Soutien aux acteurs de la Solidarit&eacute; internationale et de l\'Education &agrave; la Citoyennet&eacute; Mondiale\"</span></p>\r\n</div>\r\n<div>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">L&rsquo;action internationale de la Ville se d&eacute;cline dans le cadre des actions de coop&eacute;ration avec des collectivit&eacute;s &eacute;trang&egrave;res et &eacute;galement &agrave; Montreuil, dans les quartiers, dans les associations.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">Parce que chaque habitant de Montreuil est aussi un citoyen europ&eacute;en et un citoyen du monde, il peut &ecirc;tre un acteur de la solidarit&eacute; internationale. Cet appel &agrave; projets &agrave; vocation &agrave; soutenir et enrichir les pratiques de solidarit&eacute; internationale d&eacute;j&agrave; nombreuses &agrave; Montreuil port&eacute;es par les associations dont c\'est l\'objet, promouvoir la participation des habitants aux projets de coop&eacute;ration, informer et sensibiliser, promouvoir l&rsquo;ouverture &agrave; l&rsquo;Europe et au monde.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">A travers cet appel &agrave; projets, la Ville de Montreuil encourage par ailleurs l\'engagement des structures associatives du territoire en faveur de l\'apprentissage d\'une citoyennet&eacute; mondiale qui se d&eacute;cline dans de nombreux projets socio-culturels, sportifs, de d&eacute;veloppement durable ...</span></p>\r\n</div>\r\n<div>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">Par cet appel &agrave; projets la ville de Montreuil entend contribuer localement &agrave; la r&eacute;alisation des objectifs de d&eacute;veloppement durable d&eacute;finis et adopt&eacute;s par l\'ONU en 2015.</span></p>\r\n</div>', '2019-01-14', 1, '417155821.jpg', NULL),
(16, 'Le cinéma voyageur', 'Aucun résumé', '<div>\r\n<h3><span style=\"font-size: 14pt;\">Halle du march&eacute; Croix de Chavaux</span></h3>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">Le Cin&eacute;ma Voyageur est un cin&eacute;ma itin&eacute;rant qui, apr&egrave;s son hibernation montreuilloise,&nbsp; embarque chaque &eacute;t&eacute; sur les routes un camion-caravane, un petit chapiteau et un grand &eacute;cran gonflable pour montrer des films produits en dehors des circuits traditionnels, documentaires ou fictions, courts ou longs.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">Le samedi 8 Juin, de 14h &agrave; minuit, il vous invite sous la Halle de&nbsp; Croix-de Chavaux. Une apr&egrave;s-midi sous chapiteau et une soir&eacute;e en plein air pour d&eacute;couvrir en exclusivit&eacute; les films que nous porteront lors de notre tourn&eacute;e estivale.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">&rarr; programmation sur cinema-voyageur.org</span></p>', '2019-06-08', 1, '1444015111.jpg', NULL),
(17, 'Vide-Grenier rues en fête', 'Aucun résumé', '<div>\r\n<p><span style=\"font-size: 14pt;\">Rue de la r&eacute;volution</span></p>\r\n</div>\r\n<p><span style=\"font-size: 14pt;\">Le Vide-Grenier Rues en f&ecirc;te revient pour une &eacute;dition 2019 le dimanche 9 juin de 9h30 &agrave; 19h00 !</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">Cette nouvelle &eacute;dition aura lieu, comme d&rsquo;habitude, dans les rues adjacentes &agrave; Comme Vous &Eacute;moi.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">Buvette, restauration, concerts et animations seront au rendez-vous !</span></p>', '2019-06-09', 1, '2110005526.jpg', NULL),
(18, 'Concert chorales Cham élémentaire Joliot-Curie', 'Aucun résumé', '<div>\r\n<p><span style=\"font-size: 14pt;\">Avec les &eacute;l&egrave;ves de cm1 &amp; cm2 en Cham &eacute;l&eacute;mentaire<a title=\"Editer l\'enregistrement\" href=\"http://www.montreuil.fr/typo3/mod.php?&amp;M=web_list&amp;id=1434&amp;table=tt_news\">&nbsp;Joliot-Curie 1 &amp; 2</a>&nbsp;dirig&eacute;s par Chritelle Dutouquet &amp; Stanislav Pavilek , Jeanne-Marie Fourel (Piano) &amp; Ayumi Mori (Clarinette).</span></p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">Au programme :</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">\"Un poirier m\'a dit\" de Mich&egrave;le Bernard.</span></p>\r\n<p><br /><span style=\"font-size: 14pt;\">Entr&eacute;e libre dans la limite des places disponibles - sur invitation.</span></p>', '2019-06-07', 1, '974936055.jpg', NULL),
(19, 'Amour-S, lorsque l’amour vous fait signe, suivez-le !', 'Rencontres chorégraphiques internationales de Seine-Saint-Denis', '<p><span style=\"font-size: 14pt;\">Tarif Plein 20 &euro; - Tarif R&eacute;duit 14 &euro;</span></p>\r\n<p><br /><span style=\"font-size: 14pt;\">&laquo; Le tarif r&eacute;duit est accord&eacute; aux habitants de la Seine-Saint-Denis, aux moins de 30 ans, aux &eacute;tudiants, aux plus de 65 ans, aux demandeurs d&rsquo;emploi, aux b&eacute;n&eacute;ficiaires du RSA, aux abonn&eacute;.e.s des th&eacute;&acirc;tres partenaires sur pr&eacute;sentation d&rsquo;un justificatif. &raquo; Abonnements des Rencontres chor&eacute;graphiques - 3 spectacles et + 12 &euro; la place ; 5 spectacles et + 9 &euro; la place</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 14pt;\">Cr&eacute;ation - Dur&eacute;e : Trio - 1h</span></p>\r\n<p><br /><span style=\"font-size: 14pt;\">S&rsquo;inspirant de Lorsque l&rsquo;amour vous fait signe, suivez-le de Gibran Khalil Gibran, po&egrave;te et artiste peintre libanais, la nouvelle pi&egrave;ce de Radhouane El Meddeb est un hymne &agrave; l&rsquo;amour, comme une envie de lyrisme, de d&eacute;mesure, de transcendance et de beaut&eacute; dans un quotidien de plus en plus violent. Trois corps amoureux cherchent &agrave; s&eacute;duire et lutter contre l&rsquo;oubli. C&rsquo;est un besoin d&rsquo;envol, d&rsquo;utopie et de silence pour se retrouver, d&eacute;sirer et s&rsquo;&eacute;vader du r&eacute;el.</span></p>\r\n<p><br /><span style=\"font-size: 14pt;\">Conception et chor&eacute;graphie : Radhouane El Meddeb&nbsp;</span></p>\r\n<p><span style=\"font-size: 14pt;\">Collaboration artistique : Philippe Lebhar</span></p>\r\n<p><br /><span style=\"font-size: 14pt;\">Interpr&egrave;tes : William Delahaye, R&eacute;mi Leblanc-Messager, Chlo&eacute; Zamboni</span></p>\r\n<p><span style=\"font-size: 14pt;\">Cr&eacute;ation lumi&egrave;res : Manuel Desfeux</span></p>\r\n<p><br /><span style=\"font-size: 14pt;\">Cr&eacute;ation sonore : Nicolas Worms.</span></p>\r\n<p><br /><span style=\"font-size: 14pt;\">Production : La Compagnie de SOI. Coproductions : Rencontres chor&eacute;graphiques internationales de Seine-Saint-Denis, P&ocirc;le Sud - CDCN Strasbourg, CCN Tours Avec le soutien du CND &agrave; Pantin et de la Briqueterie / CDCN Val-de-Marne, La Compagnie de SOI est subventionn&eacute;e par la DRAC &Icirc;le-de-France / Minist&egrave;re de la Culture.</span></p>', '2019-06-05', 1, '843238413.jpg', NULL),
(21, 'E3 2019 : Dragon Ball Z : Kakarot s\'offre de nouvelles images', 'Aucun résumé', '<p>Comme son nom l\'indique, ce nouveau volet sera consacr&eacute; aux aventures de Son Goku telles qu\'elles &eacute;taient racont&eacute;es dans la s&eacute;rie Dragon Ball Z. Apr&egrave;s un premier trailer nous permettant de voir le combat contre Vegeta sous sa forme de singe, Bandai Namco publie aujourd\'hui une poign&eacute;e de nouvelles images. Il est notamment possible d\'y apercevoir Piccolo, Yajirob&eacute; et quelques autres, ainsi que les d&eacute;cors du jeu.</p>', '2019-06-10', 1, '1238654935.jpg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1Y-A1kUCvzY\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(256) NOT NULL,
  `response` text NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id`, `question`, `response`, `category_id`) VALUES
(10, 'Qui dois-je contacter pour demander le retrait d\'encombrants ?', '<p>Vous avez des encombrants dont vous souhaitez vous d&eacute;barrasser ? C\'est tr&egrave;s simple, il vous suffit de prendre rendez-vous par t&eacute;l&eacute;phone et de sortir vos encombrants le jour indiqu&eacute;e.</p>', 5),
(11, 'Comment est organisé le ramassage des déchets et le nettoyage des rues sur la Ville du Kremlin-Bicêtre ?', '<p>La collecte des d&eacute;chets (ordures m&eacute;nag&egrave;res, verre, emballages, d&eacute;chets v&eacute;g&eacute;taux) est organis&eacute;e selon un calendrier que vous pouvez consulter ici. Concernant la propret&eacute;, deux &eacute;quipes m&eacute;canis&eacute;es et plusieurs &eacute;quipes de cantonniers interviennent cinq jours par semaine pour assurer le nettoyage de l&rsquo;espace public et du patrimoine de l&rsquo;office HLM.</p>', 5),
(12, 'Je souhaite louer une salle pour une réception, où dois-je m\'adresser ?', '<p>Contactez le service vie associative au 01 96 50 13 50.</p>', 6);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `caption` varchar(256) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `caption`, `name`, `event_id`) VALUES
(6, 'Deadpool', '1035057612.jpg', 9),
(7, '', '2141554250.jpg', 11),
(8, '', '1453833963.jpg', 11),
(9, '', '1228742921.jpg', 11),
(10, '', '1655215495.jpg', 11),
(11, '', '1361871942.png', 11),
(12, '', '832772341.jpg', 11),
(13, '', '859262767.jpeg', 21),
(14, '', '836779061.jpg', 21),
(15, '', '1488131452.jpg', 21),
(16, '', '1431917440.jpeg', 21),
(17, '', '1121308053.png', 21),
(18, '', '970152346.jpg', 21);

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE `infos` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `infos`
--

INSERT INTO `infos` (`id`, `title`, `content`) VALUES
(1, 'La ville de Montreuil', 'Située dans le département de la Seine-Saint-Denis, aux portes de Paris, Montreuil est la cinquième ville d’Ile-de-France de par sa population : 104 139 habitants au 1er janvier 2013 (population entrée en vigueur au 1er janvier 2016). Limitrophe avec les villes de Bagnolet (93), Romainville (93), Noisy-le-Sec (93), Rosny-sous-Bois (93), Vincennes (94), Fontenay-Sous-Bois (94) et Paris (75), elle s’étend sur une superficie de 892 hectares dont 63 de parcs. Montreuil fait partie des 9 villes de la Communauté d’Agglomération Est-Ensemble. Riche d’une histoire dont témoigne son patrimoine (industriel mais aussi horticole avec les Murs à pêches), Montreuil se caractérise par sa mixité sociale et urbaine mais également par son dynamisme et son évolution marquée par de grands projets (Hauts de Montreuil, Prus Bel Air – Grands Pêchers, Prus La Noue, etc.).');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `mobile` int(20) NOT NULL,
  `message` longtext NOT NULL,
  `send_at` date DEFAULT NULL,
  `first_choice_id` varchar(256) DEFAULT NULL,
  `second_choice_id` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `name`, `firstname`, `email`, `mobile`, `message`, `send_at`, `first_choice_id`, `second_choice_id`) VALUES
(1, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'Premier test', '2019-05-30', '1', '2'),
(8, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'RAS', '2019-05-30', '4', '13'),
(9, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'Aucuun', '2019-05-30', '2', '5'),
(10, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'fdsgshgsd', NULL, NULL, NULL),
(11, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'un truc', NULL, NULL, NULL),
(12, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'un truc l', NULL, NULL, NULL),
(13, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'zaun truc leza', NULL, NULL, NULL),
(14, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'alors', NULL, NULL, NULL),
(15, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'bon bon', NULL, NULL, NULL),
(16, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'loslos', NULL, NULL, NULL),
(17, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'EZZ', NULL, NULL, NULL),
(18, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'sqsqqqq', NULL, '2', '5'),
(19, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'ALors l\'heure', '2019-06-03', '2', '6'),
(20, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, '', '2019-06-03', 'Choisissez...', ''),
(21, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, '', '2019-06-03', 'Choisissez...', ''),
(22, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'ol', '2019-06-03', '2', '4'),
(23, 'Admin', 'Achraf', 'root', 788782583, 'Aucun messge', '2019-06-04', '4', '11'),
(24, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'tfshtfdhfs', '2019-06-04', '4', '13'),
(25, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'aucun lol', '2019-06-04', '1', '1'),
(26, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'encore', '2019-06-04', '1', '2'),
(27, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'fr', '2019-06-04', '1', '1'),
(28, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'pour', '2019-06-04', '2', '5'),
(29, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'ki', '2019-06-04', '1', '1'),
(30, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'dddd', '2019-06-04', '2', '5'),
(31, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'res', '2019-06-04', '1', '1'),
(32, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'tu', '2019-06-04', '4', '12'),
(33, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'ddqqqq', '2019-06-04', '4', '12'),
(34, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'bvcx', '2019-06-04', '3', '8'),
(35, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'lll', '2019-06-04', '4', '14'),
(36, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'xx', '2019-06-04', '3', '9'),
(37, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'f', '2019-06-04', '3', '8'),
(38, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'dv', '2019-06-04', '2', '5'),
(39, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'BN', '2019-06-04', '2', '5'),
(40, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 's', '2019-06-04', '4', '13'),
(41, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'g', '2019-06-04', '1', '1'),
(42, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'c', '2019-06-04', '3', '7'),
(43, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'f', '2019-06-04', '4', '13'),
(44, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'h', '2019-06-04', '2', '6'),
(45, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'm', '2019-06-04', '3', '8'),
(46, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'k', '2019-06-04', '2', '4'),
(47, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'j', '2019-06-04', '3', '9'),
(48, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'h', '2019-06-04', '4', '11'),
(49, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'd', '2019-06-04', '2', '5'),
(50, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'y', '2019-06-04', '3', '8'),
(51, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'a peu pres', '2019-06-05', '3', '7'),
(52, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'fgf', '2019-06-05', '3', '9'),
(53, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'ff', '2019-06-05', '2', '4'),
(54, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'b', '2019-06-05', '2', '5'),
(55, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'gv', '2019-06-05', '2', '4'),
(56, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'fff', '2019-06-05', '2', '5'),
(57, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'jjj', '2019-06-05', '2', '5'),
(58, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'dd', '2019-06-05', '3', '10'),
(59, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'f', '2019-06-05', '3', '8'),
(60, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'nul', '2019-06-06', '2', '5'),
(61, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'lkl', '2019-06-06', '2', '6'),
(62, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'Test du sendmail', '2019-06-07', '5', ''),
(63, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'uit', '2019-06-12', '5', ''),
(64, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'pro', '2019-06-12', '5', ''),
(65, 'Hamrouni', 'Charfeddine', 'admin@admin.fr', 788782583, 'ps', '2019-06-12', '5', ''),
(66, 'Ben Salem', 'Belgacem', 'admin@admin.fr', 614308726, 'ou', '2019-06-12', '3', '9'),
(67, 'Doe', 'John', 'hamrounich@outlook.fr', 788782583, 'John Test', '2019-06-12', '3', '8'),
(68, 'mohamed', 'bendhaou', 'fds@fggfs.fr', 788782583, 'dsfezfez', '2019-06-12', '4', '14'),
(69, 'Ben Salem', 'Belgacem', 'be@fe.fr', 788782583, 'idf', '2019-06-12', '2', '6'),
(70, 'Admin', 'Achraf', 'admin@admin.fr', 788782583, 'hg', '2019-06-12', '3', '7'),
(71, 'Bd', 'Hd', 'Hd@jf.fr', 0, 'Bld', '2019-06-12', '1', '2'),
(72, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 'f', '2019-06-12', '4', '13'),
(73, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 'l', '2019-06-12', '3', '8'),
(74, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 'p', '2019-06-12', '4', '12'),
(75, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 'd', '2019-06-12', '5', ''),
(76, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 'o', '2019-06-12', '3', '9'),
(77, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 'io', '2019-06-12', '2', '4'),
(78, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 'ds', '2019-06-12', '2', '4'),
(79, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 's', '2019-06-12', '2', '5'),
(80, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 's', '2019-06-12', '3', '8'),
(81, 'Ham', 'Test', 'achraaf93@gmail.com', 788782583, 'Test de l\'envoi du mail', '2019-06-13', '3', '8'),
(82, 'Mehdi', 'Kannouni', 'mehdi.kannouni@hotmail.fr', 0, 'salut\n', '2019-06-13', '2', '4'),
(83, 'Mehdi', 'Kannouni', 'mehdi.kannouni@hotmail.fr', 0, 'mehdi', '2019-06-13', '2', '4'),
(84, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'po', '2019-06-13', '3', '8'),
(85, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Test New', '2019-06-13', '5', ''),
(86, 'Admin', 'Achraf', 'hamro@outlook.fr', 788782583, 'Test', '2019-06-15', '5', ''),
(87, 'Admin', 'Achraf', 'hamh@outlook.fr', 788782583, 'Encore', '2019-06-15', '4', '12'),
(88, 'Admin', 'Achraf', 'hamro@outlook.fr', 788782583, 'pp', '2019-06-15', '5', ''),
(89, 'Admin', 'Achraf', 'ounich@outlook.fr', 788782583, 'oui', '2019-06-15', '5', ''),
(90, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'fd', '2019-06-15', '5', ''),
(91, 'Prof', 'Max', 'maxime.basset31@gmail.com', 0, 'Yo j\'voudrais savoir c\'est quand le ramassage des encombrants mais dans la FAQ du site y\'a que des trucs sur le cinéma et ça m\'aide pas des masses...\r\n\r\nMax', '2019-06-17', '4', '11'),
(92, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Test du message avec toutes les informations de l\'utilisateur.', '2019-06-17', '5', ''),
(93, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Deuxième test de l\'envoi du mail avec toutes les informations de l\'utilisateur.', '2019-06-17', '2', '5'),
(94, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Alors test test', '2019-06-17', '5', ''),
(95, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Retest de toutes les informations.', '2019-06-17', '5', ''),
(96, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Test avec les br', '2019-06-17', '5', ''),
(97, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'defe', '2019-06-17', '4', '12'),
(98, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'cnnezz', '2019-06-17', '5', ''),
(99, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'ko', '2019-06-17', '5', ''),
(100, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'cx', '2019-06-17', '5', ''),
(101, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'fffff', '2019-06-17', '5', ''),
(102, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'poiuytredfghjk', '2019-06-17', '5', ''),
(103, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'test iso', '2019-06-17', '5', ''),
(104, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'gg', '2019-06-17', '5', ''),
(105, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'bo', '2019-06-17', '5', ''),
(106, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'fg', '2019-06-17', '1', '2'),
(107, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'bytu', '2019-06-17', '4', '13'),
(108, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'cfr', '2019-06-17', '3', '8'),
(109, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'azertgbn,jkomlkyds', '2019-06-17', '5', ''),
(110, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'ftg', '2019-06-17', '4', '14'),
(111, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'wxcvcdsvs', '2019-06-17', '5', ''),
(112, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'azerty', '2019-06-17', '5', ''),
(113, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'fffffffffff', '2019-06-17', '5', ''),
(114, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'ddddc', '2019-06-17', '5', ''),
(115, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'fdsfsfs', '2019-06-17', '5', ''),
(116, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'cjjeezezaeezdz', '2019-06-17', '4', '14'),
(117, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'ds', '2019-06-17', '5', ''),
(118, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'xxxccxcxcxcx', '2019-06-17', '4', '12'),
(119, 'Un', 'Inconnu', 'hamrouni.pro@outlook.fr', 788782583, 'AUGUSTE', '2019-06-17', '5', ''),
(120, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'cdf', '2019-06-17', '5', ''),
(121, 'Charfeddine', 'Hamrouni', 'achraaf93@gmail.com', 788782583, 'mp', '2019-06-17', '5', ''),
(122, 'Admin', 'Achraf', 'hamrounich.pro@outlook.fr', 788782583, 'cffff', '2019-06-17', '5', ''),
(123, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'encore un test des infos', '2019-06-17', '5', ''),
(124, 'Admin', 'Achraf', 'hamrouni.pro@outlook.fr', 788782583, 're', '2019-06-17', '5', ''),
(125, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Bonjour, je n\'ai aucun problème.', '2019-06-17', '5', ''),
(126, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Je n\'ai aucun problème.', '2019-06-17', '4', '13'),
(127, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Test de l\'encodage', '2019-06-17', '5', ''),
(128, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Test encodage des accent :: élevage', '2019-06-17', '5', ''),
(129, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'encore test des accent é î', '2019-06-17', '5', ''),
(130, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'Test du titre', '2019-06-17', '5', ''),
(131, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'encore le titre', '2019-06-17', '5', ''),
(132, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'test du cc', '2019-06-17', '5', ''),
(133, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'retest du cc', '2019-06-17', '5', ''),
(134, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'test des espaces dans le titre', '2019-06-17', '5', ''),
(135, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'retest des espaces', '2019-06-17', '5', ''),
(136, 'Admin', 'Achraf', 'hamrounich@outlook.fr', 788782583, 'rien du tout', '2019-06-17', '5', ''),
(137, 'Max', 'Max', 'maxime.basset31@gmail.com', 0, 'Message test, et j\'espère que cette fois y\'a toutes les infos dans le mail !', '2019-06-18', '4', '13'),
(138, 'Max', 'Max', 'maxime.basset31@gmail.com', 0, 'gjhgh jfgyj tyu', '2019-06-18', '4', '13'),
(139, 'Max', 'Max', 'maxime.basset31@gmail.com', 0, 'ty tuy yruk uy', '2019-06-18', '4', '13'),
(140, 'Max', 'Max', 'maxime.basset31@gmail.com', 0, 'tyr uyuk uykiluy uyil uyl y', '2019-06-18', '4', '13'),
(141, 'az', 'az', 'fd@sd.fr', 0, 'fd', '2019-06-18', '3', '10');

-- --------------------------------------------------------

--
-- Structure de la table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notices`
--

INSERT INTO `notices` (`id`, `title`, `content`) VALUES
(1, 'Nature des données recueillies', 'Les informations que nous sommes amenés à recueillir proviennent de la communication volontaire de votre adresse électronique ou coordonnées vous permettant de recevoir l’un de nos produits ou bénéficier de l’un de nos services en ligne (copies d’actes d’état civil, inscription aux petites annonces…).'),
(2, 'Emploi des données recueillies', 'Aucune information personnelle vous concernant n’est cédée à des tiers ou utilisée à des fins non prévues :\r\n\r\nVous avez adressé un courrier électronique à un service de la Ville.\r\nDans ce cas, votre adresse mail ne nous servira qu’à vous transmettre les documents municipaux demandés.'),
(3, 'Droits d’auteur et reprise du contenu', 'Tous les contenus présents sur le site montreuil.fr sont couverts par le droit d’auteur. Toute reprise est dès lors conditionnée à l’accord de l’auteur en vertu de l’article L.122-4 du Code de la Propriété Intellectuelle.'),
(4, 'Les différents contenus présents sur le site', 'Ecrits et/ou mis en ligne par la rédaction du site montreuil.fr, ces contenus ne sauraient être reproduits librement sans l’indication de la source. De même, les pages du site montreuil.fr ne doivent pas être imbriquées à l’intérieur des pages d’un autre site.');

-- --------------------------------------------------------

--
-- Structure de la table `second_choices`
--

CREATE TABLE `second_choices` (
  `id` int(11) NOT NULL,
  `choice` varchar(256) NOT NULL,
  `choices_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `second_choices`
--

INSERT INTO `second_choices` (`id`, `choice`, `choices_id`) VALUES
(1, 'Mobiliers', 1),
(2, 'Revêtements', 1),
(3, 'Signalisations au sol', 1),
(4, 'Feux tricolores', 2),
(5, 'Panneaux directionnels', 2),
(6, 'Panneaux sectorisations', 2),
(7, 'Parcs', 3),
(8, 'Squares', 3),
(9, 'Aires de jeu', 3),
(10, 'Espaces ornementaux', 3),
(11, 'Poubelles', 4),
(12, 'Ramassages', 4),
(13, 'Dégradations', 4),
(14, 'Propreté de la voirie', 4);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `schedule` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `lat` double(10,7) NOT NULL,
  `long` double(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `schedule`, `address`, `lat`, `long`) VALUES
(1, 'Stade Nautique Maurice Thorez', 'piscine.jpg', 'Ouvert du lundi au samedi et le dimanche fermé', '21 Rue du Colonel Raynal 93100 Montreuil', 48.8561688, 2.4315137),
(3, 'Bibliothèque Robert- Desnos', 'bi.jpg', 'Ouvert du lundi au samedi et le dimanche fermé', '14 Boulevard Rouget de Lisle 93100 Montreuil', 48.8661270, 2.4329003),
(5, 'Centre de Loisirs La Cerisaie', 'centre.jpg', 'Ouvert du lundi au samedi et le dimanche fermé', '123 Avenue du Président Wilson 93100 Montreuil', 48.8543845, 2.4372460),
(6, 'Lycée Jean Jaurès', 'lycee.jpg', 'Ouvert du lundi au samedi et le dimanche fermé', '1 Rue Dombasle 93100 Montreuil', 48.8661217, 2.4329003),
(7, 'College Colonel Fabien', '1.jpg', 'Ouvert du lundi au samedi et le dimanche fermé', '81 Avenue du Colonel Fabien 93100 Montreuil', 48.8755557, 2.4510831),
(8, 'École élémentaire publique Fabien', 'ecole.jpg', 'Ouvert du lundi au samedi et le dimanche fermé', '162 Boulevard Aristide Briand 93100 Montreuil', 48.8740409, 2.4458685);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `firstname` varchar(256) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `city` varchar(256) DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `mobile` varchar(256) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `verif` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `birthdate`, `address`, `city`, `zipcode`, `email`, `password`, `mobile`, `admin`, `verif`) VALUES
(2, 'Admin', 'Achraf', '2019-04-02', '134 rue saint denis', 'Montreuil', 93100, 'hamrounich@outlook.fr', 'ac905e701e76ef3385de7cdd5acd4eab', '0788782583', 1, 1),
(15, 'Prof', 'Admin', '1980-06-07', 'En a pas', 'Les lilas', 93260, 'prof@prof.fr', '2e6b3ac70fe4b120406d31f3bbd598cc', NULL, 1, 0),
(22, 'Doe', 'John', '1990-01-01', '55 Clark St', 'Brooklyn, USA', 11201, 'john.test.doe@outlook.fr', '0efffc51d5e228e69bec75545457b977', '', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorie_id` (`category_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `second_choices`
--
ALTER TABLE `second_choices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT pour la table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `second_choices`
--
ALTER TABLE `second_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `fk_categorie_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
