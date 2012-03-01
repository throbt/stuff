-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2011 at 12:59 PM
-- Server version: 5.5.18
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `maxima`
--

-- --------------------------------------------------------

--
-- Table structure for table `lang_cat`
--

CREATE TABLE IF NOT EXISTS `lang_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `var` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `lang_cat`
--

INSERT INTO `lang_cat` (`id`, `var`) VALUES
(8, 'main_kerdoivek'),
(9, 'main_tagok'),
(10, 'main_uzenetek'),
(11, 'main_statisztikak'),
(12, 'main_hatterfeladatok'),
(13, 'main_beallitasok'),
(14, 'main_csoportok'),
(15, 'main_adatbazisok'),
(16, 'main_folyamatok'),
(17, 'main_profil');

-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2011 at 12:59 PM
-- Server version: 5.5.18
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `maxima`
--

-- --------------------------------------------------------

--
-- Table structure for table `lang_groups`
--

CREATE TABLE IF NOT EXISTS `lang_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `val` varchar(255) DEFAULT NULL,
  `flag` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `lang_groups`
--

INSERT INTO `lang_groups` (`id`, `val`, `flag`) VALUES
(1, 'hungarian', 'hu'),
(2, 'english', 'en');

-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2011 at 01:00 PM
-- Server version: 5.5.18
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `maxima`
--

-- --------------------------------------------------------

--
-- Table structure for table `lang_values`
--

CREATE TABLE IF NOT EXISTS `lang_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `var_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=156 ;

--
-- Dumping data for table `lang_values`
--

INSERT INTO `lang_values` (`id`, `var_id`, `group_id`, `value`) VALUES
(150, 80, 2, 'automatikus weboldalak'),
(149, 79, 2, 'automatic emails'),
(155, 93, 2, 'magyar'),
(152, 92, 1, 'nyelvek'),
(153, 92, 2, 'languages'),
(154, 93, 1, 'english'),
(151, 81, 2, 'warning emails'),
(148, 89, 2, 'administrative interface'),
(64, 49, 1, 'tagok exportálása'),
(41, 29, 1, 'ezegymasikteszt'),
(62, 47, 1, 'kérdőívek'),
(63, 48, 1, 'tagok listája'),
(65, 50, 1, 'szűrők'),
(66, 51, 1, 'tagok importálása'),
(67, 52, 1, 'alcsoportok'),
(68, 53, 1, 'tag kereso'),
(69, 54, 1, 'felhasználók'),
(70, 55, 1, 'visszapattanó emailek'),
(71, 51, 2, 'import members'),
(72, 50, 2, 'filters'),
(73, 48, 2, 'list of members'),
(74, 49, 2, 'export members'),
(75, 52, 2, 'sub groups'),
(76, 53, 2, 'search members'),
(77, 54, 2, 'users'),
(78, 55, 2, 'bounced emails'),
(79, 47, 2, 'questionnaris'),
(80, 56, 1, 'üzenetek'),
(81, 57, 1, 'email keret'),
(82, 58, 1, 'email tartalom'),
(83, 59, 1, 'email küldő'),
(84, 60, 1, 'email időzítő'),
(85, 61, 1, 'email archívum'),
(86, 62, 1, 'sms küldő'),
(87, 63, 1, 'sms időzítő'),
(88, 64, 1, 'sms archívum'),
(89, 65, 1, 'kampányok'),
(90, 66, 1, 'tagok száma'),
(91, 67, 1, 'új tagok'),
(92, 68, 1, 'kérdőív statisztika'),
(93, 69, 1, 'leiratkozott tagok'),
(94, 70, 1, 'nem hitelesített feliratkozások'),
(95, 71, 1, 'üzenetek'),
(96, 72, 1, 'demográfiai'),
(97, 73, 1, 'átkattintások'),
(98, 74, 1, 'statisztikák'),
(99, 75, 1, 'tagok'),
(100, 75, 2, 'members'),
(101, 76, 1, 'háttér feladatok'),
(102, 77, 1, 'live export'),
(103, 78, 1, 'adatok'),
(104, 79, 1, 'automatikus emailek'),
(105, 80, 1, 'automatikus weboldalak'),
(106, 81, 1, 'figyelmeztető emailek'),
(107, 82, 1, 'adat beállítások'),
(108, 83, 1, 'beállítások'),
(109, 84, 1, 'adat csoportok'),
(110, 85, 1, 'csoportok'),
(111, 86, 1, 'adatbázisok'),
(112, 87, 1, 'futó folyamatok'),
(113, 88, 1, 'felhasználó'),
(114, 89, 1, 'adminisztrációs felület'),
(115, 90, 1, 'súgó'),
(116, 91, 1, 'szerkeszt'),
(117, 77, 2, 'live export'),
(118, 76, 2, 'background jobs'),
(119, 88, 2, 'user'),
(120, 90, 2, 'help'),
(121, 91, 2, 'edit'),
(122, 87, 2, 'running processes '),
(123, 86, 2, 'databases'),
(124, 85, 2, 'groups'),
(125, 78, 2, 'datas'),
(126, 82, 2, 'data settings'),
(127, 83, 2, 'settings'),
(128, 84, 2, 'data groups'),
(129, 67, 2, 'new members'),
(130, 56, 2, 'messages'),
(131, 58, 2, 'email content'),
(132, 57, 2, 'email frame'),
(133, 59, 2, 'email sender'),
(134, 60, 2, 'email timer'),
(135, 61, 2, 'email archivum'),
(136, 62, 2, 'sms sender'),
(137, 63, 2, 'sms timer'),
(138, 64, 2, 'sms archivum'),
(139, 65, 2, 'campaigns'),
(140, 66, 2, 'number of members'),
(141, 68, 2, 'questionnaire statistics'),
(142, 69, 2, 'unsubscribed members'),
(143, 70, 2, 'non authenticated subscribe'),
(144, 71, 2, 'messages'),
(145, 72, 2, 'demographic'),
(146, 73, 2, 'click-throughs'),
(147, 74, 2, 'statistics');

-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2011 at 01:01 PM
-- Server version: 5.5.18
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `maxima`
--

-- --------------------------------------------------------

--
-- Table structure for table `lang_variables`
--

CREATE TABLE IF NOT EXISTS `lang_variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `var` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `lang_variables`
--

INSERT INTO `lang_variables` (`id`, `cat_id`, `var`) VALUES
(92, 17, 'nyelvek'),
(93, 17, 'current_nyelv'),
(51, 9, 'tagok_importalasa'),
(50, 9, 'szurok'),
(47, 8, 'kerdoivek'),
(48, 9, 'tagok_listaja'),
(49, 9, 'tagok_exportalasa'),
(52, 9, 'alcsoportok'),
(53, 9, 'tag_kereso'),
(54, 9, 'felhasznalok'),
(55, 9, 'visszapattano'),
(56, 10, 'uzenetek'),
(57, 10, 'email_keret'),
(58, 10, 'email_tartalom'),
(59, 10, 'email_kuldo'),
(60, 10, 'email_idozito'),
(61, 10, 'email_archivum'),
(62, 10, 'sms_kuldo'),
(63, 10, 'sms_idozito'),
(64, 10, 'sms_archivum'),
(65, 10, 'kampanyok'),
(66, 11, 'tagok_szama'),
(67, 11, 'uj_tagok'),
(68, 11, 'kerdoiv_statisztika'),
(69, 11, 'leiratkozott_tagok'),
(70, 11, 'hitelesitetlen_feliratkozasok'),
(71, 11, 'stat_uzenetek'),
(72, 11, 'demografiai'),
(73, 11, 'atkattintasok'),
(74, 11, 'statisztikak'),
(75, 9, 'tagok'),
(76, 12, 'hatterfeladatok'),
(77, 12, 'live_export'),
(78, 13, 'adatok'),
(79, 13, 'automatikus_emailek'),
(80, 13, 'automatikus_weboldalak'),
(81, 13, 'figyelmezteto_emailek'),
(82, 13, 'adat_beallitasok'),
(83, 13, 'beallitasok'),
(84, 13, 'adat_csoportok'),
(85, 14, 'csoportok'),
(86, 15, 'adatbazisok'),
(87, 16, 'futo_folyamatok'),
(88, 17, 'felhasznalo'),
(89, 17, 'adminisztracio'),
(90, 17, 'sugo'),
(91, 17, 'szerkeszt');

