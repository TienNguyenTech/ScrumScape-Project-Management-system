-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 05:54 AM
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
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('not started','active','completed') DEFAULT 'not started',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sprints`
--

INSERT INTO `sprints` (`id`, `name`, `start_date`, `end_date`, `status`, `created_at`, `duration`) VALUES
(1, 'Sprint 1', '2024-09-01', '2024-09-07', 'not started', '2024-08-29 14:14:36', 6),
(2, 'Sprint 1', '2024-09-01', '2024-09-07', 'not started', '2024-08-29 14:19:26', 6);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('product owner','scrum master','developer','business analyst') DEFAULT 'developer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `role`, `created_at`) VALUES
(1, 'Liam Harris', 'liam.harris@example.com', '', '2024-08-30 00:00:00'),
(2, 'Emma Clark', 'emma.clark@example.com', '', '2024-08-30 00:15:00'),
(3, 'Noah Lewis', 'noah.lewis@example.com', '', '2024-08-30 00:30:00'),
(4, 'Ava Walker', 'ava.walker@example.com', '', '2024-08-30 00:45:00'),
(5, 'Oliver King', 'oliver.king@example.com', '', '2024-08-30 01:00:00'),
(6, 'Sophia Hill', 'sophia.hill@example.com', '', '2024-08-30 01:15:00'),
(7, 'Elijah Scott', 'elijah.scott@example.com', '', '2024-08-30 01:30:00'),
(8, 'Isabella Green', 'isabella.green@example.com', '', '2024-08-30 01:45:00'),
(9, 'James Adams', 'james.adams@example.com', '', '2024-08-30 02:00:00'),
(10, 'Mia Baker', 'mia.baker@example.com', '', '2024-08-30 02:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('story','bug') DEFAULT 'story',
  `weight` int(11) NOT NULL CHECK (`weight` between 1 and 10),
  `tag` set('frontend','backend','api','database','framework','testing','ui','ux') NOT NULL,
  `priority` enum('low','medium','important','urgent') NOT NULL,
  `assignee_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('not started','in progress','completed') DEFAULT 'not started',
  `stage` enum('planning','development','testing','integration') DEFAULT 'planning',
  `sprint_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `type`, `weight`, `tag`, `priority`, `assignee_id`, `description`, `status`, `stage`, `sprint_id`, `created_at`) VALUES
(1, 'Create Login Page', 'story', 5, 'frontend,backend', 'important', 1, 'Create a login page with authentication.', 'not started', 'planning', 1, '2024-08-29 14:14:36'),
(2, 'Design Database Schema', 'story', 8, 'backend', '', 2, 'Design the database schema for the project.', 'not started', 'planning', 1, '2024-08-29 14:30:00'),
(3, 'Implement User Registration', '', 3, 'backend', 'important', 3, 'Implement the user registration functionality with validation.', 'not started', 'planning', 1, '2024-08-29 14:45:00'),
(4, 'Set Up CI/CD Pipeline', '', 4, '', 'medium', 4, 'Set up continuous integration and deployment pipeline.', 'not started', 'planning', 1, '2024-08-29 15:00:00'),
(5, 'Create User Dashboard', 'story', 6, 'frontend', '', 1, 'Develop a user dashboard for displaying personalized information.', 'not started', 'planning', 1, '2024-08-29 15:15:00'),
(6, 'Write Unit Tests', '', 2, 'testing', 'important', 2, 'Write unit tests for the backend services.', 'not started', 'planning', 1, '2024-08-29 15:30:00'),
(7, 'Optimize Database Queries', 'story', 5, 'backend', '', 3, 'Optimize the existing database queries for better performance.', 'not started', 'planning', 1, '2024-08-29 15:45:00'),
(8, 'Create Landing Page', '', 4, 'frontend', 'medium', 4, 'Design and develop the project’s landing page.', 'not started', 'planning', 1, '2024-08-29 16:00:00'),
(9, 'Set Up User Authentication', '', 3, 'frontend,backend', 'important', 1, 'Set up user authentication across the application.', 'not started', 'planning', 1, '2024-08-29 16:15:00'),
(10, 'Deploy Application', '', 7, '', '', 2, 'Deploy the application to the production environment.', 'not started', 'planning', 1, '2024-08-29 16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `time_logs`
--

CREATE TABLE `time_logs` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hours_spent` decimal(5,2) NOT NULL,
  `log_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') DEFAULT 'member',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin', 'admin@example.com', 'admin12345', 'admin', '2024-08-29 14:14:36'),
(2, 'John Doe', 'johndoe', 'john.doe@example.com', 'password12345', 'member', '2024-08-29 14:14:36'),
(3, 'Jane Smith', 'janesmith', 'jane.smith@example.com', 'password12345', 'member', '2024-08-29 14:14:36');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `before_insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.username = LOWER(REPLACE(NEW.name, ' ', ''));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sprints`
--
ALTER TABLE `sprints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignee_id` (`assignee_id`),
  ADD KEY `sprint_id` (`sprint_id`);

--
-- Indexes for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sprints`
--
ALTER TABLE `sprints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `time_logs`
--
ALTER TABLE `time_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assignee_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`sprint_id`) REFERENCES `sprints` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD CONSTRAINT `time_logs_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `time_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
