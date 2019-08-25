-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2019 at 01:12 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ope_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `applicant_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `home_address` varchar(500) NOT NULL,
  `birthdate` date NOT NULL,
  `course` varchar(100) NOT NULL,
  `school` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `is_sent_email` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`applicant_id`, `first_name`, `middle_name`, `last_name`, `home_address`, `birthdate`, `course`, `school`, `position`, `contact_no`, `is_sent_email`) VALUES
(21, 'Emilio Abadicio', 'Garcia', 'Santos', '402-B Guava St., Quezon City', '1962-12-20', 'BSABC', 'BBS Informatics', 'FGK', '', b'0'),
(22, 'Don Carlo', 'Alab', 'Korano', 'Pasig City, Metro Manila', '1985-05-22', 'BS DEF', 'PUP', 'BBB Assistant', '', b'0'),
(23, 'Chrysanthemum', 'Chua', 'Rodriguez', 'Blk. 4 Lot 8 Hyacinth St., Estrella, Pasig City', '1970-01-29', 'BA JKL', 'Rizal Technological University', 'HR', '09228485999', b'0'),
(24, 'Albert Galileo', 'Bordo', 'Hipolito', '402 Kamias St., Brgy. Malaya, Makati City', '1992-04-12', 'BS FHJ', 'University of the Philippines - Diliman', 'HYY Specialist', '', b'0'),
(25, 'Roberta Ramona', 'Rocapor', 'Regalado', 'Novaliches, Q.C.', '1973-12-25', 'BA HUFC', 'OPP College', 'GB Assistant', '', b'0'),
(26, 'Marco', 'Andres', 'Benson', 'Taguig', '1986-06-12', 'BS JJJ', 'CLDC College', 'MMV', '09278475940', b'0'),
(27, 'Cecilia', '', 'Quinse', 'Makati', '1983-11-30', 'BS MNL', 'SciTech College', 'BS Specialist', '', b'0'),
(28, 'John', 'Marcelo', 'Pinale', 'BGC, Taguig City', '2000-07-16', 'BS Information Technology', 'College of Hard Knocks', 'Software Engineer', '09191234567', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category` varchar(100) NOT NULL,
  `category_no` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `no_items` int(11) NOT NULL,
  `passing_score` int(11) NOT NULL,
  `instructions` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category`, `category_no`, `time_limit`, `no_items`, `passing_score`, `instructions`) VALUES
('Aptitude', 2, 200, 10, 7, '<p>Shank tongue pig fatback, hamburger tenderloin beef ribs kielbasa shoulder sirloin bacon frankfurter meatloaf. Tail porchetta jerky leberkas shoulder frankfurter tri-tip cow, flank pig andouille. Beef ribs t-bone ham hock pastrami, rump kevin pork loin biltong fatback. Frankfurter t-bone tongue ham hock meatloaf tri-tip drumstick pork, brisket pancetta kielbasa shank. Rump t-bone beef ribs, chicken ball tip landjaeger fatback pork belly corned beef prosciutto pork loin sausage. Ground round t-bone doner swine venison pork belly ham bresaola meatloaf tongue. Leberkas strip steak corned beef pork chop shank. Test bacon</p>'),
('Engineering', 4, 200, 5, 3, '<p>Engineering shank tongue pig fatback, hamburger tenderloin beef ribs kielbasa shoulder sirloin bacon frankfurter meatloaf. Tail porchetta jerky leberkas shoulder frankfurter tri-tip cow, flank pig andouille. Beef ribs t-bone ham hock pastrami, rump kevin pork loin biltong fatback. Frankfurter t-bone tongue ham hock meatloaf tri-tip drumstick pork, brisket pancetta kielbasa shank. Rump t-bone beef ribs, chicken ball tip landjaeger fatback pork belly corned beef prosciutto pork loin sausage. Ground round t-bone doner swine venison pork belly ham bresaola meatloaf tongue. Leberkas strip steak corned beef pork chop shank.</p>'),
('Intelligence', 1, 300, 5, 3, '<p><strong>Jowl drumstick beef ribs brisket pork loin short loin pancetta salami boudin sausage ground round strip steak fatback short ribs. Venison landjaeger andouille frankfurter boudin, sirloin pork belly jerky prosciutto hamburger flank turducken filet mignon ham. Landjaeger porchetta pork belly pork t-bone salami, meatloaf biltong filet mignon brisket. Fatback t-bone brisket kevin sirloin, biltong corned beef. </strong></p>\r\n<p><strong>Shank bacon salami, rump beef ribs andouille chicken sirloin pork chop pork loin. Leberkas pancetta porchetta shankle venison corned beef ribeye doner hamburger drumstick. Porchetta andouille t-bone brisket kevin tail, pancetta turducken filet mignon short loin ribeye bacon chuck bresaola. Shankle tail boudin meatloaf bresaola ball tip salami. Capicola turkey flank hamburger ham hock fatback pork loin prosciutto sirloin swine leberkas sausage corned beef andouille beef ribs. </strong></p>\r\n<p><strong>Bacon turducken andouille, turkey venison biltong drumstick beef ribs landjaeger. Pork loin shank rump</strong></p>'),
('Personality', 3, 100, 5, 3, '<p>Personality shank tongue pig fatback, hamburger tenderloin beef ribs kielbasa shoulder sirloin bacon frankfurter meatloaf. Tail porchetta jerky leberkas shoulder frankfurter tri-tip cow, flank pig andouille. Beef ribs t-bone ham hock pastrami, rump kevin pork loin biltong fatback. Frankfurter t-bone tongue ham hock meatloaf tri-tip drumstick pork, brisket pancetta kielbasa shank. Rump t-bone beef ribs, chicken ball tip landjaeger fatback pork belly corned beef prosciutto pork loin sausage. Ground round t-bone doner swine venison pork belly ham bresaola meatloaf tongue. Leberkas strip steak corned beef pork chop shank.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `classifications`
--

CREATE TABLE `classifications` (
  `classification` varchar(45) NOT NULL,
  `percentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classifications`
--

INSERT INTO `classifications` (`classification`, `percentage`) VALUES
('Above Average', 75),
('Average', 40),
('Below Average', 10),
('High Average', 60),
('Low', 4),
('Low Average', 24),
('Superior', 90),
('Very Low', 0),
('Very Superior', 97);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `applicant_id`, `created_on`, `type`) VALUES
(45, 21, '2014-03-27 09:58:38', 'ENG'),
(46, 22, '2014-03-27 10:01:04', 'MPT'),
(47, 23, '2014-03-27 10:02:45', 'RNF'),
(48, 24, '2014-03-27 10:04:24', 'ENG'),
(49, 25, '2014-03-27 10:15:27', 'RNF'),
(50, 26, '2014-03-27 10:18:27', 'RNF'),
(51, 27, '2014-04-01 13:36:23', 'MPT'),
(52, 28, '2019-08-09 18:38:16', 'ENG');

-- --------------------------------------------------------

--
-- Table structure for table `exams_answers_options`
--

CREATE TABLE `exams_answers_options` (
  `item_id` int(11) NOT NULL,
  `option` varchar(250) NOT NULL,
  `score` int(11) NOT NULL,
  `is_answer` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams_answers_options`
--

INSERT INTO `exams_answers_options` (`item_id`, `option`, `score`, `is_answer`) VALUES
(1, 'False', 1, b'1'),
(1, 'True', 0, b'0'),
(2, '25', 1, b'1'),
(3, 'False', 0, b'0'),
(3, 'True', 1, b'1'),
(4, '<p>cactus - cacti</p>', 1, b'0'),
(4, '<p>furniture - furnitures</p>', -1, b'0'),
(4, '<p>goose - gooses</p>', -1, b'0'),
(4, '<p>mouse - mice</p>', 1, b'1'),
(4, '<p>ox - oxes</p>', -1, b'0'),
(5, 'False', 0, b'1'),
(5, 'True', 1, b'0'),
(6, '<p>1</p>', 0, b'0'),
(6, '<p>2</p>', 0, b'0'),
(6, '<p>3</p>', 1, b'0'),
(6, '<p>4</p>', 0, b'1'),
(7, '', 0, b'1'),
(7, '12', 1, b'0'),
(8, '<p>13</p>', 0, b'0'),
(8, '<p>4</p>', 1, b'0'),
(8, '<p>7</p>', 0, b'0'),
(8, '<p>9</p>', 0, b'1'),
(9, 'False', 0, b'0'),
(9, 'True', 1, b'1'),
(10, '', 0, b'1'),
(10, '634', 1, b'0'),
(11, '', 0, b'1'),
(11, '54', 1, b'0'),
(12, '<p>1</p>', 0, b'0'),
(12, '<p>2</p>', 0, b'0'),
(12, '<p>3</p>', 0, b'0'),
(12, '<p>4</p>', 1, b'1'),
(13, '', 0, b'1'),
(13, '27', 1, b'0'),
(14, '<p>108 min.</p>', 0, b'0'),
(14, '<p>144 min.</p>', 1, b'1'),
(14, '<p>192 min.</p>', 0, b'0'),
(14, '<p>81 min.</p>', 0, b'0'),
(15, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C1.JPG\" alt=\"Q4 C1\" /></p>', 0, b'0'),
(15, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C2.JPG\" alt=\"Q4 C2\" /></p>', 0, b'0'),
(15, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C3.JPG\" alt=\"Q4 C3\" /></p>', 0, b'0'),
(15, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C4.JPG\" alt=\"Q4 C4\" /></p>', 1, b'1'),
(16, '', 0, b'1'),
(16, '27', 1, b'0'),
(17, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C1.JPG\" alt=\"Q4 C1\" /></p>', 0, b'0'),
(17, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C2.JPG\" alt=\"Q4 C2\" /></p>', 0, b'0'),
(17, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C3.JPG\" alt=\"Q4 C3\" /></p>', 0, b'0'),
(17, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C4.JPG\" alt=\"Q4 C4\" /></p>', 1, b'1'),
(18, '<p>1</p>', 0, b'0'),
(18, '<p>2</p>', 0, b'0'),
(18, '<p>3</p>', 1, b'1'),
(18, '<p>4</p>', 0, b'0'),
(19, '', 0, b'1'),
(19, '12', 1, b'0'),
(20, '<p>1</p>', 0, b'0'),
(20, '<p>2</p>', 0, b'0'),
(20, '<p>3</p>', 0, b'0'),
(20, '<p>4</p>', 1, b'1'),
(21, 'False', 0, b'0'),
(21, 'True', 1, b'1'),
(22, 'False', 1, b'1'),
(22, 'True', 0, b'0'),
(23, '<p>10</p>', 0, b'0'),
(23, '<p>4</p>', 0, b'0'),
(23, '<p>5</p>', 1, b'1'),
(23, '<p>6</p>', 0, b'0'),
(24, '<p>13</p>', 0, b'0'),
(24, '<p>4</p>', 1, b'1'),
(24, '<p>7</p>', 0, b'0'),
(24, '<p>9</p>', 0, b'0'),
(25, 'False', 0, b'1'),
(25, 'True', 1, b'0'),
(26, '<p>break - broken</p>', -1, b'0'),
(26, '<p>buy - bought</p>', 1, b'1'),
(26, '<p>cut - cutted</p>', -1, b'0'),
(26, '<p>lie - lie</p>', -1, b'0'),
(27, 'False', 0, b'0'),
(27, 'True', 1, b'1'),
(28, 'False', 0, b'0'),
(28, 'True', 1, b'1'),
(29, '', 0, b'1'),
(29, '25', 1, b'0'),
(30, '', 0, b'1'),
(30, '36', 1, b'0'),
(31, '', 0, b'1'),
(31, '47', 1, b'0'),
(32, 'False', 1, b'1'),
(32, 'True', 0, b'0'),
(33, '<p>cactus - cacti</p>', 1, b'1'),
(33, '<p>furniture - furnitures</p>', -1, b'0'),
(33, '<p>goose - gooses</p>', -1, b'0'),
(33, '<p>mouse - mice</p>', 1, b'1'),
(33, '<p>ox - oxes</p>', -1, b'0'),
(34, '<p>Artist: : Tailor Brush</p>', 0, b'0'),
(34, '<p>Needle</p>', 0, b'0'),
(34, '<p>Painter</p>', 1, b'0'),
(34, '<p>Teacher : Canvas : Class</p>', 0, b'1'),
(35, '<p>Feathers</p>', 0, b'0'),
(35, '<p>Fur</p>', 1, b'0'),
(35, '<p>Leaves</p>', 0, b'0'),
(35, '<p>Skin</p>', 0, b'1'),
(36, '<p>cactus - cacti</p>', 1, b'1'),
(36, '<p>furniture - furnitures</p>', -1, b'0'),
(36, '<p>goose - gooses</p>', -1, b'0'),
(36, '<p>mouse - mice</p>', 1, b'1'),
(36, '<p>ox - oxes</p>', -1, b'0'),
(37, 'False', 1, b'1'),
(37, 'True', 0, b'0'),
(38, '', 0, b'1'),
(38, '288', 1, b'0'),
(39, 'False', 1, b'1'),
(39, 'True', 0, b'0'),
(40, '<p>Alligator</p>', -1, b'0'),
(40, '<p>Cat</p>', 1, b'1'),
(40, '<p>Elephant</p>', 1, b'0'),
(40, '<p>Snake</p>', -1, b'0'),
(41, '<p>108 min.</p>', 0, b'0'),
(41, '<p>144 min.</p>', 1, b'1'),
(41, '<p>192 min.</p>', 0, b'0'),
(41, '<p>81 min.</p>', 0, b'0'),
(42, '<p>1</p>', 0, b'0'),
(42, '<p>2</p>', 0, b'0'),
(42, '<p>3</p>', 0, b'0'),
(42, '<p>4</p>', 1, b'1'),
(43, '', 0, b'1'),
(43, '12', 1, b'0'),
(44, 'False', 0, b'0'),
(44, 'True', 1, b'1'),
(45, '', 0, b'1'),
(45, '634', 1, b'0'),
(46, 'False', 1, b'1'),
(46, 'True', 0, b'0'),
(47, '54', 1, b'1'),
(48, 'False', 0, b'0'),
(48, 'True', 1, b'1'),
(49, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C1.JPG\" alt=\"Q4 C1\" /></p>', 0, b'0'),
(49, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C2.JPG\" alt=\"Q4 C2\" /></p>', 0, b'0'),
(49, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C3.JPG\" alt=\"Q4 C3\" /></p>', 0, b'0'),
(49, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C4.JPG\" alt=\"Q4 C4\" /></p>', 1, b'1'),
(50, '27', 1, b'1'),
(51, '<p>128 bits</p>', 1, b'1'),
(51, '<p>128 bytes</p>', 0, b'0'),
(51, '<p>32 bits</p>', 0, b'0'),
(51, '<p>64 bits</p>', 0, b'0'),
(52, '<p>config mem</p>', 0, b'0'),
(52, '<p>copy running backup</p>', 0, b'0'),
(52, '<p>copy running-config startup-config</p>', 1, b'1'),
(52, '<p>wr mem</p>', 0, b'0'),
(53, '<p>FTP</p>', 1, b'0'),
(53, '<p>JSP</p>', -1, b'0'),
(53, '<p>PHP</p>', -1, b'0'),
(53, '<p>SMTP</p>', 1, b'1'),
(54, '<p>A</p>', 0, b'0'),
(54, '<p>B</p>', 0, b'0'),
(54, '<p>G</p>', 1, b'1'),
(54, '<p>N</p>', 0, b'0'),
(55, 'False', 1, b'1'),
(55, 'True', 0, b'0'),
(56, 'False', 0, b'0'),
(56, 'True', 1, b'1'),
(57, 'False', 1, b'1'),
(57, 'True', 0, b'0'),
(58, 'False', 0, b'0'),
(58, 'True', 1, b'1'),
(59, 'False', 0, b'0'),
(59, 'True', 1, b'1'),
(60, 'False', 0, b'1'),
(60, 'True', 1, b'0'),
(61, '47', 1, b'1'),
(62, '<p>Alligator</p>', -1, b'0'),
(62, '<p>Cat</p>', 1, b'1'),
(62, '<p>Elephant</p>', 1, b'0'),
(62, '<p>Snake</p>', -1, b'0'),
(63, '', 0, b'1'),
(63, '288', 1, b'0'),
(64, '<p>314</p>', 0, b'0'),
(64, '<p>431</p>', 0, b'0'),
(64, '<p>531</p>', 1, b'0'),
(64, '<p>532</p>', 0, b'0'),
(65, '', 0, b'1'),
(65, '5', 1, b'0'),
(66, 'False', 1, b'1'),
(66, 'True', 0, b'0'),
(67, 'False', 1, b'1'),
(67, 'True', 0, b'0'),
(68, '<p>Carbon</p>', 1, b'1'),
(68, '<p>Diamond</p>', -1, b'0'),
(68, '<p>Nitrogen</p>', 1, b'0'),
(68, '<p>Oxygen</p>', 1, b'0'),
(68, '<p>Sucrose</p>', -1, b'0'),
(69, '<p>0.1</p>', -1, b'0'),
(69, '<p>25</p>', 1, b'0'),
(69, '<p>30.6</p>', -1, b'0'),
(70, 'False', 0, b'0'),
(70, 'True', 1, b'0'),
(71, 'False', 1, b'1'),
(71, 'True', 0, b'0'),
(72, 'False', 0, b'1'),
(72, 'True', 1, b'0'),
(73, '<p>108 min.</p>', 0, b'0'),
(73, '<p>144 min.</p>', 1, b'1'),
(73, '<p>192 min.</p>', 0, b'0'),
(73, '<p>81 min.</p>', 0, b'0'),
(74, '<p>13</p>', 0, b'0'),
(74, '<p>4</p>', 1, b'1'),
(74, '<p>7</p>', 0, b'0'),
(74, '<p>9</p>', 0, b'0'),
(75, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C1.JPG\" alt=\"Q5 C1\" /></p>', 0, b'0'),
(75, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C2.JPG\" alt=\"Q5 C2\" /></p>', 0, b'0'),
(75, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C3.JPG\" alt=\"Q5 C3\" /></p>', 1, b'1'),
(75, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C4.JPG\" alt=\"Q5 C4\" /></p>', 0, b'0'),
(76, 'False', 0, b'0'),
(76, 'True', 1, b'1'),
(77, '', 0, b'1'),
(77, '12', 1, b'0'),
(78, '<p>10</p>', 0, b'0'),
(78, '<p>4</p>', 0, b'0'),
(78, '<p>5</p>', 1, b'1'),
(78, '<p>6</p>', 0, b'0'),
(79, '<p>1</p>', 0, b'0'),
(79, '<p>2</p>', 0, b'0'),
(79, '<p>3</p>', 1, b'1'),
(79, '<p>4</p>', 0, b'0'),
(80, '', 0, b'1'),
(80, '54', 1, b'0'),
(81, 'False', 0, b'0'),
(81, 'True', 1, b'1'),
(82, 'False', 0, b'1'),
(82, 'True', 1, b'0'),
(83, 'False', 0, b'1'),
(83, 'True', 1, b'0'),
(84, 'False', 1, b'0'),
(84, 'True', 0, b'1'),
(85, 'False', 1, b'0'),
(85, 'True', 0, b'0'),
(86, '<p>1</p>', 0, b'0'),
(86, '<p>2</p>', 0, b'0'),
(86, '<p>3</p>', 0, b'0'),
(86, '<p>4</p>', 1, b'1'),
(87, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C1.JPG\" alt=\"Q4 C1\" /></p>', 0, b'0'),
(87, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C2.JPG\" alt=\"Q4 C2\" /></p>', 0, b'0'),
(87, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C3.JPG\" alt=\"Q4 C3\" /></p>', 0, b'0'),
(87, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C4.JPG\" alt=\"Q4 C4\" /></p>', 1, b'1'),
(88, '<p>1</p>', 1, b'1'),
(88, '<p>2</p>', 0, b'0'),
(88, '<p>3</p>', 0, b'0'),
(88, '<p>4</p>', 0, b'0'),
(89, '', 0, b'1'),
(89, '27', 1, b'0'),
(90, 'False', 0, b'0'),
(90, 'True', 1, b'1'),
(91, '', 0, b'1'),
(91, '12', 1, b'0'),
(92, 'False', 0, b'0'),
(92, 'True', 1, b'1'),
(93, 'False', 1, b'1'),
(93, 'True', 0, b'0'),
(94, '<p>13</p>', 0, b'0'),
(94, '<p>4</p>', 1, b'1'),
(94, '<p>7</p>', 0, b'0'),
(94, '<p>9</p>', 0, b'0'),
(95, '<p>10</p>', 0, b'0'),
(95, '<p>4</p>', 0, b'0'),
(95, '<p>5</p>', 1, b'0'),
(95, '<p>6</p>', 0, b'0'),
(96, 'False', 1, b'0'),
(96, 'True', 0, b'1'),
(97, '', 0, b'1'),
(97, '25', 1, b'0'),
(98, '<p>Alligator</p>', -1, b'0'),
(98, '<p>Cat</p>', 1, b'0'),
(98, '<p>Elephant</p>', 1, b'0'),
(98, '<p>Snake</p>', -1, b'0'),
(99, '<p>1</p>', 0, b'0'),
(99, '<p>25</p>', 0, b'0'),
(99, '<p>50</p>', 1, b'1'),
(99, '<p>81</p>', 0, b'0'),
(100, '<p>FMSYE</p>', 0, b'0'),
(100, '<p>FMYES</p>', 0, b'0'),
(100, '<p>GMSYE</p>', 1, b'0'),
(100, '<p>GNSYD</p>', 0, b'0'),
(101, 'False', 0, b'0'),
(101, 'True', 1, b'1'),
(102, '<p>cactus - cacti</p>', 1, b'1'),
(102, '<p>furniture - furnitures</p>', -1, b'0'),
(102, '<p>goose - gooses</p>', -1, b'0'),
(102, '<p>mouse - mice</p>', 1, b'1'),
(102, '<p>ox - oxes</p>', -1, b'0'),
(103, '5', 1, b'1'),
(104, '276', 0, b'1'),
(104, '288', 1, b'0'),
(105, 'False', 0, b'1'),
(105, 'True', 1, b'0'),
(106, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C1.JPG\" alt=\"Q5 C1\" /></p>', 0, b'0'),
(106, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C2.JPG\" alt=\"Q5 C2\" /></p>', 0, b'0'),
(106, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C3.JPG\" alt=\"Q5 C3\" /></p>', 1, b'0'),
(106, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C4.JPG\" alt=\"Q5 C4\" /></p>', 0, b'1'),
(107, 'False', 1, b'1'),
(107, 'True', 0, b'0'),
(108, '<p>108 min.</p>', 0, b'0'),
(108, '<p>144 min.</p>', 1, b'1'),
(108, '<p>192 min.</p>', 0, b'0'),
(108, '<p>81 min.</p>', 0, b'0'),
(109, '27', 1, b'0'),
(109, '28', 0, b'1'),
(110, 'False', 0, b'0'),
(110, 'True', 1, b'1'),
(111, '12', 1, b'1'),
(112, '<p>1</p>', 0, b'0'),
(112, '<p>2</p>', 0, b'0'),
(112, '<p>3</p>', 1, b'1'),
(112, '<p>4</p>', 0, b'0'),
(113, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C1.JPG\" alt=\"Q4 C1\" /></p>', 0, b'0'),
(113, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C2.JPG\" alt=\"Q4 C2\" /></p>', 0, b'0'),
(113, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C3.JPG\" alt=\"Q4 C3\" /></p>', 0, b'0'),
(113, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C4.JPG\" alt=\"Q4 C4\" /></p>', 1, b'1'),
(114, '<p>1</p>', 0, b'0'),
(114, '<p>2</p>', 0, b'1'),
(114, '<p>3</p>', 0, b'0'),
(114, '<p>4</p>', 1, b'0'),
(115, '<p>10</p>', 0, b'0'),
(115, '<p>4</p>', 0, b'0'),
(115, '<p>5</p>', 1, b'1'),
(115, '<p>6</p>', 0, b'0'),
(116, '<p>date link layer</p>', 1, b'0'),
(116, '<p>logic layer</p>', -1, b'0'),
(116, '<p>physical layer</p>', 1, b'1'),
(116, '<p>transfer layer</p>', -1, b'0'),
(116, '<p>visual layer</p>', -1, b'0'),
(117, 'False', 1, b'1'),
(117, 'True', 0, b'0'),
(118, '<p>config mem</p>', 0, b'0'),
(118, '<p>copy running backup</p>', 0, b'0'),
(118, '<p>copy running-config startup-config</p>', 1, b'1'),
(118, '<p>wr mem</p>', 0, b'0'),
(119, '<p>1 Mbps</p>', 0, b'0'),
(119, '<p>10 Mbps</p>', 1, b'0'),
(119, '<p>100 kbps</p>', 0, b'1'),
(119, '<p>2 Mbps</p>', 0, b'0'),
(120, 'False', 1, b'1'),
(120, 'True', 0, b'0'),
(121, 'False', 0, b'0'),
(121, 'True', 1, b'1'),
(122, 'False', 0, b'0'),
(122, 'True', 1, b'1'),
(123, 'False', 1, b'1'),
(123, 'True', 0, b'0'),
(124, 'False', 0, b'1'),
(124, 'True', 1, b'0'),
(125, 'False', 0, b'1'),
(125, 'True', 1, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `exams_answers_questions`
--

CREATE TABLE `exams_answers_questions` (
  `item_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `category` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams_answers_questions`
--

INSERT INTO `exams_answers_questions` (`item_id`, `exam_id`, `question`, `category`, `type`) VALUES
(1, 45, '<p>If the letters in the word LITTORAL are rearranged, they can spell a word relating to a well known art form.</p>', 'Intelligence', 'True or False'),
(2, 45, '<p>37, 34, 31, 28</p>', 'Intelligence', 'Fill in the Blanks'),
(3, 45, '<p>At the end of a banquet 10 people shake hands with each other. The total number of handshakes will be 45.</p>', 'Intelligence', 'True or False'),
(4, 45, '<p>Which of the following plural forms are correct? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(5, 45, '<p>The day before the day before yesterday is three days after Saturday. Therefore, today is Friday.</p>', 'Intelligence', 'True or False'),
(6, 45, '<p>Find out which of the figures (1), (2), (3) and (4) can be formed from the pieces given in figure (X).</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q2 A3.JPG\" alt=\"Q2 A3\" /></p>', 'Aptitude', 'Multiple Choice'),
(7, 45, '<p>3 pumps, working 8 hours a day, can empty a tank in 2 days. How many hours a day must 4 pumps work to empty the tank in 1 day?</p>', 'Aptitude', 'Fill in the Blanks'),
(8, 45, '<p>Find the greatest number that will divide 43, 91 and 183 so as to leave the same remainder in each case.</p>', 'Aptitude', 'Multiple Choice'),
(9, 45, '<p>A man buys a watch for Rs. 1950 in cash and sells it for Rs. 2200 at a credit of 1 year. If the rate of interest is 10% per annum, the man gains Rs. 50.</p>', 'Aptitude', 'True or False'),
(10, 45, '<p>Find out the wrong number in the given sequence of numbers: 582, 605, 588, 611, 634, 617, 600</p>', 'Aptitude', 'Fill in the Blanks'),
(11, 45, '<p>Find the odd man out: 10, 25, 45, 54, 60, 75, 80</p>', 'Aptitude', 'Fill in the Blanks'),
(12, 45, '<p>Find out how will the key figure (X) look like after rotation.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q3 A4.JPG\" alt=\"Q3 A4\" /></p>', 'Aptitude', 'Multiple Choice'),
(13, 45, '<p>Insert the missing number: 8, 24, 12, 36, 18, 54, ?</p>', 'Aptitude', 'Fill in the Blanks'),
(14, 45, '<p>One pipe can fill a tank three times as fast as another pipe. If together the two pipes can fill the tank in 36 minutes, then the slower pipe alone will be able to fill the tank in:</p>', 'Aptitude', 'Multiple Choice'),
(15, 45, '<p>Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 Question.JPG\" alt=\"Q4 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(16, 46, '<p>Insert the missing number: 8, 24, 12, 36, 18, 54, ?</p>', 'Aptitude', 'Fill in the Blanks'),
(17, 46, '<p>Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 Question.JPG\" alt=\"Q4 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(18, 46, '<p>Find out which of the figures (1), (2), (3) and (4) can be formed from the pieces given in figure (X).</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q2 A3.JPG\" alt=\"Q2 A3\" /></p>', 'Aptitude', 'Multiple Choice'),
(19, 46, '<p>3 pumps, working 8 hours a day, can empty a tank in 2 days. How many hours a day must 4 pumps work to empty the tank in 1 day?</p>', 'Aptitude', 'Fill in the Blanks'),
(20, 46, '<p>Find out how will the key figure (X) look like after rotation.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q3 A4.JPG\" alt=\"Q3 A4\" /></p>', 'Aptitude', 'Multiple Choice'),
(21, 46, '<p>A man buys a watch for Rs. 1950 in cash and sells it for Rs. 2200 at a credit of 1 year. If the rate of interest is 10% per annum, the man gains Rs. 50.</p>', 'Aptitude', 'True or False'),
(22, 46, '<p>If gear X turns clockwise, then gear Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q6 Anticlockwise.JPG\" alt=\"Q6 Anticlockwise\" /></p>', 'Aptitude', 'True or False'),
(23, 46, '<p>A motorboat, whose speed in 15 km/hr in still water goes 30 km downstream and comes back in a total of 4 hours 30 minutes. The speed of the stream (in km/hr) is:</p>', 'Aptitude', 'Multiple Choice'),
(24, 46, '<p>Find the greatest number that will divide 43, 91 and 183 so as to leave the same remainder in each case.</p>', 'Aptitude', 'Multiple Choice'),
(25, 46, '<p>If drive wheel X rotates clockwise, then&nbsp;wheel Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q7 Clockwise.JPG\" alt=\"Q7 Clockwise\" /></p>', 'Aptitude', 'True or False'),
(26, 46, '<p>Which of the following past tense forms are correct? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(27, 46, '<p>The day before the day before yesterday is three days after Saturday. Therefore, today is Friday.</p>', 'Intelligence', 'True or False'),
(28, 46, '<p>At the end of a banquet 10 people shake hands with each other. The total number of handshakes will be 45.</p>', 'Intelligence', 'True or False'),
(29, 46, '<p>37, 34, 31, 28</p>', 'Intelligence', 'Fill in the Blanks'),
(30, 46, '<p>8, 24, 12, ?, 18, 54</p>', 'Intelligence', 'Fill in the Blanks'),
(31, 47, '<p>3, 4, 7, 11, 18, 29,?</p>', 'Intelligence', 'Fill in the Blanks'),
(32, 47, '<p>If the letters in the word LITTORAL are rearranged, they can spell a word relating to a well known art form.</p>', 'Intelligence', 'True or False'),
(33, 47, '<p>Which of the following plural forms are correct? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(34, 47, '<p>Writer : Pen : : ?</p>', 'Intelligence', 'Multiple Choice'),
(35, 47, '<p>Fish: Scales : : Bear : ?</p>', 'Intelligence', 'Multiple Choice'),
(36, 48, '<p>Which of the following plural forms are correct? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(37, 48, '<p>The letters in the word ABOUT are in alphabetical order.</p>', 'Intelligence', 'True or False'),
(38, 48, '<p>18 is 1/2 of 36. 36 is 1/4 of 144. 144 is 1/4 of 576. What is 144 divided by 1/2?</p>', 'Intelligence', 'Fill in the Blanks'),
(39, 48, '<p>FGID : OPQR : BCDE : KMLN</p>', 'Intelligence', 'True or False'),
(40, 48, '<p>Which of the following are mammals? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(41, 48, '<p>One pipe can fill a tank three times as fast as another pipe. If together the two pipes can fill the tank in 36 minutes, then the slower pipe alone will be able to fill the tank in:</p>', 'Aptitude', 'Multiple Choice'),
(42, 48, '<p>Find out how will the key figure (X) look like after rotation.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q3 A4.JPG\" alt=\"Q3 A4\" /></p>', 'Aptitude', 'Multiple Choice'),
(43, 48, '<p>3 pumps, working 8 hours a day, can empty a tank in 2 days. How many hours a day must 4 pumps work to empty the tank in 1 day?</p>', 'Aptitude', 'Fill in the Blanks'),
(44, 48, '<p>A man buys a watch for Rs. 1950 in cash and sells it for Rs. 2200 at a credit of 1 year. If the rate of interest is 10% per annum, the man gains Rs. 50.</p>', 'Aptitude', 'True or False'),
(45, 48, '<p>Find out the wrong number in the given sequence of numbers: 582, 605, 588, 611, 634, 617, 600</p>', 'Aptitude', 'Fill in the Blanks'),
(46, 48, '<p>If gear X turns clockwise, then gear Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q6 Anticlockwise.JPG\" alt=\"Q6 Anticlockwise\" /></p>', 'Aptitude', 'True or False'),
(47, 48, '<p>Find the odd man out: 10, 25, 45, 54, 60, 75, 80</p>', 'Aptitude', 'Fill in the Blanks'),
(48, 48, '<p>If drive wheel X rotates clockwise, then&nbsp;wheel Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q7 Clockwise.JPG\" alt=\"Q7 Clockwise\" /></p>', 'Aptitude', 'True or False'),
(49, 48, '<p>Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 Question.JPG\" alt=\"Q4 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(50, 48, '<p>Insert the missing number: 8, 24, 12, 36, 18, 54, ?</p>', 'Aptitude', 'Fill in the Blanks'),
(51, 48, '<p>How long is an IPv6 address?</p>', 'Engineering', 'Multiple Choice'),
(52, 48, '<p>What command is used to create a backup configuration?</p>', 'Engineering', 'Multiple Choice'),
(53, 48, '<p>Select all network protocols.</p>', 'Engineering', 'Multiple Answers'),
(54, 48, '<p>Which WLAN IEEE specification allows up to 54Mbps at 2.4GHz?</p>', 'Engineering', 'Multiple Choice'),
(55, 48, '<p>BPDUs are sent from a layer 2 device every 3 seconds</p>', 'Engineering', 'True or False'),
(56, 48, '<p>You like to be engaged in an active and fast-paced job</p>', 'Personality', 'True or False'),
(57, 48, '<p>Strict observance of the established rules is likely to prevent a good outcome</p>', 'Personality', 'True or False'),
(58, 48, '<p>You tend to be unbiased even if this might endanger your good relations with people</p>', 'Personality', 'True or False'),
(59, 48, '<p>You are usually the first to react to a sudden event, such as the telephone ringing or unexpected question</p>', 'Personality', 'True or False'),
(60, 48, '<p>It is in your nature to assume responsibility</p>', 'Personality', 'True or False'),
(61, 49, '<p>3, 4, 7, 11, 18, 29,?</p>', 'Intelligence', 'Fill in the Blanks'),
(62, 49, '<p>Which of the following are mammals? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(63, 49, '<p>18 is 1/2 of 36. 36 is 1/4 of 144. 144 is 1/4 of 576. What is 144 divided by 1/2?</p>', 'Intelligence', 'Fill in the Blanks'),
(64, 49, '<p>975, 864, 753, 642,?</p>', 'Intelligence', 'Multiple Choice'),
(65, 49, '<p>8 : 4 as 10 : ?</p>', 'Intelligence', 'Fill in the Blanks'),
(66, 50, '<p>The letters in the word ABOUT are in alphabetical order.</p>', 'Intelligence', 'True or False'),
(67, 50, '<p>If the letters in the word LITTORAL are rearranged, they can spell a word relating to a well known art form.</p>', 'Intelligence', 'True or False'),
(68, 50, '<p>Check all options that are elements.</p>', 'Intelligence', 'Multiple Answers'),
(69, 50, '<p>Check all options that are integers</p>', 'Intelligence', 'Multiple Answers'),
(70, 50, '<p>At the end of a banquet 10 people shake hands with each other. The total number of handshakes will be 45.</p>', 'Intelligence', 'True or False'),
(71, 50, '<p>If gear X turns clockwise, then gear Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q6 Anticlockwise.JPG\" alt=\"Q6 Anticlockwise\" /></p>', 'Aptitude', 'True or False'),
(72, 50, '<p>If drive wheel X rotates clockwise, then&nbsp;wheel Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q7 Clockwise.JPG\" alt=\"Q7 Clockwise\" /></p>', 'Aptitude', 'True or False'),
(73, 50, '<p>One pipe can fill a tank three times as fast as another pipe. If together the two pipes can fill the tank in 36 minutes, then the slower pipe alone will be able to fill the tank in:</p>', 'Aptitude', 'Multiple Choice'),
(74, 50, '<p>Find the greatest number that will divide 43, 91 and 183 so as to leave the same remainder in each case.</p>', 'Aptitude', 'Multiple Choice'),
(75, 50, '<p><span style=\"color: #555555; font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: 19.200000762939453px; background-color: #fafafa;\">Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</span></p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 Question.JPG\" alt=\"Q5 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(76, 50, '<p>A man buys a watch for Rs. 1950 in cash and sells it for Rs. 2200 at a credit of 1 year. If the rate of interest is 10% per annum, the man gains Rs. 50.</p>', 'Aptitude', 'True or False'),
(77, 50, '<p>3 pumps, working 8 hours a day, can empty a tank in 2 days. How many hours a day must 4 pumps work to empty the tank in 1 day?</p>', 'Aptitude', 'Fill in the Blanks'),
(78, 50, '<p>A motorboat, whose speed in 15 km/hr in still water goes 30 km downstream and comes back in a total of 4 hours 30 minutes. The speed of the stream (in km/hr) is:</p>', 'Aptitude', 'Multiple Choice'),
(79, 50, '<p>Find out which of the figures (1), (2), (3) and (4) can be formed from the pieces given in figure (X).</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q2 A3.JPG\" alt=\"Q2 A3\" /></p>', 'Aptitude', 'Multiple Choice'),
(80, 50, '<p>Find the odd man out: 10, 25, 45, 54, 60, 75, 80</p>', 'Aptitude', 'Fill in the Blanks'),
(81, 50, '<p>You like to be engaged in an active and fast-paced job</p>', 'Personality', 'True or False'),
(82, 50, '<p>You are usually the first to react to a sudden event, such as the telephone ringing or unexpected question</p>', 'Personality', 'True or False'),
(83, 50, '<p>You are almost never late for your appointments</p>', 'Personality', 'True or False'),
(84, 50, '<p>Strict observance of the established rules is likely to prevent a good outcome</p>', 'Personality', 'True or False'),
(85, 50, '<p>It\'s difficult to get you excited </p>', 'Personality', 'True or False'),
(86, 51, '<p>Find out how will the key figure (X) look like after rotation.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q3 A4.JPG\" alt=\"Q3 A4\" /></p>', 'Aptitude', 'Multiple Choice'),
(87, 51, '<p>Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 Question.JPG\" alt=\"Q4 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(88, 51, '<p>Find out which of the figures (1), (2), (3) and (4) can be formed from the pieces given in figure (X).</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q1 A1.JPG\" alt=\"Q1 A1\" /></p>', 'Aptitude', 'Multiple Choice'),
(89, 51, '<p>Insert the missing number: 8, 24, 12, 36, 18, 54, ?</p>', 'Aptitude', 'Fill in the Blanks'),
(90, 51, '<p>If drive wheel X rotates clockwise, then&nbsp;wheel Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q7 Clockwise.JPG\" alt=\"Q7 Clockwise\" /></p>', 'Aptitude', 'True or False'),
(91, 51, '<p>3 pumps, working 8 hours a day, can empty a tank in 2 days. How many hours a day must 4 pumps work to empty the tank in 1 day?</p>', 'Aptitude', 'Fill in the Blanks'),
(92, 51, '<p>A man buys a watch for Rs. 1950 in cash and sells it for Rs. 2200 at a credit of 1 year. If the rate of interest is 10% per annum, the man gains Rs. 50.</p>', 'Aptitude', 'True or False'),
(93, 51, '<p>If gear X turns clockwise, then gear Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q6 Anticlockwise.JPG\" alt=\"Q6 Anticlockwise\" /></p>', 'Aptitude', 'True or False'),
(94, 51, '<p>Find the greatest number that will divide 43, 91 and 183 so as to leave the same remainder in each case.</p>', 'Aptitude', 'Multiple Choice'),
(95, 51, '<p>A motorboat, whose speed in 15 km/hr in still water goes 30 km downstream and comes back in a total of 4 hours 30 minutes. The speed of the stream (in km/hr) is:</p>', 'Aptitude', 'Multiple Choice'),
(96, 51, '<p>FGID : OPQR : BCDE : KMLN</p>', 'Intelligence', 'True or False'),
(97, 51, '<p>37, 34, 31, 28</p>', 'Intelligence', 'Fill in the Blanks'),
(98, 51, '<p>Which of the following are mammals? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(99, 51, '<p>Which number is wrong in the given series? 1, 9, 25, 50, 81</p>', 'Intelligence', 'Multiple Choice'),
(100, 51, '<p>AGMSY, CIOUA, EXQWC, ?, IOUAG, KQWCI</p>', 'Intelligence', 'Multiple Choice'),
(101, 52, '<p>At the end of a banquet 10 people shake hands with each other. The total number of handshakes will be 45.</p>', 'Intelligence', 'True or False'),
(102, 52, '<p>Which of the following plural forms are correct? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(103, 52, '<p>8 : 4 as 10 : ?</p>', 'Intelligence', 'Fill in the Blanks'),
(104, 52, '<p>18 is 1/2 of 36. 36 is 1/4 of 144. 144 is 1/4 of 576. What is 144 divided by 1/2?</p>', 'Intelligence', 'Fill in the Blanks'),
(105, 52, '<p>The day before the day before yesterday is three days after Saturday. Therefore, today is Friday.</p>', 'Intelligence', 'True or False'),
(106, 52, '<p><span style=\"color: #555555; font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: 19.200000762939453px; background-color: #fafafa;\">Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</span></p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 Question.JPG\" alt=\"Q5 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(107, 52, '<p>If gear X turns clockwise, then gear Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q6 Anticlockwise.JPG\" alt=\"Q6 Anticlockwise\" /></p>', 'Aptitude', 'True or False'),
(108, 52, '<p>One pipe can fill a tank three times as fast as another pipe. If together the two pipes can fill the tank in 36 minutes, then the slower pipe alone will be able to fill the tank in:</p>', 'Aptitude', 'Multiple Choice'),
(109, 52, '<p>Insert the missing number: 8, 24, 12, 36, 18, 54, ?</p>', 'Aptitude', 'Fill in the Blanks'),
(110, 52, '<p>If drive wheel X rotates clockwise, then&nbsp;wheel Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q7 Clockwise.JPG\" alt=\"Q7 Clockwise\" /></p>', 'Aptitude', 'True or False'),
(111, 52, '<p>3 pumps, working 8 hours a day, can empty a tank in 2 days. How many hours a day must 4 pumps work to empty the tank in 1 day?</p>', 'Aptitude', 'Fill in the Blanks'),
(112, 52, '<p>Find out which of the figures (1), (2), (3) and (4) can be formed from the pieces given in figure (X).</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q2 A3.JPG\" alt=\"Q2 A3\" /></p>', 'Aptitude', 'Multiple Choice'),
(113, 52, '<p>Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 Question.JPG\" alt=\"Q4 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(114, 52, '<p>Find out how will the key figure (X) look like after rotation.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q3 A4.JPG\" alt=\"Q3 A4\" /></p>', 'Aptitude', 'Multiple Choice'),
(115, 52, '<p>A motorboat, whose speed in 15 km/hr in still water goes 30 km downstream and comes back in a total of 4 hours 30 minutes. The speed of the stream (in km/hr) is:</p>', 'Aptitude', 'Multiple Choice'),
(116, 52, '<p>Select all layers that are included in the OSI model.</p>', 'Engineering', 'Multiple Answers'),
(117, 52, '<p>The two main types of access control lists (ACLs) are Standard and IEEE.</p>', 'Engineering', 'True or False'),
(118, 52, '<p>What command is used to create a backup configuration?</p>', 'Engineering', 'Multiple Choice'),
(119, 52, '<p>You have 10 users plugged into a hub running 10Mbps half-duplex. There is a server connected to the switch running 10Mbps half-duplex as well. How much bandwidth does each host have to the server?</p>', 'Engineering', 'Multiple Choice'),
(120, 52, '<p>BPDUs are sent from a layer 2 device every 3 seconds</p>', 'Engineering', 'True or False'),
(121, 52, '<p>You like to be engaged in an active and fast-paced job</p>', 'Personality', 'True or False'),
(122, 52, '<p>You tend to be unbiased even if this might endanger your good relations with people</p>', 'Personality', 'True or False'),
(123, 52, '<p>You are more interested in a general idea than in the details of its realization</p>', 'Personality', 'True or False'),
(124, 52, '<p>It is in your nature to assume responsibility</p>', 'Personality', 'True or False'),
(125, 52, '<p>You enjoy having a wide circle of acquaintances</p>', 'Personality', 'True or False');

-- --------------------------------------------------------

--
-- Table structure for table `exams_results`
--

CREATE TABLE `exams_results` (
  `exam_id` int(11) NOT NULL,
  `category` varchar(45) NOT NULL,
  `score` varchar(45) NOT NULL,
  `percentage` double NOT NULL,
  `classification` varchar(45) NOT NULL,
  `remark` varchar(45) NOT NULL,
  `temp_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='		';

--
-- Dumping data for table `exams_results`
--

INSERT INTO `exams_results` (`exam_id`, `category`, `score`, `percentage`, `classification`, `remark`, `temp_pk`) VALUES
(45, 'Intelligence', '4', 80, 'Above Average', 'PASSED', 57),
(45, 'Aptitude', '4', 40, 'Average', 'FAILED', 58),
(46, 'Aptitude', '7', 70, 'High Average', 'PASSED', 59),
(46, 'Intelligence', '3', 60, 'High Average', 'PASSED', 60),
(47, 'Intelligence', '3', 60, 'High Average', 'PASSED', 61),
(48, 'Intelligence', '5', 100, 'Very Superior', 'PASSED', 62),
(48, 'Aptitude', '8', 80, 'Above Average', 'PASSED', 63),
(48, 'Engineering', '5', 100, 'Very Superior', 'PASSED', 64),
(48, 'Personality', '4', 80, 'Above Average', 'PASSED', 65),
(49, 'Intelligence', '2', 40, 'Average', 'FAILED', 66),
(50, 'Intelligence', '3', 60, 'High Average', 'PASSED', 67),
(50, 'Aptitude', '7', 70, 'High Average', 'PASSED', 68),
(50, 'Personality', '1', 20, 'Below Average', 'FAILED', 69),
(51, 'Aptitude', '7', 70, 'High Average', 'PASSED', 70),
(51, 'Intelligence', '1', 20, 'Below Average', 'FAILED', 71),
(52, 'Intelligence', '4', 80, 'Above Average', 'PASSED', 72),
(52, 'Aptitude', '7', 70, 'High Average', 'PASSED', 73),
(52, 'Engineering', '4', 80, 'Above Average', 'PASSED', 74),
(52, 'Personality', '3', 60, 'High Average', 'PASSED', 75);

-- --------------------------------------------------------

--
-- Table structure for table `exam_types`
--

CREATE TABLE `exam_types` (
  `type` varchar(50) NOT NULL,
  `order` int(11) NOT NULL,
  `category_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_types`
--

INSERT INTO `exam_types` (`type`, `order`, `category_no`) VALUES
('ENG', 1, 1),
('ENG', 2, 2),
('ENG', 3, 4),
('ENG', 4, 3),
('MPT', 1, 2),
('MPT', 2, 1),
('MPT', 3, 3),
('RNF', 1, 1),
('RNF', 2, 2),
('RNF', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='			';

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `option`, `score`) VALUES
(2, 2, '<p>GMSYE</p>', 1),
(3, 2, '<p>FMSYE</p>', 0),
(4, 2, '<p>GNSYD</p>', 0),
(5, 2, '<p>FMYES</p>', 0),
(6, 3, '<p>531</p>', 1),
(7, 3, '<p>314</p>', 0),
(8, 3, '<p>431</p>', 0),
(9, 3, '<p>532</p>', 0),
(11, 5, '<p>50</p>', 1),
(12, 5, '<p>25</p>', 0),
(13, 5, '<p>1</p>', 0),
(14, 5, '<p>81</p>', 0),
(15, 6, '<p>Fur</p>', 1),
(16, 6, '<p>Leaves</p>', 0),
(17, 6, '<p>Feathers</p>', 0),
(18, 6, '<p>Skin</p>', 0),
(19, 7, '<p>Painter</p>', 1),
(20, 7, '<p>Artist: : Tailor Brush</p>', 0),
(21, 7, '<p>Needle</p>', 0),
(22, 7, '<p>Teacher : Canvas : Class</p>', 0),
(23, 8, 'True', 1),
(24, 8, 'False', 0),
(25, 9, 'True', 1),
(26, 9, 'False', 0),
(27, 10, 'False', 1),
(28, 10, 'True', 0),
(32, 14, 'False', 1),
(33, 14, 'True', 0),
(34, 15, 'False', 1),
(35, 15, 'True', 0),
(36, 16, '<p>Carbon</p>', 1),
(37, 16, '<p>Nitrogen</p>', 1),
(38, 16, '<p>Oxygen</p>', 1),
(39, 16, '<p>Sucrose</p>', -1),
(40, 16, '<p>Diamond</p>', -1),
(41, 17, '<p>Elephant</p>', 1),
(42, 17, '<p>Cat</p>', 1),
(43, 17, '<p>Snake</p>', -1),
(44, 17, '<p>Alligator</p>', -1),
(45, 18, '<p>mouse - mice</p>', 1),
(46, 18, '<p>cactus - cacti</p>', 1),
(47, 18, '<p>furniture - furnitures</p>', -1),
(48, 18, '<p>ox - oxes</p>', -1),
(49, 18, '<p>goose - gooses</p>', -1),
(50, 19, '<p>25</p>', 1),
(51, 19, '<p>0.1</p>', -1),
(52, 19, '<p>30.6</p>', -1),
(53, 20, '<p>buy - bought</p>', 1),
(54, 20, '<p>cut - cutted</p>', -1),
(55, 20, '<p>break - broken</p>', -1),
(56, 20, '<p>lie - lie</p>', -1),
(57, 21, '<p>4</p>', 1),
(58, 21, '<p>9</p>', 0),
(59, 21, '<p>7</p>', 0),
(60, 21, '<p>13</p>', 0),
(61, 22, '<p>144 min.</p>', 1),
(62, 22, '<p>81 min.</p>', 0),
(63, 22, '<p>192 min.</p>', 0),
(64, 22, '<p>108 min.</p>', 0),
(65, 23, '<p>5</p>', 1),
(66, 23, '<p>4</p>', 0),
(67, 23, '<p>6</p>', 0),
(68, 23, '<p>10</p>', 0),
(73, 28, 'True', 1),
(74, 28, 'False', 0),
(75, 29, 'True', 1),
(76, 29, 'False', 0),
(77, 30, 'True', 1),
(78, 30, 'False', 0),
(79, 31, 'True', 1),
(80, 31, 'False', 0),
(81, 32, 'True', 1),
(82, 32, 'False', 0),
(83, 33, 'True', 1),
(84, 33, 'False', 0),
(85, 34, 'False', 1),
(86, 34, 'True', 0),
(87, 35, 'True', 1),
(88, 35, 'False', 0),
(89, 36, 'False', 1),
(90, 36, 'True', 0),
(91, 37, 'False', 1),
(92, 37, 'True', 0),
(93, 38, 'True', 1),
(94, 38, 'False', 0),
(95, 39, '<p>1</p>', 1),
(96, 39, '<p>2</p>', 0),
(97, 39, '<p>3</p>', 0),
(98, 39, '<p>4</p>', 0),
(99, 40, '<p>1</p>', 0),
(100, 40, '<p>2</p>', 0),
(101, 40, '<p>3</p>', 1),
(102, 40, '<p>4</p>', 0),
(103, 41, '<p>1</p>', 0),
(104, 41, '<p>2</p>', 0),
(105, 41, '<p>3</p>', 0),
(106, 41, '<p>4</p>', 1),
(115, 44, 'True', 0),
(116, 44, 'False', 1),
(117, 45, 'True', 1),
(118, 45, 'False', 0),
(119, 42, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C1.JPG\" alt=\"Q4 C1\" /></p>', 0),
(120, 42, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C2.JPG\" alt=\"Q4 C2\" /></p>', 0),
(121, 42, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C3.JPG\" alt=\"Q4 C3\" /></p>', 0),
(122, 42, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 C4.JPG\" alt=\"Q4 C4\" /></p>', 1),
(123, 1, '47', 1),
(124, 4, '36', 1),
(125, 12, '5', 1),
(126, 11, '25', 1),
(127, 13, '288', 1),
(128, 24, '54', 1),
(129, 27, '12', 1),
(130, 26, '27', 1),
(131, 25, '634', 1),
(138, 43, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C1.JPG\" alt=\"Q5 C1\" /></p>', 0),
(139, 43, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C2.JPG\" alt=\"Q5 C2\" /></p>', 0),
(140, 43, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C3.JPG\" alt=\"Q5 C3\" /></p>', 1),
(141, 43, '<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 C4.JPG\" alt=\"Q5 C4\" /></p>', 0),
(142, 46, '<p>32 bits</p>', 0),
(143, 46, '<p>128 bytes</p>', 0),
(144, 46, '<p>64 bits</p>', 0),
(145, 46, '<p>128 bits</p>', 1),
(146, 47, '<p>100 kbps</p>', 0),
(147, 47, '<p>1 Mbps</p>', 0),
(148, 47, '<p>2 Mbps</p>', 0),
(149, 47, '<p>10 Mbps</p>', 1),
(150, 48, '<p>copy running backup</p>', 0),
(151, 48, '<p>copy running-config startup-config</p>', 1),
(152, 48, '<p>config mem</p>', 0),
(153, 48, '<p>wr mem</p>', 0),
(154, 49, '<p>A</p>', 0),
(155, 49, '<p>B</p>', 0),
(156, 49, '<p>G</p>', 1),
(157, 49, '<p>N</p>', 0),
(158, 50, '<p>NCP</p>', 1),
(159, 50, '<p>ISDN</p>', 0),
(160, 50, '<p>HDLC</p>', 0),
(161, 50, '<p>LCP</p>', 0),
(162, 51, 'True', 1),
(163, 51, 'False', 0),
(164, 52, 'True', 0),
(165, 52, 'False', 1),
(166, 53, 'True', 0),
(167, 53, 'False', 1),
(168, 54, '<p>physical layer</p>', 1),
(169, 54, '<p>transfer layer</p>', -1),
(170, 54, '<p>date link layer</p>', 1),
(171, 54, '<p>visual layer</p>', -1),
(172, 54, '<p>logic layer</p>', -1),
(173, 55, '<p>FTP</p>', 1),
(174, 55, '<p>SMTP</p>', 1),
(175, 55, '<p>PHP</p>', -1),
(176, 55, '<p>JSP</p>', -1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(8000) NOT NULL,
  `category` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `category`, `type`) VALUES
(1, '<p>3, 4, 7, 11, 18, 29,?</p>', 'Intelligence', 'Fill in the Blanks'),
(2, '<p>AGMSY, CIOUA, EXQWC, ?, IOUAG, KQWCI</p>', 'Intelligence', 'Multiple Choice'),
(3, '<p>975, 864, 753, 642,?</p>', 'Intelligence', 'Multiple Choice'),
(4, '<p>8, 24, 12, ?, 18, 54</p>', 'Intelligence', 'Fill in the Blanks'),
(5, '<p>Which number is wrong in the given series? 1, 9, 25, 50, 81</p>', 'Intelligence', 'Multiple Choice'),
(6, '<p>Fish: Scales : : Bear : ?</p>', 'Intelligence', 'Multiple Choice'),
(7, '<p>Writer : Pen : : ?</p>', 'Intelligence', 'Multiple Choice'),
(8, '<p>The day before the day before yesterday is three days after Saturday. Therefore, today is Friday.</p>', 'Intelligence', 'True or False'),
(9, '<p>At the end of a banquet 10 people shake hands with each other. The total number of handshakes will be 45.</p>', 'Intelligence', 'True or False'),
(10, '<p>FGID : OPQR : BCDE : KMLN</p>', 'Intelligence', 'True or False'),
(11, '<p>37, 34, 31, 28</p>', 'Intelligence', 'Fill in the Blanks'),
(12, '<p>8 : 4 as 10 : ?</p>', 'Intelligence', 'Fill in the Blanks'),
(13, '<p>18 is 1/2 of 36. 36 is 1/4 of 144. 144 is 1/4 of 576. What is 144 divided by 1/2?</p>', 'Intelligence', 'Fill in the Blanks'),
(14, '<p>The letters in the word ABOUT are in alphabetical order.</p>', 'Intelligence', 'True or False'),
(15, '<p>If the letters in the word LITTORAL are rearranged, they can spell a word relating to a well known art form.</p>', 'Intelligence', 'True or False'),
(16, '<p>Check all options that are elements.</p>', 'Intelligence', 'Multiple Answers'),
(17, '<p>Which of the following are mammals? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(18, '<p>Which of the following plural forms are correct? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(19, '<p>Check all options that are integers</p>', 'Intelligence', 'Multiple Answers'),
(20, '<p>Which of the following past tense forms are correct? Check all possible answers.</p>', 'Intelligence', 'Multiple Answers'),
(21, '<p>Find the greatest number that will divide 43, 91 and 183 so as to leave the same remainder in each case.</p>', 'Aptitude', 'Multiple Choice'),
(22, '<p>One pipe can fill a tank three times as fast as another pipe. If together the two pipes can fill the tank in 36 minutes, then the slower pipe alone will be able to fill the tank in:</p>', 'Aptitude', 'Multiple Choice'),
(23, '<p>A motorboat, whose speed in 15 km/hr in still water goes 30 km downstream and comes back in a total of 4 hours 30 minutes. The speed of the stream (in km/hr) is:</p>', 'Aptitude', 'Multiple Choice'),
(24, '<p>Find the odd man out: 10, 25, 45, 54, 60, 75, 80</p>', 'Aptitude', 'Fill in the Blanks'),
(25, '<p>Find out the wrong number in the given sequence of numbers: 582, 605, 588, 611, 634, 617, 600</p>', 'Aptitude', 'Fill in the Blanks'),
(26, '<p>Insert the missing number: 8, 24, 12, 36, 18, 54, ?</p>', 'Aptitude', 'Fill in the Blanks'),
(27, '<p>3 pumps, working 8 hours a day, can empty a tank in 2 days. How many hours a day must 4 pumps work to empty the tank in 1 day?</p>', 'Aptitude', 'Fill in the Blanks'),
(28, '<p>A man buys a watch for Rs. 1950 in cash and sells it for Rs. 2200 at a credit of 1 year. If the rate of interest is 10% per annum, the man gains Rs. 50.</p>', 'Aptitude', 'True or False'),
(29, '<p>You are almost never late for your appointments</p>', 'Personality', 'True or False'),
(30, '<p>You like to be engaged in an active and fast-paced job</p>', 'Personality', 'True or False'),
(31, '<p>You enjoy having a wide circle of acquaintances</p>', 'Personality', 'True or False'),
(32, '<p>You feel involved when watching TV soaps</p>', 'Personality', 'True or False'),
(33, '<p>You are usually the first to react to a sudden event, such as the telephone ringing or unexpected question</p>', 'Personality', 'True or False'),
(34, '<p>You are more interested in a general idea than in the details of its realization</p>', 'Personality', 'True or False'),
(35, '<p>You tend to be unbiased even if this might endanger your good relations with people</p>', 'Personality', 'True or False'),
(36, '<p>Strict observance of the established rules is likely to prevent a good outcome</p>', 'Personality', 'True or False'),
(37, '<p>It\'s difficult to get you excited </p>', 'Personality', 'True or False'),
(38, '<p>It is in your nature to assume responsibility</p>', 'Personality', 'True or False'),
(39, '<p>Find out which of the figures (1), (2), (3) and (4) can be formed from the pieces given in figure (X).</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q1 A1.JPG\" alt=\"Q1 A1\" /></p>', 'Aptitude', 'Multiple Choice'),
(40, '<p>Find out which of the figures (1), (2), (3) and (4) can be formed from the pieces given in figure (X).</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q2 A3.JPG\" alt=\"Q2 A3\" /></p>', 'Aptitude', 'Multiple Choice'),
(41, '<p>Find out how will the key figure (X) look like after rotation.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q3 A4.JPG\" alt=\"Q3 A4\" /></p>', 'Aptitude', 'Multiple Choice'),
(42, '<p>Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q4 Question.JPG\" alt=\"Q4 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(43, '<p><span style=\"color: #555555; font-family: Verdana, Tahoma, Arial, sans-serif; font-size: 12px; line-height: 19.200000762939453px; background-color: #fafafa;\">Find out from amongst the four alternatives as to how the pattern would appear when the transparent sheet is folded at the dotted line.</span></p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q5 Question.JPG\" alt=\"Q5 Question\" /></p>', 'Aptitude', 'Multiple Choice'),
(44, '<p>If gear X turns clockwise, then gear Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q6 Anticlockwise.JPG\" alt=\"Q6 Anticlockwise\" /></p>', 'Aptitude', 'True or False'),
(45, '<p>If drive wheel X rotates clockwise, then&nbsp;wheel Y also turns clockwise.</p>\r\n<p><img src=\"http://localhost/workspace/ope_app/public/js/tinymce/filemanager/uploads/Aptitude/Q7 Clockwise.JPG\" alt=\"Q7 Clockwise\" /></p>', 'Aptitude', 'True or False'),
(46, '<p>How long is an IPv6 address?</p>', 'Engineering', 'Multiple Choice'),
(47, '<p>You have 10 users plugged into a hub running 10Mbps half-duplex. There is a server connected to the switch running 10Mbps half-duplex as well. How much bandwidth does each host have to the server?</p>', 'Engineering', 'Multiple Choice'),
(48, '<p>What command is used to create a backup configuration?</p>', 'Engineering', 'Multiple Choice'),
(49, '<p>Which WLAN IEEE specification allows up to 54Mbps at 2.4GHz?</p>', 'Engineering', 'Multiple Choice'),
(50, '<p>What protocol does PPP use to identify the Network layer protocol?</p>', 'Engineering', 'Multiple Choice'),
(51, '<p>ICMP is used to send a destination network unknown message back to originating hosts.</p>', 'Engineering', 'True or False'),
(52, '<p>The two main types of access control lists (ACLs) are Standard and IEEE.</p>', 'Engineering', 'True or False'),
(53, '<p>BPDUs are sent from a layer 2 device every 3 seconds</p>', 'Engineering', 'True or False'),
(54, '<p>Select all layers that are included in the OSI model.</p>', 'Engineering', 'Multiple Answers'),
(55, '<p>Select all network protocols.</p>', 'Engineering', 'Multiple Answers');

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE `question_types` (
  `type` varchar(50) NOT NULL,
  `type_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_types`
--

INSERT INTO `question_types` (`type`, `type_no`) VALUES
('Fill in the Blanks', 3),
('Multiple Answers', 4),
('Multiple Choice', 2),
('True or False', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `no` int(11) NOT NULL,
  `display_message` longtext NOT NULL,
  `post_exam_message` longtext NOT NULL,
  `subject_passed` varchar(255) NOT NULL,
  `message_passed` longtext NOT NULL,
  `subject_failed` varchar(255) NOT NULL,
  `message_failed` longtext NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `email_password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`no`, `display_message`, `post_exam_message`, `subject_passed`, `message_passed`, `subject_failed`, `message_failed`, `email_address`, `email_password`) VALUES
(0, '<p>Filet mignon consequat prosciutto shank anim sint incididunt aliqua kevin porchetta ham hock. Sed velit pork officia in landjaeger, shank esse salami ea. Meatloaf adipisicing kevin sint sunt magna ut sed reprehenderit exercitation tempor. Voluptate elit ea fatback cupidatat venison ground round consequat eiusmod kielbasa leberkas. Tempor reprehenderit nisi et biltong. Drumstick pork loin aliquip capicola, andouille adipisicing tempor sed ad beef corned beef sirloin tongue venison. Spare ribs cillum beef prosciutto, shankle minim meatball pancetta ea. Tongue ball tip ex enim magna exercitation veniam tri-tip ham hock andouille biltong short ribs beef ut adipisicing. Aliqua turkey meatball labore pork belly. Rump cow pork et biltong, ad boudin fugiat pastrami pancetta ullamco porchetta. Aute frankfurter t-bone short ribs beef ribs. Fatback velit bacon do, ut chuck laboris frankfurter bresaola meatball labore commodo. Minim dolore occaecat spare ribs est enim doner aliquip beef ribs. Ullamco sausage venison cillum culpa, eiusmod leberkas labore velit biltong fatback nostrud esse enim tempor. Ut proident pork loin enim ex adipisicing. Magna adipisicing anim ball tip id nisi pork belly corned beef ham venison in strip steak aute cupidatat pork. Turducken meatloaf in, tenderloin nisi corned beef cow aute do.</p>', '<p>Exam Completed</p>', 'PASSED', '<p>YOU PASSED!</p>', 'FAILED', '<p>YOU FAILED</p>', 'ope_app@gmail.com', 'admin_sanchez');

-- --------------------------------------------------------

--
-- Table structure for table `unique_key`
--

CREATE TABLE `unique_key` (
  `email_address` varchar(255) NOT NULL,
  `unique_key` varchar(20) NOT NULL,
  `exam_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(15) NOT NULL,
  `applicant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `type`, `applicant_id`) VALUES
('admin1', '1234', 'Admin Sanchez', 'admin', 0),
('admin2', '1234', 'Admin San Diego', 'admin', 0),
('asdasdas@yahoo.com', '1234', 'John Pinale', 'applicant', 28),
('ces_quinse15@yahoo.com', '1234', 'Cecilia Quinse', 'applicant', 27),
('dc.korano@hotmail.com', '1234', 'Don Carlo Korano', 'applicant', 22),
('emilio_abadicio@ymail.com', '1234', 'Emilio Abadicio Santos', 'applicant', 21),
('hipolito.aga@gmail.com', '1234', 'Albert Galileo Hipolito', 'applicant', 24),
('kris.rodriguez@gmail.com', '1234', 'Chrysanthemum Rodriguez', 'applicant', 23),
('marco_benson@hotmail.com', '1234', 'Marco Benson', 'applicant', 26),
('rr_regalado@yahoo.com', '1234', 'Roberta Ramona Regalado', 'applicant', 25),
('super_admin', '1234', 'Super Admin Santos', 'super_admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `classifications`
--
ALTER TABLE `classifications`
  ADD PRIMARY KEY (`classification`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `FK_applicant_id_idx` (`applicant_id`);

--
-- Indexes for table `exams_answers_options`
--
ALTER TABLE `exams_answers_options`
  ADD PRIMARY KEY (`item_id`,`option`);

--
-- Indexes for table `exams_answers_questions`
--
ALTER TABLE `exams_answers_questions`
  ADD PRIMARY KEY (`item_id`,`exam_id`);

--
-- Indexes for table `exams_results`
--
ALTER TABLE `exams_results`
  ADD PRIMARY KEY (`temp_pk`);

--
-- Indexes for table `exam_types`
--
ALTER TABLE `exam_types`
  ADD PRIMARY KEY (`type`,`order`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `FK_type_idx` (`type`);

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `unique_key`
--
ALTER TABLE `unique_key`
  ADD PRIMARY KEY (`email_address`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `exams_answers_questions`
--
ALTER TABLE `exams_answers_questions`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `exams_results`
--
ALTER TABLE `exams_results`
  MODIFY `temp_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `FK_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_type` FOREIGN KEY (`type`) REFERENCES `question_types` (`type`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
