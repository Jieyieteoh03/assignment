-- Adminer 4.8.0 MySQL 5.5.5-10.5.17-MariaDB-1:10.5.17+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1,	'Teoh',	'pugcuteness13@gmail.com',	'$2y$10$7Anbb3iavRyIXPYzb/fqJuR7mWRPelK9gPlaYCmqx2YqQDkhMALMO',	'2023-05-23 07:18:54'),
(2,	'users',	'jieyiet2003@gmail.com',	'$2y$10$S6a6nEV9ADXdRzLsLesl8u8iR3jzbPGL7psh7uR9/zXCOMkHCn/oC',	'2023-05-23 09:49:18'),
(3,	'axa',	'jieyieteoh5@gmail.com',	'$2y$10$GbLVPpstqbrRk5dXsqERXehS06Um040fi/lrzlBR8FcTQwKgV9IYy',	'2023-05-23 09:54:06');

-- 2023-05-23 09:56:49
