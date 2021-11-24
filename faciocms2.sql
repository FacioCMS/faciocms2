-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Lis 2021, 16:29
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `faciocms2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `addons`
--

CREATE TABLE `addons` (
  `id` int(11) NOT NULL,
  `pageid` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `value` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `addons`
--

INSERT INTO `addons` (`id`, `pageid`, `name`, `value`) VALUES
(1, 1, 'test', '1000');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apiauth`
--

CREATE TABLE `apiauth` (
  `id` int(11) NOT NULL,
  `token` text COLLATE utf8_polish_ci NOT NULL,
  `createdat` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fcms-settings`
--

CREATE TABLE `fcms-settings` (
  `fcms-version` varchar(64) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `fcms-settings`
--

INSERT INTO `fcms-settings` (`fcms-version`) VALUES
('2.0.0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `lasteditedat` text COLLATE utf8_polish_ci NOT NULL,
  `lasteditedby` text COLLATE utf8_polish_ci NOT NULL,
  `createdat` text COLLATE utf8_polish_ci NOT NULL,
  `deleted` int(11) NOT NULL,
  `isDefault` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `template` text COLLATE utf8_polish_ci NOT NULL,
  `link` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pages`
--

INSERT INTO `pages` (`id`, `name`, `content`, `lasteditedat`, `lasteditedby`, `createdat`, `deleted`, `isDefault`, `parentid`, `template`, `link`) VALUES
(1, 'page1', '\r\n                            \r\n                            \r\n                            \r\n                            \r\n                            <b>Living </b><i style=\"\">like </i><u style=\"\">lovers</u>                        ', '16.11.2021 21:09', 'Admin', '16.11.2021', 0, 1, -1, 'page.tplc', 'home');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seo`
--

CREATE TABLE `seo` (
  `author` text COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `keywords` text COLLATE utf8_polish_ci NOT NULL,
  `ogtitle` text COLLATE utf8_polish_ci NOT NULL,
  `ogtype` text COLLATE utf8_polish_ci NOT NULL,
  `ogimage` text COLLATE utf8_polish_ci NOT NULL,
  `ogurl` text COLLATE utf8_polish_ci NOT NULL,
  `oglocale` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `seo`
--

INSERT INTO `seo` (`author`, `description`, `keywords`, `ogtitle`, `ogtype`, `ogimage`, `ogurl`, `oglocale`) VALUES
('Maciej Dębowski', 'A website created using FacioCMS ', '', 'A website created using FacioCMS', 'poster', '', '', 'en-US');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `lastlogin` text COLLATE utf8_polish_ci NOT NULL,
  `permissions` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `lastlogin`, `permissions`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `apiauth`
--
ALTER TABLE `apiauth`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `apiauth`
--
ALTER TABLE `apiauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
