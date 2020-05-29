-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 02, 2020 at 03:37 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(200) NOT NULL,
  `admin_mail` varchar(200) NOT NULL,
  `admin_pass` varchar(200) NOT NULL,
  `admin_image` text NOT NULL,
  `last_ip` varchar(200) NOT NULL,
  `last_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_mail`, `admin_pass`, `admin_image`, `last_ip`, `last_date`) VALUES
(1, 'Pərviz Fətullayev', 'pervizfetulla@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 'perviz.jpg', '::1', '2020-02-20 13:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `elaqeform`
--

DROP TABLE IF EXISTS `elaqeform`;
CREATE TABLE IF NOT EXISTS `elaqeform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usta_id` int(11) NOT NULL,
  `ad` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `tarix` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prosedur` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mebleg` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `cins` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `elaqeform`
--

INSERT INTO `elaqeform` (`id`, `usta_id`, `ad`, `soyad`, `telefon`, `email`, `tarix`, `prosedur`, `mebleg`, `cins`) VALUES
(1, 3, 'Gunel', 'Ibrahimova', '+99455-476-59-23', 'gunel123@gmail.com', '2020-02-07 05:36:19', '2', '20', 'Qadin'),
(2, 1, 'Gunel', 'Humbetli', '+99455 593 23 12', 'gunel1993@gmail.com', '2020-02-20 09:25:12', '2', '20', 'Qadin');

-- --------------------------------------------------------

--
-- Table structure for table `prosedur`
--

DROP TABLE IF EXISTS `prosedur`;
CREATE TABLE IF NOT EXISTS `prosedur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `pro_sef` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `prosedur`
--

INSERT INTO `prosedur` (`id`, `ad`, `pro_sef`) VALUES
(1, 'Sac kesimi', 'sac-kesimi'),
(2, 'Qaynaq', 'qaynaq'),
(7, 'Tato silme', 'tato-silme'),
(4, 'Tato', 'tato'),
(5, 'Ukladka', 'ukladka'),
(6, 'Sac qaynagi', 'sac-qaynagi');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_url` varchar(200) NOT NULL,
  `site_title` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_url`, `site_title`) VALUES
(1, 'http://localhost/u529262orw.ha003.t.justns.ru/public_html/', 'Fetullayev Blog');

-- --------------------------------------------------------

--
-- Table structure for table `ustalar`
--

DROP TABLE IF EXISTS `ustalar`;
CREATE TABLE IF NOT EXISTS `ustalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `usta_sef` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `ustalar`
--

INSERT INTO `ustalar` (`id`, `adsoyad`, `usta_sef`) VALUES
(1, 'Nermin Ceferli', 'nermin-ceferli'),
(10, 'Kamil Eliyev', 'kamil-eliyev'),
(3, 'Gunay Ibrahimli', 'gunay-ibrahimli'),
(4, 'Sebuhi Eliyev', 'sebuhi-eliyev'),
(5, 'Fezilet Elizade', 'fezilet-elizade'),
(6, 'Ayan Guleliyeva', 'ayan-guleliyeva'),
(7, 'Kamran Velizade', 'kamran-velizade'),
(8, 'Guler Elizade', 'guler-elizade');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
