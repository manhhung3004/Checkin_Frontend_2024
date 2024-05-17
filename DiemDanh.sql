-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 07:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@OLD_COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Diem Danh dai hoi`
--
-- --------------------------------------------------------

-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid_card` varchar(20) DEFAULT NULL,
  `ho_ten` varchar(40) NOT NULL,
  `mssv` varchar(40) NOT NULL,
  `chi_doan` varchar(20) NOT NULL,
  `so_ghe` varchar(20) NOT NULL,
  `chuc_vu` varchar(20) NOT NULL,
  `diem_danh` tinyint(1) NOT NULL DEFAULT '0',
  `ghi_chu` varchar(255) NOT NULL DEFAULT 'Chưa điểm Danh',
  `thoi_gian_den` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `hien_co_mat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`

INSERT INTO `users` (`uid_card`, `ho_ten`, `mssv`, `chi_doan`, `so_ghe`, `chuc_vu`, `diem_danh`, `ghi_chu`, `thoi_gian_den`, `hinh_anh`) VALUES
('11 50 93 89', 'random1', 'mssv1', 'chi_doan1', 'so_ghe1', 'chuc_vu1', 0, 'Chưa điểm Danh', NOW(), 'anh1.jpg'),
('44168193206', 'Trần Ngọc Lâm', 'mssv2', 'MMCL2020', 'A2', 'Phó Bí Thư', 0, 'Chưa điểm Danh', NOW(), 'anh2.jpg'),
('uid_card3', 'random3', 'mssv3', 'chi_doan3', 'so_ghe3', 'chuc_vu3', 0, 'Chưa điểm Danh', NOW(), 'anh3.jpg');
-- ('11509389', 'Nong Manh Hung', '21522122', 'MMTT2021', 'A1', 'PBT', 1, 'Chưa điểm Danh', NOW(), 'anh4.jpg');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
