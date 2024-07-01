-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 05:06 PM
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
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `user_id`, `quiz_id`, `score`, `attempt_timestamp`) VALUES
(10, 5, 1, 2, '2024-06-30 05:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(100) NOT NULL,
  `post_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content_comment` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `name`, `content_comment`, `image`, `created`, `user_id`) VALUES
(167, '84', '', 'hello', NULL, '1715117411', 0),
(168, '87', '', 'Helloooooooooo', NULL, '1716031621', 0),
(169, '86', '', 'Hellllll', NULL, '1716031628', 0),
(170, '87', '', 'Hellllll', NULL, '1716031632', 0),
(171, '85', '', 'ggggggg', NULL, '1716031636', 0),
(172, '0', '', 'Hello', NULL, '1716819571', 1),
(173, '0', '', 'Hellooo', NULL, '1717099705', 1),
(174, '4', '', 'Hello', NULL, '1717100983', 1),
(175, '3', '', 'no', NULL, '1717100990', 1),
(176, '2', '', 'yes', NULL, '1717100998', 1),
(177, '1', '', 'ily', NULL, '1717101004', 1),
(178, '6', '', 'Hello', NULL, '1717652940', 1),
(179, '7', '', 'Hello', NULL, '1719461996', 1);

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `measurement_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `bmi` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `goal` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL,
  `measurement_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`measurement_id`, `age`, `height`, `bmi`, `weight`, `goal`, `member_id`, `measurement_date`) VALUES
(24, 22, 174, 22, 103, 'Endurance', 1, '2024-06-20'),
(25, 22, 174, 20, 100, 'Endurance', 1, '2024-06-20'),
(26, 22, 192, 33, 123, 'Flexibility', 1, '2024-06-20'),
(27, 22, 192, 22, 80, 'Weight Loss', 1, '2024-06-24'),
(29, 22, 174, 23, 69, 'Functional Fitness', 5, '2024-06-30'),
(30, 22, 174, 23, 69, 'Functional Fitness', 5, '2024-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membership_id` int(11) NOT NULL,
  `membership_start` date NOT NULL,
  `membership_end` date NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_id`, `membership_start`, `membership_end`, `member_id`) VALUES
(1, '2024-05-17', '2024-09-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 2, 1, 'Hello'),
(2, 1, 2, 'Hello Back'),
(3, 2, 1, 'Hello'),
(4, 1, 2, 'How are you');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `option_text`, `is_correct`) VALUES
(1, 1, 'Running', 0),
(2, 1, 'Swimming', 1),
(3, 1, 'Jumping jacks', 0),
(4, 1, 'Burpees', 0),
(5, 2, 'Biceps', 0),
(6, 2, 'Triceps', 0),
(7, 2, 'Quadriceps', 1),
(8, 2, 'Deltoids', 0),
(9, 3, '75 minutes', 0),
(10, 3, '100 minutes', 0),
(11, 3, '150 minutes', 1),
(12, 3, '200 minutes', 0),
(13, 5, 'Weightlifting', 0),
(14, 5, 'Yoga', 0),
(15, 5, 'Interval running', 1),
(16, 5, 'Pilates', 0),
(17, 6, 'Brisk walking', 1),
(18, 6, 'Jump rope', 0),
(19, 6, 'Bench press', 0),
(20, 6, 'Rowing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `post_image` varchar(100) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `created` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qfc`
--

CREATE TABLE `qfc` (
  `qfc_id` int(11) NOT NULL,
  `qfc_title` varchar(255) NOT NULL,
  `qfc_url` varchar(255) NOT NULL,
  `qfc_type` varchar(255) NOT NULL,
  `qfc_status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qfc_description` varchar(255) NOT NULL,
  `qfc_feedback` varchar(255) NOT NULL,
  `trainer_replied` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `qfc`
--

INSERT INTO `qfc` (`qfc_id`, `qfc_title`, `qfc_url`, `qfc_type`, `qfc_status`, `user_id`, `qfc_description`, `qfc_feedback`, `trainer_replied`) VALUES
(1, 'Problem with posture', 'https://www.youtube.com/', 'posture', 'complete', 1, 'lopem mndsmd dkldklc dslkdfkmd', '', NULL),
(2, 'Hello', 'facebook.com', 'anything', 'complete', 1, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '', NULL),
(3, 'Hello kitty', 'www.youtube.com', 'Ankle ', 'complete', 1, 'Hello kitty', 'lesgo', 2),
(4, 'Hello kitty nose', 'www.Facebook.com', 'chest', 'complete', 1, 'This is facebook', 'gogogogog', 2),
(5, 'Posture Problem', 'www.youtube.com', 'posture', 'Active', 1, 'Lorem ', '', NULL),
(7, 'Hello kitty', 'www.Facebook.com', 'Nutrition', 'Active', 1, 'lllllllllllllllllllllllllllllll', '', NULL),
(8, 'aaaaaaaa', 'assssaaefdsfds', 'Cardio', 'Active', 1, 'dresfes', '', NULL),
(9, 'lelele', 'facebook.com', 'Nutrition', 'complete', 1, 'This is facebook description', 'Hello there', 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `quiz_id`, `question_text`) VALUES
(1, 1, 'Which of the following is considered a low-impact cardio exercise?'),
(2, 1, 'What is the primary muscle targeted during cycling?'),
(3, 1, 'What is the recommended duration of moderate-intensity cardio exercise per week for adults?'),
(5, 1, 'Which type of cardio exercise is best for improving cardiovascular endurance?'),
(6, 1, 'Which of these activities is NOT typically considered a form of cardio exercise?');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `quiz_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `quiz_title`, `quiz_description`) VALUES
(1, 'Cardio', 'This is a cardio quiz');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_pk` int(11) NOT NULL,
  `day_of_week` varchar(255) NOT NULL,
  `workout_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_pk`, `day_of_week`, `workout_name`, `description`, `user_id`) VALUES
(6, 'Monday', 'Leg press', '3 sets and 10 reps', 1),
(7, 'Monday', 'Shoulder press', '4 sets 12 reps', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_email`, `user_password`, `user_number`, `status`, `type`, `points`) VALUES
(1, 'Anas', 'anasehabelabd12@gmail.com', 'Zalabia12', '603311111111', '', 'member', 25),
(2, 'bota', 'bota@gmail.com', 'Bota21', '+89993939030', '', 'trainer', 0),
(5, 'omar', 'omar@gmail.com', 'Zalabia12', '12345', '', 'member', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`measurement_id`),
  ADD KEY `fk2_member_id` (`member_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membership_id`),
  ADD KEY `fk_member_id` (`member_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `qfc`
--
ALTER TABLE `qfc`
  ADD PRIMARY KEY (`qfc_id`),
  ADD KEY `fk_qfc_user_id` (`user_id`),
  ADD KEY `fk_trainer_replied` (`trainer_replied`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_pk`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `qfc`
--
ALTER TABLE `qfc`
  MODIFY `qfc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `attempts_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `fk2_member_id` FOREIGN KEY (`member_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints for table `qfc`
--
ALTER TABLE `qfc`
  ADD CONSTRAINT `fk_qfc_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk_trainer_replied` FOREIGN KEY (`trainer_replied`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
