-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3307
-- Timp de generare: dec. 10, 2019 la 11:09 AM
-- Versiune server: 10.3.14-MariaDB
-- Versiune PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `librarie`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_nume` text NOT NULL,
  `admin_parola` text NOT NULL,
  `ultimul_comentariu_moderat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `admin`
--

INSERT INTO `admin` (`admin_nume`, `admin_parola`, `ultimul_comentariu_moderat`) VALUES
('administrator', '8287458823facb8ff918dbfabcd22ccb', 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `branduri`
--

DROP TABLE IF EXISTS `branduri`;
CREATE TABLE IF NOT EXISTS `branduri` (
  `id_brand` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nume_brand` text CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_brand`),
  KEY `id_brand` (`id_brand`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Eliminarea datelor din tabel `branduri`
--

INSERT INTO `branduri` (`id_brand`, `nume_brand`) VALUES
(2, 'Mont Blanc'),
(1, 'Rolex'),
(3, 'BeaGift'),
(4, 'Starbucks'),
(5, 'Zara Home'),
(6, 'Pepco'),
(7, 'Apple'),
(8, 'Carturesti');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `comentarii`
--

DROP TABLE IF EXISTS `comentarii`;
CREATE TABLE IF NOT EXISTS `comentarii` (
  `id_comentariu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_produs` int(10) UNSIGNED DEFAULT 0,
  `nume_utilizator` text DEFAULT NULL,
  `adresa_email` text DEFAULT NULL,
  `comentariu` text DEFAULT NULL,
  PRIMARY KEY (`id_comentariu`),
  UNIQUE KEY `id_comentariu` (`id_comentariu`),
  KEY `id_comentariu_2` (`id_comentariu`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `comentarii`
--

INSERT INTO `comentarii` (`id_comentariu`, `id_produs`, `nume_utilizator`, `adresa_email`, `comentariu`) VALUES
(12, 3, 'beatrice', 'deac@yahoo.com', 'Acesta este un comm'),
(14, 1, 'tudor', 'tudi@gmail.com', 'foarte bun');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `domenii`
--

DROP TABLE IF EXISTS `domenii`;
CREATE TABLE IF NOT EXISTS `domenii` (
  `id_domeniu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nume_domeniu` text DEFAULT NULL,
  PRIMARY KEY (`id_domeniu`),
  UNIQUE KEY `id_domeniu` (`id_domeniu`),
  KEY `id_domeniu_2` (`id_domeniu`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `domenii`
--

INSERT INTO `domenii` (`id_domeniu`, `nume_domeniu`) VALUES
(1, 'Cadouri haioase'),
(2, 'Cadouri pentru calatorii'),
(3, 'Cadouri pentru zi de nastere'),
(4, 'Ceasuri'),
(5, 'Cadouri originale'),
(6, 'Cadouri de lux');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `produse`
--

DROP TABLE IF EXISTS `produse`;
CREATE TABLE IF NOT EXISTS `produse` (
  `id_produs` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_brand` smallint(6) NOT NULL,
  `titlu` text CHARACTER SET latin1 DEFAULT NULL,
  `descriere` text CHARACTER SET latin1 DEFAULT NULL,
  `pret` mediumint(8) UNSIGNED DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_domeniu` smallint(6) NOT NULL,
  PRIMARY KEY (`id_produs`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Eliminarea datelor din tabel `produse`
--

INSERT INTO `produse` (`id_produs`, `id_brand`, `titlu`, `descriere`, `pret`, `data`, `id_domeniu`) VALUES
(1, 1, 'Rolex gold', 'Ceas rolex, culoarea aurie, care afiseaza si zilele saptamanii', 25800, '2019-12-03 13:53:39', 4),
(2, 2, 'Pix Rollerball', 'Pix de culoare albastra, produs de lux', 1170, '2019-12-03 13:53:24', 6),
(3, 3, 'Infuzor ceai scafandru', 'Cum sa faci din activitatile de zi cu zi un moment placut cu putin de umor? Lasa scafandrul sa iti pregateasca ceaiul preferat. Nu trebuie sa il imbraci pe partenerul tau in neopren pentru a face acest lucru, ajunge sa folosesti acest Infuzor ceai scafandru. Sticla de oxigen este folosita pentru a indeparta scafandrul dupa ce si-a incheiat sarcina intr-o cana, astfel incat sa nu te uzi sau sa murdaresti masa, trebuie doar sa scoti figura pe o tava mica, care este inclusa. Acest Infuzor ceai Scafandru este un cadou frumos pentru toti iubitorii de ceai sau pentru acest sport neobisnuit.', 34, '2019-12-03 14:05:39', 5),
(4, 7, 'iphone', 'had', 75, '2019-12-04 08:41:09', 6);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tranzactii`
--

DROP TABLE IF EXISTS `tranzactii`;
CREATE TABLE IF NOT EXISTS `tranzactii` (
  `id_tranzactie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_tranzactie` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nume_cumparator` text NOT NULL,
  `adresa_cumparator` text NOT NULL,
  `comanda_onorata` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  UNIQUE KEY `id_tranzactie` (`id_tranzactie`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `tranzactii`
--

INSERT INTO `tranzactii` (`id_tranzactie`, `data_tranzactie`, `nume_cumparator`, `adresa_cumparator`, `comanda_onorata`) VALUES
(31, '2019-12-04 09:18:45', 'Beatrice', 'str silvaniei', 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `vanzari`
--

DROP TABLE IF EXISTS `vanzari`;
CREATE TABLE IF NOT EXISTS `vanzari` (
  `id_tranzactie` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `id_produs` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `nr_buc` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `vanzari`
--

INSERT INTO `vanzari` (`id_tranzactie`, `id_produs`, `nr_buc`) VALUES
(1, 2, 1),
(1, 3, 1),
(1, 4, 30),
(2, 8, 2),
(3, 24, 4),
(4, 12, 6),
(4, 5, 1),
(0, 24, 1),
(0, 20, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
