-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 10:45 AM
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
-- Table structure for table `hours_log`
--

CREATE TABLE `hours_log` (
  `log_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hours` decimal(5,2) NOT NULL,
  `log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hours_log`
--

INSERT INTO `hours_log` (`log_id`, `task_id`, `user_id`, `hours`, `log_date`) VALUES
(1, 1, 3, 5.00, '2024-09-10'),
(2, 2, 4, 6.50, '2024-09-12'),
(3, 3, 5, 4.25, '2024-09-13'),
(4, 4, 6, 7.00, '2024-09-15'),
(5, 5, 7, 3.75, '2024-09-18'),
(6, 6, 8, 9.00, '2024-09-20'),
(7, 7, 9, 8.50, '2024-09-22'),
(8, 8, 3, 6.00, '2024-09-25'),
(9, 9, 4, 7.25, '2024-09-28'),
(10, 10, 5, 10.50, '2024-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `sprint`
--

CREATE TABLE `sprint` (
  `sprint_id` int(11) NOT NULL,
  `sprint_no` int(11) NOT NULL,
  `sprint_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Not Started','In Progress','Completed') DEFAULT 'Not Started',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sprint`
--

INSERT INTO `sprint` (`sprint_id`, `sprint_no`, `sprint_name`, `start_date`, `end_date`, `status`, `created_at`) VALUES
(1, 1, 'Login & Homepage Development', '2024-09-11', '2024-10-02', 'Completed', '2024-09-10 23:30:00'),
(2, 2, 'Tasks & Sprints Development', '2024-10-03', '2024-10-16', 'In Progress', '2024-10-02 23:30:00'),
(3, 3, 'Kanban Board & Burndown Chart Development', '2024-10-17', '2024-10-30', 'Not Started', '2024-10-16 22:30:00'),
(4, 4, 'Hello Australia', '2024-10-10', '2024-10-25', 'Not Started', '2024-10-03 14:00:00'),
(5, 5, 'Wolf', '2024-10-11', '2024-10-07', 'In Progress', '2024-10-06 13:00:00'),
(6, 6, 'Everest', '2024-10-19', '2024-10-25', 'Not Started', '2024-10-07 13:00:00'),
(7, 7, 'Marvel', '2024-10-24', '2024-11-01', 'Not Started', '2024-10-07 13:00:00'),
(8, 8, 'Wukong', '2024-10-11', '2024-10-25', 'In Progress', '2024-10-07 13:00:00'),
(9, 9, 'Hi', '2024-10-18', '2024-10-20', 'Not Started', '2024-10-08 13:00:00'),
(10, 10, 'hey', '2024-10-20', '2024-10-26', 'Not Started', '2024-10-08 13:00:00'),
(11, 11, 'Pro', '2024-10-11', '2024-11-02', 'In Progress', '2024-10-08 13:00:00'),
(16, 16, 'Hello', '2024-10-10', '2024-10-11', 'Not Started', '2024-10-08 13:00:00'),
(17, 17, 'Hello', '2024-10-18', '2024-10-26', 'Not Started', '2024-10-08 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sprint_assignment`
--

CREATE TABLE `sprint_assignment` (
  `sprint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sprint_assignment`
--

INSERT INTO `sprint_assignment` (`sprint_id`, `user_id`) VALUES
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
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES
(1, 'Frontend'),
(2, 'Backend'),
(3, 'API'),
(4, 'Database'),
(5, 'Framework'),
(6, 'Testing'),
(7, 'UI'),
(8, 'UX');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_no` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `story_points` decimal(5,2) NOT NULL,
  `type` enum('Story','Bug') DEFAULT 'Story',
  `priority` enum('Low','Medium','High') NOT NULL,
  `status` enum('Not Started','In Progress','Completed') DEFAULT 'Not Started',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sprint_id` int(11) DEFAULT NULL,
  `completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_no`, `task_name`, `description`, `story_points`, `type`, `priority`, `status`, `created_at`, `sprint_id`, `completion_date`) VALUES
(1, 1, 'Create Task: Backend DAO function', 'Design the homepage layout and structure.', 5.00, 'Story', 'Medium', 'Completed', '2024-09-17 17:23:07', 1, NULL),
(2, 2, 'Create Task: UI task registration form', 'Implement the backend logic for user authentication.', 3.00, 'Story', 'Medium', 'Completed', '2024-09-17 17:23:07', 1, NULL),
(3, 3, 'Update Task: Backend DAO function', 'Develop RESTful APIs for data handling.', 4.00, 'Story', 'Medium', 'In Progress', '2024-09-17 17:23:07', 1, NULL),
(4, 4, 'Update Task: UI task update form', 'Set up the database schema and relationships.', 2.00, 'Story', 'Low', 'Not Started', '2024-09-17 17:23:07', 2, NULL),
(5, 5, 'Delete Task: Backend DAO function', 'Choose and implement a front-end framework.', 1.00, 'Story', 'Low', 'Completed', '2024-09-17 17:23:07', 2, NULL),
(6, 6, 'View Product Backlog tasks: Backend DAO function', 'Write and execute test cases for the application.', 3.00, 'Story', 'Medium', 'Completed', '2024-09-17 17:23:07', 2, NULL),
(7, 7, 'View Product Backlog tasks: UI view table', 'Create a responsive user interface for mobile and desktop.', 2.00, 'Story', 'Low', 'In Progress', '2024-09-17 17:23:07', 2, NULL),
(8, 8, 'Create Sprint: Backend DAO function', 'Design and improve user experience across the platform.', 4.00, 'Story', 'High', 'Not Started', '2024-09-17 17:23:07', 2, NULL),
(9, 9, 'Create Sprint: UI sprint registration form', 'Develop a component for the navigation bar.', 3.00, 'Story', 'Medium', 'Not Started', '2024-09-17 17:23:07', 2, NULL),
(10, 10, 'Delete Sprint: Backend DAO function', 'Optimize API calls for performance and speed.', 1.00, 'Story', 'Low', 'Completed', '2024-09-17 17:23:07', 3, NULL),
(11, 11, 'Inspect Sprint: Backend DAO function', 'Write documentation for the database structure.', 5.00, 'Story', 'High', 'Completed', '2024-09-17 17:23:07', 3, NULL),
(12, 12, 'Inspect Sprint: UI sprint inspect page', 'Implement user feedback in the next design iteration.', 4.00, 'Story', 'Medium', 'In Progress', '2024-09-17 17:23:07', NULL, NULL),
(13, 13, 'Update Sprint: Backend DAO function', 'Conduct code reviews to ensure quality and standards.', 4.00, 'Story', 'High', 'Completed', '2024-09-17 17:23:07', NULL, NULL),
(14, 14, 'Update Sprint: UI update sprint form', 'Integrate third-party services and APIs.', 3.00, 'Story', 'Medium', 'In Progress', '2024-09-17 17:23:07', NULL, NULL),
(15, 15, 'View all Sprints: Backend DAO function', 'Prepare and present the project milestones to stakeholders.', 3.00, 'Story', 'Medium', 'Completed', '2024-09-17 17:23:07', NULL, NULL),
(16, 16, 'View all Sprints: UI view table', 'Conduct user testing sessions for feedback.', 2.00, 'Story', 'Low', 'Not Started', '2024-09-17 17:23:07', NULL, NULL),
(17, 17, 'Kanban Board: Backend update DAO function for status', 'Create data backup and recovery procedures.', 5.00, 'Story', 'High', 'In Progress', '2024-09-17 17:23:07', NULL, NULL),
(18, 18, 'Kanban Board: UI board', 'Ensure accessibility standards are met in the UI design.', 4.00, 'Story', 'Medium', 'Not Started', '2024-09-17 17:23:07', NULL, NULL),
(19, 1, 'Create Task', 'Conduct a performance review and optimization for the application.', 3.00, 'Story', 'Medium', 'Not Started', '2024-09-27 14:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_assignment`
--

CREATE TABLE `task_assignment` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assignment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_assignment`
--

INSERT INTO `task_assignment` (`task_id`, `user_id`, `assignment_date`) VALUES
(1, 3, '2024-10-09'),
(2, 4, '2024-10-10'),
(3, 5, '2024-10-11'),
(4, 6, '2024-10-12'),
(5, 7, '2024-10-13'),
(6, 8, '2024-10-14'),
(7, 9, '2024-10-15'),
(8, 3, '2024-10-16'),
(9, 4, '2024-10-17'),
(10, 5, '2024-10-18'),
(11, 6, '2024-10-19'),
(12, 7, '2024-10-20'),
(13, 8, '2024-10-21'),
(14, 9, '2024-10-22'),
(15, 3, '2024-10-23'),
(16, 4, '2024-10-24'),
(17, 5, '2024-10-25'),
(18, 6, '2024-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `task_tag`
--

CREATE TABLE `task_tag` (
  `task_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_tag`
--

INSERT INTO `task_tag` (`task_id`, `tag_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 1),
(10, 2),
(11, 3),
(12, 4),
(13, 5),
(14, 6),
(15, 7),
(16, 8),
(17, 1),
(18, 2),
(19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_fname` varchar(50) DEFAULT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_name`, `user_password`, `user_fname`, `user_lname`, `admin`) VALUES
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
-- Indexes for table `hours_log`
--
ALTER TABLE `hours_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sprint`
--
ALTER TABLE `sprint`
  ADD PRIMARY KEY (`sprint_id`);

--
-- Indexes for table `sprint_assignment`
--
ALTER TABLE `sprint_assignment`
  ADD PRIMARY KEY (`sprint_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_ibfk_1` (`sprint_id`);

--
-- Indexes for table `task_assignment`
--
ALTER TABLE `task_assignment`
  ADD PRIMARY KEY (`task_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `task_tag`
--
ALTER TABLE `task_tag`
  ADD PRIMARY KEY (`task_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hours_log`
--
ALTER TABLE `hours_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sprint`
--
ALTER TABLE `sprint`
  MODIFY `sprint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hours_log`
--
ALTER TABLE `hours_log`
  ADD CONSTRAINT `hours_log_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task_assignment` (`task_id`),
  ADD CONSTRAINT `hours_log_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `task_assignment` (`user_id`);

--
-- Constraints for table `sprint_assignment`
--
ALTER TABLE `sprint_assignment`
  ADD CONSTRAINT `sprint_assignment_ibfk_1` FOREIGN KEY (`sprint_id`) REFERENCES `sprint` (`sprint_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sprint_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`sprint_id`) REFERENCES `sprint` (`sprint_id`) ON DELETE SET NULL;

--
-- Constraints for table `task_assignment`
--
ALTER TABLE `task_assignment`
  ADD CONSTRAINT `task_assignment_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `task_tag`
--
ALTER TABLE `task_tag`
  ADD CONSTRAINT `task_tag_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
