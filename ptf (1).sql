-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2018. Nov 11. 18:31
-- Kiszolgáló verziója: 10.1.34-MariaDB
-- PHP verzió: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `ptf`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `sex` varchar(6) COLLATE utf8_hungarian_ci NOT NULL,
  `is_trainer` tinyint(1) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `people`
--

INSERT INTO `people` (`id`, `user_id`, `name`, `sex`, `is_trainer`, `trainer_id`, `birth_date`, `weight`, `height`, `profile_pic`) VALUES
(1, 3, 'Farkas Lilla', 'female', 0, 0, '1999-09-02', 51, 165, '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `since` date NOT NULL,
  `price` int(11) NOT NULL,
  `places` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `introduction` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `trainers`
--

INSERT INTO `trainers` (`id`, `user_id`, `title`, `since`, `price`, `places`, `mobile`, `introduction`) VALUES
(0, 3, '', '0000-00-00', 2, '', '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `training_type`
--

CREATE TABLE `training_type` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `type1` tinyint(1) NOT NULL,
  `type2` tinyint(1) NOT NULL,
  `type3` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_hungarian_ci NOT NULL,
  `reg_date` date NOT NULL,
  `last_login` datetime NOT NULL,
  `is_trainer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `reg_date`, `last_login`, `is_trainer`) VALUES
(1, 'asd', '', '0000-00-00', '0000-00-00 00:00:00', 0),
(2, 'nemeth.balint98@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', '2018-11-01', '2018-11-01 20:14:00', 0),
(3, 'lilluscsaj@freemail.hu', 'a8f5f167f44f4964e6c998dee827110c', '2018-11-01', '2018-11-01 21:14:09', 1),
(4, 'lilluscsaj@freemail.hu', 'a8f5f167f44f4964e6c998dee827110c', '2018-11-01', '2018-11-01 21:15:49', 1),
(5, 'lilluscsajasd@freemail.hu', 'a8f5f167f44f4964e6c998dee827110c', '2018-11-01', '2018-11-01 21:17:54', 1),
(6, 'karvai.gyuri@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', '2018-11-05', '2018-11-05 14:00:32', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `training_type`
--
ALTER TABLE `training_type`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `training_type`
--
ALTER TABLE `training_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
