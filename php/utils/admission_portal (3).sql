-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2025 at 05:37 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `rememberme_tokens`
--

CREATE TABLE `rememberme_tokens` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiration` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rememberme_tokens`
--

INSERT INTO `rememberme_tokens` (`id`, `user_id`, `token`, `expiration`) VALUES
(1, 9, '8ad66757138078b3a3818a77caba968619912a5612119a8ffc7a5fad86ecca42', '2025-04-04 08:32:04'),
(2, 9, '15e9972c971f5268979e1c69b30fdbaff3806d75c8663c80d6d78ac64b84cc2d', '2025-04-04 08:47:18'),
(3, 9, '974db972c86730a52126ed692d3117a6a31eb0cbc4eb002a6b5cdac237b3d4a3', '2025-04-04 08:56:28'),
(4, 9, '8b02ae4a74d4ca4392521847626589171dc2c4b90ed86c19c95d4c985407822a', '2025-04-04 08:59:24'),
(5, 9, '5af822d0513a6fe642612ca0a665cc69afd827dbf374b97dd237a8658d7482c2', '2025-04-04 10:44:04'),
(6, 10, 'e45afb008bdd298e0ec7cdf8e2c57138abfa1c9cf1a716b186c9b87ae7be4349', '2025-04-04 10:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `profile_pic` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'default.png',
  `password` varchar(255) NOT NULL,
  `acc_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'inactive',
  `verification_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone_number`, `gender`, `department`, `profile_pic`, `password`, `acc_status`, `verification_code`, `created_at`, `city`) VALUES
(2, 'admin_marcha', 'waxihid146@arinuse.com', '9876543210', 'female', 'Finance', NULL, '$2y$10$XoSreUpjdND0EthPkiLwc.S3/PlMuIEL.TORkUR7exFF1388ZPH5y', 'inactive', 'z0VU6w4Yes82NKMiktBE9FZCh', '2025-03-04 17:36:17', 'kalol'),
(3, 'steamuser', 'gigoye1471@anomgo.com', '9876543210', 'male', 'Engineering', NULL, '$2y$10$dCdH6BDxTE7O7IlY8hgGD.WCORakRznlPDChM5Px7l3AvJTAtXpS.', 'inactive', 'Pu4mWC7cOwsfqSb8TKkvp5jQiraELAeUIF02NYGVoR6BgDtZJ1MxhH3lnz9dXy', '2025-03-04 18:23:21', 'india'),
(4, 'ayush', 'ayushsolanki2901+newprime@gmail.com', '9876543210', 'male', 'Engineering', NULL, '$2y$10$a1iqk6oxM5UA2E65yqqkneQ7JZTqlSykh2xM0ADsm28y79wG/krWG', 'inactive', '849HTIs0eFwuXGaS6QL7obWmhUcgr3KAqidCO1VZtDEjlPNBM2fYJvRyknxz5p', '2025-03-04 18:34:27', 'india'),
(5, 'ayush1', 'ayushsolanki2901+newprime2@gmail.com', '9876543210', 'male', 'Engineering', NULL, '$2y$10$e4PS1OG42uvwUpW8IWPV9ebzcb7HG1Y6AHc1PS45/.UzHjq4MigmC', 'inactive', '416B5Yk2VvtrSiAGHbIWRT7Luw8hxZn3ejdK0XDCqpamfQcFgOyJNUMEolsz9P', '2025-03-04 18:45:52', 'india'),
(6, 'steamuser2', 'ayushsolanki2901+new@gmail.com', '9876543210', 'male', 'Engineering', NULL, '$2y$10$efW8HwjWPBVtEn.wsvHQ6O9WW4waJKFTrmA70fPmFk7kqjmWPEkYC', 'active', '', '2025-03-04 18:47:19', 'india'),
(7, 'ayush.exeaa12', 'ayushsolanki2901+new123@gmail.com', '9876543210', 'male', 'Engineering', NULL, '$2y$10$O8mX9.9TvQTLgj5u52RBRuRy1XDuKfprRYpyVsntxgH4n4qA0Yikq', 'active', '', '2025-03-04 18:52:02', 'india'),
(9, 'ayush.exeaa', 'ayushsolanki2901@gmail.com', '9876543210', 'male', 'Engineering', NULL, '$2y$10$xMLNIgIfvxccZY99ctummeMCndcBtPk0nf1z7m/qLq3ODrWZDUBUa', 'active', '', '2025-03-05 14:00:48', 'kalol'),
(10, 'sheshan', 'aimgodmanagement@gmail.com', '9876543210', 'male', 'Engineering', 'default.png', '$2y$10$W.19ugoBnvgc49SZC9dDHutGzTD36eZz8qAbqe4b4SOCHg5wabCFC', 'active', '', '2025-03-05 16:15:08', 'india'),
(11, 'ayush.exe', 'gisor58437@chodyi.com', '9876543210', 'male', 'Engineering', 'default.png', '$2y$10$4tPIzpcoOHCoM/JgPU.9O.Bv5kUWwgHGzeBcfZZZIx/gck2Gkk9t6', 'inactive', 'A1zbk05SDqQIaM4vl7iTEN63WOGfVoxdh9CRFsyKHPr2UpLBgJuXtwjmZYnce8', '2025-03-05 17:26:31', 'india');

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
-- Indexes for table `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
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

--
-- AUTO_INCREMENT for table `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
