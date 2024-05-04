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
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
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
  `diem_danh` int(1) NOT NULL DEFAULT '1',
  `ghi_chu` varchar(255) DEFAULT NULL,
  `thoi_gian_den` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Dumping data for table `users`

INSERT INTO `users` (`uid_card`, `ho_ten`, `mssv`, `chi_doan`, `so_ghe`, `chuc_vu`, `diem_danh`, `ghi_chu`,`thoi_gian_den`) VALUES
('11 50 93 89', 'random1', 'mssv1', 'chi_doan1', 'so_ghe1', 'chuc_vu1', 1, NULL,NOW()),
('uid_card2', 'random2', 'mssv2', 'chi_doan2', 'so_ghe2', 'chuc_vu2', 1, NULL,NOW()),
('uid_card3', 'random3', 'mssv3', 'chi_doan3', 'so_ghe3', 'chuc_vu3', 1, NULL,NOW());
-- ('11509389', 'Nong Manh Hung', '21522122', 'MMTT2021', 'A1', 'PBT', 1, NULL);