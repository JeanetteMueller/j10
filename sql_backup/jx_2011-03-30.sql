-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 30. März 2011 um 09:34
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
-- Tabellenstruktur für Tabelle `jx_content`
--

CREATE TABLE `jx_content` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dachzeile` varchar(500) default NULL,
  `ueberschrift` varchar(1000) default NULL,
  `vorspann` text,
  `text1` text,
  `text2` text,
  `text3` text,
  `text4` text,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `jx_content`
--

INSERT INTO `jx_content` VALUES(1, '2011-03-23 15:19:47', '2011-03-23 15:44:40', NULL, 1, 0, 'Nutzungsbedingungen', 'AGB', 'Vorspanntext falls vorhanden', 'Textbaustein 1', 'Textbaustein 2', 'Textbaustein 3', 'Textbaustein 4');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_contenttypes`
--

CREATE TABLE `jx_contenttypes` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `jx_contenttypes`
--

INSERT INTO `jx_contenttypes` VALUES(1, '2011-03-23 15:19:28', '2011-03-23 15:19:28', NULL, 'static');
INSERT INTO `jx_contenttypes` VALUES(2, '2011-03-23 15:19:28', '2011-03-23 15:19:28', NULL, 'article');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_modul`
--

CREATE TABLE `jx_modul` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `path` varchar(150) NOT NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `path` (`path`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `jx_modul`
--

INSERT INTO `jx_modul` VALUES(1, '2010-09-19 16:01:49', '2011-01-23 19:42:46', NULL, 'navigationbar', 'Navi');
INSERT INTO `jx_modul` VALUES(2, '2010-09-26 12:36:05', '2010-09-26 12:36:05', NULL, 'login', 'Login');
INSERT INTO `jx_modul` VALUES(3, '2010-09-26 14:25:03', '2010-09-26 14:25:03', NULL, 'onlineuser', 'Online User');
INSERT INTO `jx_modul` VALUES(4, '2010-10-10 13:37:27', '2010-10-10 13:37:27', NULL, 'register', 'User Registration');
INSERT INTO `jx_modul` VALUES(5, '0000-00-00 00:00:00', '2011-01-24 20:11:19', NULL, 'multiUserGallery', 'multiUserGallery');
INSERT INTO `jx_modul` VALUES(6, '2011-03-23 15:25:32', '2011-03-23 15:25:32', NULL, 'page', 'Page');
INSERT INTO `jx_modul` VALUES(7, '2011-03-28 23:58:09', '2011-03-28 23:58:09', NULL, 'admin', 'Administration');
INSERT INTO `jx_modul` VALUES(8, '0000-00-00 00:00:00', '2011-03-29 01:04:06', NULL, 'admin_reorderModules', 'Admin_reorderModules');

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
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `jx_module_multiUserGallery_galleries`
--

INSERT INTO `jx_module_multiUserGallery_galleries` VALUES(1, '2011-01-24 20:22:57', '2011-03-28 17:54:18', NULL, 1, 'testgalerie', 'das ist die beschreibung für die Testgalerie', 4);
INSERT INTO `jx_module_multiUserGallery_galleries` VALUES(2, '2011-03-28 23:50:27', '2011-03-28 23:50:27', NULL, 15, 'test 2', '', 2);
INSERT INTO `jx_module_multiUserGallery_galleries` VALUES(3, '2011-03-28 23:50:27', '2011-03-28 23:50:27', NULL, 15, 'test 3', '', 3);
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
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `taxonomie_id` (`taxonomie_id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `jx_module_multiUserGallery_images`
--

INSERT INTO `jx_module_multiUserGallery_images` VALUES(1, '0000-00-00 00:00:00', '2011-02-24 20:48:31', NULL, 1, 1, 1, 'erstes bild', 'bildbeschreibung');
INSERT INTO `jx_module_multiUserGallery_images` VALUES(2, '0000-00-00 00:00:00', '2011-02-24 20:48:32', NULL, 1, 1, 2, 'bla', '');
INSERT INTO `jx_module_multiUserGallery_images` VALUES(3, '0000-00-00 00:00:00', '2011-03-28 23:55:27', NULL, 15, 3, 3, 'soso', '');
INSERT INTO `jx_module_multiUserGallery_images` VALUES(4, '0000-00-00 00:00:00', '2011-03-28 23:55:27', NULL, 15, 4, 1, 'southpark', '');

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
  `params` text,
  PRIMARY KEY  (`id`),
  KEY `modul_id` (`modul_id`),
  KEY `slot_id` (`slot_id`),
  KEY `site_id` (`site_id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `jx_modul_to_slots_in_site`
--

INSERT INTO `jx_modul_to_slots_in_site` VALUES(1, '2010-09-26 11:40:25', '2011-03-29 12:38:37', NULL, 1, 2, NULL, 50, NULL);
INSERT INTO `jx_modul_to_slots_in_site` VALUES(5, '0000-00-00 00:00:00', '2011-03-29 12:38:37', NULL, 5, 4, 6, 50, NULL);
INSERT INTO `jx_modul_to_slots_in_site` VALUES(3, '2010-09-26 12:36:34', '2011-03-29 12:38:37', NULL, 2, 2, NULL, 60, NULL);
INSERT INTO `jx_modul_to_slots_in_site` VALUES(4, '2010-09-26 14:25:23', '2011-03-29 12:31:37', NULL, 3, 2, 1, 70, '{"itemcount":5}');
INSERT INTO `jx_modul_to_slots_in_site` VALUES(6, '2011-03-23 15:26:36', '2011-03-29 12:31:12', NULL, 6, 4, 2, 60, '{"contentid":1}');

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
  KEY `root_id` (`root_id`),
  KEY `sort` (`sort`),
  KEY `path` (`path`(333))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `jx_sites`
--

INSERT INTO `jx_sites` VALUES(1, '2010-09-19 12:27:44', '2011-01-23 19:34:18', NULL, 0, 100, 'index', 'Startseite');
INSERT INTO `jx_sites` VALUES(2, '2010-09-19 14:25:33', '2011-03-23 15:46:52', NULL, 0, 150, 'agb', 'AGB');
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
  KEY `site_id` (`site_id`),
  KEY `slottype_id` (`slottype_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Daten für Tabelle `jx_slots`
--

INSERT INTO `jx_slots` VALUES(1, '2010-09-19 15:15:45', '2010-09-26 12:01:56', NULL, 1, 1);
INSERT INTO `jx_slots` VALUES(2, '2010-09-19 15:16:10', '2010-09-26 12:01:56', NULL, 1, 2);
INSERT INTO `jx_slots` VALUES(3, '2010-09-19 15:16:10', '2011-02-27 18:59:58', NULL, 1, 3);
INSERT INTO `jx_slots` VALUES(4, '2010-09-19 15:16:30', '2010-09-26 12:01:56', NULL, 1, 4);
INSERT INTO `jx_slots` VALUES(5, '2010-09-19 15:16:30', '2010-09-26 12:01:56', NULL, 1, 5);
INSERT INTO `jx_slots` VALUES(6, '2010-09-26 11:39:53', '2010-09-26 12:01:56', NULL, 2, 1);
INSERT INTO `jx_slots` VALUES(7, '2010-09-26 11:49:24', '2010-09-26 12:01:56', NULL, 2, 2);
INSERT INTO `jx_slots` VALUES(8, '2010-09-26 11:49:45', '2010-09-26 12:01:56', NULL, 2, 4);
INSERT INTO `jx_slots` VALUES(9, '2011-01-23 18:35:15', '2011-03-29 12:32:13', NULL, 2, 3);
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
INSERT INTO `jx_slots` VALUES(23, '0000-00-00 00:00:00', '2011-03-29 12:32:13', NULL, 6, 3);
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
  PRIMARY KEY  (`id`),
  KEY `root_id` (`root_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `jx_taxonomie`
--

INSERT INTO `jx_taxonomie` VALUES(1, '2011-02-24 20:42:25', '2011-02-24 20:42:25', NULL, 0, 'Menschen', '');
INSERT INTO `jx_taxonomie` VALUES(2, '2011-02-24 20:42:53', '2011-02-24 20:42:53', NULL, 0, 'Akt', '');
INSERT INTO `jx_taxonomie` VALUES(3, '2011-02-24 20:44:08', '2011-02-24 20:44:08', NULL, 0, 'Natur', '');
INSERT INTO `jx_taxonomie` VALUES(4, '2011-02-24 20:44:08', '2011-02-24 20:44:08', NULL, 0, 'Technik', '');
INSERT INTO `jx_taxonomie` VALUES(5, '2011-02-24 20:44:08', '2011-02-24 20:44:08', NULL, 0, 'Spezial', '');
INSERT INTO `jx_taxonomie` VALUES(6, '2011-02-24 20:44:27', '2011-02-24 20:44:27', NULL, 0, 'Portrait', '');
INSERT INTO `jx_taxonomie` VALUES(7, '2011-02-24 20:45:06', '2011-02-24 20:45:06', NULL, 0, 'Tiere', '');
INSERT INTO `jx_taxonomie` VALUES(8, '0000-00-00 00:00:00', '2011-02-24 20:45:06', NULL, 0, 'Digitale Kunst', '');

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
  `group_id` int(11) NOT NULL,
  `birthday` date default NULL,
  `gender` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `jx_users`
--

INSERT INTO `jx_users` VALUES(1, '2010-09-26 12:25:40', '2011-03-29 00:14:30', NULL, 'Jeanette', 'f29957e2682583a41969d05d4ecec44a', 'jeanette@jeanette-rose.de', 6, '1982-01-24', 3);
INSERT INTO `jx_users` VALUES(15, '2011-03-09 17:55:04', '2011-03-28 18:24:31', NULL, 'dasdasd', 'a8f5f167f44f4964e6c998dee827110c', 'blaaaa@blub.de', 1, '1891-07-01', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_users_loginlog`
--

CREATE TABLE `jx_users_loginlog` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=268 ;

--
-- Daten für Tabelle `jx_users_loginlog`
--

INSERT INTO `jx_users_loginlog` VALUES(267, '0000-00-00 00:00:00', '2011-03-29 12:39:50', NULL, 1, 'Jeanette');

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
-- Tabellenstruktur für Tabelle `jx_user_groups`
--

CREATE TABLE `jx_user_groups` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `jx_user_groups`
--

INSERT INTO `jx_user_groups` VALUES(1, '2011-03-28 17:31:23', '2011-03-28 17:31:23', NULL, 'Everyone');
INSERT INTO `jx_user_groups` VALUES(2, '2011-03-28 17:31:23', '2011-03-28 17:31:23', NULL, 'Registered Users');
INSERT INTO `jx_user_groups` VALUES(3, '2011-03-28 17:31:47', '2011-03-28 17:31:47', NULL, 'Group Manager');
INSERT INTO `jx_user_groups` VALUES(4, '2011-03-28 17:31:47', '2011-03-28 17:31:47', NULL, 'Moderator');
INSERT INTO `jx_user_groups` VALUES(5, '2011-03-28 17:32:03', '2011-03-28 17:32:03', NULL, 'Administrator');
INSERT INTO `jx_user_groups` VALUES(6, '2011-03-28 17:32:03', '2011-03-28 17:32:03', NULL, 'Super Admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_user_rights`
--

CREATE TABLE `jx_user_rights` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `group_id` int(11) NOT NULL,
  `modul_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `group_above` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `jx_user_rights`
--

INSERT INTO `jx_user_rights` VALUES(1, '2011-03-28 18:00:18', '2011-03-28 18:00:50', NULL, 1, 2, 'login', 0);
INSERT INTO `jx_user_rights` VALUES(2, '2011-03-28 18:00:18', '2011-03-28 18:01:01', NULL, 1, 4, 'register', 0);
INSERT INTO `jx_user_rights` VALUES(3, '2011-03-28 23:05:17', '2011-03-28 23:05:17', NULL, 2, 5, 'addGallery', 1);
INSERT INTO `jx_user_rights` VALUES(4, '2011-03-28 23:05:17', '2011-03-28 23:05:17', NULL, 2, 5, 'addImage', 1);
INSERT INTO `jx_user_rights` VALUES(5, '2011-03-28 23:05:42', '2011-03-28 23:24:19', NULL, 0, 5, 'showGallery', 1);
INSERT INTO `jx_user_rights` VALUES(6, '2011-03-28 23:05:42', '2011-03-28 23:24:19', NULL, 0, 5, 'showImage', 1);
INSERT INTO `jx_user_rights` VALUES(7, '2011-03-29 00:01:06', '2011-03-29 00:01:06', NULL, 6, 7, 'reorderModules', 0);

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

