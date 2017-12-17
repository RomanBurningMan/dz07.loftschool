-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 17 2017 г., 13:50
-- Версия сервера: 5.5.48
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customer_data`
--

CREATE TABLE IF NOT EXISTS `customer_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `street` varchar(30) DEFAULT NULL,
  `house` smallint(6) DEFAULT NULL,
  `house_block` tinyint(4) DEFAULT NULL,
  `apt` smallint(6) DEFAULT NULL,
  `floor` tinyint(4) DEFAULT NULL,
  `comments` text,
  `need_cashback` tinyint(2) DEFAULT NULL,
  `need_callback` tinyint(2) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer_data`
--

INSERT INTO `customer_data` (`id`, `user_id`, `tel`, `street`, `house`, `house_block`, `apt`, `floor`, `comments`, `need_cashback`, `need_callback`, `updated_at`, `created_at`) VALUES
(5, 4, '+7 (111) 111 1', 'Roman', 11, 1, 1, 1, 'Мне нужна большая пицца', 0, 1, '2017-12-12 15:47:59', '2017-12-12 15:47:59'),
(6, 4, '+7 (111) 111 1', 'Roman', 11, 1, 1, 1, 'Мне нужна большая пицца и торт', 1, 1, '2017-12-12 15:49:58', '2017-12-12 15:49:58'),
(7, 4, '+7 (111) 111 1', 'Roman', 11, 1, 1, 1, 'Мне нужна большая пицца и торт', 1, 1, '2017-12-12 15:50:04', '2017-12-12 15:50:04'),
(8, 5, '+7 (111) 111 1', 'Monomaha', 11, 11, 1, 1, 'qwertyui', 1, 1, '2017-12-12 19:07:02', '2017-12-12 19:07:02'),
(9, 6, '+7 (111) 111 1', 'Marka', 88, 8, 8, 8, 'test', 1, 1, '2017-12-12 19:13:09', '2017-12-12 19:13:09'),
(13, 11, '12332132132121', '2113221321', 213, 127, 213, 127, '                                    \r\n                                ', 0, 0, '2017-12-12 21:44:02', '2017-12-12 21:44:02'),
(14, 12, '+7 (132) 123 1', 'qwert', 123, 12, 21, 21, '12', 0, 0, '2017-12-12 21:44:57', '2017-12-12 21:44:57');

-- --------------------------------------------------------

--
-- Структура таблицы `users_login`
--

CREATE TABLE IF NOT EXISTS `users_login` (
  `id` int(11) NOT NULL,
  `user_name` varchar(60) DEFAULT NULL,
  `user_email` varchar(80) NOT NULL,
  `ip_addr` varchar(12) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_login`
--

INSERT INTO `users_login` (`id`, `user_name`, `user_email`, `ip_addr`, `photo`) VALUES
(1, 'Rom', 'r.r@r.com', '127.0.0.1', 'download.jpg'),
(2, 'TEST', 'ivan@TEST.test', '127.0.0.1', 'images (1).jpg'),
(3, 'Ignat', 'ivan@ignat.com', '127.0.0.1', ''),
(4, 'MyMy', 'my@my.my', '127.0.0.1', 'images.jpg'),
(5, 'Rem', 'poi@poi.pi', '127.0.0.1', 'images.jpg'),
(6, 'CHanges', 'qwe@qwe.qwe1', '127.0.0.1', 'download (2).png'),
(7, 'MainTest', 'main@test.com', '127.0.0.1', 'download (2).png'),
(9, 'Create', 'Create@i.ua', '127.0.0.1', 'download (2).png'),
(10, 'man', 'man@i.ua', '127.0.0.1', 'download (2).png'),
(11, 'TETETETE', 'test@test.com', '127.0.0.1', 'download (3).png'),
(12, 'qwerty', 'qwerty@qwerty.qwert', '127.0.0.1', 'download (1).png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `customer_data`
--
ALTER TABLE `customer_data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `customer_data`
--
ALTER TABLE `customer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `users_login`
--
ALTER TABLE `users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
