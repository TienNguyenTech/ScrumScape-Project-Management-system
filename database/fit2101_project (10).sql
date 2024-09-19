-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 06:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fit2101_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `sprints`
--

CREATE TABLE `sprints` (
  `sprint_id` int(11) NOT NULL,
  `sprint_no` int(11) NOT NULL,
  `sprint_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Not Started','In Progress','Completed') DEFAULT 'Not Started',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sprints`
--

INSERT INTO `sprints` (`sprint_id`, `sprint_no`, `sprint_name`, `start_date`, `end_date`, `status`, `created_at`, `duration`) VALUES
(1, 1, 'Login & Homepage Development', '2024-09-11', '2024-10-02', 'Completed', '2024-09-10 23:30:00', 14),
(2, 2, 'Tasks & Sprints Development', '2024-10-03', '2024-10-16', 'In Progress', '2024-10-02 23:30:00', 14),
(3, 3, 'Kanban Board & Burndown Chart Development', '2024-10-17', '2024-10-30', 'Not Started', '2024-10-16 22:30:00', 14);

-- --------------------------------------------------------

--
-- Table structure for table `sprint_assignments`
--

CREATE TABLE `sprint_assignments` (
  `sprint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sprint_assignments`
--

INSERT INTO `sprint_assignments` (`sprint_id`, `user_id`) VALUES
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 4),
(3, 5),
(3, 6),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_no` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `story_points` decimal(5,2) NOT NULL,
  `priority` enum('Low','Medium','High') NOT NULL,
  `status` enum('Not Started','In Progress','Completed') DEFAULT 'Not Started',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_no`, `task_name`, `story_points`, `priority`, `status`, `created_at`) VALUES
(1, 1, 'Create Task: Backend DAO function', 5.00, 'Medium', 'Completed', '2024-09-17 17:23:07'),
(2, 2, 'Create Task: UI task registration form', 3.00, 'Medium', 'Completed', '2024-09-17 17:23:07'),
(3, 3, 'Update Task: Backend DAO function', 4.00, 'Medium', 'In Progress', '2024-09-17 17:23:07'),
(4, 4, 'Update Task: UI task update form', 2.00, 'Low', 'Not Started', '2024-09-17 17:23:07'),
(5, 5, 'Delete Task: Backend DAO function', 1.00, 'Low', 'Completed', '2024-09-17 17:23:07'),
(6, 6, 'View Product Backlog tasks: Backend DAO function', 3.00, 'Medium', 'Completed', '2024-09-17 17:23:07'),
(7, 7, 'View Product Backlog tasks: UI view table', 2.00, 'Low', 'In Progress', '2024-09-17 17:23:07'),
(8, 8, 'Create Sprint: Backend DAO function', 4.00, 'High', 'Not Started', '2024-09-17 17:23:07'),
(9, 9, 'Create Sprint: UI sprint registration form', 3.00, 'Medium', 'Not Started', '2024-09-17 17:23:07'),
(10, 10, 'Delete Sprint: Backend DAO function', 1.00, 'Low', 'Completed', '2024-09-17 17:23:07'),
(11, 11, 'Inspect Sprint: Backend DAO function', 5.00, 'High', 'Completed', '2024-09-17 17:23:07'),
(12, 12, 'Inspect Sprint: UI sprint inspect page', 4.00, 'Medium', 'In Progress', '2024-09-17 17:23:07'),
(13, 13, 'Update Sprint: Backend DAO function', 4.00, 'High', 'Completed', '2024-09-17 17:23:07'),
(14, 14, 'Update Sprint: UI update sprint form', 3.00, 'Medium', 'In Progress', '2024-09-17 17:23:07'),
(15, 15, 'View all Sprints: Backend DAO function', 3.00, 'Medium', 'Completed', '2024-09-17 17:23:07'),
(16, 16, 'View all Sprints: UI view table', 2.00, 'Low', 'Not Started', '2024-09-17 17:23:07'),
(17, 17, 'Kanban Board: Backend update DAO function for status', 5.00, 'High', 'In Progress', '2024-09-17 17:23:07'),
(18, 18, 'Kanban Board: UI board', 4.00, 'Medium', 'Not Started', '2024-09-17 17:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `task_assignments`
--

CREATE TABLE `task_assignments` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `logged_hours` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_assignments`
--

INSERT INTO `task_assignments` (`task_id`, `user_id`, `logged_hours`) VALUES
(1, 3, 5.00),
(2, 4, 4.50),
(3, 5, 3.25),
(4, 6, 2.00),
(5, 7, 1.75),
(6, 8, 4.00),
(7, 9, 3.50),
(8, 3, 6.00),
(9, 4, 5.50),
(10, 5, 2.00),
(11, 6, 7.00),
(12, 7, 3.00),
(13, 8, 6.50),
(14, 9, 4.75),
(15, 3, 5.00),
(16, 4, 3.75),
(17, 5, 4.50),
(18, 6, 2.25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_fname` varchar(50) DEFAULT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_name`, `user_password`, `user_fname`, `user_lname`, `admin`) VALUES
(1, 'achini.jayawardane@monash.edu', 'admin', '41e5653fc7aeb894026d6bb7b2db7f65902b454945fa8fd65a6327047b5277fb', 'Achini', 'Jayawardane', 1),
(2, 'nisal.desilva1@monash.edu', 'lecturer', '0098b8d8dca520e950652311b7e89780bf3a3b9702c9aadeacb3977b7ebca78e', 'Nisal', 'de Silva', 1),
(3, 'velocity.admin@velocitycode.com', 'velocity', 'a47b08aabb73a27f192c1fa25f232b61f3da4c251e3e604724630ca3ef0bb6e8', 'Velocity', 'Admin', 1),
(4, 'aditya.patel@velocitycode.com', 'aditya', 'f7f98b6beecbf24d42c3aa0937db5efff2031468ad5c44cdc2c80829259f2660', 'Aditya', 'Patel', 0),
(5, 'tien.nguyen@velocitycode.com', 'tien', '1fd3d7845594b371d28279b7aea5d3729fdfef66ba6d13490bbd33758a45ed47', 'Tien', 'Nguyen', 0),
(6, 'danna.pabayo@example.com', 'danna', '982e4b2f310be9d25db16d21574ff9f3527bb53657d2323627dc764fe6b6ecda', 'Danna', 'Pabayo', 0),
(7, 'oliver.sirota@example.com', 'oliver', '442b34deb77849e82b15f96712c47d31a6de3adc2e8ef94f1da198df99e99cac', 'Oliver', 'Sirota', 0),
(8, 'hiew.hong@example.com', 'hiew', '84233fae5c3199d8545af759f367dc42b6c296d0dc4fcb82c4aed47ee9bb191c', 'Hiew', 'Hong', 0),
(9, 'madelyn.ooi@example.com', 'madelyn', '98d71a5736ffcba7a8a521228a7e1c14dc069bdc3da4ad9c3f266fd3cf866d42', 'Madelyn', 'Ooi', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sprints`
--
ALTER TABLE `sprints`
  ADD PRIMARY KEY (`sprint_id`);

--
-- Indexes for table `sprint_assignments`
--
ALTER TABLE `sprint_assignments`
  ADD PRIMARY KEY (`sprint_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_assignments`
--
ALTER TABLE `task_assignments`
  ADD PRIMARY KEY (`task_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sprints`
--
ALTER TABLE `sprints`
  MODIFY `sprint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sprint_assignments`
--
ALTER TABLE `sprint_assignments`
  ADD CONSTRAINT `sprint_assignments_ibfk_1` FOREIGN KEY (`sprint_id`) REFERENCES `sprints` (`sprint_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sprint_assignments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `task_assignments`
--
ALTER TABLE `task_assignments`
  ADD CONSTRAINT `task_assignments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_assignments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
