
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

CREATE TABLE `check_card` (
  `uid_card` varchar(20) DEFAULT NULL,
  `check` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid_card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;