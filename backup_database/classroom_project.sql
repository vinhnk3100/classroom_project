-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 07:08 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classroom_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignment_id` varchar(100) NOT NULL,
  `assignmentName` varchar(100) NOT NULL,
  `assignmentDes` text NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` varchar(100) NOT NULL,
  `className` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `classRoom` varchar(10) NOT NULL,
  `classAvatar` longtext NOT NULL DEFAULT 'default_bg.jpg',
  `teacher_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `className`, `subject`, `classRoom`, `classAvatar`, `teacher_id`) VALUES
('class1122', 'Lập trình AI - Ca 4', 'Lập trình AI', 'A1252', 'https://www.stockvault.net/data/2019/04/14/263855/preview16.jpg', 'user5f857cdd92ee5'),
('class1234', 'Phân tích thiết kế - Ca 4', 'Phân tích thiết kế và giải thuật', 'A0504', 'r6-challenge-dog_day_international_2019-ncsa-hybrid-thumb-960x540_354506.wdp.jxr', 'user5f847fc434323'),
('class2231', 'Lập Trình Web - Ứng dụng Ca 3', 'Lập Trình Web', 'A0525', 'pikachu-assassinates-trotsky-in-mexico-city-1940-colorized-pikachu-finish-43098943.png', 'user5f847bad67765'),
('class2234', 'Mạng máy tính - Ca 3', 'Mạng máy tính', 'A1502', 'Michael_Corleone_Part_I.jpg', 'user5f847fc434323'),
('class3456', 'Cấu trúc dữ liệu - Ca 2', 'Cấu trúc dữ liệu', 'A0635', 'DOoZ6_rWkAE7fLo.jpg', 'user5f8470440afac'),
('class4554', 'Thiết kế giao diện - Ca 2', 'Thiết kế giao diện', 'A0501', 'https://www.wallpapers4u.org/wp-content/uploads/spot_light_color_bright_43993_1920x1080.jpg', 'user5f847bad67765'),
('class5678', 'Ứng dụng di động - Ca 2', 'Ứng dụng di động', 'A0252', 'time-100-influential-photos-jeff-widener-tank-man-81.jpg', 'user5f857cdd92ee5'),
('class7890', 'Giải thuật 2 - Ca 1', 'Giải thuật 2', 'A0603', '68842170_2392323617518258_3931754358592503808_o.jpg', 'user5f8470440afac'),
('cls5fa3ab029572e', 'test1', 'abc', '103', 'Lenin-Engels-Marx.jpg', 'user5f847fc434323'),
('cls5fa3c5eaa198a', 'abc', '121', '12', '', 'user5f847bad67765'),
('cls5fa623cdf372f', 'classA1', 'sucky sucky', 'A091', 'default_bg.jpg', 'user5f847bad67765'),
('cls5fa653be51111', '123', '123', '123', 'default_bg.jpg', 'user5f847bad67765'),
('cls5fa6540185f30', '123', '123', '123', 'default_bg.jpg', 'user5f847fc434323');

-- --------------------------------------------------------

--
-- Table structure for table `class_assignment_teacher`
--

CREATE TABLE `class_assignment_teacher` (
  `assignment_id` varchar(100) NOT NULL,
  `class_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `c_id` int(255) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `comment` longtext NOT NULL,
  `dateT_current` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateT_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `dateT_current` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateT_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `class_id` varchar(100) NOT NULL,
  `file_dir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `content`, `dateT_current`, `dateT_update`, `class_id`, `file_dir`) VALUES
(27, 'user5f847bad67765', 'ciao', '2020-11-16 06:00:40', '2020-11-16 06:00:40', 'class7890', ''),
(28, 'user5f847bad67765', 'bonjour', '2020-11-16 06:10:12', '2020-11-16 06:10:12', 'class3456', ''),
(29, 'user5f847bad67765', 'hallo', '2020-11-16 06:10:50', '2020-11-16 06:10:50', 'class4554', ''),
(30, 'user5f847bad67765', 'salute', '2020-11-16 06:12:10', '2020-11-16 06:12:10', 'class4554', ''),
(31, 'user5f847bad67765', 'alo', '2020-11-17 04:41:10', '2020-11-17 04:41:10', 'class3456', ''),
(32, 'user5f8470440afac', 'kheol', '2020-11-17 06:23:59', '2020-11-17 06:23:59', 'class3456', ''),
(33, 'user5f8470440afac', 'xin chao', '2020-11-28 04:27:17', '2020-11-28 04:27:17', 'class3456', ''),
(34, 'user5f8470440afac', 'bello', '2020-11-28 05:11:01', '2020-11-28 05:11:01', 'class3456', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(100) NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `fullName` text NOT NULL,
  `dateOfBirth` date NOT NULL,
  `email` text NOT NULL,
  `phoneNum` varchar(10) NOT NULL,
  `role` varchar(3) NOT NULL DEFAULT 'stu' COMMENT 'stu : student , tea : teacher , adm : admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `passWord`, `fullName`, `dateOfBirth`, `email`, `phoneNum`, `role`) VALUES
('user5f8470440afac', '$2y$10$BIPG.p1xwIH2pYj4mxrCmup6WTthfBgqQanDlSPPb/Si0fC924Zdq', 'Nguyễn Văn C', '2020-10-27', 'nguyenvanc@gmail.com', '0958456321', 'tea'),
('user5f847bad67765', '$2y$10$48oF7wVFTtVGnp.n6HV/9O78RX/u9PRD/J68fmUr5nXagMfZ8aBXi', 'Administrator', '2020-10-01', 'eclassroom.me@gmail.com', '0335248759', 'adm'),
('user5f847fc434323', '$2y$10$/aj3hlUOmhUx1MpTxKpKCOUBqzzon7IC7fE10mJB/IJKJJ6ZGtRVe', 'Nguyen Van A', '2020-10-28', 'nguyenvanA@gmail.com', '0956325875', 'tea'),
('user5f857cdd92ee5', '$2y$10$JeFLGdvc1B1A.TnxD7g6lODVIXHSyrO22lt9wQkW0HDbSqzOLKk2y', 'Nguyen Van B', '2020-10-05', 'nguyenvanb@gmail.com', '0985758984', 'tea'),
('user5faa41b56b494', '$2y$10$jfQKR2Z4Cj5vZfpmmCu.IeV3npmWCFldjvIpaEMtBUcU1iLqvJjm6', 'abc', '2020-11-12', 'abc@yahoo.com', '129438171', 'stu');

-- --------------------------------------------------------

--
-- Table structure for table `users_class`
--

CREATE TABLE `users_class` (
  `class_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_class`
--

INSERT INTO `users_class` (`class_id`, `user_id`) VALUES
('class1234', 'user5f847fc434323'),
('class2231', 'user5f847bad67765');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `FK_teacherClass` (`teacher_id`);

--
-- Indexes for table `class_assignment_teacher`
--
ALTER TABLE `class_assignment_teacher`
  ADD PRIMARY KEY (`assignment_id`,`class_id`),
  ADD KEY `assignment_id` (`assignment_id`,`class_id`),
  ADD KEY `FK_classIDAssign` (`class_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `FK_commentUser` (`user_id`),
  ADD KEY `FK_commentPost` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_postUser` (`user_id`),
  ADD KEY `FK_postClass` (`class_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_class`
--
ALTER TABLE `users_class`
  ADD PRIMARY KEY (`class_id`,`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `FK_teacherClass` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_commentPost` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `FK_commentUser` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_postClass` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `FK_postUser` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users_class`
--
ALTER TABLE `users_class`
  ADD CONSTRAINT `FK_classID` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `FK_userIDTeacher` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
