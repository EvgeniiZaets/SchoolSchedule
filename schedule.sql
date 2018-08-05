-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 05 2018 г., 22:23
-- Версия сервера: 5.5.53
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `schedule`
--

-- --------------------------------------------------------

--
-- Структура таблицы `academic_hours`
--

CREATE TABLE `academic_hours` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `num_of_hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Структура таблицы `bell`
--

CREATE TABLE `bell` (
  `id` int(11) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bell`
--

INSERT INTO `bell` (`id`, `time_from`, `time_to`) VALUES
(1, '09:00:00', '09:45:00'),
(2, '09:55:00', '10:40:00'),
(3, '10:50:00', '11:35:00'),
(4, '12:05:00', '12:50:00'),
(5, '13:00:00', '13:45:00'),
(6, '13:55:00', '14:40:00');

-- --------------------------------------------------------

--
-- Структура таблицы `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `class`
--

INSERT INTO `class` (`id`, `title`) VALUES
(1, '5А'),
(2, '5Б'),
(3, '6А'),
(4, '6Б'),
(5, '7А'),
(6, '7Б'),
(7, '7В'),
(8, '8А'),
(9, '8Б'),
(10, '9А'),
(11, '9Б'),
(12, '9В'),
(13, '10А'),
(14, '10Б'),
(15, '11А'),
(16, '11Б');

-- --------------------------------------------------------

--
-- Структура таблицы `day_of_week`
--

CREATE TABLE `day_of_week` (
  `id` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `day_of_week`
--

INSERT INTO `day_of_week` (`id`, `title`) VALUES
(1, 'Понедельник'),
(2, 'Вторник'),
(3, 'Среда'),
(4, 'Четверг'),
(5, 'Пятница'),
(6, 'Суббота');

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `day_id` tinyint(1) NOT NULL,
  `bell_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблицы `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`id`, `title`) VALUES
(1, 'Математика'),
(2, 'Физика'),
(3, 'Химия'),
(4, 'Литература'),
(5, 'Физ. культура'),
(6, 'Укр. язык'),
(7, 'География'),
(8, 'Биология'),
(9, 'Рисование');

-- --------------------------------------------------------

--
-- Структура таблицы `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `teacher`
--

INSERT INTO `teacher` (`id`, `name`) VALUES
(1, 'Иванов П. М.'),
(2, 'Петров С. И.'),
(3, 'Михайленко К. И.'),
(4, 'Петренко А. А.'),
(5, 'Криворотов Д. А.'),
(6, 'Самойленко И. П.'),
(7, 'Колобов Е. Э.'),
(8, 'Лобанов А. С'),
(9, 'Уваров Т. А.'),
(10, 'Ситников М. Р.'),
(11, 'Кононов В. Б.'),
(12, 'Фадеев Д. Т.'),
(13, 'Овчинников С. Г.'),
(14, 'Абрамов К. Н.'),
(15, 'Соболев Г. Д.'),
(16, 'Лапина Л. В.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `academic_hours`
--
ALTER TABLE `academic_hours`
  ADD KEY `class` (`class_id`),
  ADD KEY `subject` (`subject_id`);

--
-- Индексы таблицы `bell`
--
ALTER TABLE `bell`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `day_of_week`
--
ALTER TABLE `day_of_week`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day` (`day_id`),
  ADD KEY `bell` (`bell_id`),
  ADD KEY `teacher` (`teacher_id`),
  ADD KEY `scedule_class` (`class_id`),
  ADD KEY `schedule_subject` (`subject_id`);

--
-- Индексы таблицы `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bell`
--
ALTER TABLE `bell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `day_of_week`
--
ALTER TABLE `day_of_week`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;
--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `academic_hours`
--
ALTER TABLE `academic_hours`
  ADD CONSTRAINT `class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `bell` FOREIGN KEY (`bell_id`) REFERENCES `bell` (`id`),
  ADD CONSTRAINT `day` FOREIGN KEY (`day_id`) REFERENCES `day_of_week` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scedule_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
