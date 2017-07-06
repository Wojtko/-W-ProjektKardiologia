-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Lip 2017, 11:52
-- Wersja serwera: 10.1.24-MariaDB
-- Wersja PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kardio`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `patients`
--

CREATE TABLE `patients` (
  `name` text CHARACTER SET latin1 NOT NULL,
  `surname` text CHARACTER SET latin1 NOT NULL,
  `birth` text CHARACTER SET latin1 NOT NULL,
  `street` text CHARACTER SET latin1 NOT NULL,
  `town` text CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `filename` text CHARACTER SET latin1 NOT NULL,
  `status` text CHARACTER SET latin1 NOT NULL,
  `code` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `patients`
--

INSERT INTO `patients` (`name`, `surname`, `birth`, `street`, `town`, `description`, `filename`, `status`, `code`) VALUES
('Janusz', 'Kowalski', '12-03-1974', 'Gda?ska 35', '83-123 Gda?sk', 'Jest chory', '1234.jpg', '0', '1234');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `pesel` text NOT NULL,
  `nrprawa` text NOT NULL,
  `place_name` text NOT NULL,
  `email` text NOT NULL,
  `ranga` text NOT NULL,
  `first_time` text NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`name`, `surname`, `pesel`, `nrprawa`, `place_name`, `email`, `ranga`, `first_time`, `login`, `password`, `code`) VALUES
('Elon', 'Musk', '333333333', '21234', 'Medical center', 'jhsdafjhlf', '1', '0', 'admin1', 'admin1', 'ewrqew'),
('Jan', 'Adamski', '123456', '123', 'Medical Center', 'jan.adamski@gmail.com', '0', '0', 'admin', 'admin', '1234'),
('Mimi', 'Jackson', '09876543210', '67890', 'Medical Center', 'mimi.jackson@gmail.com', '3', '1', 'ada', 'ada', '123'),
('Wojciech', 'Adrych', '00261902433', '98765', 'Szpital', 'wojtek.adrych@gmail.com', '3', '0', 'cQz11f', 'zaq1', 'Bgur');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
