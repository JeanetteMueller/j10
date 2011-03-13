-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 23. Februar 2011 um 20:42
-- Server Version: 5.0.41
-- PHP-Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `jx`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_modul`
--

CREATE TABLE `jx_modul` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `path` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `jx_modul`
--

INSERT INTO `jx_modul` VALUES(1, '2010-09-19 16:01:49', '2011-01-23 19:42:46', NULL, 'navigationbar', 'Navi');
INSERT INTO `jx_modul` VALUES(2, '2010-09-26 12:36:05', '2010-09-26 12:36:05', NULL, 'login', 'Login');
INSERT INTO `jx_modul` VALUES(3, '2010-09-26 14:25:03', '2010-09-26 14:25:03', NULL, 'onlineuser', 'Online User');
INSERT INTO `jx_modul` VALUES(4, '2010-10-10 13:37:27', '2010-10-10 13:37:27', NULL, 'register', 'User Registration');
INSERT INTO `jx_modul` VALUES(5, '0000-00-00 00:00:00', '2011-01-24 20:11:19', NULL, 'multiUserGallery', 'multiUserGallery');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_module_multiUserGallery_galleries`
--

CREATE TABLE `jx_module_multiUserGallery_galleries` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(2500) NOT NULL,
  `titleimage` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `jx_module_multiUserGallery_galleries`
--

INSERT INTO `jx_module_multiUserGallery_galleries` VALUES(1, '2011-01-24 20:22:57', '2011-01-24 22:36:58', NULL, 1, 'testgalerie', 'das ist die beschreibung für die Testgalerie', 4);
INSERT INTO `jx_module_multiUserGallery_galleries` VALUES(2, '0000-00-00 00:00:00', '2011-01-24 22:36:58', NULL, 1, 'test 2', '', 2);
INSERT INTO `jx_module_multiUserGallery_galleries` VALUES(3, '0000-00-00 00:00:00', '2011-01-24 22:36:58', NULL, 1, 'test 3', '', 3);
INSERT INTO `jx_module_multiUserGallery_galleries` VALUES(4, '0000-00-00 00:00:00', '2011-01-24 20:34:07', NULL, 1, 'test 4', '', 0);
INSERT INTO `jx_module_multiUserGallery_galleries` VALUES(5, '0000-00-00 00:00:00', '2011-01-24 20:34:17', NULL, 1, 'test 5', '', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_module_multiUserGallery_images`
--

CREATE TABLE `jx_module_multiUserGallery_images` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `user_id` int(11) NOT NULL,
  `taxonomie_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(2500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `jx_module_multiUserGallery_images`
--

INSERT INTO `jx_module_multiUserGallery_images` VALUES(1, '0000-00-00 00:00:00', '2011-01-24 20:23:41', NULL, 1, 0, 1, 'erstes bild', 'bildbeschreibung');
INSERT INTO `jx_module_multiUserGallery_images` VALUES(2, '0000-00-00 00:00:00', '2011-01-24 20:49:05', NULL, 1, 0, 2, 'bla', '');
INSERT INTO `jx_module_multiUserGallery_images` VALUES(3, '0000-00-00 00:00:00', '2011-01-24 20:49:05', NULL, 1, 0, 3, 'soso', '');
INSERT INTO `jx_module_multiUserGallery_images` VALUES(4, '0000-00-00 00:00:00', '2011-01-24 22:17:15', NULL, 1, 0, 1, 'southpark', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_modul_to_slots_in_site`
--

CREATE TABLE `jx_modul_to_slots_in_site` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `modul_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `site_id` int(11) default NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `modul_id` (`modul_id`),
  KEY `slot_id` (`slot_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `jx_modul_to_slots_in_site`
--

INSERT INTO `jx_modul_to_slots_in_site` VALUES(1, '2010-09-26 11:40:25', '2011-01-23 19:32:25', NULL, 1, 2, NULL, 90);
INSERT INTO `jx_modul_to_slots_in_site` VALUES(5, '0000-00-00 00:00:00', '2011-01-24 20:11:37', NULL, 5, 4, 6, 100);
INSERT INTO `jx_modul_to_slots_in_site` VALUES(3, '2010-09-26 12:36:34', '2011-01-23 19:32:25', NULL, 2, 2, NULL, 100);
INSERT INTO `jx_modul_to_slots_in_site` VALUES(4, '2010-09-26 14:25:23', '2011-01-23 19:32:25', NULL, 3, 2, 1, 110);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_sites`
--

CREATE TABLE `jx_sites` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `root_id` int(11) default NULL,
  `sort` int(11) NOT NULL,
  `path` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `site_id` (`root_id`),
  KEY `navigationorder` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `jx_sites`
--

INSERT INTO `jx_sites` VALUES(1, '2010-09-19 12:27:44', '2011-01-23 19:34:18', NULL, 0, 100, 'index', 'Startseite');
INSERT INTO `jx_sites` VALUES(2, '2010-09-19 14:25:33', '2011-01-23 19:34:18', NULL, 0, 150, 'impressum', 'Impressum & AGB');
INSERT INTO `jx_sites` VALUES(3, '2010-09-19 17:40:45', '2010-09-19 19:16:45', NULL, 1, 0, 'untermenupunkt', 'Unter Menu Punkt');
INSERT INTO `jx_sites` VALUES(4, '2010-09-19 17:42:09', '2010-09-19 17:42:09', NULL, NULL, 0, 'nichtInDerNavigation', 'nichtInDerNavigation');
INSERT INTO `jx_sites` VALUES(5, '2010-09-19 20:00:30', '2011-01-23 19:34:18', NULL, 0, 160, 'kontakt', 'Kontakt');
INSERT INTO `jx_sites` VALUES(6, '0000-00-00 00:00:00', '2011-01-24 20:07:05', NULL, 0, 110, 'gallery', 'Galerie');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_slots`
--

CREATE TABLE `jx_slots` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `site_id` int(11) NOT NULL,
  `slottype_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Daten für Tabelle `jx_slots`
--

INSERT INTO `jx_slots` VALUES(1, '2010-09-19 15:15:45', '2010-09-26 12:01:56', NULL, 1, 1);
INSERT INTO `jx_slots` VALUES(2, '2010-09-19 15:16:10', '2010-09-26 12:01:56', NULL, 1, 2);
INSERT INTO `jx_slots` VALUES(3, '2010-09-19 15:16:10', '2010-09-26 12:01:56', NULL, 1, 3);
INSERT INTO `jx_slots` VALUES(4, '2010-09-19 15:16:30', '2010-09-26 12:01:56', NULL, 1, 4);
INSERT INTO `jx_slots` VALUES(5, '2010-09-19 15:16:30', '2010-09-26 12:01:56', NULL, 1, 5);
INSERT INTO `jx_slots` VALUES(6, '2010-09-26 11:39:53', '2010-09-26 12:01:56', NULL, 2, 1);
INSERT INTO `jx_slots` VALUES(7, '2010-09-26 11:49:24', '2010-09-26 12:01:56', NULL, 2, 2);
INSERT INTO `jx_slots` VALUES(8, '2010-09-26 11:49:45', '2010-09-26 12:01:56', NULL, 2, 4);
INSERT INTO `jx_slots` VALUES(9, '0000-00-00 00:00:00', '2011-01-23 18:35:23', NULL, 2, 3);
INSERT INTO `jx_slots` VALUES(10, '0000-00-00 00:00:00', '2011-01-23 18:35:23', NULL, 2, 5);
INSERT INTO `jx_slots` VALUES(11, '0000-00-00 00:00:00', '2011-01-23 18:54:56', NULL, 5, 1);
INSERT INTO `jx_slots` VALUES(12, '0000-00-00 00:00:00', '2011-01-23 18:54:56', NULL, 5, 2);
INSERT INTO `jx_slots` VALUES(13, '0000-00-00 00:00:00', '2011-01-23 18:55:14', NULL, 5, 3);
INSERT INTO `jx_slots` VALUES(14, '0000-00-00 00:00:00', '2011-01-23 18:55:14', NULL, 5, 4);
INSERT INTO `jx_slots` VALUES(15, '0000-00-00 00:00:00', '2011-01-23 18:55:24', NULL, 5, 5);
INSERT INTO `jx_slots` VALUES(16, '0000-00-00 00:00:00', '2011-01-23 19:35:31', NULL, 3, 1);
INSERT INTO `jx_slots` VALUES(17, '0000-00-00 00:00:00', '2011-01-23 19:35:31', NULL, 3, 2);
INSERT INTO `jx_slots` VALUES(18, '0000-00-00 00:00:00', '2011-01-23 19:35:46', NULL, 3, 3);
INSERT INTO `jx_slots` VALUES(19, '0000-00-00 00:00:00', '2011-01-23 19:35:46', NULL, 3, 4);
INSERT INTO `jx_slots` VALUES(20, '0000-00-00 00:00:00', '2011-01-23 19:35:50', NULL, 3, 5);
INSERT INTO `jx_slots` VALUES(21, '0000-00-00 00:00:00', '2011-01-24 20:07:38', NULL, 6, 1);
INSERT INTO `jx_slots` VALUES(22, '0000-00-00 00:00:00', '2011-01-24 20:07:38', NULL, 6, 2);
INSERT INTO `jx_slots` VALUES(23, '0000-00-00 00:00:00', '2011-01-24 20:07:50', NULL, 6, 3);
INSERT INTO `jx_slots` VALUES(24, '0000-00-00 00:00:00', '2011-01-24 20:07:50', NULL, 6, 4);
INSERT INTO `jx_slots` VALUES(25, '0000-00-00 00:00:00', '2011-01-24 20:07:59', NULL, 6, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_slottypes`
--

CREATE TABLE `jx_slottypes` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `jx_slottypes`
--

INSERT INTO `jx_slottypes` VALUES(1, '2010-09-19 15:15:45', '2010-09-19 20:25:26', NULL, 'header');
INSERT INTO `jx_slottypes` VALUES(2, '2010-09-19 15:16:10', '2010-09-19 20:25:26', NULL, 'sidebar_left');
INSERT INTO `jx_slottypes` VALUES(3, '2010-09-19 15:16:10', '2010-09-19 20:25:26', NULL, 'sidebar_right');
INSERT INTO `jx_slottypes` VALUES(4, '2010-09-19 15:16:30', '2010-09-19 20:25:26', NULL, 'content');
INSERT INTO `jx_slottypes` VALUES(5, '2010-09-19 15:16:30', '2010-09-19 20:25:26', NULL, 'footer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_taxonomie`
--

CREATE TABLE `jx_taxonomie` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `root_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(2500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `jx_taxonomie`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_users`
--

CREATE TABLE `jx_users` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `birthday` date default NULL,
  `gender` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Daten für Tabelle `jx_users`
--

INSERT INTO `jx_users` VALUES(1, '2010-09-26 12:25:40', '2010-09-26 12:25:57', NULL, 'Jeanette', 'f29957e2682583a41969d05d4ecec44a', 'jeanette@jeanette-rose.de', '1982-01-24', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_user_gender`
--

CREATE TABLE `jx_user_gender` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `jx_user_gender`
--

INSERT INTO `jx_user_gender` VALUES(1, '2010-09-26 12:23:18', '2010-09-26 12:23:18', NULL, 'Mann');
INSERT INTO `jx_user_gender` VALUES(2, '2010-09-26 12:23:18', '2010-09-26 12:23:18', NULL, 'Frau');
INSERT INTO `jx_user_gender` VALUES(3, '2010-09-26 12:23:41', '2010-09-26 12:23:41', NULL, 'Transgender MzF');
INSERT INTO `jx_user_gender` VALUES(4, '2010-09-26 12:23:41', '2010-09-26 12:23:41', NULL, 'Transgender FzM');
INSERT INTO `jx_user_gender` VALUES(5, '2010-09-26 12:23:51', '2010-09-26 12:23:51', NULL, 'Androgyn');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leer`
--

CREATE TABLE `leer` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `leer`
--

