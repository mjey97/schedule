-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db731643354.db.1and1.com
-- Erstellungszeit: 03. Apr 2018 um 03:30
-- Server Version: 5.5.59-0+deb7u1-log
-- PHP-Version: 5.4.45-0+deb7u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `db731643354`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `ws_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `week` int(11) NOT NULL,
  `weekday` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ws_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Daten für Tabelle `schedule`
--

INSERT INTO `schedule` (`ws_id`, `p_id`, `date`, `week`, `weekday`, `start`, `end`, `name`) VALUES
(2, 1, '2018-03-25', 22, '', '00:00:00', '00:00:00', 'Thomas'),
(3, 4, '2018-03-26', 13, 'Tuesday', '10:00:00', '17:00:00', 'Marcel'),
(4, 5, '2018-03-27', 13, 'Wednesday', '10:00:00', '17:00:00', 'Julia'),
(12, 13, '2018-03-25', 13, 'Monday', '10:00:00', '17:00:00', 'Sandra'),
(33, 33, '2018-03-26', 13, 'Tuesday', '17:00:00', '22:30:00', 'Alina'),
(43, 43, '2018-03-30', 13, 'Saturday', '18:00:00', '22:30:00', 'Jenny'),
(44, 44, '2018-03-31', 13, 'Sunday', '10:00:00', '17:00:00', 'Tibo'),
(45, 0, '2018-04-03', 14, 'Tuesday', '10:00:00', '17:00:00', 'Tomas'),
(46, 1, '2018-04-02', 14, 'Monday', '10:00:00', '17:00:00', 'Emma'),
(47, 1, '2018-04-02', 14, 'Monday', '17:00:00', '23:00:00', 'Finn'),
(48, 0, '2018-04-04', 14, 'Wednesday', '10:00:00', '17:00:00', 'Amy'),
(49, 1, '2018-04-05', 14, 'Thusday', '10:00:00', '17:00:00', 'Lui'),
(50, 1, '2018-04-08', 14, 'Sunday', '18:00:00', '23:00:00', 'Max');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
