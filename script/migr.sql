-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2012 at 10:52 AM
-- Server version: 5.1.63
-- PHP Version: 5.3.6-13ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mnvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `langelements`
--

CREATE TABLE IF NOT EXISTS `langelements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) COLLATE utf8_bin NOT NULL,
  `orig` varchar(250) COLLATE utf8_bin NOT NULL,
  `hu` varchar(250) COLLATE utf8_bin NOT NULL,
  `en` varchar(250) COLLATE utf8_bin NOT NULL,
  `de` varchar(250) COLLATE utf8_bin NOT NULL,
  `order` int(10) NOT NULL,
  `active` int(10) NOT NULL,
  `url` varchar(250) COLLATE utf8_bin NOT NULL,
  `hierarchy` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `linx`
--

CREATE TABLE IF NOT EXISTS `linx` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `thisorder` varchar(250) COLLATE utf8_bin NOT NULL,
  `params` varchar(250) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` text COLLATE utf8_bin NOT NULL,
  `meta_description` text COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `lead` text COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `node_node`
--

CREATE TABLE IF NOT EXISTS `node_node` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `left_nid` int(100) NOT NULL,
  `right_nid` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `node_type`
--

CREATE TABLE IF NOT EXISTS `node_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `suffix` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cfg` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `firm` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(255) COLLATE utf8_bin NOT NULL,
  `object` text COLLATE utf8_bin NOT NULL,
  `adult_okj` smallint(1) NOT NULL,
  `adult` smallint(1) NOT NULL,
  `examination` smallint(1) NOT NULL,
  `language` smallint(1) NOT NULL,
  `elearning` smallint(1) NOT NULL,
  `other` smallint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `firm`, `email`, `phone`, `object`, `adult_okj`, `adult`, `examination`, `language`, `elearning`, `other`) VALUES
(1, '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(2, '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(3, '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(4, '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(5, 'sdfsdfsdfsdf', 'sdfsdf', 'sdfsdf@sdfsdfsdf.hu', 'sdfsdfsfsdf', 0x73736466736466, 0, 0, 0, 1, 1, 0),
(6, 'sdf', 'sdfsf', 'adadadad@asdaadadasd.hu', '', 0x6c686b686b686b686b686b686b68, 0, 0, 0, 0, 0, 0),
(7, 'teszt', 'info@halation.hu', 'info@halation.hu', '545', 0x6476767876, 1, 0, 0, 0, 0, 0),
(8, 'hjhgh', 'ihj', 'fturtz@ert', '', 0x6a67686a, 0, 0, 0, 0, 0, 0),
(9, 'dfgdfg', 'dfgfdg', 'dfgdfg@sdfsd.hu', '', 0x646667646667, 0, 0, 0, 0, 0, 0),
(10, 'sdf', 'ffffg', 'fhfhfhfhfhfh@sdfsdf.hu', '', 0x6466676667646667, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1001 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'developer'),
(2, 'admin'),
(1000, 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `term_data`
--

CREATE TABLE IF NOT EXISTS `term_data` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` longtext,
  `weight` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `taxonomy_tree` (`vid`,`weight`,`name`),
  KEY `vid_name` (`vid`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

-- --------------------------------------------------------

--
-- Table structure for table `term_node`
--

CREATE TABLE IF NOT EXISTS `term_node` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nid` int(100) NOT NULL,
  `vid` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vid` (`vid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=382 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `role` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `role`) VALUES
(1, 'cseszko ferenc', 'c80393bd66f53e60ec6de1e35a98a33e', 'cseszko.ferenc@halation.hu', 1),
(2, 'robci', '9e3669d19b675bd57058fd4664205d2a', 'robthot@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vocabulary`
--

CREATE TABLE IF NOT EXISTS `vocabulary` (
  `vid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` longtext,
  `hierarchy` int(15) unsigned NOT NULL DEFAULT '0',
  `required` int(15) unsigned NOT NULL DEFAULT '0',
  `weight` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vid`),
  KEY `list` (`weight`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;
