-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 20 2017 г., 22:47
-- Версия сервера: 5.6.37
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rest_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Test', 'Test2222', '2017-08-20 14:36:57', '0000-00-00 00:00:00', '2017-08-20 21:45:26'),
(2, 'TESTWK', '$2y$10$A/eyegxTXTc1798yxqN0fePQQbLTDabE2cildlPID3AxDeW/Z7ODS', 'TESTWK@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Pofig', '$2y$10$okrxPNFYWBzw4noNM3nHueF8qG0iU0ibFjfWPdIGBcYHfgnnGrnYS', 'pofig@mail.ru', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Pofig2', '$2y$10$mdt3b4kCxTwf7wQZm16sleWF0s2VF5yT8VI3I19OGE3YewKEH3rha', 'pofig@mail.ua', '0000-00-00 00:00:00', '2017-08-20 18:19:42', '0000-00-00 00:00:00'),
(5, 'Pofig2', '$2y$10$s2okxUSVfkxcs9d1k1qxROo8eN9FuwBa1taxONbd8Pq/1DmcqRhT6', 'pofig@mail.ua', '0000-00-00 00:00:00', '2017-08-20 18:55:38', '0000-00-00 00:00:00'),
(6, '', '$2y$10$Hp5.zWY24uTLjpxdLUgbKexa75eM48mWTuLadkkyGgT2fVwnloZ8i', 'pofig@mail.ua', '0000-00-00 00:00:00', '2017-08-20 18:55:57', '0000-00-00 00:00:00'),
(7, '', '$2y$10$wOMcijrML7ZIJngc8yEtn.y6rAB.wFdJpVpZpmKQl1ELy2I8Ut67C', 'pofig@mail.ua', '0000-00-00 00:00:00', '2017-08-20 19:00:30', '0000-00-00 00:00:00'),
(8, 'w', '$2y$10$01F4DYhSjBiGvtNZa3QQJ.OUBaoO19UQVSeOBHw9dugwIG/ntHLWq', 'w', '0000-00-00 00:00:00', '2017-08-20 19:02:08', '0000-00-00 00:00:00'),
(9, 'w', '$2y$10$zpZXuZxA2XsRI5LCgekBBuGDlhYQyZxRJJgQMy/8Xdm9pOw1uMjVi', 'w', '0000-00-00 00:00:00', '2017-08-20 19:02:40', '0000-00-00 00:00:00'),
(12, 'Wayne', '827ccb0eea8a706c4c34a16891f84e7b', 'Bro', '2017-08-20 22:15:58', '2017-08-20 22:15:26', '2017-08-20 22:39:56');

-- --------------------------------------------------------

--
-- Структура таблицы `users_authentication`
--

CREATE TABLE `users_authentication` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_authentication`
--

INSERT INTO `users_authentication` (`id`, `user_id`, `token`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 1, '4a69104301ce166b38b5e02b4f665fba', '2017-08-21 10:29:04', '0000-00-00 00:00:00', '2017-08-20 22:29:04');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_authentication`
--
ALTER TABLE `users_authentication`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `users_authentication`
--
ALTER TABLE `users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
