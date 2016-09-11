-- phpMyAdmin SQL Dump
-- version OVH
-- http://www.phpmyadmin.net
--
-- Client: mysql5-11.perso
-- Généré le : Mer 29 Mai 2013 à 15:26
-- Version du serveur: 5.1.63
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `leseschobescho`
--

-- --------------------------------------------------------

--
-- Structure de la table `table_address`
--

CREATE TABLE IF NOT EXISTS `table_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `table_address`
--

INSERT INTO `table_address` (`id`, `address`) VALUES
(1, 'THEATRE DE L\\\\\\''ECHANGE\r\n26 rue Sommeiller\r\n74000 Annecy\r\n06 52 07 87 98');

-- --------------------------------------------------------

--
-- Structure de la table `table_datas_newsletter`
--

CREATE TABLE IF NOT EXISTS `table_datas_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_test` varchar(200) NOT NULL DEFAULT '',
  `object` varchar(150) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `table_datas_newsletter`
--

INSERT INTO `table_datas_newsletter` (`id`, `email_test`, `object`, `content`) VALUES
(1, 'test@yahoo.fr', 'objet de la newsletter', '<h1>\r\n	Quisque vitae dictum nunc. Donec vitae felis nulla.</h1>\r\n<hr />\r\n<p>\r\n	<strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin viverra molestie ornare. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</strong><br />\r\n	<br />\r\n	Tam bibendum lorem sed mauris elementum vehicula. Donec odio risus, euismod a congue quis, faucibus in massa. Aliquam erat volutpat. Duis eget sem in enim hendrerit eleifend. Quisque laoreet pulvinar porta. Nunc vel arcu nisi, vitae mattis metus. Nulla aliquet dignissim dolor eget aliquam. Sed eget justo lacus.</p>\r\n<h1>\r\n	Pellentes suscipit tincidunt</h1>\r\n<hr />\r\n<p>\r\n	<img height=\\\\\\"10\\\\\\" src=\\\\\\"http://www.kitsgratuits.com/templates-preview/template-16/images/puce1.gif\\\\\\" width=\\\\\\"21\\\\\\" />Sed scelerisque fringilla pharetra. Suspendisse ultricies, dui vel venenatis mollis, tortor nisi ultricies leo, quis sollicitudin leo est et leo.</p>\r\n<p class=\\\\\\"more\\\\\\">\r\n	<a class=\\\\\\"liensMore\\\\\\" href=\\\\\\"http://www.kitsgratuits.com/templates-preview/template-16/index.htm#\\\\\\">&gt;&gt; Read more</a></p>\r\n<p>\r\n	<br />\r\n	<img height=\\\\\\"10\\\\\\" src=\\\\\\"http://www.kitsgratuits.com/templates-preview/template-16/images/puce1.gif\\\\\\" width=\\\\\\"21\\\\\\" />Morbi fermentum semper ullamcorper. Donec et laoreet nisl. Donec condimentum interdum leo in porttitor.</p>\r\n<p class=\\\\\\"more\\\\\\">\r\n	<a class=\\\\\\"liensMore\\\\\\" href=\\\\\\"http://www.kitsgratuits.com/templates-preview/template-16/index.htm#\\\\\\">&gt;&gt; Read more</a></p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `table_email`
--

CREATE TABLE IF NOT EXISTS `table_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `table_email`
--

INSERT INTO `table_email` (`id`, `email`) VALUES
(1, 'lesescholiers.annecy@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `table_email_reservation`
--

CREATE TABLE IF NOT EXISTS `table_email_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `table_email_reservation`
--

INSERT INTO `table_email_reservation` (`id`, `email`) VALUES
(1, 'jeanine.ribollet@wanadoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `table_evenements`
--

CREATE TABLE IF NOT EXISTS `table_evenements` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_spectacle` bigint(20) NOT NULL,
  `id_salle` bigint(20) NOT NULL,
  `horaire` datetime NOT NULL,
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Contenu de la table `table_evenements`
--

INSERT INTO `table_evenements` (`id`, `id_spectacle`, `id_salle`, `horaire`, `tstp`) VALUES
(22, 5, 6, '2013-04-21 16:30:00', 1353454075),
(17, 5, 6, '2013-04-12 20:30:00', 1353453915),
(21, 5, 6, '2013-04-20 20:30:00', 1353454052),
(20, 5, 6, '2013-04-19 20:30:00', 1353454035),
(18, 5, 6, '2013-04-13 20:30:00', 1353453940),
(19, 5, 6, '2013-04-14 16:30:00', 1353453987),
(23, 5, 6, '2013-04-26 20:30:00', 1353454096),
(24, 5, 6, '2013-04-27 20:30:00', 1353454112),
(25, 5, 6, '2013-04-28 16:30:00', 1353454147),
(27, 5, 6, '2013-05-04 20:30:00', 1353454185),
(30, 5, 6, '2013-05-17 20:30:00', 1353454242),
(31, 5, 6, '2013-05-18 20:30:00', 1353454259),
(32, 5, 6, '2013-05-24 20:30:00', 1353454275),
(33, 5, 6, '2013-05-25 20:30:00', 1353454290),
(34, 5, 6, '2013-05-31 20:30:00', 1353454306),
(35, 5, 6, '2013-06-01 20:30:00', 1353454323),
(36, 5, 6, '2013-06-07 20:30:00', 1353454341),
(37, 5, 6, '2013-06-08 20:30:00', 1353454357),
(42, 5, 6, '2013-05-03 20:30:00', 1353454577);

-- --------------------------------------------------------

--
-- Structure de la table `table_galeries`
--

CREATE TABLE IF NOT EXISTS `table_galeries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL DEFAULT '',
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `table_galeries`
--

INSERT INTO `table_galeries` (`id`, `titre`, `tstp`) VALUES
(1, 'Le Dindon, de Feydeau (2012)', 1360685367),
(2, 'Les Petits Escholiers', 1349714147),
(3, 'La Pastorale des Santons de Provence 2011', 1361125867),
(4, 'Huit Femmes, de Robert Thomas (2011)', 1361125976),
(5, 'Les Femmes Savantes, de MoliÃ¨re (2009)', 1368199528),
(6, 'La Nuit de Valognes, d\\\\\\''Eric-Emmanuel Schmitt (2010)', 1367261396),
(7, 'Le Mandat, de NicolaÃ¯ Erdman (2013)', 1355076680),
(8, 'Festival de ThÃ©Ã¢tre Amateur 2013', 1349629390),
(9, 'Et dans la presse...', 1369065691);

-- --------------------------------------------------------

--
-- Structure de la table `table_groupes_personnes`
--

CREATE TABLE IF NOT EXISTS `table_groupes_personnes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) NOT NULL DEFAULT '',
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `table_groupes_personnes`
--

INSERT INTO `table_groupes_personnes` (`id`, `libelle`, `tstp`) VALUES
(2, 'Bureau', 1350245985),
(3, 'ComÃ©diens', 1350245995),
(4, 'DÃ©cors et costumes', 1350246007);

-- --------------------------------------------------------

--
-- Structure de la table `table_historique_compagnie`
--

CREATE TABLE IF NOT EXISTS `table_historique_compagnie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `table_historique_compagnie`
--

INSERT INTO `table_historique_compagnie` (`id`, `contenu`) VALUES
(1, '<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Quatre potaches de l&#39;Ecole Sup&eacute;rieure de Gar&ccedil;ons d&#39;Annecy, amoureux de th&eacute;&acirc;tre, vont en 1928 fonder LES ESCHOLIERS. C&#39;est en souvenir des textes de Fran&ccedil;ois Villon qu&#39;ils lui donneront ce nom.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">D&egrave;s leur fondation, avec le concours de la Ville d&#39;Annecy,&nbsp; les Escholiers vont se faire un nom dans le th&eacute;&acirc;tre amateur.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Ils vont tout de suite marquer les esprits, tout d&#39;abord par leurs metteurs en sc&egrave;ne (Savry, Paston et autres), puis dans le choix de leurs textes : Rostand, Daudet, Dosto&iuml;evsky, Romain, Racine, Moli&egrave;re, etc.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Leur fondateur Camille Mugnier va, de ses deniers, cr&eacute;er le coeur des Escholiers : le THEATRE DE L&#39;ECHANGE. A sa mort, la Ville continuera &agrave; l&#39;entretenir.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Par la suite, Fran&ccedil;ois Lanier va porter les Escholiers jusqu&#39;&agrave; son d&eacute;part vers des cieux plus cl&eacute;ments. Il sera tout d&#39;abord acteur, puis assurera la pr&eacute;sidence et la mise en sc&egrave;ne. Son &quot;r&egrave;gne&quot; marquera entre autre l&#39;ouverture vers les jeunes et vers les autres associations culturelles.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Gil de Lall&eacute;e, acteur, form&eacute; par un de nos grands anciens, Gaby Monnet, prendra sa suite pour la mise en sc&egrave;ne.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">C&#39;est un autre com&eacute;dien, Aymeric CHAUFFERT, qui va en 1998 prendre sa suite. Toutes ses pi&egrave;ces ont un excellent accueil et vont faire la joie des acteurs et des spectateurs. Il excelle dans la com&eacute;die de boulevard, mais ne craint pas de se frotter tant au classique, qu&#39;au moderne.</span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><img alt=\\\\\\\\\\\\\\"\\\\\\\\\\\\\\" src=\\\\\\\\\\\\\\"/ckfinder/userfiles/images/escho.jpg\\\\\\\\\\\\\\" style=\\\\\\\\\\\\\\"width: 100px; height: 275px;\\\\\\\\\\\\\\" /></span></span></p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `table_images_video`
--

CREATE TABLE IF NOT EXISTS `table_images_video` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_video` bigint(20) NOT NULL DEFAULT '0',
  `extension` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `table_messages_ldo`
--

CREATE TABLE IF NOT EXISTS `table_messages_ldo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `author` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `table_messages_ldo`
--

INSERT INTO `table_messages_ldo` (`id`, `author`, `content`, `tstp`) VALUES
(9, 'Aurore de la Cie Jean Thomas', 'Un Ã©norme  MERCI pour votre accueil si chaleureux, votre disponibilitÃ© et votre amour du thÃ©Ã¢tre !\r\nNous sommes enchantÃ©s de notre participation Ã  votre festival et, au-delÃ  de l\\\\\\''honneur que vous avez fait Ã  notre compagnie en lui dÃ©cernant deux prix, nous sommes trÃ¨s heureux d\\\\\\''avoir participÃ© Ã  cette belle aventure humaine ! Nous espÃ©rons que nos routes se recroiseront bientÃ´t, au fil de ces voyages extraordinaires que permet le thÃ©Ã¢tre...\r\n', 1368392980),
(10, 'JEAN-FRED POUR L\\\\\\''ONCION', 'MILLE MERCIS POUR VOTRE ACCUEIL, AMIS ESCHOLIERS ! UN SEUL PETIT REGRET, NE PAS AVOIR PU SALUER BENJAMIN, DIMANCHE APRÃˆS LE REPAS. SINON, BRAVO SUR TOUTE LA LIGNE ! L\\\\\\''ONCION  SE JOINT Ã€ MOI POUR VOUS SOUHAITER UN BON \\\\&quot;MANDAT\\\\&quot;. A BIENTÃ”T ! JEAN-FRED', 1368551213);

-- --------------------------------------------------------

--
-- Structure de la table `table_newsletter`
--

CREATE TABLE IF NOT EXISTS `table_newsletter` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL DEFAULT '',
  `prenom` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `table_newsletter`
--

INSERT INTO `table_newsletter` (`id`, `nom`, `prenom`, `email`, `tstp`) VALUES
(6, 'Hardibo', 'Pierre-Jean', 'lewebalternatif@gmail.com', 1356884447),
(3, 'Hardibo', 'Pierre-Jean', 'hardibopj@yahoo.fr', 1355246241),
(5, 'Doe', 'John', 'hardibopj@hotmail.fr', 1356452767),
(7, 'belmonte pena', 'claire', 'claire.belmontepena@sfr.fr', 1363528198),
(8, 'boukharak', 'rhemo', 'rhemoboukharak@hotmail.fr', 1363776742),
(9, 'Perrier', 'Alfred', 'alfred.perrier@gmail.com', 1364195329),
(10, 'FABRE', 'Nathalie', 'fabrenathalie47@neuf.fr', 1365060169),
(11, 'NOAILHET', 'ANNIE', 'annie.noailhet@free.fr', 1365153906),
(12, 'CLIVILLE', 'CLAUDIE', 'claudie.cliville@free.fr', 1365438361),
(13, 'PAUL', 'MARIE-FRANCE', 'mfpaul@free.fr', 1365530005),
(14, 'dekoninck', 'lucie', 'lucie.dekoninck@gmail.com', 1366372328),
(15, 'mulliez', 'nathalie', 'nmulliez@yahoo.fr', 1366566138),
(16, 'bezier', 'isabelle', 'isabellemarie.bezier@laposte.net', 1366800632),
(17, 'Vacher', 'Gilles', 'gillesvacher@hotmail.com', 1367097950),
(18, 'DUPARC', 'Philippe', 'pduparc@usa.net', 1367137875),
(19, 'CROUZAT', 'MichÃ¨le', 'michelecrouzat@aol.com', 1367338508),
(20, 'ketterer-pignarre', 'christine', 'christipigna@orange.fr', 1367570789),
(21, 'SOL', 'Patrick', 'dunniamateu@hotmail.com', 1367658522),
(22, 'NUER', 'PIERRE', 'nuer.famille@wanadoo.fr', 1367681993),
(23, 'lemay', 'catherine', 'clemay2@gmail.com', 1368524143),
(24, 'BORCARD ', 'CHRISTINE', 'christine.borcard@wanadoo.fr', 1369083020);

-- --------------------------------------------------------

--
-- Structure de la table `table_pages_contenu`
--

CREATE TABLE IF NOT EXISTS `table_pages_contenu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `main_titre` varchar(200) NOT NULL DEFAULT 'titre a modifier',
  `titre` varchar(100) NOT NULL DEFAULT '',
  `contenu` longtext NOT NULL,
  `title` varchar(200) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `table_pages_contenu`
--

INSERT INTO `table_pages_contenu` (`id`, `main_titre`, `titre`, `contenu`, `title`, `description`, `date`) VALUES
(12, 'Festivals prÃ©cÃ©dents', '7- Festival annees precedentes', '<p>\r\n	Page en cours de construction</p>\r\n', 'Festivals prÃ©cÃ©dents Escholiers', 'Festivals prÃ©cÃ©dents Escholiers', 1352139325),
(13, 'Les Petits Escholiers', '9 Les Petits Escholiers', '<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<br />\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><strong>Les Petits Escholiers, troupe de th&eacute;&acirc;tre enfants et adolescents cr&eacute;e en 2009</strong></span></span></p>\r\n<p>\r\n	<br />\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Les Escholiers, riches de leur 84 ann&eacute;es d&#39;exp&eacute;rience, ont souhait&eacute; ouvrir leur compagnie aux plus jeunes, ils d&eacute;cident donc de cr&eacute;er une troupe de jeunes qui r&eacute;p&eacute;tera dans les m&ecirc;mes conditions, dans le tr&egrave;s intime et convivial th&eacute;&acirc;tre de l&#39;&eacute;change, le m&ecirc;me jour qu&#39;eux.<br />\r\n	<br />\r\n	Le d&eacute;but de l &#39;aventure d&eacute;marre en 2009, Un groupe de 10 jeunes com&eacute;diens accompagn&eacute; &agrave; la Mise en sc&egrave;ne par Florence Delorme, se lance dans les traces de leurs a&icirc;n&eacute;s.<br />\r\n	<br />\r\n	L&#39;id&eacute;e est de travailler comme les grands, l&#39;objectif est le m&ecirc;me, ce n&#39;est pas un atelier mais une troupe, qui pr&eacute;sente la r&eacute;alisation de la saison au cours de plusieurs repr&eacute;sentations.<br />\r\n	Depuis deux ans, les petits Escholiers participent aussi &agrave; un spectacle de No&euml;l avec les &laquo; grands &raquo;.<br />\r\n	<br />\r\n	2009-2010, &laquo; Les 21 infortunes d&#39;Arlequin &raquo; Cr&eacute;ation de Florence Delorme ( d&#39;apr&egrave;s un canevas de Goldoni)<br />\r\n	2010-2011, &laquo; C&#39;est par ici , les prisons &raquo; Cr&eacute;ation de Florence Delorme avec 12 com&eacute;diens<br />\r\n	<br />\r\n	En 2011- 2012, la troupe s&rsquo;agrandit : 20 com&eacute;diens de 8 &agrave; 13 ans ! Qu&#39;&agrave; cela ne tienne il y aura d&eacute;sormais deux groupes. Le premier monte &laquo;La Fontaine y buvait de l&#39;eau, ce type l&agrave; ?&raquo; d&#39;apr&egrave;s un texte de Sylvaine Hinglais, le deuxi&egrave;me &laquo; HUIT &raquo; une cr&eacute;ation de Florence Delorme (un hommage &agrave; 8 femmes de R.Thomas).<br />\r\n	<br />\r\n	2012-2013, les deux troupes grandissent encore ! 26 com&eacute;diens !!</span></span></p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<span style=\\\\\\\\\\\\\\"font-size: 20px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><strong>Repr&eacute;sentations des Petits Escholiers les 28 et 29 JUIN 2013</strong></span></span></p>\r\n', 'Les Petits Escholiers', 'Les Petits Escholiers', 1359581670),
(2, 'Historique', '2 Compagnie Historique', '<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">Quatre potaches de l&#39;Ecole Sup&eacute;rieure de Gar&ccedil;ons d&#39;Annecy, amoureux de th&eacute;&acirc;tre, vont en 1928 fonder LES ESCHOLIERS. C&#39;est en souvenir des textes de Fran&ccedil;ois Villon qu&#39;ils lui donneront ce nom.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">D&egrave;s leur fondation, avec le concours de la Ville d&#39;Annecy,&nbsp; les Escholiers vont se faire un nom dans le th&eacute;&acirc;tre amateur.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">Ils vont tout de suite marquer les esprits, tout d&#39;abord par leurs metteurs en sc&egrave;ne (Savry, Paston et autres), puis dans le choix de leurs textes : Rostand, Daudet, Dosto&iuml;evsky, Romain, Racine, Moli&egrave;re, etc.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">Leur fondateur Camille Mugnier va, de ses deniers, cr&eacute;er le coeur des Escholiers : le THEATRE DE L&#39;ECHANGE. A sa mort, la Ville continuera &agrave; l&#39;entretenir.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">Par la suite, Fran&ccedil;ois Lanier va porter les Escholiers jusqu&#39;&agrave; son d&eacute;part vers des cieux plus cl&eacute;ments. Il sera tout d&#39;abord acteur, puis assurera la pr&eacute;sidence et la mise en sc&egrave;ne. Son &quot;r&egrave;gne&quot; marquera entre autre l&#39;ouverture vers les jeunes et vers les autres associations culturelles.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">Gil de Lall&eacute;e, acteur, form&eacute; par un de nos grands anciens, Gaby Monnet, prendra sa suite pour la mise en sc&egrave;ne.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">C&#39;est un autre com&eacute;dien, Aymeric Chauffert, qui va en 1998 prendre sa suite. Toutes ses pi&egrave;ces ont un excellent accueil et vont faire la joie des acteurs et des spectateurs. Il excelle dans la com&eacute;die de boulevard, mais ne craint pas de se frotter tant au classique, qu&#39;au moderne.</span></span></p>\r\n', 'Compagnie Historique Escholiers', 'Compagnie Historique Escholiers', 1361107073),
(5, 'Remerciements', '13 Remerciements', '<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; La mairie d&#39;ANNECY ainsi que le Conseil g&eacute;n&eacute;ral de Haute-Savoie</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; La FNCTA pour leurs conseils et leur pr&eacute;sence</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; Tous les supports de communication (presse, radio, t&eacute;l&eacute;visuel) qui portent de l&#39;attention &agrave; nos sollicitations depuis de nombreuses ann&eacute;es</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; ARP EXIT pour les badges du Festival</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; Jimy HAIDIRA pour la cr&eacute;ation des visuels des pi&egrave;ces et du festival</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; Nathalie COTTET, Alain BARAVAGLIO, et Gilles PATUREL pour la cr&eacute;ation et l&#39;ex&eacute;cution des d&eacute;cors</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; Jacqueline VIRMAUX pour les costumes</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; </span></span><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Laurent TABOUROT pour les mises en sc&egrave;ne des s&eacute;ries de spectacles donn&eacute;s dans le cadre du No&euml;l des Alpes (par exemple, la Pastorale des Santons de Provence qui a mobilis&eacute; plus de 150 participants venant de 3 associations diff&eacute;rentes)</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; Pierre-Jean HARDIBO qui a r&eacute;alis&eacute; ce site internet</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; Tous ceux qui, physiquement ou mentalement, de pr&egrave;s ou de loin, nous ont soutenu depuis 1928, et par avance aussi ceux qui le feront durant de longues ann&eacute;es</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">&bull; Nous remercions le PUBLIC et plus g&eacute;n&eacute;ralement tous les amoureux du th&eacute;&acirc;tre</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">â€¨â€¨&bull; Et encore et toujours Camille MUGNIER et ses amis pour avoir cr&eacute;&eacute; Les Escholiers !</span></span><br />\r\n	&nbsp;</p>\r\n', 'Remerciements Escholiers', 'Remerciements Escholiers', 1367480006),
(6, 'PrÃ©sentation', '6 Festival Presentation', '<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><strong><span style=\\\\\\\\\\\\\\"font-size: 22px;\\\\\\\\\\\\\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Festival 2013 : le mot des Organisateurs</span></strong><br />\r\n	<br />\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">Le festival vient de se terminer et voici venu le temps du bilan. D&rsquo;ores et d&eacute;j&agrave;, nous pouvons dire que ce 6&egrave;me festival a vraiment &eacute;t&eacute; un tr&egrave;s grand cru.<br />\r\n	<br />\r\n	Il est bon d&eacute;j&agrave; de pr&eacute;ciser que le Festival des Escholiers commence &agrave; avoir une r&eacute;putation grandissante. En effet, nous avons re&ccedil;u 30 candidatures parmi lesquelles il a fallu avec grande difficult&eacute; s&eacute;lectionner quinze troupes.<br />\r\n	Le comit&eacute; de s&eacute;lection a fait un excellent travail, car nous avons constat&eacute; que son choix &eacute;tait tr&egrave;s judicieux. Les troupes qui se sont produites ont pr&eacute;sent&eacute; des spectacles de tr&egrave;s grande qualit&eacute;. La diversit&eacute; des pi&egrave;ces, contemporain, classique, drame, com&eacute;die, th&eacute;&acirc;tre musical, correspond aux couleurs que nous voulons donner &agrave; notre festival.<br />\r\n	<br />\r\n	Le festival en quelques chiffres&nbsp;:<br />\r\n	<br />\r\n	5 jours, 15 troupes, 158 festivaliers, 31 Escholiers b&eacute;n&eacute;voles, 3 techniciens, 1 parrain, 5 membres de jury, 20 spectacles dont une s&eacute;ance scolaire et un spectacle de rue, 2 salles de spectacle + la rue, une librairie sp&eacute;ciale festival, une &eacute;quipe de tournage,<br />\r\n	<br />\r\n	Et surtout&nbsp;:&nbsp; <span style=\\\\\\\\\\\\\\"font-size: 22px;\\\\\\\\\\\\\\">1913 spectateurs soit 37 % de plus que l&rsquo;ann&eacute;e derni&egrave;re</span>.<br />\r\n	<br />\r\n	Mais au-del&agrave; des chiffres, le festival a &eacute;t&eacute; l&rsquo;occasion de belles rencontres, d&rsquo;&eacute;change, de grands moments de rires, de pleurs mais aussi d&rsquo;un panel d&rsquo;&eacute;motions. Tout ce qu&rsquo;il faut pour qu&rsquo;un festival soit r&eacute;ussi.<br />\r\n	<br />\r\n	Nous tenons &agrave; remercier tous les participants, le parrain, le jury, les b&eacute;n&eacute;voles, et bien entendu le public.<br />\r\n	A l&rsquo;ann&eacute;e prochaine pour le 7&egrave;me festival&nbsp;!</span></span></p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	&nbsp;</p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<span style=\\\\\\\\\\\\\\"font-size: 16px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Et pour avoir des nouvelles d&#39;une des troupes r&eacute;compens&eacute;es, cliquez sur la photo ci-dessous :</span></span></p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<a href=\\\\\\\\\\\\\\"http://www.midilibre.fr/2013/05/23/la-compagnie-jean-thomas-cartonne,701885.php\\\\\\\\\\\\\\"><img alt=\\\\\\\\\\\\\\"\\\\\\\\\\\\\\" src=\\\\\\\\\\\\\\"/ckfinder/userfiles/images/Cie%20Th%C3%A9%C3%A2tre%20Jean%20Thomas.jpg\\\\\\\\\\\\\\" style=\\\\\\\\\\\\\\"width: 521px; height: 397px;\\\\\\\\\\\\\\" /></a></p>\r\n', 'Festival Escholiers', 'Festival Escholiers', 1369827804),
(7, 'ActualitÃ©s', '4 Actualites', '<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<br />\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><strong>LE MANDAT, de Nicolai Erdman, &eacute;crit en 1925</strong></span></span></p>\r\n<p>\r\n	<br />\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Nous sommes en Russie en 1924, dans un immeuble locatif. La r&eacute;volution communiste a eu lieu.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Les Gouliatchkine, anciens commer&ccedil;ants petits bourgeois, ont perdu leur statut. Les Sm&eacute;tanitch, famille de la noblesse, craignent leur futur sous ce nouveau r&eacute;gime. Ces deux familles essayent par tous les moyens de bien se faire voir du r&eacute;gime en place, ce qui am&egrave;ne &agrave; des situations rocambolesques.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Pi&egrave;ce irr&eacute;sistiblement dr&ocirc;le, &eacute;voluant sur un rythme d&eacute;brid&eacute;, on retrouve dans Le Mandat la d&eacute;mesure toute sovi&eacute;tique des sentiments. Elle est &eacute;galement une r&eacute;flexion am&egrave;re sur l&#39;individu, ses petites compromissions, ses ambitions et le poids du pass&eacute;.</span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<img alt=\\\\\\\\\\\\\\"\\\\\\\\\\\\\\" src=\\\\\\\\\\\\\\"/ckfinder/userfiles/images/Le%20mandat_300x400.jpg\\\\\\\\\\\\\\" style=\\\\\\\\\\\\\\"width: 400px; height: 533px;\\\\\\\\\\\\\\" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><u>Distribution</u> (par ordre d&#39;apparition sur sc&egrave;ne) : </span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Nadiejda Petrovna Gouliatchkina : <em>Josiane Walser</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Pavel Sergue&iuml;evitch Gouliatchkine : <em>Fabien Christ</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Ivan Ivanovitch Chironkine : <em>Benjamin De Rossi</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Varvara Sergue&iuml;evna Gouliatchkina : <em>Lili Dubois / Carole Siret </em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Anastassia Nikola&iuml;evna Poupkina, dite Nastia : <em>Sylvie Galichet / Jo&euml;lle Paulme</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Tamara Leopoldovna Vichnevetska&iuml;a : <em>Mellie Barrueco</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">La joueuse d&#39;orgue de Barbarie : <em>Jeanine Ribollet</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Olympe Val&eacute;rianovna Sm&eacute;tanitch : <em>Nelly Becuwe</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Val&eacute;rian Olympovitch Sm&eacute;tanitch : <em>Romain Prioux</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Le joueur de tambour : <em>Bastien Cortes / Carole Siret</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Autonome Sigismondovitch : <em>Bernard Walser</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Agafange : <em>Laurent Gustin / Cyril Sainton</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Anatole Olympovitch Sm&eacute;tanitch : <em>Justine Boissier / Bastien Cortes</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">F&eacute;litsata Gorde&iuml;evna : <em>Maria Coirier</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Stepane Stepanovitch : <em>Arnaud Berthier</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Ilinkine : <em>Alvaro Marin</em></span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">N.B. : Repr&eacute;sentations des PETITS&nbsp;ESCHOLIERS les 28 et 29 JUIN 2013</span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 'ActualitÃ©s Escholiers', 'ActualitÃ©s Escholiers', 1364419424),
(8, 'Inscription', '8- Festival Inscription', '<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><a href=\\\\\\\\\\\\\\"/ckfinder/userfiles/files/lettre%20d\\\\\\\\\\\\\\''invitation%202013.pdf\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">Lettre d&#39;invitation 2013</span></a></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><a href=\\\\\\\\\\\\\\"/ckfinder/userfiles/files/Reglement%20Festival%202013.pdf\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">R&egrave;glement 2013</span></a></span></p>\r\n<p>\r\n	<a href=\\\\\\\\\\\\\\"/ckfinder/userfiles/files/fiche%20d\\\\\\\\\\\\\\''inscription%202013.pdf\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\">Fiche d&#39;inscription 2013</span></span></a></p>\r\n', 'Festival Inscription Escholiers', 'Festival Inscription Escholiers', 1359581341),
(9, 'Contact', '12 Contact', '<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Les Escholiers<br />\r\n	Th&eacute;&acirc;tre Camille Mugnier<br />\r\n	6 rue Sommeiller</span><br />\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">74000 ANNECY</span></p>\r\n<p>\r\n	06.52.07.87.98</p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">lesescholiers.annecy@gmail.com</span></p>\r\n<p>\r\n	<a href=\\\\\\\\\\\\\\"http://maps.google.fr/maps/place?ftid=0x478b8ff760681945:0x487ab5b5a719677d&amp;q=26+Rue+Sommeiller,+Annecy&amp;hl=fr&amp;authuser=0&amp;cd=1&amp;cad=src:ppiwlink&amp;ei=Nhk9UNipJcf4iAaBuICIAw&amp;dtab=0\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Plan d&#39;acc&egrave;s</span></a></p>\r\n', 'Contact Escholiers', 'Contact Escholiers', 1352138929),
(11, 'Liens', '14- Liens', '<p>\r\n	<a href=\\\\\\\\\\\\\\"http://www.fncta-2-savoie.fr/\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">FNCTA des Deux Savoie</span></span></a></p>\r\n<p>\r\n	<a href=\\\\\\\\\\\\\\"http://theatre.savoie.free.fr/\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Th&eacute;&acirc;tre(s) en Savoie</span></span></a></p>\r\n<p>\r\n	<a href=\\\\\\\\\\\\\\"http://sites.radiofrance.fr/chaines/france-bleu/\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">France Bleu</span></span></a></p>\r\n<p>\r\n	<a href=\\\\\\\\\\\\\\"http://www.annecy.fr/\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Ville d&#39;Annecy</span></span></a></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><a href=\\\\\\\\\\\\\\"http://www.thomaswalser.fr/\\\\\\\\\\\\\\">Thomas Walser</a><br />\r\n	<br />\r\n	<a href=\\\\\\\\\\\\\\"http://www.adhocmusic.net/\\\\\\\\\\\\\\">AdHoc Music</a></span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size: 18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Et retrouvez bien s&ucirc;r <a href=\\\\\\\\\\\\\\"http://www.facebook.com/escholiers.annecy\\\\\\\\\\\\\\">Les Escholiers</a> sur Facebook !</span></span><br />\r\n	&nbsp;</p>\r\n', 'Liens Escholiers', 'Liens Escholiers', 1368442706),
(17, 'Lieux Festival', 'Lieux Festival', '<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size:18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Vous pourrez assister aux pi&egrave;ces du festival dans les deux sites suivants :</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size:18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><strong>Th&eacute;&acirc;tre de l&#39;Echange&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span></span>[plan]<br />\r\n	<span style=\\\\\\\\\\\\\\"font-size:18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">26 rue Sommeiller</span></span><br />\r\n	<span style=\\\\\\\\\\\\\\"font-size:18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">74000 Annecy</span></span></p>\r\n<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size:18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><strong>Salle Pierre Lamy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span></span>[plan]<br />\r\n	<span style=\\\\\\\\\\\\\\"font-size:18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">12 rue de la R&eacute;publique<br />\r\n	74000 Annecy</span></span></p>\r\n', 'lieux festival escholiers', 'lieux festival escholiers', 1361378841),
(18, 'Ils ont jouÃ©', 'Ils ont joue', '<p>\r\n	<span style=\\\\\\\\\\\\\\"font-size:18px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Page en cours de construction</span></span></p>\r\n', 'Ils ont jouÃ© Escholiers', 'Ils ont jouÃ© Escholiers', 1361383421),
(16, 'Accueil', 'accueil', '<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<em><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 48px;\\\\\\\\\\\\\\">Bienvenue sur le site des Escholiers</span></span></em></p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	&nbsp;</p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	&nbsp;</p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 20px;\\\\\\\\\\\\\\">Plus que quatre dates pour Le Mandat... Pensez &agrave; <a href=\\\\\\\\\\\\\\"http://www.lesescholiers.fr/fr/reservation-5.html\\\\\\\\\\\\\\">r&eacute;server</a>!</span></span></p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 20px;\\\\\\\\\\\\\\">Si vous avez aim&eacute; le festival ou Le Mandat, laissez nous un mot dans notre <a href=\\\\\\\\\\\\\\"http://www.lesescholiers.fr/fr/livre-d-or.html?PHPSESSID=869e8d2172944376064897e115f0e372\\\\\\\\\\\\\\">Livre d&#39;or</a>...<br />\r\n	Et pour des infos en direct, pensez &agrave; <a href=\\\\\\\\\\\\\\"https://www.facebook.com/escholiers.annecy\\\\\\\\\\\\\\">Facebook</a>!</span></span></p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	&nbsp;</p>\r\n<p align=\\\\\\\\\\\\\\"center\\\\\\\\\\\\\\">\r\n	<br />\r\n	<span style=\\\\\\\\\\\\\\"font-size: 20px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-size: 24px;\\\\\\\\\\\\\\">A bient&ocirc;t sur sc&egrave;ne!</span></span></span></p>\r\n', 'Les escholiers', 'Site internet des Escholiers, troupe de thÃ©Ã¢tre amateur d\\\\\\''Annecy', 1369466886);

-- --------------------------------------------------------

--
-- Structure de la table `table_personnes`
--

CREATE TABLE IF NOT EXISTS `table_personnes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_groupe` bigint(20) NOT NULL DEFAULT '0',
  `libelle` varchar(200) NOT NULL DEFAULT '',
  `extension` varchar(100) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `table_personnes`
--

INSERT INTO `table_personnes` (`id`, `id_groupe`, `libelle`, `extension`, `description`, `tstp`) VALUES
(26, 3, 'Lili Dubois', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re en 2009-2010 puis depuis 2012</span></span></p>\r\n', 1352065347),
(24, 3, 'Marie Barot', '', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2008</span></span></p>\r\n', 1352065262),
(25, 3, 'Nelly Becuwe', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2008</span></span></p>\r\n', 1352065316),
(22, 3, 'Benjamin De Rossi', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 1995</span></span></p>\r\n', 1352065050),
(23, 2, 'Aymeric Chauffert', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 1991</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Metteur en Sc&egrave;ne</span></span></p>\r\n', 1352066682),
(15, 2, 'Jeanine Ribollet', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 1985</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Pr&eacute;sidente des Escholiers</span></span></p>\r\n', 1352063777),
(16, 2, 'Fabien Christ', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 2010</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Vice-Pr&eacute;sident des Escholiers</span></span></p>\r\n', 1352063929),
(17, 2, 'Benjamin De Rossi', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 1995</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Tr&eacute;sorier, Organisateur du Festival</span></span></p>\r\n', 1352063962),
(18, 2, 'Chantal Tabourot', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 1984</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Secr&eacute;taire</span></span></p>\r\n', 1352065368),
(20, 3, 'Fabien Christ', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 2010</span></span></p>\r\n', 1352065436),
(21, 3, 'Maria Coirier', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2002</span></span></p>\r\n', 1352065226),
(27, 3, 'JoÃ«lle Paulme', '.png', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2010</span></span></p>\r\n', 1352065384),
(28, 3, 'Mellie Barrueco', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2009</span></span></p>\r\n', 1352065332),
(29, 3, 'Bastien Cortes', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Escholier depuis 2012</span></span></p>\r\n', 1352065745),
(30, 3, 'Romain Prioux', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 2012</span></span></p>\r\n', 1352988153),
(32, 3, 'Alvaro Marin', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier de 1983 &agrave; 2007 puis depuis 2011</span></span></p>\r\n', 1352063752),
(33, 3, 'Josiane Walser', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2000</span></span></p>\r\n', 1352065069),
(34, 3, 'Bernard Walser', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 2000</span></span></p>\r\n', 1352065177),
(35, 3, 'Sylvie Galichet', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 1992</span></span></p>\r\n', 1352064032),
(36, 3, 'Carole Siret', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2010</span></span></p>\r\n', 1352065416),
(37, 3, 'Justine Boissier', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2012</span></span></p>\r\n', 1352065701),
(38, 3, 'Arnaud Berthier', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 2012</span></span></p>\r\n', 1352065725),
(39, 4, 'Alain Baravaglio', '', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">D&eacute;cors</span></span></p>\r\n', 1352988052),
(40, 4, 'Nathalie Cottet', '', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\">D&eacute;cors</span></p>\r\n', 1352066663),
(41, 4, 'Gilles Paturel', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">D&eacute;cors</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 2008</span></span></p>\r\n', 1359417293),
(43, 3, 'Laurent Gustin', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 2012</span></span></p>\r\n', 1353740680),
(44, 2, 'Anne Bouvier', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Escholi&egrave;re depuis 2009</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Secr&eacute;taire du Festival</span></span></p>\r\n', 1352987816),
(45, 2, 'Alain Baravaglio', '', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Membre du Bureau</span></span></p>\r\n', 1360442178),
(46, 2, 'Nelly Becuwe', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2008</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Vice-pr&eacute;sidente des Escholiers</span></span></p>\r\n', 1352063803),
(48, 3, 'Cyril Sainton', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholier depuis 2011</span></span></p>\r\n', 1352065456),
(50, 2, 'Mellie Barrueco', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2009</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Responsable Costumes</span></span></p>\r\n', 1352988072),
(49, 4, 'GisÃ¨le De Rossi', '.jpg', '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 20px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Costumi&egrave;re</span></span></p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<span style=\\\\\\"font-size: 20px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">Escholi&egrave;re depuis 2004</span></span></p>\r\n', 1352066642),
(51, 2, 'Carole Siret', '.jpg', '<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<span style=\\\\\\\\\\\\\\"font-size: 20px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Escholi&egrave;re depuis 2010</span></span></p>\r\n<p style=\\\\\\\\\\\\\\"text-align: center;\\\\\\\\\\\\\\">\r\n	<span style=\\\\\\\\\\\\\\"font-size: 20px;\\\\\\\\\\\\\\"><span style=\\\\\\\\\\\\\\"font-family: georgia,serif;\\\\\\\\\\\\\\">Responsable Site web</span></span></p>\r\n', 1360442093);

-- --------------------------------------------------------

--
-- Structure de la table `table_photos`
--

CREATE TABLE IF NOT EXISTS `table_photos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_galerie` bigint(20) NOT NULL,
  `commentaires` varchar(200) NOT NULL DEFAULT '',
  `extension` varchar(5) NOT NULL DEFAULT '',
  `timestamp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

--
-- Contenu de la table `table_photos`
--

INSERT INTO `table_photos` (`id`, `id_galerie`, `commentaires`, `extension`, `timestamp`) VALUES
(36, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347222570),
(34, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1349974870),
(33, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347224390),
(27, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347222895),
(28, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347223222),
(29, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347223465),
(30, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347223596),
(31, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347223707),
(32, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347223808),
(26, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347222689),
(24, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347221858),
(23, 1, 'GÃ©nÃ©rale Dindon 04/2012', '.jpg', 1347221663),
(44, 2, 'Les Petits Escholiers - 2012', '.jpg', 1352063602),
(43, 2, 'Les Petits Escholiers - 2012', '.jpg', 1352063585),
(45, 2, 'Les Petits Escholiers - 2012', '.jpg', 1352063648),
(46, 2, 'Florence Delorme, metteur en scÃ¨ne', '.jpg', 1352063667),
(47, 2, 'RÃ©pÃ©tition', '.jpg', 1354880824),
(48, 3, 'Photographie Pierre Vallet', '.jpg', 1355076883),
(49, 3, 'http://www.youtube.com/watch?v=m5kURsPznXw', '.jpg', 1355077149),
(50, 3, 'Photographie Pierre Vallet', '.jpg', 1355077487),
(51, 3, 'Photographie Pierre Vallet', '.jpg', 1355077891),
(52, 3, 'Photographie Pierre Vallet', '.jpg', 1355078140),
(53, 3, 'Photographie Pierre Vallet', '.jpg', 1355078553),
(54, 3, 'Photographie Pierre Vallet', '.jpg', 1355079212),
(55, 3, 'Photographie Pierre Vallet', '.jpg', 1355079384),
(56, 3, 'Photographie Pierre Vallet', '.jpg', 1355079722),
(57, 3, 'Photographie Pierre Vallet', '.jpg', 1355080096),
(58, 3, 'Photographie Pierre Vallet', '.jpg', 1355080443),
(59, 4, 'Huit Femmes', '.jpg', 1360685530),
(60, 4, 'Huit Femmes', '.jpg', 1360686693),
(61, 4, 'Huit Femmes', '.jpg', 1360686837),
(62, 6, 'La nuit de Valognes', '.jpg', 1361126050),
(63, 6, 'La nuit de Valognes', '.jpg', 1361126068),
(64, 6, 'La nuit de Valognes', '.jpg', 1361126095),
(65, 5, 'Les Femmes Savantes', '.jpg', 1361126121),
(66, 5, 'Les Femmes Savantes', '.jpg', 1361126147),
(67, 7, 'Le Mandat 04/2013', '.jpg', 1367262032),
(68, 7, 'Le Mandat 04/2013', '.jpg', 1367261723),
(69, 7, 'Le Mandat 04/2013', '.jpg', 1367262604),
(70, 7, 'Le Mandat 04/2013', '.jpg', 1367262838),
(71, 7, 'Le Mandat 04/2013', '.jpg', 1367263067),
(72, 7, 'Le Mandat 04/2013', '.jpg', 1367263299),
(73, 7, 'Le Mandat 04/2013', '.jpg', 1367263555),
(74, 7, 'Le Mandat 04/2013', '.jpg', 1367263765),
(75, 7, 'Le Mandat 04/2013', '.jpg', 1367263985),
(76, 7, 'Le Mandat 04/2013', '.jpg', 1367264177),
(77, 7, 'Le Mandat 04/2013', '.jpg', 1367264258),
(83, 7, 'Le Mandat 04/2013', '.jpg', 1367265934),
(79, 7, 'Le Mandat 04/2013', '.jpg', 1367264560),
(80, 7, 'Le Mandat 04/2013', '.jpg', 1367264768),
(81, 7, 'Le Mandat 04/2013', '.jpg', 1367264954),
(82, 7, 'Le Mandat 04/2013', '.jpg', 1367265173),
(84, 7, 'Le Mandat 04/2013', '.jpg', 1367266080),
(85, 7, 'Le Mandat 04/2013', '.jpg', 1367266262),
(86, 7, 'Le Mandat 04/2013', '.jpg', 1367266538),
(87, 7, 'Le Mandat 04/2013', '.jpg', 1367266712),
(88, 7, 'Le Mandat 04/2013', '.jpg', 1367266893),
(89, 7, 'Le Mandat 04/2013', '.jpg', 1367267782),
(90, 7, 'Le Mandat 04/2013', '.jpg', 1367267919),
(91, 7, 'Le Mandat 04/2013', '.jpg', 1367268219),
(92, 7, 'Le Mandat 04/2013', '.jpg', 1367268495),
(93, 7, 'Le Mandat 04/2013', '.jpg', 1367268661),
(94, 7, 'Le Mandat 04/2013', '.jpg', 1367269009),
(96, 7, 'Le Mandat 04/2013', '.jpg', 1367269500),
(97, 7, 'Le Mandat 04/2013', '.jpg', 1367269638),
(98, 7, 'Le Mandat 04/2013', '.jpg', 1367269882),
(99, 7, 'Le Mandat 04/2013', '.jpg', 1367270093),
(100, 7, 'Le Mandat 04/2013', '.jpg', 1367270476),
(101, 7, 'Le Mandat 04/2013', '.jpg', 1367270738),
(102, 7, 'Le Mandat 04/2013', '.jpg', 1367270920),
(103, 7, 'Le Mandat 04/2013', '.jpg', 1367271134),
(104, 7, 'Le Mandat 04/2013', '.jpg', 1367271262),
(105, 7, 'Le Mandat 04/2013', '.jpg', 1367271552),
(106, 7, 'Le Mandat 04/2013', '.jpg', 1367271753),
(107, 7, 'Le Mandat 04/2013', '.jpg', 1367272059),
(108, 7, 'Le Mandat 04/2013', '.jpg', 1367272381),
(109, 7, 'Le Mandat 04/2013', '.jpg', 1367272599),
(110, 7, 'Le Mandat 04/2013', '.jpg', 1367273055),
(111, 7, 'Le Mandat 04/2013', '.jpg', 1367273240),
(158, 8, 'GÃ©omÃ©trie du Triangle IsocÃ¨le (HÃ©ricy s/ ScÃ¨ne) - 10/05/13', '.jpg', 1368476307),
(161, 8, 'Nature et DÃ©passement (la Troupe de Poche) - 10/05/13', '.jpg', 1368477139),
(160, 8, 'Nature et DÃ©passement (la Troupe de Poche) - 10/05/13', '.jpg', 1368476761),
(159, 8, 'Salle Pierre Lamy - 10/05/13', '.jpg', 1368476571),
(118, 8, 'Dingy Toys, thÃ©Ã¢tre d\\\\\\''impro (spectacle d\\\\\\''ouverture) - 8/05/13', '.jpg', 1368385117),
(119, 8, 'Dingy Toys, thÃ©Ã¢tre d\\\\\\''impro (spectacle d\\\\\\''ouverture) - 8/05/13', '.jpg', 1368385363),
(201, 9, '13/05/2013 - Le DauphinÃ© LibÃ©rÃ©', '.jpg', 1369066297),
(121, 8, 'Dingy Toys, thÃ©Ã¢tre d\\\\\\''impro (spectacle d\\\\\\''ouverture) - 8/05/13', '.jpg', 1368385598),
(200, 9, '13/05/2013 - Le DauphinÃ© LibÃ©rÃ©', '.jpg', 1369066010),
(199, 9, '6/05/2013 - Le DauphinÃ© LibÃ©rÃ©', '.jpg', 1369066341),
(124, 8, 'Dingy Toys, thÃ©Ã¢tre d\\\\\\''impro (spectacle d\\\\\\''ouverture) - 8/05/13', '.jpg', 1368386036),
(197, 1, 'Le Dindon (salle PIerre Lamy) 04/2012', '.jpg', 1369064308),
(196, 1, 'Le Dindon (salle PIerre Lamy) 04/2012', '.jpg', 1369063897),
(157, 8, 'GÃ©omÃ©trie du Triangle IsocÃ¨le (HÃ©ricy s/ ScÃ¨ne) - 10/05/13', '.jpg', 1368476090),
(129, 8, 'Dingy Toys, thÃ©Ã¢tre d\\\\\\''impro (spectacle d\\\\\\''ouverture) - 8/05/13', '.jpg', 1368386676),
(131, 8, 'Les Petits Escholiers (spectacle d\\\\\\''ouverture) - 8/05/13', '.jpg', 1368386893),
(132, 8, 'Les Petits Escholiers (spectacle d\\\\\\''ouverture) - 8/05/13', '.jpg', 1368387085),
(133, 8, 'Les Petits Escholiers (spectacle d\\\\\\''ouverture) - 8/05/13', '.jpg', 1368387185),
(134, 8, 'Escholiers - 9/05/13', '.jpg', 1368387304),
(195, 1, 'Le Dindon (salle PIerre Lamy) 04/2012', '.jpg', 1369063704),
(136, 8, 'Escholiers - 9/05/13', '.jpg', 1368387613),
(137, 8, 'Le Malade Imaginaire (ThÃ©Ã¢tre des Faces-Ã -Mains) - 9/05/13', '.jpg', 1368389585),
(138, 8, 'Le Malade Imaginaire (ThÃ©Ã¢tre des Faces-Ã -Mains) - 9/05/13', '.jpg', 1368389831),
(139, 8, 'Le Malade Imaginaire (ThÃ©Ã¢tre des Faces-Ã -Mains) - 9/05/13', '.jpg', 1368390038),
(140, 8, 'Le Malade Imaginaire (ThÃ©Ã¢tre des Faces-Ã -Mains) - 9/05/13', '.jpg', 1368390159),
(156, 8, 'GÃ©omÃ©trie du Triangle IsocÃ¨le (HÃ©ricy s/ ScÃ¨ne) - 10/05/13', '.jpg', 1368475868),
(142, 8, 'Le Malade Imaginaire (ThÃ©Ã¢tre des Faces-Ã -Mains) - 9/05/13', '.jpg', 1368390585),
(143, 8, 'Le Malade Imaginaire (ThÃ©Ã¢tre des Faces-Ã -Mains) - 9/05/13', '.jpg', 1368390687),
(144, 8, 'Le Malade Imaginaire (ThÃ©Ã¢tre des Faces-Ã -Mains) - 9/05/13', '.jpg', 1368390898),
(145, 8, 'Le Roi Victor (La Malle au Grenier) -9/05/13', '.jpg', 1368387719),
(146, 8, 'Le Roi Victor (La Malle au Grenier) -9/05/13', '.jpg', 1368387815),
(147, 8, 'Le Roi Victor (La Malle au Grenier) -9/05/13', '.jpg', 1368387882),
(148, 8, 'L\\\\\\''inconnu du Pont Neuf (Cie ThÃ©Ã¢tre du Gelohann) - 9/05/13', '.jpg', 1368387979),
(149, 8, 'L\\\\\\''inconnu du Pont Neuf (Cie ThÃ©Ã¢tre du Gelohann) - 9/05/13', '.jpg', 1368388237),
(150, 8, 'Escholiers - 9/05/13', '.jpg', 1368388384),
(151, 8, 'L\\\\\\''inconnu du Pont Neuf (Cie ThÃ©Ã¢tre du Gelohann) - 9/05/13', '.jpg', 1368388550),
(152, 8, 'L\\\\\\''inconnu du Pont Neuf (Cie ThÃ©Ã¢tre du Gelohann) - 9/05/13', '.jpg', 1368388660),
(153, 8, 'Nos amis les Humains (Espace ThÃ©Ã¢tre) - 9/05/13', '.jpg', 1368388861),
(154, 8, 'Nos amis les Humains (Espace ThÃ©Ã¢tre) - 9/05/13', '.jpg', 1368389176),
(155, 8, 'Nos amis les Humains (Espace ThÃ©Ã¢tre) - 9/05/13', '.jpg', 1368389385),
(162, 8, 'Nature et DÃ©passement (la Troupe de Poche) - 10/05/13', '.jpg', 1368477353),
(163, 8, 'La LeÃ§on (ThÃ©Ã¢tre d\\\\\\''en Haut) - 10/05/13', '.jpg', 1368477570),
(164, 8, 'La LeÃ§on (ThÃ©Ã¢tre d\\\\\\''en Haut) - 10/05/13', '.jpg', 1368477745),
(165, 8, 'La LeÃ§on (ThÃ©Ã¢tre d\\\\\\''en Haut) - 10/05/13', '.jpg', 1368478028),
(166, 8, 'Escholiers - 10/05/13', '.jpg', 1368478172),
(167, 8, 'Landru tout feu tout femme (cie Zig Zag) - 10/05/13', '.jpg', 1368478504),
(168, 8, 'Landru tout feu tout femme (cie Zig Zag) - 10/05/13', '.jpg', 1368478616),
(169, 8, 'Landru tout feu tout femme (cie Zig Zag) - 10/05/13', '.jpg', 1368478930),
(170, 8, 'Landru tout feu tout femme (cie Zig Zag) - 10/05/13', '.jpg', 1368479106),
(171, 8, 'Une BÃªte sur la Lune (Cie ThÃ©Ã¢tre Jean Thomas) - 11/05/13', '.jpg', 1368559102),
(172, 8, 'Une BÃªte sur la Lune (Cie ThÃ©Ã¢tre Jean Thomas) - 11/05/13', '.jpg', 1368559274),
(173, 8, 'Une BÃªte sur la Lune (Cie ThÃ©Ã¢tre Jean Thomas) - 11/05/13', '.jpg', 1368559479),
(174, 8, 'Une BÃªte sur la Lune (Cie ThÃ©Ã¢tre Jean Thomas) - 11/05/13', '.jpg', 1368559659),
(175, 8, 'Hors Sec (G.E.S.T.) - 11/05/13', '.jpg', 1368559810),
(176, 8, 'Hors Sec (G.E.S.T.) - 11/05/13', '.jpg', 1368560152),
(177, 8, 'Hors Sec (G.E.S.T.) - 11/05/13', '.jpg', 1368560378),
(178, 8, 'Hors Sec (G.E.S.T.) - 11/05/13', '.jpg', 1368560654),
(179, 8, 'Le Dernier Train (Cie TA 58) - 11/05/13', '.jpg', 1368560806),
(180, 8, 'Le Dernier Train (Cie TA 58) - 11/05/13', '.jpg', 1368561041),
(181, 8, 'Vive le Roi (La Barcarolle) - 11/05/13', '.jpg', 1368561253),
(182, 8, 'Vive le Roi (La Barcarolle) - 11/05/13', '.jpg', 1368561465),
(183, 8, 'Vive le Roi (La Barcarolle) - 11/05/13', '.jpg', 1368561746),
(184, 8, 'Vive le Roi (La Barcarolle) - 11/05/13', '.jpg', 1368562038),
(185, 8, 'ClÃ´ture, Pierre Launay - 12/05/13', '.jpg', 1368562243),
(186, 8, 'ClÃ´ture, Thomas Walser - 12/05/13', '.jpg', 1368562484),
(187, 8, 'ClÃ´ture - 12/05/13', '.jpg', 1368562771),
(188, 8, 'ClÃ´ture - 12/05/13', '.jpg', 1368562938),
(189, 8, 'ClÃ´ture - 12/05/13', '.jpg', 1368563150),
(190, 8, 'ClÃ´ture, Prix du Public - 12/05/13', '.jpg', 1368563406),
(191, 8, 'ClÃ´ture, Prix Coup de Coeur - 12/05/13', '.jpg', 1368563817),
(192, 8, 'ClÃ´ture, Prix de la Ville d\\\\\\''Annecy - 12/05/13', '.jpg', 1368564027),
(193, 8, 'ClÃ´ture, Prix Camille Mugnier - 12/05/13', '.jpg', 1368564256),
(194, 8, 'Mairie d\\\\\\''Annecy - 12/05/13', '.jpg', 1368564656);

-- --------------------------------------------------------

--
-- Structure de la table `table_presentations`
--

CREATE TABLE IF NOT EXISTS `table_presentations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_spectacle` bigint(20) NOT NULL,
  `content` longtext NOT NULL,
  `title` varchar(200) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `table_presentations`
--

INSERT INTO `table_presentations` (`id`, `id_spectacle`, `content`, `title`, `description`, `tstp`) VALUES
(1, 3, '<p>\r\n	Note that choosing a template at this point does not imply that you can&rsquo;t change language later. For example, you can create a new application using the default Java application template and start adding Scala code whenever you like. modif</p>\r\n', 'title spectacle1 modif', 'description spectacle 1 modif', 1360862991),
(5, 5, '<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<br />\r\n	<strong><span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">LE MANDAT, de Nicolai Erdman, &eacute;crit en 1925</span></span></strong></p>\r\n<p>\r\n	<br />\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Nous sommes en Russie en 1924, dans un immeuble locatif. La r&eacute;volution communiste a eu lieu.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Les Gouliatchkine, anciens commer&ccedil;ants petits bourgeois, ont perdu leur statut. Les Sm&eacute;tanitch, famille de la noblesse, craignent leur futur sous ce nouveau r&eacute;gime. Ces deux familles essayent par tous les moyens de bien se faire voir du r&eacute;gime en place, ce qui am&egrave;ne &agrave; des situations rocambolesques.</span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Pi&egrave;ce irr&eacute;sistiblement dr&ocirc;le, &eacute;voluant sur un rythme d&eacute;brid&eacute;, on retrouve dans Le Mandat la d&eacute;mesure toute sovi&eacute;tique des sentiments. Elle est &eacute;galement une r&eacute;flexion am&egrave;re sur l&#39;individu, ses petites compromissions, ses ambitions et le poids du pass&eacute;.</span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style=\\\\\\"text-align: center;\\\\\\">\r\n	<img alt=\\\\\\"\\\\\\" src=\\\\\\"/ckfinder/userfiles/images/Le%20mandat_300x400.jpg\\\\\\" style=\\\\\\"width: 500px; height: 667px;\\\\\\" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\"><u>Distribution</u> (par ordre d&#39;apparition sur sc&egrave;ne) : </span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Nadiejda Petrovna Gouliatchkina : <em>Josiane Walser</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Pavel Sergue&iuml;evitch Gouliatchkine : <em>Fabien Christ</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Ivan Ivanovitch Chironkine : <em>Benjamin De Rossi</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Varvara Sergue&iuml;evna Gouliatchkina : <em>Lili Dubois / Carole Siret </em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Anastassia Nikola&iuml;evna Poupkina, dite Nastia : <em>Sylvie Galichet / Jo&euml;lle Paulme</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Tamara Leopoldovna Vichnevetska&iuml;a : <em>Mellie Barrueco</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">La joueuse d&#39;orgue de Barbarie : <em>Jeanine Ribollet</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Olympe Val&eacute;rianovna Sm&eacute;tanitch : <em>Nelly Becuwe</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Val&eacute;rian Olympovitch Sm&eacute;tanitch : <em>Romain Prioux</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Le joueur de tambour : <em>Bastien Cortes / Carole Siret</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Autonome Sigismondovitch : <em>Bernard Walser</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Agafange : <em>Laurent Gustin / Cyril Sainton</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Anatole Olympovitch Sm&eacute;tanitch : <em>Justine Boissier / Bastien Cortes</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">F&eacute;litsata Gorde&iuml;evna : <em>Maria Coirier</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Stepane Stepanovitch : <em>Arnaud Berthier</em></span></span></p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">Ilinkine : <em>Alvaro Marin</em></span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size: 18px;\\\\\\">N.B. : Repr&eacute;sentations des PETITS&nbsp;ESCHOLIERS les 28 et 29 JUIN 2013</span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 'Le mandat - Les escholiers', 'Le mandat - Les escholiers', 1364419604);

-- --------------------------------------------------------

--
-- Structure de la table `table_presentation_compagnie`
--

CREATE TABLE IF NOT EXISTS `table_presentation_compagnie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) NOT NULL DEFAULT '',
  `contenu` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `table_presentation_compagnie`
--

INSERT INTO `table_presentation_compagnie` (`id`, `titre`, `contenu`) VALUES
(1, 'PrÃ©sentation', '<p>\r\n	Fort de son anciennet&eacute; (cf &quot;Historique&quot;), la Troupe a continu&eacute; ce qui avait &eacute;t&eacute; d&eacute;cid&eacute; dans le pass&eacute; : nous accueillons tout le monde, &agrave; condition qu&#39;ils acceptent non seulement les joies du th&eacute;&acirc;tre amateur, mais aussi les contraintes.</p>\r\n<p>\r\n	En effet, un engagement aupr&egrave;s des Escholiers repr&eacute;sente deux r&eacute;p&eacute;titions par semaine, les mardis et vendredis soirs, plus un dimanche mensuel pendant le premier trimestre de chaque ann&eacute;e.<br />\r\n	Il faut &eacute;galement assurer les repr&eacute;sentations annuelles (environ 18) ou pr&eacute;voir des remplacements avec sa doublure, participer activement au Festival de th&eacute;&acirc;tre amateur qui a lieu le week-end de l&#39;Ascension, et enfin&nbsp;prendre part &agrave; tout ce qui se fait au sein de la Troupe (aider &agrave; l&#39;&eacute;laboration, au montage et d&eacute;montage des d&eacute;cors, ranger la salle o&ugrave;&nbsp;se trouve les d&eacute;cors, etc), se plier aux d&eacute;cisions prises par le Comit&eacute;, accepter les d&eacute;cisions du Metteur en sc&egrave;ne...</p>\r\n<p>\r\n	En un mot : &quot; ETRE ESCHOLIER A PART ENTIERE&quot; !</p>\r\n<p>\r\n	Heureusement, toutes ces contraintes sont contre balanc&eacute;es par le plaisir d&#39;&ecirc;tre sur sc&egrave;ne et de partager notre passion commune. Et c&#39;est avec plaisir que nous vous invitons &agrave; venir voir par vous-m&ecirc;me, lors de nos prochaines repr&eacute;sentations !</p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `table_reservations`
--

CREATE TABLE IF NOT EXISTS `table_reservations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_evenement` bigint(20) NOT NULL,
  `nom` varchar(100) NOT NULL DEFAULT '',
  `prenom` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `telephone` varchar(20) NOT NULL DEFAULT '',
  `nb_places` varchar(4) NOT NULL DEFAULT '',
  `groupes` tinyint(4) NOT NULL DEFAULT '0',
  `newsletter` tinyint(4) NOT NULL DEFAULT '0',
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Contenu de la table `table_reservations`
--

INSERT INTO `table_reservations` (`id`, `id_evenement`, `nom`, `prenom`, `email`, `telephone`, `nb_places`, `groupes`, `newsletter`, `tstp`) VALUES
(47, 18, 'NOAILHET', 'ANNIE', 'annie.noailhet@free.fr', 'O4 50 27 80 11', '2', 1, 1, 1365153906),
(37, 19, 'belmonte pena', 'claire', 'claire.belmontepena@sfr.fr', '0450235704', '1', 0, 1, 1363528198),
(38, 23, 'boukharak', 'rhemo', 'rhemoboukharak@hotmail.fr', '0617508278', '2', 1, 1, 1363776742),
(39, 25, 'LiÃ¨vre', 'VÃ©ronique', 'veronique.lievre@gmail.com', '0688703440', '5', 1, 0, 1363892530),
(40, 18, 'HESLON', 'CHRISTOPHER', 'topher74@hotmail.fr', '0689140622', '3', 1, 0, 1363944279),
(46, 21, 'SCHUSTER', 'MÃ©lanie', 'melmorese@yahoo.fr', '06.63.23.29.68.', '3', 1, 0, 1365146391),
(45, 24, 'FABRE', 'Nathalie', 'fabrenathalie47@neuf.fr', '0662667167', '3', 1, 1, 1365060169),
(44, 17, 'CLEMENT', 'FranÃ§oise', 'joelleclement@hotmail.fr', '04 50 23 17 14', '2', 1, 0, 1364479160),
(43, 22, 'Perrier', 'Alfred', 'alfred.perrier@gmail.com', '0662816996', '1', 1, 0, 1364377400),
(41, 22, 'Perrier', 'Alfred', 'alfred.perrier@gmail.com', '0662816996', '2', 1, 1, 1364195328),
(42, 22, 'Perrier', 'Alfred', 'alfred.perrier@gmail.com', '0662816996', '1', 1, 0, 1364197458),
(36, 36, 'FONTAINE', 'Guillaume', 'kangooroo1981@yahoo.fr', '0623086411', '1', 0, 0, 1362132149),
(23, 33, 'jarre', 'nathalie', 'jarre.family@wanadoo.fr', '0616864757', '2', 1, 0, 1359960468),
(56, 18, 'CALLOT', 'Emmanuelle', 'callot.emmanuelle@gmail.com', '0685290445', '4', 1, 0, 1365491247),
(55, 24, 'CLIVILLE', 'CLAUDIE', 'claudie.cliville@free.fr', '0673801699', '3', 1, 1, 1365438361),
(54, 18, 'DIARD', 'CAROLINE', 'cdiard@hotmail.com', '0671144731', '2', 1, 0, 1365432806),
(53, 27, 'paulme', 'caroline', 'cpaulme@priams.fr', '0689140622', '2', 1, 0, 1365430966),
(52, 19, 'THUILLOT', 'claude', 'mamcapucine1@hotmail.fr', '0611941065', '1', 1, 0, 1365423580),
(51, 18, 'jacquot', 'chantal', 'chantal.jacquot@live.fr', '0610695702', '4', 1, 0, 1365410210),
(50, 21, 'BERSINGER', 'ROLAND', 'roland.bersinger@wanadoo.fr', '0683498526', '4', 1, 0, 1365408921),
(49, 19, 'VIOLLET', 'CATHERINE', 'catherine.viollet@cdg74.fr', '0687730402', '2', 0, 0, 1365404276),
(48, 17, 'Hardibo (test webmaster)', 'Pierre-jean', 'hardibopj@hotmail.fr', '06060606', '2', 1, 0, 1365266575),
(57, 17, 'PRIOUX', 'FRANCOIS', 'francois.prioux@wurth.fr', '0607212514', '2', 1, 0, 1365491530),
(58, 18, 'PAUL', 'MARIE-FRANCE', 'mfpaul@free.fr', '0614961819', '2', 1, 1, 1365530005),
(59, 19, 'PATRON', 'JEAN MARC', 'jmp.accro@gmail.com', '0450515802', '3', 1, 0, 1365535328),
(60, 32, 'FERRAUD', 'CÃ©line', 'ferraudsc@free.fr', '0684442282', '4', 1, 0, 1365601390),
(61, 21, 'VALENTINI', 'patricia', 'patricia.valentini@hotmail.fr', '0676996376', '4', 1, 0, 1365616673),
(62, 18, 'FONTAINE', 'Isabelle', 'fontaine.isabelle@live.fr', '0685605215', '3', 1, 0, 1365678376),
(63, 18, 'Neyrolles', 'Fabrice', 'fabrice.neyrolles@gmail.com', '0672659679', '3', 1, 0, 1365754914),
(64, 18, 'VISINI', 'Simone', 'simone.visini@orange.fr', '04 50 22 91 34', '2', 1, 0, 1365756573),
(65, 18, 'Auceps', 'Jean-Baptiste', 'fabrice.neyrolles@gmail.com', '0672659679', '1', 0, 0, 1365842729),
(66, 20, 'MAUVAIS', 'LAURENCE', 'laurencemauvais@orange.fr', '0614042737', '3', 1, 0, 1366111086),
(67, 22, 'Perrier', 'Sandie', 'sandie.perrier@gmail.com', '0623233208', '1', 0, 0, 1366229924),
(68, 20, 'plessis', 'reale', 'reale_plessis@yahoo.fr', '0450577880', '2', 1, 0, 1366277982),
(69, 17, 'Tang', 'Claire', 'compte74000@gmail.com', '0450231712', '2', 1, 0, 1366365229),
(70, 21, 'dekoninck', 'lucie', 'lucie.dekoninck@gmail.com', '0617431814', '2', 1, 1, 1366372328),
(71, 20, 'ZÃ©ro', 'Fisher', 'dggdjj@yeteb.fr', '0199876453', '4', 1, 0, 1366393546),
(72, 27, 'mulliez', 'nathalie', 'nmulliez@yahoo.fr', '0684721385', '3', 1, 1, 1366566138),
(73, 23, 'CABANNE', 'Mathilde', 'mathilde.cabanne@gmail.com', '0631257643', '2', 1, 0, 1366707832),
(74, 23, 'LANFANT', 'Caroline', 'caroline.lanfant@gmail.com', '0664834103', '2', 1, 0, 1366790221),
(75, 23, 'ARBEZ', 'Emilien', 'arbezemile@hotmail.fr', '0648489156', '2', 1, 0, 1366791966),
(76, 23, 'FALCONNET', 'Marine', 'falconnetmarine@hotmail.com', '0658113187', '2', 1, 0, 1366797136),
(77, 24, 'bezier', 'isabelle', 'isabellemarie.bezier@laposte.net', '0616925971', '2', 1, 1, 1366800632),
(78, 25, 'Berriguiot', 'Cedric', 'cedric.berriguiot@gmail.com', '0675208750', '1', 0, 0, 1366814275),
(79, 23, 'ROUSSEAUX', 'MARIE-JOSE', 'mj.rousseaux@orange.fr', '0610775024', '2', 1, 0, 1366958028),
(80, 23, 'Zeghida', 'Nadia', 'nadia.zeghida@orange.fr', '0616158292', '1', 0, 0, 1366984428),
(81, 24, 'ZEGHIDA', 'Nadia', 'nadia.zeghida@orange.fr', '0616158292', '1', 0, 0, 1366984478),
(82, 23, 'Badoinot', 'Florie', 'florie.badoinot@hotmail.fr', '0621559759', '3', 1, 0, 1366986427),
(83, 25, 'ECUER-MACHADO', 'MARIE', 'mr2machado@orange.fr', '0661510274', '3', 1, 0, 1367009857),
(84, 25, 'Forestier', 'Cindy', 'ci.forestier@orange.fr', '0643643938', '2', 1, 0, 1367049051),
(85, 25, 'Vacher', 'Gilles', 'gillesvacher@hotmail.com', '0686315214', '2', 1, 1, 1367097950),
(86, 27, 'DUPARC', 'Philippe', 'pduparc@usa.net', '0661291635', '2', 1, 1, 1367137875),
(87, 37, 'collet', 'pascal', 'pascal.collet60@gmail.com', '0630394109', '4', 1, 0, 1367306019),
(88, 42, 'vilotta', 'annelise', 'annelise.vilotta@gmail.com', '0677182281', '3', 1, 0, 1367307804),
(89, 42, 'DEDEYSTERE', 'Xavier', 'x.dedeystere@gmail.com', '0625062745', '2', 1, 0, 1367311735),
(90, 34, 'SEGURET', 'CHARLOTTE', 'seguretc@hotmail.com', '0623157493', '2', 1, 0, 1367313929),
(91, 42, 'bocquet', 'bernadette', 'bernadette.bocquet@gmail.com', '0450576622', '2', 1, 0, 1367316182),
(92, 30, 'DEKEYNE', 'Dominique', 'dodekeyne@hotmail.fr', '06 73 35 74 37', '3', 1, 0, 1367316245),
(93, 27, 'BELMONTE PENA', 'claire', 'claire.belmontepena@sfr.fr', '0450235704', '1', 0, 0, 1367316717),
(94, 33, 'CROUZAT', 'MichÃ¨le', 'michelecrouzat@aol.com', '0450526641', '2', 1, 1, 1367338508),
(95, 42, 'BLANC', 'Paul', 'paul.blanc723@orange.fr', '0450020527', '1', 0, 0, 1367506668),
(96, 35, 'POECHE', 'Simone', 'poeche.simone@orange.fr', '0681552275', '6', 1, 0, 1367519742),
(97, 27, 'VERMET', 'ERIC', 'erikat@infonie.fr', '0676183593', '1', 0, 0, 1367526330),
(98, 33, 'AVET', 'denise', 'damarket@free.fr', '0677431995', '4', 1, 0, 1367562798),
(99, 34, 'DONZIER', 'HELENE', 'hdonzier@orange.fr', '0688615516', '2', 1, 0, 1367569657),
(100, 42, 'ketterer-pignarre', 'christine', 'christipigna@orange.fr', '0450673833', '2', 0, 1, 1367570789),
(101, 27, 'GREZE', 'Sylvain', 'syl2074@gmail.com', '0618082220', '2', 1, 0, 1367583679),
(102, 27, 'veiga', 'sandrine', 'veiga_s@yahoo.fr', '0629337986', '2', 1, 0, 1367609680),
(103, 27, 'SOL', 'Patrick', 'dunniamateu@hotmail.com', '0952126865', '4', 1, 1, 1367658522),
(104, 27, 'NUER', 'PIERRE', 'nuer.famille@wanadoo.fr', '0673354811', '2', 1, 1, 1367681993),
(105, 34, 'PlanÃ¨s', 'Micheline et AndrÃ©', 'micheline.planes@hotmail.fr', '0450683285', '2', 1, 0, 1367698289),
(106, 32, 'vernierervernierERNIER', 'MmartineARTINE', 'vernier.m@hotmail.fr', '0669303505', '4', 1, 0, 1367841949),
(107, 31, 'PAGET', 'Jean-Paul', 'paget.jeanpaul@neuf.fr', '0608378431', '2', 1, 0, 1368169560),
(108, 36, 'MASSONmmmmmm', 'nadineNADINE', 'nadine.masson@yahoo.fr', '0450519897', '1', 0, 0, 1368179384),
(109, 31, 'jacquemin', 'chantal', 'thomas.jacquemin@wanadoo.fr', '0688934730', '1', 0, 0, 1368195291),
(110, 31, 'PAGET', 'Jean-Paul', 'paget.jeanpaul@neuf.fr', '0608378431', '1', 1, 0, 1368256622),
(111, 35, 'DUFOURNET', 'HÃ©lÃ¨ne', 'helene_dufournet@yahoo.fr', '06 22 22 90 30', '2', 1, 0, 1368385623),
(112, 30, 'lemay', 'catherine', 'clemay2@gmail.com', '0621678990', '2', 1, 1, 1368524143),
(113, 31, 'SOUDAN ROSSERO', 'ELIANE', 'eliane.soudan-rossero@neuf.fr', '0615352241', '1', 0, 0, 1368544922),
(114, 31, 'Fargier', 'Jean-Claude', 'fargierjc@hotmail.fr', '0450673946', '2', 1, 0, 1368561702),
(115, 32, 'BERTHOD', 'FranÃ§ois', 'pf.berthod@orange.fr', '04 50 27 13 44', '2', 1, 0, 1368687451),
(116, 31, 'GUENOT', 'Anne-Marie', 'amguenot@hotmail.fr', '0618269491', '5', 1, 0, 1368700191),
(117, 24, 'BOGUET', 'isabelle', 'isalbo@sfr.fr', '0778952755', '3', 1, 0, 1368729085),
(118, 30, 'BOGUET', 'Isabelle', 'isalbo@sfr.fr', '0778952755', '3', 1, 0, 1368729197),
(119, 31, 'Malnati', 'Florie', 'arwen832@hotmail.com', '0675937076', '2', 0, 0, 1368873283),
(120, 32, 'Antoine', 'Jean-Yves', 'jy.antoine@sfr.fr', '0620029152', '1', 0, 0, 1368894346),
(121, 35, 'BORCARD ', 'CHRISTINE', 'christine.borcard@wanadoo.fr', '0663017745', '3', 1, 1, 1369083020),
(122, 33, 'poussineau', 'anne-sophie', 'poussineau.anne-sophie@neuf.fr', '0661582707', '4', 1, 0, 1369304287),
(123, 33, 'chaverot', 'nadine', 'moutonnadine@orange.fr', '0687411813', '2', 1, 0, 1369323143),
(124, 35, 'PECOCUX', 'Pascale', 'eslipa@hotmail.fr', '0678121141', '1', 0, 0, 1369335522),
(125, 35, 'GrÃ©delue', 'Christine', 'c.gredelue@free.fr', '0450022653', '1', 0, 0, 1369338868),
(126, 35, 'MEROUR', 'Christian', 'karpinos@hotmail.fr', '0619033749', '1', 0, 0, 1369344669),
(127, 35, 'jacquet', 'sylvie', 'sylvie.jacquet@gmail.com', '0687881599', '2', 0, 0, 1369377705),
(128, 33, 'Tissot', 'Nicolas', 'nicolas_tissot74@hotmail.com', '0664977227', '2', 0, 0, 1369415328),
(129, 33, 'LACROIX ', 'SERGE', 'lacroixserge7400@yahoo.fr', '0680588011', '1', 0, 0, 1369468581),
(130, 35, 'reyne', 'dominique', 'dominiquereyne@orange.fr', '0619231772', '1', 0, 0, 1369469179),
(131, 35, 'MARTINEZ', 'roger', 'roger.martinez@live.fr', '0684410089', '2', 1, 0, 1369511883),
(132, 37, 'MUGNIER', 'Annie', 'francmugnier@wanadoo.fr', '0450221117', '2', 1, 0, 1369578283),
(133, 36, 'LAMBOUR', 'LAURENT', 'christilaur@gmail.com', '0646792700', '4', 1, 0, 1369675011),
(134, 36, 'LAMBOUR', 'LAURENT', 'christilaur@gmail.com', '0646792700', '4', 1, 0, 1369675013),
(135, 36, 'LAMBOUR', 'LAURENT', 'christilaur@gmail.com', '0646792700', '4', 1, 0, 1369675014),
(136, 35, 'raffner', 'yael', 'yael208@hotmail.com', '0625431298', '4', 0, 0, 1369676195),
(137, 35, 'COLOMB', 'GrÃ©gory', 'greg02bis@hotmail.fr', '0662611981', '2', 0, 0, 1369681767),
(138, 34, 'BLACHE', 'Coralie', 'coralieblache@gmail.com', '0650676764', '1', 0, 0, 1369729042),
(139, 35, 'CLEMENT', 'Martine', 'joelleclement@hotmail.fr', '0678758917', '1', 0, 0, 1369737024),
(140, 35, 'curtelin', 'elisabeth', 'e.curtelin@free.fr', '0672146913', '1', 0, 0, 1369749873),
(141, 34, 'ARNAUD', 'Catherine', 'cat.arnaud@orange.fr', '0620531103', '2', 0, 0, 1369810177),
(142, 35, 'Binet', 'Patrice', 'pbinet@gmx.net', '0672520794', '2', 1, 0, 1369828620),
(143, 34, 'COURVALIN', 'marie jose', 'mjcourvalin@live.fr', '0681549197', '2', 1, 0, 1369832154);

-- --------------------------------------------------------

--
-- Structure de la table `table_salles`
--

CREATE TABLE IF NOT EXISTS `table_salles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_spectacle` bigint(20) NOT NULL DEFAULT '0',
  `libelle` varchar(200) NOT NULL DEFAULT '',
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `table_salles`
--

INSERT INTO `table_salles` (`id`, `id_spectacle`, `libelle`, `tstp`) VALUES
(6, 5, 'ThÃ©Ã¢tre de l\\\\\\''Echange', 1353453875);

-- --------------------------------------------------------

--
-- Structure de la table `table_spectacles`
--

CREATE TABLE IF NOT EXISTS `table_spectacles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) NOT NULL DEFAULT '',
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `table_spectacles`
--

INSERT INTO `table_spectacles` (`id`, `libelle`, `etat`, `tstp`) VALUES
(8, 'nom du spectacle 2', 0, 3),
(5, 'Le Mandat', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `table_texte_reservation`
--

CREATE TABLE IF NOT EXISTS `table_texte_reservation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_spectacle` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `tstp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `table_texte_reservation`
--

INSERT INTO `table_texte_reservation` (`id`, `id_spectacle`, `content`, `tstp`) VALUES
(2, 3, '<h1>\r\n	test tarifs modif</h1>\r\n<p>\r\n	test tarifs modif</p>\r\n', 1360517971),
(4, 5, '<h2>\r\n	<span style=\\\\\\"font-size:18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size:22px;\\\\\\">Tarifs</span></span></span></h2>\r\n<div>\r\n	<span style=\\\\\\"font-size:18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size:20px;\\\\\\">Normal : 10 &euro;</span></span></span></div>\r\n<div>\r\n	<span style=\\\\\\"font-size:20px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">R&eacute;duit </span></span><span style=\\\\\\"font-size:18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size:20px;\\\\\\">: 5 &euro; </span></span></span><span style=\\\\\\"font-size:18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\">(&eacute;tudiant, &agrave; partir de 12 ans,&nbsp;adh&eacute;rent &agrave; la FNCTA, demandeur d&#39;emploi)</span></span></div>\r\n<div>\r\n	<span style=\\\\\\"font-size:18px;\\\\\\"><span style=\\\\\\"font-family: georgia,serif;\\\\\\"><span style=\\\\\\"font-size:20px;\\\\\\">Gratuit </span>pour les enfants de moins de 12 ans,&nbsp;carte &quot;Annecy&nbsp;Pass&quot;</span></span></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n', 1361379250);

-- --------------------------------------------------------

--
-- Structure de la table `table_videos`
--

CREATE TABLE IF NOT EXISTS `table_videos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL DEFAULT '',
  `commentaires` varchar(200) NOT NULL DEFAULT '',
  `extension` varchar(10) NOT NULL DEFAULT '',
  `timestamp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `table_videos`
--

INSERT INTO `table_videos` (`id`, `url`, `commentaires`, `extension`, `timestamp`) VALUES
(28, 'http://www.youtube.com/watch?v=rOKhLRDD6_0&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2011 - jour 1', '', 1368379800),
(29, 'http://www.youtube.com/watch?v=djUmlnOcc_Q&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2011 - jour 2 ', '', 1368379767),
(30, 'http://www.youtube.com/watch?v=Vty0QbkDakY&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2011 - jour 3 ', '', 1368379664),
(31, 'http://www.youtube.com/watch?v=F7Rm1abXo60&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2011 - jour 4 ', '', 1368276807),
(32, 'http://www.youtube.com/watch?v=qT-KmlilcB4&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2011 - jour 5', '', 1368116404),
(33, 'http://www.youtube.com/watch?v=TPnT7_J3p-0&amp;feature=plcp', 'TEASER 5Ã¨me Festival de ThÃ©Ã¢tre amateur des Escholiers', '', 1367919384),
(35, 'http://www.youtube.com/watch?v=Y5L9Pouzvl4&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2012 - Jour 2', '', 1350244761),
(36, 'http://www.youtube.com/watch?v=vQTn3ya9IVA&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2012 - Jour 3', '', 1350244735),
(37, 'http://www.youtube.com/watch?v=D6XcDJKwysA&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2012 - Jour 4', '', 1350244700),
(38, 'http://www.youtube.com/watch?v=yzKHrwTxcGw&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2012 - Jour 5 ', '', 1350244676),
(39, 'http://www.youtube.com/watch?v=PwqXJxuNL9o&amp;feature=plcp', 'Festival de thÃ©Ã¢tre amateur des Escholiers 2012 - Jour 1', '', 1350245100),
(40, 'http://www.youtube.com/watch?v=28ZAB1Pzbrw&amp;feature=youtu.be', 'Teaser du 6e Festival de ThÃ©Ã¢tre Amateur des Escholiers', '', 1350244390),
(41, 'http://www.youtube.com/watch?v=EUQEyAP6IT0&amp;feature=youtu.be', 'Mercredi 8 mai - Ouverture du 6e Festival', '', 1350244354),
(42, 'http://www.youtube.com/watch?v=n0bKqWTBAqg&amp;feature=youtu.be', 'Jeudi 9 mai - 6e Festival J2', '', 1350244314),
(43, 'http://www.youtube.com/watch?v=SWe6kx-aEDk', 'Vendredi 10 mai - 6e Festival J3', '', 1350244290),
(44, 'http://www.youtube.com/watch?v=uC_p4F4LbyQ', 'Samedi 11 mai - 6e Festival J4', '', 1350244263),
(45, 'http://www.youtube.com/watch?v=CARHzb9m9WQ&amp;feature=em-upload_owner', 'Dimanche 12 mai - 6e Festival J5', '', 1350244217);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
