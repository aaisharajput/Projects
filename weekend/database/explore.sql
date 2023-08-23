-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 12:38 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `explore`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fd_id` smallint(8) UNSIGNED NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `fd_text` varchar(255) DEFAULT NULL,
  `status` char(6) NOT NULL DEFAULT 'not'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fd_id`, `email`, `name`, `fd_text`, `status`) VALUES
(3, 'sonia12@gmail.com', 'sonia', 'I have an unknown issue. Please help me to find my issue.', 'not'),
(5, 'sapnadevi.1610a@gmail.com', 'sapna devi', 'hii page testing', 'mailed'),
(6, 'sapnadevi.1610a@gmail.com', 'sapna devi', 'hii page testing', 'not'),
(7, 'singhharish17082001@gmail.com', 'harish singh', 'contact page testing', 'mailed'),
(8, 'singhharish17082001@gmail.com', 'harish singh', 'contact page testing', 'not');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_no` smallint(8) UNSIGNED NOT NULL,
  `sender_id` smallint(8) UNSIGNED NOT NULL,
  `receiver_id` smallint(8) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_no`, `sender_id`, `receiver_id`, `message`, `msg_date`) VALUES
(1, 21, 20, 'Welcome to the Explore The Unexplore Site.', '2021-07-03 13:47:54'),
(2, 20, 21, 'Thank you. I have a query related to trip.', '2021-07-03 13:47:54'),
(3, 21, 20, 'Ok. What query you have?', '2021-07-03 14:21:23'),
(4, 20, 21, 'About vaishno devi trip', '2021-07-03 14:21:50'),
(5, 20, 21, 'where we stay', '2021-07-03 14:23:30'),
(6, 21, 20, 'we stay in hotel', '2021-07-03 14:43:32'),
(7, 20, 21, 'ok thanku', '2021-07-03 14:43:52'),
(8, 21, 20, 'Welcome', '2021-07-03 14:55:44'),
(9, 21, 25, 'Hello', '2021-07-03 17:36:06'),
(10, 25, 21, 'Hii', '2021-07-03 17:36:06'),
(12, 25, 21, 'i am user', '2021-07-03 17:36:35'),
(13, 20, 21, 'hello', '2021-07-04 08:11:22'),
(16, 20, 21, 'hllo', '2021-07-04 13:05:42'),
(20, 21, 20, 'may i help you', '2021-07-04 16:11:00'),
(21, 20, 21, 'yes i wanna help', '2021-07-04 16:23:53'),
(22, 21, 20, 'ok tell', '2021-07-04 16:25:10'),
(49, 21, 20, 'hii', '2021-07-05 16:46:04'),
(50, 21, 20, 'hello', '2021-07-05 16:46:24'),
(51, 21, 20, 'hi', '2021-07-05 17:22:58'),
(52, 21, 20, 'aaisha', '2021-07-05 17:44:20'),
(53, 21, 20, 'are you there?', '2021-07-05 17:44:35'),
(54, 20, 21, 'yes', '2021-07-05 17:44:49'),
(55, 21, 20, 'ok', '2021-07-05 17:45:14'),
(56, 26, 21, 'hello', '2021-07-05 18:01:31'),
(57, 21, 26, 'hii', '2021-07-05 18:02:04'),
(58, 21, 25, 'i am admin', '2021-07-06 10:21:36'),
(60, 21, 20, 'hello', '2021-07-08 08:17:03'),
(61, 20, 21, 'hii admin', '2021-07-08 16:13:45'),
(62, 30, 21, 'hii', '2021-07-09 03:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notify_id` smallint(5) UNSIGNED NOT NULL,
  `trip_name` varchar(40) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notify_id`, `trip_name`, `post_date`) VALUES
(1, 'Vaishno Devi Trip', '2021-06-28'),
(4, 'fdf', '2021-06-25'),
(6, 'Vaishno Devi Trip, Katra', '2021-06-28'),
(7, 'Anarnath Yatra, Baltal Amarnath Trek', '2021-07-05'),
(8, 'Vaishno Devi Yatra, Katra', '2021-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `plan_purchase`
--

CREATE TABLE `plan_purchase` (
  `s_no` smallint(8) UNSIGNED NOT NULL,
  `plan_id` smallint(8) UNSIGNED NOT NULL,
  `u_id` smallint(8) UNSIGNED NOT NULL,
  `member_booking` smallint(2) UNSIGNED NOT NULL DEFAULT 1,
  `pay_mode` varchar(20) NOT NULL DEFAULT '--nil--',
  `pay_status` char(1) NOT NULL DEFAULT '0',
  `book_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_purchase`
--

INSERT INTO `plan_purchase` (`s_no`, `plan_id`, `u_id`, `member_booking`, `pay_mode`, `pay_status`, `book_date`) VALUES
(6, 2, 20, 2, '--nil--', '1', '2021-06-23 06:30:00'),
(7, 2, 21, 1, '--nil--', '1', '2021-06-22 19:30:00'),
(10, 1, 20, 1, '--nil--', '0', '2021-06-23 06:54:37'),
(20, 3, 25, 1, '--nil--', '1', '2021-07-08 17:47:43'),
(22, 3, 30, 1, '--nil--', '1', '2021-07-09 03:50:25'),
(24, 3, 20, 5, '--nil--', '1', '2021-07-11 11:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` smallint(8) UNSIGNED NOT NULL,
  `u_id` smallint(8) UNSIGNED NOT NULL,
  `plan_id` smallint(8) UNSIGNED NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` char(1) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `u_id`, `plan_id`, `post_date`, `rating`, `comment`) VALUES
(1, 21, 3, '2021-06-21 19:47:58', '3', 'very nice\r\nmemorable trip\r\n'),
(2, 21, 2, '2021-06-23 06:37:21', '5', 'lovelly and memorable trip'),
(10, 20, 4, '2021-07-03 13:02:54', '5', 'i love this trip');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `s_no` smallint(8) UNSIGNED NOT NULL,
  `plan_id` smallint(8) UNSIGNED NOT NULL,
  `location` varchar(40) DEFAULT NULL,
  `event` varchar(30) NOT NULL,
  `photo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`s_no`, `plan_id`, `location`, `event`, `photo`) VALUES
(1, 1, 'ban ganga', 'bath', 'bath.jpg'),
(2, 1, 'bhero mandir', 'skyview ', 'skyview.jpg'),
(3, 1, 'bhero minder', 'helicopter ride', 'katra5.jpg'),
(4, 2, '10:00 PM', 'Bon Fire,Singing,Dance', 'cook.jpg'),
(5, 2, '10:00 PM', 'Bon Fire,Singing,Dance', 'sanasar1.jpg'),
(6, 2, '10:00 PM', 'Bon Fire,Singing,Dance', 'bonfire1jpg'),
(7, 3, 'at safe place', 'off road dance', 'off-road.jpg'),
(8, 3, 'pahalgam', 'bhandara', 'langar.jpg'),
(9, 4, '7:00AM', 'Running and exercise', 'run.jpg'),
(10, 4, '9:00AM', 'Breakfast', 'food.jpg'),
(11, 4, '10:00AM', 'River crossing', 'river-cross.jpg'),
(12, 4, '12:00PM', 'Mount climbing', 'mount-climb.jpg'),
(13, 4, '2:00PM', 'Lunch', 'lfood.jpg'),
(14, 4, '5:00PM', 'Visiting Baisaran', 'baisaran.jpg'),
(15, 4, '8:00PM', 'Camp at Baisaran', 'sanasar4.jpg'),
(16, 4, '9:00PM', 'Departure', 'back.jpg'),
(17, 4, '3:00PM', 'Visiting Mamleshwara Temple', 'temple.jpg'),
(18, 4, '5:00PM', 'River rafting', 'river-rafting.jpg'),
(19, 5, 'patnitop', 'snow man making competition', 'snow-man.jpg'),
(20, 5, 'patnitop', 'snow fight competition', 'snow-fight.jpg'),
(21, 5, 'patnitop', 'skiing', 'skiing.jpg'),
(22, 5, 'patnitop', 'dance', 'dance.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

CREATE TABLE `traffic` (
  `traffic_id` smallint(5) UNSIGNED NOT NULL,
  `website` varchar(10) NOT NULL,
  `views` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `traffic`
--

INSERT INTO `traffic` (`traffic_id`, `website`, `views`) VALUES
(1, 'explore', 266);

-- --------------------------------------------------------

--
-- Table structure for table `trip_gallery`
--

CREATE TABLE `trip_gallery` (
  `gallery_id` smallint(8) UNSIGNED NOT NULL,
  `plan_id` smallint(8) UNSIGNED NOT NULL,
  `source` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trip_gallery`
--

INSERT INTO `trip_gallery` (`gallery_id`, `plan_id`, `source`) VALUES
(1, 1, 'katra3.jpg'),
(2, 1, 'katra2.jpg'),
(3, 1, 'katra1.jpg'),
(4, 1, 'katra4.jpg'),
(5, 1, 'katra5.jpg'),
(6, 2, 'bonfire.jpg'),
(7, 2, 'bonfire1.jpg'),
(8, 2, 'sanasar1.jpg'),
(9, 2, 'sanasar2.jpg'),
(10, 2, 'sanasar3.png'),
(11, 2, 'sanasar4.jpg'),
(12, 3, 'amarnath.jpg'),
(13, 3, 'amarnath1.jpg'),
(14, 3, 'amarnath2.jpg'),
(15, 3, 'amarnath3.jpg'),
(16, 3, 'amarnath4.jpg'),
(17, 4, 'Pahalgam.png'),
(18, 4, 'camp5.png'),
(19, 4, 'camp1.jpg'),
(20, 4, 'camp2.jpg'),
(21, 4, 'camp3.jpg'),
(22, 4, 'camp4.jpg'),
(23, 5, 'patnitop1.jpg'),
(24, 5, 'patnitop4.jpg'),
(25, 5, 'patnitop5.png'),
(26, 5, 'patnitop2.jpeg'),
(27, 5, 'patnitop3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_hobbies`
--

CREATE TABLE `user_hobbies` (
  `s_no` smallint(8) UNSIGNED NOT NULL,
  `u_id` smallint(8) UNSIGNED DEFAULT NULL,
  `hobby` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_hobbies`
--

INSERT INTO `user_hobbies` (`s_no`, `u_id`, `hobby`) VALUES
(13, 20, 'Dancing'),
(14, 20, 'Camping'),
(15, 20, 'Pool Party'),
(16, 30, 'Advanture'),
(17, 30, 'Bike Riding'),
(18, 30, 'Camping'),
(19, 30, 'Fair');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `u_id` smallint(8) UNSIGNED NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `pswd` varchar(40) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `gender` char(6) NOT NULL DEFAULT 'Gender',
  `phone_no` char(10) NOT NULL,
  `alt_phone_no` char(10) NOT NULL,
  `zipcode` char(6) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(30) NOT NULL,
  `profile_pic` varchar(50) NOT NULL DEFAULT 'default.svg',
  `online` tinyint(1) NOT NULL DEFAULT 0,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`u_id`, `f_name`, `l_name`, `email`, `pswd`, `status`, `gender`, `phone_no`, `alt_phone_no`, `zipcode`, `city`, `state`, `profile_pic`, `online`, `reg_date`) VALUES
(20, 'aaisha', 'rajput', 'aaisha@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 1, 'Female', '7895047856', '6666666666', '180006', 'jammu', 'j&k', 'about-trip.jpg', 1, '2021-06-18'),
(21, 'Monika', 'Dogra', 'monikadogra@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 1, 'Gender', '', '', '', '', '', 'couple.jpg', 0, '2021-06-21'),
(25, 'tania', 'sharma', 'tania45@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 1, 'Gender', '', '', '', '', '', 'default.svg', 0, '2021-06-27'),
(26, 'sapna', 'devi', 'aaisha16@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 1, 'Gender', '', '', '', '', '', 'default.svg', 0, '2021-07-05'),
(27, 'Harish', 'Singh', 'harishsingh@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 1, 'Gender', '', '', '', '', '', 'default.svg', 0, '2021-07-08'),
(29, 'Roshini', 'rajput', 'rajputroshini684@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 1, 'Gender', '', '', '', '', '', 'default.svg', 0, '2021-07-09'),
(30, 'sapna', 'devi', 'aaisharajput16101999@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 1, 'Gender', '', '', '', '', '', 'default.svg', 0, '2021-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `weekend_plans`
--

CREATE TABLE `weekend_plans` (
  `plan_id` smallint(8) UNSIGNED NOT NULL,
  `trip_name` varchar(30) NOT NULL,
  `pickup_point` varchar(80) NOT NULL,
  `arrival_time` char(10) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `fee_charges` smallint(7) UNSIGNED DEFAULT NULL,
  `members` char(2) NOT NULL,
  `cmn_interest` varchar(20) NOT NULL,
  `stay_address` varchar(60) DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_member` char(2) NOT NULL,
  `map` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weekend_plans`
--

INSERT INTO `weekend_plans` (`plan_id`, `trip_name`, `pickup_point`, `arrival_time`, `start_date`, `end_date`, `destination`, `fee_charges`, `members`, `cmn_interest`, `stay_address`, `post_date`, `booking_member`, `map`, `note`) VALUES
(1, 'Mata Ka Darbar', 'Jammu, Bus Stand. Bus no.: 6584', '09:00 AM', '2021-06-19', '2021-06-21', 'Vaishno Devi, Katra,J&K', 5000, '20', 'Singing', 'Vaishna Devi Bhawan', '2021-06-17 07:08:35', '3', '\r\n\r\n!1m18!1m12!1m3!1d3344.974665193851!2d74.94714331452549!3d33.0307979283106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391e786b6985aaad%3A0xa04ab611af048191!2sVaishno%20Devi!5e0!3m2!1sen!2sin!4v1623659565612!5m2!1sen!2sin', 'The last date of payment: 17-06-2021.Pay on time either your trip will cancelled.'),
(2, 'Bon Fire Night Party', 'Bus stand, Udhmpur. Bus no.: 09845', '9:00 PM', '2021-06-25', '2021-06-27', 'Sanasar, Ramban , J&K', 5000, '25', 'Singing,Dance', 'Sanasar', '2021-06-17 07:42:20', '6', '!1m18!1m12!1m3!1d26731.67810147135!2d75.24614950292022!3d33.12328396742602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391dc676b009c11d%3A0x31b7708768619e61!2sSanasar%20182143!5e0!3m2!1sen!2sin!4v1624093412605!5m2!1sen!2sin\" ', 'The last date of payment: 22-06-2021. No liqure Allowed'),
(3, 'Amarnath Yatra', 'Jammu', '18:00:00', '2021-07-16', '2021-07-21', 'Baltal Amarnath Trek, Forest Block, Pahalgam, J&k', 15000, '30', 'advanture', 'Camps on save place', '2021-06-17 07:52:30', '5', '!1m18!1m12!1m3!1d3299.2867391811146!2d75.50193141456026!3d34.215696216547386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38e24fca96056755%3A0xdfd15d625912515e!2sShri%20Amarnath%20Cave%20Temple!5e0!3m2!1sen!2sin!4v1624093962216!5m2!1sen!2sin', 'Bring your identification card like aadhar card/pan card,etc weight of carry bag shouldn\'t be more than 4kg.'),
(4, 'Trekking Special', 'Jammu', '06:00:00', '2021-07-06', '2021-07-08', 'Pahalgam', 5000, '15', 'Advanture', 'Mountaineering Learning Institute, Pahalgam', '2021-06-17 07:56:27', '2', '!1m18!1m12!1m3!1d52916.82389736838!2d75.2806048392042!3d34.01047123743521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38e23f2a7b9509df%3A0x8c1cff001fb18c5!2sPahalgam!5e0!3m2!1sen!2sin!4v1624094076399!5m2!1sen!2sin', ''),
(5, 'Snow Camp', 'Udhmpur', '06:00:00', '2021-01-08', '2021-01-10', 'Patnitop', 4000, '15', 'Dancing', 'Patnitop, hut', '2021-06-17 08:01:38', '1', '!1m18!1m12!1m3!1d53488.62736881342!2d75.29505653213836!3d33.08175302379072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391dc80fa6194c41%3A0x9302f4549eca4df9!2sPatnitop!5e0!3m2!1sen!2sin!4v1624094018307!5m2!1sen!2sin', 'Make your new friends.Enjoy the snowfall');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fd_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_no`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `plan_purchase`
--
ALTER TABLE `plan_purchase`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `traffic`
--
ALTER TABLE `traffic`
  ADD PRIMARY KEY (`traffic_id`);

--
-- Indexes for table `trip_gallery`
--
ALTER TABLE `trip_gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `weekend_plans`
--
ALTER TABLE `weekend_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fd_id` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_no` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notify_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plan_purchase`
--
ALTER TABLE `plan_purchase`
  MODIFY `s_no` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `s_no` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `traffic`
--
ALTER TABLE `traffic`
  MODIFY `traffic_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trip_gallery`
--
ALTER TABLE `trip_gallery`
  MODIFY `gallery_id` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  MODIFY `s_no` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `u_id` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `weekend_plans`
--
ALTER TABLE `weekend_plans`
  MODIFY `plan_id` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user_tbl` (`u_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user_tbl` (`u_id`);

--
-- Constraints for table `plan_purchase`
--
ALTER TABLE `plan_purchase`
  ADD CONSTRAINT `plan_purchase_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `weekend_plans` (`plan_id`),
  ADD CONSTRAINT `plan_purchase_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user_tbl` (`u_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_tbl` (`u_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `weekend_plans` (`plan_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `weekend_plans` (`plan_id`);

--
-- Constraints for table `trip_gallery`
--
ALTER TABLE `trip_gallery`
  ADD CONSTRAINT `trip_gallery_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `weekend_plans` (`plan_id`);

--
-- Constraints for table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  ADD CONSTRAINT `user_hobbies_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_tbl` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
