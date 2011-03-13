-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 06. Oktober 2010 um 21:14
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

DROP TABLE IF EXISTS `jx_modul`;
CREATE TABLE `jx_modul` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `path` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `jx_modul`
--

INSERT INTO `jx_modul` (`id`, `created`, `edited`, `deleted`, `path`, `title`) VALUES
(1, '2010-09-19 16:01:49', '2010-09-20 10:52:02', NULL, 'navigationbar', 'Navi'),
(2, '2010-09-26 12:36:05', '2010-09-26 12:36:05', NULL, 'login', 'Login'),
(3, '2010-09-26 14:25:03', '2010-09-26 14:25:03', NULL, 'onlineuser', 'Online User');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_modul_to_slots`
--

DROP TABLE IF EXISTS `jx_modul_to_slots`;
CREATE TABLE `jx_modul_to_slots` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `modul_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `modul_id` (`modul_id`),
  KEY `slot_id` (`slot_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `jx_modul_to_slots`
--

INSERT INTO `jx_modul_to_slots` (`id`, `created`, `edited`, `deleted`, `modul_id`, `slot_id`) VALUES
(1, '2010-09-26 11:40:25', '2010-09-26 11:40:25', NULL, 1, 2),
(2, '2010-09-26 11:40:25', '2010-09-26 11:40:25', NULL, 1, 6),
(3, '2010-09-26 12:36:34', '2010-09-26 12:36:34', NULL, 2, 3),
(4, '2010-09-26 14:25:23', '2010-09-26 14:25:23', NULL, 3, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_sites`
--

DROP TABLE IF EXISTS `jx_sites`;
CREATE TABLE `jx_sites` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `site_id` int(11) default NULL,
  `navigationorder` int(11) NOT NULL,
  `path` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `site_id` (`site_id`),
  KEY `navigationorder` (`navigationorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `jx_sites`
--

INSERT INTO `jx_sites` (`id`, `created`, `edited`, `deleted`, `site_id`, `navigationorder`, `path`, `title`) VALUES
(1, '2010-09-19 12:27:44', '2010-09-19 17:46:36', NULL, 0, 5, 'index', 'Startseite'),
(2, '2010-09-19 14:25:33', '2010-09-19 16:53:15', NULL, 0, 0, 'impressum', 'Impressum & AGB'),
(3, '2010-09-19 17:40:45', '2010-09-19 19:16:45', NULL, 1, 0, 'untermenupunkt', 'Unter Menu Punkt'),
(4, '2010-09-19 17:42:09', '2010-09-19 17:42:09', NULL, NULL, 0, 'nichtInDerNavigation', 'nichtInDerNavigation'),
(5, '2010-09-19 20:00:30', '2010-09-19 20:00:56', NULL, 0, 6, 'kontakt', 'Kontakt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_slots`
--

DROP TABLE IF EXISTS `jx_slots`;
CREATE TABLE `jx_slots` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `site_id` int(11) NOT NULL,
  `slottype_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `jx_slots`
--

INSERT INTO `jx_slots` (`id`, `created`, `edited`, `deleted`, `site_id`, `slottype_id`) VALUES
(1, '2010-09-19 15:15:45', '2010-09-26 12:01:56', NULL, 1, 1),
(2, '2010-09-19 15:16:10', '2010-09-26 12:01:56', NULL, 1, 2),
(3, '2010-09-19 15:16:10', '2010-09-26 12:01:56', NULL, 1, 3),
(4, '2010-09-19 15:16:30', '2010-09-26 12:01:56', NULL, 1, 4),
(5, '2010-09-19 15:16:30', '2010-09-26 12:01:56', NULL, 1, 5),
(6, '2010-09-26 11:39:53', '2010-09-26 12:01:56', NULL, 2, 1),
(7, '2010-09-26 11:49:24', '2010-09-26 12:01:56', NULL, 2, 2),
(8, '2010-09-26 11:49:45', '2010-09-26 12:01:56', NULL, 2, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_slottypes`
--

DROP TABLE IF EXISTS `jx_slottypes`;
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

INSERT INTO `jx_slottypes` (`id`, `created`, `edited`, `deleted`, `title`) VALUES
(1, '2010-09-19 15:15:45', '2010-09-19 20:25:26', NULL, 'header'),
(2, '2010-09-19 15:16:10', '2010-09-19 20:25:26', NULL, 'sidebar_left'),
(3, '2010-09-19 15:16:10', '2010-09-19 20:25:26', NULL, 'sidebar_right'),
(4, '2010-09-19 15:16:30', '2010-09-19 20:25:26', NULL, 'content'),
(5, '2010-09-19 15:16:30', '2010-09-19 20:25:26', NULL, 'footer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_users`
--

DROP TABLE IF EXISTS `jx_users`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `jx_users`
--

INSERT INTO `jx_users` (`id`, `created`, `edited`, `deleted`, `username`, `password`, `email`, `birthday`, `gender`) VALUES
(1, '2010-09-26 12:25:40', '2010-09-26 12:25:57', NULL, 'Jeanette', 'f29957e2682583a41969d05d4ecec44a', 'jeanette@jeanette-rose.de', '1982-01-24', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jx_user_gender`
--

DROP TABLE IF EXISTS `jx_user_gender`;
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

INSERT INTO `jx_user_gender` (`id`, `created`, `edited`, `deleted`, `title`) VALUES
(1, '2010-09-26 12:23:18', '2010-09-26 12:23:18', NULL, 'Mann'),
(2, '2010-09-26 12:23:18', '2010-09-26 12:23:18', NULL, 'Frau'),
(3, '2010-09-26 12:23:41', '2010-09-26 12:23:41', NULL, 'Transgender MzF'),
(4, '2010-09-26 12:23:41', '2010-09-26 12:23:41', NULL, 'Transgender FzM'),
(5, '2010-09-26 12:23:51', '2010-09-26 12:23:51', NULL, 'Androgyn');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leer`
--

DROP TABLE IF EXISTS `leer`;
CREATE TABLE `leer` (
  `id` int(11) NOT NULL auto_increment,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `deleted` timestamp NULL default NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `leer`
--

