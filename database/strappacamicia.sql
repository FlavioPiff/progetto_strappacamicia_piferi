-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Set 16, 2026 alle 21:00
-- Versione del server: 5.7.24
-- Versione PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `strappacamicia`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `partite`
--

CREATE TABLE `partite` (
  `id_partita` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `data_partita` datetime NOT NULL,
  `durata` int(11) NOT NULL,
  `esito` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `partite`
--

INSERT INTO `partite` (`id_partita`, `id_utente`, `data_partita`, `durata`, `esito`) VALUES
(1, 1, '2026-09-01 16:20:00', 185, 'vittoria'),
(2, 1, '2026-09-02 17:15:00', 240, 'sconfitta'),
(3, 1, '2026-09-04 18:30:00', 210, 'vittoria'),
(4, 1, '2026-09-06 15:45:00', 275, 'sconfitta'),
(5, 1, '2026-09-08 19:10:00', 195, 'vittoria'),
(6, 1, '2026-09-09 16:40:00', 225, 'sconfitta'),
(7, 1, '2026-09-10 18:05:00', 160, 'vittoria'),
(8, 1, '2026-09-11 17:25:00', 290, 'sconfitta'),
(9, 1, '2026-09-13 19:30:00', 205, 'vittoria'),
(10, 1, '2026-09-15 18:50:00', 250, 'sconfitta'),
(11, 2, '2026-09-02 15:30:00', 220, 'sconfitta'),
(12, 2, '2026-09-03 17:40:00', 180, 'vittoria'),
(13, 2, '2026-09-05 18:20:00', 260, 'vittoria'),
(14, 2, '2026-09-07 16:15:00', 200, 'vittoria'),
(15, 2, '2026-09-09 19:25:00', 245, 'sconfitta'),
(16, 2, '2026-09-10 16:50:00', 190, 'vittoria'),
(17, 2, '2026-09-11 18:10:00', 280, 'sconfitta'),
(18, 2, '2026-09-12 17:35:00', 175, 'vittoria'),
(19, 2, '2026-09-14 19:15:00', 230, 'vittoria'),
(20, 2, '2026-09-15 17:55:00', 265, 'sconfitta');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id_utente` int(11) NOT NULL,
  `nickname` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id_utente`, `nickname`, `password_hash`) VALUES
(1, 'Flavio', '$2y$10$6zsh.KTZuo3yEoQox6LmPOPLQCfPntbdhcQ0NFhEc47hFAv3935bu'),
(2, 'Marco', '$2y$10$9d3E6tJRMgJN4cnZEtP5xu4r9nMh6Nhe9s7Kv/AIqFG.FO6vuksve');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `partite`
--
ALTER TABLE `partite`
  ADD PRIMARY KEY (`id_partita`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id_utente`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `partite`
--
ALTER TABLE `partite`
  MODIFY `id_partita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `partite`
--
ALTER TABLE `partite`
  ADD CONSTRAINT `partite_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id_utente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
