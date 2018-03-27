-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Mrz 2018 um 00:12
-- Server-Version: 10.1.31-MariaDB
-- PHP-Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `croque_laden_schedule`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schedule`
--

CREATE TABLE `schedule` (
  `ws_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `week` int(11) NOT NULL,
  `weekday` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `schedule`
--

INSERT INTO `schedule` (`ws_id`, `p_id`, `date`, `week`, `weekday`, `start`, `end`) VALUES
(2, 1, '2018-03-25', 22, '', '00:00:00', '00:00:00'),
(3, 4, '2018-03-26', 13, 'Tuesday', '10:00:00', '17:00:00'),
(4, 5, '2018-03-27', 13, 'Wednesday', '10:00:00', '17:00:00'),
(12, 13, '2018-03-25', 13, 'Monday', '10:00:00', '17:00:00'),
(33, 33, '2018-03-26', 13, 'Tuesday', '17:00:00', '22:30:00'),
(43, 43, '2018-03-30', 13, 'Saturday', '18:00:00', '22:30:00'),
(44, 44, '2018-03-31', 13, 'Sunday', '10:00:00', '17:00:00');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ws_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ws_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
