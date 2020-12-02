-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 05:51 PM
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
('5fc7baeb', 'Lập Trình Web - Ứng Dụng Ca 5', 'Lập Trình Web', 'C510', 'default_bg.jpg', 'user5f857cdd92ee5'),
('class1122', 'Lập trình AI - Ca 4', 'Lập trình AI', 'A1252', 'minimalistic-abstract-colors-simple-background-5k-fc.jpg', 'user5f857cdd92ee5'),
('class2231', 'Lập Trình Web - Ứng dụng Ca 3', 'Lập Trình Web', 'A0525', '67959940_475210066643935_2308596633006243840_o.jpg', 'user5f847bad67765'),
('class7890', 'Giải thuật 2 - Ca 1', 'Giải thuật 2', 'A0603', 'Predator.jpg', 'user5f8470440afac');

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
  `file_dir` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `content`, `dateT_current`, `dateT_update`, `class_id`, `file_dir`) VALUES
(27, 'user5f847bad67765', 'ciao', '2020-11-16 06:00:40', '2020-11-16 06:00:40', 'class7890', ''),
(50, 'user5f857cdd92ee5', 'Example Files ', '2020-12-02 09:56:31', '2020-12-02 09:56:31', 'class1122', 'Alone.mp3');

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
('user5f857cdd92ee5', '$2y$10$JeFLGdvc1B1A.TnxD7g6lODVIXHSyrO22lt9wQkW0HDbSqzOLKk2y', 'Nguyen Van B', '2020-10-05', 'teacher.eclassB@gmail.com', '0985758984', 'tea'),
('user5fc7611979ff7', '$2y$10$qPwbj7rbL2.qXwByhTgts.ou/RA79G0SacucFPkRWFKhGSoTHcYCK', 'Student 1', '2020-12-17', 'eclassroom.student1@gmail.com', '874589687', 'stu');

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
('5fc7baeb', 'user5fc7611979ff7'),
('class1122', 'user5fc7611979ff7'),
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
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `FK_teacherClass` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_commentPost` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_commentUser` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_postClass` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_postUser` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

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
