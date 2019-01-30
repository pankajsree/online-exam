-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2019 at 10:37 PM
-- Server version: 5.7.13-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` smallint(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `activation_code` varchar(256) NOT NULL,
  `email_status` enum('not verified','verified') NOT NULL,
  `added_on` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `activation_code`, `email_status`, `added_on`) VALUES
(1, 'daspankajsree@gmail.com', '$2y$10$fpS33Dwqef5J4Wv1sDgSZuXURpwusO1eHD3VgwvAGq5zYKKrmz0GC', 'f4569f822520943e5bace6351a434394', 'verified', '2019-01-19 19:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

DROP TABLE IF EXISTS `candidate`;
CREATE TABLE IF NOT EXISTS `candidate` (
  `candidate_id` varchar(32) NOT NULL,
  `candidate_name` varchar(128) NOT NULL,
  `candidate_care_of` varchar(128) NOT NULL,
  `candidate_email` varchar(64) NOT NULL,
  `candidate_contact_no` varchar(16) NOT NULL,
  `candidate_exam_status` tinyint(3) NOT NULL DEFAULT '0',
  `time_left` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candidate_id`, `candidate_name`, `candidate_care_of`, `candidate_email`, `candidate_contact_no`, `candidate_exam_status`, `time_left`) VALUES
('cse_033_001', 'Pankajsree Das', '', '', '', 1, -1020);

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_chem_ans`
--

DROP TABLE IF EXISTS `cse_033_chem_ans`;
CREATE TABLE IF NOT EXISTS `cse_033_chem_ans` (
  `ques_sl` smallint(3) NOT NULL,
  `answer` smallint(2) NOT NULL,
  PRIMARY KEY (`ques_sl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cse_033_chem_ans`
--

INSERT INTO `cse_033_chem_ans` (`ques_sl`, `answer`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 1),
(6, 2),
(7, 3),
(8, 4),
(9, 4),
(10, 2),
(11, 3),
(12, 1),
(13, 2),
(14, 4),
(15, 1),
(16, 3),
(17, 1),
(18, 2),
(19, 3),
(20, 4),
(21, 1),
(22, 1),
(23, 2),
(24, 3),
(25, 4),
(26, 1),
(27, 2),
(28, 3),
(29, 4),
(30, 4),
(31, 2),
(32, 1),
(33, 1),
(34, 3),
(35, 3),
(36, 3),
(37, 4),
(38, 1),
(39, 2),
(40, 2),
(41, 1),
(42, 3),
(43, 1),
(44, 2),
(45, 3),
(46, 4),
(47, 1),
(48, 2),
(49, 3),
(50, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_chem_ques`
--

DROP TABLE IF EXISTS `cse_033_chem_ques`;
CREATE TABLE IF NOT EXISTS `cse_033_chem_ques` (
  `ques_sl` smallint(3) NOT NULL AUTO_INCREMENT,
  `ques` varchar(1024) NOT NULL,
  `opt_1` varchar(512) NOT NULL,
  `opt_2` varchar(512) NOT NULL,
  `opt_3` varchar(512) NOT NULL,
  `opt_4` varchar(512) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`ques_sl`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cse_033_chem_ques`
--

INSERT INTO `cse_033_chem_ques` (`ques_sl`, `ques`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `image`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'India', 'West Indies', 'Pakistan', 'Australia', '1'),
(2, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'test', 'dntud', ''),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'some', 'dntud', 'many', ''),
(4, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', ''),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'some', 'dntud', ''),
(6, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'test', 'dntud', '1'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(8, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'dntud', 'many', 'some', ''),
(9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(10, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', '1'),
(11, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'some', 'many', 'test', ''),
(12, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'dntud', 'test', ''),
(13, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'some', 'test', 'dntud', ''),
(14, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'test', 'dntud', 'some', ''),
(15, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(16, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'many', 'some', 'test', ''),
(17, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(18, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', ''),
(19, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'dntud', 'some', ''),
(20, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'dntud', 'test', ''),
(21, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'test', 'some', 'dntud', ''),
(22, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(23, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'many', 'test', 'some', ''),
(24, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'test', 'many', 'dntud', ''),
(25, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(26, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'some', 'many', 'dntud', ''),
(27, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'dntud', 'some', ''),
(28, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(29, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(30, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'test', 'some', 'dntud', ''),
(31, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'some', 'test', 'dntud', ''),
(32, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'many', 'dntud', 'some', ''),
(33, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(34, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'test', 'many', ''),
(35, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'some', 'many', 'test', ''),
(36, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'many', 'some', 'test', ''),
(37, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'dntud', 'some', 'test', ''),
(38, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(39, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'many', 'some', ''),
(40, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'some', 'many', 'dntud', '1'),
(41, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'test', 'dntud', ''),
(42, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(43, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'test', 'some', 'many', ''),
(44, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'dntud', 'many', 'some', ''),
(45, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(46, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'dntud', 'some', 'test', ''),
(47, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(48, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'many', 'some', 'dntud', ''),
(49, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(50, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'test', 'some', 'many', ''),
(51, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'India', 'West Indies', 'Pakistan', 'Australia', '1'),
(52, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'test', 'dntud', ''),
(53, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'some', 'dntud', 'many', ''),
(54, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', ''),
(55, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'some', 'dntud', ''),
(56, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'test', 'dntud', '1'),
(57, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(58, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'dntud', 'many', 'some', ''),
(59, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(60, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', '1'),
(61, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'some', 'many', 'test', ''),
(62, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'dntud', 'test', ''),
(63, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'some', 'test', 'dntud', ''),
(64, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'test', 'dntud', 'some', ''),
(65, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(66, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'many', 'some', 'test', ''),
(67, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(68, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', ''),
(69, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'dntud', 'some', ''),
(70, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'dntud', 'test', ''),
(71, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'test', 'some', 'dntud', ''),
(72, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(73, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'many', 'test', 'some', ''),
(74, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'test', 'many', 'dntud', ''),
(75, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(76, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'some', 'many', 'dntud', ''),
(77, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'dntud', 'some', ''),
(78, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(79, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(80, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'test', 'some', 'dntud', ''),
(81, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'some', 'test', 'dntud', ''),
(82, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'many', 'dntud', 'some', ''),
(83, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(84, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'test', 'many', ''),
(85, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'some', 'many', 'test', ''),
(86, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'many', 'some', 'test', ''),
(87, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'dntud', 'some', 'test', ''),
(88, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(89, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'many', 'some', ''),
(90, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'some', 'many', 'dntud', '1'),
(91, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'test', 'dntud', ''),
(92, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(93, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'test', 'some', 'many', ''),
(94, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'dntud', 'many', 'some', ''),
(95, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(96, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'dntud', 'some', 'test', ''),
(97, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(98, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'many', 'some', 'dntud', ''),
(99, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(100, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'test', 'some', 'many', ''),
(101, '﻿1,1', '', '', '', '', ''),
(102, '2,2', '', '', '', '', ''),
(103, '3,3', '', '', '', '', ''),
(104, '4,4', '', '', '', '', ''),
(105, '5,1', '', '', '', '', ''),
(106, '6,2', '', '', '', '', ''),
(107, '7,3', '', '', '', '', ''),
(108, '8,4', '', '', '', '', ''),
(109, '9,4', '', '', '', '', ''),
(110, '10,2', '', '', '', '', ''),
(111, '11,3', '', '', '', '', ''),
(112, '12,1', '', '', '', '', ''),
(113, '13,2', '', '', '', '', ''),
(114, '14,4', '', '', '', '', ''),
(115, '15,1', '', '', '', '', ''),
(116, '16,3', '', '', '', '', ''),
(117, '17,1', '', '', '', '', ''),
(118, '18,2', '', '', '', '', ''),
(119, '19,3', '', '', '', '', ''),
(120, '20,4', '', '', '', '', ''),
(121, '21,1', '', '', '', '', ''),
(122, '22,1', '', '', '', '', ''),
(123, '23,2', '', '', '', '', ''),
(124, '24,3', '', '', '', '', ''),
(125, '25,4', '', '', '', '', ''),
(126, '26,1', '', '', '', '', ''),
(127, '27,2', '', '', '', '', ''),
(128, '28,3', '', '', '', '', ''),
(129, '29,4', '', '', '', '', ''),
(130, '30,4', '', '', '', '', ''),
(131, '31,2', '', '', '', '', ''),
(132, '32,1', '', '', '', '', ''),
(133, '33,1', '', '', '', '', ''),
(134, '34,3', '', '', '', '', ''),
(135, '35,3', '', '', '', '', ''),
(136, '36,3', '', '', '', '', ''),
(137, '37,4', '', '', '', '', ''),
(138, '38,1', '', '', '', '', ''),
(139, '39,2', '', '', '', '', ''),
(140, '40,2', '', '', '', '', ''),
(141, '41,1', '', '', '', '', ''),
(142, '42,3', '', '', '', '', ''),
(143, '43,1', '', '', '', '', ''),
(144, '44,2', '', '', '', '', ''),
(145, '45,3', '', '', '', '', ''),
(146, '46,4', '', '', '', '', ''),
(147, '47,1', '', '', '', '', ''),
(148, '48,2', '', '', '', '', ''),
(149, '49,3', '', '', '', '', ''),
(150, '50,4', '', '', '', '', ''),
(151, '﻿1,1', '', '', '', '', ''),
(152, '2,2', '', '', '', '', ''),
(153, '3,3', '', '', '', '', ''),
(154, '4,4', '', '', '', '', ''),
(155, '5,1', '', '', '', '', ''),
(156, '6,2', '', '', '', '', ''),
(157, '7,3', '', '', '', '', ''),
(158, '8,4', '', '', '', '', ''),
(159, '9,4', '', '', '', '', ''),
(160, '10,2', '', '', '', '', ''),
(161, '11,3', '', '', '', '', ''),
(162, '12,1', '', '', '', '', ''),
(163, '13,2', '', '', '', '', ''),
(164, '14,4', '', '', '', '', ''),
(165, '15,1', '', '', '', '', ''),
(166, '16,3', '', '', '', '', ''),
(167, '17,1', '', '', '', '', ''),
(168, '18,2', '', '', '', '', ''),
(169, '19,3', '', '', '', '', ''),
(170, '20,4', '', '', '', '', ''),
(171, '21,1', '', '', '', '', ''),
(172, '22,1', '', '', '', '', ''),
(173, '23,2', '', '', '', '', ''),
(174, '24,3', '', '', '', '', ''),
(175, '25,4', '', '', '', '', ''),
(176, '26,1', '', '', '', '', ''),
(177, '27,2', '', '', '', '', ''),
(178, '28,3', '', '', '', '', ''),
(179, '29,4', '', '', '', '', ''),
(180, '30,4', '', '', '', '', ''),
(181, '31,2', '', '', '', '', ''),
(182, '32,1', '', '', '', '', ''),
(183, '33,1', '', '', '', '', ''),
(184, '34,3', '', '', '', '', ''),
(185, '35,3', '', '', '', '', ''),
(186, '36,3', '', '', '', '', ''),
(187, '37,4', '', '', '', '', ''),
(188, '38,1', '', '', '', '', ''),
(189, '39,2', '', '', '', '', ''),
(190, '40,2', '', '', '', '', ''),
(191, '41,1', '', '', '', '', ''),
(192, '42,3', '', '', '', '', ''),
(193, '43,1', '', '', '', '', ''),
(194, '44,2', '', '', '', '', ''),
(195, '45,3', '', '', '', '', ''),
(196, '46,4', '', '', '', '', ''),
(197, '47,1', '', '', '', '', ''),
(198, '48,2', '', '', '', '', ''),
(199, '49,3', '', '', '', '', ''),
(200, '50,4', '', '', '', '', ''),
(201, '﻿1,1', '', '', '', '', ''),
(202, '2,2', '', '', '', '', ''),
(203, '3,3', '', '', '', '', ''),
(204, '4,4', '', '', '', '', ''),
(205, '5,1', '', '', '', '', ''),
(206, '6,2', '', '', '', '', ''),
(207, '7,3', '', '', '', '', ''),
(208, '8,4', '', '', '', '', ''),
(209, '9,4', '', '', '', '', ''),
(210, '10,2', '', '', '', '', ''),
(211, '11,3', '', '', '', '', ''),
(212, '12,1', '', '', '', '', ''),
(213, '13,2', '', '', '', '', ''),
(214, '14,4', '', '', '', '', ''),
(215, '15,1', '', '', '', '', ''),
(216, '16,3', '', '', '', '', ''),
(217, '17,1', '', '', '', '', ''),
(218, '18,2', '', '', '', '', ''),
(219, '19,3', '', '', '', '', ''),
(220, '20,4', '', '', '', '', ''),
(221, '21,1', '', '', '', '', ''),
(222, '22,1', '', '', '', '', ''),
(223, '23,2', '', '', '', '', ''),
(224, '24,3', '', '', '', '', ''),
(225, '25,4', '', '', '', '', ''),
(226, '26,1', '', '', '', '', ''),
(227, '27,2', '', '', '', '', ''),
(228, '28,3', '', '', '', '', ''),
(229, '29,4', '', '', '', '', ''),
(230, '30,4', '', '', '', '', ''),
(231, '31,2', '', '', '', '', ''),
(232, '32,1', '', '', '', '', ''),
(233, '33,1', '', '', '', '', ''),
(234, '34,3', '', '', '', '', ''),
(235, '35,3', '', '', '', '', ''),
(236, '36,3', '', '', '', '', ''),
(237, '37,4', '', '', '', '', ''),
(238, '38,1', '', '', '', '', ''),
(239, '39,2', '', '', '', '', ''),
(240, '40,2', '', '', '', '', ''),
(241, '41,1', '', '', '', '', ''),
(242, '42,3', '', '', '', '', ''),
(243, '43,1', '', '', '', '', ''),
(244, '44,2', '', '', '', '', ''),
(245, '45,3', '', '', '', '', ''),
(246, '46,4', '', '', '', '', ''),
(247, '47,1', '', '', '', '', ''),
(248, '48,2', '', '', '', '', ''),
(249, '49,3', '', '', '', '', ''),
(250, '50,4', '', '', '', '', ''),
(251, '﻿1,1', '', '', '', '', ''),
(252, '2,2', '', '', '', '', ''),
(253, '3,3', '', '', '', '', ''),
(254, '4,4', '', '', '', '', ''),
(255, '5,1', '', '', '', '', ''),
(256, '6,2', '', '', '', '', ''),
(257, '7,3', '', '', '', '', ''),
(258, '8,4', '', '', '', '', ''),
(259, '9,4', '', '', '', '', ''),
(260, '10,2', '', '', '', '', ''),
(261, '11,3', '', '', '', '', ''),
(262, '12,1', '', '', '', '', ''),
(263, '13,2', '', '', '', '', ''),
(264, '14,4', '', '', '', '', ''),
(265, '15,1', '', '', '', '', ''),
(266, '16,3', '', '', '', '', ''),
(267, '17,1', '', '', '', '', ''),
(268, '18,2', '', '', '', '', ''),
(269, '19,3', '', '', '', '', ''),
(270, '20,4', '', '', '', '', ''),
(271, '21,1', '', '', '', '', ''),
(272, '22,1', '', '', '', '', ''),
(273, '23,2', '', '', '', '', ''),
(274, '24,3', '', '', '', '', ''),
(275, '25,4', '', '', '', '', ''),
(276, '26,1', '', '', '', '', ''),
(277, '27,2', '', '', '', '', ''),
(278, '28,3', '', '', '', '', ''),
(279, '29,4', '', '', '', '', ''),
(280, '30,4', '', '', '', '', ''),
(281, '31,2', '', '', '', '', ''),
(282, '32,1', '', '', '', '', ''),
(283, '33,1', '', '', '', '', ''),
(284, '34,3', '', '', '', '', ''),
(285, '35,3', '', '', '', '', ''),
(286, '36,3', '', '', '', '', ''),
(287, '37,4', '', '', '', '', ''),
(288, '38,1', '', '', '', '', ''),
(289, '39,2', '', '', '', '', ''),
(290, '40,2', '', '', '', '', ''),
(291, '41,1', '', '', '', '', ''),
(292, '42,3', '', '', '', '', ''),
(293, '43,1', '', '', '', '', ''),
(294, '44,2', '', '', '', '', ''),
(295, '45,3', '', '', '', '', ''),
(296, '46,4', '', '', '', '', ''),
(297, '47,1', '', '', '', '', ''),
(298, '48,2', '', '', '', '', ''),
(299, '49,3', '', '', '', '', ''),
(300, '50,4', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_chem_response`
--

DROP TABLE IF EXISTS `cse_033_chem_response`;
CREATE TABLE IF NOT EXISTS `cse_033_chem_response` (
  `candidate_id` varchar(32) NOT NULL,
  `q1` smallint(2) NOT NULL DEFAULT '0',
  `q2` smallint(2) NOT NULL DEFAULT '0',
  `q3` smallint(2) NOT NULL DEFAULT '0',
  `q4` smallint(2) NOT NULL DEFAULT '0',
  `q5` smallint(2) NOT NULL DEFAULT '0',
  `q6` smallint(2) NOT NULL DEFAULT '0',
  `q7` smallint(2) NOT NULL DEFAULT '0',
  `q8` smallint(2) NOT NULL DEFAULT '0',
  `q9` smallint(2) NOT NULL DEFAULT '0',
  `q10` smallint(2) NOT NULL DEFAULT '0',
  `q11` smallint(2) NOT NULL DEFAULT '0',
  `q12` smallint(2) NOT NULL DEFAULT '0',
  `q13` smallint(2) NOT NULL DEFAULT '0',
  `q14` smallint(2) NOT NULL DEFAULT '0',
  `q15` smallint(2) NOT NULL DEFAULT '0',
  `q16` smallint(2) NOT NULL DEFAULT '0',
  `q17` smallint(2) NOT NULL DEFAULT '0',
  `q18` smallint(2) NOT NULL DEFAULT '0',
  `q19` smallint(2) NOT NULL DEFAULT '0',
  `q20` smallint(2) NOT NULL DEFAULT '0',
  `q21` smallint(2) NOT NULL DEFAULT '0',
  `q22` smallint(2) NOT NULL DEFAULT '0',
  `q23` smallint(2) NOT NULL DEFAULT '0',
  `q24` smallint(2) NOT NULL DEFAULT '0',
  `q25` smallint(2) NOT NULL DEFAULT '0',
  `q26` smallint(2) NOT NULL DEFAULT '0',
  `q27` smallint(2) NOT NULL DEFAULT '0',
  `q28` smallint(2) NOT NULL DEFAULT '0',
  `q29` smallint(2) NOT NULL DEFAULT '0',
  `q30` smallint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_math_ans`
--

DROP TABLE IF EXISTS `cse_033_math_ans`;
CREATE TABLE IF NOT EXISTS `cse_033_math_ans` (
  `ques_sl` smallint(3) NOT NULL,
  `answer` smallint(2) NOT NULL,
  PRIMARY KEY (`ques_sl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cse_033_math_ans`
--

INSERT INTO `cse_033_math_ans` (`ques_sl`, `answer`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 1),
(6, 2),
(7, 3),
(8, 4),
(9, 4),
(10, 2),
(11, 3),
(12, 1),
(13, 2),
(14, 4),
(15, 1),
(16, 3),
(17, 1),
(18, 2),
(19, 3),
(20, 4),
(21, 1),
(22, 1),
(23, 2),
(24, 3),
(25, 4),
(26, 1),
(27, 2),
(28, 3),
(29, 4),
(30, 4),
(31, 2),
(32, 1),
(33, 1),
(34, 3),
(35, 3),
(36, 3),
(37, 4),
(38, 1),
(39, 2),
(40, 2),
(41, 1),
(42, 3),
(43, 1),
(44, 2),
(45, 3),
(46, 4),
(47, 1),
(48, 2),
(49, 3),
(50, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_math_ques`
--

DROP TABLE IF EXISTS `cse_033_math_ques`;
CREATE TABLE IF NOT EXISTS `cse_033_math_ques` (
  `ques_sl` smallint(3) NOT NULL AUTO_INCREMENT,
  `ques` varchar(1024) NOT NULL,
  `opt_1` varchar(512) NOT NULL,
  `opt_2` varchar(512) NOT NULL,
  `opt_3` varchar(512) NOT NULL,
  `opt_4` varchar(512) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`ques_sl`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cse_033_math_ques`
--

INSERT INTO `cse_033_math_ques` (`ques_sl`, `ques`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `image`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'India', 'West Indies', 'Pakistan', 'Australia', '1'),
(2, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'test', 'dntud', ''),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'some', 'dntud', 'many', ''),
(4, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', ''),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'some', 'dntud', ''),
(6, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'test', 'dntud', '1'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(8, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'dntud', 'many', 'some', ''),
(9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(10, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', '1'),
(11, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'some', 'many', 'test', ''),
(12, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'dntud', 'test', ''),
(13, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'some', 'test', 'dntud', ''),
(14, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'test', 'dntud', 'some', ''),
(15, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(16, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'many', 'some', 'test', ''),
(17, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(18, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', ''),
(19, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'dntud', 'some', ''),
(20, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'dntud', 'test', ''),
(21, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'test', 'some', 'dntud', ''),
(22, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(23, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'many', 'test', 'some', ''),
(24, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'test', 'many', 'dntud', ''),
(25, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(26, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'some', 'many', 'dntud', ''),
(27, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'dntud', 'some', ''),
(28, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(29, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(30, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'test', 'some', 'dntud', ''),
(31, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'some', 'test', 'dntud', ''),
(32, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'many', 'dntud', 'some', ''),
(33, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(34, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'test', 'many', ''),
(35, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'some', 'many', 'test', ''),
(36, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'many', 'some', 'test', ''),
(37, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'dntud', 'some', 'test', ''),
(38, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(39, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'many', 'some', ''),
(40, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'some', 'many', 'dntud', '1'),
(41, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'test', 'dntud', ''),
(42, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(43, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'test', 'some', 'many', ''),
(44, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'dntud', 'many', 'some', ''),
(45, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(46, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'dntud', 'some', 'test', ''),
(47, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(48, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'many', 'some', 'dntud', ''),
(49, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(50, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'test', 'some', 'many', '');

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_math_response`
--

DROP TABLE IF EXISTS `cse_033_math_response`;
CREATE TABLE IF NOT EXISTS `cse_033_math_response` (
  `candidate_id` varchar(32) NOT NULL,
  `q1` smallint(2) NOT NULL DEFAULT '0',
  `q2` smallint(2) NOT NULL DEFAULT '0',
  `q3` smallint(2) NOT NULL DEFAULT '0',
  `q4` smallint(2) NOT NULL DEFAULT '0',
  `q5` smallint(2) NOT NULL DEFAULT '0',
  `q6` smallint(2) NOT NULL DEFAULT '0',
  `q7` smallint(2) NOT NULL DEFAULT '0',
  `q8` smallint(2) NOT NULL DEFAULT '0',
  `q9` smallint(2) NOT NULL DEFAULT '0',
  `q10` smallint(2) NOT NULL DEFAULT '0',
  `q11` smallint(2) NOT NULL DEFAULT '0',
  `q12` smallint(2) NOT NULL DEFAULT '0',
  `q13` smallint(2) NOT NULL DEFAULT '0',
  `q14` smallint(2) NOT NULL DEFAULT '0',
  `q15` smallint(2) NOT NULL DEFAULT '0',
  `q16` smallint(2) NOT NULL DEFAULT '0',
  `q17` smallint(2) NOT NULL DEFAULT '0',
  `q18` smallint(2) NOT NULL DEFAULT '0',
  `q19` smallint(2) NOT NULL DEFAULT '0',
  `q20` smallint(2) NOT NULL DEFAULT '0',
  `q21` smallint(2) NOT NULL DEFAULT '0',
  `q22` smallint(2) NOT NULL DEFAULT '0',
  `q23` smallint(2) NOT NULL DEFAULT '0',
  `q24` smallint(2) NOT NULL DEFAULT '0',
  `q25` smallint(2) NOT NULL DEFAULT '0',
  `q26` smallint(2) NOT NULL DEFAULT '0',
  `q27` smallint(2) NOT NULL DEFAULT '0',
  `q28` smallint(2) NOT NULL DEFAULT '0',
  `q29` smallint(2) NOT NULL DEFAULT '0',
  `q30` smallint(2) NOT NULL DEFAULT '0',
  `q31` smallint(2) NOT NULL DEFAULT '0',
  `q32` smallint(2) NOT NULL DEFAULT '0',
  `q33` smallint(2) NOT NULL DEFAULT '0',
  `q34` smallint(2) NOT NULL DEFAULT '0',
  `q35` smallint(2) NOT NULL DEFAULT '0',
  `q36` smallint(2) NOT NULL DEFAULT '0',
  `q37` smallint(2) NOT NULL DEFAULT '0',
  `q38` smallint(2) NOT NULL DEFAULT '0',
  `q39` smallint(2) NOT NULL DEFAULT '0',
  `q40` smallint(2) NOT NULL DEFAULT '0',
  `q41` smallint(2) NOT NULL DEFAULT '0',
  `q42` smallint(2) NOT NULL DEFAULT '0',
  `q43` smallint(2) NOT NULL DEFAULT '0',
  `q44` smallint(2) NOT NULL DEFAULT '0',
  `q45` smallint(2) NOT NULL DEFAULT '0',
  `q46` smallint(2) NOT NULL DEFAULT '0',
  `q47` smallint(2) NOT NULL DEFAULT '0',
  `q48` smallint(2) NOT NULL DEFAULT '0',
  `q49` smallint(2) NOT NULL DEFAULT '0',
  `q50` smallint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_phy_ans`
--

DROP TABLE IF EXISTS `cse_033_phy_ans`;
CREATE TABLE IF NOT EXISTS `cse_033_phy_ans` (
  `ques_sl` smallint(3) NOT NULL,
  `answer` smallint(2) NOT NULL,
  PRIMARY KEY (`ques_sl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cse_033_phy_ans`
--

INSERT INTO `cse_033_phy_ans` (`ques_sl`, `answer`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 1),
(6, 2),
(7, 3),
(8, 4),
(9, 4),
(10, 2),
(11, 3),
(12, 1),
(13, 2),
(14, 4),
(15, 1),
(16, 3),
(17, 1),
(18, 2),
(19, 3),
(20, 4),
(21, 1),
(22, 1),
(23, 2),
(24, 3),
(25, 4),
(26, 1),
(27, 2),
(28, 3),
(29, 4),
(30, 4),
(31, 2),
(32, 1),
(33, 1),
(34, 3),
(35, 3),
(36, 3),
(37, 4),
(38, 1),
(39, 2),
(40, 2),
(41, 1),
(42, 3),
(43, 1),
(44, 2),
(45, 3),
(46, 4),
(47, 1),
(48, 2),
(49, 3),
(50, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_phy_ques`
--

DROP TABLE IF EXISTS `cse_033_phy_ques`;
CREATE TABLE IF NOT EXISTS `cse_033_phy_ques` (
  `ques_sl` smallint(3) NOT NULL AUTO_INCREMENT,
  `ques` varchar(1024) NOT NULL,
  `opt_1` varchar(512) NOT NULL,
  `opt_2` varchar(512) NOT NULL,
  `opt_3` varchar(512) NOT NULL,
  `opt_4` varchar(512) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`ques_sl`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cse_033_phy_ques`
--

INSERT INTO `cse_033_phy_ques` (`ques_sl`, `ques`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `image`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'India', 'West Indies', 'Pakistan', 'Australia', '41.png'),
(2, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'test', 'dntud', ''),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'some', 'dntud', 'many', ''),
(4, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', ''),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'some', 'dntud', ''),
(6, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'test', 'dntud', '41.png'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(8, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'dntud', 'many', 'some', ''),
(9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(10, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', '41.png'),
(11, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'some', 'many', 'test', ''),
(12, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'dntud', 'test', ''),
(13, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'some', 'test', 'dntud', ''),
(14, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'test', 'dntud', 'some', ''),
(15, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(16, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'many', 'some', 'test', ''),
(17, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(18, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'many', 'test', ''),
(19, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'dntud', 'some', ''),
(20, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'many', 'dntud', 'test', ''),
(21, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'test', 'some', 'dntud', ''),
(22, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(23, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'many', 'test', 'some', ''),
(24, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'some', 'test', 'many', 'dntud', ''),
(25, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'some', 'many', ''),
(26, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'some', 'many', 'dntud', ''),
(27, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'many', 'dntud', 'some', ''),
(28, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(29, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(30, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'test', 'some', 'dntud', ''),
(31, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'some', 'test', 'dntud', ''),
(32, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'many', 'dntud', 'some', ''),
(33, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(34, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'some', 'test', 'many', ''),
(35, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'some', 'many', 'test', ''),
(36, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'many', 'some', 'test', ''),
(37, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'many', 'dntud', 'some', 'test', ''),
(38, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(39, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'test', 'dntud', 'many', 'some', ''),
(40, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'some', 'many', 'dntud', '41.png'),
(41, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'test', 'dntud', ''),
(42, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'some', 'dntud', 'test', ''),
(43, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'dntud', 'test', 'some', 'many', ''),
(44, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'dntud', 'many', 'some', ''),
(45, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(46, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'many', 'dntud', 'some', 'test', ''),
(47, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'many', 'dntud', 'test', ''),
(48, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'test', 'many', 'some', 'dntud', ''),
(49, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore sit ipsam nesciunt, a aspernatur rerum.', 'some', 'dntud', 'many', 'test', ''),
(50, 'SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT', 'dntud', 'test', 'some', 'many', '');

-- --------------------------------------------------------

--
-- Table structure for table `cse_033_phy_response`
--

DROP TABLE IF EXISTS `cse_033_phy_response`;
CREATE TABLE IF NOT EXISTS `cse_033_phy_response` (
  `candidate_id` varchar(32) NOT NULL,
  `q1` smallint(2) NOT NULL DEFAULT '0',
  `q2` smallint(2) NOT NULL DEFAULT '0',
  `q3` smallint(2) NOT NULL DEFAULT '0',
  `q4` smallint(2) NOT NULL DEFAULT '0',
  `q5` smallint(2) NOT NULL DEFAULT '0',
  `q6` smallint(2) NOT NULL DEFAULT '0',
  `q7` smallint(2) NOT NULL DEFAULT '0',
  `q8` smallint(2) NOT NULL DEFAULT '0',
  `q9` smallint(2) NOT NULL DEFAULT '0',
  `q10` smallint(2) NOT NULL DEFAULT '0',
  `q11` smallint(2) NOT NULL DEFAULT '0',
  `q12` smallint(2) NOT NULL DEFAULT '0',
  `q13` smallint(2) NOT NULL DEFAULT '0',
  `q14` smallint(2) NOT NULL DEFAULT '0',
  `q15` smallint(2) NOT NULL DEFAULT '0',
  `q16` smallint(2) NOT NULL DEFAULT '0',
  `q17` smallint(2) NOT NULL DEFAULT '0',
  `q18` smallint(2) NOT NULL DEFAULT '0',
  `q19` smallint(2) NOT NULL DEFAULT '0',
  `q20` smallint(2) NOT NULL DEFAULT '0',
  `q21` smallint(2) NOT NULL DEFAULT '0',
  `q22` smallint(2) NOT NULL DEFAULT '0',
  `q23` smallint(2) NOT NULL DEFAULT '0',
  `q24` smallint(2) NOT NULL DEFAULT '0',
  `q25` smallint(2) NOT NULL DEFAULT '0',
  `q26` smallint(2) NOT NULL DEFAULT '0',
  `q27` smallint(2) NOT NULL DEFAULT '0',
  `q28` smallint(2) NOT NULL DEFAULT '0',
  `q29` smallint(2) NOT NULL DEFAULT '0',
  `q30` smallint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cse_033_phy_response`
--

INSERT INTO `cse_033_phy_response` (`candidate_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, `q18`, `q19`, `q20`, `q21`, `q22`, `q23`, `q24`, `q25`, `q26`, `q27`, `q28`, `q29`, `q30`) VALUES
('cse_033_001', 2, 5, 6, 6, 6, 3, 4, 1, 5, 6, 5, 5, -2, 5, 6, 5, 5, 6, 6, 5, -3, 3, 5, 6, 5, 5, 5, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `exam_code` varchar(32) NOT NULL,
  `exam_name` varchar(64) NOT NULL,
  `sec_count` tinyint(2) NOT NULL,
  `exam_password` varchar(64) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `added_on` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`exam_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_code`, `exam_name`, `sec_count`, `exam_password`, `is_active`, `added_on`) VALUES
('cse_033', 'CSE Test', 3, 'cse@123', 0, '2019-01-20 18:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `sec_details`
--

DROP TABLE IF EXISTS `sec_details`;
CREATE TABLE IF NOT EXISTS `sec_details` (
  `sec_id` varchar(32) NOT NULL,
  `sec_name` varchar(64) NOT NULL,
  `tot_ques` smallint(3) NOT NULL,
  `time_mins` smallint(3) NOT NULL,
  `positive` tinyint(2) NOT NULL,
  `negative` tinyint(2) NOT NULL,
  `note` varchar(2048) NOT NULL,
  PRIMARY KEY (`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_details`
--

INSERT INTO `sec_details` (`sec_id`, `sec_name`, `tot_ques`, `time_mins`, `positive`, `negative`, `note`) VALUES
('cse_033_chem', 'Chemistry', 30, 60, 4, 1, ''),
('cse_033_math', 'Mathematics', 50, 90, 5, 2, ''),
('cse_033_phy', 'Physics', 30, 60, 4, 1, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
