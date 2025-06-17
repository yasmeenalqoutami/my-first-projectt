-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 12:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smoker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aId` int(20) NOT NULL,
  `aName` varchar(50) NOT NULL,
  `aPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aId`, `aName`, `aPassword`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cId` int(255) NOT NULL,
  `cName` varchar(50) NOT NULL,
  `cImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cId`, `cName`, `cImage`) VALUES
(1, 'مجتمع الدعم عبر الإنترنت', 'Category/2d6664ee486804c71b59244d796e452d01.jpg'),
(2, 'خطوات عملية للإقلاع', 'Category/49460b707a59e67f928189a1859e282703.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chatting`
--

CREATE TABLE `chatting` (
  `cId` int(11) NOT NULL,
  `uId` varchar(50) NOT NULL,
  `sId` varchar(50) NOT NULL,
  `Message` text NOT NULL,
  `status` int(1) DEFAULT 0,
  `Posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chatwithuser`
--

CREATE TABLE `chatwithuser` (
  `cId` int(255) NOT NULL,
  `uId` varchar(50) NOT NULL,
  `sId` varchar(50) NOT NULL,
  `Message` text NOT NULL,
  `status` int(1) NOT NULL,
  `Posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consultant`
--

CREATE TABLE `consultant` (
  `cId` int(255) NOT NULL,
  `cName` varchar(50) NOT NULL,
  `cImage` text NOT NULL,
  `cPrice` varchar(3) NOT NULL,
  `cEmail` varchar(50) NOT NULL,
  `cPassword` varchar(50) NOT NULL,
  `cStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consultant`
--

INSERT INTO `consultant` (`cId`, `cName`, `cImage`, `cPrice`, `cEmail`, `cPassword`, `cStatus`) VALUES
(1, 'doctor 1', 'Category/97a97dcd5c2505a479df9f6840b64454assets_task_01jt96f7xdew8sq9why0d0xj3x_1746213046_img_0.webp', '1', '1@gmail.com', 'asd;asd;askfa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `Id` int(255) NOT NULL,
  `uId` varchar(50) NOT NULL,
  `sType` varchar(50) NOT NULL,
  `sPrice` varchar(3) NOT NULL,
  `nCigarettes` int(2) NOT NULL,
  `nDaily` int(2) NOT NULL,
  `uStatus` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pId` int(255) NOT NULL,
  `pName` varchar(100) NOT NULL,
  `pImage` text NOT NULL,
  `pPrice` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pId`, `pName`, `pImage`, `pPrice`) VALUES
(1, 'Plastic plates 8 strong', 'Category/97a97dcd5c2505a479df9f6840b64454assets_task_01jt96f7xdew8sq9why0d0xj3x_1746213046_img_0.webp', '2');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `sId` int(255) NOT NULL,
  `cId` varchar(50) NOT NULL,
  `supported` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`sId`, `cId`, `supported`) VALUES
(2, 'خطوات عملية للإقلاع', 'يمكن أن تكون الرغبة الملحّة في تدخين التبغ قوية بالنسبة إلى معظم الأشخاص الذين يتعاطون التبغ. ومع ذلك بإمكانك التغلب على هذه الرغبات الملحّة.\r\n\r\nوعندما تشعر بالرغبة في تدخين التبغ، ضع في حسبانك أنه مهما كانت قوة تلك الرغبة، فإنها ستزول في غضون 5 أو 10 دقائق سواء دخنت سيجارة أو أخذت قطعة من تبغ المضغ أم لا. وفي كل مرة تقاوم فيها الرغبة الملحّة لتعاطي التبغ، تقترب خطوة من الإقلاع عن تعاطيه نهائيًا، وهذا ما نهدف إليه في نهاية المطاف.\r\n\r\nفيما يأتي 10 طرق لمساعدتك على مقاومة الرغبة في التدخين أو تعاطي التبغ في حالة الرغبة الملحّة.'),
(3, 'مجتمع الدعم عبر الإنترنت', 'يمكن أن تساعدك العلاجات ببدائل النيكوتين قصيرة المفعول -مثل العلكة أو أقراص الاستحلاب أو بخاخات الأنف أو المِنشَقات التي تحتوي على النيكوتين- في التغلب على الرغبة الملحة في التدخين. وعادةً ما تكون هذه العلاجات القصيرة المفعول آمنة للاستخدام بجانب لصقات النيكوتين طويلة المفعول أو أحد عقاقير الإقلاع عن التدخين.');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `Id` int(255) NOT NULL,
  `uId` varchar(50) NOT NULL,
  `sType` varchar(50) NOT NULL,
  `nCigarettes` int(5) NOT NULL,
  `log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uId` int(255) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `uName` varchar(50) NOT NULL,
  `uEmail` varchar(50) NOT NULL,
  `uPhone` int(10) NOT NULL,
  `uPassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `chatting`
--
ALTER TABLE `chatting`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `chatwithuser`
--
ALTER TABLE `chatwithuser`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `consultant`
--
ALTER TABLE `consultant`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pId`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`sId`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chatting`
--
ALTER TABLE `chatting`
  MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatwithuser`
--
ALTER TABLE `chatwithuser`
  MODIFY `cId` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultant`
--
ALTER TABLE `consultant`
  MODIFY `cId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `sId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uId` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
