-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 08:18 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clientmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 3261, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2019-10-21 07:01:36'),
(2, 'Admin2', 'admin2', 2876, 'admin2@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', '2019-10-21 07:01:36'),
(3, 'Admin3', 'admin3', 28762020, 'admin3@gmail.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '2019-10-21 07:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `tblclient`
--

CREATE TABLE `tblclient` (
  `UserID` int(10) NOT NULL,
  `AccountID` int(10) DEFAULT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Ip` varchar(120) DEFAULT NULL,
  `Package` varchar(120) DEFAULT NULL,
  `ContactNumber` text DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `AccountType` varchar(20) NOT NULL,
  `LastActiveDate` date DEFAULT NULL,
  `LastAddBillDate` date DEFAULT NULL,
  `Due` int(11) NOT NULL DEFAULT 0,
  `Subscription` int(11) NOT NULL DEFAULT 0,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclient`
--

INSERT INTO `tblclient` (`UserID`, `AccountID`, `Name`, `Address`, `Ip`, `Package`, `ContactNumber`, `CreationDate`, `AccountType`, `LastActiveDate`, `LastAddBillDate`, `Due`, `Subscription`, `Password`) VALUES
(1, 900370752, '												Sanjay Malhotra', 'ABC Private LimitedB-150,Okhla New ', 'New Delhi', '3mbps', '88888694', '2019-10-22 04:40:11', 'Active', '2020-07-11', '2020-07-01', 3500, 0, '62608e08adc29a8d6dbc9754e659f125'),
(2, 884010538, 'Sidharth Sukla', 'Infosys Pvt Ltd\r\nC-123, Sector 15 Noida ', 'Noida not', '4mbps', '4454545454', '2019-10-22 05:24:39', 'Active', '2020-07-05', '2020-07-01', 1400, 0, ''),
(6, 426546224, '						Anuj Kumar', 'New Delhi', 'New Delhi', '4mbps', '9354778033', '2019-11-27 16:00:24', 'Active', '2020-04-05', '2020-07-05', 2100, 1, ''),
(8, 612002420, 'GREGORY J LUTON', '3144  DOCTORS DRIVE', '10.1464.2646.', '1mbps', '1791979210', '2020-06-29 05:28:46', 'Active', '2020-03-05', '2020-07-05', 1000, 4, ''),
(9, 844887551, 'GREGORY J LUTON', '3144  DOCTORS DRIVE', '10.1464.2646.', '1mbps', '0179197921', '2020-06-29 13:50:18', 'Active', '2020-06-29', NULL, 0, 0, ''),
(10, 239761062, 'Raymond B Cooks', '3144  DOCTORS DRIVE', '10.1464.2646.', '3mbps', '0179197921', '2020-06-29 13:53:11', 'Inactive', NULL, NULL, 0, 0, ''),
(11, 414689033, 'GREGORY J LUTON', '3144  DOCTORS DRIVE', '10.1464.2646.', '2mbps', '0179197921', '2020-06-29 13:55:03', 'Active', '2020-07-02', NULL, 0, 0, ''),
(16, 527306658, 'Rafi Khan', '4755  Kerry Way', '1234.5564', '2mbps', '0156465489', '2020-07-04 10:27:19', 'Inactive', NULL, NULL, 0, 0, ''),
(17, 785038098, 'Junaid Khan', 'Chittagong', '1234.5564', '2mbps', '0184656', '2020-07-11 19:52:20', 'Inactive', NULL, NULL, 0, 0, '81dc9bdb52d04dc20036dbd8313ed055'),
(19, 827206557, 'Rafi Khan', '				goplgonj								', '15.154.592', '3mbps', '0141446635', '2020-07-18 01:17:13', 'Active', '2020-03-18', '2020-07-18', 16000, 4, '81dc9bdb52d04dc20036dbd8313ed055'),
(22, 926904763, 'Ripon', '				Belgium								', '192.162', '4mbps', '3498', '2020-07-19 17:58:44', 'Inactive', NULL, NULL, 0, 0, '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 348760525, 'selim', '				Belgium								', '192.162', '4mbps', '46546', '2020-07-19 18:05:02', 'Inactive', NULL, NULL, 0, 0, '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomplain`
--

CREATE TABLE `tblcomplain` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Issue` text NOT NULL,
  `ComplainDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Submission` text DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcomplain`
--

INSERT INTO `tblcomplain` (`ID`, `UserID`, `Issue`, `ComplainDate`, `Submission`) VALUES
(1, 1, 'Net Slow', '2020-07-11 18:55:19', 'Solved'),
(2, 1, 'no Internet', '2020-07-11 19:39:59', 'Solved'),
(3, 1, 'not working', '2020-07-19 08:53:57', 'Solved'),
(4, 1, 'net slow', '2020-07-19 08:54:43', 'Solved');

-- --------------------------------------------------------

--
-- Table structure for table `tblconfirmclient`
--

CREATE TABLE `tblconfirmclient` (
  `ID` int(11) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `ContactNumber` text DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Package` varchar(120) DEFAULT NULL,
  `Ip` varchar(120) DEFAULT NULL,
  `Password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblconfirmclient`
--

INSERT INTO `tblconfirmclient` (`ID`, `Name`, `ContactNumber`, `Address`, `Package`, `Ip`, `Password`) VALUES
(3, 'ataur', '88888496', '4755  Kerry Way', '2mbps', '4755  Kerry Way', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `EmployeeId` int(11) NOT NULL,
  `EmployeeName` varchar(30) NOT NULL,
  `EmployeeNumber` text NOT NULL,
  `EmployeeAddress` text NOT NULL,
  `JoinDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`EmployeeId`, `EmployeeName`, `EmployeeNumber`, `EmployeeAddress`, `JoinDate`) VALUES
(1, 'Imran Khan Pk', '01791979210', '1/D,Mirbhag,Rampura,Dhaka', '2020-07-18 19:26:42'),
(2, 'Modi', '01799268987', 'Dinajpur', '2020-07-18 19:26:42'),
(3, 'Sheik Hasina', '01799268457', 'Golpalgonj', '2020-07-18 19:26:42'),
(4, 'sujon', '017878956', 'Feni												', '2020-07-18 19:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(120) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About Us', 'bghjgjhg', NULL, NULL, '2019-10-24 07:54:52'),
(2, 'contactus', 'Contact Us', 'D-204, Hole Town South West,Delhi-110096,India', 'info@gmail.com', 8529631237, '2019-10-24 07:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblpaid`
--

CREATE TABLE `tblpaid` (
  `id` int(10) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PaidBill` varchar(120) DEFAULT NULL,
  `CollectedBy` varchar(120) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpaid`
--

INSERT INTO `tblpaid` (`id`, `UserID`, `PaidBill`, `CollectedBy`, `CreationDate`) VALUES
(20, 2, '120', 'Imran Khan', '2020-07-03 17:15:51'),
(21, 1, '300', 'Imran Khan', '2020-07-04 02:47:23'),
(22, 2, '200', 'Modi', '2020-07-04 02:47:53'),
(23, 1, '400', 'Imran Khan', '2020-07-04 13:44:19'),
(24, 2, '100', 'Imran Khan', '2020-07-04 14:28:55'),
(25, 1, '10', 'Imran Khan', '2020-07-08 16:01:43'),
(26, 6, '100', 'Imran Khan Pk', '2020-07-18 03:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `ServicePrice` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`ID`, `ServiceName`, `ServicePrice`, `CreationDate`) VALUES
(1, '3mbps', '4000', '2019-10-22 13:42:29'),
(2, '2mbps', '500', '2019-10-21 22:56:17'),
(4, '4mbps', '700', '2019-10-22 03:14:15'),
(14, '1mbps', '250', '2020-07-19 14:18:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblclient`
--
ALTER TABLE `tblclient`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `tblcomplain`
--
ALTER TABLE `tblcomplain`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblconfirmclient`
--
ALTER TABLE `tblconfirmclient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`EmployeeId`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpaid`
--
ALTER TABLE `tblpaid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblclient`
--
ALTER TABLE `tblclient`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblcomplain`
--
ALTER TABLE `tblcomplain`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblconfirmclient`
--
ALTER TABLE `tblconfirmclient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `EmployeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpaid`
--
ALTER TABLE `tblpaid`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
