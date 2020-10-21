-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 12:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
  `classAvatar` longtext NOT NULL,
  `teacher_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `className`, `subject`, `classRoom`, `classAvatar`, `teacher_id`) VALUES
('class1122', 'Lập trình AI - Ca 4', 'Lập trình AI', 'A1252', 'https://www.stockvault.net/data/2019/04/14/263855/preview16.jpg', 'user5f857cdd92ee5'),
('class1234', 'Phân tích thiết kế - Ca 4', 'Phân tích thiết kế và giải thuật', 'A0504', 'https://c4.wallpaperflare.com/wallpaper/231/113/301/background-solid-glare-light-wallpaper-preview.jpg', 'user5f847fc434323'),
('class2231', 'Lập Trình Web - Ứng dụng Ca 3', 'Lập Trình Web', 'A0525', 'https://www.desktopbackground.org/download/o/2014/01/02/695204_simple-color-hd-1080p-wallpaper-color-hd-wallpaper-hd-1080p-hd_2560x1440_h.jpg', 'user5f847bad67765'),
('class2234', 'Mạng máy tính - Ca 3', 'Mạng máy tính', 'A1502', 'https://wallpaperset.com/w/full/4/6/3/105103.jpg', 'user5f847fc434323'),
('class3456', 'Cấu trúc dữ liệu - Ca 2', 'Cấu trúc dữ liệu', 'A0635', 'https://wallpaperset.com/w/full/4/6/3/105103.jpg', 'user5f8470440afac'),
('class4554', 'Thiết kế giao diện - Ca 2', 'Thiết kế giao diện', 'A0501', 'https://www.wallpapers4u.org/wp-content/uploads/spot_light_color_bright_43993_1920x1080.jpg', 'user5f847bad67765'),
('class5678', 'Ứng dụng di động - Ca 2', 'Ứng dụng di động', 'A0252', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTATVTClP17Aut9uKMcUQ7iVcyn2TRqxRXsiA&usqp=CAU', 'user5f857cdd92ee5'),
('class7890', 'Giải thuật 2 - Ca 1', 'Giải thuật 2', 'A0603', 'https://storage.pixteller.com/designs/designs-images/2019-03-27/05/simple-background-backgrounds-passion-simple-1-5c9b95c124328.png', 'user5f8470440afac');

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
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` varchar(500) NOT NULL,
  `post_des` text NOT NULL COMMENT 'post description',
  `file` varbinary(500) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teachers_class`
--

CREATE TABLE `teachers_class` (
  `class_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers_class`
--

INSERT INTO `teachers_class` (`class_id`, `user_id`) VALUES
('class1234', 'user5f847fc434323'),
('class2231', 'user5f847bad67765');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_post`
--

CREATE TABLE `teacher_post` (
  `post_id` varchar(500) NOT NULL,
  `teacher_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('user5f857cdd92ee5', '$2y$10$JeFLGdvc1B1A.TnxD7g6lODVIXHSyrO22lt9wQkW0HDbSqzOLKk2y', 'Nguyen Van B', '2020-10-05', 'nguyenvanb@gmail.com', '0985758984', 'tea');

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
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `teachers_class`
--
ALTER TABLE `teachers_class`
  ADD PRIMARY KEY (`class_id`,`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `teacher_post`
--
ALTER TABLE `teacher_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_teacherPost` (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `FK_teacherClass` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `teachers_class`
--
ALTER TABLE `teachers_class`
  ADD CONSTRAINT `FK_classID` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `FK_userIDTeacher` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `teacher_post`
--
ALTER TABLE `teacher_post`
  ADD CONSTRAINT `FK_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `FK_teacherPost` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
