-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 24, 2026 at 04:38 AM
-- Server version: 10.4.34-MariaDB-1:10.4.34+maria~ubu2004
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kazlegacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_name`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agent_code` varchar(255) NOT NULL,
  `agent_picture` varchar(255) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_password` varchar(255) NOT NULL,
  `agent_phone` varchar(255) NOT NULL,
  `agent_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agent_code`, `agent_picture`, `agent_name`, `agent_password`, `agent_phone`, `agent_email`) VALUES
('A00001', 'upload/default_pic.jpg', 'Agent 1', 'agent', '017-9001154', 'agent1@gmail.com'),
('A00002', 'upload/default_pic.jpg', 'Agent 2', 'agent', '011-28284383', 'agent2@gmail.com'),
('A00003', 'upload/default_pic.jpg', 'Agent 3', 'agent', '011-63938393', 'agent3@gmail.com'),
('A00004', 'upload/default_pic.jpg', 'Agent 4', 'agent', '013-7509148', 'agent4@gmail.com'),
('A00005', 'upload/default_pic.jpg', 'Agent 5', 'agent', '013-2433004', 'agent5@gmail.com'),
('A00006', 'upload/default_pic.jpg', 'Agent 6', 'agent', '019-3532675', 'agent6@gmail.com'),
('A00007', 'upload/default_pic.jpg', 'Agent 7', 'agent', '017-6572886', 'agent7@gmail.com'),
('A00008', 'upload/default_pic.jpg', 'Agent 8', 'agent', '010-2986175', 'agent8@gmail.com'),
('A00009', 'upload/default_pic.jpg', 'Agent 9', 'agent', '017-2398396', 'agent9@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_ID` int(11) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_username` varchar(255) NOT NULL,
  `client_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_ID`, `client_email`, `client_username`, `client_password`) VALUES
(1, 'client@gmail.com', 'client', 'Client1');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `quotation_ID` int(11) NOT NULL,
  `client_ID` int(11) NOT NULL,
  `client_IC` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_age` varchar(255) NOT NULL,
  `client_job` varchar(255) NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `client_status` varchar(255) NOT NULL,
  `selected_plan` varchar(255) NOT NULL,
  `agent_code` varchar(255) NOT NULL,
  `complete_date` varchar(255) NOT NULL,
  `progress` varchar(255) NOT NULL,
  `price` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`quotation_ID`, `client_ID`, `client_IC`, `client_name`, `client_age`, `client_job`, `client_phone`, `client_status`, `selected_plan`, `agent_code`, `complete_date`, `progress`, `price`) VALUES
(1, 1, '000000-00-0000', 'Client', '20', 'Student', '029-3947576', 'Smoker', 'Education', 'A00001', '24-07-26 11:13:59', 'Completed', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `takafulplan`
--

CREATE TABLE `takafulplan` (
  `plan_name` varchar(255) NOT NULL,
  `plan_description` varchar(255) NOT NULL,
  `plan_price` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `takafulplan`
--

INSERT INTO `takafulplan` (`plan_name`, `plan_description`, `plan_price`) VALUES
('Critical Illness', 'With critical illness plan, you can protect your finances from the cost of critical illness', 100.00),
('Education', 'Education plan ensure that quality education does not equal debt and goes hand-in-hand with financial flexibility for your child', 100.00),
('Hibah', 'Hibah is a pure protection family takaful plan that covers death for you and your family', 100.00),
('Investment', 'We design the Investment plan to let your money work just as hard as you do', 100.00),
('Medical Card', 'Medical Card plan helps to pay for inpatient and outpatient medical expenses incurred as healthcare is getting more expensive in Malaysia', 100.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agent_code`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_ID`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`quotation_ID`),
  ADD KEY `agent_code` (`agent_code`),
  ADD KEY `client_ID` (`client_ID`);

--
-- Indexes for table `takafulplan`
--
ALTER TABLE `takafulplan`
  ADD PRIMARY KEY (`plan_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `quotation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quotation`
--
ALTER TABLE `quotation`
  ADD CONSTRAINT `quotation_ibfk_1` FOREIGN KEY (`agent_code`) REFERENCES `agent` (`agent_code`),
  ADD CONSTRAINT `quotation_ibfk_2` FOREIGN KEY (`client_ID`) REFERENCES `client` (`client_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
