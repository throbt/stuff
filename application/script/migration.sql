-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2012 at 10:22 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `manna`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nid` int(10) NOT NULL,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `lead` varchar(250) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `reg` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nid` (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lang_elements`
--

CREATE TABLE IF NOT EXISTS `lang_elements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) COLLATE utf8_bin NOT NULL,
  `orig` varchar(250) COLLATE utf8_bin NOT NULL,
  `hu` varchar(250) COLLATE utf8_bin NOT NULL,
  `en` varchar(250) COLLATE utf8_bin NOT NULL,
  `de` varchar(250) COLLATE utf8_bin NOT NULL,
  `order` int(10) NOT NULL,
  `url` varchar(250) COLLATE utf8_bin NOT NULL,
  `hierarchy` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lang_elements`
--

INSERT INTO `lang_elements` (`id`, `type`, `orig`, `hu`, `en`, `de`, `order`, `url`, `hierarchy`) VALUES
(1, 'menu', 'home', 'FŐOLDAL', 'HOME', '', 1, '/home', 0),
(2, 'menu', 'news', 'HÍREK', 'NEWS', '', 2, '/news', 0),
(3, 'menu', 'menu', 'ÉTLAP', 'MENU', '', 3, '/menu', 0),
(4, 'menu', 'drinks', 'ITALLAP', 'DRINKS', '', 4, '/drinks', 0),
(5, 'menu', 'content', 'TARTALMAK', 'CONTENT', '', 5, '/content', 0),
(6, 'menu', 'programmes', 'PROGRAMOK', 'PROGRAMMES', '', 6, '/programmes', 0),
(7, 'menu', 'reservations', 'ASZTALFOGLALÁS', 'RESERVATIONS', '', 7, '/reservations', 0),
(8, 'menu', 'gallery', 'GALÉRIA', 'GALLERY', '', 8, '/gallery', 0);

-- --------------------------------------------------------

--
-- Table structure for table `linx`
--

CREATE TABLE IF NOT EXISTS `linx` (
  `id` int(10) NOT NULL,
  `order` varchar(250) COLLATE utf8_bin NOT NULL,
  `params` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `node_translate`
--

CREATE TABLE IF NOT EXISTS `node_translate` (
  `nid` int(10) NOT NULL,
  `en` int(10) NOT NULL,
  `de` int(10) NOT NULL,
  UNIQUE KEY `nid` (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
