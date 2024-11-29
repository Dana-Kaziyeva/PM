-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 29 2024 г., 11:49
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `student_portal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cr` int(11) NOT NULL,
  `ects` int(11) NOT NULL,
  `year_range` varchar(50) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL CHECK (`semester` between 1 and 8),
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `cr`, `ects`, `year_range`, `semester`, `price`) VALUES
(1, 'CSS 465', 'Project Management', 3, 5, '2024-2025', 7, 120000),
(2, 'INF 228', 'UX/UI design', 3, 5, '2024-2025', 7, 120000),
(3, 'CSS 215', 'Introduction to Algorithms', 3, 5, '2024-2025', 1, 120000),
(4, 'CSS 410', 'Research Tools and Methods', 3, 5, '2024-2025', 1, 120000),
(5, 'CSS 480', 'Industrial Practice 3', 2, 3, '2024-2025', 1, 72000),
(6, 'INF 428', 'Data Ethics and Applied Analitics', 3, 5, '2024-2025', 7, 120000),
(7, 'CSS 481', 'Industrial Practice 3', 1, 2, '2024-2025', 1, 48000),
(8, 'INF 394', 'Introduction to Geographic Information Systems', 3, 5, '2024-2025', 1, 120000),
(9, 'INF 415', 'Leadership in IT', 3, 5, '2024-2025', 7, 120000),
(10, 'INF 360', 'It law', 3, 5, '2024-2025', 7, 120000),
(11, 'INF 426', 'IT Asset Management', 3, 5, '2024-2025', 1, 120000),
(12, 'INF 440', 'Digital Image Processing', 3, 5, '2024-2025', 1, 120000),
(13, 'INF 431', 'Accounting Information Systems', 3, 5, '2024-2025', 7, 120000);

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('opened','closed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `title`, `start_date`, `end_date`, `status`) VALUES
(1, 'Course Registration (for students)', '2024-08-12', '2024-08-23', 'closed'),
(2, 'Late withdrawal', '2024-10-21', '2024-12-13', 'opened');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `language` enum('en','kz','rus') NOT NULL,
  `delivery_method` enum('advising desk','online') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orderstudent`
--

CREATE TABLE `orderstudent` (
  `order_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `link` varchar(2083) DEFAULT NULL,
  `status` enum('pending','ready','denied') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `teacher_course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` int(9) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `native_name` varchar(255) DEFAULT NULL,
  `birth_day` date DEFAULT NULL,
  `program_class` varchar(255) DEFAULT NULL,
  `advisor` varchar(255) DEFAULT NULL,
  `status` enum('studying','graduated','dropped','academic leave') NOT NULL,
  `balance` int(11) DEFAULT 0,
  `ENT_score` int(11) DEFAULT NULL CHECK (`ENT_score` between 50 and 140),
  `email` varchar(255) NOT NULL,
  `grant_type` enum('State Grant','Paid','University Grant') NOT NULL,
  `registration_date` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `native_name`, `birth_day`, `program_class`, `advisor`, `status`, `balance`, `ENT_score`, `email`, `grant_type`, `registration_date`, `password`) VALUES
(210103062, 'Dana', 'Kaziyeva', 'Казиева Дана', '2003-08-15', 'Information systems', 'Манбай Шахназар-Сұлтан', 'studying', 0, 99, '210103062@stu.sdu.edu.kz', 'State Grant', '2021-08-20', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19'),
(210103225, 'Nursaule', 'Nurlybek', 'Нұрлыбек Нұрсәуле', '2004-09-01', 'Inforation Systems', 'Dilyara Zhaxylykova', 'studying', 0, 140, 'nnn@gmail.com', 'State Grant', '2024-08-01', 'qwerty123'),
(210103322, 'Dilyara', 'Zhaxylykova', 'Жаксылыкова Диляра', '2004-01-31', 'Infromation Systems', 'Nursaule Nurlybek', 'studying', 0, 125, 'dilyaoke@gmail.com', 'State Grant', '2021-08-23', 'dilya1234'),
(210103382, 'Bauyrzhan', 'Makhsudov ', 'Махсудов Бауыржан', '0000-00-00', 'Information Systems', 'Әділхан Шынғыс', 'studying', 0, 104, 'bauka_maxsud@mail.ru', 'State Grant', '2024-11-29', 'Qwerty1234');

-- --------------------------------------------------------

--
-- Структура таблицы `studentcourse`
--

CREATE TABLE `studentcourse` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` tinyint(3) UNSIGNED DEFAULT 0,
  `status` enum('first time','retake') NOT NULL,
  `grade` decimal(5,2) DEFAULT 0.00,
  `letter_grade` char(2) DEFAULT NULL,
  `gpa` decimal(3,2) DEFAULT 0.00,
  `traditional_grade` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `teachercourse`
--

CREATE TABLE `teachercourse` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `group_number` char(2) DEFAULT NULL,
  `type` enum('N','P','L') NOT NULL,
  `week_day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `teachercourse`
--

INSERT INTO `teachercourse` (`id`, `course_id`, `teacher_id`, `group_number`, `type`, `week_day`, `start_time`, `end_time`, `location`) VALUES
(1, 1, 1, '1', 'N', 'Thursday', '10:30:00', '12:20:00', 'C1'),
(2, 3, 8, '01', 'L', 'Monday', '08:30:00', '09:30:00', 'Virtual Building'),
(3, 1, 1, '01', 'N', 'Thursday', '10:30:00', '12:20:00', 'D113(C1)'),
(4, 2, 4, '06', 'N', 'Tuesday', '11:30:00', '13:20:00', 'D116'),
(5, 1, 1, '04', 'P', 'Friday', '14:30:00', '15:20:00', 'G301'),
(6, 3, 12, '05', 'P', 'Thursday', '12:30:00', '14:20:00', 'F203'),
(7, 2, 1, '07', 'P', 'Saturday', '11:30:00', '12:20:00', 'G103'),
(8, 5, 6, '01', 'N', 'Friday', '17:30:00', '18:20:00', 'Virtual Building'),
(9, 2, 2, '06', 'P', 'Tuesday', '14:30:00', '15:20:00', 'G104'),
(10, 10, 11, '01', 'N', 'Wednesday', '13:30:00', '14:20:00', 'H03'),
(11, 10, 11, '02', 'P', 'Thursday', '12:30:00', '13:20:00', 'G101'),
(12, 7, 6, '01', 'N', 'Monday', '17:30:00', '19:20:00', 'Virtual Building\r\n'),
(13, 13, 5, '01', 'N', 'Thursday', '14:30:00', '16:20:00', 'H02'),
(14, 13, 5, '02', 'L', 'Friday', '11:30:00', '12:20:00', 'G103'),
(15, 12, 7, '01', 'L', 'Friday', '12:30:00', '13:30:00', 'Virtual Building\r\n'),
(16, 12, 7, '01', 'N', 'Friday', '15:30:00', '16:20:00', 'VR16'),
(17, 12, 7, '02', 'P', 'Saturday', '09:30:00', '10:20:00', 'Virtual Building\r\n'),
(18, 12, 7, '04', 'P', 'Saturday', '08:30:00', '10:20:00', 'VR93');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `last_name`) VALUES
(1, 'Assyl ', 'Abilakim'),
(2, 'Aziza', 'Aipenova'),
(3, 'Alikhan ', 'Nurlanuly'),
(4, 'Ainura ', 'Yespanova'),
(5, 'Sufyan ', 'Mustafa'),
(6, 'Kuanyshbek ', 'Mamay'),
(7, 'Magzhan', 'Kairanbay'),
(8, 'Bissenbay', 'Dauletbayev'),
(9, 'Zhumaniyaz', 'Mamatnabiyev'),
(10, 'Bakhtiyor ', 'Meraliyev\r\n'),
(11, 'Abay', 'Magauiya'),
(12, 'Adil', 'Akhmetov');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orderstudent`
--
ALTER TABLE `orderstudent`
  ADD PRIMARY KEY (`order_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Индексы таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`teacher_course_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `studentcourse`
--
ALTER TABLE `studentcourse`
  ADD PRIMARY KEY (`course_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Индексы таблицы `teachercourse`
--
ALTER TABLE `teachercourse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `teachercourse`
--
ALTER TABLE `teachercourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orderstudent`
--
ALTER TABLE `orderstudent`
  ADD CONSTRAINT `orderstudent_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderstudent_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`teacher_course_id`) REFERENCES `teachercourse` (`id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Ограничения внешнего ключа таблицы `studentcourse`
--
ALTER TABLE `studentcourse`
  ADD CONSTRAINT `studentcourse_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `studentcourse_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Ограничения внешнего ключа таблицы `teachercourse`
--
ALTER TABLE `teachercourse`
  ADD CONSTRAINT `teachercourse_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `teachercourse_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
