-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: 10.246.16.162:3306
-- Generation Time: Nov 02, 2012 at 08:51 AM
-- Server version: 5.1.63
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `detterholm_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`catID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catID`, `catname`, `description`) VALUES
(1, 'Natur', 'Naturbilder'),
(2, 'Hundar', 'Hundar!'),
(3, 'Spel', 'Allt om spel.'),
(4, 'Skoj', 'Allt som &auml;r skoj!'),
(5, 'Personligt', 'Bilder på mig och min familj.');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `imageID` int(11) NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8 NOT NULL,
  `uploaded` datetime NOT NULL,
  `imageName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`imageID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageID`, `description`, `uploaded`, `imageName`, `category_id`) VALUES
(55, 'Sonja eller Alf?', '2012-11-02 08:07:20', 'af6850_599562_10151704141025016_937846037_n.jpg', 2),
(68, 'P&Atilde;&yen; v&Atilde;&curren;g till Stockholm', '2012-11-02 08:17:07', 'f04386_427498_10151746998030016_826384685_n.jpg', 1),
(47, 'Solnedg&Atilde;&yen;ng sedd fr&Atilde;&yen;n Hvens gamla kyrka.', '2012-11-02 08:04:56', '242827_378295_10151746993880016_605241951_n.jpg', 1),
(53, 'Vindm&Atilde;&para;llan vid Malm&Atilde;&para;hus.', '2012-11-02 08:06:42', '2549d1_376704_10151753470595016_1752016688_n.jpg', 1),
(52, 'Spex, blandras sch&Atilde;&curren;fer och Sankt Bernhard.', '2012-11-02 08:06:27', 'ab4f4c_396131_10151701603470016_1590285591_n.jpg', 2),
(51, 'Jycke (han heter s&Atilde;&yen; :p )', '2012-11-02 08:06:00', '99ec2c_527126_10151605270275016_310252256_n.jpg', 2),
(50, 'Chanel', '2012-11-02 08:05:40', '8fe62e_538365_10151792744310016_170137409_n.jpg', 2),
(49, 'Chanel och jag p&Atilde;&yen; hunddagiset.', '2012-11-02 08:05:27', 'c4a186_376811_10151694154715016_1414194093_n.jpg', 5),
(48, 'Jag och Zita', '2012-11-02 08:05:07', 'e41ee7_285063_10151860176510016_994658788_n.jpg', 5),
(46, 'Zita', '2012-11-02 08:04:29', '56554f_269160_10151825317145016_888477000_n.jpg', 2),
(45, 'Coffee', '2012-11-02 08:01:07', 'ecf8ca_coffee.jpg', 4),
(44, 'Creeper', '2012-11-02 07:58:57', 'f9b459_fbee05c0dd210c9b5f684996c86a00ef.png', 3),
(56, 'Hvens gamla kyrka', '2012-11-02 08:07:31', '393c77_531417_10151745017875016_654378236_n.jpg', 1),
(57, 'Zita och jag', '2012-11-02 08:07:41', '409ec9_318879_10151734171025016_1814848090_n.jpg', 2),
(58, 'En tidig morgon p&Atilde;&yen; Hven.', '2012-11-02 08:07:56', '3eed39_599922_10151743741770016_117738269_n.jpg', 1),
(59, 'Mirrors Edge.', '2012-11-02 08:08:17', '9e0796_1299264596-mirrors_edge_reflection.jpg', 3),
(60, ':)', '2012-11-02 08:08:34', '338b2b_JoPLa.jpg', 4),
(61, 'S&Atilde;&yen; &Atilde;&curren;r det. :)', '2012-11-02 08:09:12', 'f04a7d_422801_10151812551210016_1675545608_n.jpg', 4),
(67, 'Bf3', '2012-11-02 08:13:16', '7f7840_bf3.jpg', 3),
(66, 'Bc2', '2012-11-02 08:13:03', 'e4cd59_bc2.jpg', 3),
(64, 'Super Mario', '2012-11-02 08:10:09', 'eeecd7_tv-spel204_115626145_157039765.jpg', 3),
(65, 'Hen!', '2012-11-02 08:10:42', 'd1d979_577039_10151826982850016_371448679_n.jpg', 4),
(69, 'Zita och jag', '2012-11-02 08:23:42', 'b1f610_318879_10151734171025016_1814848090_n.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `pass`) VALUES
(2, 'ravvie', '05b972dcf28374406d13e879724bfe3b');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
