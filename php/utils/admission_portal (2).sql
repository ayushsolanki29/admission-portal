-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 02, 2025 at 05:47 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admission_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `campus_images`
--

CREATE TABLE `campus_images` (
  `id` int NOT NULL,
  `image` varchar(200) NOT NULL,
  `college_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `campus_images`
--

INSERT INTO `campus_images` (`id`, `image`, `college_id`) VALUES
(13, '20250302173851_0.png', 6),
(14, '20250302173851_1.jpg', 6),
(15, '20250302173851_2.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int NOT NULL,
  `college_name` varchar(200) NOT NULL,
  `city_name` varchar(200) NOT NULL,
  `district_name` varchar(200) NOT NULL,
  `admission_type` varchar(200) NOT NULL,
  `courseId` varchar(100) NOT NULL,
  `desciption_of_college` text NOT NULL,
  `university_details` text NOT NULL,
  `admission_process` text NOT NULL,
  `placement_details` text NOT NULL,
  `college_logo` varchar(100) NOT NULL,
  `college_brochure` varchar(100) NOT NULL,
  `median_salary` varchar(100) NOT NULL,
  `avarage_package` varchar(100) NOT NULL,
  `highest_package` varchar(100) NOT NULL,
  `finance_type` varchar(100) NOT NULL,
  `university_name` varchar(100) NOT NULL,
  `total_Students` varchar(100) NOT NULL,
  `online_Students` varchar(100) NOT NULL,
  `ofline_Students` varchar(100) NOT NULL,
  `tag_id` varchar(200) NOT NULL,
  `college_campus` varchar(200) NOT NULL,
  `google_map_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_name`, `city_name`, `district_name`, `admission_type`, `courseId`, `desciption_of_college`, `university_details`, `admission_process`, `placement_details`, `college_logo`, `college_brochure`, `median_salary`, `avarage_package`, `highest_package`, `finance_type`, `university_name`, `total_Students`, `online_Students`, `ofline_Students`, `tag_id`, `college_campus`, `google_map_link`) VALUES
(6, 'Kalol Institute of Technology', 'Kalol', 'Gandhinagar', 'ACPC,Direct Admission', '3', 'KIRC is a distinguished institution in India, celebrated for its commitment to superior higher education over an impressive span of years. This revered academic institution has cultivated a vast network of over 10,000 professionals worldwide, testament to its excellence in education and impactful alumni. Offering a diverse array of more than undergraduate and postgraduate programs, KIRC is dedicated to blending rigorous academic theory with practical, hands-on experiences. The educational philosophy at KIRC centers around experiential learning, ensuring that students are well-equipped to apply their knowledge in practical settings. This holistic approach is supported by comprehensive internships and mentorship opportunities, providing a rich foundation for both personal and professional development.', 'Gujarat Technological University is a premier academic and research institution which has driven new ways of thinking since its 2007 founding, established by the Government of Gujarat vide Gujarat Act No. 20 of 2007. Today, GTU is an intellectual destination that draws inspired scholars to its campus, keeping GTU at the nexus of ideas that challenge and change the world.', 'Eligibility Criteria\r\nAdmission Coordination is handled by ACPC (Admission Committee for Professional Courses).\r\nEntrance Exam Requirement: Appeared in the Common Management Aptitude Test (CMAT) conducted by AICTE.\r\nCandidates must hold a Bachelor\'s Degree in any discipline (12+3 pattern).', 'The MCA program at KIM employs a dynamic and interactive pedagogy that balances theoretical understanding with practical application. The curriculum is delivered through a mix of lectures, hands-on laboratory sessions, projects, seminars, and workshops, ensuring that students gain comprehensive knowledge and skills. Collaborative projects and case studies encourage teamwork and problem-solving abilities, while internships and industry projects provide real-world exposure. This holistic approach to learning prepares students to successfully navigate and contribute to the technology industry.', '67c497421f45f_images (3).png', '67c497421f870_Kalol Institute of Technology Brochure.pdf', '18K', '1.2 LPA', '1.2 CR', 'Self Finace', 'Gujarat Technology University', '122222', '22222', '100000', '67c497421f45b', '67c497421fce3_images (4).png', 'https://www.google.com/maps/embed?pb=!4v1740901922819!6m8!1m7!1sCAoSLEFGMVFpcFB0cFkwc3JqU2NNVm1pWFZEamZSa3pObjdWZTczdE5xSTlfd2s0!2m2!1d23.25083808666042!2d72.47860357326454!3f172.5954783024602!4f0!5f0.7820865974627469');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `other_topic` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `full_name`, `email`, `phone`, `city`, `topic`, `other_topic`, `message`, `created_at`) VALUES
(1, 'AYUSH', 'magod70932@acname.com', 'asdsad', 'Gandhinagar', 'counseling', '', 'saddddddd', '2025-03-02 03:02:44'),
(2, 'AYUSH', 'gisor58437@chodyi.com', '4444444444444444', 'Gandhinagar', 'other', '4333333333', 'fddddddddddd', '2025-03-02 03:12:10'),
(3, 'AYUSH', 'hotikor611@armablog.com', 'dfffffffff', 'Gandhinagar', 'developer', '', 'assssssssssssssssssss', '2025-03-02 03:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `short_form` varchar(100) NOT NULL,
  `fees` varchar(50) NOT NULL,
  `duration_of_Course` varchar(100) NOT NULL,
  `study_mode` varchar(50) NOT NULL,
  `enterance_exam` varchar(100) NOT NULL,
  `eligibility` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `course_thumbnail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `short_form`, `fees`, `duration_of_Course`, `study_mode`, `enterance_exam`, `eligibility`, `department`, `course_thumbnail`) VALUES
(3, 'Master Of Computer Applications', 'MCA', '25000', '4 Year', 'Regular', 'CMAT, CAT', 'At Least 60% in Bachelor Degree', 'IT Section', '67c495f729bf3_16.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`) VALUES
(1, 'IT Section'),
(5, 'Engineering');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campus_images`
--
ALTER TABLE `campus_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campus_images`
--
ALTER TABLE `campus_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
