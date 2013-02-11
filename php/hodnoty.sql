-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vygenerováno: Stř 30. led 2013, 12:15
-- Verze MySQL: 5.5.27
-- Verze PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `zamestnaci`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `hodnoty`
--

CREATE TABLE IF NOT EXISTS `hodnoty` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `age` tinyint(4) unsigned NOT NULL,
  `payment` int(6) NOT NULL,
  `request` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=15 ;

--
-- Vypisuji data pro tabulku `hodnoty`
--

INSERT INTO `hodnoty` (`id`, `name`, `age`, `payment`, `request`) VALUES
(2, 'Marie Majerová', 43, 0, 0),
(3, 'Jakub Skoumal', 16, 60000, 0),
(4, 'Martin Dostál', 34, 18000, 1),
(5, 'Anna Kareninová', 65, 20000, 0),
(6, 'Lucie Krásná', 21, 12000, 1),
(7, 'Roman Zabloudil', 51, 19000, 1),
(8, 'Maxmilián Navrátil', 31, 23000, 0),
(9, 'Jan Pospíšil', 28, 19000, 1),
(10, 'Martina Nehezká', 24, 14000, 0),
(11, 'Jan Stoffer', 24, 15000, 1),
(14, 'Jakub Skoumal', 31, 60000, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
