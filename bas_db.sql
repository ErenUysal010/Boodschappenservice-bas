-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 jun 2023 om 11:14
-- Serverversie: 8.0.28
-- PHP-versie: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bas_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelen`
--

CREATE TABLE `artikelen` (
  `artId` int NOT NULL,
  `artOmschrijving` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `artInkoop` decimal(3,2) DEFAULT NULL,
  `artVerkoop` decimal(3,2) DEFAULT NULL,
  `artVoorraad` int NOT NULL,
  `artMinVoorraad` int NOT NULL,
  `artMaxVoorraad` int NOT NULL,
  `levId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikelen`
--

INSERT INTO `artikelen` (`artId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `levId`) VALUES
(2, 'melk', '1.00', '1.50', 100, 10, 500, 1),
(3, 'brood', '1.00', '1.50', 100, 30, 1000, NULL),
(4, 'wc-papier', '5.00', '9.50', 100, 30, 1000, NULL),
(5, 'eieren', '0.50', '1.00', 600, 100, 1000, NULL),
(6, 'test', '1.00', '1.50', 100, 30, 1000, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkooporder`
--

CREATE TABLE `inkooporder` (
  `inkId` int NOT NULL,
  `levId` int DEFAULT NULL,
  `artId` int DEFAULT NULL,
  `inkOrdDatum` date DEFAULT NULL,
  `inkOrdBestAantal` int DEFAULT NULL,
  `inkOrdStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `inkooporder`
--

INSERT INTO `inkooporder` (`inkId`, `levId`, `artId`, `inkOrdDatum`, `inkOrdBestAantal`, `inkOrdStatus`) VALUES
(1, 2, 4, '2023-06-08', 10, '1'),
(3, 1, 5, '2023-06-08', 400, '2'),
(4, 3, 3, '2023-06-08', 1, '2'),
(5, 1, 2, '2023-06-14', 1000, '2'),
(6, 3, 2, '2023-06-14', 30, '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int NOT NULL,
  `klantNaam` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `klantEmail` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `klantAdres` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `klantPostcode` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `klantWoonplaats` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(2, 'test2', 'test1@test.nl', 'testAdres', 'test01', 'testWoonplaats'),
(5, 'pieter', 'test@test.nl', 'testAdres', 'Test', 'Rotterdam'),
(6, 'Eren', 'test@test.nl', 'testAdres', 'Test', 'Rotterdam'),
(8, 'piet', 'test@test.nl', 'testAdres', 'Test', 'Rotterdam'),
(9, 'hans', 'test@test.nl', 'testAdres', 'Test', 'Rotterdam'),
(10, 'Jan Jansen', 'jan.jansen@example.com', 'Hoofdstraat 123', '1234AB', 'Amsterdam'),
(11, 'Sarah Smith', 'sarah.smith@example.com', 'Elm Street 45', '5678CD', 'New York'),
(12, 'María García', 'maria.garcia@example.com', 'Calle Mayor 67', '1234AB', 'Madrid'),
(13, 'Hans Müller', 'hans.mueller@example.com', 'Hauptstraße 1', '98765', 'Berlijn'),
(14, 'Hans Müller', 'hans.mueller@example.com', 'Hauptstraße 1', '98765', 'Berlijn'),
(15, 'Eren', 'test@test.nl', 'testAdres', 'Test', 'Rotterdam'),
(16, 'Eren', 'test@test.nl', 'testAdres', 'Test12', 'Rotterdam'),
(18, 'qaz', 'test@test.nl', 'testAdres', 'Test02', 'Rotterdam');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leveranciers`
--

CREATE TABLE `leveranciers` (
  `levId` int NOT NULL,
  `levNaam` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `levContact` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `levEmail` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `levAdres` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `levPostcode` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `levWoonplaats` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leveranciers`
--

INSERT INTO `leveranciers` (`levId`, `levNaam`, `levContact`, `levEmail`, `levAdres`, `levPostcode`, `levWoonplaats`) VALUES
(1, 'De Boer', '0612345678', 'boer@live.nl', 'AdresBoer', '0000AA', 'Rotterdam'),
(2, 'De Haven', '0698765432', 'haven@live.nl', 'DeHaven', '3030AB', 'Rotterdam'),
(3, 'test', '0123645', 'test@test.nl', 'testAdres', 'Test', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkooporder`
--

CREATE TABLE `verkooporder` (
  `klantId` int NOT NULL,
  `artId` int NOT NULL,
  `verkOrdId` int NOT NULL,
  `verkOrdDatum` date DEFAULT NULL,
  `verkOrdBestAantal` int DEFAULT NULL,
  `verkOrdStatus` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verkooporder`
--

INSERT INTO `verkooporder` (`klantId`, `artId`, `verkOrdId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`) VALUES
(5, 4, 43, '2023-06-08', 2, 1),
(6, 3, 41, '2023-06-07', 2, 4),
(8, 2, 42, '2023-06-08', 10, 1),
(9, 2, 37, '2023-06-06', 2, 1),
(10, 3, 44, '2023-06-14', 2, 1),
(12, 2, 39, '2023-06-06', 2, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD PRIMARY KEY (`artId`),
  ADD KEY `levId` (`levId`);

--
-- Indexen voor tabel `inkooporder`
--
ALTER TABLE `inkooporder`
  ADD PRIMARY KEY (`inkId`),
  ADD KEY `levId` (`levId`),
  ADD KEY `artId` (`artId`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  ADD PRIMARY KEY (`levId`);

--
-- Indexen voor tabel `verkooporder`
--
ALTER TABLE `verkooporder`
  ADD PRIMARY KEY (`klantId`,`artId`),
  ADD UNIQUE KEY `verkOrdId` (`verkOrdId`),
  ADD KEY `artId` (`artId`),
  ADD KEY `klantId` (`klantId`),
  ADD KEY `klantId_2` (`klantId`,`artId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikelen`
--
ALTER TABLE `artikelen`
  MODIFY `artId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `inkooporder`
--
ALTER TABLE `inkooporder`
  MODIFY `inkId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT voor een tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  MODIFY `levId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `verkooporder`
--
ALTER TABLE `verkooporder`
  MODIFY `verkOrdId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD CONSTRAINT `artikelen_ibfk_1` FOREIGN KEY (`levId`) REFERENCES `leveranciers` (`levId`);

--
-- Beperkingen voor tabel `inkooporder`
--
ALTER TABLE `inkooporder`
  ADD CONSTRAINT `inkooporder_ibfk_1` FOREIGN KEY (`levId`) REFERENCES `leveranciers` (`levId`),
  ADD CONSTRAINT `inkooporder_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikelen` (`artId`);

--
-- Beperkingen voor tabel `verkooporder`
--
ALTER TABLE `verkooporder`
  ADD CONSTRAINT `verkooporder_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`),
  ADD CONSTRAINT `verkooporder_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikelen` (`artId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
