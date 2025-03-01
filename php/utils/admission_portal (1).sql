-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2025 at 07:18 PM
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
(1, '20250227133337_0.JPG', 1),
(2, '20250227133337_1.jpg', 1),
(3, '20250227133337_2.jpg', 1),
(4, '20250227133509_0.jpg', 3),
(5, '20250228155457_0.png', 4),
(6, '20250228155457_1.png', 4),
(7, '20250228155457_2.png', 4),
(8, '20250301080949_0.jpg', 3);

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
  `college_campus` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_name`, `city_name`, `district_name`, `admission_type`, `courseId`, `desciption_of_college`, `university_details`, `admission_process`, `placement_details`, `college_logo`, `college_brochure`, `median_salary`, `avarage_package`, `highest_package`, `finance_type`, `university_name`, `total_Students`, `online_Students`, `ofline_Students`, `tag_id`, `college_campus`) VALUES
(1, 'Kalol Institute of Technology', 'Kalol', 'Gandhinagar', 'Direct Admission', '1', 'IIT Madras B.Tech, BS + MS and B.Tech+M.Tech admission is based on JEE Advanced and JEE Main. The college offers 92 courses at the PG and UG levels. For admission to the MBA registration is open, furthermore, CAT 2025 will be held on November 30, 2025. IIT Madras fees range from Rs 5,000 to Rs 3,00,000 annually.', 'Institute of Technology Madras was established in 1959. As per the QS World University Ranking, IIT Madras bagged the 526th. IIT Madras campus is spread across 630 acres of land and has over 550 faculty, 9700 students and 1250 administrative & supporting staff. IITM courses are spread across 16 academic departments. It offers multiple courses at the undergraduate, postgraduate and doctoral levels. Apart from the regular courses, it also offers an online B.Sc programme. IIT Chennai admissions in all these programmes are done based on entrance exams. UG admissions are done through JEE Advanced, and admission to the MA and M.Tech programmes are done through GATE. Candidates willing to take admission in the MBA and M.Sc programme need to appear for CAT and JAM respectively.', 'IIT Madras Courses and Admissions 2025 IIT Madras has 16 academic departments and a few advanced research centres in various disciplines of pure sciences and engineering. The curriculum of IIT Madras is designed in a way to encourage students to balance both academics and research. Several undergraduate, postgraduate, integrated, and doctoral-level courses are available at IIT Madras. It provides B.Tech and dual degree programmes in twelve different disciplines. The dual degree (BS & MS) in biological sciences and physics is available. MA, M.Sc, M.Tech, and MBA programmes are available at IIT Madras at the postgraduate level. Other IIT Madras courses available at the postgraduate level include the AICTE-sponsored QIP, the EMBA programme, and the web-enabled M.Tech programme. There are also numerous research programmes available, such as the Joint PhD and AICTE QIP. For all the courses, the IITM fees is different.', 'Indian Institute of Technology Madras placement report 2022 is out. The institute has also released the IITM Summer Internship Placement Report 2023 for management courses. IIT Chennai placement cell looks after the overall functioning from inviting recruiters, conducting pre-placement talks to organising the placement drive. The placement cell at Indian Institute of Technology Madras also conducts necessary training and workshops to make the students interview ready. In the IIT Chennai placement drive 2022, 26 companies visited and 61 students registered for placement. The average salary package recorded was Rs 16.66 LPA. In the internship report 2023, the highest stipend recorded was Rs 2,50,000 and the average stipend was Rs 1,12,000. Tabulate below are the IIT Madras placement related highlights for 2022:', '67bf4ac570997_images (2).png', '67bf4ac570999_AYUSH-SOLANKI Resume.pdf', '18K', '1.2 LPA', '1.2 CR', 'Self Finace', 'Gujarat Technology University', '100000', '25564', '74436', '67bf4ac570997', '67c1bcd32bc10_Untitled (1).png'),
(3, 'Kalol Institute of Technology', 'Kalol', 'Gandhinagar', 'ACPC,Direct Admission', '2', 'Indian Institute of Technology Madras placement report 2022 is out. The institute has also released the IITM Summer Internship Placement Report 2023 for management courses. IIT Chennai placement cell looks after the overall functioning from inviting recruiters, conducting pre-placement talks to organising the placement drive. The placement cell at Indian Institute of Technology Madras also conducts necessary training and workshops to make the students interview ready. In the IIT Chennai placement drive 2022, 26 companies visited and 61 students registered for placement. The average salary package recorded was Rs 16.66 LPA. In the internship report 2023, the highest stipend recorded was Rs 2,50,000 and the average stipend was Rs 1,12,000. Tabulate below are the IIT Madras placement related highlights for 2022:', 'Indian Institute of Technology Madras placement report 2022 is out. The institute has also released the IITM Summer Internship Placement Report 2023 for management courses. IIT Chennai placement cell looks after the overall functioning from inviting recruiters, conducting pre-placement talks to organising the placement drive. The placement cell at Indian Institute of Technology Madras also conducts necessary training and workshops to make the students interview ready. In the IIT Chennai placement drive 2022, 26 companies visited and 61 students registered for placement. The average salary package recorded was Rs 16.66 LPA. In the internship report 2023, the highest stipend recorded was Rs 2,50,000 and the average stipend was Rs 1,12,000. Tabulate below are the IIT Madras placement related highlights for 2022:', 'Indian Institute of Technology Madras placement report 2022 is out. The institute has also released the IITM Summer Internship Placement Report 2023 for management courses. IIT Chennai placement cell looks after the overall functioning from inviting recruiters, conducting pre-placement talks to organising the placement drive. The placement cell at Indian Institute of Technology Madras also conducts necessary training and workshops to make the students interview ready. In the IIT Chennai placement drive 2022, 26 companies visited and 61 students registered for placement. The average salary package recorded was Rs 16.66 LPA. In the internship report 2023, the highest stipend recorded was Rs 2,50,000 and the average stipend was Rs 1,12,000. Tabulate below are the IIT Madras placement related highlights for 2022:', 'Indian Institute of Technology Madras placement report 2022 is out. The institute has also released the IITM Summer Internship Placement Report 2023 for management courses. IIT Chennai placement cell looks after the overall functioning from inviting recruiters, conducting pre-placement talks to organising the placement drive. The placement cell at Indian Institute of Technology Madras also conducts necessary training and workshops to make the students interview ready. In the IIT Chennai placement drive 2022, 26 companies visited and 61 students registered for placement. The average salary package recorded was Rs 16.66 LPA. In the internship report 2023, the highest stipend recorded was Rs 2,50,000 and the average stipend was Rs 1,12,000. Tabulate below are the IIT Madras placement related highlights for 2022:', '67bf4ddfbab07_IMG_1384ssss.JPG', '67bf4ddfbab08_AYUSH-SOLANKI Resume.pdf', '18K', '1.2 LPA', '1.2 CR', 'Self Finace', 'Gujarat Technology University', '2342444', '2342344', '100', '67bf4ddfbab06', '67c1bcd32bc10_Untitled (1).png'),
(4, 'Gujarat Technology University ', 'Ahmedabad', 'Gandhinagar', 'ACPC', '2,1', 'Gujarat UniversityGujarat UniversityGujarat UniversityGujarat UniversityGujarat UniversityGujarat UniversityGujarat University', 'Gujarat UniversityGujarat UniversityGujarat UniversityGujarat UniversityGujarat University', 'Gujarat UniversityGujarat UniversityGujarat University', 'Gujarat UniversityGujarat UniversityGujarat University', '67c1bcd32bc0e_Untitled.png', '67c1bcd32bc0f_Untitled.png', '18K', '1.2 LPA', '1.2 CR', 'Self Finace', 'Gujarat Technology University', '234444', '234243', '201', '67c1bcd32bc0c', '67c1bcd32bc10_Untitled (1).png');

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
(1, 'Master Of Computer Applications', 'MCA', '25000', '2 Year', 'Regular', 'CMAT, CAT', 'At Least 60% in Bachelor Degree', 'IT Section', '67bf404411dc0_images.png'),
(2, 'Bachelor of Computer Applications', 'BCA', '13000', '4 Year', 'Regular', 'CMAT, CAT', 'At Least 60% in 12th', 'IT Section', '67bf41702af19_images (1).png');

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
(2, 'Medical '),
(3, 'Physio'),
(4, 'Management'),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
