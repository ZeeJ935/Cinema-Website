-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2023 at 10:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seatselect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `adminname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `age` int(11) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `phoneno` varchar(12) NOT NULL,
  `adminid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`adminname`, `email`, `password`, `age`, `cnic`, `phoneno`, `adminid`) VALUES
('rohail', 'rohail1@gmail.com', 'roni7777', 28, '36603-6374988-8', '0320-1111111', 1);

--
-- Triggers `admininfo`
--
DELIMITER $$
CREATE TRIGGER `agetrigger` BEFORE INSERT ON `admininfo` FOR EACH ROW BEGIN
    IF NEW.age <= 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Age must be greater than 0';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cnictrigger` BEFORE INSERT ON `admininfo` FOR EACH ROW BEGIN
    DECLARE cnic_prefix CHAR(5);
    DECLARE cnic_suffix CHAR(7);
    SET cnic_prefix = SUBSTRING(NEW.cnic, 1, 5);
    SET cnic_suffix = SUBSTRING(NEW.cnic, 7, 7);
    IF LENGTH(NEW.cnic) != 15 OR SUBSTRING(NEW.cnic, 6, 1) != '-' OR SUBSTRING(NEW.cnic, 14, 1) != '-' OR SUBSTRING(NEW.cnic, 15, 1) NOT IN ('0', '1', '2', '3', '4', '5', '6', '7', '8', '9') OR cnic_prefix NOT REGEXP '^[0-9]+$' OR cnic_suffix NOT REGEXP '^[0-9]+$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid CNIC number';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `passwordtrigger` BEFORE INSERT ON `admininfo` FOR EACH ROW BEGIN
    IF LENGTH(NEW.password) < 8 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Password must have at least 8 characters';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `phonetrigger` BEFORE INSERT ON `admininfo` FOR EACH ROW BEGIN
    DECLARE phone_prefix CHAR(4);
    DECLARE phone_suffix CHAR(7);
    SET phone_prefix = SUBSTRING(NEW.phoneno, 1, 4);
    SET phone_suffix = SUBSTRING(NEW.phoneno, 6, 7);
    IF LENGTH(NEW.phoneno) != 12 OR SUBSTRING(NEW.phoneno, 5, 1) != '-' OR phone_prefix NOT REGEXP '^[0-9]+$' OR phone_suffix NOT REGEXP '^[0-9]+$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid phone number';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blocked`
--

CREATE TABLE `blocked` (
  `blocked_userid` int(11) NOT NULL,
  `adminid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booksite`
--

CREATE TABLE `booksite` (
  `Ticket_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Movie_id` int(11) NOT NULL,
  `City` varchar(30) NOT NULL,
  `Day` date NOT NULL,
  `Time` time NOT NULL,
  `paymentmethod` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booksite`
--

INSERT INTO `booksite` (`Ticket_id`, `User_id`, `Movie_id`, `City`, `Day`, `Time`, `paymentmethod`) VALUES
(126, 1, 29, 'Lahore', '2023-05-15', '22:30:00', 'Debit'),
(127, 1, 29, 'Lahore', '2023-05-15', '09:30:00', 'Credit'),
(129, 1, 29, 'Lahore', '2023-05-15', '09:30:00', 'Debit'),
(132, 1, 29, 'Lahore', '2023-05-15', '22:30:00', 'Debit'),
(133, 1, 40, 'Lahore', '2023-05-15', '22:30:00', 'Debit'),
(134, 1, 30, 'Lahore', '2023-05-15', '22:30:00', 'Debit'),
(138, 1, 40, 'Lahore', '2023-05-15', '09:30:00', 'Debit'),
(143, 1, 40, 'karachi', '2023-05-15', '22:30:00', 'Debit'),
(144, 1, 40, 'karachi', '2023-05-15', '09:30:00', 'Debit'),
(169, 1, 27, 'Islamabad', '2023-05-14', '20:00:00', 'Debit'),
(170, 1, 27, 'Islamabad', '2023-05-14', '20:00:00', 'Debit'),
(171, 1, 27, 'Islamabad', '2023-05-14', '20:00:00', 'Debit'),
(172, 1, 27, 'Islamabad', '2023-05-14', '20:00:00', 'Debit'),
(173, 1, 27, 'Islamabad', '2023-05-14', '20:00:00', 'Debit'),
(174, 1, 27, 'Islamabad', '2023-05-14', '20:00:00', 'Debit'),
(175, 1, 27, 'Islamabad', '2023-05-14', '20:00:00', 'Debit');

-- --------------------------------------------------------

--
-- Table structure for table `ComingSoon`
--

CREATE TABLE `ComingSoon` (
  `Movie_iD` int(255) NOT NULL,
  `Movie_Name` varchar(255) NOT NULL,
  `ReleaseDate` date NOT NULL,
  `Duration` varchar(255) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `Showtimes` varchar(255) NOT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ComingSoon`
--

INSERT INTO `ComingSoon` (`Movie_iD`, `Movie_Name`, `ReleaseDate`, `Duration`, `Genre`, `Showtimes`, `ImageURL`) VALUES
(32, 'Cars 2', '2023-05-05', '114', 'Comedy', '11:00 AM, 3:00 PM, 7:00 PM,11:00 PM', 'cars1.jpeg'),
(34, 'Creed 3', '2023-05-05', '125', 'Action, Crime, Drama', '9', 'br.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Movieadmin`
--

CREATE TABLE `Movieadmin` (
  `Movie_iD` int(255) NOT NULL,
  `MovieName` varchar(255) NOT NULL,
  `ReleaseDate` date NOT NULL,
  `Duration` int(255) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `Showtimes` varchar(255) NOT NULL,
  `AvgRating` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `ImageUrl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movieadmin`
--

INSERT INTO `Movieadmin` (`Movie_iD`, `MovieName`, `ReleaseDate`, `Duration`, `Genre`, `Showtimes`, `AvgRating`, `description`, `ImageUrl`) VALUES
(27, 'Oppenheimer', '2023-04-05', 175, 'Drama/War', '11:00 AM, 3:00 PM, 7:00 PM,11:00 PM', '9.2', 'Physicist J Robert Oppenheimer works with a team of scientists during the Manhattan Project, leading to the development of the atomic bomb.', 'img16.jpeg'),
(28, 'Interstellar', '2023-04-07', 172, 'Sci-Fi/Adventure', '11:00 AM, 3:00 PM, 7:00 PM,11:00 PM', '9.5', 'When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans', 'img21.jpeg'),
(29, 'Avatar 2:The Way of Water', '2023-03-03', 114, 'Sci-Fi/Adventure', '1:30, 3:30, 5:30, 7:30', '8.1', 'Jake Sully and Ney-tiri have formed a family and are doing everything to stay together. However, they must leave their home and explore the regions of Pandora. When an ancient threat resurfaces, Jake must fight a difficult war against the humans', 'img14.jpeg'),
(30, 'Demon Slayer:To The Swordsmith Village', '2023-01-05', 112, 'Shounen,Action', '1:00, 4:00, 8:00', '8.1', 'Demon Slayer: Kimetsu no Yaiba – To the Swordsmith Village, also known as Demon Slayer: Swordsmith Village is a 2023 Japanese animated dark fantasy action film based on the \"Entertainment District\" and \"Swordsmith Village\" arcs of the shōnen manga series Demon Slayer: Kimetsu no Yaiba by Koyoharu Gotouge', 'img15.jpeg'),
(31, 'One piece Red', '2023-03-02', 125, 'Shounen,Action', '1:00, 4:00, 8:00', '8.2', 'Uta is a beloved singer, renowned for concealing her own identity when performing. Her voice is described as \"otherworldly.\" Now, for the first time ever, Uta will reveal herself to the world at a live concert', 'img20.webp'),
(40, 'Ant Man and the Wasp', '2023-05-05', 175, 'Drama/War', '1:30, 4:30, 7:30, 11:30, 2:30', '8', 'Ant-Man and the Wasp find themselves exploring the Quantum Realm, interacting with strange new creatures and embarking on an adventure that pushes them beyond the limits of what they thought was possible', 'img13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ticket_id` int(11) NOT NULL,
  `paymentdate` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cardnum` varchar(22) NOT NULL,
  `expdate` date NOT NULL,
  `cvc` int(4) NOT NULL,
  `userid` int(11) NOT NULL,
  `paymentid` int(11) NOT NULL,
  `totalcost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`ticket_id`, `paymentdate`, `name`, `email`, `cardnum`, `expdate`, `cvc`, `userid`, `paymentid`, `totalcost`) VALUES
(127, '2023-05-10', 'rohail', 'rohail@gmail.com', '1234 3243 2345 3234', '2024-09-01', 777, 1, 21, 3000),
(170, '2023-05-13', 'rohail', 'rohail@gmail.com', '2343 3245 3454 5443', '2023-09-01', 999, 1, 30, 4500),
(172, '2023-05-13', 'rohail', 'rohail@gmail.com', '1111 2222 3333 4444', '2023-09-01', 123, 1, 31, 22000),
(173, '2023-05-13', 'rohail', 'rohail@gmail.com', '1111 2222 3333 4444', '2023-09-01', 123, 1, 32, 4800),
(175, '2023-05-13', 'rohail', 'rohail@gmail.com', '1111 2222 3333 4444', '2222-09-01', 999, 1, 33, 1600);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `bio` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `fblink` varchar(255) DEFAULT NULL,
  `twtlink` varchar(255) DEFAULT NULL,
  `CP` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `bio`, `photo`, `fblink`, `twtlink`, `CP`) VALUES
(1, 'Rohail Shahid', 'Doo Bee Doo Bee DOO bA', 'img1.webp', NULL, NULL, 4300),
(2, 'mida rasil', 'welcome to my youtube channel', '', '', '', 200);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ticket_id` int(255) NOT NULL,
  `Movie_iD` int(11) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `Screen_iD` int(11) NOT NULL,
  `tickettype` varchar(50) NOT NULL,
  `ticketprice` bigint(20) NOT NULL,
  `Payment` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ticket_id`, `Movie_iD`, `seat_number`, `Screen_iD`, `tickettype`, `ticketprice`, `Payment`) VALUES
(127, 29, 24, 3, 'Gold', 1500, 'paid'),
(127, 29, 25, 3, 'Gold', 1500, 'paid'),
(129, 29, 25, 3, 'Gold', 1500, 'Unpaid'),
(129, 29, 35, 3, 'Gold', 1500, 'Unpaid'),
(170, 27, 24, 4, 'Gold', 1500, 'paid'),
(170, 27, 25, 4, 'Gold', 1500, 'paid'),
(170, 27, 26, 4, 'Gold', 1500, 'paid'),
(170, 27, 24, 4, 'Gold', 1500, 'paid'),
(170, 27, 25, 4, 'Gold', 1500, 'paid'),
(170, 27, 26, 4, 'Gold', 1500, 'paid'),
(172, 27, 41, 4, 'Platinum', 2200, 'paid'),
(172, 27, 42, 4, 'Platinum', 2200, 'paid'),
(172, 27, 43, 4, 'Platinum', 2200, 'paid'),
(172, 27, 44, 4, 'Platinum', 2200, 'paid'),
(172, 27, 45, 4, 'Platinum', 2200, 'paid'),
(172, 27, 46, 4, 'Platinum', 2200, 'paid'),
(172, 27, 47, 4, 'Platinum', 2200, 'paid'),
(172, 27, 48, 4, 'Platinum', 2200, 'paid'),
(172, 27, 49, 4, 'Platinum', 2200, 'paid'),
(172, 27, 50, 4, 'Platinum', 2200, 'paid'),
(173, 27, 3, 4, 'Silver', 800, 'paid'),
(173, 27, 4, 4, 'Silver', 800, 'paid'),
(173, 27, 5, 4, 'Silver', 800, 'paid'),
(173, 27, 6, 4, 'Silver', 800, 'paid'),
(173, 27, 7, 4, 'Silver', 800, 'paid'),
(173, 27, 8, 4, 'Silver', 800, 'paid'),
(175, 27, 9, 4, 'Silver', 800, 'paid'),
(175, 27, 10, 4, 'Silver', 800, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `Screen`
--

CREATE TABLE `Screen` (
  `Show_iD` int(11) NOT NULL,
  `Screen_iD` int(11) NOT NULL,
  `Movie_iD` int(11) NOT NULL,
  `Location` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Screen`
--

INSERT INTO `Screen` (`Show_iD`, `Screen_iD`, `Movie_iD`, `Location`, `Date`, `Time`) VALUES
(8, 3, 40, 'karachi', '2023-05-15', '09:30:00'),
(11, 4, 27, 'Islamabad', '2023-05-14', '20:00:00'),
(14, 2, 28, 'Lahore', '2023-05-11', '23:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `Screenexist`
--

CREATE TABLE `Screenexist` (
  `Screen_iD` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Screenexist`
--

INSERT INTO `Screenexist` (`Screen_iD`, `Name`) VALUES
(2, 'Maximus'),
(3, '4k'),
(4, '3D');

-- --------------------------------------------------------

--
-- Table structure for table `Trending`
--

CREATE TABLE `Trending` (
  `Movie_iD` int(255) NOT NULL,
  `Movie_Name` varchar(255) NOT NULL,
  `ReleaseDate` date NOT NULL,
  `Duration` varchar(255) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `Showtimes` varchar(255) NOT NULL,
  `AvgRating` varchar(255) NOT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Trending`
--

INSERT INTO `Trending` (`Movie_iD`, `Movie_Name`, `ReleaseDate`, `Duration`, `Genre`, `Showtimes`, `AvgRating`, `ImageURL`) VALUES
(27, 'Oppenheimer', '2023-04-04', '175', 'Drama/War', '11:00 AM, 3:00 PM, 7:00 PM,11:00 PM', '9.2', 'img19.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trendingg`
--

CREATE TABLE `trendingg` (
  `Movie_iD` int(11) NOT NULL,
  `Movie_Name` int(11) NOT NULL,
  `ReleaseDate` int(11) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Genre` int(11) NOT NULL,
  `Showtimes` int(11) NOT NULL,
  `AvgRating` int(11) NOT NULL,
  `ImageURL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `username` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `confirm_password` varchar(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `cnic` varchar(16) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`username`, `password`, `confirm_password`, `email`, `age`, `cnic`, `phone_no`, `user_id`, `status`) VALUES
('rohail10', 'roni11', 'roni11', 'rohail@gmail.com', 21, '36603-6375607-6', '0321-1111111', 1, 'unblocked'),
('midzo9', 'midi10', 'midi10', 'midah@gmail.com', 20, '36603-6375607-7', '0321-1111112', 2, 'unblocked'),
('zj', 'meowmeow', 'meowmeow', 'zj@gmail.com', 21, '36603-6375607-7', '0321-1111113', 3, 'unblocked');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE `user_review` (
  `rating` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating_iD` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `blocked`
--
ALTER TABLE `blocked`
  ADD PRIMARY KEY (`blocked_userid`),
  ADD KEY `fk_admin` (`adminid`);

--
-- Indexes for table `booksite`
--
ALTER TABLE `booksite`
  ADD PRIMARY KEY (`Ticket_id`),
  ADD KEY `fkuser` (`User_id`);

--
-- Indexes for table `ComingSoon`
--
ALTER TABLE `ComingSoon`
  ADD PRIMARY KEY (`Movie_iD`);

--
-- Indexes for table `Movieadmin`
--
ALTER TABLE `Movieadmin`
  ADD PRIMARY KEY (`Movie_iD`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`),
  ADD KEY `FK_PAYMENT` (`userid`),
  ADD KEY `fk_ticket` (`ticket_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD KEY `fk_seat` (`ticket_id`),
  ADD KEY `fk_screens` (`Screen_iD`);

--
-- Indexes for table `Screen`
--
ALTER TABLE `Screen`
  ADD PRIMARY KEY (`Show_iD`),
  ADD KEY `Fk_con` (`Movie_iD`),
  ADD KEY `Fk_ciner` (`Screen_iD`);

--
-- Indexes for table `Screenexist`
--
ALTER TABLE `Screenexist`
  ADD PRIMARY KEY (`Screen_iD`);

--
-- Indexes for table `Trending`
--
ALTER TABLE `Trending`
  ADD PRIMARY KEY (`Movie_iD`);

--
-- Indexes for table `trendingg`
--
ALTER TABLE `trendingg`
  ADD KEY `fk_movie1` (`Movie_iD`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`rating_iD`) USING BTREE,
  ADD KEY `fk_user1` (`userid`),
  ADD KEY `Fk_constraint6` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admininfo`
--
ALTER TABLE `admininfo`
  MODIFY `adminid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blocked`
--
ALTER TABLE `blocked`
  MODIFY `blocked_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booksite`
--
ALTER TABLE `booksite`
  MODIFY `Ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `ComingSoon`
--
ALTER TABLE `ComingSoon`
  MODIFY `Movie_iD` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `Movieadmin`
--
ALTER TABLE `Movieadmin`
  MODIFY `Movie_iD` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Screen`
--
ALTER TABLE `Screen`
  MODIFY `Show_iD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Screenexist`
--
ALTER TABLE `Screenexist`
  MODIFY `Screen_iD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_review`
--
ALTER TABLE `user_review`
  MODIFY `rating_iD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocked`
--
ALTER TABLE `blocked`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`adminid`) REFERENCES `admininfo` (`adminid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`blocked_userid`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booksite`
--
ALTER TABLE `booksite`
  ADD CONSTRAINT `fkuser` FOREIGN KEY (`User_id`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_PAYMENT` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `booksite` (`Ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_u` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_screens` FOREIGN KEY (`Screen_iD`) REFERENCES `Screenexist` (`Screen_iD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_seat` FOREIGN KEY (`ticket_id`) REFERENCES `booksite` (`Ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Screen`
--
ALTER TABLE `Screen`
  ADD CONSTRAINT `Fk_ciner` FOREIGN KEY (`Screen_iD`) REFERENCES `Screenexist` (`Screen_iD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_con` FOREIGN KEY (`Movie_iD`) REFERENCES `Movieadmin` (`Movie_iD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Trending`
--
ALTER TABLE `Trending`
  ADD CONSTRAINT `Fk_movie` FOREIGN KEY (`Movie_iD`) REFERENCES `Movieadmin` (`Movie_iD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trendingg`
--
ALTER TABLE `trendingg`
  ADD CONSTRAINT `fk_movie1` FOREIGN KEY (`Movie_iD`) REFERENCES `Movieadmin` (`Movie_iD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_review`
--
ALTER TABLE `user_review`
  ADD CONSTRAINT `Fk_constraint6` FOREIGN KEY (`movie_id`) REFERENCES `Movieadmin` (`Movie_iD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user1` FOREIGN KEY (`userid`) REFERENCES `userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
