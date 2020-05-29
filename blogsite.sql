-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 12, 2020 at 01:24 PM
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
(1, 'Pərviz Fətullayev', 'pervizfetulla@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 'perviz.jpg', '::1', '2020-01-12 16:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `text_id` int(11) NOT NULL AUTO_INCREMENT,
  `text_cat_id` int(11) NOT NULL,
  `text_title` varchar(200) NOT NULL,
  `text_chef` varchar(200) NOT NULL,
  `text_image` varchar(200) NOT NULL,
  `text_content` text NOT NULL,
  `text_tags` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text_chef_tag` varchar(200) NOT NULL,
  `text_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text_status` tinyint(1) NOT NULL DEFAULT '1',
  `text_show` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`text_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`text_id`, `text_cat_id`, `text_title`, `text_chef`, `text_image`, `text_content`, `text_tags`, `text_chef_tag`, `text_date`, `text_status`, `text_show`) VALUES
(1, 1, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 1),
(2, 1, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 12),
(3, 1, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 4),
(4, 2, 'PHP dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 1),
(5, 2, 'CSS dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 3),
(6, 2, 'JQUERY dersleri', 'jquery dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'jquery dersleri', 'jquery dersleri', '2020-01-07 09:50:22', 1, 1),
(7, 3, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 0),
(8, 3, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 1),
(9, 4, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 1),
(10, 4, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 0),
(11, 4, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri,html videolari', '2020-01-07 09:50:22', 1, 0),
(12, 5, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 0),
(13, 5, 'PHP  Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 0),
(14, 6, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 0),
(15, 6, 'HTML Dersleri', 'html-dersleri', 'blog.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'html dersleri,html videolari', 'html-dersleri, html_dersleri', '2020-01-07 09:50:22', 1, 0),
(35, 5, 'Html yeni elementler', 'html-yeni-elementler', '1367053434_2011-cars-images-audi-r8-tdi-le-mans-04.jpg', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like', 'html5,hmtl5, yeni,elementler,html', 'html5,hmtl5,yeni,elementler,html', '2020-01-10 13:44:23', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(200) NOT NULL,
  `cat_chef` varchar(200) NOT NULL,
  `cat_keyword` varchar(200) NOT NULL,
  `cat_desc` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_chef`, `cat_keyword`, `cat_desc`) VALUES
(1, 'HTML', 'html', 'html dersleri, html videolari', 'html dersleri, html videolari'),
(2, 'PHP', 'php', 'php dersleri, pdo dersleri', 'php dersleri, pdo dersleri'),
(3, 'CSS', 'css', 'css dersleri', 'css dersleri'),
(4, 'C#', 'csharp', 'c# dersleri', 'c# dersleri'),
(5, 'JAVASCRIPT', 'javascript', 'javascript dersleri', 'javascript dersleri'),
(6, 'JAVA', 'java', 'java dersleri', 'java dersleri'),
(7, 'React', 'react', 'react dersleri', 'react dersleri'),
(8, 'Vue', 'vue', 'vue dersleri', 'vue dersleri'),
(9, 'Angular', 'angular', 'angular dersleri', 'angular dersleri'),
(10, 'C++', 'cplusplus', 'c++ dersleri', 'c++ dersleri'),
(12, 'bootstrap', 'bootstrap', 'bootstrap', 'bootstrap');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_text_id` int(11) NOT NULL,
  `com_name` varchar(200) NOT NULL,
  `com_email` varchar(200) NOT NULL,
  `com_content` text NOT NULL,
  `com_website` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `com_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `com_status` tinyint(1) NOT NULL DEFAULT '2',
  `com_ip` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `com_text_id`, `com_name`, `com_email`, `com_content`, `com_website`, `com_date`, `com_status`, `com_ip`) VALUES
(1, 2, 'Perviz Fetullayev', 'pervizfetulla@gmail.com', 'html dersleri', 'http://php.net', '2020-01-08 10:40:53', 2, '::1'),
(3, 2, 'Heyder Ezimli', 'heyder@gmail.com', 'css dersleri', 'http://php.net', '2020-01-08 10:40:53', 1, '::1'),
(4, 1, 'Nazir Ezimli', 'nazir@gmail.com', 'dersler eladi, xosuma geldi,cox sagolun', '', '2020-01-10 13:50:21', 1, '::1'),
(5, 1, 'Heyder Ezimli', 'heyder123@gmail.com', 'Basqa sey istemirsen?', '', '2020-01-10 13:53:35', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `subject` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `m_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `ip` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `subject`, `email`, `message`, `m_date`, `status`, `ip`) VALUES
(2, 'Nazir Ezimli', 'Html5 de yeni elementler', 'nazir@gmail.com', 'Html5 de yeni tanimlanan elementler hansilardir?', '2020-01-06 19:24:05', 1, '::1'),
(4, 'Perviz Fetullayev', 'CSS Flexbox', 'pervizfetulla@gmail.com', 'CSS de Flexbox nedir?', '2020-01-06 19:24:05', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_url` varchar(200) NOT NULL,
  `site_title` varchar(200) NOT NULL,
  `site_keyword` varchar(250) NOT NULL,
  `site_desc` varchar(250) NOT NULL,
  `site_location` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `site_mail` varchar(200) NOT NULL,
  `site_logo` varchar(200) NOT NULL,
  `site_favicon` varchar(200) NOT NULL,
  `google_code` varchar(200) NOT NULL,
  `yandex_code` varchar(200) NOT NULL,
  `bing_code` varchar(200) NOT NULL,
  `analytics_code` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `site_status` tinyint(1) NOT NULL,
  `site_location_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_url`, `site_title`, `site_keyword`, `site_desc`, `site_location`, `site_mail`, `site_logo`, `site_favicon`, `google_code`, `yandex_code`, `bing_code`, `analytics_code`, `site_status`, `site_location_status`) VALUES
(1, 'http://localhost/blog/', 'Fetullayev Blog', 'Fetullayev Blog', 'Fetullayev Blog', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.2557300983426!2d49.79800881481762!3d40.381024479369266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307df3e00e2fbf%3A0x87c2214ecc707f3b!2sDadash%20Bunyad-Zadeh%2C%20Baku%2C%20Azerbaijan!5e0!3m2!1sen!2s!4v1578322268919!5m2!1sen!2s', 'perviz.fetullayev@gmail.com', '1OPF7qU0_400x400.jpg', 'logo.png', '1', '2', '3', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

DROP TABLE IF EXISTS `social_media`;
CREATE TABLE IF NOT EXISTS `social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(200) NOT NULL,
  `link` varchar(300) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `icon`, `link`, `status`) VALUES
(1, 'linkedin', 'https:/linkedin.com', 1),
(2, 'facebook', 'https://www.facebook.com/profile.php?id=100009274310872', 1),
(3, 'twitter', 'https:/twitter.com', 1),
(4, 'instagram', 'https://www.instagram.com/perviz_fetullayev/?hl=en', 1),
(6, 'pinterest', 'http://pinterest.com', 1),
(7, 'tumblr', 'http://tumblr.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub`
--

DROP TABLE IF EXISTS `sub`;
CREATE TABLE IF NOT EXISTS `sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_mail` varchar(200) NOT NULL,
  `sub_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sub_ip` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub`
--

INSERT INTO `sub` (`id`, `sub_mail`, `sub_date`, `sub_ip`) VALUES
(2, 'nazir@gamil.com', '2020-01-10 11:17:07', '::1'),
(3, 'heyder@gmail.com', '2020-01-10 11:17:17', '::1'),
(4, 'perviz@gmail.com', '2020-01-10 11:17:37', '::1'),
(5, 'eli@gmail.com', '2020-01-10 11:17:53', '::1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
