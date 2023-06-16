-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2023 at 01:22 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fcsldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `p1_admin`
--

CREATE TABLE `p1_admin` (
  `id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_course`
--

CREATE TABLE `p1_course` (
  `course_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_feedback`
--

CREATE TABLE `p1_feedback` (
  `feedback_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `assignments` int(11) NOT NULL,
  `lab evaluations` int(11) NOT NULL,
  `exams` int(11) NOT NULL,
  `comment` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_gives`
--

CREATE TABLE `p1_gives` (
  `anon_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_instructor`
--

CREATE TABLE `p1_instructor` (
  `id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_represents`
--

CREATE TABLE `p1_represents` (
  `stud_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anon_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_section`
--

CREATE TABLE `p1_section` (
  `course_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_student`
--

CREATE TABLE `p1_student` (
  `id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_takes`
--

CREATE TABLE `p1_takes` (
  `id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p1_teaches`
--

CREATE TABLE `p1_teaches` (
  `id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL,
  `course_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p1_admin`
--
ALTER TABLE `p1_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p1_course`
--
ALTER TABLE `p1_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `p1_feedback`
--
ALTER TABLE `p1_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `p1_gives`
--
ALTER TABLE `p1_gives`
  ADD KEY `anon_id` (`anon_id`),
  ADD KEY `feedback_id` (`feedback_id`);

--
-- Indexes for table `p1_instructor`
--
ALTER TABLE `p1_instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p1_represents`
--
ALTER TABLE `p1_represents`
  ADD PRIMARY KEY (`anon_id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- Indexes for table `p1_section`
--
ALTER TABLE `p1_section`
  ADD PRIMARY KEY (`course_id`,`sec_id`,`semester`);

--
-- Indexes for table `p1_student`
--
ALTER TABLE `p1_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p1_takes`
--
ALTER TABLE `p1_takes`
  ADD UNIQUE KEY `id_2` (`id`,`course_id`,`sec_id`,`semester`),
  ADD KEY `id` (`id`),
  ADD KEY `course_id` (`course_id`,`sec_id`,`semester`);

--
-- Indexes for table `p1_teaches`
--
ALTER TABLE `p1_teaches`
  ADD UNIQUE KEY `id_2` (`id`,`sec_id`,`semester`,`course_id`),
  ADD KEY `id` (`id`),
  ADD KEY `course_id` (`course_id`,`sec_id`,`semester`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p1_gives`
--
ALTER TABLE `p1_gives`
  ADD CONSTRAINT `p1_gives_ibfk_1` FOREIGN KEY (`anon_id`) REFERENCES `p1_represents` (`anon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p1_gives_ibfk_2` FOREIGN KEY (`feedback_id`) REFERENCES `p1_feedback` (`feedback_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p1_represents`
--
ALTER TABLE `p1_represents`
  ADD CONSTRAINT `p1_represents_ibfk_1` FOREIGN KEY (`stud_id`) REFERENCES `p1_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p1_section`
--
ALTER TABLE `p1_section`
  ADD CONSTRAINT `p1_section_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `p1_course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p1_takes`
--
ALTER TABLE `p1_takes`
  ADD CONSTRAINT `p1_takes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `p1_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p1_takes_ibfk_2` FOREIGN KEY (`course_id`,`sec_id`,`semester`) REFERENCES `p1_section` (`course_id`, `sec_id`, `semester`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p1_teaches`
--
ALTER TABLE `p1_teaches`
  ADD CONSTRAINT `p1_teaches_ibfk_1` FOREIGN KEY (`id`) REFERENCES `p1_instructor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p1_teaches_ibfk_2` FOREIGN KEY (`course_id`,`sec_id`,`semester`) REFERENCES `p1_section` (`course_id`, `sec_id`, `semester`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
