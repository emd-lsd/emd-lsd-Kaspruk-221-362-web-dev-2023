-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: std-mysql
-- Время создания: Июн 14 2023 г., 17:08
-- Версия сервера: 5.7.26-0ubuntu0.16.04.1
-- Версия PHP: 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `std_2020_type`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Car`
--

CREATE TABLE `Car` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `reg_num` varchar(6) NOT NULL,
  `color` varchar(255) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Car`
--

INSERT INTO `Car` (`id`, `brand`, `class`, `reg_num`, `color`, `year`) VALUES
(1, 'Mercedes', 'business', 'a101bb', 'black', '2020'),
(2, 'BMW', 'business', 'a102bb', 'black', '2021'),
(3, 'Audi', 'business', 'a103bb', 'black', '2021'),
(4, 'KIA', 'plus', 'b101cc', 'yellow', '2019'),
(5, 'Hyundai', 'plus', 'b102cc', 'yellow', '2018'),
(6, 'Haval', 'plus', 'b103cc', 'white', '2019'),
(7, 'Lada', 'econom', 'c101dd', 'yellow', '2018'),
(8, 'Shkoda', 'econom', 'c102dd', 'white', '2020');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Car`
--
ALTER TABLE `Car`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Car`
--
ALTER TABLE `Car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
