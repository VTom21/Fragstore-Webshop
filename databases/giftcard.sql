-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Nov 05. 14:02
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `giftcards`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `giftcard`
--

CREATE TABLE `giftcard` (
  `CardId` varchar(50) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IMG` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `giftcard`
--

INSERT INTO `giftcard` (`CardId`, `Name`, `IMG`, `Price`, `Region`) VALUES
('AMZ25EUR', 'Amazon Gift Card 25 EUR', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fmagzoid.com%2Famazon-unveils-first-major-logo-redesign-in-20-years%2F&psig=AOvVaw0v4EzLMg_P4BYHQFW286xo&ust=1762433874375000&source=images&cd=vfe&opi=89978449&ved=0CBUQjRxqFwoTCOiXwvKH25ADFQAAAAAdAAAAABBr', 25.00, 'EUR'),
('GPLHUF5K', 'Google Play 20 USD', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.amazon.com%2FGoogle-Play-Gift-Code-mail%2Fdp%2FB074T91QTZ&psig=AOvVaw28s4kPNfuWAtA5VML-BWrW&ust=1762433756520000&source=images&cd=vfe&opi=89978449&ved=0CBUQjRxqFwoTCKCm8LqH25ADFQAAAAAdAAAAABAX', 20.00, 'USD'),
('NFLX30USD', 'Netflix Gift Card 30 USD', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fbrand.netflix.com%2Fen%2Fterms%2F&psig=AOvVaw08MsfpmA5_219GbPpRLHF3&ust=1762433713105000&source=images&cd=vfe&opi=89978449&ved=0CBUQjRxqFwoTCODPtqaH25ADFQAAAAAdAAAAABAE', 30.00, 'USD'),
('PSN50USD', 'PlayStation Store Card 50 USD', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Ftech.yahoo.com%2Fgaming%2Farticles%2Fused-seeing-playstation-branding-xbox-120750257.html&psig=AOvVaw1099fGDnD2bzF5kqkGUwcN&ust=1762433787940000&source=images&cd=vfe&opi=89978449&ved=0CBUQjRxqFwoTCMis-cyH2', 50.00, 'USD'),
('STM10EUR', 'Steam Gift Card 10 EUR', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fstore.steampowered.com%2F&psig=AOvVaw0eK3b70mcvZN-kMRKkW1fk&ust=1762433669826000&source=images&cd=vfe&opi=89978449&ved=0CBUQjRxqFwoTCMjzwpGH25ADFQAAAAAdAAAAABAE', 10.00, 'EUR');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `giftcard`
--
ALTER TABLE `giftcard`
  ADD PRIMARY KEY (`CardId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
