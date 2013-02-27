-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vygenerováno: Stř 27. úno 2013, 15:19
-- Verze MySQL: 5.5.27
-- Verze PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `firma`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `firma`
--

CREATE TABLE IF NOT EXISTS `firma` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) NOT NULL,
  `adresa` varchar(45) NOT NULL,
  `mesto` varchar(45) NOT NULL,
  `psc` varchar(45) NOT NULL,
  `jmeno_jednatele` varchar(45) NOT NULL,
  `ico` int(10) unsigned NOT NULL,
  `dic` varchar(45) NOT NULL,
  `telefon` int(9) unsigned NOT NULL,
  `email` varchar(45) NOT NULL,
  `dph` tinyint(1) NOT NULL,
  `mesicni_naklady` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `firma`
--

INSERT INTO `firma` (`id`, `nazev`, `adresa`, `mesto`, `psc`, `jmeno_jednatele`, `ico`, `dic`, `telefon`, `email`, `dph`, `mesicni_naklady`) VALUES
(1, 'IBM', 'Technického 5', 'Brno', '60200', 'Jaromír Kovařík', 25623219, 'cz523751', 256145698, 'jaromirkovarik@ibm.cz', 1, 2500000),
(2, 'RedHat', 'Dřevařova 341', 'Praha', '10200', 'Stanislav Malý', 52371265, 'cz628351', 325452658, 'stanislavmaly@redhat.cz', 0, 725000);

-- --------------------------------------------------------

--
-- Struktura tabulky `pobocka`
--

CREATE TABLE IF NOT EXISTS `pobocka` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) NOT NULL,
  `adresa` varchar(45) NOT NULL,
  `telefon` int(9) unsigned NOT NULL,
  `email` varchar(45) NOT NULL,
  `mesto` varchar(45) NOT NULL,
  `psc` varchar(45) NOT NULL,
  `firma_id` int(10) unsigned NOT NULL,
  `mesicni_naklady` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pobocka_firma1_idx` (`firma_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `pobocka`
--

INSERT INTO `pobocka` (`id`, `nazev`, `adresa`, `telefon`, `email`, `mesto`, `psc`, `firma_id`, `mesicni_naklady`) VALUES
(1, 'IBM Brno', 'Technického 5', 125369456, 'jiriskocil@ibm.cz', 'Brno', '60200', 1, 251000),
(2, 'IBM Praha', 'Křídlovická 1', 125478963, 'jakubskrivan@ibm.cz', 'Praha', '10200', 1, 130000),
(3, 'RedHat Ostrava', 'Černého 10', 256321458, 'martinsvihly@redhat.cz', 'Ostrava', '12600', 2, 324100);

-- --------------------------------------------------------

--
-- Struktura tabulky `pobocka_vybaveni`
--

CREATE TABLE IF NOT EXISTS `pobocka_vybaveni` (
  `pobocka_id` int(10) unsigned NOT NULL,
  `vybaveni_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pobocka_id`,`vybaveni_id`),
  KEY `fk_pobocka_vybaveni_pobocka1_idx` (`pobocka_id`),
  KEY `fk_pobocka_vybaveni_vybaveni1_idx` (`vybaveni_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `pobocka_vybaveni`
--

INSERT INTO `pobocka_vybaveni` (`pobocka_id`, `vybaveni_id`) VALUES
(1, 1),
(1, 2),
(1, 5),
(1, 7),
(3, 4),
(3, 6),
(3, 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `pobocka_zamestnanec`
--

CREATE TABLE IF NOT EXISTS `pobocka_zamestnanec` (
  `zamestnanec_id1` int(10) unsigned NOT NULL,
  `pobocka_id1` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pobocka_id1`,`zamestnanec_id1`),
  KEY `fk_pobocka_zamestnanec_zamestnanec1_idx` (`zamestnanec_id1`),
  KEY `fk_pobocka_zamestnanec_pobocka1_idx` (`pobocka_id1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `pobocka_zamestnanec`
--

INSERT INTO `pobocka_zamestnanec` (`zamestnanec_id1`, `pobocka_id1`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 3),
(6, 1),
(7, 2),
(8, 3),
(9, 1),
(9, 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `skupina`
--

CREATE TABLE IF NOT EXISTS `skupina` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(25) NOT NULL,
  `plat_od` int(11) NOT NULL,
  `plat_do` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `skupina`
--

INSERT INTO `skupina` (`id`, `nazev`, `plat_od`, `plat_do`) VALUES
(1, 'junior', 15000, 20000),
(2, 'pokročilý', 20000, 26000),
(3, 'senior programátor', 26000, 32000),
(4, 'geek', 32000, 100000);

-- --------------------------------------------------------

--
-- Struktura tabulky `vybaveni`
--

CREATE TABLE IF NOT EXISTS `vybaveni` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Vypisuji data pro tabulku `vybaveni`
--

INSERT INTO `vybaveni` (`id`, `nazev`) VALUES
(1, 'kopírka'),
(2, 'počítač'),
(3, 'tabule'),
(4, 'projektor'),
(5, 'kávovar'),
(6, 'automat na kávu'),
(7, 'vařič'),
(8, 'mikrovlnka');

-- --------------------------------------------------------

--
-- Struktura tabulky `zamestnanec`
--

CREATE TABLE IF NOT EXISTS `zamestnanec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `age` tinyint(3) unsigned NOT NULL,
  `payment` int(10) unsigned NOT NULL,
  `request` tinyint(1) NOT NULL,
  `skupina_id` int(10) unsigned NOT NULL,
  `firma_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_zamestnanec_skupina1_idx` (`skupina_id`),
  KEY `fk_zamestnanec_firma1_idx` (`firma_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Vypisuji data pro tabulku `zamestnanec`
--

INSERT INTO `zamestnanec` (`id`, `name`, `age`, `payment`, `request`, `skupina_id`, `firma_id`) VALUES
(1, 'Marie Majerová', 43, 24000, 0, 2, 1),
(2, 'Jakub Skoumal', 16, 27000, 0, 3, 1),
(3, 'Martin Dostál', 34, 65000, 1, 4, 1),
(4, 'Anna Kareninová', 65, 21000, 0, 1, 2),
(5, 'Lucie Krásná', 21, 18000, 1, 1, 1),
(6, 'Roman Zabloudil', 51, 22000, 1, 3, NULL),
(7, 'Maxmilián Navrátil', 31, 22000, 0, 4, 2),
(8, 'Jan Pospíšil', 28, 23500, 1, 2, 2),
(9, 'Martina Nehezká', 24, 16300, 0, 3, 1);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `pobocka`
--
ALTER TABLE `pobocka`
  ADD CONSTRAINT `fk_pobocka_firma1` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `pobocka_vybaveni`
--
ALTER TABLE `pobocka_vybaveni`
  ADD CONSTRAINT `fk_pobocka_vybaveni_pobocka1` FOREIGN KEY (`pobocka_id`) REFERENCES `pobocka` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pobocka_vybaveni_vybaveni1` FOREIGN KEY (`vybaveni_id`) REFERENCES `vybaveni` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `pobocka_zamestnanec`
--
ALTER TABLE `pobocka_zamestnanec`
  ADD CONSTRAINT `fk_pobocka_zamestnanec_zamestnanec1` FOREIGN KEY (`zamestnanec_id1`) REFERENCES `zamestnanec` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pobocka_zamestnanec_pobocka1` FOREIGN KEY (`pobocka_id1`) REFERENCES `pobocka` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `zamestnanec`
--
ALTER TABLE `zamestnanec`
  ADD CONSTRAINT `fk_zamestnanec_skupina1` FOREIGN KEY (`skupina_id`) REFERENCES `skupina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zamestnanec_firma1` FOREIGN KEY (`firma_id`) REFERENCES `firma` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
