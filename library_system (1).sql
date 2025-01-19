-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 22, 2024 at 08:19 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_system`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bibliotekarze`
--

CREATE TABLE `bibliotekarze` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Haslo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `bibliotekarze`
--

INSERT INTO `bibliotekarze` (`id`, `email`, `Haslo`) VALUES
(0, 'mxtys@gmail.com', 'Mati'),
(1, 'mxtys@gmail.com', 'Mati'),
(2, 'mxtys@gmail.com', 'Mxtys1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `czytelnicy`
--

CREATE TABLE `czytelnicy` (
  `id` int(11) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `czytelnicy`
--

INSERT INTO `czytelnicy` (`id`, `nazwisko`, `haslo`, `email`) VALUES
(1, 'Motyl', 'Andzik06', 'motyl@gmail.com'),
(2, 'Krepsztul', 'Krepusz', 'michal123@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazka`
--

CREATE TABLE `ksiazka` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `ksiazka`
--

INSERT INTO `ksiazka` (`id`, `tytul`, `autor`, `ilosc`) VALUES
(1, 'Mały Książę', 'Antoine de Saint-Exupéry\r\n', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `id` int(11) NOT NULL,
  `id_osoby` int(11) NOT NULL,
  `tytul_ksiazki` varchar(255) NOT NULL,
  `id_ksiazki` int(11) NOT NULL,
  `data_wypozyczenia` date NOT NULL,
  `data_terminu_oddania` date NOT NULL,
  `status` enum('oddana','nie') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id`, `id_osoby`, `tytul_ksiazki`, `id_ksiazki`, `data_wypozyczenia`, `data_terminu_oddania`, `status`) VALUES
(1, 1, 'Mały Książę', 1, '2024-11-20', '2024-11-23', 'oddana'),
(2, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'oddana'),
(3, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'oddana'),
(4, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'oddana'),
(5, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'oddana'),
(6, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'oddana'),
(7, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(8, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(9, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(10, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(11, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(12, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(13, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(14, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(15, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(16, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(17, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(18, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(19, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(20, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(21, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(22, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(23, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie'),
(24, 1, 'Mały Książę', 1, '2024-11-22', '2024-11-29', 'nie');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `czytelnicy`
--
ALTER TABLE `czytelnicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_osoby` (`id_osoby`),
  ADD KEY `id_ksiazki` (`id_ksiazki`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `czytelnicy`
--
ALTER TABLE `czytelnicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ksiazka`
--
ALTER TABLE `ksiazka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`id_osoby`) REFERENCES `czytelnicy` (`id`),
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`id_ksiazki`) REFERENCES `ksiazka` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
