-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2014 at 07:13 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_exyard`
--

-- --------------------------------------------------------

--
-- Table structure for table `wl_meta_tags`
--

CREATE TABLE `wl_meta_tags` (
  `meta_id` int(11) NOT NULL auto_increment,
  `is_fixed` enum('Y','N') NOT NULL default 'N',
  `entity_type` varchar(80) default NULL COMMENT 'name of controllers  ',
  `entity_id` int(11) NOT NULL default '0',
  `page_url` varchar(200) NOT NULL,
  `meta_title` varchar(80) character set utf8 collate utf8_unicode_ci NOT NULL,
  `meta_description` varchar(220) character set utf8 collate utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(460) character set utf8 collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`meta_id`),
  KEY `page_url` (`page_url`),
  KEY `entity_type` (`entity_type`),
  KEY `entity_id` (`entity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `wl_meta_tags`
--

INSERT INTO `wl_meta_tags` (`meta_id`, `is_fixed`, `entity_type`, `entity_id`, `page_url`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(1, 'N', 'pages/index', 22, 'vital-information/my-page1', 'My page1', 'ewre sdf sdfsdfs fsdfs sdf sdf sdfsdfsd', 'sdfsdfsd, fsdfs, sdfsdfs, ewre'),
(2, 'N', 'pages/index', 24, 'vital-information/my-page3', 'My Page2', 'sadhgashd asd asd hasd sad asd asd asdasdas', 'asdasdas, hasd, sadhgashd'),
(3, 'N', 'pages/index', 25, 'vital-information/my-page33', 'My Page33', 'er rtetrerert etrererter', 'etrererter, rtetrerert'),
(4, 'N', 'category/index', 1, 'heavy-equipment', 'Heavy Equipment', '', ''),
(5, 'N', 'category/index', 2, 'heavy-equipment/trucks', 'Trucks', '', ''),
(6, 'N', 'category/index', 3, 'heavy-equipment/mycars', 'Cars', '', ''),
(26, 'Y', 'home/index', 0, 'home', 'home', 'home', 'home'),
(27, 'Y', 'testimonials/index', 0, 'testimonials', 'testimonials', 'testimonials', 'testimonials'),
(28, 'Y', 'news/index', 0, 'news', 'news', 'news', 'news'),
(29, 'Y', 'faq/index', 0, 'faq', 'faq', 'faq', 'faq'),
(30, 'Y', 'products/index', 0, 'products', 'products', 'products', 'products'),
(31, 'Y', 'category/index', 0, 'category', 'category', 'category', 'category'),
(32, 'Y', 'users/index', 0, 'users', 'users', 'users', 'users'),
(33, 'Y', 'users/register', 0, 'users/register', 'users/register', 'users/register', 'users/register'),
(34, 'Y', 'member/index', 0, 'member', 'member', 'member', 'member'),
(35, 'Y', 'pages/sitemap', 0, 'sitemap', 'sitemap', 'sitemap', 'sitemap'),
(36, 'Y', 'pages/index/math-conversion', 0, 'math-conversion', 'math-conversion', 'math-conversion', 'math-conversion'),
(37, 'Y', 'pages/index/aboutus', 0, 'aboutus', 'aboutus', 'aboutus', 'aboutus'),
(38, 'Y', 'pages/contactus', 0, 'contactus', 'contactus', 'contactus', 'contactus'),
(39, 'Y', 'pages/classified', 0, 'classified', 'classified', 'classified', 'classified'),
(40, 'Y', 'category/index?type=rental', 0, 'rental-services', 'rental-services', 'rental-services', 'rental-services'),
(41, 'Y', 'pages/index/vital-information', 0, 'vital-information', 'vital-information', 'vital-information', 'vital-information'),
(42, 'Y', 'products/index', 0, 'search-products', 'search-products', 'search-products', 'search-products'),
(43, 'Y', 'category/index?type=buy', 0, 'wanted-to-buy', 'wanted-to-buy', 'wanted-to-buy', 'wanted-to-buy'),
(44, 'Y', 'users/logout', 0, 'users/logout', 'users/logout', 'users/logout', 'users/logout'),
(45, 'N', 'news/details/3', 3, 'news/maecenas-pharetra-bibendum-iaculis', 'Maecenas pharetra bibendum iaculis', 'Maecenas pharetra bibendum iaculis. Praesent purus ipsum, dignissim quis venenatis ut, ullamcorper ut enim. Etiam porta convallis enim, consectetur pellentesque leo imperdiet eu. Nam pretium diam vel arcu sodales', 'enim, ipsum, consequat, Etiam, iaculis, diam, Proin, odio, scelerisque, Duis, lectus, nulla, ultricies, tortor, fermentum, Suspendisse, sapien, lorem, lacus, Maecenas'),
(46, 'N', 'news/details/4', 4, 'news/maecenas-pharetra-bibendum-iaculis1', 'Maecenas pharetra bibendum iaculis1', 'fssdfsfds', 'fssdfsfds'),
(47, 'Y', 'home/index', 0, 'home', 'home', 'home', 'home'),
(48, 'Y', 'testimonials/index', 0, 'testimonials', 'testimonials', 'testimonials', 'testimonials'),
(49, 'Y', 'news/index', 0, 'news', 'news', 'news', 'news'),
(50, 'Y', 'faq/index', 0, 'faq', 'faq', 'faq', 'faq'),
(51, 'Y', 'products/index', 0, 'products', 'products', 'products', 'products'),
(52, 'Y', 'category/index', 0, 'category', 'category', 'category', 'category'),
(53, 'Y', 'users/index', 0, 'users', 'users', 'users', 'users'),
(54, 'Y', 'users/register', 0, 'users/register', 'users/register', 'users/register', 'users/register'),
(55, 'Y', 'member/index', 0, 'member', 'member', 'member', 'member'),
(56, 'Y', 'pages/sitemap', 0, 'sitemap', 'sitemap', 'sitemap', 'sitemap'),
(57, 'Y', 'pages/index/math-conversion', 0, 'math-conversion', 'math-conversion', 'math-conversion', 'math-conversion'),
(58, 'Y', 'pages/index/aboutus', 0, 'aboutus', 'aboutus', 'aboutus', 'aboutus'),
(59, 'Y', 'pages/contactus', 0, 'contactus', 'contactus', 'contactus', 'contactus'),
(60, 'Y', 'pages/classified', 0, 'classified', 'classified', 'classified', 'classified'),
(61, 'Y', 'category/index?type=rental', 0, 'rental-services', 'rental-services', 'rental-services', 'rental-services'),
(62, 'Y', 'pages/vital-information', 0, 'vital-information', 'vital-information', 'vital-information', 'vital-information'),
(63, 'Y', 'products/index', 0, 'search-products', 'search-products', 'search-products', 'search-products'),
(64, 'Y', 'category/index?type=buy', 0, 'wanted-to-buy', 'wanted-to-buy', 'wanted-to-buy', 'wanted-to-buy'),
(65, 'Y', 'users/logout', 0, 'users/logout', 'users/logout', 'users/logout', 'users/logout'),
(66, 'Y', 'home/index', 0, 'home', 'home', 'home', 'home'),
(67, 'Y', 'testimonials/index', 0, 'testimonials', 'testimonials', 'testimonials', 'testimonials'),
(68, 'Y', 'news/index', 0, 'news', 'news', 'news', 'news'),
(69, 'Y', 'faq/index', 0, 'faq', 'faq', 'faq', 'faq'),
(70, 'Y', 'products/index', 0, 'products', 'products', 'products', 'products'),
(71, 'Y', 'category/index', 0, 'category', 'category', 'category', 'category'),
(72, 'Y', 'users/index', 0, 'users', 'users', 'users', 'users'),
(73, 'Y', 'users/register', 0, 'users/register', 'users/register', 'users/register', 'users/register'),
(74, 'Y', 'member/index', 0, 'member', 'member', 'member', 'member'),
(75, 'Y', 'pages/sitemap', 0, 'sitemap', 'sitemap', 'sitemap', 'sitemap'),
(76, 'Y', 'pages/index/math-conversion', 0, 'math-conversion', 'math-conversion', 'math-conversion', 'math-conversion'),
(77, 'Y', 'pages/index/aboutus', 0, 'aboutus', 'aboutus', 'aboutus', 'aboutus'),
(78, 'Y', 'pages/contactus', 0, 'contactus', 'contactus', 'contactus', 'contactus'),
(79, 'Y', 'pages/classified', 0, 'classified', 'classified', 'classified', 'classified'),
(80, 'Y', 'category/index?type=rental', 0, 'rental-services', 'rental-services', 'rental-services', 'rental-services'),
(81, 'Y', 'pages/vital-information', 0, 'vital-information', 'vital-information', 'vital-information', 'vital-information'),
(82, 'Y', 'products/index', 0, 'search-products', 'search-products', 'search-products', 'search-products'),
(83, 'Y', 'category/index?type=buy', 0, 'wanted-to-buy', 'wanted-to-buy', 'wanted-to-buy', 'wanted-to-buy'),
(84, 'Y', 'users/logout', 0, 'users/logout', 'users/logout', 'users/logout', 'users/logout'),
(85, 'Y', 'news/index', 0, 'news', 'news', 'news', 'news'),
(86, 'N', 'news/details/5', 5, 'news/petrol-price-hike', 'Petrol price hike', 'e wer we rwerwer werwere wrwe', 'wrwe, werwere, rwerwer');
