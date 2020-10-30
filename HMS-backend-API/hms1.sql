-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2020 at 10:15 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` varchar(45) NOT NULL,
  `hotel_name` varchar(50) NOT NULL,
  `hotel_tel_no` varchar(20) NOT NULL,
  `hotel_location_address` varchar(45) NOT NULL,
  `hotel_email_address` varchar(45) NOT NULL,
  `hotel_po_box` varchar(45) NOT NULL,
  `hotel_tin_no` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`, `hotel_tel_no`, `hotel_location_address`, `hotel_email_address`, `hotel_po_box`, `hotel_tin_no`) VALUES
('20206LI484CFI5', 'carrefoul', '0786910057', 'kam', 'mmu@m.com', 'po', 1012901),
('20208WC673APD1', 'carrefoul1', '0786910057', 'kam', 'mmu1@m.com', 'po', 1012901);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` varchar(255) NOT NULL,
  `room_No` int(11) NOT NULL,
  `prefix` varchar(25) NOT NULL,
  `room_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms_availability`
--

CREATE TABLE `rooms_availability` (
  `rooms_availability_id` double NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `busy_from` datetime NOT NULL,
  `busy_to` datetime NOT NULL,
  `reference` varchar(255) NOT NULL,
  `availability_status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `rooms_availability`
--
DELIMITER $$
CREATE TRIGGER `client_checkout` AFTER UPDATE ON `rooms_availability` FOR EACH ROW INSERT INTO rooms_departures(departure_date,reservation_id) VALUES(NOW(),NEW.reference)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rooms_categories`
--

CREATE TABLE `rooms_categories` (
  `category_id` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `hotel` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms_clients`
--

CREATE TABLE `rooms_clients` (
  `client_id` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_nationality` varchar(255) NOT NULL,
  `client_passport_id` varchar(255) NOT NULL,
  `client_age` int(11) NOT NULL,
  `client_gender` char(1) NOT NULL,
  `client_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms_departures`
--

CREATE TABLE `rooms_departures` (
  `departure_id` int(11) NOT NULL,
  `departure_date` date NOT NULL,
  `reservation_id` varchar(255) NOT NULL,
  `left_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `product_id` varchar(255) NOT NULL,
  `inflow_date` date NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `mfg_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `hotel` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`product_id`, `inflow_date`, `product_name`, `unit`, `quantity`, `mfg_date`, `exp_date`, `supplier`, `description`, `hotel`) VALUES
('20202CW638HXL5', '2020-07-11', 'ibido', 'meters', 0, '2020-07-08', '2020-07-08', 'muhire', 'not required', '20206LI484CFI5');

--
-- Triggers `stock`
--
DELIMITER $$
CREATE TRIGGER `inflow_logs` AFTER INSERT ON `stock` FOR EACH ROW INSERT INTO stock_logs(log_date,product_ref_id,log_quantity,action) VALUES(NOW(),NEW.product_id,NEW.quantity,'inflow')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `out_flow` AFTER UPDATE ON `stock` FOR EACH ROW INSERT INTO stock_logs(log_date,product_ref_id,log_quantity,action) VALUES(NOW(),NEW.product_id,(OLD.quantity-NEW.quantity),'outflow')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_logs`
--

CREATE TABLE `stock_logs` (
  `stock_log_id` double NOT NULL,
  `log_date` date NOT NULL,
  `product_ref_id` varchar(255) NOT NULL,
  `log_quantity` int(11) NOT NULL,
  `action` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_logs`
--

INSERT INTO `stock_logs` (`stock_log_id`, `log_date`, `product_ref_id`, `log_quantity`, `action`) VALUES
(1, '2020-07-11', '20202CW638HXL5', 10, 'inflow'),
(2, '2020-07-11', '20202CW638HXL5', 6, 'outflow'),
(3, '2020-07-11', '20202CW638HXL5', 4, 'outflow');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_pwd` varchar(225) NOT NULL,
  `user_tel_no` varchar(20) NOT NULL,
  `hotel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pwd`, `user_tel_no`, `hotel`) VALUES
('20207ON685IUQ1', 'muhire', 'mmm@mm.com', '$2y$10$PjsjV1DJWrkqv1h/mOPw0O2PBbXTzLGaCeFFJaliVGVbigQN4Yu.a', '0786910057', '20206LI484CFI5');

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE `user_statuses` (
  `user_status_id` varchar(45) NOT NULL,
  `user_status` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`user_status_id`, `user_status`, `user_id`) VALUES
('20207HM857UAD1', 'General Manager', '20207ON685IUQ1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `category` (`room_category`);

--
-- Indexes for table `rooms_availability`
--
ALTER TABLE `rooms_availability`
  ADD PRIMARY KEY (`rooms_availability_id`),
  ADD KEY `reference` (`reference`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rooms_categories`
--
ALTER TABLE `rooms_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `hotel` (`hotel`);

--
-- Indexes for table `rooms_clients`
--
ALTER TABLE `rooms_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `rooms_departures`
--
ALTER TABLE `rooms_departures`
  ADD PRIMARY KEY (`departure_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `hotel` (`hotel`);

--
-- Indexes for table `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD PRIMARY KEY (`stock_log_id`),
  ADD KEY `product_ref_id` (`product_ref_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `hotel` (`hotel`);

--
-- Indexes for table `user_statuses`
--
ALTER TABLE `user_statuses`
  ADD PRIMARY KEY (`user_status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms_availability`
--
ALTER TABLE `rooms_availability`
  MODIFY `rooms_availability_id` double NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms_departures`
--
ALTER TABLE `rooms_departures`
  MODIFY `departure_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_logs`
--
ALTER TABLE `stock_logs`
  MODIFY `stock_log_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`room_category`) REFERENCES `rooms_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms_availability`
--
ALTER TABLE `rooms_availability`
  ADD CONSTRAINT `rooms_availability_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_availability_ibfk_2` FOREIGN KEY (`reference`) REFERENCES `rooms_clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms_departures`
--
ALTER TABLE `rooms_departures`
  ADD CONSTRAINT `rooms_departures_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `rooms_availability` (`reference`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`hotel`) REFERENCES `hotels` (`hotel_id`);

--
-- Constraints for table `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD CONSTRAINT `stock_logs_ibfk_1` FOREIGN KEY (`product_ref_id`) REFERENCES `stock` (`product_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`hotel`) REFERENCES `hotels` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_statuses`
--
ALTER TABLE `user_statuses`
  ADD CONSTRAINT `user_statuses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
