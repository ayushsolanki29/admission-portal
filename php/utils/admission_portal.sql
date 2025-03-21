-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2025 at 03:46 PM
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
(15, '20250302173851_2.jpg', 6),
(28, '20250310071002_0.jpg', 6),
(29, '20250310071212_0.png', 6),
(30, '20250310071835_0.jpg', 6),
(31, '20250310072035_0.png', 6),
(32, '20250310072401_0.png', 6),
(33, '20250310072600_0.png', 6),
(34, '20250310074013_0.jpg', 7),
(36, '20250310074408_0.jpeg', 7),
(37, '20250310074719_0.jpg', 7),
(38, '20250310075045_0.jpeg', 7),
(39, '20250310075822_0.jpg', 7),
(41, '20250310080402_0.jpg', 10),
(43, '20250310080719_0.png', 10),
(44, '20250310080752_0.jpg', 10),
(45, '20250310081001_0.jpg', 10),
(46, '20250310081226_0.jpeg', 10),
(47, '20250310081508_0.jpeg', 10),
(48, '20250310082014_0.jpg', 11),
(49, '20250310082141_0.jpg', 11),
(50, '20250310082245_0.jpg', 11),
(51, '20250310082354_0.jpg', 11),
(52, '20250310082536_0.png', 11);

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
  `google_map_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `views` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_name`, `city_name`, `district_name`, `admission_type`, `courseId`, `desciption_of_college`, `university_details`, `admission_process`, `placement_details`, `college_logo`, `college_brochure`, `median_salary`, `avarage_package`, `highest_package`, `finance_type`, `university_name`, `total_Students`, `online_Students`, `ofline_Students`, `tag_id`, `college_campus`, `google_map_link`, `views`) VALUES
(6, 'Kalol Institute of Technology', 'Kalol', 'Gandhinagar', 'ACPC,Direct Admission', '3', 'KIRC is a distinguished institution in India, celebrated for its commitment to superior higher education over an impressive span of years. This revered academic institution has cultivated a vast network of over 10,000 professionals worldwide, testament to its excellence in education and impactful alumni. Offering a diverse array of more than undergraduate and postgraduate programs, KIRC is dedicated to blending rigorous academic theory with practical, hands-on experiences. The educational philosophy at KIRC centers around experiential learning, ensuring that students are well-equipped to apply their knowledge in practical settings. This holistic approach is supported by comprehensive internships and mentorship opportunities, providing a rich foundation for both personal and professional development.', 'Gujarat Technological University is a premier academic and research institution which has driven new ways of thinking since its 2007 founding, established by the Government of Gujarat vide Gujarat Act No. 20 of 2007. Today, GTU is an intellectual destination that draws inspired scholars to its campus, keeping GTU at the nexus of ideas that challenge and change the world.', 'Eligibility Criteria\r\nAdmission Coordination is handled by ACPC (Admission Committee for Professional Courses).\r\nEntrance Exam Requirement: Appeared in the Common Management Aptitude Test (CMAT) conducted by AICTE.\r\nCandidates must hold a Bachelors Degree in any discipline (12+3 pattern).', 'The MCA program at KIM employs a dynamic and interactive pedagogy that balances theoretical understanding with practical application. The curriculum is delivered through a mix of lectures, hands-on laboratory sessions, projects, seminars, and workshops, ensuring that students gain comprehensive knowledge and skills. Collaborative projects and case studies encourage teamwork and problem-solving abilities, while internships and industry projects provide real-world exposure. This holistic approach to learning prepares students to successfully navigate and contribute to the technology industry.', '67c497421f45f_images (3).png', '67da6d1995502_AYUSH-SOLANKI Resume.pdf', '18K', '1.2 LPA', '1.2 CR', 'Self Finace', 'Gujarat Technology University', '122222', '22222', '100000', '67c497421f45b', '67c497421fce3_images (4).png', 'https://www.google.com/maps/embed?pb=!4v1740901922819!6m8!1m7!1sCAoSLEFGMVFpcFB0cFkwc3JqU2NNVm1pWFZEamZSa3pObjdWZTczdE5xSTlfd2s0!2m2!1d23.25083808666042!2d72.47860357326454!3f172.5954783024602!4f0!5f0.7820865974627469', '10'),
(7, 'Swaminarayan University', 'Kalol', 'Gandhinagar', 'ACPC,Direct Admission', '8,7,3', 'Swaminarayana University is loacted at Kalol near Ahmedabad, spread over 60 acres of greenery. The college is approved by UGC and Estalished under Gujarat ...', 'Swaminarayana University is loacted at Kalol near Ahmedabad, spread over 60 acres of greenery. The college is approved by UGC and Estalished under Gujarat ...', 'Swaminarayana University is loacted at Kalol near Ahmedabad, spread over 60 acres of greenery. The college is approved by UGC and Estalished under Gujarat ...', 'Swaminarayana University is loacted at Kalol near Ahmedabad, spread over 60 acres of greenery. The college is approved by UGC and Estalished under Gujarat ...', '67cc749806795_Untitled.png', '67cc6e99ac79b_undefined_1712559832227.png', '30K', '4 LPA', '30.5 LPA', 'Self Finace', 'Swaminarayan University', '15000', '5000', '10000', '67cc6e9998544', '67cc7498069d2_images.jpg', 'YES', '10'),
(10, 'Indrashil University', 'Rajpur', 'Kadi', 'ACPC,Direct Admission', '10,9,8,7,6,5,4,3', 'The university has an inviting ambience for academically committed and dedicated staff to nurture the creativity and innovation of young minds.Highly qualified and passionate faculty members with PhDs (100%) and most of them possess postdoctoral fellowships from premier institutions across the globe.\r\nIU observes innovative teaching-learning practices, flexible academic structure amalgamating with internship programs, thesis/dissertation, entrepreneurial projects, and social outreach programmes.\r\nIt prepares graduates who are industry & research-ready with humanity-serving skills & zeal.\r\nProvides a healthy mix of co-curricular & extra-curricular activities, general knowledge, speed typing, writing competency, interview training, Standard Practice Instructions, Community Service etc. for the holistic development of students.', 'Indrashil University is private university located in near the village Rajpur in Mahesana district, Gujarat, India. The university was established in 2017 through the Gujarat Private Universities Act, 2017, which also established P P Savani University, Karnavati University and Swarnim Startup & Innovation University.', 'Step 1: Find out your Eligibility Criteria. ADMISSION ELIGIBILITY - Std. ...\r\nStep 2: Prepare Documents. For all: ...\r\nStep 3: Buy PIN & Booklet. ...\r\nStep 4: Register Online. ...\r\nStep 5: Submit Documents @ Help Centre. ...\r\nStep 6: Finalize your College & Interested Branch. ...\r\nStep 7: Choice Filling. ...\r\nStep 8: Confirm Admission.', 'In 2023, Indrashil University had a 100% placement rate\r\nThe highest package offered in 2023 was INR 45 LPA\r\nTop recruiters in 2023 included Accenture, Infosys, Google, Amazon, Capgemini, IBM, Flipkart, and more\r\nStudents were placed in various sectors, including consulting, BFSI, and FMCG', '67cd306db3f40_IND.jpg', '67cd306db409e_Course Name.jpeg', '35000', '5.1 LPA', '20.5 LPA', 'self Finance', 'Indrashil University', '8000', '5000', '3000', '67cd306db3f3c', '67cd306db45bd_ind 2.jpg', 'https://www.google.com/maps/embed?pb=!4v1741511171139!6m8!1m7!1s3sXymjl6XuZtSfkqsKWP1w!2m2!1d23.33116081781105!2d72.38849483847362!3f319.45222787994857!4f11.666791788027467!5f0.7820865974627469', '6'),
(11, 'Shankersinh Vaghela Bapu Institute of Technology', 'Gandhinagar', 'Gandhinagar', 'ACPC,Direct Admission', '3', 'Shankersinh Vaghela Bapu Institute of Technology (SVBIT) is a private college in Gandhinagar, Gujarat. It offers courses in engineering, pharmacy, science, commerce, nursing, and law.', 'Shankersinh Vaghela Bapu Institute of Technology (SVBIT) was established in the year 2009 with the approval of AICTE and affiliated to Gujarat Technological University (GTU). The college is located at Gandhinagar – Mansa road, about 7 km from Gandhinagar, in a 40 acre lush green campus.', '10th Standard Marks Sheet.\r\n12th Standard Marks Sheet.\r\n12th Standard School Leaving Certificate.\r\n4.Valid GPAT/GATE Scorecard (In case of GATE/PGCET Qualified)\r\nPassport Size Photograph.\r\n6.Bachelor Course Last two semester Marksheet.\r\n7.Bachelor Course Grade History.\r\n8.Undergraduate Course Provisional Eligibility certificate.', 'Some of the companies that have recruited from the institute include Gujarat Vij Company Limited (DGVCL) Ltd., JBM Group Pvt. Ltd., AGC Inc., Tata Power Pvt. Ltd., and Apttus Corporation.', '67cd9f3f2ad64_New-Project-30-1-233x300-1.webp', '67cd9f3f2afb5_Facebook Post 940x788 px (1).png', '35000', '4LPA', '15LPA', 'self Finance', 'GTU', '11000', '6000', '5000', '67cd9f3f2ad61', '67cd9f3f5ece6_BAPU2.jpg', '', '3');

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
(6, 'Rakesh', 'wagihit745@oziere.com', '9876543210', 'Gandhinagar', 'admissions', '', 'hii i want help in college admissions in KIRC. thank you', '2025-03-09 08:55:19');

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
(3, 'Master Of Computer Applications', 'MCA', '50,000', '4 Year', 'Regular', 'CMAT, CAT', 'At Least 60% in Bachelor Degree', 'IT Section', '67cffed2ddefe_mca-banner.jpg'),
(4, 'Bachelor of Engineering/ Technology', 'BE/ B.Tech', '55000', '3 And 4 Year Duration', 'Regular', 'DDCET/GUJCET', 'D TO D & 12TH', 'Engineering', '67cff642b0173_ENG.jpg'),
(5, 'General Nursing and Midwifery', 'GNM', '1,15000', '3year', 'Regular', 'No', '12th', 'Nursing', '67d11fc0e44bc_gnm2.jpg'),
(6, 'Bachelor of Legislative law', 'LLB', '25000', '3year', 'Regular', 'Graduation', 'To be eligible for LLB, you must have graduated from a recognized university with at least 55% aggre', 'Law', '67d1205a862a1_ba-llb-banner.jpg'),
(7, 'Bachelor of Computer Applications', 'BCA', '26000', '4 YEAR', 'Regular', '12th', 'you typically need to have passed your 12th grade examination with a minimum of 50% marks, or equiva', 'Computer Studies', '67d121ebb92f5_bca-1.jpg'),
(8, 'Bachelor of Commaerce and Bachelor of Legislative ', 'B.COM LLB', '70,000', '5 Year', 'Regular', '12th', 'must have completed their 10+2 (or equivalent) from a recognized board and meet the minimum percenta', 'Law', '67d1263396f3e_bba-llb-colleges.jpg'),
(9, 'Bachelor of Pharmacy ', 'B.Pharm / M.pharm', '81,000 to 90,000', '4 YEAR and 2 YEAR', 'Regular', '12th / AFTER B.pharm', 'Completion of 10+2 with Science subjects (Physics, Chemistry, Biology/Mathematics), minimum qualifyi', 'Pharmacy', '67d127d1b8c79_images.jpg'),
(10, 'BACHELOR OF BUSINESS ADMINISTRATION', 'BBA', '32,000', '3 YEARS', 'REGULER', 'NO', '12TH ', 'Management, ', '67d950f824aa8_MBA_Graduate_Lecturer.jpg');

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
(5, 'Engineering'),
(6, 'Medical'),
(7, 'Physiotherapy'),
(8, 'Nursing'),
(9, 'Law'),
(10, 'Computer Studies'),
(12, 'Pharmacy'),
(13, 'Science'),
(14, 'Management, '),
(15, 'M.B.B.S ');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int NOT NULL,
  `course_id` int NOT NULL,
  `college_id` int NOT NULL,
  `fees` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `course_id`, `college_id`, `fees`) VALUES
(136, 3, 6, '8500'),
(137, 3, 7, '5000'),
(138, 7, 7, '5000'),
(139, 8, 7, '5000'),
(140, 3, 10, '6000'),
(141, 4, 10, '1240'),
(142, 5, 10, '555'),
(143, 6, 10, '8900'),
(144, 7, 10, '5600'),
(145, 8, 10, '7000');

-- --------------------------------------------------------

--
-- Table structure for table `inquire`
--

CREATE TABLE `inquire` (
  `id` int NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `course_id` int DEFAULT NULL,
  `college_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inquire`
--

INSERT INTO `inquire` (`id`, `user_id`, `course_id`, `college_id`, `created_at`) VALUES
(11, '21', NULL, 7, '2025-03-10 16:28:10'),
(12, '25', NULL, 6, '2025-03-10 16:31:44'),
(13, '21', NULL, 6, '2025-03-18 10:27:55'),
(14, '19', NULL, 7, '2025-03-19 08:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `message` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'unread',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `url`, `status`, `date`) VALUES
(17, 'Rakesh Just Submited Contact Form', 'contact.php?s=wagihit745@oziere.com', 'read', '2025-03-09 09:55:19'),
(18, 'rana mitesh Just Registered Successfull ', 'users_list.php?s=miteshr987@gmail.com', 'unread', '2025-03-09 11:57:06'),
(19, 'roshni Just Registered Successfull ', 'users_list.php?s=roshnidumater25@gmail.com', 'unread', '2025-03-09 11:59:47'),
(20, 'twinkle rana Just Registered Successfull ', 'users_list.php?s=dumatertwinkle9@gmail.com', 'unread', '2025-03-09 12:02:12'),
(21, 'rana karan Just Registered Successfull ', 'users_list.php?s=mitesh9612@gmail.com', 'unread', '2025-03-10 05:21:07'),
(22, 'kajalrana Just Registered Successfull ', 'users_list.php?s=kajalrana4393@gmail.com', 'unread', '2025-03-10 16:08:25'),
(23, 'rana mitesh Just Applied in Swaminarayan University', 'leads_list.php?s=miteshr987@gmail.com', 'unread', '2025-03-10 16:28:10'),
(24, 'kajalrana Just Applied in Kalol Institute of Technology', 'leads_list.php?s=kajalrana4393@gmail.com', 'unread', '2025-03-10 16:31:44'),
(25, 'rana mitesh Just Applied in Swaminarayan University', 'leads_list.php?s=miteshr987@gmail.com', 'unread', '2025-03-12 15:45:04'),
(26, 'rana mitesh Just Applied in Swaminarayan University', 'leads_list.php?s=miteshr987@gmail.com', 'unread', '2025-03-16 05:42:06'),
(27, 'rana mitesh Just Applied in Kalol Institute of Technology', 'leads_list.php?s=miteshr987@gmail.com', 'unread', '2025-03-18 10:27:55'),
(28, 'rana mitesh Just Applied in Swaminarayan University', 'leads_list.php?s=miteshr987@gmail.com', 'unread', '2025-03-18 10:33:09'),
(29, 'steamuser Just Registered Successfull ', 'users_list.php?s=xovepi2823@doishy.com', 'unread', '2025-03-19 06:11:15'),
(30, 'collegenew.com Just Applied in Swaminarayan University', 'leads_list.php?s=contact@collegenew.com', 'unread', '2025-03-19 08:26:49'),
(31, 'collegenew.com Just Applied in Swaminarayan University', 'leads_list.php?s=contact@collegenew.com', 'unread', '2025-03-19 08:59:42');

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
(6, 10, 'e45afb008bdd298e0ec7cdf8e2c57138abfa1c9cf1a716b186c9b87ae7be4349', '2025-04-04 10:48:40'),
(7, 9, '862e17e6d85db000e3a148ebd34e425397a44a9af0a7b30f3a6148efc702829a', '2025-04-04 12:19:41'),
(8, 9, 'fcb42e56a3d67e558233ec161af3657d33937855b36573cecb675142b5ab39df', '2025-04-05 10:36:02'),
(9, 9, 'b0c477a17082c6059ad8a48be34a9d83d04cf5b8bb07fa981055c97ffd06679d', '2025-04-05 11:18:51'),
(10, 9, '82a89c709c9ec7d32d08295651334c07816ab53b08887d64830d47f6206c10a2', '2025-04-05 11:19:12'),
(11, 9, '8d0d9fcdae00418a2e0d81e855841c3b531f25aadb948a1e9892e80900134a66', '2025-04-05 11:19:21'),
(12, 9, '47db3c50cf24f2a93a03b465a3fc14e63e453291c622e0454ad3889bc9cc37a2', '2025-04-05 11:37:08'),
(13, 9, '9f80ca3a48eb655fea1cb77311852f6cc34d3ece0366dd347ffbc4b04d2cbc95', '2025-04-05 12:10:23'),
(14, 9, 'e1c144dfe947b51926f2553ce0f60b8dc75a5b8bf19aa482e0ba8d91b218d5d8', '2025-04-05 13:05:39'),
(15, 2, '73c44e8175cfc7bab4f040264998680e88f10ecf5a9480a870f1be5c9e8bc71caf838e61a75487d695be', '2025-03-10 05:04:18'),
(16, 2, 'c3517ddc662b856d301fad1aad6ce88ab410557aefe1232609c6dc6e35eb34454d61c0520c8d582446f0', '2025-03-10 05:07:05'),
(17, 2, 'd8d9a42702593459ce3073c531c9ed2d3d4e16b6a060a8012913b16717a6cfdfad9ad33b11b9399d40e4', '2025-03-11 04:02:02'),
(18, 12, 'dfc006bc719f99511fca044a1af31b2248cb2c112226953afbfbbbce5e4ebe6b', '2025-04-07 08:38:17'),
(19, 2, 'bc376302c227f53fa20c91f60de482a6b1e304514a6ce7b020e85fc754d12b62cce170bee1adb39f8c72', '2025-03-11 09:39:21'),
(20, 2, '3b48fd44c504327948bf35722ac7e81c881112e0ff04f3911c25102073ac7879498b91d9237902233f28', '2025-03-11 10:14:47'),
(21, 13, 'a27f0f2ff7ea30a12e24b7d64481a64b2a2880794996c68b48b426d1a14e0018', '2025-04-07 10:22:14'),
(22, 13, '4fd3e3d199150dc77ee882f62affb8d049e51c97c8617a36c1ac01de3ac5110c', '2025-04-07 10:22:55'),
(23, 9, 'ccf2e5840f41c8c8b6e3540582fbef0c6910d58cd5dab006dd3c471b56e4f55e', '2025-04-07 10:27:18'),
(24, 2, 'b637624f7d2d53db774e33aa6ffd21a5825ee2ac29d4023d639aa3caaba7c86d0534a7abbc293e713944', '2025-03-11 11:33:28'),
(25, 2, 'a6d844ea8c37574977f31a9e49bce5b6ae5386fe89d9f97832b6ff6c9fd41a1b0f34a484bfe1ab667836', '2025-03-11 15:48:06'),
(26, 13, '862e0b499318a30671ccc5651096af543a324d81466e500d0e45bfb20f8fa7ee', '2025-04-07 15:14:47'),
(27, 2, 'da109c8b9ce8db94562c57e6a1a58c49d419fa56bdd417260cccfc9faf9156cd4d1f1dc3d76d77394ace', '2025-03-12 03:15:37'),
(28, 13, '2435537a15462ae129d82a3d6fc1aa92814b11ee4fbe1397fd3aa699c6d7126c', '2025-04-08 04:11:20'),
(29, 17, '77b4a589da3e509bfe281a48291c3822ff83c17471737e7937a2beaa0ef1d31c', '2025-04-08 05:44:19'),
(30, 18, '0dc33717c790e4e2aa70e2492e566400aff3034c95c42efdf96e4fb13c028ff7', '2025-04-08 06:16:27'),
(31, 18, 'ab49022f41c6456c96309cd5cfcf844f6645ecf012be844871ba22f96fbc6ce7', '2025-04-08 06:26:53'),
(32, 15, 'f04341f41e94dd57c01913f07e91380819bb9b562d50abf0f197b634359feb86', '2025-04-08 07:00:24'),
(33, 12, 'a19acce2ec0f39bbca4820063ad7bdbc8c09a1f0ef8207d9125080d24891ee16', '2025-04-08 07:04:45'),
(34, 12, '9afc6d88426bf9d4205a912a7098bbdaf814fc7ae404a4e1ddae30757a896903', '2025-04-08 07:04:45'),
(35, 2, 'efca7d5b8a5eed00490c2b66c7aadb86386c647c92e74a4fa14c1a7bd83281255a3b66a135fbbc4227a3', '2025-03-12 08:29:35'),
(36, 2, 'ccbdd3a6634d0d8ff35c1f69911675f285a8ff9f79c05e4b8c2a67537d5b9e92e6979d6a836dc0f8035a', '2025-03-12 08:49:11'),
(37, 21, '11f54ee86670aa25cd51c001edd381f1bfd77102213715b82a591aa36ad33853', '2025-04-08 09:57:30'),
(38, 22, '77a91f3bf84f2e9267cc756708803555688835716dad5844f90aabe9f3337b93', '2025-04-08 10:00:36'),
(39, 22, '49d063b0edb63172af06346c750f770c5e0cb04993e6c07dad8a1aeb0a265c41', '2025-04-08 12:12:00'),
(40, 2, 'b2bd6e46bf21bd47727b7a8112fd9daece117d3cde8816911b22cf99505cc1d5b26f4cc6461c31a30d19', '2025-03-12 17:29:13'),
(41, 23, '3a62e9dba65d6d7df69225a75f8b2a6540c898ed2c55abe11eab4be230c374de', '2025-04-09 03:21:43'),
(42, 22, 'c696cf327a4edda99a44fc98e833158e9cde9ce33561fec0a009a243eb043b43', '2025-04-09 04:51:31'),
(43, 21, '4f404bf1e34fef5fc1345c7bb73f5555b12061d7fa2da38b52de78d76b4513e1', '2025-04-09 04:59:27'),
(44, 21, '32791f712201411d8fbaa61c616d3351dd1a9c961f0468b3443d74ca236bef02', '2025-04-09 05:12:49'),
(45, 21, 'e62d7cddc52d64eaea05d43b3d6a800b39af50aa9313ca17fb305de08818677d', '2025-04-09 05:26:48'),
(46, 25, 'c8550d8e55d6ad4eab171ac49fad8f2cc2e10d8aea7ed08c59ab381628b6d00b', '2025-04-09 14:09:02'),
(47, 21, '96f2c7c9f075c4dcfa7989e9f7f142089fb26d216919950761c6a2ab0e09f764', '2025-04-09 14:23:58'),
(48, 21, '4193ceec3bf48091f519cd51f601caabed1b835b5e6a8929f101b108dee3dbaf', '2025-04-10 06:35:34'),
(49, 21, '91dd8f52f122b8c2cc6b3eafe1c6d666a23337f79f38e0e3887d7465e09034cd', '2025-04-10 06:41:43'),
(50, 25, 'dfdff8bed2ba7f301c323b805c2cd46ce94ed6059a4aaf3390c0f00de86f0180', '2025-04-10 11:10:15'),
(51, 2, '4c83ec0b03eb20a1e368df43e550eac2bb9e2bf5ca378cd55f3568e748c772452cdffcbb98617670e2dd', '2025-03-14 14:50:41'),
(52, 2, 'cccac6c2a946d1378d0238e0040e19d5e439716b96d801f4ec7bcd4ecd1bf105ffdcb4058dac26ce1f74', '2025-03-14 16:03:31'),
(53, 2, 'ef5dc26b50a26e8bed2b230f014610d0594f53e83cbd74b201a2ca01f52ddb1057645bbb24eb1bce5c80', '2025-03-15 04:39:39'),
(54, 2, '0d573ced47757be578fdc772652fb69462c91c48435bd694b1acb667695f8f5c48cec2be60f4ad35dde4', '2025-03-15 04:39:45'),
(55, 22, '5e255707d3a4d32d9dfeb98261df17012c99952ed92619e1b150b2aee14e8815', '2025-04-11 03:57:26'),
(56, 2, '1907c78ca5cab50db1698195adfe5049d2d3508aae1afcf5852ce936e85eefcd0501cc3883f52ae105cf', '2025-03-15 07:01:22'),
(57, 2, '4090fb5f0f560fcb198fc5b2b2f44d86398f10c4f79fe2c82260e393a2b9b9a26c503fb55339075781e6', '2025-03-15 14:33:56'),
(58, 2, '0b20abf369f7f58db2e629cf7ddffd9454308c9665d5d9734d468e2a13bc24759d6593b8224aa5b56846', '2025-03-16 14:25:57'),
(59, 2, '68b36bc25453f5c2aa50b35d3d5e219b1e7f5d143764c1373910450ab16e2a9eeb60e3afb36095c2f7ca', '2025-03-17 05:04:59'),
(60, 2, '6bea2747c985b36972d694e54096a372ce6edff2f5af79e59814fbf382e448494a901a1fa45026f4b0a3', '2025-03-17 07:49:43'),
(61, 2, '2638dcee112b421e8689b0c72e3fc0efc62de8d7688c7eabdc72aa4d65120902d4c0672acddcd089fbe1', '2025-03-17 14:41:07'),
(62, 2, '1ac9cf11db865dcf662f28b6b2524e9a00c35cab8e4ef437ad2e0f35dd5eb06c4a1cd3799ab7032f8ef8', '2025-03-18 04:18:05'),
(63, 2, '41fb7981ce2a0188e5d9842d5fd1641aaa05ab814e06a8781f24142ea3f9645c3a89efafcb976b460ce7', '2025-03-18 07:39:04'),
(64, 2, '810539f8cdea4d9b740c40d59a8fe68812aa4ea7ae56a5d16dc76f454cd6a8d67368038b3c1698aceab9', '2025-03-18 14:38:37'),
(65, 21, '5403744daa941474ebb65e473379779067b0cff4a353ef10bccdf81e1fcdcba9', '2025-04-14 13:45:35'),
(66, 2, '001d942a30cf96f1f55b81890ec2084ccfd9b774a87bbf87e70ee0c8216df2dc395c76a33d5f4f03b28e', '2025-03-19 04:15:39'),
(67, 2, 'f71e8a38bd86c3cec33bc66384f8e1dd3df0342a7444235d50f6263a8c1ea99f42a3518c61135f9c21fa', '2025-03-19 04:24:58'),
(68, 21, '242bc507b05e58274bc0cab8ea13a3d75eb4ffa90398a89b3596f27fd84c9192', '2025-04-15 03:31:51'),
(69, 2, 'f4845a84e97d7f427f45c26b11d55e54a2ad0ced8d6681e51380cc158dc50047a843b125d310f0148ed1', '2025-03-19 04:38:38'),
(70, 2, '72171f5c0bf88dfc4bd4a2e57498d87f125f03d106218e67def2afa5517490a493c6aa24064208f25e25', '2025-03-19 11:48:47'),
(71, 2, '37175f7ba35c0e092d844d25ebc65ab43a230ca8a60ea31c6c4fad93ce4fa9375e67173b60cf2495c03a', '2025-03-20 04:16:33'),
(72, 2, '625ec48204ae50d7252103833dd6bb9ce4b07a935d1ea2a7c18d1780669a0902a7bbe3b981ee06cdfbb5', '2025-03-20 08:11:54'),
(73, 2, '9cc5c0a2b993a21b71cd3f2ffc5eec2f295b888fbe8cede88d9bc1ec38315b5d529dec51c3842a22db8c', '2025-03-20 08:43:06'),
(74, 2, '3df20e6f3770b70d045794fc6609d44ba3de78993159b58a1b22ead98de8792760aecc839a888190e828', '2025-03-20 09:40:42'),
(75, 21, 'a24ce277adaef7f2a4b8cdaebd80d24887eda000ee084ee8efa9fbb26ed9b9a5', '2025-04-17 03:07:36'),
(76, 2, '45c3b96aca7f85c154ac6a0e97c5d49c7b1260cba14857d2cbe4bbd12aee034b78c42572f024bc18477e', '2025-03-21 04:11:17'),
(77, 2, '560cc268c4eb3292e0bdce076027894708c97025ca7954d42a1da5310808a05be3c962ead176f10f8c72', '2025-03-21 05:40:21'),
(78, 2, '6eb4a0de35e462ab925e9fae5b3a56854d073c08071b36e695a8fdb2063c8beb2200fde2fbf435f7c1ec', '2025-03-21 06:56:18'),
(79, 2, '208b6572ad1381cddd0f55f5d1deceea008c8bfc7614be583f647a86134f13e7e53d31c7b57b82a11c15', '2025-03-21 08:31:32'),
(80, 2, 'bfc181a037033597a014e90d96dd8cdc5ae70d55af002e97d96dc2ff2dfc0443d97431dd064e60e8ee0f', '2025-03-21 09:39:46'),
(81, 2, '639f9dd1313c2d5d3aa21ddca6f204f351c045e9cd332c8131c8f0602a3203cbff6b63a3eff3c1e6a21f', '2025-03-22 04:41:34'),
(82, 19, '08b80d8301b5a553fbd47ec37ec6aad6277b9ec3e3dc7da97ebdf3408a86e82a', '2025-04-18 03:48:52'),
(83, 19, 'c6bc22c533a93f347fb7a05493ac9a610b9d4ad9831ea3cf80e9e9c3e17ba7bf', '2025-04-18 03:50:42'),
(84, 2, 'bbecc4e14048053498f57121539a039f8faa941912e05bd06ab7afb02f55765bec41e5fbfc345bfe71d4', '2025-03-22 04:53:06'),
(85, 2, 'a4d389eafe0630f7abf82bcf62e72a139c096a30954127f5120cd176e8b49a23eb75451bcd93d9ace1b4', '2025-03-22 06:06:36'),
(86, 19, 'b49380d35f515648660f3615c885f0b4cb0a0d79ff8fee4666d0c3a0e3d542ab', '2025-04-18 01:46:54'),
(87, 2, 'b69f5a27f852b611a51dbb02c2a11f3d5e9b88ec54506f809269409bb5b1d26281e3ccbd302228bc782d', '2025-03-22 01:47:57'),
(88, 2, '5a79a506613fc6446ebb31afa9ebebdec093ae08dbfe6da691629dfaa9817dfb70421824d68cc2a686a6', '2025-03-22 04:44:59'),
(89, 29, '7e6e516d4c156e8c6f2b7db106471d9b7a2f28f1afc204514e35470f3e81ebcd', '2025-04-18 05:09:29'),
(90, 29, '1cd82c3c60a5e8e35ffc8396958771d872878de16327a3261462e37d81e63328', '2025-04-18 05:10:14'),
(91, 27, '433cc69d9d5b75201681179336b7be816e557503e1002edddb72ccb6e9f102aa', '2025-04-18 05:10:32'),
(92, 27, '69a7089e88878b36ee7ebee2b4416b8d4dcc29441eb82dafbb4ab0c54ce42df9', '2025-04-18 05:11:00'),
(93, 27, 'a2c7e3157f1670fcb64c34362d70a19acb664b07a2233e1ea77505982897d5db', '2025-04-18 05:11:09'),
(94, 27, 'de4e36a0a6daeb2e483ce13e0fbaaf326c7d7e023043989932592cefd8ecf7e9', '2025-04-18 05:19:40'),
(95, 2, '7c0b0aa06150d4e066acc88064c9fcf2aeb907278b51f35750a5e042883b58a2ab3cbb8c8cb58910f4981d1b239bfd2d3f668428c2a76be1aca788c23b9a1db9', '2025-06-18 09:27:11'),
(96, 29, 'b44cd6e3dd545baff02f0df390ade0e08d5c3136b2deefb528570105f08de9f4', '2025-04-20 10:06:26'),
(97, 29, 'cce09ed940ff90a6c53e2b0e7ad3e61663bd79d8032ce02e6aa656e83fed84aa', '2025-04-20 10:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `data0` varchar(200) NOT NULL,
  `data1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `data2` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `data0`, `data1`, `data2`) VALUES
(1, 'views', '1636', ''),
(2, 'credentials', 'admin_Bnvgc49SZC', '$2y$10$wFZrM/T89olAAsCuYeEoouPSw89A/fS5I5hfzzhPz7KUnQRvNONAq'),
(3, 'whatsapp\r\n', '9104647206', ''),
(4, 'youtube', 'https://www.youtube.com/embed/aF-sOuKfSKk?si=_4V0z-vZ763RStpg', '');

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
(19, 'collegenew.com', 'contact@collegenew.com', '7984289940', 'male', 'IT Section', 'default.png', '$2y$10$wFZrM/T89olAAsCuYeEoouPSw89A/fS5I5hfzzhPz7KUnQRvNONAq', 'active', '', '2025-03-09 09:46:42', 'Kalol'),
(20, 'twinkle rana', 'dumatertwinkle9@gmail.com', '9157743468', 'female', 'Physio', 'default.png', '$2y$10$FaOr5fXjRZgjXa2sn4dND.NPnVpXALJlaeaK7UXC0.BFn1G.pk.w2', 'active', '', '2025-03-09 11:37:08', 'mehsana'),
(21, 'rana mitesh', 'miteshr987@gmail.com', '9104647206', 'male', 'Engineering', 'default.png', '$2y$10$1bAaGgaTBVgkWTHx8q3OLeDdD.jeV0QEr73z52RN74cvdOJ5aHA7K', 'active', '', '2025-03-09 11:46:43', 'mehsana'),
(22, 'roshni', 'roshnidumater25@gmail.com', '7874744004', 'female', 'IT Section', 'default.png', '$2y$10$lqsyz6ydc7a6VmsCroUn2.SGyZSKs9.r13cVodiE2mJx4lZemgSLG', 'active', '', '2025-03-09 11:53:06', 'ahmedabad'),
(23, 'rana karan', 'mitesh9612@gmail.com', '9510903051', 'male', 'Engineering', 'default.png', '$2y$10$fKP7pgIKw7c3aBh6a6jOfeVjmjBMYXAUHn.fE.0nIvn3K9fte6JyC', 'active', '', '2025-03-10 05:16:44', 'mehsana'),
(24, 'Jadav Dharmesh ', 'jadavdharmendra341@gmail.com', '7984289940', 'male', 'Engineering', 'default.png', '$2y$10$NxS7EaXkq1FLBEKzCwo/JuRHLypxUoV65Y0TQazhI2H86.6hBjib2', 'active', '', '2025-03-10 05:44:51', 'Ahmedabad '),
(25, 'kajalrana', 'kajalrana4393@gmail.com', '9157333066', 'female', 'Computer Studies', 'default.png', '$2y$10$aEONLuqTBIfILSLH/J2c8Oc3qA5oQkJotBDS0iRnobooAVmzbhyCW', 'active', '', '2025-03-10 16:04:04', 'Ahmedabad '),
(26, 'Vipul', 'talkabhai@gmail.com', '7096701669', 'male', 'Law', 'default.png', '$2y$10$gIuQq82LIYuUfhcQ.vRHdeImWehqVqDCCuHOFzNRNYaAwV8SjtXE6', 'active', '', '2025-03-11 05:41:42', 'Patan'),
(27, 'steamuser', 'xovepi2823@doishy.com', '9876543210', 'male', 'Pharmacy', 'default.png', '$2y$10$3s.WlFa4s4hHWRJ83dO8Fu1Vc8arPNmGQZAf2QqmV05M11gdf379y', 'active', '', '2025-03-19 06:10:36', 'Gandhinagar'),
(29, 'admin', 'ayushsolanki2901@gmail.com', '9876543210', 'male', 'Management, ', 'default.png', '$2y$10$mICUxRONE.efudkF8ivW3.oEG6J48pqL4J5D0etHKhYn2yG2KsGyS', 'active', NULL, '2025-03-19 10:16:50', 'Gandhinagar');

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
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquire`
--
ALTER TABLE `inquire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `inquire`
--
ALTER TABLE `inquire`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
