-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2012 at 11:07 PM
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
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `lead` varchar(250) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `image` int(10) NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_desc` text COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `lang` enum('hu','en','de') COLLATE utf8_bin NOT NULL,
  `active` enum('false','true') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `lead`, `body`, `created`, `edited`, `image`, `meta_title`, `meta_keywords`, `meta_desc`, `date_from`, `date_to`, `lang`, `active`) VALUES
(1, 'index_action', '', '', '0000-00-00', '2020-05-13', 0, '', '', '', '0000-00-00', '0000-00-00', '', 'false'),
(16, 'Éttermünkről', 'Ezúttal szeretnénk eloszlatni azt a tévhitet, hogy a Manna kizárólag nyári hely.', 0x3c703e264561637574653b747465726d2675756d6c3b6e6b20612068696465672c20737a2675756d6c3b726b65206964c59162656e206973206b656c6c656d6573206d65646974657272266161637574653b6e20737a696765742c2073c591742061206e6170732675756d6c3b74266561637574653b736573206e61706f6b6f6e20617a202675756d6c3b76656766616c616c616b6f6e206265266f756d6c3b6d6cc5912066266561637574653b6e7962656e20737a696e74652061206e79266161637574653b7262616e20266561637574653b72657a6865746a2675756d6c3b6b206d6167756e6b61742e20457374266561637574653b6e6b266561637574653b6e742070656469672061206d656c656720737a266961637574653b6e656b6b656c20266561637574653b73206b266561637574653b6e79656c6d6573206b616e6170266561637574653b6b6b616c20626572656e64657a65747420266561637574653b74746572656d62656e2061206c65676a6f626220626f726f6b2074266161637574653b72736173266161637574653b67266161637574653b62616e20266561637574653b6c76657a6865746a2675756d6c3b6b2061206b6974c5b16ec59120666f67266161637574653b736f6b61742e203c6272202f3e3c6272202f3e264961637574653b7a656c266961637574653b74c59120617a20266561637574653b746c617072266f61637574653b6c3a3c6272202f3e3c6272202f3e2d204d6172686168267561637574653b73206573737a656e636961206d6172686168267561637574653b736f7320626174797576616c3c6272202f3e2d2053657270656e79c59162656e20732675756d6c3b6c74206c6962616d266161637574653b6a20706f73266961637574653b726f7a6f74742076616e266961637574653b6c69266161637574653b73206b266f756d6c3b7274266561637574653b76656c20266561637574653b732068266161637574653b7a692076616a6173206b616c266161637574653b636373616c3c6272202f3e2d2046656c657a657474207a266f756d6c3b6c646b6167796c266f61637574653b207061726d657a266161637574653b6e6e616c2067726174696e266961637574653b726f7a76613c6272202f3e2d20466f6b686167796d266161637574653b73207363616d70692066656b65746520737061676574746976656c3c6272202f3e2d20264561637574653b726c656c7420417267656e74696e20416e6775732062266561637574653b6c737a266961637574653b6e2066c5b1737a6572657320627572676f6e79266161637574653b76616c2c206c6962616d266161637574653b6a20636f756c69732d737a616c20266561637574653b732076616a6173206b61726f7474266161637574653b76616c3c6272202f3e2d20426f7572626f6e2076616e266961637574653b6c6961206372656d65206272756c266561637574653b653c6272202f3e3c6272202f3e417a20266161637574653b6c6c616e64266f61637574653b20666f67266161637574653b736f6b206d656c6c65747420416c747a6965626c6572204a266f61637574653b7a73656620657865637574697665206368656620686574656e7465206d6567267561637574653b6a756c266f61637574653b206d656e2675756d6c3b6a266561637574653b76656c2076266161637574653b726a756b2076656e64266561637574653b6765696e6b6574213c6272202f3e3c6272202f3e417a2074656c6a657320266561637574653b746c6170206f6c766173686174266f61637574653b20686f6e6c6170756e6b6f6e213c2f703e0d0a3c64697620636c6173733d22696d61676557726170706572223e3c696d67207372633d222e2e2f2e2e2f75706c6f61642f31372f37613135613565613965333035383333616533653034623633653339366534342e6a70672220616c743d22222077696474683d2236303022202f3e3c2f6469763e, '2012-05-18', '2012-05-20', 23, 'Manna Étterem', 'étterem étel ital lounge', 0x4d616e6e6120c3a974746572656d204275646170657374206bc3b67a6570c3a96e2c20612076c3a17262616e2e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(17, 'A Manna Terasz már tavasszal is várja Önöket!', 'A Manna Terasz már Tavasszal is várja Önöket! Élvezze ki nálunk a Tavasz napsütötte óráit nálunk! 12:00-15:00ig a hetente megújuló Chef ajánlatunkról, ha 3 fogást kiválasztanak, 3000.-Ft-ért elfogyaszthatják a napsütötte teraszunkon!', 0x3c703e41204d616e6e612054657261737a206d266161637574653b72205461766173737a616c2069732076266161637574653b726a6120264f756d6c3b6e266f756d6c3b6b65742120264561637574653b6c76657a7a65206b69206e266161637574653b6c756e6b20612054617661737a206e6170732675756d6c3b74266f756d6c3b74746520266f61637574653b72266161637574653b6974206e266161637574653b6c756e6b212031323a30302d31353a30306967206120686574656e7465206d6567267561637574653b6a756c266f61637574653b204368656620616a266161637574653b6e6c6174756e6b72266f61637574653b6c2c206861203320666f67266161637574653b7374206b6976266161637574653b6c61737a74616e616b2c20333030302e2d46742d266561637574653b727420656c666f677961737a746861746a266161637574653b6b2061206e6170732675756d6c3b74266f756d6c3b7474652074657261737a756e6b6f6e213c2f703e0d0a3c703e54617661737a69204e79697476612054617274266161637574653b733a20482d537a6f2031323a30302d32343a30303c6272202f3e3c6272202f3e4d266161637574653b6a75732e312d74c5916c20766173266161637574653b726e6170206973206e79697476612074617274756e6b3a20482d562031323a30302d32343a30303c2f703e0d0a3c703e3c6120687265663d22687474703a2f2f7777772e66616365626f6f6b2e636f6d2f70616765732f4d616e6e612d264561637574653b74746572656d2f31373632313030333837373922207461726765743d225f626c616e6b223e4b6572657373656e206d696e6b657420612046616365626f6f6b6f6e206973213c2f613e3c6272202f3e3c6272202f3e3c6272202f3e41737a74616c666f676c616c266161637574653b733a3c6272202f3e3c7374726f6e673e2b33362032302039393939203138383c2f7374726f6e673e3c2f703e, '2012-05-18', '2012-05-20', 24, 'Manna Terasz', 'terasz étterem szabadtér kiülős_hely', 0x41204d616e6e612054657261737a20656779206b656c6c656d6573206b69c3bc6cc591732068656c7920612056c3a17262616e2e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(18, ' Kézműves borok és Ételkülönlegességek a Mannában!', 'Tisztelt Vendégeink!  2012. Március 6-án este különleges és rendhagyó borvacsora helyszíne lesz a Manna Étterem. A 2011-es Borászok Borászának megválasztott Kaló Imre és egyik legjobb barátja (és tanítványa) Vámos Attila (Attila Pince) Szomolyából va', 0x3c703e5a454e453c6272202f3e4c616b61746f73204779756c612c204f7262266161637574653b6e204779266f756d6c3b726779204a617a7a206475266f61637574653b3c6272202f3e3c6272202f3e3c6272202f3e424f5220266561637574653b7320264561637574653b54454c534f523c6272202f3e2655756d6c3b6476266f756d6c3b7a6cc591206974616c202d20323031302052266161637574653b7370692050657a7367c5913c6272202f3e3c6272202f3e4c6962616d266161637574653b6a2076617269266161637574653b6369266f61637574653b3c6272202f3e32303038204f6c61737a72697a6c696e672046c591626f7220284b616c266f61637574653b20496d7265293c6272202f3e3c6272202f3e4373696373266f61637574653b6b616b72266561637574653b6d6c6576657320747572626f6c79266161637574653b76616c3c6272202f3e323030392043616265726e6574205361757669676e6f6e20526f7a266561637574653b20284b616c266f61637574653b20496d7265293c6272202f3e3c6272202f3e4b6563736567652070617072696b61737a266f61637574653b73737a616c3c6272202f3e32303038204c65266161637574653b6e796b61202856266161637574653b6d6f7320417474696c61293c6272202f3e3c6272202f3e426f726a267561637574653b676572696e63207370656e266f61637574653b7474616c3c6272202f3e323030372043616265726e6574205361757669676e6f6e202856266161637574653b6d6f7320417474696c61293c6272202f3e323030382043616265726e6574205361757669676e6f6e20284b616c266f61637574653b20496d7265293c6272202f3e3c6272202f3e537a6172766173676572696e632063736f6b6f6c266161637574653b64266561637574653b737a266f61637574653b73737a616c20266561637574653b7320737a6172766173676f6d62266161637574653b76616c3c6272202f3e3230303820547572266161637574653b6e202856266161637574653b6d6f7320417474696c61293c6272202f3e3c6272202f3e436875616f2043736f6b6f6c266161637574653b64266561637574653b20737a75666c266561637574653b20637369706b65626f6779266f61637574653b6c656b76266161637574653b7272616c3c6272202f3e32303036205a776569672e2056266161637574653b6c6f676174266161637574653b73202852266161637574653b737069293c6272202f3e3c6272202f3e53616a7474266161637574653b6c3c6272202f3e3230303620476e6569737a2852266161637574653b737069293c6272202f3e3c6272202f3e3c6272202f3e564143534f524120264161637574653b52413a2032392e3930302046742f66c5913c6272202f3e3c6272202f3e3c6272202f3e4944c590504f4e543a20323031322e206d266161637574653b72636975732e20362e2031392e30303c6272202f3e3c6272202f3e41737a74616c666f676c616c266161637574653b7320266561637574653b732072266561637574653b737a6c6574657320696e666f726d266161637574653b6369266f61637574653b6b3a202b33362032302039393939203138383c2f703e, '2012-05-18', '0000-00-00', 0, 'Borvacsora', 'bor italkülönlegesség kézműves ', 0x4bc3a97a6dc5b176657320626f726f6b20c3a97320c3a974656c6bc3bc6cc3b66e6c65676573c3a967656b, '0000-00-00', '0000-00-00', 'hu', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `lead` varchar(250) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_desc` text COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `lang` enum('hu','en','de') COLLATE utf8_bin NOT NULL,
  `active` enum('false','true') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `title`, `lead`, `body`, `created`, `edited`, `meta_title`, `meta_keywords`, `meta_desc`, `date_from`, `date_to`, `lang`, `active`) VALUES
(1, 'index_action', '', '', '2020-02-06', '2020-05-07', '', '', '', '0000-00-00', '0000-00-00', '', 'false'),
(15, 'Lorem ipsum dolor', 'Lorem ipsum dolor', 0x092020092020094c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747572206164697069736963696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20557420656e696d206164206d696e696d2076656e69616d2c2071756973206e6f737472756420657865726369746174696f6e20756c6c616d636f206c61626f726973206e69736920757420616c697175697020657820656120636f6d6d6f646f20636f6e7365717561742e2044756973206175746520697275726520646f6c6f7220696e20726570726568656e646572697420696e20766f6c7570746174652076656c697420657373652063696c6c756d20646f6c6f726520657520667567696174206e756c6c612070617269617475722e204578636570746575722073696e74206f6363616563617420637570696461746174206e6f6e2070726f6964656e742c2073756e7420696e2063756c706120717569206f666669636961206465736572756e74206d6f6c6c697420616e696d20696420657374206c61626f72756d2e0d0a0d0a4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747572206164697069736963696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20557420656e696d206164206d696e696d2076656e69616d2c2071756973206e6f737472756420657865726369746174696f6e20756c6c616d636f206c61626f726973206e69736920757420616c697175697020657820656120636f6d6d6f646f20636f6e7365717561742e2044756973206175746520697275726520646f6c6f7220696e20726570726568656e646572697420696e20766f6c7570746174652076656c697420657373652063696c6c756d20646f6c6f726520657520667567696174206e756c6c612070617269617475722e204578636570746575722073696e74206f6363616563617420637570696461746174206e6f6e2070726f6964656e742c2073756e7420696e2063756c706120717569206f666669636961206465736572756e74206d6f6c6c697420616e696d20696420657374206c61626f72756d2e0d0a0d0a4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747572206164697069736963696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20557420656e696d206164206d696e696d2076656e69616d2c2071756973206e6f737472756420657865726369746174696f6e20756c6c616d636f206c61626f726973206e69736920757420616c697175697020657820656120636f6d6d6f646f20636f6e7365717561742e2044756973206175746520697275726520646f6c6f7220696e20726570726568656e646572697420696e20766f6c7570746174652076656c697420657373652063696c6c756d20646f6c6f726520657520667567696174206e756c6c612070617269617475722e204578636570746575722073696e74206f6363616563617420637570696461746174206e6f6e2070726f6964656e742c2073756e7420696e2063756c706120717569206f666669636961206465736572756e74206d6f6c6c697420616e696d20696420657374206c61626f72756d2e09, '2012-05-17', '2012-05-17', 'Lorem', 'Lorem,Lorem,Lorem', 0x092020092020094c6f72656d4c6f72656d4c6f72656d4c6f72656d4c6f72656d09, '2012-03-09', '2017-05-19', 'hu', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE IF NOT EXISTS `drinks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `type` varchar(250) COLLATE utf8_bin NOT NULL,
  `price` varchar(100) COLLATE utf8_bin NOT NULL,
  `place` varchar(250) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `priceglass` varchar(250) COLLATE utf8_bin NOT NULL,
  `pricebottle` varchar(250) COLLATE utf8_bin NOT NULL,
  `winery` varchar(250) COLLATE utf8_bin NOT NULL,
  `categories` varchar(250) COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `image` int(10) NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_desc` text COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `lang` enum('hu','en','de') COLLATE utf8_bin NOT NULL,
  `active` enum('false','true') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=326 ;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`id`, `title`, `type`, `price`, `place`, `body`, `priceglass`, `pricebottle`, `winery`, `categories`, `created`, `edited`, `image`, `meta_title`, `meta_keywords`, `meta_desc`, `date_from`, `date_to`, `lang`, `active`) VALUES
(1, 'index_action', '', '', '', '', '', '', '', '', '2020-05-13', '2020-05-13', 0, '', '', '', '0000-00-00', '0000-00-00', '', 'false'),
(16, '﻿name', 'type', '', 'place', 0x636f6e74656e74, 'priceglass', 'pricebottle', 'winery', 'categories', '0000-00-00', '0000-00-00', 0, 'title', 'keywords', 0x6465736372697074696f6e, '0000-00-00', '0000-00-00', '', 'true'),
(17, 'Naturaqua szénsavas 0,33l', 'Ásványvíz', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-01', '0000-00-00', 0, 'Naturaqua szénsavas 0,33l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4e617475726171756120737ac3a96e736176617320302c33336c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(18, 'Naturaqua szénsavmentes 0,33l', 'Ásványvíz', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-04', '0000-00-00', 0, 'Naturaqua szénsavmentes 0,33l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4e617475726171756120737ac3a96e7361766d656e74657320302c33336c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(19, 'Naturaqua szénsavas 0,75l', 'Ásványvíz', '', '', '', '', '1050', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-07', '0000-00-00', 0, 'Naturaqua szénsavas 0,75l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4e617475726171756120737ac3a96e736176617320302c37356c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(20, 'Naturaqua szénsavmentes 0,75l', 'Ásványvíz', '', '', '', '', '1050', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-10', '0000-00-00', 0, 'Naturaqua szénsavmentes 0,75l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4e617475726171756120737ac3a96e7361766d656e74657320302c37356c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(21, 'Coca Cola 0,2l , Cola Light 0,2 l', 'Üdítő italok ', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-13', '0000-00-00', 0, 'Coca Cola 0,2l , Cola Light 0,2 l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x436f636120436f6c6120302c326c202c20436f6c61204c6967687420302c32206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(22, 'Kinley Gyömbér 0,25l, Kinley Tonic 0,25l ', 'Üdítő italok ', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-16', '0000-00-00', 0, 'Kinley Gyömbér 0,25l, Kinley Tonic 0,25l ', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4b696e6c6579204779c3b66d62c3a97220302c32356c2c204b696e6c657920546f6e696320302c32356cc2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(23, 'Fanta Citrom , Fanta Narancs 0,2l ', 'Üdítő italok ', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-19', '0000-00-00', 0, 'Fanta Citrom , Fanta Narancs 0,2l ', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x46616e746120436974726f6d202c2046616e7461204e6172616e637320302c326cc2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(24, 'Sprite 0,2 l', 'Üdítő italok ', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-22', '0000-00-00', 0, 'Sprite 0,2 l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x53707269746520302c32206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(25, 'Nestea Citrom 0,25l, Nestea Őszibarack 0,25l', 'Üdítő italok ', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-25', '0000-00-00', 0, 'Nestea Citrom 0,25l, Nestea Őszibarack 0,25l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4e657374656120436974726f6d20302c32356c2c204e657374656120c590737a6962617261636b20302c32356c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(26, 'Narancs', 'Gyümölcslevek 0,2 l', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-28', '0000-00-00', 0, 'Narancs', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4e6172616e6373, '0000-00-00', '0000-00-00', 'hu', 'true'),
(27, 'Alma', 'Gyümölcslevek 0,2 l', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-01-31', '0000-00-00', 0, 'Alma', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x416c6d61, '0000-00-00', '0000-00-00', 'hu', 'true'),
(28, 'Őszibarack', 'Gyümölcslevek 0,2 l', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-03', '0000-00-00', 0, 'Őszibarack', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0xc590737a6962617261636b, '0000-00-00', '0000-00-00', 'hu', 'true'),
(29, 'Paradicsom', 'Gyümölcslevek 0,2 l', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-06', '0000-00-00', 0, 'Paradicsom', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x50617261646963736f6d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(30, 'Ananász', 'Gyümölcslevek 0,2 l', '', '', '', '', '450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-09', '0000-00-00', 0, 'Ananász', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x416e616ec3a1737a, '0000-00-00', '0000-00-00', 'hu', 'true'),
(31, 'Burn 0,2l', 'Energia italok', '', '', '', '', '800', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-12', '0000-00-00', 0, 'Burn 0,2l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4275726e20302c326c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(32, 'Monster 0,5l', 'Energia italok', '', '', '', '', '800', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-15', '0000-00-00', 0, 'Monster 0,5l', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4d6f6e7374657220302c356c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(33, 'Espresso, Ristretto', 'Kávé - Tea', '', '', '', '', '500', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-18', '0000-00-00', 0, 'Espresso, Ristretto', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x457370726573736f2c2052697374726574746f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(34, 'Duplapresszó / Double espresso', 'Kávé - Tea', '', '', '', '', '750', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-21', '0000-00-00', 0, 'Duplapresszó / Double espresso', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4475706c6170726573737ac3b3202f20446f75626c6520657370726573736f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(35, 'Capuccino, Melange', 'Kávé - Tea', '', '', '', '', '500', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-24', '0000-00-00', 0, 'Capuccino, Melange', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x436170756363696e6f2c204d656c616e6765, '0000-00-00', '0000-00-00', 'hu', 'true'),
(36, 'Latte Macchiato', 'Kávé - Tea', '', '', '', '', '600', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-02-27', '0000-00-00', 0, 'Latte Macchiato', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4c61747465204d616363686961746f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(37, 'Jeges Kávé / Ice Coffee ', 'Kávé - Tea', '', '', '', '', '800', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-03-02', '0000-00-00', 0, 'Jeges Kávé / Ice Coffee ', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4a65676573204bc3a176c3a9202f2049636520436f66666565c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(38, 'Ronnefeldt Tea', 'Kávé - Tea', '', '', '', '', '600', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-03-05', '0000-00-00', 0, 'Ronnefeldt Tea', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x526f6e6e6566656c647420546561, '0000-00-00', '0000-00-00', 'hu', 'true'),
(39, 'Forró csoki', 'Kávé - Tea', '', '', '', '', '800', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-03-08', '0000-00-00', 0, 'Forró csoki', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x466f7272c3b32063736f6b69, '0000-00-00', '0000-00-00', 'hu', 'true'),
(40, 'Bailey''s kávé', 'Kávé specialitások - Kávé és likőr', '', '', '', '', '1250', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-03-11', '0000-00-00', 0, 'Bailey''s kávé', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x4261696c65792773206bc3a176c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(41, 'Amaretto kávé', 'Kávé specialitások - Kávé és likőr', '', '', '', '', '1250', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-03-14', '0000-00-00', 0, 'Amaretto kávé', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0x416d61726574746f206bc3a176c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(42, 'Ír káve', 'Kávé specialitások - Kávé és likőr', '', '', '', '', '1450', '', 'Ásványvíz, Üdítő italok, Kávé - Tea', '2010-03-17', '0000-00-00', 0, 'Ír káve', 'Ásványvíz, Üdítő italok, Kávé - Tea', 0xc38d72206bc3a17665, '0000-00-00', '0000-00-00', 'hu', 'true'),
(43, 'Pilsner Urquell 0,3 l', 'Sör', '', '', '', '', '650', 'Csapolt sör', 'Sör, Vermut, Likőr és Rövid italok', '2010-03-20', '0000-00-00', 0, 'Pilsner Urquell 0,3 l', 'Sör, Vermut, Likőr és Rövid italok', 0x50696c736e65722055727175656c6c20302c33206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(44, 'Pilsner Urquell 0,5 l', 'Sör', '', '', '', '', '950', 'Csapolt sör', 'Sör, Vermut, Likőr és Rövid italok', '2010-03-23', '0000-00-00', 0, 'Pilsner Urquell 0,5 l', 'Sör, Vermut, Likőr és Rövid italok', 0x50696c736e65722055727175656c6c20302c35206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(45, 'Dreher 0,3 l', 'Sör', '', '', '', '', '450', 'Csapolt sör', 'Sör, Vermut, Likőr és Rövid italok', '2010-03-26', '0000-00-00', 0, 'Dreher 0,3 l', 'Sör, Vermut, Likőr és Rövid italok', 0x44726568657220302c33206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(46, 'Dreher 0,5 l', 'Sör', '', '', '', '', '750', 'Csapolt sör', 'Sör, Vermut, Likőr és Rövid italok', '2010-03-29', '0000-00-00', 0, 'Dreher 0,5 l', 'Sör, Vermut, Likőr és Rövid italok', 0x44726568657220302c35206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(47, 'Dreher 0,33l / Dreher 0,33 l', 'Sör', '', '', '', '', '550', 'Üveges sör', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-01', '0000-00-00', 0, 'Dreher 0,33l / Dreher 0,33 l', 'Sör, Vermut, Likőr és Rövid italok', 0x44726568657220302c33336c202f2044726568657220302c3333206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(48, 'Dreher bak / Brown 0,5 l', 'Sör', '', '', '', '', '650', 'Üveges sör', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-04', '0000-00-00', 0, 'Dreher bak / Brown 0,5 l', 'Sör, Vermut, Likőr és Rövid italok', 0x4472656865722062616b202f2042726f776e20302c35206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(49, 'HB Búza / wheat 0,5 l', 'Sör', '', '', '', '', '950', 'Üveges sör', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-07', '0000-00-00', 0, 'HB Búza / wheat 0,5 l', 'Sör, Vermut, Likőr és Rövid italok', 0x48422042c3ba7a61202f20776865617420302c35206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(50, 'Dreher Alkoholmentes / Non alcoholic 0,33 l', 'Sör', '', '', '', '', '550', 'Üveges sör', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-10', '0000-00-00', 0, 'Dreher Alkoholmentes / Non alcoholic 0,33 l', 'Sör, Vermut, Likőr és Rövid italok', 0x44726568657220416c6b6f686f6c6d656e746573202f204e6f6e20616c636f686f6c696320302c3333206c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(51, 'Martini Extra Dry', 'Vermut - 8 cl', '', '', '', '', '900', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-13', '0000-00-00', 0, 'Martini Extra Dry', 'Sör, Vermut, Likőr és Rövid italok', 0x4d617274696e6920457874726120447279, '0000-00-00', '0000-00-00', 'hu', 'true'),
(52, 'Martini Rosso', 'Vermut - 8 cl', '', '', '', '', '900', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-16', '0000-00-00', 0, 'Martini Rosso', 'Sör, Vermut, Likőr és Rövid italok', 0x4d617274696e6920526f73736f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(53, 'Martini Bianco', 'Vermut - 8 cl', '', '', '', '', '900', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-19', '0000-00-00', 0, 'Martini Bianco', 'Sör, Vermut, Likőr és Rövid italok', 0x4d617274696e69204269616e636f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(54, 'Campari', 'Vermut - 8 cl', '', '', '', '', '1100', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-22', '0000-00-00', 0, 'Campari', 'Sör, Vermut, Likőr és Rövid italok', 0x43616d70617269, '0000-00-00', '0000-00-00', 'hu', 'true'),
(55, 'Cointreau', 'Likőr - 4cl', '', '', '', '', '1200', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-25', '0000-00-00', 0, 'Cointreau', 'Sör, Vermut, Likőr és Rövid italok', 0x436f696e7472656175, '0000-00-00', '0000-00-00', 'hu', 'true'),
(56, 'Aurum', 'Likőr - 4cl', '', '', '', '', '1200', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-04-28', '0000-00-00', 0, 'Aurum', 'Sör, Vermut, Likőr és Rövid italok', 0x417572756d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(57, 'Amaretto di Saronno', 'Likőr - 4cl', '', '', '', '', '1100', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-01', '0000-00-00', 0, 'Amaretto di Saronno', 'Sör, Vermut, Likőr és Rövid italok', 0x416d61726574746f206469205361726f6e6e6f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(58, 'Borghetti Caffé', 'Likőr - 4cl', '', '', '', '', '1100', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-04', '0000-00-00', 0, 'Borghetti Caffé', 'Sör, Vermut, Likőr és Rövid italok', 0x426f726768657474692043616666c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(59, 'Malibu', 'Likőr - 4cl', '', '', '', '', '1100', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-07', '0000-00-00', 0, 'Malibu', 'Sör, Vermut, Likőr és Rövid italok', 0x4d616c696275, '0000-00-00', '0000-00-00', 'hu', 'true'),
(60, 'Sambucca', 'Likőr - 4cl', '', '', '', '', '1100', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-10', '0000-00-00', 0, 'Sambucca', 'Sör, Vermut, Likőr és Rövid italok', 0x53616d6275636361, '0000-00-00', '0000-00-00', 'hu', 'true'),
(61, 'Pernod', 'Likőr - 4cl', '', '', '', '', '1200', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-13', '0000-00-00', 0, 'Pernod', 'Sör, Vermut, Likőr és Rövid italok', 0x5065726e6f64, '0000-00-00', '0000-00-00', 'hu', 'true'),
(62, 'Bailey''s Irish Cream - 6 cl', 'Likőr - 4cl', '', '', '', '', '1400', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-16', '0000-00-00', 0, 'Bailey''s Irish Cream - 6 cl', 'Sör, Vermut, Likőr és Rövid italok', 0x4261696c6579277320497269736820437265616d202d203620636c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(63, 'Limoncello', 'Likőr - 4cl', '', '', '', '', '1100', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-19', '0000-00-00', 0, 'Limoncello', 'Sör, Vermut, Likőr és Rövid italok', 0x4c696d6f6e63656c6c6f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(64, 'Southern Comfort', 'Likőr - 4cl', '', '', '', '', '1200', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-22', '0000-00-00', 0, 'Southern Comfort', 'Sör, Vermut, Likőr és Rövid italok', 0x536f75746865726e20436f6d666f7274, '0000-00-00', '0000-00-00', 'hu', 'true'),
(65, 'Alizé - 1 dl', 'Likőr - 4cl', '', '', '', '', '1600', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-25', '0000-00-00', 0, 'Alizé - 1 dl', 'Sör, Vermut, Likőr és Rövid italok', 0x416c697ac3a9202d203120646c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(66, 'Alizé blue - 1 dl', 'Likőr - 4cl', '', '', '', '', '1800', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-28', '0000-00-00', 0, 'Alizé blue - 1 dl', 'Sör, Vermut, Likőr és Rövid italok', 0x416c697ac3a920626c7565202d203120646c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(67, 'Absolut', 'Vodka - 4 cl', '', '', '', '', '900', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-05-31', '0000-00-00', 0, 'Absolut', 'Sör, Vermut, Likőr és Rövid italok', 0x4162736f6c7574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(68, 'Finlandia', 'Vodka - 4 cl', '', '', '', '', '900', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-06-03', '0000-00-00', 0, 'Finlandia', 'Sör, Vermut, Likőr és Rövid italok', 0x46696e6c616e646961, '0000-00-00', '0000-00-00', 'hu', 'true'),
(69, 'Finlandia Cranberry', 'Vodka - 4 cl', '', '', '', '', '900', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-06-06', '0000-00-00', 0, 'Finlandia Cranberry', 'Sör, Vermut, Likőr és Rövid italok', 0x46696e6c616e646961204372616e6265727279, '0000-00-00', '0000-00-00', 'hu', 'true'),
(70, 'Russky Standart Platinum', 'Vodka - 4 cl', '', '', '', '', '1250', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-06-09', '0000-00-00', 0, 'Russky Standart Platinum', 'Sör, Vermut, Likőr és Rövid italok', 0x527573736b79205374616e6461727420506c6174696e756d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(71, 'Olmeca Silver', 'Tequila - 4 cl ', '', '', '', '', '900', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-06-12', '0000-00-00', 0, 'Olmeca Silver', 'Sör, Vermut, Likőr és Rövid italok', 0x4f6c6d6563612053696c766572, '0000-00-00', '0000-00-00', 'hu', 'true'),
(72, 'Olmeca Gold', 'Tequila - 4 cl ', '', '', '', '', '1250', '', 'Sör, Vermut, Likőr és Rövid italok', '2010-06-15', '0000-00-00', 0, 'Olmeca Gold', 'Sör, Vermut, Likőr és Rövid italok', 0x4f6c6d65636120476f6c64, '0000-00-00', '0000-00-00', 'hu', 'true'),
(73, 'Gordon''s', 'Gin - 4 cl', '', '', '', '', '900', '', 'Rövid Italok és Whiskey', '2010-06-18', '0000-00-00', 0, 'Gordon''s', 'Rövid Italok és Whiskey', 0x476f72646f6e2773, '0000-00-00', '0000-00-00', 'hu', 'true'),
(74, 'Bacardi Light', 'Rum - 4 cl', '', '', '', '', '900', '', 'Rövid Italok és Whiskey', '2010-06-21', '0000-00-00', 0, 'Bacardi Light', 'Rövid Italok és Whiskey', 0x42616361726469204c69676874, '0000-00-00', '0000-00-00', 'hu', 'true'),
(75, 'Captain Morgan Black', 'Rum - 4 cl', '', '', '', '', '1100', '', 'Rövid Italok és Whiskey', '2010-06-24', '0000-00-00', 0, 'Captain Morgan Black', 'Rövid Italok és Whiskey', 0x4361707461696e204d6f7267616e20426c61636b, '0000-00-00', '0000-00-00', 'hu', 'true'),
(76, 'Captain Morga Spiced', 'Rum - 4 cl', '', '', '', '', '1100', '', 'Rövid Italok és Whiskey', '2010-06-27', '0000-00-00', 0, 'Captain Morga Spiced', 'Rövid Italok és Whiskey', 0x4361707461696e204d6f72676120537069636564, '0000-00-00', '0000-00-00', 'hu', 'true'),
(77, 'Cachaca Pitu', 'Rum - 4 cl', '', '', '', '', '1100', '', 'Rövid Italok és Whiskey', '2010-06-30', '0000-00-00', 0, 'Cachaca Pitu', 'Rövid Italok és Whiskey', 0x436163686163612050697475, '0000-00-00', '0000-00-00', 'hu', 'true'),
(78, 'Ballantines', 'Skót whiskey - 4 cl', '', '', '', '', '1200', '', 'Rövid Italok és Whiskey', '2010-07-03', '0000-00-00', 0, 'Ballantines', 'Rövid Italok és Whiskey', 0x42616c6c616e74696e6573, '0000-00-00', '0000-00-00', 'hu', 'true'),
(79, 'Ballantines Gold 12 éves / years', 'Skót whiskey - 4 cl', '', '', '', '', '1800', '', 'Rövid Italok és Whiskey', '2010-07-06', '0000-00-00', 0, 'Ballantines Gold 12 éves / years', 'Rövid Italok és Whiskey', 0x42616c6c616e74696e657320476f6c6420313220c3a9766573202f207965617273, '0000-00-00', '0000-00-00', 'hu', 'true'),
(80, 'Johnnie Walker red', 'Skót whiskey - 4 cl', '', '', '', '', '900', '', 'Rövid Italok és Whiskey', '2010-07-09', '0000-00-00', 0, 'Johnnie Walker red', 'Rövid Italok és Whiskey', 0x4a6f686e6e69652057616c6b657220726564, '0000-00-00', '0000-00-00', 'hu', 'true'),
(81, 'Johnnie Walker black', 'Skót whiskey - 4 cl', '', '', '', '', '1800', '', 'Rövid Italok és Whiskey', '2010-07-12', '0000-00-00', 0, 'Johnnie Walker black', 'Rövid Italok és Whiskey', 0x4a6f686e6e69652057616c6b657220626c61636b, '0000-00-00', '0000-00-00', 'hu', 'true'),
(82, 'Chivas Regal', 'Skót whiskey - 4 cl', '', '', '', '', '1800', '', 'Rövid Italok és Whiskey', '2010-07-15', '0000-00-00', 0, 'Chivas Regal', 'Rövid Italok és Whiskey', 0x43686976617320526567616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(83, 'Tullamore Dew', 'Ír whiskey - 4 cl', '', '', '', '', '1200', '', 'Rövid Italok és Whiskey', '2010-07-18', '0000-00-00', 0, 'Tullamore Dew', 'Rövid Italok és Whiskey', 0x54756c6c616d6f726520446577, '0000-00-00', '0000-00-00', 'hu', 'true'),
(84, 'Jameson', 'Ír whiskey - 4 cl', '', '', '', '', '1200', '', 'Rövid Italok és Whiskey', '2010-07-21', '0000-00-00', 0, 'Jameson', 'Rövid Italok és Whiskey', 0x4a616d65736f6e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(85, 'Jameson 12 éves / years ', 'Ír whiskey - 4 cl', '', '', '', '', '1600', '', 'Rövid Italok és Whiskey', '2010-07-24', '0000-00-00', 0, 'Jameson 12 éves / years ', 'Rövid Italok és Whiskey', 0x4a616d65736f6e20313220c3a9766573202f207965617273c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(86, 'Laphroaig Islay 10 éves / years', 'Maláta whiskey - 4 cl', '', '', '', '', '1600', '', 'Rövid Italok és Whiskey', '2010-07-27', '0000-00-00', 0, 'Laphroaig Islay 10 éves / years', 'Rövid Italok és Whiskey', 0x4c617068726f6169672049736c617920313020c3a9766573202f207965617273, '0000-00-00', '0000-00-00', 'hu', 'true'),
(87, 'Glendronach 12 éves / years', 'Maláta whiskey - 4 cl', '', '', '', '', '1600', '', 'Rövid Italok és Whiskey', '2010-07-30', '0000-00-00', 0, 'Glendronach 12 éves / years', 'Rövid Italok és Whiskey', 0x476c656e64726f6e61636820313220c3a9766573202f207965617273, '0000-00-00', '0000-00-00', 'hu', 'true'),
(88, 'Glenfiddich 12 éves / years', 'Maláta whiskey - 4 cl', '', '', '', '', '1600', '', 'Rövid Italok és Whiskey', '2010-08-02', '0000-00-00', 0, 'Glenfiddich 12 éves / years', 'Rövid Italok és Whiskey', 0x476c656e6669646469636820313220c3a9766573202f207965617273, '0000-00-00', '0000-00-00', 'hu', 'true'),
(89, 'Jim Beam', 'Bourbon - 4 cl', '', '', '', '', '1100', '', 'Rövid Italok és Whiskey', '2010-08-05', '0000-00-00', 0, 'Jim Beam', 'Rövid Italok és Whiskey', 0x4a696d204265616d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(90, 'Jack Daniel''s', 'Bourbon - 4 cl', '', '', '', '', '1400', '', 'Rövid Italok és Whiskey', '2010-08-08', '0000-00-00', 0, 'Jack Daniel''s', 'Rövid Italok és Whiskey', 0x4a61636b2044616e69656c2773, '0000-00-00', '0000-00-00', 'hu', 'true'),
(91, 'Canadian Special Old', 'Kanadai whiskey - 4 cl', '', '', '', '', '1100', '', 'Rövid Italok és Whiskey', '2010-08-11', '0000-00-00', 0, 'Canadian Special Old', 'Rövid Italok és Whiskey', 0x43616e616469616e205370656369616c204f6c64, '0000-00-00', '0000-00-00', 'hu', 'true'),
(92, 'Calem Fine Ruby 0,1l', 'Portói Bor és Sherry', '', '', '', '', '1500', '', 'Rövid Italok és Whiskey', '2010-08-14', '0000-00-00', 0, 'Calem Fine Ruby 0,1l', 'Rövid Italok és Whiskey', 0x43616c656d2046696e65205275627920302c316c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(93, 'Calem 20 éves / years 0,04l', 'Portói Bor és Sherry', '', '', '', '', '3200', '', 'Rövid Italok és Whiskey', '2010-08-17', '0000-00-00', 0, 'Calem 20 éves / years 0,04l', 'Rövid Italok és Whiskey', 0x43616c656d20323020c3a9766573202f20796561727320302c30346c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(94, 'Tio Pepe Jerez Fino 0,1l', 'Portói Bor és Sherry', '', '', '', '', '1800', '', 'Rövid Italok és Whiskey', '2010-08-20', '0000-00-00', 0, 'Tio Pepe Jerez Fino 0,1l', 'Rövid Italok és Whiskey', 0x54696f2050657065204a6572657a2046696e6f20302c316c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(95, 'Jagermeister', 'Gyomorkeserű - 4 cl', '', '', '', '', '1100', '', 'Gyomorkeserű és Pálinka', '2010-08-23', '0000-00-00', 0, 'Jagermeister', 'Gyomorkeserű és Pálinka', 0x4a616765726d656973746572, '0000-00-00', '0000-00-00', 'hu', 'true'),
(96, 'Unicum', 'Gyomorkeserű - 4 cl', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-08-26', '0000-00-00', 0, 'Unicum', 'Gyomorkeserű és Pálinka', 0x556e6963756d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(97, 'Fernet Branca ', 'Gyomorkeserű - 4 cl', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-08-29', '0000-00-00', 0, 'Fernet Branca ', 'Gyomorkeserű és Pálinka', 0x4665726e6574204272616e6361c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(98, 'Fernet Menta ', 'Gyomorkeserű - 4 cl', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-09-01', '0000-00-00', 0, 'Fernet Menta ', 'Gyomorkeserű és Pálinka', 0x4665726e6574204d656e7461c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(99, 'Cynar (articsóka)', 'Gyomorkeserű - 4 cl', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-09-04', '0000-00-00', 0, 'Cynar (articsóka)', 'Gyomorkeserű és Pálinka', 0x43796e61722028617274696373c3b36b6129, '0000-00-00', '0000-00-00', 'hu', 'true'),
(100, 'Manna Málna', 'Pálinka - 4 cl ', '', '', '', '', '1650', '', 'Gyomorkeserű és Pálinka', '2010-09-07', '0000-00-00', 0, 'Manna Málna', 'Gyomorkeserű és Pálinka', 0x4d616e6e61204dc3a16c6e61, '0000-00-00', '0000-00-00', 'hu', 'true'),
(101, 'Manna Árvay Aszutörköly', 'Pálinka - 4 cl ', '', '', '', '', '1200', '', 'Gyomorkeserű és Pálinka', '2010-09-10', '0000-00-00', 0, 'Manna Árvay Aszutörköly', 'Gyomorkeserű és Pálinka', 0x4d616e6e6120c381727661792041737a7574c3b6726bc3b66c79, '0000-00-00', '0000-00-00', 'hu', 'true'),
(102, 'Kajszibarack', 'Panyolai Elixír', '', '', '', '', '1100', '', 'Gyomorkeserű és Pálinka', '2010-09-13', '0000-00-00', 0, 'Kajszibarack', 'Gyomorkeserű és Pálinka', 0x4b616a737a6962617261636b, '0000-00-00', '0000-00-00', 'hu', 'true'),
(103, 'Szamóca', 'Panyolai Elixír', '', '', '', '', '1100', '', 'Gyomorkeserű és Pálinka', '2010-09-16', '0000-00-00', 0, 'Szamóca', 'Gyomorkeserű és Pálinka', 0x537a616dc3b36361, '0000-00-00', '0000-00-00', 'hu', 'true'),
(104, 'Szatmári szilva', 'Panyolai Elixír', '', '', '', '', '1100', '', 'Gyomorkeserű és Pálinka', '2010-09-19', '0000-00-00', 0, 'Szatmári szilva', 'Gyomorkeserű és Pálinka', 0x537a61746dc3a1726920737a696c7661, '0000-00-00', '0000-00-00', 'hu', 'true'),
(105, 'Mézes ágyas meggy', 'Rézangyal', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-09-22', '0000-00-00', 0, 'Mézes ágyas meggy', 'Gyomorkeserű és Pálinka', 0x4dc3a97a657320c3a167796173206d65676779, '0000-00-00', '0000-00-00', 'hu', 'true'),
(106, 'Mézes barack', 'Rézangyal', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-09-25', '0000-00-00', 0, 'Mézes barack', 'Gyomorkeserű és Pálinka', 0x4dc3a97a65732062617261636b, '0000-00-00', '0000-00-00', 'hu', 'true'),
(107, 'Kajszibarack 55% ', 'Rézangyal', '', '', '', '', '1100', '', 'Gyomorkeserű és Pálinka', '2010-09-28', '0000-00-00', 0, 'Kajszibarack 55% ', 'Gyomorkeserű és Pálinka', 0x4b616a737a6962617261636b2035352520, '0000-00-00', '0000-00-00', 'hu', 'true'),
(108, 'Szatmári Szilva 55%', 'Rézangyal', '', '', '', '', '1100', '', 'Gyomorkeserű és Pálinka', '2010-10-01', '0000-00-00', 0, 'Szatmári Szilva 55%', 'Gyomorkeserű és Pálinka', 0x537a61746dc3a1726920537a696c766120353525, '0000-00-00', '0000-00-00', 'hu', 'true'),
(109, 'Meggy 55%', 'Rézangyal', '', '', '', '', '1100', '', 'Gyomorkeserű és Pálinka', '2010-10-04', '0000-00-00', 0, 'Meggy 55%', 'Gyomorkeserű és Pálinka', 0x4d6567677920353525, '0000-00-00', '0000-00-00', 'hu', 'true'),
(110, 'Irsai Olivér szőlő', 'Márton és Lányai', '', '', '', '', '1200', '', 'Gyomorkeserű és Pálinka', '2010-10-07', '0000-00-00', 0, 'Irsai Olivér szőlő', 'Gyomorkeserű és Pálinka', 0x4972736169204f6c6976c3a97220737ac5916cc591, '0000-00-00', '0000-00-00', 'hu', 'true'),
(111, 'Debreczeni muskotályos szilva', 'Márton és Lányai', '', '', '', '', '1200', '', 'Gyomorkeserű és Pálinka', '2010-10-10', '0000-00-00', 0, 'Debreczeni muskotályos szilva', 'Gyomorkeserű és Pálinka', 0x4465627265637a656e69206d75736b6f74c3a16c796f7320737a696c7661, '0000-00-00', '0000-00-00', 'hu', 'true'),
(112, 'Vackor vadkörte', 'Márton és Lányai', '', '', '', '', '1200', '', 'Gyomorkeserű és Pálinka', '2010-10-13', '0000-00-00', 0, 'Vackor vadkörte', 'Gyomorkeserű és Pálinka', 0x5661636b6f72207661646bc3b6727465, '0000-00-00', '0000-00-00', 'hu', 'true'),
(113, 'Sensea Moscato', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-10-16', '0000-00-00', 0, 'Sensea Moscato', 'Gyomorkeserű és Pálinka', 0x53656e736561204d6f736361746f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(114, 'Sensea Prosecco ', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-10-19', '0000-00-00', 0, 'Sensea Prosecco ', 'Gyomorkeserű és Pálinka', 0x53656e7365612050726f736563636fc2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(115, 'Grappa Riserva Magnum ', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '1100', '', 'Gyomorkeserű és Pálinka', '2010-10-22', '0000-00-00', 0, 'Grappa Riserva Magnum ', 'Gyomorkeserű és Pálinka', 0x4772617070612052697365727661204d61676e756dc2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(116, 'Grappa Luce ', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '2400', '', 'Gyomorkeserű és Pálinka', '2010-10-25', '0000-00-00', 0, 'Grappa Luce ', 'Gyomorkeserű és Pálinka', 0x477261707061204c756365c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(117, 'Grappa Sassicaia ', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '2700', '', 'Gyomorkeserű és Pálinka', '2010-10-28', '0000-00-00', 0, 'Grappa Sassicaia ', 'Gyomorkeserű és Pálinka', 0x47726170706120536173736963616961c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(118, 'Calvados Chateau du Breuil - Fine ', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '900', '', 'Gyomorkeserű és Pálinka', '2010-10-31', '0000-00-00', 0, 'Calvados Chateau du Breuil - Fine ', 'Gyomorkeserű és Pálinka', 0x43616c7661646f7320436861746561752064752042726575696c202d2046696e65c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(119, 'Calvados Chateau du Breuil - V.S.O.P. ', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '1700', '', 'Gyomorkeserű és Pálinka', '2010-11-03', '0000-00-00', 0, 'Calvados Chateau du Breuil - V.S.O.P. ', 'Gyomorkeserű és Pálinka', 0x43616c7661646f7320436861746561752064752042726575696c202d20562e532e4f2e502ec2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(120, 'Calvados Chateau du Breuil - X.O. ', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '3500', '', 'Gyomorkeserű és Pálinka', '2010-11-06', '0000-00-00', 0, 'Calvados Chateau du Breuil - X.O. ', 'Gyomorkeserű és Pálinka', 0x43616c7661646f7320436861746561752064752042726575696c202d20582e4f2ec2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(121, 'Baron de Sigognac Bas Armagnac 20 éves', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '4900', '', 'Gyomorkeserű és Pálinka', '2010-11-09', '0000-00-00', 0, 'Baron de Sigognac Bas Armagnac 20 éves', 'Gyomorkeserű és Pálinka', 0x4261726f6e206465205369676f676e6163204261732041726d61676e616320323020c3a9766573, '0000-00-00', '0000-00-00', 'hu', 'true'),
(122, 'Hennessy Fine de Cognanc ', 'Grappa, konyak, párlat - 4 cl', '', '', '', '', '2700', '', 'Gyomorkeserű és Pálinka', '2010-11-12', '0000-00-00', 0, 'Hennessy Fine de Cognanc ', 'Gyomorkeserű és Pálinka', 0x48656e6e657373792046696e6520646520436f676e616e63c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(123, 'Dunhill Fehér / White 0,1mg', 'Dunhill cigaretta ', '', '', '', '', '750', '', 'Cigaretta - Szivarok', '2010-11-15', '0000-00-00', 0, 'Dunhill Fehér / White 0,1mg', 'Cigaretta - Szivarok', 0x44756e68696c6c20466568c3a972202f20576869746520302c316d67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(124, 'Dunhill Világos kék / Light Blue 0,4mg', 'Dunhill cigaretta ', '', '', '', '', '750', '', 'Cigaretta - Szivarok', '2010-11-18', '0000-00-00', 0, 'Dunhill Világos kék / Light Blue 0,4mg', 'Cigaretta - Szivarok', 0x44756e68696c6c2056696cc3a1676f73206bc3a96b202f204c6967687420426c756520302c346d67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(125, 'Dunhill Sötét kék / Dark Blue 0,7 mg', 'Dunhill cigaretta ', '', '', '', '', '750', '', 'Cigaretta - Szivarok', '2010-11-21', '0000-00-00', 0, 'Dunhill Sötét kék / Dark Blue 0,7 mg', 'Cigaretta - Szivarok', 0x44756e68696c6c2053c3b674c3a974206bc3a96b202f204461726b20426c756520302c37206d67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(126, 'Dunhill Fekete / Black 10mg', 'Dunhill cigaretta ', '', '', '', '', '750', '', 'Cigaretta - Szivarok', '2010-11-24', '0000-00-00', 0, 'Dunhill Fekete / Black 10mg', 'Cigaretta - Szivarok', 0x44756e68696c6c2046656b657465202f20426c61636b2031306d67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(127, 'Vogue Lilas 0,4 mg', 'Vogue cigaretta', '', '', '', '', '735', '', 'Cigaretta - Szivarok', '2010-11-27', '0000-00-00', 0, 'Vogue Lilas 0,4 mg', 'Cigaretta - Szivarok', 0x566f677565204c696c617320302c34206d67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(128, 'Vogue Bleue 0,7 mg', 'Vogue cigaretta', '', '', '', '', '735', '', 'Cigaretta - Szivarok', '2010-11-30', '0000-00-00', 0, 'Vogue Bleue 0,7 mg', 'Cigaretta - Szivarok', 0x566f67756520426c65756520302c37206d67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(129, 'Vogue Menthe 0,7 mg', 'Vogue cigaretta', '', '', '', '', '735', '', 'Cigaretta - Szivarok', '2010-12-03', '0000-00-00', 0, 'Vogue Menthe 0,7 mg', 'Cigaretta - Szivarok', 0x566f677565204d656e74686520302c37206d67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(130, 'Vogue Arome 0,4 mg', 'Vogue cigaretta', '', '', '', '', '735', '', 'Cigaretta - Szivarok', '2010-12-06', '0000-00-00', 0, 'Vogue Arome 0,4 mg', 'Cigaretta - Szivarok', 0x566f6775652041726f6d6520302c34206d67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(131, 'Aurora Barrrel Aged Maduro Robusto', 'Szivarok', '', '', '', '', '2200', '', 'Cigaretta - Szivarok', '2010-12-09', '0000-00-00', 0, 'Aurora Barrrel Aged Maduro Robusto', 'Cigaretta - Szivarok', 0x4175726f7261204261727272656c2041676564204d616475726f20526f627573746f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(132, 'Cohiba Siglo I', 'Szivarok', '', '', '', '', '4700', '', 'Cigaretta - Szivarok', '2010-12-12', '0000-00-00', 0, 'Cohiba Siglo I', 'Cigaretta - Szivarok', 0x436f68696261205369676c6f2049, '0000-00-00', '0000-00-00', 'hu', 'true'),
(133, 'Cohiba Siglo IV', 'Szivarok', '', '', '', '', '8500', '', 'Cigaretta - Szivarok', '2010-12-15', '0000-00-00', 0, 'Cohiba Siglo IV', 'Cigaretta - Szivarok', 0x436f68696261205369676c6f204956, '0000-00-00', '0000-00-00', 'hu', 'true'),
(134, 'Cohiba Siglo I V A/T Tubos', 'Szivarok', '', '', '', '', '14500', '', 'Cigaretta - Szivarok', '2010-12-18', '0000-00-00', 0, 'Cohiba Siglo I V A/T Tubos', 'Cigaretta - Szivarok', 0x436f68696261205369676c6f2049205620412f54205475626f73, '0000-00-00', '0000-00-00', 'hu', 'true'),
(135, 'Cohiba Robusto', 'Szivarok', '', '', '', '', '8500', '', 'Cigaretta - Szivarok', '2010-12-21', '0000-00-00', 0, 'Cohiba Robusto', 'Cigaretta - Szivarok', 0x436f6869626120526f627573746f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(136, 'Montecristo Edmundo', 'Szivarok', '', '', '', '', '6000', '', 'Cigaretta - Szivarok', '2010-12-24', '0000-00-00', 0, 'Montecristo Edmundo', 'Cigaretta - Szivarok', 0x4d6f6e746563726973746f2045646d756e646f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(137, 'Oliva Cain 5 3/4x50 Maduro''24', 'Szivarok', '', '', '', '', '2800', '', 'Cigaretta - Szivarok', '2010-12-27', '0000-00-00', 0, 'Oliva Cain 5 3/4x50 Maduro''24', 'Cigaretta - Szivarok', 0x4f6c697661204361696e203520332f34783530204d616475726f273234, '0000-00-00', '0000-00-00', 'hu', 'true'),
(138, 'Partagas De Luxe A/T Tubos', 'Szivarok', '', '', '', '', '3000', '', 'Cigaretta - Szivarok', '2010-12-30', '0000-00-00', 0, 'Partagas De Luxe A/T Tubos', 'Cigaretta - Szivarok', 0x5061727461676173204465204c75786520412f54205475626f73, '0000-00-00', '0000-00-00', 'hu', 'true'),
(139, 'Romeo y Julieta Churchill A/T', 'Szivarok', '', '', '', '', '8500', '', 'Cigaretta - Szivarok', '2011-01-02', '0000-00-00', 0, 'Romeo y Julieta Churchill A/T', 'Cigaretta - Szivarok', 0x526f6d656f2079204a756c6965746120436875726368696c6c20412f54, '0000-00-00', '0000-00-00', 'hu', 'true'),
(140, 'Romeo y Julieta Short Churchill A/T', 'Szivarok', '', '', '', '', '5500', '', 'Cigaretta - Szivarok', '2011-01-05', '0000-00-00', 0, 'Romeo y Julieta Short Churchill A/T', 'Cigaretta - Szivarok', 0x526f6d656f2079204a756c696574612053686f727420436875726368696c6c20412f54, '0000-00-00', '0000-00-00', 'hu', 'true'),
(141, 'Oliva Nub Cigars 358 Connecticut', 'Szivarok', '', '', '', '', '2900', '', 'Cigaretta - Szivarok', '2011-01-08', '0000-00-00', 0, 'Oliva Nub Cigars 358 Connecticut', 'Cigaretta - Szivarok', 0x4f6c697661204e7562204369676172732033353820436f6e6e65637469637574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(142, 'Oliva Nub Cigars 466 Habano (sun grow)', 'Szivarok', '', '', '', '', '3900', '', 'Cigaretta - Szivarok', '2011-01-11', '0000-00-00', 0, 'Oliva Nub Cigars 466 Habano (sun grow)', 'Cigaretta - Szivarok', 0x4f6c697661204e7562204369676172732034363620486162616e6f202873756e2067726f7729, '0000-00-00', '0000-00-00', 'hu', 'true'),
(143, 'Oliva Serie G Toro Tubos', 'Szivarok', '', '', '', '', '2500', '', 'Cigaretta - Szivarok', '2011-01-14', '0000-00-00', 0, 'Oliva Serie G Toro Tubos', 'Cigaretta - Szivarok', 0x4f6c697661205365726965204720546f726f205475626f73, '0000-00-00', '0000-00-00', 'hu', 'true'),
(144, 'Oliva Serie V Belicoso', 'Szivarok', '', '', '', '', '3000', '', 'Cigaretta - Szivarok', '2011-01-17', '0000-00-00', 0, 'Oliva Serie V Belicoso', 'Cigaretta - Szivarok', 0x4f6c69766120536572696520562042656c69636f736f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(145, 'Laurent Perrier Brut (0,375 l)', ' Brut Évjárat Nélkül', '', '', '', '', '8900', '', 'Champagne', '2011-01-20', '0000-00-00', 0, 'Laurent Perrier Brut (0,375 l)', 'Champagne', 0x4c617572656e74205065727269657220427275742028302c333735206c29, '0000-00-00', '0000-00-00', 'hu', 'true'),
(146, 'Alfred Gratien Brut', ' Brut Évjárat Nélkül', '', '', '', '', '13900', '', 'Champagne', '2011-01-23', '0000-00-00', 0, 'Alfred Gratien Brut', 'Champagne', 0x416c66726564204772617469656e2042727574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(147, 'Taittinger Brut Reserve', ' Brut Évjárat Nélkül', '', '', '', '2500', '14900', '', 'Champagne', '2011-01-26', '0000-00-00', 0, 'Taittinger Brut Reserve', 'Champagne', 0x5461697474696e67657220427275742052657365727665, '0000-00-00', '0000-00-00', 'hu', 'true'),
(148, 'Bollinger Special Cuvée', ' Brut Évjárat Nélkül', '', '', '', '', '16900', '', 'Champagne', '2011-01-29', '0000-00-00', 0, 'Bollinger Special Cuvée', 'Champagne', 0x426f6c6c696e676572205370656369616c20437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(149, 'Taittinger Prelude', ' Brut Évjárat Nélkül', '', '', '', '', '19900', '', 'Champagne', '2011-02-01', '0000-00-00', 0, 'Taittinger Prelude', 'Champagne', 0x5461697474696e676572205072656c756465, '0000-00-00', '0000-00-00', 'hu', 'true'),
(150, 'Ayala Brut Zéro Dosage', ' Brut Évjárat Nélkül', '', '', '', '', '14900', '', 'Champagne', '2011-02-04', '0000-00-00', 0, 'Ayala Brut Zéro Dosage', 'Champagne', 0x4179616c612042727574205ac3a9726f20446f73616765, '0000-00-00', '0000-00-00', 'hu', 'true'),
(151, 'Pol Roger Brut ', ' Brut Évjárat Nélkül', '', '', '', '', '15900', '', 'Champagne', '2011-02-07', '0000-00-00', 0, 'Pol Roger Brut ', 'Champagne', 0x506f6c20526f6765722042727574c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(152, 'Louis Roederer Premier Brut', ' Brut Évjárat Nélkül', '', '', '', '', '25000', '', 'Champagne', '2011-02-10', '0000-00-00', 0, 'Louis Roederer Premier Brut', 'Champagne', 0x4c6f75697320526f656465726572205072656d6965722042727574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(153, 'Alfred Gratien Brut Rosé', 'Rosé Évjárat Nélkül', '', '', '', '', '14900', '', 'Champagne', '2011-02-13', '0000-00-00', 0, 'Alfred Gratien Brut Rosé', 'Champagne', 0x416c66726564204772617469656e204272757420526f73c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(154, 'Bollinger Brut Rosé', 'Rosé Évjárat Nélkül', '', '', '', '', '19000', '', 'Champagne', '2011-02-16', '0000-00-00', 0, 'Bollinger Brut Rosé', 'Champagne', 0x426f6c6c696e676572204272757420526f73c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(155, 'Taittinger Brut Rosé', 'Rosé Évjárat Nélkül', '', '', '', '2900', '19900', '', 'Champagne', '2011-02-19', '0000-00-00', 0, 'Taittinger Brut Rosé', 'Champagne', 0x5461697474696e676572204272757420526f73c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(156, 'Laurent Perrier Brut Rosé', 'Rosé Évjárat Nélkül', '', '', '', '', '27900', '', 'Champagne', '2011-02-22', '0000-00-00', 0, 'Laurent Perrier Brut Rosé', 'Champagne', 0x4c617572656e742050657272696572204272757420526f73c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(157, '1999 Delamotte Blanc de Blanc', 'Brut Évjáratos', '', '', '', '', '17900', '', 'Champagne', '2011-02-25', '0000-00-00', 0, '1999 Delamotte Blanc de Blanc', 'Champagne', 0x313939392044656c616d6f74746520426c616e6320646520426c616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(158, '2001 Perlé d’Ayala', 'Brut Évjáratos', '', '', '', '', '25900', '', 'Champagne', '2011-02-28', '0000-00-00', 0, '2001 Perlé d’Ayala', 'Champagne', 0x32303031205065726cc3a92064e280994179616c61, '0000-00-00', '0000-00-00', 'hu', 'true'),
(159, '1999 Bollinger La Grand Année', 'Brut Évjáratos', '', '', '', '', '26900', '', 'Champagne', '2011-03-03', '0000-00-00', 0, '1999 Bollinger La Grand Année', 'Champagne', 0x3139393920426f6c6c696e676572204c61204772616e6420416e6ec3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(160, '1995 / 1996 Bollinger RD', 'Brut Évjáratos', '', '', '', '', '59900', '', 'Champagne', '2011-03-06', '0000-00-00', 0, '1995 / 1996 Bollinger RD', 'Champagne', 0x31393935202f203139393620426f6c6c696e676572205244, '0000-00-00', '0000-00-00', 'hu', 'true'),
(161, 'Laurent Perrier Grand Siécle', 'Brut Évjáratos', '', '', '', '', '49900', '', 'Champagne', '2011-03-09', '0000-00-00', 0, 'Laurent Perrier Grand Siécle', 'Champagne', 0x4c617572656e742050657272696572204772616e64205369c3a9636c65, '0000-00-00', '0000-00-00', 'hu', 'true'),
(162, '1982 Pol Roger Blanc de Blanc', 'Brut Évjáratos', '', '', '', '', '129900', '', 'Champagne', '2011-03-12', '0000-00-00', 0, '1982 Pol Roger Blanc de Blanc', 'Champagne', 0x3139383220506f6c20526f67657220426c616e6320646520426c616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(163, '2002 Louis Roederer Cristal', 'Brut Évjáratos', '', '', '', '', '110000', '', 'Champagne', '2011-03-15', '0000-00-00', 0, '2002 Louis Roederer Cristal', 'Champagne', 0x32303032204c6f75697320526f656465726572204372697374616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(164, '1978 Dom Perignon Cuvée (1,5l)', 'Brut Évjáratos', '', '', '', '', '119900', '', 'Champagne', '2011-03-18', '0000-00-00', 0, '1978 Dom Perignon Cuvée (1,5l)', 'Champagne', 0x3139373820446f6d2050657269676e6f6e20437576c3a9652028312c356c29, '0000-00-00', '0000-00-00', 'hu', 'true'),
(165, '1990 Krug Klos de Mesnil', 'Brut Évjáratos', '', '', '', '', '289900', '', 'Champagne', '2011-03-21', '0000-00-00', 0, '1990 Krug Klos de Mesnil', 'Champagne', 0x31393930204b727567204b6c6f73206465204d65736e696c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(166, '1976 Salon', 'Brut Évjáratos', '', '', '', '', '619900', '', 'Champagne', '2011-03-24', '0000-00-00', 0, '1976 Salon', 'Champagne', 0x313937362053616c6f6e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(167, '1999 Pol Roger Rosé Brut', 'Rosé Évjáratos', '', '', '', '', '22900', '', 'Champagne', '2011-03-27', '0000-00-00', 0, '1999 Pol Roger Rosé Brut', 'Champagne', 0x3139393920506f6c20526f67657220526f73c3a92042727574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(168, 'Hungária Grand Cuvée Brut', 'Pezsgők', '', 'Magyarország - Etyek', '', '900', '5900', 'Törley', 'Pezsg?k - Habzóborok', '2011-03-30', '0000-00-00', 0, 'Hungária Grand Cuvée Brut', 'Pezsg?k - Habzóborok', 0x48756e67c3a1726961204772616e6420437576c3a9652042727574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(169, 'Francois Nyerspezsgő', 'Pezsgők', '', 'Magyarország - Etyek', '', '', '6900', 'Törley', 'Pezsg?k - Habzóborok', '2011-04-02', '0000-00-00', 0, 'Francois Nyerspezsgő', 'Pezsg?k - Habzóborok', 0x4672616e636f6973204e7965727370657a7367c591, '0000-00-00', '0000-00-00', 'hu', 'true'),
(170, 'Francois President Brut Rosé', 'Pezsgők', '', 'Magyarország - Etyek', '', '1200', '6500', 'Törley', 'Pezsg?k - Habzóborok', '2011-04-05', '0000-00-00', 0, 'Francois President Brut Rosé', 'Pezsg?k - Habzóborok', 0x4672616e636f697320507265736964656e74204272757420526f73c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(171, 'Chantoiseau Blanc de Blancs', '', '', 'Franciaország - Bourgogne', '', '', '8900', 'Crémant de Bourgogne', 'Pezsg?k - Habzóborok', '2011-04-08', '0000-00-00', 0, 'Chantoiseau Blanc de Blancs', 'Pezsg?k - Habzóborok', 0x4368616e746f697365617520426c616e6320646520426c616e6373, '0000-00-00', '0000-00-00', 'hu', 'true'),
(172, 'Bosca Prosecco D.O.C.', '', '', 'Olaszország - Veneto', '', '1000', '6900', 'Bosca ', 'Pezsg?k - Habzóborok', '2011-04-11', '0000-00-00', 0, 'Bosca Prosecco D.O.C.', 'Pezsg?k - Habzóborok', 0x426f7363612050726f736563636f20442e4f2e432e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(173, 'Il Rosé', '', '', '', '', '', '4900', 'Mionetto ', 'Pezsg?k - Habzóborok', '2011-04-14', '0000-00-00', 0, 'Il Rosé', 'Pezsg?k - Habzóborok', 0x496c20526f73c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(174, 'Curtefranca Brut', '', '', 'Olaszország - Lombardia', '', '', '11900', 'Ca'' Del Bosco', 'Pezsg?k - Habzóborok', '2011-04-17', '0000-00-00', 0, 'Curtefranca Brut', 'Pezsg?k - Habzóborok', 0x43757274656672616e63612042727574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(175, '2007 Gewurtztraminer', 'Fehérborok', '', 'Rhone', '', '', '7900', 'Ch.&D. Frey', 'Francia Borok', '2011-04-20', '0000-00-00', 0, '2007 Gewurtztraminer', 'Francia Borok', 0x32303037204765777572747a7472616d696e6572, '0000-00-00', '0000-00-00', 'hu', 'true'),
(176, ' 2007 Condrieu', 'Fehérborok', '', 'Rhone', '', '', '12900', ' Louis Cheze', 'Francia Borok', '2011-04-23', '0000-00-00', 0, ' 2007 Condrieu', 'Francia Borok', 0xc2a03230303720436f6e6472696575, '0000-00-00', '0000-00-00', 'hu', 'true'),
(177, ' 2007 Crozes Hermitage', 'Fehérborok', '', 'Rhone', '', '', '8900', ' J.L.Colombo', 'Francia Borok', '2011-04-26', '0000-00-00', 0, ' 2007 Crozes Hermitage', 'Francia Borok', 0xc2a0323030372043726f7a6573204865726d6974616765, '0000-00-00', '0000-00-00', 'hu', 'true'),
(178, ' 2007 Pouilly Fumé Les Logeres AOC', 'Fehérborok', '', 'Loire', '', '', '8900', 'Guy Saget', 'Francia Borok', '2011-04-29', '0000-00-00', 0, ' 2007 Pouilly Fumé Les Logeres AOC', 'Francia Borok', 0xc2a03230303720506f75696c6c792046756dc3a9204c6573204c6f676572657320414f43, '0000-00-00', '0000-00-00', 'hu', 'true'),
(179, '2003 Grand Ardeche Chardonnay', 'Fehérborok', '', 'Bourgogne', '', '', '9900', 'Louis Latour', 'Francia Borok', '2011-05-02', '0000-00-00', 0, '2003 Grand Ardeche Chardonnay', 'Francia Borok', 0x32303033204772616e6420417264656368652043686172646f6e6e6179, '0000-00-00', '0000-00-00', 'hu', 'true'),
(180, '2008 Gigondas', 'Vörösborok', '', 'Rhone', '', '', '8900', 'Xavier', 'Francia Borok', '2011-05-05', '0000-00-00', 0, '2008 Gigondas', 'Francia Borok', 0x32303038204769676f6e646173, '0000-00-00', '0000-00-00', 'hu', 'true'),
(181, ' 2006 Châteauneuf-du-Pape', 'Vörösborok', '', 'Rhone', '', '', '12900', ' Chapoutier', 'Francia Borok', '2011-05-08', '0000-00-00', 0, ' 2006 Châteauneuf-du-Pape', 'Francia Borok', 0xc2a032303036204368c3a2746561756e6575662d64752d50617065, '0000-00-00', '0000-00-00', 'hu', 'true'),
(182, ' 2006 Cuvée Anges', 'Vörösborok', '', 'Rhone', '', '', '12900', ' Louis Cheze', 'Francia Borok', '2011-05-11', '0000-00-00', 0, ' 2006 Cuvée Anges', 'Francia Borok', 0xc2a03230303620437576c3a96520416e676573, '0000-00-00', '0000-00-00', 'hu', 'true'),
(183, ' 2006 Hermitage', 'Vörösborok', '', 'Rhone', '', '', '19900', ' J.L.Colombo', 'Francia Borok', '2011-05-14', '0000-00-00', 0, ' 2006 Hermitage', 'Francia Borok', 0xc2a032303036204865726d6974616765, '0000-00-00', '0000-00-00', 'hu', 'true'),
(184, ' 2003 Châteauneuf-du-Pape', 'Vörösborok', '', 'Rhone', '', '', '14900', ' Chateau de la Gardine', 'Francia Borok', '2011-05-17', '0000-00-00', 0, ' 2003 Châteauneuf-du-Pape', 'Francia Borok', 0xc2a032303033204368c3a2746561756e6575662d64752d50617065, '0000-00-00', '0000-00-00', 'hu', 'true'),
(185, ' 2006 Cornas', 'Vörösborok', '', 'Rhone', '', '', '21900', ' Domaine Courbis', 'Francia Borok', '2011-05-20', '0000-00-00', 0, ' 2006 Cornas', 'Francia Borok', 0xc2a03230303620436f726e6173, '0000-00-00', '0000-00-00', 'hu', 'true'),
(186, ' 2006 Mercurey', 'Vörösborok', '', 'Bourgogne', '', '', '8900', ' Chateau d''Etroyes', 'Francia Borok', '2011-05-23', '0000-00-00', 0, ' 2006 Mercurey', 'Francia Borok', 0xc2a032303036204d65726375726579, '0000-00-00', '0000-00-00', 'hu', 'true'),
(187, '1984 Mercurey ''Clos de Barraults'' - Pinot', 'Vörösborok', '', 'Bourgogne', '', '', '25900', 'Michel Juillot', 'Francia Borok', '2011-05-26', '0000-00-00', 0, '1984 Mercurey ''Clos de Barraults'' - Pinot', 'Francia Borok', 0x31393834204d657263757265792027436c6f73206465204261727261756c747327202d2050696e6f74, '0000-00-00', '0000-00-00', 'hu', 'true'),
(188, '2001 Mercurey Corton Perriéres - Pinot', 'Vörösborok', '', 'Bourgogne', '', '', '31900', 'Michel Juillot', 'Francia Borok', '2011-05-29', '0000-00-00', 0, '2001 Mercurey Corton Perriéres - Pinot', 'Francia Borok', 0x32303031204d6572637572657920436f72746f6e205065727269c3a9726573202d2050696e6f74, '0000-00-00', '0000-00-00', 'hu', 'true'),
(189, '2001 Château Anthonic', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '12900', ' Moulis en Medoc ', 'Francia Borok', '2011-06-01', '0000-00-00', 0, '2001 Château Anthonic', 'Francia Borok', 0x32303031204368c3a27465617520416e74686f6e6963, '0000-00-00', '0000-00-00', 'hu', 'true'),
(190, '2003 Chateau Sansonnet', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '19900', ' Saint-Émilion', 'Francia Borok', '2011-06-04', '0000-00-00', 0, '2003 Chateau Sansonnet', 'Francia Borok', 0x3230303320436861746561752053616e736f6e6e6574, '0000-00-00', '0000-00-00', 'hu', 'true');
INSERT INTO `drinks` (`id`, `title`, `type`, `price`, `place`, `body`, `priceglass`, `pricebottle`, `winery`, `categories`, `created`, `edited`, `image`, `meta_title`, `meta_keywords`, `meta_desc`, `date_from`, `date_to`, `lang`, `active`) VALUES
(191, '2001 Château La Lagune', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '29900', ' Haut Medoc 3*CC ', 'Francia Borok', '2011-06-07', '0000-00-00', 0, '2001 Château La Lagune', 'Francia Borok', 0x32303031204368c3a274656175204c61204c6167756e65, '0000-00-00', '0000-00-00', 'hu', 'true'),
(192, '1981 Château Chasse - Spleen', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '29900', ' Moulis en Medoc', 'Francia Borok', '2011-06-10', '0000-00-00', 0, '1981 Château Chasse - Spleen', 'Francia Borok', 0x31393831204368c3a27465617520436861737365202d2053706c65656e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(193, '1999 Château Gazin', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '39900', ' Pomerol', 'Francia Borok', '2011-06-13', '0000-00-00', 0, '1999 Château Gazin', 'Francia Borok', 0x31393939204368c3a2746561752047617a696e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(194, '1990 Château Prieuré Lichine', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '41900', ' Margaux ', 'Francia Borok', '2011-06-16', '0000-00-00', 0, '1990 Château Prieuré Lichine', 'Francia Borok', 0x31393930204368c3a27465617520507269657572c3a9204c696368696e65, '0000-00-00', '0000-00-00', 'hu', 'true'),
(195, '2001 Château Figeac', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '41900', ' Saint-Émilion', 'Francia Borok', '2011-06-19', '0000-00-00', 0, '2001 Château Figeac', 'Francia Borok', 0x32303031204368c3a27465617520466967656163, '0000-00-00', '0000-00-00', 'hu', 'true'),
(196, '1988 Château Figeac', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '51900', ' Saint-Émilion', 'Francia Borok', '2011-06-22', '0000-00-00', 0, '1988 Château Figeac', 'Francia Borok', 0x31393838204368c3a27465617520466967656163, '0000-00-00', '0000-00-00', 'hu', 'true'),
(197, '1972 Château Cheval Blanc', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '149900', ' Saint-Émilion', 'Francia Borok', '2011-06-25', '0000-00-00', 0, '1972 Château Cheval Blanc', 'Francia Borok', 0x31393732204368c3a2746561752043686576616c20426c616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(198, '1999 Château Cheval Blanc-Magnum (1,5l)', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '289900', ' Saint-Émilion', 'Francia Borok', '2011-06-28', '0000-00-00', 0, '1999 Château Cheval Blanc-Magnum (1,5l)', 'Francia Borok', 0x31393939204368c3a2746561752043686576616c20426c616e632d4d61676e756d2028312c356c29, '0000-00-00', '0000-00-00', 'hu', 'true'),
(199, '1986 Château Latour', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '159900', ' Pouillac', 'Francia Borok', '2011-07-01', '0000-00-00', 0, '1986 Château Latour', 'Francia Borok', 0x31393836204368c3a274656175204c61746f7572, '0000-00-00', '0000-00-00', 'hu', 'true'),
(200, '1975 Château Lafite Rothschild', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '169900', ' Pouillac', 'Francia Borok', '2011-07-04', '0000-00-00', 0, '1975 Château Lafite Rothschild', 'Francia Borok', 0x31393735204368c3a274656175204c616669746520526f7468736368696c64, '0000-00-00', '0000-00-00', 'hu', 'true'),
(201, '2003 Château Lafite Rothschild', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '299900', ' Pouillac', 'Francia Borok', '2011-07-07', '0000-00-00', 0, '2003 Château Lafite Rothschild', 'Francia Borok', 0x32303033204368c3a274656175204c616669746520526f7468736368696c64, '0000-00-00', '0000-00-00', 'hu', 'true'),
(202, '1995 Château Margaux', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '199900', ' Margaux ', 'Francia Borok', '2011-07-10', '0000-00-00', 0, '1995 Château Margaux', 'Francia Borok', 0x31393935204368c3a274656175204d617267617578, '0000-00-00', '0000-00-00', 'hu', 'true'),
(203, '2000 Château Mouton Rothschild', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '299900', ' Pouillac', 'Francia Borok', '2011-07-13', '0000-00-00', 0, '2000 Château Mouton Rothschild', 'Francia Borok', 0x32303030204368c3a274656175204d6f75746f6e20526f7468736368696c64, '0000-00-00', '0000-00-00', 'hu', 'true'),
(204, '1988 Château Petrus', 'Francia Grand Cru válogatás', '', 'Bourgogne', '', '', '459900', ' Pomerol', 'Francia Borok', '2011-07-16', '0000-00-00', 0, '1988 Château Petrus', 'Francia Borok', 0x31393838204368c3a27465617520506574727573, '0000-00-00', '0000-00-00', 'hu', 'true'),
(205, ' 2009 Muga Blanco', 'Fehérborok', '', '', '', '', '7900', '', 'Spanyolország', '2011-07-19', '0000-00-00', 0, ' 2009 Muga Blanco', 'Spanyolország', 0xc2a032303039204d75676120426c616e636f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(206, ' 2005 Reserva Muga', 'Vörösborok', '', '', '', '', '13900', 'Muga', 'Spanyolország', '2011-07-22', '0000-00-00', 0, ' 2005 Reserva Muga', 'Spanyolország', 0xc2a0323030352052657365727661204d756761, '0000-00-00', '0000-00-00', 'hu', 'true'),
(207, ' 2001 Grand Reserva Prado', 'Vörösborok', '', '', '', '', '21900', 'Muga', 'Spanyolország', '2011-07-25', '0000-00-00', 0, ' 2001 Grand Reserva Prado', 'Spanyolország', 0xc2a032303031204772616e64205265736572766120507261646f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(208, ' 2004 Spiga', 'Vörösborok', '', '', '', '', '12900', 'O.Fournier', 'Spanyolország', '2011-07-28', '0000-00-00', 0, ' 2004 Spiga', 'Spanyolország', 0xc2a032303034205370696761, '0000-00-00', '0000-00-00', 'hu', 'true'),
(209, ' 2004 Icon Tinta del Pais', 'Vörösborok', '', '', '', '', '24900', 'O.Fournier', 'Spanyolország', '2011-07-31', '0000-00-00', 0, ' 2004 Icon Tinta del Pais', 'Spanyolország', 0xc2a0323030342049636f6e2054696e74612064656c2050616973, '0000-00-00', '0000-00-00', 'hu', 'true'),
(210, ' 2009  Sauvignon Blanc', 'Fehérborok', '', '', '', '', '7500', 'Villa Maria', 'Új-Zéland', '2011-08-03', '0000-00-00', 0, ' 2009  Sauvignon Blanc', 'Új-Zéland', 0xc2a032303039c2a0205361757669676e6f6e20426c616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(211, ' 2005 Irony Pinot Noir', 'Vörösborok', '', '', '', '', '13900', 'Monterey County', 'Kalifornia', '2011-08-06', '0000-00-00', 0, ' 2005 Irony Pinot Noir', 'Kalifornia', 0xc2a0323030352049726f6e792050696e6f74204e6f6972, '0000-00-00', '0000-00-00', 'hu', 'true'),
(212, ' 2008 Zinfandel', 'Vörösborok', '', '', '', '', '12900', 'Rancho Zabaco', 'Kalifornia', '2011-08-09', '0000-00-00', 0, ' 2008 Zinfandel', 'Kalifornia', 0xc2a032303038205a696e66616e64656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(213, ' 2009 El Descanso Sauvignon Blanc', 'Fehérborok', '', '', '', '', '3900', ' Errazuriz ', 'Új-Zéland / Chile and Argentina', '2011-08-12', '0000-00-00', 0, ' 2009 El Descanso Sauvignon Blanc', 'Új-Zéland / Chile and Argentina', 0xc2a03230303920456c2044657363616e736f205361757669676e6f6e20426c616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(214, ' 2008 Estate Chardonnay', 'Fehérborok', '', '', '', '', '5900', ' Errazuriz ', 'Új-Zéland / Chile and Argentina', '2011-08-15', '0000-00-00', 0, ' 2008 Estate Chardonnay', 'Új-Zéland / Chile and Argentina', 0xc2a032303038204573746174652043686172646f6e6e6179, '0000-00-00', '0000-00-00', 'hu', 'true'),
(215, ' 2008 Single Vineyard Sauvignon Blanc', 'Fehérborok', '', '', '', '', '7900', ' Errazuriz ', 'Új-Zéland / Chile and Argentina', '2011-08-18', '0000-00-00', 0, ' 2008 Single Vineyard Sauvignon Blanc', 'Új-Zéland / Chile and Argentina', 0xc2a0323030382053696e676c652056696e6579617264205361757669676e6f6e20426c616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(216, ' 2008 Max Reserva Chardonnay', 'Fehérborok', '', '', '', '', '6900', ' Errazuriz ', 'Új-Zéland / Chile and Argentina', '2011-08-21', '0000-00-00', 0, ' 2008 Max Reserva Chardonnay', 'Új-Zéland / Chile and Argentina', 0xc2a032303038204d617820526573657276612043686172646f6e6e6179, '0000-00-00', '0000-00-00', 'hu', 'true'),
(217, ' 2007/2008 B-Crux Sauvignon Blanc', 'Fehérborok', '', '', '', '', '6900', ' O.Fournier', 'Új-Zéland / Chile and Argentina', '2011-08-24', '0000-00-00', 0, ' 2007/2008 B-Crux Sauvignon Blanc', 'Új-Zéland / Chile and Argentina', 0xc2a0323030372f3230303820422d43727578205361757669676e6f6e20426c616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(218, ' 2009 El Descanso Cabernet Sauvignon', 'Vörösborok', '', '', '', '900', '3900', ' Errazuriz', 'Új-Zéland / Chile and Argentina', '2011-08-27', '0000-00-00', 0, ' 2009 El Descanso Cabernet Sauvignon', 'Új-Zéland / Chile and Argentina', 0xc2a03230303920456c2044657363616e736f2043616265726e6574205361757669676e6f6e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(219, ' 2007 Urban Uco Tempranillo', 'Vörösborok', '', '', '', '1300', '5900', ' O.Fournier', 'Új-Zéland / Chile and Argentina', '2011-08-30', '0000-00-00', 0, ' 2007 Urban Uco Tempranillo', 'Új-Zéland / Chile and Argentina', 0xc2a03230303720557262616e2055636f2054656d7072616e696c6c6f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(220, ' 2007 Estate Shiraz', 'Vörösborok', '', '', '', '1300', '5900', ' Errazuriz', 'Új-Zéland / Chile and Argentina', '2011-09-02', '0000-00-00', 0, ' 2007 Estate Shiraz', 'Új-Zéland / Chile and Argentina', 0xc2a032303037204573746174652053686972617a, '0000-00-00', '0000-00-00', 'hu', 'true'),
(221, ' 2008 Estate Cabernet Sauvignon', 'Vörösborok', '', '', '', '', '6900', ' Errazuriz', 'Új-Zéland / Chile and Argentina', '2011-09-05', '0000-00-00', 0, ' 2008 Estate Cabernet Sauvignon', 'Új-Zéland / Chile and Argentina', 0xc2a032303038204573746174652043616265726e6574205361757669676e6f6e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(222, ' 2009 Estate Carnenere', 'Vörösborok', '', '', '', '', '6900', ' Errazuriz', 'Új-Zéland / Chile and Argentina', '2011-09-08', '0000-00-00', 0, ' 2009 Estate Carnenere', 'Új-Zéland / Chile and Argentina', 0xc2a03230303920457374617465204361726e656e657265, '0000-00-00', '0000-00-00', 'hu', 'true'),
(223, ' 2008 Malbec Mendoza', 'Vörösborok', '', '', '', '', '8900', ' Achaval Ferrer', 'Új-Zéland / Chile and Argentina', '2011-09-11', '0000-00-00', 0, ' 2008 Malbec Mendoza', 'Új-Zéland / Chile and Argentina', 0xc2a032303038204d616c626563204d656e646f7a61, '0000-00-00', '0000-00-00', 'hu', 'true'),
(224, ' 2006 Max Reserva Merlot ', 'Vörösborok', '', '', '', '', '8900', ' Errazuriz', 'Új-Zéland / Chile and Argentina', '2011-09-14', '0000-00-00', 0, ' 2006 Max Reserva Merlot ', 'Új-Zéland / Chile and Argentina', 0xc2a032303036204d61782052657365727661204d65726c6f74c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(225, ' 2007 Organic Cabernet Sauvignon ', 'Vörösborok', '', '', '', '', '9900', ' Errazuriz   ', 'Új-Zéland / Chile and Argentina', '2011-09-17', '0000-00-00', 0, ' 2007 Organic Cabernet Sauvignon ', 'Új-Zéland / Chile and Argentina', 0xc2a032303037204f7267616e69632043616265726e6574205361757669676e6f6ec2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(226, ' 2007 Kuyen ', 'Vörösborok', '', '', '', '', '11900', ' Antiyal ', 'Új-Zéland / Chile and Argentina', '2011-09-20', '0000-00-00', 0, ' 2007 Kuyen ', 'Új-Zéland / Chile and Argentina', 0xc2a032303037204b7579656ec2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(227, ' 2008 Single Vineyard Carmenere  ', 'Vörösborok', '', '', '', '', '14900', ' Errazuriz ', 'Új-Zéland / Chile and Argentina', '2011-09-23', '0000-00-00', 0, ' 2008 Single Vineyard Carmenere  ', 'Új-Zéland / Chile and Argentina', 0xc2a0323030382053696e676c652056696e6579617264204361726d656e65726520c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(228, ' 2007 Single Vineyard Cabernet Sauvignon ', 'Vörösborok', '', '', '', '', '14900', ' Errazuriz ', 'Új-Zéland / Chile and Argentina', '2011-09-26', '0000-00-00', 0, ' 2007 Single Vineyard Cabernet Sauvignon ', 'Új-Zéland / Chile and Argentina', 0xc2a0323030372053696e676c652056696e65796172642043616265726e6574205361757669676e6f6ec2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(229, ' 2003 Alfa Crux Blend', 'Vörösborok', '', '', '', '', '15900', ' O.Fournier', 'Új-Zéland / Chile and Argentina', '2011-09-29', '0000-00-00', 0, ' 2003 Alfa Crux Blend', 'Új-Zéland / Chile and Argentina', 0xc2a03230303320416c6661204372757820426c656e64, '0000-00-00', '0000-00-00', 'hu', 'true'),
(230, ' 2002 Alfa Crux Malbec', 'Vörösborok', '', '', '', '', '17900', ' O.Fournier', 'Új-Zéland / Chile and Argentina', '2011-10-02', '0000-00-00', 0, ' 2002 Alfa Crux Malbec', 'Új-Zéland / Chile and Argentina', 0xc2a03230303220416c66612043727578204d616c626563, '0000-00-00', '0000-00-00', 'hu', 'true'),
(231, ' 2007 Quimera ', 'Vörösborok', '', '', '', '', '17900', ' Achaval Ferrer', 'Új-Zéland / Chile and Argentina', '2011-10-05', '0000-00-00', 0, ' 2007 Quimera ', 'Új-Zéland / Chile and Argentina', 0xc2a032303037205175696d657261c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(232, ' 2006 Don Maximiano', 'Vörösborok', '', '', '', '', '23900', ' Errazuriz', 'Új-Zéland / Chile and Argentina', '2011-10-08', '0000-00-00', 0, ' 2006 Don Maximiano', 'Új-Zéland / Chile and Argentina', 0xc2a03230303620446f6e204d6178696d69616e6f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(233, ' 2005 Icon Blend ', 'Vörösborok', '', '', '', '', '24900', ' O.Fournier', 'Új-Zéland / Chile and Argentina', '2011-10-11', '0000-00-00', 0, ' 2005 Icon Blend ', 'Új-Zéland / Chile and Argentina', 0xc2a0323030352049636f6e20426c656e64c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(234, '2008 Pinot Grigio DOC Black Label', 'Fehérborok', '', 'Friuli ', '', '', '5900', 'Eugenio Collavini', 'Olasz Borok', '2011-10-14', '0000-00-00', 0, '2008 Pinot Grigio DOC Black Label', 'Olasz Borok', 0x323030382050696e6f742047726967696f20444f4320426c61636b204c6162656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(235, '2008 Levarie Soave Classico', 'Fehérborok', '', 'Friuli ', '', '', '6900', 'Masi', 'Olasz Borok', '2011-10-17', '0000-00-00', 0, '2008 Levarie Soave Classico', 'Olasz Borok', 0x32303038204c65766172696520536f61766520436c61737369636f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(236, '2008 Alcamo Bianco DOC', 'Fehérborok', '', 'Sicilia ', '', '', '5900', 'Firriato', 'Olasz Borok', '2011-10-20', '0000-00-00', 0, '2008 Alcamo Bianco DOC', 'Olasz Borok', 0x3230303820416c63616d6f204269616e636f20444f43, '0000-00-00', '0000-00-00', 'hu', 'true'),
(237, ' 2007 Chiaramonte Ansonica Bianco', 'Fehérborok', '', 'Sicilia ', '', '', '6900', ' Firriato', 'Olasz Borok', '2011-10-23', '0000-00-00', 0, ' 2007 Chiaramonte Ansonica Bianco', 'Olasz Borok', 0xc2a032303037204368696172616d6f6e746520416e736f6e696361204269616e636f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(238, '2007 Gavi di Gavi DOCG', 'Fehérborok', '', 'Piemont ', '', '', '7900', 'Bersano', 'Olasz Borok', '2011-10-26', '0000-00-00', 0, '2007 Gavi di Gavi DOCG', 'Olasz Borok', 0x323030372047617669206469204761766920444f4347, '0000-00-00', '0000-00-00', 'hu', 'true'),
(239, '2008 Bardolino Chiaretto', 'Fehérborok', '', 'Veneto', '', '', '4900', 'Bolla', 'Olasz Borok', '2011-10-29', '0000-00-00', 0, '2008 Bardolino Chiaretto', 'Olasz Borok', 0x3230303820426172646f6c696e6f2043686961726574746f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(240, '2007 Barbera D''Asti Costalunga D.O.C.', 'Vörösborok', '', 'Piemont ', '', '', '7900', 'Bersano', 'Olasz Borok', '2011-11-01', '0000-00-00', 0, '2007 Barbera D''Asti Costalunga D.O.C.', 'Olasz Borok', 0x3230303720426172626572612044274173746920436f7374616c756e676120442e4f2e432e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(241, '2007 Montepulciano D'' Abruzzo D.O.C', 'Vörösborok', '', 'Toscana', '', '', '8500', 'Azienda di Sipio', 'Olasz Borok', '2011-11-04', '0000-00-00', 0, '2007 Montepulciano D'' Abruzzo D.O.C', 'Olasz Borok', 0x32303037204d6f6e746570756c6369616e6f20442720416272757a7a6f20442e4f2e43, '0000-00-00', '0000-00-00', 'hu', 'true'),
(242, '2007 Rosso di Montalcino', 'Vörösborok', '', 'Toscana', '', '', '9900', 'Lazaretti', 'Olasz Borok', '2011-11-07', '0000-00-00', 0, '2007 Rosso di Montalcino', 'Olasz Borok', 0x3230303720526f73736f206469204d6f6e74616c63696e6f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(243, '2007 Chianti Colli Senesi', 'Vörösborok', '', 'Toscana', '', '', '11900', 'Fornaci di Sotto', 'Olasz Borok', '2011-11-10', '0000-00-00', 0, '2007 Chianti Colli Senesi', 'Olasz Borok', 0x3230303720436869616e746920436f6c6c692053656e657369, '0000-00-00', '0000-00-00', 'hu', 'true'),
(244, '2004 Brunello di Montalcino (Wine spect.92p)', 'Vörösborok', '', 'Toscana', '', '', '19900', 'Talenti ', 'Olasz Borok', '2011-11-13', '0000-00-00', 0, '2004 Brunello di Montalcino (Wine spect.92p)', 'Olasz Borok', 0x32303034204272756e656c6c6f206469204d6f6e74616c63696e6f202857696e652073706563742e39327029, '0000-00-00', '0000-00-00', 'hu', 'true'),
(245, '2006 Lucente', 'Vörösborok', '', 'Toscana', '', '', '19900', 'Frescobaldi', 'Olasz Borok', '2011-11-16', '0000-00-00', 0, '2006 Lucente', 'Olasz Borok', 0x32303036204c7563656e7465, '0000-00-00', '0000-00-00', 'hu', 'true'),
(246, '2007 Primitivo "Thyrsos" D.O.C', 'Vörösborok', '', 'Puglia', '', '', '6900', ' Azienda Pezzaviva', 'Olasz Borok', '2011-11-19', '0000-00-00', 0, '"2007 Primitivo ""Thyrsos"" D.O.C"', 'Olasz Borok', 0x2232303037205072696d697469766f20222254687972736f73222220442e4f2e43220d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(247, '2007 Chiaramonte Rosso Sicilia IGT', 'Vörösborok', '', 'Sicila', '', '', '8900', 'Firrato', 'Olasz Borok', '2011-11-22', '0000-00-00', 0, '2007 Chiaramonte Rosso Sicilia IGT', 'Olasz Borok', 0x32303037204368696172616d6f6e746520526f73736f20536963696c696120494754, '0000-00-00', '0000-00-00', 'hu', 'true'),
(248, '2008 Banyászó Olaszrizling', 'Fehérborok', '', 'Balaton ', '', '1700', '7500', 'Légli', 'Magyar Borok', '2011-11-25', '0000-00-00', 0, '2008 Banyászó Olaszrizling', 'Magyar Borok', 0x323030382042616e79c3a1737ac3b3204f6c61737a72697a6c696e67, '0000-00-00', '0000-00-00', 'hu', 'true'),
(249, '2008 Kerkaborum Vörcsöki Furmint', 'Fehérborok', '', 'Balaton ', '', '1300', '5900', 'Kerkaborum', 'Magyar Borok', '2011-11-28', '0000-00-00', 0, '2008 Kerkaborum Vörcsöki Furmint', 'Magyar Borok', 0x32303038204b65726b61626f72756d2056c3b6726373c3b66b69204675726d696e74, '0000-00-00', '0000-00-00', 'hu', 'true'),
(250, '2008 Fresküvé', 'Fehérborok', '', 'Etyek', '', '1100', '5000', 'Rókusfalvy', 'Magyar Borok', '2011-12-01', '0000-00-00', 0, '2008 Fresküvé', 'Magyar Borok', 0x3230303820467265736bc3bc76c3a9, '0000-00-00', '0000-00-00', 'hu', 'true'),
(251, ' 2007 Sauvignon Blanc (fahordós) ', 'Fehérborok', '', 'Etyek', '', '', '6500', ' Rókusfalvy', 'Magyar Borok', '2011-12-04', '0000-00-00', 0, ' 2007 Sauvignon Blanc (fahordós) ', 'Magyar Borok', 0xc2a032303037205361757669676e6f6e20426c616e6320286661686f7264c3b37329c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(252, ' 2009 Hanga', 'Fehérborok', '', ' Eger', '', '', '4900', ' Demeter', 'Magyar Borok', '2011-12-07', '0000-00-00', 0, ' 2009 Hanga', 'Magyar Borok', 0xc2a0323030392048616e6761, '0000-00-00', '0000-00-00', 'hu', 'true'),
(253, ' 2007 Chardonnay Battonage', 'Fehérborok', '', ' Eger', '', '1500', '6900', ' Kovács Nimród', 'Magyar Borok', '2011-12-10', '0000-00-00', 0, ' 2007 Chardonnay Battonage', 'Magyar Borok', 0xc2a0323030372043686172646f6e6e617920426174746f6e616765, '0000-00-00', '0000-00-00', 'hu', 'true'),
(254, ' 2009 Napbor', 'Fehérborok', '', ' Eger', '', '1500', '6900', ' St-Andrea', 'Magyar Borok', '2011-12-13', '0000-00-00', 0, ' 2009 Napbor', 'Magyar Borok', 0xc2a032303039204e6170626f72, '0000-00-00', '0000-00-00', 'hu', 'true'),
(255, '2009 Csenge', 'Fehérborok', '', 'Villány ', '', '1100', '4900', 'Tiffán', 'Magyar Borok', '2011-12-16', '0000-00-00', 0, '2009 Csenge', 'Magyar Borok', 0x32303039204373656e6765, '0000-00-00', '0000-00-00', 'hu', 'true'),
(256, ' 2008 Noblesse Chardonnay', 'Fehérborok', '', 'Villány ', '', '2200', '9900', ' Malatinszky', 'Magyar Borok', '2011-12-19', '0000-00-00', 0, ' 2008 Noblesse Chardonnay', 'Magyar Borok', 0xc2a032303038204e6f626c657373652043686172646f6e6e6179, '0000-00-00', '0000-00-00', 'hu', 'true'),
(257, '2005 "Tojáséj" Furmint (Magnum 1,5L) MANNA RESERVE ', 'Fehérborok', '', 'Tokaj-Hegyalja', '', '800', '7500', 'Németh Attila', 'Magyar Borok', '2011-12-22', '0000-00-00', 0, '"2005 ""Tojáséj"" Furmint (Magnum 1,5L) MANNA RESERVE "', 'Magyar Borok', 0x2232303035202222546f6ac3a173c3a96a2222204675726d696e7420284d61676e756d20312c354c29204d414e4e412052455345525645c2a0220d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(258, '2009 Sauvignon Blanc', 'Fehérborok', '', 'Tokaj-Hegyalja', '', '', '5000', 'Árvay', 'Magyar Borok', '2011-12-25', '0000-00-00', 0, '2009 Sauvignon Blanc', 'Magyar Borok', 0x32303039205361757669676e6f6e20426c616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(259, '2003 Istenhegyi Furmint', 'Fehérborok', '', 'Tokaj-Hegyalja', '', '', '5900', 'Árvay', 'Magyar Borok', '2011-12-28', '0000-00-00', 0, '2003 Istenhegyi Furmint', 'Magyar Borok', 0x3230303320497374656e6865677969204675726d696e74, '0000-00-00', '0000-00-00', 'hu', 'true'),
(260, '2006 Vióka 2 Furmint', 'Fehérborok', '', 'Tokaj-Hegyalja', '', '', '5900', 'AZ pince', 'Magyar Borok', '2011-12-31', '0000-00-00', 0, '2006 Vióka 2 Furmint', 'Magyar Borok', 0x32303036205669c3b36b612032204675726d696e74, '0000-00-00', '0000-00-00', 'hu', 'true'),
(261, '2000 Szamorodni ( 0,5 l )', 'Fehérborok', '', 'Tokaj-Hegyalja', '', '1100', '4900', 'Árvay                     1dl', 'Magyar Borok', '2012-01-03', '0000-00-00', 0, '2000 Szamorodni ( 0,5 l )', 'Magyar Borok', 0x3230303020537a616d6f726f646e69202820302c35206c2029, '0000-00-00', '0000-00-00', 'hu', 'true'),
(262, '2009 Cab.Sauv-Kadarka', 'Roséborok', '', 'Villány ', '', '', '4900', 'Malatinszky', 'Magyar Borok', '2012-01-06', '0000-00-00', 0, '2009 Cab.Sauv-Kadarka', 'Magyar Borok', 0x32303039204361622e536175762d4b616461726b61, '0000-00-00', '0000-00-00', 'hu', 'true'),
(263, '2009 Kékfrankos', 'Roséborok', '', 'Szekszárd ', '', '1100', '4900', 'Dúzsi', 'Magyar Borok', '2012-01-09', '0000-00-00', 0, '2009 Kékfrankos', 'Magyar Borok', 0x32303039204bc3a96b6672616e6b6f73, '0000-00-00', '0000-00-00', 'hu', 'true'),
(264, '2008 Pinot Noir Esterhazy', 'Vörösborok', '', 'Etyek', '', '', '9900', 'Etyeki Kúria   ', 'Magyar Borok', '2012-01-12', '0000-00-00', 0, '2008 Pinot Noir Esterhazy', 'Magyar Borok', 0x323030382050696e6f74204e6f6972c2a0457374657268617a79, '0000-00-00', '0000-00-00', 'hu', 'true'),
(265, '2008 Nyitnikék Cuvée', 'Vörösborok', '', 'Eger, Mátra ', '', '', '5900', 'Losonci Bálint', 'Magyar Borok', '2012-01-15', '0000-00-00', 0, '2008 Nyitnikék Cuvée', 'Magyar Borok', 0x32303038204e7969746e696bc3a96b20437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(266, '2007 Merlot', 'Vörösborok', '', 'Eger, Mátra ', '', '', '6900', 'Bolyki János', 'Magyar Borok', '2012-01-18', '0000-00-00', 0, '2007 Merlot', 'Magyar Borok', 0x32303037204d65726c6f74, '0000-00-00', '0000-00-00', 'hu', 'true'),
(267, '2008 Pinot Noir', 'Vörösborok', '', 'Eger, Mátra ', '', '', '8500', 'Orsolya Pince', 'Magyar Borok', '2012-01-21', '0000-00-00', 0, '2008 Pinot Noir', 'Magyar Borok', 0x323030382050696e6f74204e6f6972, '0000-00-00', '0000-00-00', 'hu', 'true'),
(268, '2007 Syrah', 'Vörösborok', '', 'Eger, Mátra ', '', '2200', '9900', 'Kovács Nimród', 'Magyar Borok', '2012-01-24', '0000-00-00', 0, '2007 Syrah', 'Magyar Borok', 0x32303037205379726168, '0000-00-00', '0000-00-00', 'hu', 'true'),
(269, '2006 Cserje Turán', 'Vörösborok', '', 'Eger, Mátra ', '', '', '14900', 'Demeter Csaba', 'Magyar Borok', '2012-01-27', '0000-00-00', 0, '2006 Cserje Turán', 'Magyar Borok', 0x3230303620437365726a6520547572c3a16e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(270, '2003 X.Y.', 'Vörösborok', '', 'Eger, Mátra ', '', '', '14900', 'Demeter Csaba', 'Magyar Borok', '2012-01-30', '0000-00-00', 0, '2003 X.Y.', 'Magyar Borok', 0x3230303320582e592e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(271, '2006 NJK', 'Vörösborok', '', 'Eger, Mátra ', '', '', '16900', 'Kovács Nimród', 'Magyar Borok', '2012-02-02', '0000-00-00', 0, '2006 NJK', 'Magyar Borok', 0x32303036204e4a4b, '0000-00-00', '0000-00-00', 'hu', 'true'),
(272, '2007 Merengő', 'Vörösborok', '', 'Eger, Mátra ', '', '', '15900', 'St.Andrea', 'Magyar Borok', '2012-02-05', '0000-00-00', 0, '2007 Merengő', 'Magyar Borok', 0x32303037204d6572656e67c591, '0000-00-00', '0000-00-00', 'hu', 'true'),
(273, '2000 Vili Papa Cuvée', 'Vörösborok', '', 'Eger, Mátra ', '', '', '19900', 'Thummerer', 'Magyar Borok', '2012-02-08', '0000-00-00', 0, '2000 Vili Papa Cuvée', 'Magyar Borok', 0x323030302056696c69205061706120437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(274, ' 2007 Cabernet Sauvignon', 'Vörösborok', '', 'Sopron', '', '1300', '5900', 'Weninger', 'Magyar Borok', '2012-02-11', '0000-00-00', 0, ' 2007 Cabernet Sauvignon', 'Magyar Borok', 0xc2a0323030372043616265726e6574205361757669676e6f6e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(275, ' 2008 Jánoshegyi Merlot', 'Vörösborok', '', 'Balaton', '', '1750', '7900', 'Légli Géza', 'Magyar Borok', '2012-02-14', '0000-00-00', 0, ' 2008 Jánoshegyi Merlot', 'Magyar Borok', 0xc2a032303038204ac3a16e6f736865677969204d65726c6f74, '0000-00-00', '0000-00-00', 'hu', 'true'),
(276, ' 2008 Lollinse vörös', 'Vörösborok', '', 'Balaton', '', '', '9900', 'Konyári', 'Magyar Borok', '2012-02-17', '0000-00-00', 0, ' 2008 Lollinse vörös', 'Magyar Borok', 0xc2a032303038204c6f6c6c696e73652076c3b672c3b673, '0000-00-00', '0000-00-00', 'hu', 'true'),
(277, '2007 Kadarka', 'Vörösborok', '', 'Szekszárd ', '', '1750', '7900', 'Dúzsi', 'Magyar Borok', '2012-02-20', '0000-00-00', 0, '2007 Kadarka', 'Magyar Borok', 0x32303037204b616461726b61, '0000-00-00', '0000-00-00', 'hu', 'true'),
(278, '2007 Birtokbor', 'Vörösborok', '', 'Szekszárd ', '', '1950', '8900', 'Heimann', 'Magyar Borok', '2012-02-23', '0000-00-00', 0, '2007 Birtokbor', 'Magyar Borok', 0x3230303720426972746f6b626f72, '0000-00-00', '0000-00-00', 'hu', 'true'),
(279, ' 2006 La Vida Kékfrankos', 'Vörösborok', '', 'Szekszárd ', '', '', '10900', 'Vida', 'Magyar Borok', '2012-02-26', '0000-00-00', 0, ' 2006 La Vida Kékfrankos', 'Magyar Borok', 0xc2a032303036204c612056696461204bc3a96b6672616e6b6f73, '0000-00-00', '0000-00-00', 'hu', 'true'),
(280, ' 2007 "Újratöltve" Merlot', 'Vörösborok', '', 'Szekszárd ', '', '', '11900', 'Vida', 'Magyar Borok', '2012-02-29', '0000-00-00', 0, '" 2007 ""Újratöltve"" Merlot"', 'Magyar Borok', 0x22c2a032303037202222c39a6a726174c3b66c7476652222204d65726c6f74220d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(281, '2007 Cabernet Franc', 'Vörösborok', '', 'Szekszárd ', '', '', '12900', 'Vida', 'Magyar Borok', '2012-03-03', '0000-00-00', 0, '2007 Cabernet Franc', 'Magyar Borok', 0x323030372043616265726e6574204672616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(282, '2007 Cabernet Franc', 'Vörösborok', '', 'Villány ', '', '1450', '6500', 'Jackfall', 'Magyar Borok', '2012-03-06', '0000-00-00', 0, '2007 Cabernet Franc', 'Magyar Borok', 0x323030372043616265726e6574204672616e63, '0000-00-00', '0000-00-00', 'hu', 'true'),
(283, '2007 Montenuovo Cuvée', 'Vörösborok', '', 'Villány ', '', '', '8900', 'Vylyan', 'Magyar Borok', '2012-03-09', '0000-00-00', 0, '2007 Montenuovo Cuvée', 'Magyar Borok', 0x32303037204d6f6e74656e756f766f20437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(284, '2007 Chateau Teleki Cab. Sauvignon', 'Vörösborok', '', 'Villány ', '', '', '8900', 'Csányi', 'Magyar Borok', '2012-03-12', '0000-00-00', 0, '2007 Chateau Teleki Cab. Sauvignon', 'Magyar Borok', 0x3230303720436861746561752054656c656b69204361622e205361757669676e6f6e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(285, '2007 Bauer Cabernet Cuvée', 'Vörösborok', '', 'Villány ', '', '2200', '9900', 'Bányai Gábor', 'Magyar Borok', '2012-03-15', '0000-00-00', 0, '2007 Bauer Cabernet Cuvée', 'Magyar Borok', 0x323030372042617565722043616265726e657420437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(286, '2003 Viktória Cuvée', 'Vörösborok', '', 'Villány ', '', '', '9900', 'Wunderlich', 'Magyar Borok', '2012-03-18', '0000-00-00', 0, '2003 Viktória Cuvée', 'Magyar Borok', 0x323030332056696b74c3b372696120437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(287, '2005 Pinot Noir', 'Vörösborok', '', 'Villány ', '', '2650', '11900', 'Wunderlich', 'Magyar Borok', '2012-03-21', '0000-00-00', 0, '2005 Pinot Noir', 'Magyar Borok', 0x323030352050696e6f74204e6f6972, '0000-00-00', '0000-00-00', 'hu', 'true'),
(288, '2007 Cuvée "11" ', 'Vörösborok', '', 'Villány ', '', '2750', '12500', 'Sauska ', 'Magyar Borok', '2012-03-24', '0000-00-00', 0, '"2007 Cuvée ""11"" "', 'Magyar Borok', 0x223230303720437576c3a96520222231312222c2a0220d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(289, '2007 Cabernet Franc Válogatás', 'Vörösborok', '', 'Villány ', '', '', '14900', 'Tiffán', 'Magyar Borok', '2012-03-27', '0000-00-00', 0, '2007 Cabernet Franc Válogatás', 'Magyar Borok', 0x323030372043616265726e6574204672616e632056c3a16c6f676174c3a173, '0000-00-00', '0000-00-00', 'hu', 'true'),
(290, '2007 Elegance Cuvée', 'Vörösborok', '', 'Villány ', '', '', '14900', 'Csányi', 'Magyar Borok', '2012-03-30', '0000-00-00', 0, '2007 Elegance Cuvée', 'Magyar Borok', 0x3230303720456c6567616e636520437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(291, '2007 Cassiopeia Cabernet Sauvignon', 'Vörösborok', '', 'Villány ', '', '', '14900', 'Wunderlich', 'Magyar Borok', '2012-04-02', '0000-00-00', 0, '2007 Cassiopeia Cabernet Sauvignon', 'Magyar Borok', 0x323030372043617373696f706569612043616265726e6574205361757669676e6f6e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(292, '2006 Mandolás', 'Vörösborok', '', 'Villány ', '', '', '15900', 'Vylyan', 'Magyar Borok', '2012-04-03', '0000-00-00', 0, '2006 Mandolás', 'Magyar Borok', 0x32303036204d616e646f6cc3a173, '0000-00-00', '0000-00-00', 'hu', 'true'),
(293, '2007 Syrah', 'Vörösborok', '', 'Villány ', '', '', '16500', 'Bock', 'Magyar Borok', '2012-04-04', '0000-00-00', 0, '2007 Syrah', 'Magyar Borok', 0x32303037205379726168, '0000-00-00', '0000-00-00', 'hu', 'true'),
(294, '2007 Solus', 'Vörösborok', '', 'Villány ', '', '', '19900', 'Gere', 'Magyar Borok', '2012-04-05', '0000-00-00', 0, '2007 Solus', 'Magyar Borok', 0x3230303720536f6c7573, '0000-00-00', '0000-00-00', 'hu', 'true'),
(295, '2006 Grande Selection', 'Vörösborok', '', 'Villány ', '', '', '28900', 'Tiffán', 'Magyar Borok', '2012-04-06', '0000-00-00', 0, '2006 Grande Selection', 'Magyar Borok', 0x32303036204772616e64652053656c656374696f6e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(296, '2006 Capella Cuvée Barrique', 'Vörösborok', '', 'Villány ', '', '', '29900', 'Bock', 'Magyar Borok', '2012-04-07', '0000-00-00', 0, '2006 Capella Cuvée Barrique', 'Magyar Borok', 0x3230303620436170656c6c6120437576c3a965204261727269717565, '0000-00-00', '0000-00-00', 'hu', 'true'),
(297, ' 2008 Hanna Sárgamuskotály', 'Desszertborok', '', 'Tokaj-Hegyalja', '', '', '12500', 'Németh Attila', 'Magyar Borok', '2012-04-08', '0000-00-00', 0, ' 2008 Hanna Sárgamuskotály', 'Magyar Borok', 0xc2a0323030382048616e6e612053c3a17267616d75736b6f74c3a16c79, '0000-00-00', '0000-00-00', 'hu', 'true'),
(298, '2006 Borbála Cuvée', 'Desszertborok', '', 'Tokaj-Hegyalja', '', '', '5900', 'Breitenbach ', 'Magyar Borok', '2012-04-09', '0000-00-00', 0, '2006 Borbála Cuvée', 'Magyar Borok', 0x3230303620426f7262c3a16c6120437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(299, '2001 Casino Cuvée 0,5l', 'Desszertborok', '', 'Tokaj-Hegyalja', '', '1300', '5900', 'Sauska Tokaj', 'Magyar Borok', '2012-04-10', '0000-00-00', 0, '2001 Casino Cuvée 0,5l', 'Magyar Borok', 0x3230303120436173696e6f20437576c3a96520302c356c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(300, '2007 Vitamin Cuvée MANNA RESERVE 0,5l', 'Desszertborok', '', 'Tokaj-Hegyalja', '', '', '12900', 'Árvay', 'Magyar Borok', '2012-04-11', '0000-00-00', 0, '2007 Vitamin Cuvée MANNA RESERVE 0,5l', 'Magyar Borok', 0x3230303720566974616d696e20437576c3a965204d414e4e41205245534552564520302c356c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(301, '2000 Tokaji Aszú 6 p. 0,5l', 'Desszertborok', '', 'Tokaj-Hegyalja', '', '3950', '17900', 'Árvay', 'Magyar Borok', '2012-04-12', '0000-00-00', 0, '2000 Tokaji Aszú 6 p. 0,5l', 'Magyar Borok', 0x3230303020546f6b616a692041737ac3ba203620702e20302c356c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(302, '2003 Tokaji Aszu Esszencia (0,375l)', 'Desszertborok', '', 'Tokaj-Hegyalja', '', '', '22900', 'Árvay', 'Magyar Borok', '2012-04-13', '0000-00-00', 0, '2003 Tokaji Aszu Esszencia (0,375l)', 'Magyar Borok', 0x3230303320546f6b616a692041737a75204573737a656e6369612028302c3337356c29, '0000-00-00', '0000-00-00', 'hu', 'true'),
(303, ' 2001 Ferrari Perlé Brut', 'Pezsgők', '', 'Trentino-Alto Adige', '', '', '13900', '', 'Limitált palackok', '2012-04-14', '0000-00-00', 0, ' 2001 Ferrari Perlé Brut', 'Limitált palackok', 0xc2a0323030312046657272617269205065726cc3a92042727574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(304, ' 1995 Giulio Ferrari Brut', 'Pezsgők', '', 'Trentino-Alto Adige', '', '', '14900', '', 'Limitált palackok', '2012-04-15', '0000-00-00', 0, ' 1995 Giulio Ferrari Brut', 'Limitált palackok', 0xc2a031393935204769756c696f20466572726172692042727574, '0000-00-00', '0000-00-00', 'hu', 'true'),
(305, ' 2005 Condrieu  ', 'Fehérborok', '', 'Franciaország', '', '', '17900', 'E.Guigal', 'Limitált palackok', '2012-04-16', '0000-00-00', 0, ' 2005 Condrieu  ', 'Limitált palackok', 0xc2a03230303520436f6e6472696575c2a0c2a0, '0000-00-00', '0000-00-00', 'hu', 'true'),
(306, ' 2006 Touraine Sauvignon AOC', 'Fehérborok', '', 'Franciaország', '', '', '6900', 'Guy Saget', 'Limitált palackok', '2012-04-17', '0000-00-00', 0, ' 2006 Touraine Sauvignon AOC', 'Limitált palackok', 0xc2a03230303620546f757261696e65205361757669676e6f6e20414f43, '0000-00-00', '0000-00-00', 'hu', 'true'),
(307, ' 2003 Áldozói Zöldveltelini', 'Fehérborok', '', 'Magyarország', '', '', '4500', 'Tóth Sándor', 'Limitált palackok', '2012-04-18', '0000-00-00', 0, ' 2003 Áldozói Zöldveltelini', 'Limitált palackok', 0xc2a03230303320c3816c646f7ac3b369205ac3b66c6476656c74656c696e69, '0000-00-00', '0000-00-00', 'hu', 'true'),
(308, ' 2009 "IDD+" Cuvée', 'Fehérborok', '', 'Magyarország', '', '', '4900', 'Árvay', 'Limitált palackok', '2012-04-19', '0000-00-00', 0, '" 2009 ""IDD+"" Cuvée"', 'Limitált palackok', 0x22c2a0323030392022224944442b222220437576c3a965220d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(309, ' 2008 Zölveltelini', 'Fehérborok', '', 'Magyarország', '', '', '6500', 'Hernyák', 'Limitált palackok', '2012-04-20', '0000-00-00', 0, ' 2008 Zölveltelini', 'Limitált palackok', 0xc2a032303038205ac3b66c76656c74656c696e69, '0000-00-00', '0000-00-00', 'hu', 'true'),
(310, ' 2008 Somlói Juhfark', 'Fehérborok', '', 'Magyarország', '', '', '6500', 'Laposa', 'Limitált palackok', '2012-04-21', '0000-00-00', 0, ' 2008 Somlói Juhfark', 'Limitált palackok', 0xc2a03230303820536f6d6cc3b369204a75686661726b, '0000-00-00', '0000-00-00', 'hu', 'true'),
(311, ' 2007 Héja Furmint', 'Fehérborok', '', 'Magyarország', '', '', '7900', 'Tokajicum', 'Limitált palackok', '2012-04-22', '0000-00-00', 0, ' 2007 Héja Furmint', 'Limitált palackok', 0xc2a0323030372048c3a96a61204675726d696e74, '0000-00-00', '0000-00-00', 'hu', 'true'),
(312, ' 2007  Kopár Cuvée', 'Vörösborok', '', 'Magyarország', '', '', '5500', 'Ráspi', 'Limitált palackok', '2012-04-23', '0000-00-00', 0, ' 2007  Kopár Cuvée', 'Limitált palackok', 0xc2a032303037c2a0204b6f70c3a17220437576c3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(313, ' 2008 "2008"', 'Vörösborok', '', 'Magyarország', '', '', '5900', 'Orsolya pince', 'Limitált palackok', '2012-04-24', '0000-00-00', 0, '" 2008 ""2008"""', 'Limitált palackok', 0x22c2a032303038202222323030382222220d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(314, ' 2006 Code', 'Vörösborok', '', 'Magyarország', '', '', '10900', 'Kiss Gábor', 'Limitált palackok', '2012-04-25', '0000-00-00', 0, ' 2006 Code', 'Limitált palackok', 0xc2a03230303620436f6465, '0000-00-00', '0000-00-00', 'hu', 'true'),
(315, ' 2004 Merum', 'Vörösborok', '', 'Magyarország', '', '', '12900', 'Kiss Gábor', 'Limitált palackok', '2012-04-26', '0000-00-00', 0, ' 2004 Merum', 'Limitált palackok', 0xc2a032303034204d6572756d, '0000-00-00', '0000-00-00', 'hu', 'true'),
(316, 'Tesseron Lot N° 29', 'Cognac', '', 'Párlatok 4 cl', '', '', '14000', 'Grande Champagne AOC', 'Limitált palackok', '2012-04-27', '0000-00-00', 0, 'Tesseron Lot N° 29', 'Limitált palackok', 0x5465737365726f6e204c6f74204ec2b0203239, '0000-00-00', '0000-00-00', 'hu', 'true'),
(317, 'Tesseron Lot N° 53', 'Cognac', '', 'Párlatok 4 cl', '', '', '7900', 'Grande Champagne AOC', 'Limitált palackok', '2012-04-28', '0000-00-00', 0, 'Tesseron Lot N° 53', 'Limitált palackok', 0x5465737365726f6e204c6f74204ec2b0203533, '0000-00-00', '0000-00-00', 'hu', 'true'),
(318, 'Gourmel', 'Cognac', '', 'Párlatok 4 cl', '', '', '2900', '"Premier Saveurs ""XO"""', 'Limitált palackok', '2012-04-29', '0000-00-00', 0, 'Gourmel', 'Limitált palackok', 0x476f75726d656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(319, 'Gourmel', 'Cognac', '', 'Párlatok 4 cl', '', '', '4900', '"""Age des fleurs"""', 'Limitált palackok', '2012-04-30', '0000-00-00', 0, 'Gourmel', 'Limitált palackok', 0x476f75726d656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(320, 'Gourmel', 'Cognac', '', 'Párlatok 4 cl', '', '', '9500', '"""Age des épices"""', 'Limitált palackok', '2012-05-01', '0000-00-00', 0, 'Gourmel', 'Limitált palackok', 0x476f75726d656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(321, 'Baron de Sigognac 20 ans d''age', 'Armagnac ', '', 'Párlatok 4 cl', '', '', '4900', ' Bas Armagnac AOC', 'Limitált palackok', '2012-05-02', '0000-00-00', 0, 'Baron de Sigognac 20 ans d''age', 'Limitált palackok', 0x4261726f6e206465205369676f676e616320323020616e73206427616765, '0000-00-00', '0000-00-00', 'hu', 'true'),
(322, '1998 Berta', 'Grappa', '', 'Párlatok 4 cl', '', '', '4900', 'Roccanivo', 'Limitált palackok', '2012-05-03', '0000-00-00', 0, '1998 Berta', 'Limitált palackok', 0x31393938204265727461, '0000-00-00', '0000-00-00', 'hu', 'true'),
(323, '2002 Sassicaia', 'Grappa', '', 'Párlatok 4 cl', '', '', '3200', 'Jacopo Poli', 'Limitált palackok', '2012-05-04', '0000-00-00', 0, '2002 Sassicaia', 'Limitált palackok', 0x3230303220536173736963616961, '0000-00-00', '0000-00-00', 'hu', 'true'),
(324, 'Chardonnay', 'Grappa', '', 'Párlatok 4 cl', '', '', '1400', 'Sensea', 'Limitált palackok', '2012-05-05', '0000-00-00', 0, 'Chardonnay', 'Limitált palackok', 0x43686172646f6e6e6179, '0000-00-00', '0000-00-00', 'hu', 'true'),
(325, 'Moscat', 'Grappa', '', 'Párlatok 4 cl', '', '', '1400', 'Sensea', 'Limitált palackok', '2012-05-06', '0000-00-00', 0, 'Moscat', 'Limitált palackok', 0x4d6f73636174, '0000-00-00', '0000-00-00', 'hu', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE IF NOT EXISTS `foods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `type` varchar(250) COLLATE utf8_bin NOT NULL,
  `price` varchar(100) COLLATE utf8_bin NOT NULL,
  `lead` varchar(250) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `image` int(10) NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_desc` text COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `lang` enum('hu','en','de') COLLATE utf8_bin NOT NULL,
  `active` enum('false','true') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=81 ;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `title`, `type`, `price`, `lead`, `body`, `created`, `edited`, `image`, `meta_title`, `meta_keywords`, `meta_desc`, `date_from`, `date_to`, `lang`, `active`) VALUES
(1, 'Pácolt lazac avokádóval és kaviárral', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '2290', '', '', '2012-01-02', '0000-00-00', 0, 'Pácolt lazac avokádóval és kaviárral', 'kaviár', 0x50c3a1636f6c74206c617a61632061766f6bc3a164c3b376616c20c3a973206b617669c3a17272616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(2, 'Paradicsom krémleves kecskesajt habbal és bazsalikom chips-szel', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '1090', '', '', '2012-01-06', '0000-00-00', 0, 'Paradicsom krémleves kecskesajt habbal és bazsalikom chips-szel', 'leves kecskesajt paradicsom', 0x50617261646963736f6d206b72c3a96d6c65766573206b6563736b6573616a742068616262616c20c3a9732062617a73616c696b6f6d2063686970732d737a656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(3, 'Libamájas rizotto birsalmával', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '2390', '', '', '2012-01-10', '0000-00-00', 0, 'Libamájas rizotto birsalmával', 'libamáj rizotto tészta', 0x4c6962616dc3a16a61732072697a6f74746f2062697273616c6dc3a176616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(4, 'Sole filé parajos lepénnyel és szőlő mártással', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '3390', '', '', '2012-01-14', '0000-00-00', 0, 'Sole filé parajos lepénnyel és szőlő mártással', 'paraj lepény mártás', 0x536f6c652066696cc3a920706172616a6f73206c6570c3a96e6e79656c20c3a97320737ac5916cc591206dc3a17274c3a17373616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(5, 'Konfit bárány lapocka rozmaringos blinivel és mustár habbal', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '4500', '', '', '2012-01-18', '0000-00-00', 0, 'Konfit bárány lapocka rozmaringos blinivel és mustár habbal', 'bárány lapocka rozmaring blini', 0x4b6f6e6669742062c3a172c3a16e79206c61706f636b6120726f7a6d6172696e676f7320626c696e6976656c20c3a973206d757374c3a1722068616262616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(6, 'Petit four/creme brulee mousse muffin trüffel/', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '1190', '', '', '2012-01-22', '0000-00-00', 0, 'Petit four/creme brulee mousse muffin trüffel/', 'mousse krém trüffel', 0x506574697420666f75722f6372656d65206272756c6565206d6f75737365206d756666696e207472c3bc6666656c2f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(7, '3 fogásos Menü      12:00-15:00  50%-os kedvezmény', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '6000', '', '', '2012-01-26', '0000-00-00', 0, '3 fogásos Menü      12:00-15:00  50%-os kedvezmény', 'Manna ajánlata', 0x3320666f67c3a1736f73204d656ec3bcc2a0c2a0c2a0c2a0c2a02031323a30302d31353a3030c2a0203530252d6f73206b656476657a6dc3a96e79, '0000-00-00', '0000-00-00', 'hu', 'true'),
(8, '6 fogásos kóstoló Menü', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '10000', '', '', '2012-01-30', '0000-00-00', 0, '6 fogásos kóstoló Menü', 'Manna ajánlata', 0x3620666f67c3a1736f73206bc3b373746f6cc3b3204d656ec3bc, '0000-00-00', '0000-00-00', 'hu', 'true'),
(9, '6 fogásos Menü borokkal(2X15dl)', 'CHÉF AJÁNLATA - THE CHEF''S OFFER ', '12000', '', '', '2012-02-03', '0000-00-00', 0, '6 fogásos Menü borokkal(2X15dl)', 'Manna ajánlata', 0x3620666f67c3a1736f73204d656ec3bc20626f726f6b6b616c2832583135646c29, '0000-00-00', '0000-00-00', 'hu', 'true'),
(10, 'Marhahús esszencia marhahúsos batyuval', 'LEVESEK', '1090', '', '', '2012-02-07', '0000-00-00', 0, 'Marhahús esszencia marhahúsos batyuval', 'marhahús ', 0x4d6172686168c3ba73206573737a656e636961206d6172686168c3ba736f7320626174797576616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(11, 'Szürke marha gulyásleves', 'LEVESEK', '1090', '', '', '2012-02-11', '0000-00-00', 0, 'Szürke marha gulyásleves', 'marhahús gulyásleves leves', 0x537ac3bc726b65206d617268612067756c79c3a1736c65766573, '0000-00-00', '0000-00-00', 'hu', 'true'),
(12, 'Nápolyi Zöldségleves', 'LEVESEK', '990', '', '', '2012-02-15', '0000-00-00', 0, 'Nápolyi Zöldségleves', 'zöldségleves', 0x4ec3a1706f6c7969205ac3b66c6473c3a9676c65766573, '0000-00-00', '0000-00-00', 'hu', 'true'),
(13, 'Tatár bélszínből háromféle módon /tradicionális kaprival és szardellával szójával és gyömbérrel/', 'ELŐÉTELEK ÉS SALÁTÁK', '2990', '', '', '2012-02-19', '0000-00-00', 0, 'Tatár bélszínből háromféle módon /tradicionális kaprival és szardellával szójával és gyömbérrel/', 'előétel saláta', 0x546174c3a1722062c3a96c737ac3ad6e62c5916c2068c3a1726f6d66c3a96c65206dc3b3646f6e202f747261646963696f6ec3a16c6973206b6170726976616c20c3a97320737a617264656c6cc3a176616c20737ac3b36ac3a176616c20c3a973206779c3b66d62c3a97272656c2f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(14, 'Serpenyőben sült libamáj posírozott vaníliás körtével és házi vajas kaláccsal', 'ELŐÉTELEK ÉS SALÁTÁK', '3290', '', '', '2012-02-23', '0000-00-00', 0, 'Serpenyőben sült libamáj posírozott vaníliás körtével és házi vajas kaláccsal', 'előétel saláta', 0x53657270656e79c59162656e2073c3bc6c74206c6962616dc3a16a20706f73c3ad726f7a6f74742076616ec3ad6c69c3a173206bc3b67274c3a976656c20c3a9732068c3a17a692076616a6173206b616cc3a1636373616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(15, 'Vörös tonhal cajun fűszerkéregben angolosra sütve wasabis rucola salátán', 'ELŐÉTELEK ÉS SALÁTÁK', '2890', '', '', '2012-02-27', '0000-00-00', 0, 'Vörös tonhal cajun fűszerkéregben angolosra sütve wasabis rucola salátán', 'előétel saláta', 0x56c3b672c3b67320746f6e68616c2063616a756e2066c5b1737a65726bc3a972656762656e20616e676f6c6f7372612073c3bc7476652077617361626973207275636f6c612073616cc3a174c3a16e, '0000-00-00', '0000-00-00', 'hu', 'true'),
(16, 'Bélszín Carpaccio parmezán forgáccsal dijon mustáros rucola salátával', 'ELŐÉTELEK ÉS SALÁTÁK', '2890', '', '', '2012-03-02', '0000-00-00', 0, 'Bélszín Carpaccio parmezán forgáccsal dijon mustáros rucola salátával', 'előétel saláta', 0x42c3a96c737ac3ad6e2043617270616363696f207061726d657ac3a16e20666f7267c3a1636373616c2064696a6f6e206d757374c3a1726f73207275636f6c612073616cc3a174c3a176616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(17, 'Manna Tapas tál/mozzarella serrano sonka olivabogyó szárított paradicsom padlizsán krém/', 'ELŐÉTELEK ÉS SALÁTÁK', '2990', '', '', '2012-03-06', '0000-00-00', 0, 'Manna Tapas tál/mozzarella serrano sonka olivabogyó szárított paradicsom padlizsán krém/', 'előétel saláta', 0x4d616e6e612054617061732074c3a16c2f6d6f7a7a6172656c6c612073657272616e6f20736f6e6b61206f6c697661626f6779c3b320737ac3a172c3ad746f74742070617261646963736f6d207061646c697a73c3a16e206b72c3a96d2f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(18, 'Rucola saláta kéksajttal körtével és dióval balzsamecetes vienegrettel', 'ELŐÉTELEK ÉS SALÁTÁK', '2990', '', '', '2012-03-10', '0000-00-00', 0, 'Rucola saláta kéksajttal körtével és dióval balzsamecetes vienegrettel', 'előétel saláta', 0x5275636f6c612073616cc3a17461206bc3a96b73616a7474616c206bc3b67274c3a976656c20c3a973206469c3b376616c2062616c7a73616d656365746573207669656e656772657474656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(19, 'Magyaros hideg ízelítő /napi választékból/', 'ELŐÉTELEK ÉS SALÁTÁK', '2990', '', '', '2012-03-14', '0000-00-00', 0, 'Magyaros hideg ízelítő /napi választékból/', 'előétel saláta', 0x4d61677961726f7320686964656720c3ad7a656cc3ad74c591202f6e6170692076c3a16c61737a74c3a96b62c3b36c2f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(20, 'Mogyorós pomelo saláta koriander pestóban pácolt garnélával/', 'ELŐÉTELEK ÉS SALÁTÁK', '2990', '', '', '2012-03-18', '0000-00-00', 0, 'Mogyorós pomelo saláta koriander pestóban pácolt garnélával/', 'előétel saláta', 0x4d6f67796f72c3b37320706f6d656c6f2073616cc3a17461206b6f7269616e6465722070657374c3b362616e2070c3a1636f6c74206761726ec3a96cc3a176616c2f, '0000-00-00', '0000-00-00', 'hu', 'true'),
(21, 'Felezett zöldkagyló parmezánnal gratinírozva', 'ELŐÉTELEK ÉS SALÁTÁK', '2990', '', '', '2012-03-22', '0000-00-00', 0, 'Felezett zöldkagyló parmezánnal gratinírozva', 'előétel saláta', 0x46656c657a657474207ac3b66c646b6167796cc3b3207061726d657ac3a16e6e616c2067726174696ec3ad726f7a7661, '0000-00-00', '0000-00-00', 'hu', 'true'),
(22, 'Házi burgonya gnocchi paradicsomos szószban füstölt scamorza sajttal', 'FRISS HÁZI TÉSZTÁK és RIZOTTÓK', '2690', '', '', '2012-03-26', '0000-00-00', 0, 'Házi burgonya gnocchi paradicsomos szószban füstölt scamorza sajttal', 'tészta rizottó ', 0x48c3a17a6920627572676f6e796120676e6f636368692070617261646963736f6d6f7320737ac3b3737a62616e2066c3bc7374c3b66c74207363616d6f727a612073616a7474616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(23, 'Fokhagymás scampi fekete spagettivel', 'FRISS HÁZI TÉSZTÁK és RIZOTTÓK', '3990', '', '', '2012-03-30', '0000-00-00', 0, 'Fokhagymás scampi fekete spagettivel', 'tészta rizottó ', 0x466f6b686167796dc3a173207363616d70692066656b65746520737061676574746976656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(24, 'Pirított thai tészta csirkével és rákkal', 'FRISS HÁZI TÉSZTÁK és RIZOTTÓK', '2990', '', '', '2012-04-03', '0000-00-00', 0, 'Pirított thai tészta csirkével és rákkal', 'tészta rizottó ', 0x506972c3ad746f747420746861692074c3a9737a746120637369726bc3a976656c20c3a9732072c3a16b6b616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(25, 'Erdei gombás rizotto kacsamell csíkokkal szarvasgomba olajjal csepegtetve', 'FRISS HÁZI TÉSZTÁK és RIZOTTÓK', '3190', '', '', '2012-04-07', '0000-00-00', 0, 'Erdei gombás rizotto kacsamell csíkokkal szarvasgomba olajjal csepegtetve', 'tészta rizottó ', 0x457264656920676f6d62c3a1732072697a6f74746f206b616373616d656c6c206373c3ad6b6f6b6b616c20737a6172766173676f6d6261206f6c616a6a616c206373657065677465747665, '0000-00-00', '0000-00-00', 'hu', 'true'),
(26, 'Fetuccini parajjal kéksajttal és dióval', 'FRISS HÁZI TÉSZTÁK és RIZOTTÓK', '2390', '', '', '2012-04-11', '0000-00-00', 0, 'Fetuccini parajjal kéksajttal és dióval', 'tészta rizottó ', 0x466574756363696e6920706172616a6a616c206bc3a96b73616a7474616c20c3a973206469c3b376616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(27, 'Jércemell filé vargánya gombás sült paprikával és mandulás burgonya krokettel', 'FŐÉTELEK', '2890', '', '', '2012-04-15', '0000-00-00', 0, 'Jércemell filé vargánya gombás sült paprikával és mandulás burgonya krokettel', '', 0x4ac3a97263656d656c6c2066696cc3a92076617267c3a16e796120676f6d62c3a1732073c3bc6c742070617072696bc3a176616c20c3a973206d616e64756cc3a17320627572676f6e7961206b726f6b657474656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(28, 'Pecsenye kacsa combja konfitálva káposztás cvekedlivel melle burgonyával és füge szósszal', 'FŐÉTELEK', '3680', '', '', '2012-04-19', '0000-00-00', 0, 'Pecsenye kacsa combja konfitálva káposztás cvekedlivel melle burgonyával és füge szósszal', '', 0x50656373656e7965206b6163736120636f6d626a61206b6f6e666974c3a16c7661206bc3a1706f737a74c3a173206376656b65646c6976656c206d656c6c6520627572676f6e79c3a176616c20c3a9732066c3bc676520737ac3b373737a616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(29, 'Érlelt marha bélszín fűszeres burgonyával libamáj coulis-szal és vajas karottával', 'FŐÉTELEK', '5390', '', '', '2012-04-23', '0000-00-00', 0, 'Érlelt marha bélszín fűszeres burgonyával libamáj coulis-szal és vajas karottával', '', 0xc389726c656c74206d617268612062c3a96c737ac3ad6e2066c5b1737a6572657320627572676f6e79c3a176616c206c6962616dc3a16a20636f756c69732d737a616c20c3a9732076616a6173206b61726f7474c3a176616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(30, 'Érlelt Argentin Angus bélszín fűszeres burgonyával libamáj coulis-szal és vajas karottával', 'FŐÉTELEK', '7350', '', '', '2012-04-27', '0000-00-00', 0, 'Érlelt Argentin Angus bélszín fűszeres burgonyával libamáj coulis-szal és vajas karottával', '', 0xc389726c656c7420417267656e74696e20416e6775732062c3a96c737ac3ad6e2066c5b1737a6572657320627572676f6e79c3a176616c206c6962616dc3a16a20636f756c69732d737a616c20c3a9732076616a6173206b61726f7474c3a176616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(31, 'Borjúpaprikás tojásos galuskával és uborkasalátával', 'FŐÉTELEK', '3290', '', '', '2012-05-01', '0000-00-00', 0, 'Borjúpaprikás tojásos galuskával és uborkasalátával', '', 0x426f726ac3ba70617072696bc3a17320746f6ac3a1736f732067616c75736bc3a176616c20c3a9732075626f726b6173616cc3a174c3a176616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(32, 'Vörös tonhal wasabis zöldborsó kéregben vajban párolt zöldséggel', 'FŐÉTELEK', '4190', '', '', '2012-05-05', '0000-00-00', 0, 'Vörös tonhal wasabis zöldborsó kéregben vajban párolt zöldséggel', '', 0x56c3b672c3b67320746f6e68616c2077617361626973207ac3b66c64626f7273c3b3206bc3a972656762656e2076616a62616e2070c3a1726f6c74207ac3b66c6473c3a96767656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(33, 'Teriyaki lazac mandarínos rucola salátán és jázmin rizzsel', 'FŐÉTELEK', '3690', '', '', '2012-05-09', '0000-00-00', 0, 'Teriyaki lazac mandarínos rucola salátán és jázmin rizzsel', '', 0x5465726979616b69206c617a6163206d616e646172c3ad6e6f73207275636f6c612073616cc3a174c3a16e20c3a973206ac3a17a6d696e2072697a7a73656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(34, 'Új-Zélandi bárányborda blinivel és rozmaringos jus-vel', 'FŐÉTELEK', '5590', '', '', '2012-05-13', '0000-00-00', 0, 'Új-Zélandi bárányborda blinivel és rozmaringos jus-vel', '', 0xc39a6a2d5ac3a96c616e64692062c3a172c3a16e79626f72646120626c696e6976656c20c3a97320726f7a6d6172696e676f73206a75732d76656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(35, 'Zöldséges polenta torta pirított céklával', 'FŐÉTELEK', '2190', '', '', '2012-05-17', '0000-00-00', 0, 'Zöldséges polenta torta pirított céklával', '', 0x5ac3b66c6473c3a967657320706f6c656e746120746f72746120706972c3ad746f74742063c3a96b6cc3a176616c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(36, 'Csokoládé felfújt házi vanília fagylalttal és amaréna meggyel', 'DESSZERTEK', '1190', '', '', '2012-05-21', '0000-00-00', 0, 'Csokoládé felfújt házi vanília fagylalttal és amaréna meggyel', '', 0x43736f6b6f6cc3a164c3a92066656c66c3ba6a742068c3a17a692076616ec3ad6c696120666167796c616c7474616c20c3a97320616d6172c3a96e61206d65676779656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(37, 'Bourbon vanília creme brulée', 'DESSZERTEK', '990', '', '', '2012-05-25', '0000-00-00', 0, 'Bourbon vanília creme brulée', '', 0x426f7572626f6e2076616ec3ad6c6961206372656d65206272756cc3a965, '0000-00-00', '0000-00-00', 'hu', 'true'),
(38, 'Mascarpone torta málna öntettel', 'DESSZERTEK', '990', '', '', '2012-05-29', '2012-05-19', 0, 'Mascarpone torta málna öntettel', '', 0x4d6173636172706f6e6520746f727461206dc3a16c6e6120c3b66e74657474656c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(39, 'Sajtválogatás Francia Olasz és Magyar sajtokból', 'DESSZERTEK', '2990', '', '', '2012-06-02', '0000-00-00', 0, 'Sajtválogatás Francia Olasz és Magyar sajtokból', '', 0x53616a7476c3a16c6f676174c3a173204672616e636961204f6c61737a20c3a973204d61677961722073616a746f6b62c3b36c, '0000-00-00', '0000-00-00', 'hu', 'true'),
(40, 'Marinated salmon with avocado and caviar', 'THE CHEF''S OFFER ', '9,2', '', '', '2012-01-02', '0000-00-00', 0, 'Marinated salmon with avocado and caviar', 'salomon caviar avocado', 0x4d6172696e617465642073616c6d6f6e20776974682061766f6361646f20616e6420636176696172, '0000-00-00', '0000-00-00', 'en', 'true'),
(41, 'Tomato cream soup with goat cheese foam and basil chips', 'THE CHEF''S OFFER ', '4,4', '', '', '2012-01-06', '0000-00-00', 0, 'Tomato cream soup with goat cheese foam and basil chips', 'tomato soup goat cheese chips', 0x546f6d61746f20637265616d20736f7570207769746820676f61742063686565736520666f616d20616e6420626173696c206368697073, '0000-00-00', '0000-00-00', 'en', 'true'),
(42, 'Foie gras risotto with quince', 'THE CHEF''S OFFER ', '9,6', '', '', '2012-01-10', '0000-00-00', 0, 'Foie gras risotto with quince', 'risotto quince', 0x466f69652067726173207269736f74746f2077697468207175696e6365, '0000-00-00', '0000-00-00', 'en', 'true'),
(43, 'Sole fillet with spinach pancake and grape sauce', 'THE CHEF''S OFFER ', '13,6', '', '', '2012-01-14', '0000-00-00', 0, 'Sole fillet with spinach pancake and grape sauce', 'sole spinach pancake grape sauce', 0x536f6c652066696c6c65742077697468207370696e6163682070616e63616b6520616e64206772617065207361756365, '0000-00-00', '0000-00-00', 'en', 'true'),
(44, 'Confit lamb scapula with rosmary blini and mustard foam', 'THE CHEF''S OFFER ', '18', '', '', '2012-01-18', '0000-00-00', 0, 'Confit lamb scapula with rosmary blini and mustard foam', 'lamb blini mustard', 0x436f6e666974206c616d622073636170756c61207769746820726f736d61727920626c696e6920616e64206d75737461726420666f616d, '0000-00-00', '0000-00-00', 'en', 'true'),
(45, 'Petit four/creme brulee,mousse,muffin,trüffel/', 'THE CHEF''S OFFER ', '4,8', '', '', '2012-01-22', '0000-00-00', 0, 'Petit four/creme brulee,mousse,muffin,trüffel/', 'creme brulee mousse muffin truffel', 0x506574697420666f75722f6372656d65206272756c65652c6d6f757373652c6d756666696e2c7472c3bc6666656c2f, '0000-00-00', '0000-00-00', 'en', 'true'),
(46, '3 course Menu       12:00-15:00  50% discount', 'THE CHEF''S OFFER ', '24', '', '', '2012-01-26', '0000-00-00', 0, '3 course Menu       12:00-15:00  50% discount', 'manna menu', 0x3320636f75727365204d656e75c2a0c2a0c2a0c2a0c2a0c2a02031323a30302d31353a3030c2a02035302520646973636f756e74, '0000-00-00', '0000-00-00', 'en', 'true'),
(47, '6 course tasting Menu', 'THE CHEF''S OFFER ', '40', '', '', '2012-01-30', '0000-00-00', 0, '6 course tasting Menu', 'manna menu', 0x3620636f757273652074617374696e67204d656e75, '0000-00-00', '0000-00-00', 'en', 'true'),
(48, '6 course Menu with wines(2X1,5dl)', 'THE CHEF''S OFFER ', '48', '', '', '2012-02-03', '0000-00-00', 0, '6 course Menu with wines(2X1,5dl)', 'manna menu', 0x3620636f75727365204d656e7520776974682077696e6573283258312c35646c29, '0000-00-00', '0000-00-00', 'en', 'true'),
(49, 'Beef essence with beef stuffed ravioli', 'SOUPS', '4,4', '', '', '2012-02-07', '0000-00-00', 0, 'Beef essence with beef stuffed ravioli', 'SOUPS', 0x4265656620657373656e636520776974682062656566207374756666656420726176696f6c69, '0000-00-00', '0000-00-00', 'en', 'true'),
(50, 'Hungarian grey beef Goulash soup', 'SOUPS', '4,4', '', '', '2012-02-11', '0000-00-00', 0, 'Hungarian grey beef Goulash soup', 'SOUPS', 0x48756e67617269616e2067726579206265656620476f756c61736820736f7570, '0000-00-00', '0000-00-00', 'en', 'true'),
(51, 'Naples vegetable soup', 'SOUPS', '4', '', '', '2012-02-15', '0000-00-00', 0, 'Naples vegetable soup', 'SOUPS', 0x4e61706c657320766567657461626c6520736f7570, '0000-00-00', '0000-00-00', 'en', 'true'),
(52, 'Beef tartar three different style/traditional, capri and anchovy, soya and ginger/', 'APPETIZERS and SALADS', '12', '', '', '2012-02-19', '0000-00-00', 0, 'Beef tartar three different style/traditional, capri and anchovy, soya and ginger/', 'APPETIZERS and SALADS', 0x426565662074617274617220746872656520646966666572656e74207374796c652f747261646974696f6e616c2c20636170726920616e6420616e63686f76792c20736f796120616e642067696e6765722f, '0000-00-00', '0000-00-00', 'en', 'true'),
(53, 'Pan fried Foie gras with vanillin pear compote and home made scone', 'APPETIZERS and SALADS', '13,2', '', '', '2012-02-23', '0000-00-00', 0, 'Pan fried Foie gras with vanillin pear compote and home made scone', 'APPETIZERS and SALADS', 0x50616e20667269656420466f6965206772617320776974682076616e696c6c696e207065617220636f6d706f746520616e6420686f6d65206d6164652073636f6e65, '0000-00-00', '0000-00-00', 'en', 'true'),
(54, 'Red tuna in Cajun spicy crusted baked on raw with wasabi rocket salad', 'APPETIZERS and SALADS', '11,6', '', '', '2012-02-27', '0000-00-00', 0, 'Red tuna in Cajun spicy crusted baked on raw with wasabi rocket salad', 'APPETIZERS and SALADS', 0x5265642074756e6120696e2043616a756e20737069637920637275737465642062616b6564206f6e2072617720776974682077617361626920726f636b65742073616c6164, '0000-00-00', '0000-00-00', 'en', 'true'),
(55, 'Beef Carpaccio with parmesan shaving, rocket and Dijon mustard vinaigrette', 'APPETIZERS and SALADS', '11,6', '', '', '2012-03-02', '0000-00-00', 0, 'Beef Carpaccio with parmesan shaving, rocket and Dijon mustard vinaigrette', 'APPETIZERS and SALADS', 0x426565662043617270616363696f2077697468207061726d6573616e2073686176696e672c20726f636b657420616e642044696a6f6e206d7573746172642076696e6169677265747465, '0000-00-00', '0000-00-00', 'en', 'true'),
(56, 'Tapas plate/mozzarella, Serrano ham, olive, sun dried tomato, eggplant cream/', 'APPETIZERS and SALADS', '12', '', '', '2012-03-06', '0000-00-00', 0, 'Tapas plate/mozzarella, Serrano ham, olive, sun dried tomato, eggplant cream/', 'APPETIZERS and SALADS', 0x546170617320706c6174652f6d6f7a7a6172656c6c612c2053657272616e6f2068616d2c206f6c6976652c2073756e20647269656420746f6d61746f2c20656767706c616e7420637265616d2f, '0000-00-00', '0000-00-00', 'en', 'true'),
(57, 'Rocket salad with blue cheese, pear, walnut and balsamic vinegar vinaigrette', 'APPETIZERS and SALADS', '12', '', '', '2012-03-10', '0000-00-00', 0, 'Rocket salad with blue cheese, pear, walnut and balsamic vinegar vinaigrette', 'APPETIZERS and SALADS', 0x526f636b65742073616c6164207769746820626c7565206368656573652c20706561722c2077616c6e757420616e642062616c73616d69632076696e656761722076696e6169677265747465, '0000-00-00', '0000-00-00', 'en', 'true'),
(58, 'Hungarian cold tapas selection /daily assortment/', 'APPETIZERS and SALADS', '12', '', '', '2012-03-14', '0000-00-00', 0, 'Hungarian cold tapas selection /daily assortment/', 'APPETIZERS and SALADS', 0x48756e67617269616e20636f6c642074617061732073656c656374696f6e202f6461696c79206173736f72746d656e742f, '0000-00-00', '0000-00-00', 'en', 'true'),
(59, 'Pomelo salad with nuts and chermula marinated shrimps', 'APPETIZERS and SALADS', '12', '', '', '2012-03-18', '0000-00-00', 0, 'Pomelo salad with nuts and chermula marinated shrimps', 'APPETIZERS and SALADS', 0x506f6d656c6f2073616c61642077697468206e75747320616e6420636865726d756c61206d6172696e6174656420736872696d7073, '0000-00-00', '0000-00-00', 'en', 'true'),
(60, 'Green mussel with parmesan gratin', 'APPETIZERS and SALADS', '12', '', '', '2012-03-22', '0000-00-00', 0, 'Green mussel with parmesan gratin', 'APPETIZERS and SALADS', 0x477265656e206d757373656c2077697468207061726d6573616e2067726174696e, '0000-00-00', '0000-00-00', 'en', 'true'),
(61, 'Homemade gnocchi with tomato sauce and smoked scramorza   ', 'HOMEMADE PASTAS and RISOTTO', '10,8', '', '', '2012-03-26', '0000-00-00', 0, 'Homemade gnocchi with tomato sauce and smoked scramorza   ', 'HOMEMADE PASTAS and RISOTTO', 0x486f6d656d61646520676e6f63636869207769746820746f6d61746f20736175636520616e6420736d6f6b656420736372616d6f727a61c2a0c2a0c2a0, '0000-00-00', '0000-00-00', 'en', 'true'),
(62, 'Garlic shrimps with black sepia spaghetti', 'HOMEMADE PASTAS and RISOTTO', '16', '', '', '2012-03-30', '0000-00-00', 0, 'Garlic shrimps with black sepia spaghetti', 'HOMEMADE PASTAS and RISOTTO', 0x4761726c696320736872696d7073207769746820626c61636b20736570696120737061676865747469, '0000-00-00', '0000-00-00', 'en', 'true'),
(63, 'Thai, wok fried noodles with chicken and shrimp', 'HOMEMADE PASTAS and RISOTTO', '12', '', '', '2012-04-03', '0000-00-00', 0, 'Thai, wok fried noodles with chicken and shrimp', 'HOMEMADE PASTAS and RISOTTO', 0x546861692c20776f6b206672696564206e6f6f646c6573207769746820636869636b656e20616e6420736872696d70, '0000-00-00', '0000-00-00', 'en', 'true'),
(64, 'Forest mushroom risotto with duck breast strip and truffle oil drops', 'HOMEMADE PASTAS and RISOTTO', '12,8', '', '', '2012-04-07', '0000-00-00', 0, 'Forest mushroom risotto with duck breast strip and truffle oil drops', 'HOMEMADE PASTAS and RISOTTO', 0x466f72657374206d757368726f6f6d207269736f74746f2077697468206475636b2062726561737420737472697020616e642074727566666c65206f696c2064726f7073, '0000-00-00', '0000-00-00', 'en', 'true'),
(65, 'Forest mushroom risotto with duck breast strip and truffle oil drops', 'HOMEMADE PASTAS and RISOTTO', '9,6', '', '', '2012-04-11', '0000-00-00', 0, 'Forest mushroom risotto with duck breast strip and truffle oil drops', 'HOMEMADE PASTAS and RISOTTO', 0x466f72657374206d757368726f6f6d207269736f74746f2077697468206475636b2062726561737420737472697020616e642074727566666c65206f696c2064726f7073, '0000-00-00', '0000-00-00', 'en', 'true'),
(66, 'Chicken breast with porcini, fried paprika and almond croquette   ', 'MAIN DISHES', '11,6', '', '', '2012-04-15', '0000-00-00', 0, 'Chicken breast with porcini, fried paprika and almond croquette   ', 'MAIN DISHES', 0x436869636b656e20627265617374207769746820706f7263696e692c2066726965642070617072696b6120616e6420616c6d6f6e642063726f717565747465c2a0c2a0c2a0, '0000-00-00', '0000-00-00', 'en', 'true'),
(67, 'Confit leg of duck with cabbage noodle and duck breast with potato and fig sauce', 'MAIN DISHES', '14,7', '', '', '2012-04-19', '0000-00-00', 0, 'Confit leg of duck with cabbage noodle and duck breast with potato and fig sauce', 'MAIN DISHES', 0x436f6e666974206c6567206f66206475636b20776974682063616262616765206e6f6f646c6520616e64206475636b20627265617374207769746820706f7461746f20616e6420666967207361756365, '0000-00-00', '0000-00-00', 'en', 'true'),
(68, 'Aged beef tenderloin with spicy potato, foie gras coulis and butter carrot', 'MAIN DISHES', '21,6', '', '', '2012-04-23', '0000-00-00', 0, 'Aged beef tenderloin with spicy potato, foie gras coulis and butter carrot', 'MAIN DISHES', 0x4167656420626565662074656e6465726c6f696e207769746820737069637920706f7461746f2c20666f6965206772617320636f756c697320616e642062757474657220636172726f74, '0000-00-00', '0000-00-00', 'en', 'true'),
(69, 'Aged Argentin Angus tenderloin with spicy potato, foie gras coulis and butter carrot', 'MAIN DISHES', '29,4', '', '', '2012-04-27', '0000-00-00', 0, 'Aged Argentin Angus tenderloin with spicy potato, foie gras coulis and butter carrot', 'MAIN DISHES', 0x4167656420417267656e74696e20416e6775732074656e6465726c6f696e207769746820737069637920706f7461746f2c20666f6965206772617320636f756c697320616e642062757474657220636172726f74, '0000-00-00', '0000-00-00', 'en', 'true'),
(70, 'Veal paprika with homemade egg dumplings and cucumber salad', 'MAIN DISHES', '13,2', '', '', '2012-05-01', '0000-00-00', 0, 'Veal paprika with homemade egg dumplings and cucumber salad', 'MAIN DISHES', 0x5665616c2070617072696b61207769746820686f6d656d616465206567672064756d706c696e677320616e6420637563756d6265722073616c6164, '0000-00-00', '0000-00-00', 'en', 'true'),
(71, 'Red tuna grilled in wasabi pea crust with butter steamed vegetables', 'MAIN DISHES', '16,8', '', '', '2012-05-05', '0000-00-00', 0, 'Red tuna grilled in wasabi pea crust with butter steamed vegetables', 'MAIN DISHES', 0x5265642074756e61206772696c6c656420696e207761736162692070656120637275737420776974682062757474657220737465616d656420766567657461626c6573, '0000-00-00', '0000-00-00', 'en', 'true'),
(72, 'Teriyaki salmon with mandarin rocket salad jasmine rice', 'MAIN DISHES', '14,8', '', '', '2012-05-09', '0000-00-00', 0, 'Teriyaki salmon with mandarin rocket salad jasmine rice', 'MAIN DISHES', 0x5465726979616b692073616c6d6f6e2077697468206d616e646172696e20726f636b65742073616c6164206a61736d696e652072696365, '0000-00-00', '0000-00-00', 'en', 'true'),
(73, 'New Zealand rack of lamb with potato blini and rosemary jus', 'MAIN DISHES', '24', '', '', '2012-05-13', '0000-00-00', 0, 'New Zealand rack of lamb with potato blini and rosemary jus', 'MAIN DISHES', 0x4e6577205a65616c616e64207261636b206f66206c616d62207769746820706f7461746f20626c696e6920616e6420726f73656d617279206a7573, '0000-00-00', '0000-00-00', 'en', 'true'),
(74, 'Polenta cake with vegetables and toasted beetroot', 'MAIN DISHES', '8,8', '', '', '2012-05-17', '0000-00-00', 0, 'Polenta cake with vegetables and toasted beetroot', 'MAIN DISHES', 0x506f6c656e74612063616b65207769746820766567657461626c657320616e6420746f61737465642062656574726f6f74, '0000-00-00', '0000-00-00', 'en', 'true'),
(75, 'Chocolate soufflé with home made vanilla ice cream and amarena sour cherry', 'DESSERTS', '4,8', '', '', '2012-05-21', '0000-00-00', 0, 'Chocolate soufflé with home made vanilla ice cream and amarena sour cherry', 'DESSERTS', 0x43686f636f6c61746520736f7566666cc3a9207769746820686f6d65206d6164652076616e696c6c612069636520637265616d20616e6420616d6172656e6120736f757220636865727279, '0000-00-00', '0000-00-00', 'en', 'true'),
(76, 'Bourbon vanilla creme brulée', 'DESSERTS', '4', '', '', '2012-05-25', '0000-00-00', 0, 'Bourbon vanilla creme brulée', 'DESSERTS', 0x426f7572626f6e2076616e696c6c61206372656d65206272756cc3a965, '0000-00-00', '0000-00-00', 'en', 'true'),
(77, 'Mascarpone cake with raspberry sauce ', 'DESSERTS', '4', '', '', '2012-05-29', '2012-05-19', 0, 'Mascarpone cake with raspberry sauce ', 'DESSERTS', 0x4d6173636172706f6e652063616b6520776974682072617370626572727920736175636520, '0000-00-00', '0000-00-00', 'en', 'true'),
(78, 'Cheese selection from French, Italin and Hungarian cheeses', 'DESSERTS', '12', '', '', '2012-06-02', '0000-00-00', 0, 'Cheese selection from French, Italin and Hungarian cheeses', 'DESSERTS', 0x4368656573652073656c656374696f6e2066726f6d204672656e63682c204974616c696e20616e642048756e67617269616e2063686565736573, '0000-00-00', '0000-00-00', 'en', 'true'),
(79, 'blabla', 'a chef ajánlata', '$25', 'sdfsdf', 0x3c703e7364667364667364663c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c64697620636c6173733d22696d61676557726170706572223e3c696d67207372633d222e2e2f75706c6f61642f31352f37373866353338626461373239343362383732353030323961656431333334362e6a7065672220616c743d2222202f3e3c2f6469763e0d0a3c703e266e6273703b3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e7364667364663c2f703e, '2012-05-19', '0000-00-00', 15, '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(80, 'index_action', '', '', '', '', '2020-05-13', '2020-05-14', 0, '', '', '', '0000-00-00', '0000-00-00', '', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `lead` varchar(250) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `image` int(10) NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_desc` text COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `lang` enum('hu','en','de') COLLATE utf8_bin NOT NULL,
  `active` enum('false','true') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=19 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `lead`, `body`, `created`, `edited`, `image`, `meta_title`, `meta_keywords`, `meta_desc`, `date_from`, `date_to`, `lang`, `active`) VALUES
(1, 'index_action', '', '', '2020-05-21', '2020-05-13', 0, '', '', '', '0000-00-00', '0000-00-00', '', 'false'),
(15, 'Lorem ipsum', 'Lorem ipsum Lorem ipsum', 0x092020094120737a616276c3a16e796f73206c697073756d20737ac3b67665676e656b20736f6b2076c3a16c746f7a617461206cc3a974657a696b2c206ec3a968c3a16e79756b206373616b206e6167796f6e206b6576c3a97373c3a9206861736f6e6cc3ad7420617a206572656465746968657a2e204120737ac3b6766567206ec3a968c3a16e792076c3a16c746f7a617461206f6c79616e20746f76c3a162626920626574c5b16b65742074617274616c6d617a2c206d656c79656b207269746bc3a16b2076616779206869c3a16e797ac3b3616b2061206c6174696e62616e20e280932070c3a96c64c3a1756c2061206b2c207720c3a973207a20e280932c2076616c616d696e74206f6c79616e206bc3a97074656c656e20737a6176616b61742c206d696e74207a7a72696c2c2074616b696d61746120c3a9732067756265726772656e2e20457a656b657420617ac3a9727420616468617474c3a16b20617a2065726564657469206964c3a97a657468657a2c20686f6779206120626574c5b16b206d656766656c656cc59120656c6f737a74c3a173c3a17420656cc3a9726ac3a96b2e200d0a0d0a4120737a616276c3a16e796f73206c697073756d20737ac3b67665676e656b20736f6b2076c3a16c746f7a617461206cc3a974657a696b2c206ec3a968c3a16e79756b206373616b206e6167796f6e206b6576c3a97373c3a9206861736f6e6cc3ad7420617a206572656465746968657a2e204120737ac3b6766567206ec3a968c3a16e792076c3a16c746f7a617461206f6c79616e20746f76c3a162626920626574c5b16b65742074617274616c6d617a2c206d656c79656b207269746bc3a16b2076616779206869c3a16e797ac3b3616b2061206c6174696e62616e20e280932070c3a96c64c3a1756c2061206b2c207720c3a973207a20e280932c2076616c616d696e74206f6c79616e206bc3a97074656c656e20737a6176616b61742c206d696e74207a7a72696c2c2074616b696d61746120c3a9732067756265726772656e2e20457a656b657420617ac3a9727420616468617474c3a16b20617a2065726564657469206964c3a97a657468657a2c20686f6779206120626574c5b16b206d656766656c656cc59120656c6f737a74c3a173c3a17420656cc3a9726ac3a96b2e, '2012-05-17', '0000-00-00', 0, 'szabványos', 'szabványos adhatták idézethez idézethez', 0x09202009204120737ac3b6766567206ec3a968c3a16e792076c3a16c746f7a617461206f6c79616e20746f76c3a162626920626574c5b16b65742074617274616c6d617a2c206d656c79656b207269746bc3a16b2076616779206869c3a16e797ac3b3616b2061206c6174696e62616e, '2012-03-14', '2015-05-30', 'hu', 'true'),
(16, 'main frontend', 'frontend', 0x0920200966726f6e74656e64, '2012-05-17', '0000-00-00', 0, '', '', 0x09202009, '1997-05-10', '2023-05-14', 'hu', 'true'),
(17, 'slider - front side', 'slider - front side', '', '2012-05-18', '0000-00-00', 0, '', '', '', '0000-00-00', '0000-00-00', 'hu', 'true'),
(18, 'cikkek', 'cikkekhez képek', '', '2012-05-20', '0000-00-00', 0, '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `gallery` int(10) NOT NULL,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `lead` varchar(250) COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_desc` text COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `lang` enum('hu','en','de') COLLATE utf8_bin NOT NULL,
  `active` enum('false','true') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=26 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `title`, `gallery`, `name`, `lead`, `created`, `edited`, `meta_title`, `meta_keywords`, `meta_desc`, `date_from`, `date_to`, `lang`, `active`) VALUES
(3, 'első kép', 16, '634f71108076a0104ef5a5862b27efff.jpg', 'ez bizony az első kép', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(4, 'masodik', 16, '245b45b6f9b80c46972fa18f1882a0f4.jpg', 'bizony mar a masodik', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(6, 'hhhhhhhhhhhhhhWWW', 15, '778f538bda72943b87250029aed13346.jpeg', 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(16, 'Manna Étterem 01', 17, '1efc62c6138f88964707988e770228a5.jpg', 'Manna Étterem 01', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(17, 'Manna Étterem 02', 15, '7d98e5ae75c4188c38bbc61e91138bf5.jpg', 'Manna Étterem 02', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(18, 'Manna Étterem 02', 17, '8b17020854de06d9020da073f275ce92.jpg', 'Manna Étterem 02', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(19, 'Manna Étterem 03', 17, '7a15a5ea9e305833ae3e04b63e396e44.jpg', 'Manna Étterem 03', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(20, 'Manna Étterem 04', 17, '80efed00e2ef3ad7b31a5cdf6ece83f6.jpg', 'Manna Étterem 04', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(21, 'Manna Étterem 05', 17, 'a60e891cd36f1b66b3f59776ce80e7c9.jpg', 'Manna Étterem 05', '2012-05-18', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(22, 'Manna Étterem 00', 17, 'bc5383aa1d43fba3d1fd6f7e0674a037.jpg', 'Manna Étterem 00', '2012-05-20', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(23, 'Éttermünkről', 18, '2468655427140b52988be121418792b1.jpg', 'Manna Éterem', '2012-05-20', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(24, 'Manna tavasz', 18, '92431da112d15fdf702d5fc5c3ef3df4.jpg', 'Manna tavasz', '2012-05-20', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false'),
(25, 'Kézműves borok', 18, '4ba5041a3e7b6904bb5edaa8d63213e7.jpg', 'Kézműves borok', '2012-05-20', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', 'hu', 'false');

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
  `url` varchar(250) COLLATE utf8_bin NOT NULL,
  `hierarchy` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `langelements`
--

INSERT INTO `langelements` (`id`, `type`, `orig`, `hu`, `en`, `de`, `order`, `url`, `hierarchy`) VALUES
(1, 'menu', 'home', 'FŐOLDAL', 'HOME', 'LAIBACH', 1, 'home', 0),
(2, 'menu', 'news', 'HÍREK', 'NEWS', 'BEETHOVEN', 2, 'news', 0),
(3, 'menu', 'menu', 'ÉTLAP', 'MENU', 'MOZART', 3, 'menu', 0),
(4, 'menu', 'drinks', 'ITALLAP', 'DRINKS', 'GOETHE', 4, 'drinks', 0),
(5, 'menu', 'content', 'TARTALMAK', 'CONTENT', 'BERLIN', 5, 'content', 0),
(6, 'menu', 'programmes', 'PROGRAMOK', 'PROGRAMMES', 'BMW', 6, 'programmes', 0),
(7, 'menu', 'reservations', 'ASZTALFOGLALÁS', 'RESERVATIONS', 'DAS BOOT', 7, 'reservations', 0),
(8, 'menu', 'gallery', 'GALÉRIA', 'GALLERY', 'RAMMSTEIN', 8, 'gallery', 0),
(9, 'adminmenu', 'articles', 'cikkek', 'articles', 'das articles', 5, 'admin_articles', 0),
(10, 'adminmenu', 'programmes', 'programok', 'programmes', 'das programmes', 10, 'admin_programmes', 0),
(11, 'adminmenu', 'galleries', 'galériák', 'galleries', 'das galleries', 30, 'admin_galleries', 0),
(12, 'adminmenu', 'booking', 'foglalások', 'booking', 'das booking', 25, 'admin_booking', 0),
(13, 'adminmenu', 'language', 'nyelvi elemek', 'language', 'der language', 40, 'admin_language', 0),
(14, 'adminmenu', 'drinks', 'italok', 'drinks', '', 15, 'admin_drinks', 0),
(15, 'adminmenu', 'foods', 'ételek', 'foods', '', 20, 'admin_foods', 0),
(16, 'adminmenu', 'images', 'Képek', 'images', 'das images', 35, 'admin_images', 0),
(17, 'adminmenu', 'seo', 'SEO', 'SEO', 'SEO', 45, 'admin_speaking_url', 0);

-- --------------------------------------------------------

--
-- Table structure for table `linx`
--

CREATE TABLE IF NOT EXISTS `linx` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `thisorder` varchar(250) COLLATE utf8_bin NOT NULL,
  `params` varchar(250) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `linx`
--

INSERT INTO `linx` (`id`, `thisorder`, `params`) VALUES
(2, 'ez_csak_egy_teszt', 'admin_drinks/import'),
(3, 'Dark_Shadows_2012_CAM', 'admin_foods/39/edit'),
(5, 'valamiMás', 'admin_foods?page=5'),
(6, 'Fanta Citrom , Fanta Narancs 0,2l', 'admin_drinks/23');

-- --------------------------------------------------------

--
-- Table structure for table `nodetranslate`
--

CREATE TABLE IF NOT EXISTS `nodetranslate` (
  `id` int(10) NOT NULL,
  `en` int(10) NOT NULL,
  `de` int(10) NOT NULL,
  UNIQUE KEY `nid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `nodetranslate`
--

INSERT INTO `nodetranslate` (`id`, `en`, `de`) VALUES
(14, 5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE IF NOT EXISTS `programmes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `lead` varchar(250) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL,
  `edited` date NOT NULL,
  `image` int(10) NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_keywords` varchar(250) COLLATE utf8_bin NOT NULL,
  `meta_desc` text COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `lang` enum('hu','en','de') COLLATE utf8_bin NOT NULL,
  `active` enum('false','true') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `title`, `lead`, `body`, `created`, `edited`, `image`, `meta_title`, `meta_keywords`, `meta_desc`, `date_from`, `date_to`, `lang`, `active`) VALUES
(1, 'index_action', '', '', '2020-05-14', '2020-05-13', 0, '', '', '', '0000-00-00', '0000-00-00', '', 'false'),
(15, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet', 0x3c703e3c696d67207372633d222e2e2f2e2e2f75706c6f61642f31352f37373866353338626461373239343362383732353030323961656431333334362e6a7065672220616c743d2222202f3e3c2f703e0d0a3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747572206164697069736963696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20557420656e696d206164206d696e696d2076656e69616d2c2071756973206e6f737472756420657865726369746174696f6e20756c6c616d636f206c61626f726973206e69736920757420616c697175697020657820656120636f6d6d6f646f20636f6e7365717561742e2044756973206175746520697275726520646f6c6f7220696e20726570726568656e646572697420696e20766f6c7570746174652076656c697420657373652063696c6c756d20646f6c6f726520657520667567696174206e756c6c612070617269617475722e204578636570746575722073696e74206f6363616563617420637570696461746174206e6f6e2070726f6964656e742c2073756e7420696e2063756c706120717569206f666669636961206465736572756e74206d6f6c6c697420616e696d20696420657374206c61626f72756d2e204c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747572206164697069736963696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20557420656e696d206164206d696e696d2076656e69616d2c2071756973206e6f737472756420657865726369746174696f6e20756c6c616d636f206c61626f726973206e69736920757420616c697175697020657820656120636f6d6d6f646f20636f6e7365717561742e2044756973206175746520697275726520646f6c6f7220696e20726570726568656e646572697420696e20766f6c7570746174652076656c697420657373652063696c6c756d20646f6c6f726520657520667567696174206e756c6c612070617269617475722e204578636570746575722073696e74206f6363616563617420637570696461746174206e6f6e2070726f6964656e742c2073756e7420696e2063756c706120717569206f666669636961206465736572756e74206d6f6c6c697420616e696d20696420657374206c61626f72756d2e204c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747572206164697069736963696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20557420656e696d206164206d696e696d2076656e69616d2c2071756973206e6f737472756420657865726369746174696f6e20756c6c616d636f206c61626f726973206e69736920757420616c697175697020657820656120636f6d6d6f646f20636f6e7365717561742e2044756973206175746520697275726520646f6c6f7220696e20726570726568656e646572697420696e20766f6c7570746174652076656c697420657373652063696c6c756d20646f6c6f726520657520667567696174206e756c6c612070617269617475722e204578636570746575722073696e74206f6363616563617420637570696461746174206e6f6e2070726f6964656e742c2073756e7420696e2063756c706120717569206f666669636961206465736572756e74206d6f6c6c697420616e696d20696420657374206c61626f72756d2e3c2f703e0d0a3c703e266e6273703b3c2f703e0d0a3c703e3c696d67207372633d222e2e2f2e2e2f75706c6f61642f31362f36333466373131303830373661303130346566356135383632623237656666662e6a70672220616c743d2222202f3e3c696d67207372633d222e2e2f2e2e2f75706c6f61642f31362f36333466373131303830373661303130346566356135383632623237656666662e6a70672220616c743d2222202f3e3c2f703e, '2012-05-17', '2012-05-19', 4, 'Lorem', 'Lorem,Lorem,Lorem', 0x092020092020092020094c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e7365637465747572206164697069736963696e6720656c69742c2073656420646f20656975736d6f642074656d706f7220696e6369646964756e74207574206c61626f726520657420646f6c6f7265206d61676e6120616c697175612e20557420656e696d206164206d696e696d2076656e69616d2c2071756973206e6f737472756420657865726369746174696f6e20756c6c616d636f206c61626f726973206e69736920757420616c697175697020657820656120636f6d6d6f646f20636f6e7365717561742e2044750909, '2012-04-11', '2013-05-18', 'hu', 'true');

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
