-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Lut 2020, 14:13
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

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
  `adres` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `ah30`
--

INSERT INTO `ah30` (`id`, `adres`, `timestamp`) VALUES
(1, '[09.26.00]', '2020-02-05 13:11:38'),
(2, '[xx.xx.xx]', '2020-02-05 13:07:03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `e100`
--

CREATE TABLE `e100` (
  `id` int(11) NOT NULL,
  `adres` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `e100`
--

INSERT INTO `e100` (`id`, `adres`, `timestamp`) VALUES
(1, '[0A.BA.1E]', '2020-02-05 13:09:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL,
  `ilosc` int(11) NOT NULL,
  `symbol` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `inventory`
--

INSERT INTO `inventory` (`id`, `nazwa`, `ilosc`, `symbol`, `timestamp`) VALUES
(1, 'E100', 1, '', '2020-02-05 13:12:29'),
(2, 'AH30', 1, '', '2020-02-05 13:12:29'),
(3, 'PINIO', 1, '', '2020-02-05 13:12:29');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `logins`
--

INSERT INTO `logins` (`id`, `mail`, `password`, `timestamp`) VALUES
(1, 'al@pinio.io', '$2y$10$cNYxv5mncnVabh/n.6rz8uFlEgfUmw5Ln.ytzlLcEoSJ9nnCrd7du', '2020-02-05 13:13:12'),
(3, 'mail@mail.pl', '$2y$10$5FGZ1ius0Wq327bMGnPYoen5oyuKb8JvDjVZ89uoNtvS5hzTRBYse', '2020-02-05 13:13:12');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ah30`
--
ALTER TABLE `ah30`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `e100`
--
ALTER TABLE `e100`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
