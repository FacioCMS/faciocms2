-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Gru 2021, 18:31
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apiauth`
--

CREATE TABLE `apiauth` (
  `id` int(11) NOT NULL,
  `token` text COLLATE utf8_polish_ci NOT NULL,
  `createdat` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `apiauth`
--

INSERT INTO `apiauth` (`id`, `token`, `createdat`) VALUES
(19, 'APIAuthToken_619fa760291d6', '1637853024'),
(20, 'APIAuthToken_61a08ff3de43a', '1637912563'),
(21, 'APIAuthToken_61a09015d7f19', '1637912597'),
(22, 'APIAuthToken_61a0903bb4f78', '1637912635'),
(23, 'APIAuthToken_61a0907917eff', '1637912697'),
(24, 'APIAuthToken_61a090a5837fd', '1637912741'),
(25, 'APIAuthToken_61a090d0b3fa6', '1637912784'),
(26, 'APIAuthToken_61a090f318521', '1637912819'),
(27, 'APIAuthToken_61a0910fededb', '1637912847'),
(28, 'APIAuthToken_61a09136a4ac0', '1637912886'),
(29, 'APIAuthToken_61a091580b0ef', '1637912920'),
(30, 'APIAuthToken_61a0f410dd8fe', '1637938192'),
(31, 'APIAuthToken_61a1044cace2b', '1637942348'),
(32, 'APIAuthToken_61a104c6703e6', '1637942470'),
(33, 'APIAuthToken_61a1df29d1b52', '1637998377'),
(34, 'APIAuthToken_61a34e1620c66', '1638092310'),
(35, 'APIAuthToken_61a37c8389e7b', '1638104195'),
(36, 'APIAuthToken_61a3845fe7922', '1638106207'),
(37, 'APIAuthToken_61a384815b712', '1638106241'),
(38, 'APIAuthToken_61a3ad2e4b79b', '1638116654'),
(39, 'APIAuthToken_61a4c14fc30f5', '1638187343'),
(40, 'APIAuthToken_61a64f547194b', '1638289236'),
(41, 'APIAuthToken_61a7d95ca4cc4', '1638390108'),
(42, 'APIAuthToken_61a8f5f8603d0', '1638462968'),
(43, 'APIAuthToken_61a9f5dd29a42', '1638528477'),
(44, 'APIAuthToken_61aa28a58430f', '1638541477'),
(45, 'APIAuthToken_61aa28ac0d871', '1638541484'),
(46, 'APIAuthToken_61aa296d0afce', '1638541677'),
(47, 'APIAuthToken_61aa29e98d467', '1638541801'),
(48, 'APIAuthToken_61ab92880165f', '1638634120'),
(49, 'APIAuthToken_61b0d72662080', '1638979366'),
(50, 'APIAuthToken_61b238294e7e9', '1639069737'),
(51, 'APIAuthToken_61b38af3cd70a', '1639156467'),
(52, 'APIAuthToken_61b38af49d019', '1639156468');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fcms-settings`
--

CREATE TABLE `fcms-settings` (
  `fcms-version` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `fcms-settings`
--

INSERT INTO `fcms-settings` (`fcms-version`, `id`) VALUES
('2.2.0', 1);

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
(41, 'Home', '\r\n            Welcome to FacioCMS. This page is default FacioCMS page. Delete it and template if you want. Hope you\'ll have great time with FacioCMS.', 'December 10, 2021, 6:22 pm', 'created using api', 'December 10, 2021, 6:14 pm', 0, 1, -1, 'page.tplc', '');

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
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '', 'admin');

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
-- Indeksy dla tabeli `fcms-settings`
--
ALTER TABLE `fcms-settings`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `apiauth`
--
ALTER TABLE `apiauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT dla tabeli `fcms-settings`
--
ALTER TABLE `fcms-settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
