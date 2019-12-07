-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 28. Nov 2019 um 14:08
-- Server-Version: 10.2.25-MariaDB-log
-- PHP-Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `movie_project`
--
CREATE DATABASE IF NOT EXISTS `movie_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `movie_project`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `genre` varchar(255) DEFAULT NULL,
    `release_year` char(4) DEFAULT NULL,
    `rating` tinyint(4) NOT NULL DEFAULT 1,
    `image` varchar(1024) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `film`
--

INSERT INTO `film` (`id`, `title`, `genre`, `release_year`, `rating`, `image`) VALUES
(1, 'ES', 'Thriller', '2017', 3, 'es.jpg'),
(2, 'A star is born', 'Drama', '2018', 4, 'a-star-is-born.jpg'),
(3, 'König der Löwen', 'Drama', '2019', 4, 'lowe.jpg'),
(4, 'Mamma Mia', 'Romanze', '2008', 3, 'mamma-mia.jpg'),
(5, 'Ziemlich beste Freunde', 'Comedy', '2011', 3, 'ziemlich-beste-freunde.jpg'),
(6, 'Inception', 'Thriller', '2010', 5, 'inception.jpg'),
(7, 'Avatar', 'Science-Fiction', '2009', 4, 'avatar.jpg'),
(8, 'Harry Potter - Stein der Weisen', 'Science-Fiction', '2001', 4, 'harry-potter.jpg'),
(9, 'Matrix', 'Science-Fiction', '1999', 5, 'matrix.jpg'),
(10, 'Das Dschungelbuch', 'Drama', '1967', 3, 'das-dschungelbuch.jpg'),
(11, 'Kein Ort ohne dich', 'Romanze', '2015', 4, 'kein-ort-ohne-dich.jpg'),
(12, 'High School Musical 1', 'Drama', '2006', 3, 'high-school-musical.jpg'),
(13, 'thrilller', 'Fantasy', '2013', 4, 'frozen.jpg'),
(14, 'Drei Schritte zu dir', 'Romanze', '2019', 3, 'drei-schritte-zu-dir.jpg'),
(15, 'Friedhof der Kuscheltiere', 'Horror', '2019', 3, 'friedhof-der-kuscheltiere.jpg'),
(16, 'Freitag der 13.', 'Horror', '2009', 3, 'freitag-der-13.jpg'),
(17, 'Shutter Island', 'Thriller', '2010', 4, 'shutter-island.jpg'),
(18, 'Aladdin', 'Fantasy', '2019', 4, 'aladdin.jpg'),
(19, 'Titanic', 'Drama', '1997', 4, 'titanic.jpg'),
(20, '17 Again', 'Drama', '2009', 3, '17-again.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `first_name` varchar(255) DEFAULT NULL,
    `last_name` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

COMMIT;

GRANT ALL ON `movie_project`.* TO 'movie_user'@'localhost' IDENTIFIED BY '#s5Py586y4%*';