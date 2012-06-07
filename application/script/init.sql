CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8_bin NOT NULL,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `lead` varchar(250) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_description` varchar(250) COLLATE utf8_bin NOT NULL,
  `lang` varchar(10) COLLATE utf8_bin NOT NULL,
  `acive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;