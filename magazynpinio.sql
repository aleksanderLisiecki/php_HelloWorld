-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Lut 2020, 14:54
-- Wersja serwera: 10.4.10-MariaDB
-- Wersja PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `magazynpinio`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ah30`
--

CREATE TABLE `ah30` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `available` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `ah30`
--

INSERT INTO `ah30` (`id`, `address`, `available`, `timestamp`, `add_date`) VALUES
(1, '[09.26.00]', 0, '2020-02-21 11:59:49', '2020-02-05 14:49:12'),
(2, '[xx.xx.xx]', 0, '2020-02-17 17:55:01', '2020-02-05 14:49:12'),
(3, '[12.31.23]', 0, '2020-02-21 11:22:57', '2020-02-17 18:49:36'),
(7, '[SD.FA.SD]', 0, '2020-02-21 11:59:56', '2020-02-21 11:25:43'),
(8, '[AS.DF.AS]', 0, '2020-02-21 10:43:43', '2020-02-21 11:25:46'),
(9, '[21.34.54]', 0, '2020-02-21 12:22:50', '2020-02-21 11:25:49'),
(10, '[12.34.56]', 1, '2020-02-21 10:25:52', '2020-02-21 11:25:52'),
(11, '[12.34.53]', 0, '2020-02-21 10:44:03', '2020-02-21 11:26:02'),
(12, '[12.34.55]', 1, '2020-02-21 11:00:08', '2020-02-21 12:00:08'),
(13, '[AS.4F.D2]', 1, '2020-02-21 11:00:20', '2020-02-21 12:00:20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `e100`
--

CREATE TABLE `e100` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `available` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `e100`
--

INSERT INTO `e100` (`id`, `address`, `available`, `timestamp`, `add_date`) VALUES
(1, '[0A.BA.1E]', 1, '2020-02-17 12:35:25', '2020-02-05 14:49:34'),
(2, '[xx.xx.xx]', 1, '2020-02-21 08:23:12', '2020-02-14 16:17:51'),
(3, '[AS.AD.SD]', 0, '2020-02-21 08:23:16', '2020-02-14 16:19:41'),
(4, '[12.3D.AC]', 1, '2020-02-15 13:37:35', '2020-02-14 16:19:48'),
(5, '[12.34.56]', 1, '2020-02-17 19:51:46', '2020-02-14 16:28:37'),
(6, '[12.31.23]', 1, '2020-02-17 19:52:02', '2020-02-14 16:43:09'),
(7, '[AS.DA.SD]', 1, '2020-02-15 10:42:43', '2020-02-15 11:42:43'),
(42, 'sdfsd', 1, '2020-02-17 20:08:01', '2020-02-17 21:08:01'),
(43, 'asd', 1, '2020-02-17 20:10:18', '2020-02-17 21:10:18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `symbol` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `quantity`, `symbol`, `timestamp`, `add_date`) VALUES
(1, 'E100', 8, '', '2020-02-21 08:23:16', '2020-02-05 14:48:43'),
(2, 'AH30', 3, '', '2020-02-21 12:22:50', '2020-02-05 14:48:43'),
(3, 'PINIO', 2, '', '2020-02-13 13:28:58', '2020-02-05 14:48:43'),
(4, 'Bateria', 5, 'Philips003', '2020-02-13 13:28:52', '2020-02-11 20:46:07'),
(5, 'Karta pamięci', 1, 'memXD', '2020-02-13 13:00:41', '2020-02-13 12:40:48'),
(6, 'Test', 1, 't1', '2020-02-13 14:29:46', '2020-02-13 15:29:46'),
(7, 'test2', 1, '', '2020-02-21 10:31:06', '2020-02-21 11:31:06');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `logins`
--

INSERT INTO `logins` (`id`, `mail`, `password`, `timestamp`, `add_date`) VALUES
(1, 'al@pinio.io', '$2y$10$cNYxv5mncnVabh/n.6rz8uFlEgfUmw5Ln.ytzlLcEoSJ9nnCrd7du', '2020-02-05 13:46:04', '2020-02-05 14:23:00'),
(3, 'mail@mail.pl', '$2y$10$5FGZ1ius0Wq327bMGnPYoen5oyuKb8JvDjVZ89uoNtvS5hzTRBYse', '2020-02-05 13:22:24', '2020-02-05 14:22:15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pinio`
--

CREATE TABLE `pinio` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `available` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pinio`
--

INSERT INTO `pinio` (`id`, `address`, `available`, `timestamp`, `add_date`) VALUES
(1, '[12.31.23]', 1, '2020-02-21 11:22:57', '2020-02-21 12:22:57'),
(2, '[09.26.00]', 1, '2020-02-21 11:59:49', '2020-02-21 12:59:49'),
(3, '[SD.FA.SD]', 1, '2020-02-21 11:59:56', '2020-02-21 12:59:56'),
(4, '[21.34.54]', 1, '2020-02-21 12:22:50', '2020-02-21 13:22:50');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sets`
--

CREATE TABLE `sets` (
  `id` int(11) NOT NULL,
  `e100` int(11) NOT NULL,
  `pinio` int(11) NOT NULL,
  `mask-in` int(11) NOT NULL,
  `mask-out` int(11) NOT NULL,
  `trzpien` text NOT NULL,
  `pad` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ah30`
--
ALTER TABLE `ah30`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `e100`
--
ALTER TABLE `e100`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pinio`
--
ALTER TABLE `pinio`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `sets`
--
ALTER TABLE `sets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `ah30`
--
ALTER TABLE `ah30`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `e100`
--
ALTER TABLE `e100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT dla tabeli `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `pinio`
--
ALTER TABLE `pinio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `sets`
--
ALTER TABLE `sets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
