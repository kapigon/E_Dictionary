-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 06:33 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_dictionary`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `EdictID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DateCreate` date NOT NULL,
  `Comment` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `EdictID`, `UserID`, `DateCreate`, `Comment`) VALUES
(1, 5, 100000, '2017-08-17', 'OK'),
(2, 5, 100002, '2017-08-18', 'danh, thanh danh');

-- --------------------------------------------------------

--
-- Table structure for table `edict`
--

CREATE TABLE `edict` (
  `ID` int(11) NOT NULL,
  `Word` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Detail` text COLLATE utf8_unicode_ci NOT NULL,
  `UserId` int(11) NOT NULL,
  `DateCreate` date NOT NULL,
  `DateUpdate` date NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `Language` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `StatusId` int(11) NOT NULL,
  `Spelling` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `edict`
--

INSERT INTO `edict` (`ID`, `Word`, `Detail`, `UserId`, `DateCreate`, `DateUpdate`, `Active`, `Language`, `StatusId`, `Spelling`) VALUES
(1, 'hello', 'Xin chào, chào', 100001, '2017-07-18', '2017-07-18', 1, 'en', 1, ''),
(2, 'hi', 'Xin chào', 100001, '2017-07-18', '2017-07-18', 1, 'en', 1, ''),
(3, 'Xin chào', 'Hi', 100000, '2017-07-18', '2017-07-18', 1, 'vi', 1, ''),
(4, 'Tên', 'Name', 100000, '2017-07-18', '2017-07-18', 1, 'vi', 1, ''),
(5, 'name', 'Tên', 100000, '2017-08-07', '2017-08-17', 1, 'en', 1, ''),
(6, 'Age', 'Tuổi', 100000, '2017-08-07', '2017-08-10', 0, 'en', 2, ''),
(7, 'tree', 'cây, cái cây', 100000, '2017-08-07', '2017-08-15', 0, 'en', 2, ''),
(10, 'Hot', 'nóng', 100000, '2017-08-07', '2017-08-07', 0, 'en', 2, ''),
(11, 'Nóng', 'hot', 100000, '2017-08-07', '2017-08-07', 0, 'vi', 2, ''),
(12, 'Big', 'to', 100000, '2017-08-10', '2017-08-10', 1, 'en', 1, ''),
(13, 'gfdgsd1', 'dsd1', 100000, '2017-08-12', '2017-08-17', 0, 'vi', 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `ID` int(11) NOT NULL,
  `EdictID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DateCreate` date NOT NULL,
  `Star` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`ID`, `EdictID`, `UserID`, `DateCreate`, `Star`) VALUES
(1, 5, 100000, '2017-08-17', 2),
(2, 5, 100002, '2017-08-18', 5);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `Name`, `Active`) VALUES
(1, 'Administrator', 1),
(2, 'Quản trị', 1),
(3, 'Người dùng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID`, `Name`, `Active`) VALUES
(1, 'Đã duyệt', 1),
(2, 'Chờ duyệt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `FullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserCreate` int(11) NOT NULL,
  `DateCreate` date NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `Password`, `Active`, `RoleId`, `FullName`, `UserCreate`, `DateCreate`, `Email`) VALUES
(100000, 'admin', 'defac44447b57f152d14f30cea7a73cb', 1, 1, 'Administrator', 0, '2017-07-18', 'kapigon@gmail.com'),
(100001, 'kapigon', '827ccb0eea8a706c4c34a16891f84e7b', 1, 3, 'Lee Hòa', 100000, '2017-07-19', ''),
(100002, 'Test', '827ccb0eea8a706c4c34a16891f84e7b', 1, 3, 'Test', 100000, '2017-07-19', 'test@gmail.com'),
(100003, 'boku', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, 'hot', 0, '2017-08-14', ''),
(100004, 'Test123', 'defac44447b57f152d14f30cea7a73cb', 0, 3, 'Test', 0, '2017-08-15', ''),
(100005, 'abc', 'e10adc3949ba59abbe56e057f20f883e', 0, 3, 'abc', 0, '2017-08-15', 'abc@gmail.com'),
(100006, 'xyz', 'e10adc3949ba59abbe56e057f20f883e', 0, 3, 'xyz', 0, '2017-08-15', 'xyz@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `edict`
--
ALTER TABLE `edict`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `edict`
--
ALTER TABLE `edict`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100007;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
