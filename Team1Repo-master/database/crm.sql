-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 198.71.227.98:3306
-- Generation Time: Feb 28, 2016 at 08:18 PM
-- Server version: 5.5.43-37.2-log
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `province` text NOT NULL,
  `postalCode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street`, `city`, `province`, `postalCode`) VALUES
(1, '1700 Wilson Ave #K009', 'Toronto', 'ON', 'M3L1B2'),
(2, '1571 Sandhurst Circle', 'Scarborough', 'ON', 'M1V1V2'),
(3, '7181 Yonge Suite 41', 'Thronhill', 'ON', 'L3T2A9'),
(4, '1575 Jane St. Unit 4', 'Toronto', 'ON', 'M9N2R3'),
(5, '', '0', '', ''),
(6, '', '0', '', ''),
(7, '', '0', '', ''),
(8, '', '0', '', ''),
(9, 's', 'd', 'f', 'd'),
(10, '', '0', '', ''),
(11, 'as', 'd', 'ON', 'm3m3m3'),
(12, 'as', 'd', 'ON', 'm3m3m3'),
(13, 'as', 'd', 'ON', 'm3m3m3'),
(14, 'adsf', 'asdf', 'ON', 'm1m1m1'),
(15, 'Someplace', 'Toronto', 'ON', 'M0M0M0'),
(16, 'Someplace fancy', 'Toronto', 'ON', 'M1M1M1'),
(17, 'Big Street', 'Toronto', 'ON', 'M8M8M8'),
(18, 'Big Street', 'Toronto', 'ON', 'M9M9M9'),
(19, 'Main Street', 'Hamilton', 'ON', 'M6M6M6'),
(20, 'Main Street', 'Miltin', 'ON', 'M7M7M7'),
(21, 'Main Street', 'Toronto', 'ON', 'm3m2w2'),
(22, '', 'sldkjf', 'ON', 'M3M2M2'),
(23, 'd', 'd', 'ON', 'k'),
(24, 'lkasdjflkasdjf', 'dlkfjlskdjf', 'ON', 'lkdsjfs'),
(25, 'd', 'd', 'ON', 'd'),
(26, 'djalfkjd', 'klsdjf', 'ON', 'lsdkjf'),
(27, 'lksdjf', 'lkdjflksj', 'ON', 'skljdf'),
(28, '70 The Pond Rd.', 'Toronto', 'ON', 'M3M2M1'),
(29, 'd', 'd', 'ON', 'd'),
(30, 'asdkfdsjk', 'jshdf', 'ON', 'm3m3m3'),
(31, '', '', 'ON', ''),
(32, 'asdfadsf', 'ccaass', 'm2m2m2', ''),
(33, 'George Street', 'Georgia', 'ON', 'M0G0G0');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `saleId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `saleId`, `userId`, `timestamp`, `context`) VALUES
(1, 13, 1, '2016-02-29 03:15:19', 'First sale'),
(2, 13, 1, '2016-02-29 03:16:11', 'Changed Phone number');

-- --------------------------------------------------------

--
-- Table structure for table `creditRequest`
--

CREATE TABLE `creditRequest` (
  `id` int(11) NOT NULL,
  `membershipId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `storeCode` varchar(3) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('requested','approved','declined') NOT NULL,
  `amount` double NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditRequest`
--

INSERT INTO `creditRequest` (`id`, `membershipId`, `userId`, `adminId`, `storeCode`, `timestamp`, `status`, `amount`, `comment`) VALUES
(1, 123122, 1, 0, 'W', '2016-02-22 01:50:21', 'requested', 333, '0'),
(2, 123123, 1, 0, 'W', '2016-02-22 01:50:38', 'requested', 234235235, '0'),
(3, 123122, 1, 0, 'W', '2016-02-22 02:00:15', 'requested', 33, '0'),
(4, 123122, 1, 0, 'W', '2016-02-22 02:02:16', 'requested', 234234, 'Updated on 2016-02-22 by aaa:<br>asdfasdf'),
(5, 123122, 1, 0, 'W', '2016-02-22 02:04:23', 'requested', 33, 'Updated on 2016-02-22 by Jung Choi:<br>asdfasdgadsg'),
(6, 123122, 1, 0, 'S', '2016-02-24 21:06:13', 'requested', 399, 'Updated on 2016-02-24 by Jung Choi:<br>demo 123');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `addressId` int(11) NOT NULL,
  `phoneNumber2` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `phoneNumber`, `firstName`, `lastName`, `addressId`, `phoneNumber2`) VALUES
(3, '', '2456354253', 'ads', 'd', 13, ''),
(4, '', '1234156234', 'adsf', 'adsf', 14, ''),
(5, '', '4164445555', 'Jung', 'Choi', 15, ''),
(6, 'jsfkj@askfhk.com', '0333444232', 'Jack', 'Box', 16, '4442325555'),
(7, 'jsfkj@askfhk.com', '0333444232', 'Bob', 'Smith', 17, '4442323777'),
(8, 'jsfkj@askfhk.com', '4164578890', 'Tommy', 'Something', 18, '4442325555'),
(9, 'bigboy@something.com', '4168889999', 'Donny', 'Joe', 19, ''),
(10, '', '4454454466', 'John', 'Johnson', 20, ''),
(11, 'someone@gmail.com', '4445557777', 'Jack', 'Something', 21, '4445556666'),
(12, 'asdasfd@@dd', '3423', 'd', 'd', 22, '1'),
(13, 'jdf@gmdi.com', '3', 'd', 'd', 23, '2'),
(14, 'djlksajd@gmail.com', '2309423094', 'dsdflkj', 'dlkfjasldkjf', 24, ''),
(15, 'lksj@gmail.com', '23498', 'd', 'd', 25, ''),
(16, 'dkjsdkfaj@gmail.com', '0239480923', 'sadflkj', 'ldksfjsklj', 26, ''),
(17, 'slkdjfalskjdf@gmail.com', '3209423904', 'sdlfkj', 'dlkjfslkjfd', 27, ''),
(18, 'sdlfkj@asdfasdf', '6478382000', 'FirstName', 'LastName', 28, '2347773823'),
(19, '', '34', 'ddd', 'ddd', 29, ''),
(20, '', '2304929034', 'asdf', 'asdfj', 30, ''),
(21, '', '', '', '', 31, ''),
(22, '', '2342344235', 'asdf', 'adsf', 32, ''),
(23, 'gcostanza@georgia.ca', '4445557799', 'George', 'Costanza', 33, '');

-- --------------------------------------------------------

--
-- Table structure for table `identification`
--

CREATE TABLE `identification` (
  `code` varchar(2) NOT NULL,
  `description` text NOT NULL,
  `type` enum('Primary','Secondary') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identification`
--

INSERT INTO `identification` (`code`, `description`, `type`) VALUES
('cc', 'Credit Card', 'Primary'),
('cn', 'CNIV Card', 'Secondary'),
('dd', 'Department of Defense', 'Secondary'),
('dl', 'Driver''s License', 'Primary'),
('gp', 'Government Photo ID', 'Secondary'),
('ni', 'Native Indian Status Card', 'Secondary'),
('pp', 'Passport', 'Secondary'),
('pr', 'Permanent Resident Card', 'Secondary'),
('si', 'SIN', 'Primary'),
('wv', 'Work Visa', 'Secondary');

-- --------------------------------------------------------

--
-- Table structure for table `koodoaccount`
--

CREATE TABLE `koodoaccount` (
  `id` int(11) NOT NULL,
  `accountPin` int(11) NOT NULL,
  `accountNumber` text NOT NULL,
  `customerId` int(11) NOT NULL,
  `billingCycle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koodoaccount`
--

INSERT INTO `koodoaccount` (`id`, `accountPin`, `accountNumber`, `customerId`, `billingCycle`) VALUES
(1, 0, '', 0, 0),
(2, 0, '', 0, 0),
(3, 0, '2353435234', 3, 0),
(4, 0, '2541562345', 4, 0),
(5, 0, '1234512345', 5, 4),
(6, 0, '4445556666', 9, 25),
(7, 0, '3333333333', 10, 21),
(8, 1234, '1234567890', 11, 30),
(9, 0, '1234566999', 23, 30);

-- --------------------------------------------------------

--
-- Table structure for table `koodoservice`
--

CREATE TABLE `koodoservice` (
  `id` int(11) NOT NULL,
  `phoneNumber` text NOT NULL,
  `imeiNumber` text NOT NULL,
  `simNumber` text NOT NULL,
  `giftCardUsed` varchar(5) NOT NULL,
  `plan` int(11) NOT NULL,
  `addOn` int(11) NOT NULL,
  `tab` int(11) NOT NULL,
  `modelCode` text NOT NULL,
  `koodoAccountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koodoservice`
--

INSERT INTO `koodoservice` (`id`, `phoneNumber`, `imeiNumber`, `simNumber`, `giftCardUsed`, `plan`, `addOn`, `tab`, `modelCode`, `koodoAccountId`) VALUES
(6, '1234156234', '615423651423561', '6534162534162534615', 'N/A', 0, 0, 22, '', 4),
(7, '1234156234', '615423651423561', '6534162534162534615', 'N/A', 0, 0, 22, '', 0),
(8, '1234156234', '615423651423561', '6534162534162534615', 'N/A', 0, 0, 22, 'C_CORE_B', 0),
(9, '4164445555', '123451234512345', '1234512345123451234', 'N/A', 10, 10, 100, 'C_CORE_B', 5),
(10, '4164445555', '123451234512345', '1234512345123451234', 'N/A', 10, 10, 100, 'C_CORE_B', 0),
(11, '4164445555', '123451234512345', '1234512345123451234', 'N/A', 10, 10, 100, 'C_CORE_B', 0),
(12, '4164445555', '123451234512345', '1234512345123451234', 'N/A', 10, 10, 100, 'C_CORE_B', 0),
(13, '4164445555', '123451234512345', '1234512345123451234', 'N/A', 10, 10, 100, 'C_CORE_B', 0),
(14, '0333444232', '123451234512345', '1234512345123451234', 'NO', 66, 22, 100, 'C_D320', 0),
(15, '0333444232', '123451234512345', '1234512345123451234', 'NO', 100, 27, 50, 'C_CORE_W', 0),
(16, '4164578890', '123451234512345', '1234512345123451234', 'YES', 100, 20, 70, 'C_CORE_W', 0),
(17, '4168889999', '098765432123456', '0987654321234567890', 'NO', 80, 33, 120, 'K_PRIME', 6),
(18, '4454454466', '121212121212121', '1212121212121212121', 'YES', 22, 40, 88, 'C_D320', 7),
(19, '4445557777', '123456789012345', '1234567890123456789', 'YES', 50, 20, 200, 'K_LGG3', 8),
(20, '4445557799', '123456789013345', '1234567890123453389', 'N/A', 20, 20, 50, 'K_I5C_WH', 9);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `balance` double NOT NULL,
  `VIPStartDate` date DEFAULT NULL,
  `emailPassword` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `customerId`, `startDate`, `balance`, `VIPStartDate`, `emailPassword`) VALUES
(2, 21, '2016-02-04 18:22:01', 0, NULL, ''),
(3, 21, '2016-02-04 18:19:24', 0, NULL, ''),
(33, 1123, '2016-01-28 03:11:24', 0, NULL, ''),
(123, 123, '2016-01-28 03:07:54', 0, NULL, ''),
(444, 1123, '2016-01-28 03:12:07', 0, '2016-01-28', ''),
(2344, 1123, '2016-01-28 03:08:48', 0, NULL, 'dd'),
(23984, 17, '2016-01-28 04:56:04', 0, '2016-01-28', 'slkjdfk'),
(44234, 1123, '2016-01-28 03:12:20', 0, '2016-01-28', ''),
(93850, 16, '2016-01-28 04:55:31', 0, '2016-01-28', 'slkjfalkjdf'),
(120938, 15, '2016-01-28 04:54:39', 0, NULL, '09duf'),
(123111, 20, '2016-01-30 19:22:45', 39, '2016-01-30', ''),
(123122, 22, '2016-02-22 00:17:26', 8683, '2016-02-22', ''),
(123123, 18, '2016-01-28 17:51:49', 90, '2016-02-04', ''),
(123124, 18, '2016-01-28 18:12:42', 0, NULL, ''),
(123125, 18, '2016-01-28 18:16:03', 0, NULL, ''),
(123126, 18, '2016-01-28 18:17:37', 0, NULL, ''),
(123133, 18, '2016-01-28 18:19:18', 0, NULL, ''),
(234234, 19, '2016-01-29 02:00:11', 72.34, '2016-01-29', ''),
(234239, 13, '2016-01-28 04:50:57', 0, '2016-01-28', 'asdkfjkej3##'),
(234923, 14, '2016-01-28 04:53:17', 0, '2016-01-28', 'alkdsjflkasjd##'),
(239482, 18, '2016-01-29 01:47:40', 0, NULL, ''),
(342384, 12, '2016-01-28 04:48:07', 0, '2016-01-28', 'sdlkfj');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `code` varchar(50) NOT NULL,
  `modelDescription` text NOT NULL,
  `modelPrice` int(11) NOT NULL,
  `modelCategory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`code`, `modelDescription`, `modelPrice`, `modelCategory`) VALUES
('C_CORE_B', 'CPO: Samsung Galaxy Core', 118, 'CPO'),
('C_CORE_W', 'CPO: Samsung Galaxy Core', 118, 'CPO'),
('C_D320', 'CPO: HTC Desire 320', 67, 'CPO'),
('C_GS3_B', 'CPO: Samsung Galaxy S III', 105, 'CPO'),
('C_GS3_W', 'CPO: Samsung Galaxy S III', 101, 'CPO'),
('C_MTG', 'CPO: Moto G', 105, 'CPO'),
('C_NEX5', 'CPO: LG Nexus 5', 252, 'CPO'),
('C_NOTE2', 'CPO:Samsung Galaxy Note II', 210, 'CPO'),
('K_A392A', '', 0, 'Postpaid'),
('K_GS3_B', '', 0, 'Postpaid'),
('K_GS4_B', 'Samsung Galaxy S IV', 400, 'Postpaid'),
('K_GS4_W', 'Samsung Galaxy S IV', 400, 'Postpaid'),
('K_GS5', 'Samsung Galaxy S V', 635, 'Postpaid'),
('K_GS6', 'Samsung Galaxy S6', 760, 'Postpaid'),
('K_GS6EDGE', 'Samsung Galaxy S6 Edge', 860, 'Postpaid'),
('K_I4S_B', '', 0, 'Postpaid'),
('K_I4S_W', '', 0, 'Postpaid'),
('K_I5C_WH', '', 0, 'Postpaid'),
('K_I5S_GL', '', 0, 'Postpaid'),
('K_I6P_16GB', 'Applie iPhone 6 Plus 16GB', 989, 'Postpaid'),
('K_I6S_16GB_GY', 'Apple iPhone 6S 16GB Space Grey', 915, 'Postpaid'),
('K_I6S_16GB_RG', 'Apple iPhone 6S 16GB Rose Gold', 915, 'Postpaid'),
('K_I6S_64GB', 'Apple iPhone 6S 64GB', 1055, 'Postpaid'),
('K_I6_16GB', 'Apple iPhone 6 16GB', 864, 'Postpaid'),
('K_I6_64GB', 'Apple iPhone 6 64GB', 989, 'Postpaid'),
('K_IDOL3', 'Alcatel One Touch Idol3', 312, 'Postpaid'),
('K_LGG3', 'LG G3', 410, 'Postpaid'),
('K_M8', 'HTC ONE(M8)', 360, 'Postpaid'),
('K_MTE_B', 'Motorola E Black', 150, 'Postpaid'),
('K_MTE_W', 'Motorola E White', 150, 'Postpaid'),
('K_MTG', '', 0, 'Postpaid'),
('K_MTG2_B', 'Moto G (2015 Ver.)', 216, 'Postpaid'),
('K_MTX', 'Moto X Play', 410, 'Postpaid'),
('K_NEX5', '', 0, 'Postpaid'),
('K_NOTE4', 'Samsung Galaxy Note IV', 810, 'Postpaid'),
('K_PRIME', 'Samsung Galaxy Grand Prime', 240, 'Postpaid'),
('OP', '', 0, 'OP'),
('P_D320', '', 0, 'Prepaid'),
('P_MTG', '', 0, 'Prepaid'),
('P_PIXI3_4', 'Alcatel One Touch Pixi3 (4)', 120, 'Prepaid'),
('P_PIXI3_45', 'Alcatel One Touch Pixi3 (4.5)', 150, 'Prepaid'),
('P_Y330', 'Prepaid Y330', 0, 'Prepaid'),
('U_7024W', 'Alcatel Fierce 7024W', 100, 'Unlocked'),
('U_EVOLVE2', 'Alcatel Evolve2', 80, 'Unlocked'),
('U_FIERCE2', 'Alcatel Fierce2', 125, 'Unlocked'),
('U_GFLEX', 'LG GFLEX', 310, 'Unlocked'),
('U_GGIO', 'Samsung GIO S5660', 60, 'Unlocked'),
('U_GS2', 'Samsung Galaxy S2', 100, 'Unlocked'),
('U_GS3_747', 'Samsung Galaxy S3 I747', 150, 'Unlocked'),
('U_GS3_999', 'Samsung Galaxy S3 T999', 200, 'Unlocked'),
('U_GS3_999_32G', 'Samsung Galaxy S3 T999 (32GB)', 230, 'Unlocked'),
('U_GS4', 'Samsung Galaxy S4', 160, 'Unlocked'),
('U_GS5', 'Samsung Galaxy S5', 270, 'Unlocked'),
('U_GW300', 'LG GW300', 370, 'Unlocked'),
('U_I4', 'Apple iPhone 4', 480, 'Unlocked'),
('U_I4S', 'iPhone 4S', 50, 'Unlocked'),
('U_I5C', 'Apple iPhone5 C', 210, 'Unlocked'),
('U_I5S', 'Apple Iphone 5S', 225, 'Unlocked'),
('U_I5_32G', 'Apple iPhone5', 300, 'Unlocked'),
('U_L70', 'LG L70', 280, 'Unlocked'),
('U_L90', 'LG L90', 400, 'Unlocked'),
('U_LIGHT', 'Samsung Galaxy Light', 320, 'Unlocked'),
('U_MTE', 'Moto E (1st Gen)', 470, 'Unlocked'),
('U_NEX4', 'LG Nexus 4', 400, 'Unlocked'),
('U_NOTE2', 'Samsung Galaxy Note 2', 150, 'Unlocked'),
('U_NOTE3', 'Samsung Galaxy Note3', 200, 'Unlocked');

-- --------------------------------------------------------

--
-- Table structure for table `referralRequest`
--

CREATE TABLE `referralRequest` (
  `id` int(11) NOT NULL,
  `referralId` text NOT NULL,
  `referringId` text NOT NULL,
  `storeCode` varchar(3) NOT NULL,
  `status` enum('requested','approved','declined') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL DEFAULT '-1',
  `comment` text NOT NULL,
  `accountNumber` text NOT NULL,
  `phoneNumber` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referralRequest`
--

INSERT INTO `referralRequest` (`id`, `referralId`, `referringId`, `storeCode`, `status`, `timestamp`, `userId`, `adminId`, `comment`, `accountNumber`, `phoneNumber`) VALUES
(1, '123123', '234234', 'S', 'approved', '2016-01-30 03:26:29', 1, 1, 'Updated on 2016-02-22 by Jung Choi:<br>good', '2309482093', '2342342938'),
(2, '123123', '235823', 'S', 'declined', '2016-01-30 03:26:34', 1, 1, 'Updated on 2016-02-22 by Jung Choi:<br>dd', '3580293850', '8309582039'),
(3, '123123', '234234', 'S', 'approved', '2016-01-30 03:27:39', 1, 1, 'Updated on 2016-02-24 by Jung Choi:<br>ewerwerre', '2342348092', '2342342343'),
(4, '123123', '920384', 'S', 'declined', '2016-01-30 04:09:05', 1, 1, 'Updated on 2016-02-24 by Jung Choi:<br>sadasd', '2384092348', '0923480283'),
(5, '123123', '342342', 'S', 'approved', '2016-02-04 17:17:44', 1, 1, 'Updated on 2016-02-22 by Jung Choi:<br>123123', '23423424', '2342343242'),
(6, '123122', '333222', 'W', 'approved', '2016-02-22 01:26:33', 1, 1, 'Updated on 2016-02-22 by Jung Choi:<br>asdf', '1231231231', '1231231231'),
(7, '123122', '234352', 'W', 'declined', '2016-02-22 05:20:24', 1, 1, 'Updated on 2016-02-24 by Jung Choi:<br>Account Closed.', '1351351351', '1135135135'),
(8, '123122', '817234', 'W', 'requested', '2016-02-22 05:22:22', 1, -1, '', '1256341562', '1625345612'),
(9, '123122', '239847', 'W', 'requested', '2016-02-22 05:22:32', 1, -1, '', '8749823749', '7879837492'),
(10, '123122', '123122', 'W', 'requested', '2016-02-22 05:24:17', 1, -1, '', '6253445623', '2634464443'),
(11, '123122', '123123', 'W', 'requested', '2016-02-22 05:24:27', 1, -1, '', '2635446234', '2345646234');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `dateOfSale` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL,
  `typeCode` char(11) NOT NULL,
  `koodoServiceId` int(11) NOT NULL,
  `storeCode` char(11) NOT NULL,
  `primaryIdCode` varchar(2) NOT NULL,
  `secondaryIdCode` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `dateOfSale`, `userId`, `typeCode`, `koodoServiceId`, `storeCode`, `primaryIdCode`, `secondaryIdCode`) VALUES
(6, '2015-12-02 16:23:54', 2, 'E', 13, 'S', 'cc', 'cc'),
(7, '2015-12-04 16:14:21', 1, 'D', 14, 'S', 'si', 'gp'),
(8, '2015-12-04 20:05:41', 2, 'E', 15, 'S', 'cc', 'cc'),
(9, '2015-12-04 20:10:40', 2, 'E', 16, 'S', 'dl', 'cn'),
(10, '2015-12-05 04:11:05', 1, 'E', 17, 'S', 'si', 'ni'),
(11, '2015-12-07 04:44:49', 2, 'U', 18, 'S', 'si', 'dl'),
(12, '2015-12-07 15:18:37', 1, 'P', 19, 'S', 'dl', 'cn'),
(13, '2016-02-29 03:15:19', 1, 'D', 20, 'S', 'si', 'dd');

-- --------------------------------------------------------

--
-- Table structure for table `salestatus`
--

CREATE TABLE `salestatus` (
  `id` int(11) NOT NULL,
  `status` enum('sold','deleted','returned') NOT NULL,
  `userId` int(11) NOT NULL,
  `saleId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salestatus`
--

INSERT INTO `salestatus` (`id`, `status`, `userId`, `saleId`, `timestamp`) VALUES
(1, 'sold', 0, 0, '2015-12-02 04:33:14'),
(2, 'sold', 0, 0, '2015-12-02 04:38:12'),
(3, 'sold', 1, 3, '2015-12-02 04:49:48'),
(4, 'sold', 2, 4, '2015-12-02 16:19:26'),
(5, 'sold', 2, 5, '2015-12-02 16:22:26'),
(6, 'sold', 2, 6, '2015-12-02 16:23:54'),
(7, 'sold', 1, 7, '2015-12-04 16:14:21'),
(8, 'sold', 2, 8, '2015-12-04 20:05:41'),
(9, 'sold', 2, 9, '2015-12-04 20:10:40'),
(10, 'sold', 1, 10, '2015-12-05 04:11:05'),
(11, 'sold', 2, 11, '2015-12-07 04:44:49'),
(12, 'sold', 1, 12, '2015-12-07 15:18:37'),
(13, 'sold', 1, 13, '2016-02-29 03:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `code` varchar(1) NOT NULL,
  `phoneNumber` text NOT NULL,
  `addressId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`code`, `phoneNumber`, `addressId`) VALUES
('S', '6477648188', 1),
('T', '4166450861', 4),
('W', '6473453570', 2),
('Y', '64734738400', 3);

-- --------------------------------------------------------

--
-- Table structure for table `strike`
--

CREATE TABLE `strike` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  `status` enum('active','cancelled','expired') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strike`
--

INSERT INTO `strike` (`id`, `userId`, `adminId`, `timestamp`, `comment`, `status`) VALUES
(1, 2, 1, '0000-00-00 00:00:00', 'Late', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `storeCode` varchar(3) NOT NULL,
  `userId` int(11) NOT NULL,
  `VIPServiceId` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `membershipId` int(11) NOT NULL,
  `celloNumber` text NOT NULL,
  `type` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `storeCode`, `userId`, `VIPServiceId`, `amount`, `membershipId`, `celloNumber`, `type`, `timestamp`) VALUES
(1, 'S', 1, NULL, 398, 23984, '2394892', 'Activation Credit', '2016-01-30 19:53:32'),
(2, 'S', 1, NULL, 33, 123123, '', 'Activation Credit', '2016-01-30 19:53:32'),
(3, 'S', 1, NULL, 33, 239482, '', 'Activation Credit', '2016-01-30 19:53:32'),
(4, 'S', 1, NULL, 34, 234234, '', 'Activation Credit', '2016-01-30 19:53:32'),
(5, 'S', 1, NULL, 39, 123111, '', 'Activation Credit', '2016-01-30 19:53:32'),
(6, 'S', 1, 99, 0, 123111, '2342342342342', 'VIP Activation', '2016-01-30 19:53:32'),
(7, 'S', 1, 99, 0, 123123, '3443512312312', 'VIP Activation', '2016-02-04 17:17:29'),
(8, 'S', 1, NULL, -21, 234234, '2342390482390', 'Credit Redemption', '2016-02-04 18:05:43'),
(9, 'S', 1, NULL, -1.11, 234234, '1231231231231', 'Credit Redemption', '2016-02-04 18:07:27'),
(10, 'W', 1, NULL, 8999, 123122, '', 'Activation Credit', '2016-02-22 00:17:26'),
(11, 'W', 1, 99, 0, 123122, '3523523523523', 'VIP Activation', '2016-02-22 00:45:57'),
(12, 'W', 1, 99, 0, 123122, '3523523523523', 'VIP Activation', '2016-02-22 00:46:10'),
(13, '', 1, NULL, -100, 123122, '1652436512435', 'Credit Redemption', '2016-02-22 01:23:19'),
(14, 'W', 1, NULL, -123, 123122, '1231231231231', 'Credit Redemption', '2016-02-22 01:24:45'),
(15, 'W', 1, 99, 0, 123122, '1231231231231', 'VIP Activation', '2016-02-22 03:25:36'),
(16, 'W', 1, 1, 33, 123122, '3423423423423', 'Screen Protector', '2016-02-22 03:49:38'),
(17, 'W', 1, 3, 33, 123122, '3312312312312', 'Screen Protector', '2016-02-22 03:50:00'),
(18, 'W', 1, NULL, 30, 123123, 'null', 'Referral Credit', '2016-02-22 05:08:51'),
(19, 'W', 1, NULL, 30, 234234, 'null', 'Referral Credit', '2016-02-22 05:08:51'),
(20, 'W', 1, NULL, 30, 123122, 'null', 'Referral Credit', '2016-02-22 05:14:47'),
(21, 'W', 1, NULL, 30, 123123, 'null', 'Referral Credit', '2016-02-22 05:15:23'),
(22, 'S', 1, NULL, -123, 123122, '2309480923840', 'Credit Redemption', '2016-02-24 21:05:56'),
(23, 'S', 1, NULL, 30, 123123, 'null', 'Referral Credit', '2016-02-24 21:06:50'),
(24, 'S', 1, NULL, 30, 234234, '', 'Referral Credit', '2016-02-24 21:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `category` text NOT NULL,
  `code` char(1) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`category`, `code`, `description`) VALUES
('Postpaid Service', 'D', 'DOA Exchange'),
('Postpaid Service', 'E', 'Remorse Exchange'),
('Postpaid Service', 'K', 'Koodo Activation'),
('Prepaid Service', 'P', 'Prepaid Handset'),
('Postpaid Service', 'T', 'Koodo Upgrade'),
('Prepaid Service', 'U', 'Unlocked Handset');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `userName` text NOT NULL,
  `passwordHash` text NOT NULL,
  `emailAddress` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `adminLevel` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `addressId`, `firstName`, `lastName`, `userName`, `passwordHash`, `emailAddress`, `phoneNumber`, `adminLevel`, `isActive`) VALUES
(1, 1, 'Jung', 'Choi', 'aaa', '$1$PQEAQacE$YURpf2w5cJ1gOY6q5CjU31', 'jgchoi@myseneca.ca', '', 9, 1),
(2, 2, 'Mark', 'Twain', 'MAX', '827ccb0eea8a706c4c34a16891f84e7b', 'fake@gmail.com', '', 9, 1),
(3, 1, 'user', 'user', 'bbb', '$1$PQEAQacE$YURpf2w5cJ1gOY6q5CjU31', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `VIPService`
--

CREATE TABLE `VIPService` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `VIPService`
--

INSERT INTO `VIPService` (`id`, `title`, `description`) VALUES
(1, 'Screen Protector', '2 Free screen protector during the VIP Period'),
(2, 'Phone Cleaning', 'Phone Cleaning Service'),
(3, 'Screen Protector', '2 Free screen protector during the VIP Period'),
(4, 'Phone Cleaning', 'Phone Cleaning Service'),
(5, 'Phone Discount', '$50 Discount on Handset Purchase'),
(6, 'Service Discount', '10% discount on any service'),
(7, 'Accessory Discount', '15% Discount for any accessories'),
(8, 'Contact Backup', 'Contact backup and restore service including email creation and keep track of emaill account/password information'),
(99, 'VIP Activation', 'Activate VIP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditRequest`
--
ALTER TABLE `creditRequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identification`
--
ALTER TABLE `identification`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `koodoaccount`
--
ALTER TABLE `koodoaccount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koodoservice`
--
ALTER TABLE `koodoservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `referralRequest`
--
ALTER TABLE `referralRequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salestatus`
--
ALTER TABLE `salestatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `strike`
--
ALTER TABLE `strike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `VIPService`
--
ALTER TABLE `VIPService`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `creditRequest`
--
ALTER TABLE `creditRequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `koodoaccount`
--
ALTER TABLE `koodoaccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `koodoservice`
--
ALTER TABLE `koodoservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `referralRequest`
--
ALTER TABLE `referralRequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `salestatus`
--
ALTER TABLE `salestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `strike`
--
ALTER TABLE `strike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `VIPService`
--
ALTER TABLE `VIPService`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
