-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Nov 05. 20:29
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `videogame_db`
--

-- --------------------------------------------------------



CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Action RPG'),
(3, 'Action-Adventure'),
(4, 'RPG'),
(5, 'Sandbox'),
(6, 'Battle Royale'),
(7, 'FPS'),
(8, 'Roguelike'),
(9, 'Simulation'),
(10, 'Metroidvania'),
(11, 'Puzzle'),
(12, 'Survival Horror'),
(13, 'Tactical RPG'),
(14, 'Shooter'),
(15, 'Platformer'),
(16, 'MOBA'),
(17, 'Party'),
(18, 'Puzzle Adventure'),
(19, 'Run and Gun'),
(20, 'Roguelike Shooter'),
(21, 'Adventure'),
(22, 'Sports');

-- --------------------------------------------------------



CREATE TABLE `platform` (
  `id` int(11) NOT NULL,
  `platform_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `platform` (`id`, `platform_name`) VALUES
(1, 'PC'),
(2, 'PS4'),
(3, 'PS5'),
(4, 'Xbox'),
(5, 'Xbox One'),
(6, 'Xbox Series X'),
(7, 'Nintendo Switch'),
(8, 'Mobile'),
(9, 'Console'),
(10, 'VR');

-- --------------------------------------------------------



CREATE TABLE `videogame` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `game_pic` varchar(255) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `prize` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `videogame` (`id`, `name`, `game_pic`, `release_date`, `prize`) VALUES
(1, 'Elden Ring', 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1245620/capsule_616x353.jpg?t=1748630546', '2022-02-25', 59.99),
(2, 'Grand Theft Auto V', 'https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png', '2013-09-17', 29.99);

-- --------------------------------------------------------



CREATE TABLE `videogame_genre` (
  `videogame_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `videogame_genre` (`videogame_id`, `genre_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------



CREATE TABLE `videogame_platform` (
  `videogame_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `videogame_platform` (`videogame_id`, `platform_id`) VALUES
(1, 1),
(1, 3);


--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `platform`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `videogame`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `videogame_genre`
  ADD PRIMARY KEY (`videogame_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);


ALTER TABLE `videogame_platform`
  ADD PRIMARY KEY (`videogame_id`,`platform_id`),
  ADD KEY `platform_id` (`platform_id`);




ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;


ALTER TABLE `platform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


ALTER TABLE `videogame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;



ALTER TABLE `videogame_genre`
  ADD CONSTRAINT `videogame_genre_ibfk_1` FOREIGN KEY (`videogame_id`) REFERENCES `videogame` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `videogame_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE;


ALTER TABLE `videogame_platform`
  ADD CONSTRAINT `videogame_platform_ibfk_1` FOREIGN KEY (`videogame_id`) REFERENCES `videogame` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `videogame_platform_ibfk_2` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
