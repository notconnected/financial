--
-- База данных: `financial`
--
CREATE DATABASE `financial` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `financial`;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `account` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;