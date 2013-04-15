-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vygenerováno: Pon 15. dub 2013, 17:29
-- Verze MySQL: 5.5.27
-- Verze PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `xml`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `firma`
--

CREATE TABLE IF NOT EXISTS `firma` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `firma`
--

INSERT INTO `firma` (`id`, `nazev`) VALUES
(1, 'Microsoft'),
(2, 'Red Hat'),
(3, 'IBM');

-- --------------------------------------------------------

--
-- Struktura tabulky `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `plat` int(10) unsigned NOT NULL,
  `telefon` int(9) unsigned NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `www` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `platova_trida_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=20 ;

--
-- Vypisuji data pro tabulku `person`
--

INSERT INTO `person` (`id`, `jmeno`, `plat`, `telefon`, `email`, `www`, `platova_trida_id`) VALUES
(1, 'Jan', 45000, 123456789, 'honza@gmail.com', 'http://honza.com', 2),
(2, 'Jakub', 65000, 456789123, 'jakub@yahoo.com', 'http://jakub.eu', 3),
(3, 'Martin', 19000, 789123456, 'martin@seznam.cz', 'http://martin.cz', 1),
(4, 'Michal', 12000, 741852963, 'michal@gmail.com', 'http://michal.com', 1),
(5, 'Jiri', 30000, 852963741, 'jiri@russian.ru', 'http://jiri.ru', 2),
(6, 'Adrian', 24000, 963741852, 'adrian@gmail.com', 'http://adrian.com', 2),
(7, 'marek', 45000, 123456789, 'marek@gmail.com', 'http://marek.com', 2),
(8, 'stanislav', 85000, 456789123, 'stanislav@yahoo.com', 'http://stanislav.eu', 3),
(9, 'cestmir', 19000, 789123456, 'cestmir@seznam.cz', 'http://cestmir.cz', 1),
(10, 'anna', 12000, 741852963, 'anna@gmail.com', 'http://anna.com', 1),
(11, 'doubravka', 30000, 852963741, 'doubravka@russian.ru', 'http://doubravka.ru', 2),
(12, 'lenka', 24000, 963741852, 'lenka@gmail.com', 'http://lenka.com', 2),
(13, 'vladislav', 45000, 123456789, 'vladislav@gmail.com', 'http://vladislav.com', 2),
(14, 'karel', 85000, 456789123, 'karel@yahoo.com', 'http://karel.eu', 3),
(15, 'cestmir', 19000, 789123456, 'cestmir@seznam.cz', 'http://cestmir.cz', 1),
(16, 'martina', 12000, 741852963, 'martina@gmail.com', 'http://martina.com', 1),
(17, 'eva', 30000, 852963741, 'eva@russian.ru', 'http://eva.ru', 2),
(19, 'pepa', 15000, 777666999, 'pepa@seznam.cz', 'http://pepa.cz', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `person_firma`
--

CREATE TABLE IF NOT EXISTS `person_firma` (
  `person_id` int(10) unsigned NOT NULL,
  `firma_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `person_firma`
--

INSERT INTO `person_firma` (`person_id`, `firma_id`) VALUES
(1, 2),
(1, 3),
(2, 2),
(3, 1),
(4, 2),
(5, 1),
(6, 3),
(6, 2),
(7, 1),
(8, 2),
(9, 3),
(10, 1),
(11, 2),
(12, 1),
(12, 2),
(12, 3),
(13, 2),
(14, 3),
(15, 3),
(16, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `platova_trida`
--

CREATE TABLE IF NOT EXISTS `platova_trida` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trida` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `platova_trida`
--

INSERT INTO `platova_trida` (`id`, `trida`) VALUES
(1, 'nizka platova trida'),
(2, 'stredni platova trida'),
(3, 'vysoka platova trida');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
