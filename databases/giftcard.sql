-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Nov 13. 11:11
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
CREATE DATABASE IF NOT EXISTS giftcards;
USE giftcards;

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
('AMZ25EUR', 'Amazon Gift Card \r\n', 'https://i0.wp.com/magzoid.com/wp-content/uploads/2025/05/amazon-rebrand-2025_dezeen_2364_col_1-1.webp?fit=2364%2C1330&ssl=1', 25.00, 'EUR'),
('APL', 'Apple Gift Card', 'https://i.pinimg.com/736x/a6/71/85/a6718568ee615a8dbe6f50da7409fdf9.jpg', 0.00, 'USD'),
('BIN', 'Binance Gift Card', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRj97fmjaCYgkevu7aFhgWDjXPfuNxt8bWk5w&s', 0.00, 'USD'),
('BTN', 'Battle.net Gift Card', 'https://i.namu.wiki/i/Pyl_OY2y2m9p-PElUwgfG5slWHUplCUcCU3Aj6Etxq8zOJRlfaJisPbTeZhB0V5Xu1LPSF8lPJNJ2IQETWvY3A.webp', 0.00, 'USD'),
('DSC', 'Discord Nitro Gift Card', 'https://support.discord.com/hc/article_attachments/1500015317842', 0.00, 'USD'),
('EPIC', 'Epic Games Gift Card', 'https://cdn2.unrealengine.com/UnrealEngine%2FNews%2FAnnouncing+the+Epic+Games+Store%2FFB_EpicGamesStore-1200x630-ca750cd84e1b60d746606db9e5a5ac55f8d27672.jpg', 0.00, 'USD'),
('GPLHUF5K', 'Google Play ', 'https://www.internetmatters.org/wp-content/uploads/2024/10/google_play_image-1.png', 20.00, 'USD'),
('ITN', 'iTunes Gift Card', 'https://static0.xdaimages.com/wordpress/wp-content/uploads/2021/10/itunes_logo.jpg', 0.00, 'USD'),
('MS', 'Microsoft Store Card', 'https://liquit.com/app/uploads/2023/05/Microsoft-store-liquit-workspace.jpg', 0.00, 'USD'),
('NFLX30USD', 'Netflix Gift Card ', 'https://images.ctfassets.net/y2ske730sjqp/1aONibCke6niZhgPxuiilC/2c401b05a07288746ddf3bd3943fbc76/BrandAssets_Logos_01-Wordmark.jpg?w=940', 30.00, 'USD'),
('NIN', 'Nintendo eShop Card', 'https://pop.proddigital.com.br/wp-content/uploads/sites/8/2022/07/nintendo-capa.jpg', 0.00, 'USD'),
('ORG', 'Origin Gift Card', 'https://platform.theverge.com/wp-content/uploads/sites/2/chorus/uploads/chorus_asset/file/14231476/ea_origin_logo_640.1419979269.jpg?quality=90&strip=all&crop=0,1.2937595129376,100,97.412480974125', 0.00, 'USD'),
('PSN50USD', 'PlayStation Store Card ', 'https://www.psu.com/wp/wp-content/uploads/2021/09/PlayStationStore-1-1.jpeg', 50.00, 'USD'),
('RAZ', 'Razer Gold Gift Card', 'https://assets2.razerzone.com/images/og-image/razer-gold-pin-OGimage-1200x630.jpg', 0.00, 'USD'),
('ROB', 'Roblox Gift Card', 'https://i0.wp.com/www.dafontfree.io/wp-content/uploads/2020/12/roblox.png?resize=2000%2C1311&ssl=1', 0.00, 'USD'),
('SPOT', 'Spotify Gift Card', 'https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/2024-spotify-brand-assets-media-kit.jpg', 0.00, 'EUR'),
('SPT', 'Shein Gift Card', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJeKeFNkUdI5HargYBKLeLGYCF-yNvfJ3UoA&s', 0.00, 'USD'),
('STM10EUR', 'Steam Gift Card', 'https://images.alphacoders.com/133/1339887.png', 10.00, 'EUR'),
('UBI', 'Ubisoft Connect Gift Card', 'https://www.evilcontrollers.com/media/magefan_blog/apps.63170.14246812968525544.2de1e6fd-94a7-4291-88ea-6803f279b4ed.jpeg', 0.00, 'USD'),
('VLC', 'Mastercard', 'https://wallpapercat.com/w/full/1/5/4/1254747-1920x1080-desktop-full-hd-mastercard-background-image.jpg', 0.00, 'USD'),
('XBL', 'Xbox Gift Card', 'https://i.pinimg.com/736x/02/49/33/0249336d161e09956d2b25f0730c9cd7.jpg', 0.00, 'USD');

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
