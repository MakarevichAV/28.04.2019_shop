-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 25 2019 г., 16:56
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `pic` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `price`, `pic`, `category_id`) VALUES
(1, 'Куртка синяя', 5400, '1.jpg', 4),
(2, 'Куртка с капюшоном', 6100, '2.jpg', 4),
(3, 'Куртка с карманами', 9200, '3.png', 4),
(4, 'Кожаная куртка', 22500, '4.jpg', 4),
(5, 'Куртка Casual', 8800, '5.jpg', 4),
(6, 'Стильная кожаная куртка', 12800, '6.jpg', 4),
(7, 'Кеды серые', 2900, '7.jpg', 6),
(8, 'Кеды черные', 4500, '8.jpg', 6),
(9, 'Кеды Casual', 5900, '9.jpg', 6),
(10, ' Кеды всепогодные', 9200, '10.jpg', 6),
(11, 'Джинсы', 4800, '11.jpg', 7),
(12, 'Джинсы голубые', 4200, '12.jpg', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_category`) VALUES
(1, 'Мужчинам', '0'),
(2, 'Женщинам', '0'),
(3, 'Детям', '0'),
(4, 'Верхняя одежда', '1'),
(5, 'Брюки', '1'),
(6, 'Обувь', '1'),
(7, 'Джинсы', '1'),
(8, 'Юбки', '2'),
(9, 'Платья', '2'),
(10, 'Джинсы', '2'),
(11, 'Блузки ', '2'),
(12, 'Обувь', '2'),
(13, 'Рубашки', '2'),
(14, 'Рубашки', '3'),
(15, 'Футболки', '3'),
(16, 'Комбинезоны', '3'),
(17, 'Платья', '3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
