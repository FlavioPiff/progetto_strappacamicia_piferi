-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Set 12, 2026 alle 23:13
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
(1, 'Flavio', '$2y$10$6zsh.KTZuo3yEoQox6LmPOPLQCfPntbdhcQ0NFhEc47hFAv3935bu');

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
  MODIFY `id_partita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
