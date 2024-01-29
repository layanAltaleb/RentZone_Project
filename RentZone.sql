-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 01, 2023 at 05:40 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RentZone`
--

-- --------------------------------------------------------

--
-- Table structure for table `ApplicationStatus`
--

CREATE TABLE `ApplicationStatus` (
  `id` int(11) NOT NULL,
  `status` enum('accepted','declined','under consideration') NOT NULL DEFAULT 'under consideration'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ApplicationStatus`
--

INSERT INTO `ApplicationStatus` (`id`, `status`) VALUES
(47, 'declined'),
(48, 'declined');

-- --------------------------------------------------------

--
-- Table structure for table `Homeowner`
--

CREATE TABLE `Homeowner` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Homeowner`
--

INSERT INTO `Homeowner` (`id`, `name`, `phone_number`, `email_address`, `password`) VALUES
(6, 'maha ahmad', 532323212, 'maha@gmail.com', '$2y$10$DkdQZ/HuHax/lJ6ppfeKSeBUz7ySzNcBBObOxmIuF9oy6ukpLfFgG');

-- --------------------------------------------------------

--
-- Table structure for table `HomeSeeker`
--

CREATE TABLE `HomeSeeker` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `family_members` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `job` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `HomeSeeker`
--

INSERT INTO `HomeSeeker` (`id`, `first_name`, `last_name`, `age`, `family_members`, `income`, `job`, `phone_number`, `email_address`, `password`) VALUES
(14, 'munira', 'alhammad', 22, 3, 3000, 'doctor', 523232323, 'munira@live.com', '$2y$10$LR0Fz0GqRleJtLAb7v69iOiRXGCB9idUrML1UCNLd1KwKyBBfN0N.'),
(15, 'sara', 'ahmad', 30, 5, 5000, 'teacher', 523232324, 'sara@gmail.com', '$2y$10$JoqfrT7XmInT0ImwurFDN.F2OsqvagU5HjEQpsMpCJ2PpI3r.FVdS');

-- --------------------------------------------------------

--
-- Table structure for table `Property`
--

CREATE TABLE `Property` (
  `id` int(11) NOT NULL,
  `homeowner_id` int(11) NOT NULL,
  `property_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rooms` int(11) NOT NULL,
  `rent_cost` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `max_tenants` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Property`
--

INSERT INTO `Property` (`id`, `homeowner_id`, `property_category_id`, `name`, `rooms`, `rent_cost`, `location`, `max_tenants`, `description`) VALUES
(44, 6, 1, 'Villa Al Nakheel', 5, 120000, 'Riyadh,Al Nakheel District,Al-juwairiyah bin harith Street.', 10, '                                                                                                                                round floor: 3 living room, dining room , 2 bathrooms, kitchen .\r\nUpper floor: 5 bedroom, 3 bathrooms, small dining room,Office room.\r\nBasement: children’s  games room,Laundry room ,Cinema room.\r\nthe area  is 500m2 ,the street width is 30m \r\n                                                                                          '),
(45, 6, 2, 'Olaya modern', 3, 8000, 'Riyadh, Al Olaya District.', 5, '                                                                                                                                                                Ground floor : living room, dining room , 2 bathrooms, kitchen, outdoor swimming pool, and outdoor seating\r\n  Upper floor : 3 rooms, 3 bathrooms,small living room                                                                                                          '),
(46, 6, 1, 'Malqa plaza', 3, 7000, 'Riyadh,Al Malqa District,468 St.', 4, '                                                                                                                                                Ground floor: living room, dining room , 1 bathrooms, kitchen\r\n  Upper floor: 3 bedroom, 2 bathrooms, small dining room\r\n  the area of each unit is 130m2 ,the street width is 20m                                                                          ');

-- --------------------------------------------------------

--
-- Table structure for table `PropertyCategory`
--

CREATE TABLE `PropertyCategory` (
  `id` int(11) NOT NULL,
  `PropertyCategory` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PropertyCategory`
--

INSERT INTO `PropertyCategory` (`id`, `PropertyCategory`) VALUES
(1, 'Villa'),
(2, 'Apartment');

-- --------------------------------------------------------

--
-- Table structure for table `PropertyImage`
--

CREATE TABLE `PropertyImage` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PropertyImage`
--

INSERT INTO `PropertyImage` (`id`, `property_id`, `path`) VALUES
(61, 44, 'img/1291957145__ket2.jpg'),
(62, 44, 'img/1910184706__bedroom.jpg'),
(63, 44, 'img/442972458__bath.jpg'),
(64, 45, 'img/496563747__442972458__bath.jpg'),
(65, 45, 'img/603207755__ketchen3.jpg'),
(66, 45, 'img/300171912__bedroom.jpg'),
(67, 46, 'img/1565396490__bathroom.jpg'),
(68, 46, 'img/1998043302__bath.jpg'),
(69, 46, 'img/1397266673__pro3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `RentalApplication`
--

CREATE TABLE `RentalApplication` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `home_seeker_id` int(11) NOT NULL,
  `application_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ApplicationStatus`
--
ALTER TABLE `ApplicationStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Homeowner`
--
ALTER TABLE `Homeowner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HomeSeeker`
--
ALTER TABLE `HomeSeeker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Property`
--
ALTER TABLE `Property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homeowner_id` (`homeowner_id`),
  ADD KEY `property_category_id` (`property_category_id`);

--
-- Indexes for table `PropertyCategory`
--
ALTER TABLE `PropertyCategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PropertyImage`
--
ALTER TABLE `PropertyImage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `RentalApplication`
--
ALTER TABLE `RentalApplication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `home_seeker_id` (`home_seeker_id`),
  ADD KEY `application_status_id` (`application_status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ApplicationStatus`
--
ALTER TABLE `ApplicationStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `Homeowner`
--
ALTER TABLE `Homeowner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `HomeSeeker`
--
ALTER TABLE `HomeSeeker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Property`
--
ALTER TABLE `Property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `PropertyCategory`
--
ALTER TABLE `PropertyCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `PropertyImage`
--
ALTER TABLE `PropertyImage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `RentalApplication`
--
ALTER TABLE `RentalApplication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Property`
--
ALTER TABLE `Property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`homeowner_id`) REFERENCES `Homeowner` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_ibfk_2` FOREIGN KEY (`property_category_id`) REFERENCES `PropertyCategory` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `PropertyImage`
--
ALTER TABLE `PropertyImage`
  ADD CONSTRAINT `propertyimage_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `Property` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `RentalApplication`
--
ALTER TABLE `RentalApplication`
  ADD CONSTRAINT `rentalapplication_ibfk_1` FOREIGN KEY (`application_status_id`) REFERENCES `ApplicationStatus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentalapplication_ibfk_2` FOREIGN KEY (`home_seeker_id`) REFERENCES `HomeSeeker` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentalapplication_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `Property` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
