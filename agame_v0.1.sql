-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2020 at 08:41 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.29-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agame`
--

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `m_id` int(11) NOT NULL,
  `m_version` varchar(16) NOT NULL,
  `m_tiledversion` varchar(16) NOT NULL,
  `m_orientation` varchar(16) NOT NULL,
  `m_renderorder` varchar(16) NOT NULL,
  `m_width` smallint(6) NOT NULL,
  `m_height` smallint(6) NOT NULL,
  `m_tilewidth` smallint(6) NOT NULL,
  `m_tileheight` smallint(6) NOT NULL,
  `m_nextobjectid` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tile`
--

CREATE TABLE `tile` (
  `t_id` int(11) NOT NULL,
  `t_tiletype` int(11) NOT NULL,
  `t_x` int(11) NOT NULL,
  `t_y` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tileset`
--

CREATE TABLE `tileset` (
  `ts_id` int(11) NOT NULL,
  `ts_source` varchar(64) NOT NULL,
  `ts_firstgid` smallint(6) NOT NULL,
  `ts_comment` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tiletype`
--

CREATE TABLE `tiletype` (
  `tt_id` int(11) NOT NULL,
  `tt_height` int(11) NOT NULL,
  `tt_width` int(11) NOT NULL,
  `tt_image` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tile`
--
ALTER TABLE `tile`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `tiletype` (`t_tiletype`),
  ADD KEY `t_x` (`t_x`),
  ADD KEY `t_y` (`t_y`);

--
-- Indexes for table `tileset`
--
ALTER TABLE `tileset`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `tiletype`
--
ALTER TABLE `tiletype`
  ADD PRIMARY KEY (`tt_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
