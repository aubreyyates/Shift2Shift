// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:shift2shift.database.windows.net,1433; Database = shift2shiftDB", "aubreyyates", "{your_password_here}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "aubreyyates@shift2shift", "pwd" => "{your_password_here}", "Database" => "shift2shiftDB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:shift2shift.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

$sql = "-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2018 at 12:32 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_employees`
--

CREATE TABLE `assignment_employees` (
  `id` int(11) NOT NULL,
  `emp_first` varchar(256) NOT NULL,
  `emp_last` varchar(256) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `project_name` varchar(256) NOT NULL,
  `project_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment_employees`
--

INSERT INTO `assignment_employees` (`id`, `emp_first`, `emp_last`, `emp_email`, `project_name`, `project_id`, `emp_id`) VALUES
(38, '', '', '', '', 74, 13),
(39, '', '', '', '', 128, 13),
(41, '', '', '', '', 128, 23),
(42, '', '', '', '', 216, 23),
(43, '', '', '', '', 213, 29),
(44, '', '', '', '', 128, 29),
(45, '', '', '', '', 74, 29),
(46, '', '', '', '', 215, 29),
(48, '', '', '', '', 216, 29),
(49, '', '', '', '', 74, 32),
(50, '', '', '', 'WWWWWWWWWWWWWWWWWWWWWWWW6WWWWWWWWWWWWWWWWWWWWWWW', 216, 13);

-- --------------------------------------------------------

--
-- Table structure for table `assignment_managers`
--

CREATE TABLE `assignment_managers` (
  `id` int(11) NOT NULL,
  `manager_id` varchar(256) NOT NULL,
  `emp_id` varchar(256) NOT NULL,
  `project_id` varchar(256) NOT NULL,
  `emp_uid` varchar(256) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `project_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment_managers`
--

INSERT INTO `assignment_managers` (`id`, `manager_id`, `emp_id`, `project_id`, `emp_uid`, `emp_email`, `project_name`) VALUES
(190, '21', '13', '', '', '', ''),
(216, '16', '13', '', '', '', ''),
(228, '16', '55', '', '', '', ''),
(244, '11', '23', '', '', '', ''),
(249, '9', '', '72', '', '', ''),
(250, '9', '', '74', '', '', ''),
(251, '9', '', '217', '', '', ''),
(252, '9', '', '216', '', '', ''),
(253, '9', '', '215', '', '', ''),
(254, '9', '', '214', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `company_events`
--

CREATE TABLE `company_events` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `start_event` varchar(256) NOT NULL,
  `end_event` varchar(256) NOT NULL,
  `location` varchar(256) NOT NULL,
  `project_id` int(11) NOT NULL,
  `color` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `org_id` int(11) NOT NULL,
  `emp_id` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_events`
--

INSERT INTO `company_events` (`id`, `title`, `start_event`, `end_event`, `location`, `project_id`, `color`, `description`, `org_id`, `emp_id`) VALUES
(12, '', '2018-06-11 00:00:00', '2018-06-13 00:00:00', '', 69, 'red', '', 17, ''),
(15, '', '2018-06-13 00:00:00', '2018-06-17 00:00:00', '', 69, 'red', '', 17, ''),
(16, 'Pic Nik', '2018-07-16 00:00:00', '2018-07-21 00:00:00', '', 69, 'red', 'Buy me some money.', 17, ''),
(17, '', '2018-07-23 00:00:00', '2018-07-26 00:00:00', '', 71, 'red', '', 17, '');

-- --------------------------------------------------------

--
-- Table structure for table `company_info_and_settings`
--

CREATE TABLE `company_info_and_settings` (
  `id` int(11) NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `org_id` int(11) NOT NULL,
  `allow_employee_time_edit` varchar(256) NOT NULL,
  `allow_manager_time_edit` varchar(256) NOT NULL,
  `org_website` varchar(256) NOT NULL,
  `org_color` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_info_and_settings`
--

INSERT INTO `company_info_and_settings` (`id`, `org_name`, `org_id`, `allow_employee_time_edit`, `allow_manager_time_edit`, `org_website`, `org_color`) VALUES
(1, 'Nothsor', 17, 'no', 'yes', 'www.nothsor.com', '#a8d89f'),
(3, 'foo producers', 30, 'no', 'yes', '', ''),
(4, 'ak', 31, 'no', 'yes', '', ''),
(5, 'gods of above', 32, 'no', 'yes', '', ''),
(6, 'dee company', 34, 'no', 'yes', '', ''),
(7, 'bob', 35, 'no', 'yes', '', ''),
(9, 'seess', 41, 'yes', 'no', '', ''),
(10, 'asdfs-', 42, 'yes', 'no', '', ''),
(11, 'asdfs dfsa', 43, 'yes', 'no', '', ''),
(12, 'Hugs Co', 44, 'yes', 'no', '', ''),
(13, 'fsdfjiw', 45, 'yes', 'no', '', ''),
(14, 'chris', 46, 'yes', 'no', '', ''),
(15, 'Fun company', 50, 'yes', 'no', '', '#ccd8d6'),
(16, 'go go', 53, 'yes', 'no', '', ''),
(17, 'Testing company', 54, 'yes', 'no', '', '#cbe99c');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_first` varchar(256) NOT NULL,
  `emp_last` varchar(256) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `emp_uid` varchar(256) NOT NULL,
  `emp_pwd` varchar(256) NOT NULL,
  `emp_org` int(11) NOT NULL,
  `emp_org_name` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `date_deleted` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_first`, `emp_last`, `emp_email`, `emp_uid`, `emp_pwd`, `emp_org`, `emp_org_name`, `status`, `date_deleted`) VALUES
(11, 'Aubrey', 'Yates', '1@hotmail.com', 'emp', '$2y$10$6YNRqbvxu4uhl6P3Cb3DH.rARPpjdC.U.34yy8U/.H/npkH2E8F8q', 15, 'Crazy', '', '0000-00-00 00:00:00'),
(12, 'Boy', 'Toy', 'toy@hotmail.com', 'emp2', '$2y$10$1iGOBzOyLPX.sbFdApD1IerVUmkbhE3vHvc4wMP41kJFlWMenAeO6', 15, 'Crazy', '', '0000-00-00 00:00:00'),
(13, 'BobbyTheBobbster', 'BuilderIO', 'bob@hotmail.com', 'bobnothsor', '$2y$10$cgnLjVuhtVS/Msk0//ufEObfPB/PVCEdK5Qbm9kFc7TucR.Cq2Opu', 17, 'Nothsor', 'active', '0000-00-00 00:00:00'),
(17, 'Austin', 'Yates', 'austin@hotmail.com', 'austin', '$2y$10$dFgeWHBRrv.V1ZTYcoWVr.uEN3Osmw1DuOgqU..k1nfuvKNXIE9N6', 19, 'Aubrey Company', '', '0000-00-00 00:00:00'),
(22, 'Aubrey', 'Yates', 'aubrey555@hotmail.com', 'aubreybarbie', '$2y$10$7yggC2KYOt7tA6jSDyF4G.AmywnpQZTPXEPWRTOeUrHXqOT.aD9r2', 20, 'Barbie Doll', '', '0000-00-00 00:00:00'),
(23, 'Doron', 'Tsachor', 'doron@nothsor.com', 'doron@nothsor.com', '$2y$10$ZBaGDUnFgtl90mv9POE11.hE83a.WW/RYqJ7e94wU2KteQ.tMi2Oy', 17, 'Nothsor', 'active', '0000-00-00 00:00:00'),
(25, 'Bob', 'Hills', 'bobhill@hotmail.com', 'bobhill', '$2y$10$d68uLpFmxN8xmKJQr1Az..vV9JDmmSVSJ53f2DYeO7LxnqJLp9s6.', 21, 'Aubrey Company 2', 'active', '0000-00-00 00:00:00'),
(26, 'Hosa', 'Yat', 'hy@hotmail.com', 'hy', '$2y$10$.OxXF/7yKqaT6.B9ibN0r.uJkTWidUOvrP0h./zq4Sfs86rn80fUK', 21, 'Aubrey Company 2', '', '0000-00-00 00:00:00'),
(27, 'Fuhundalishivion', 'Runhallyiabolistiva', 'fr@nothsor.com', 'fr', '$2y$10$ZnBMIsVNKFfpMCSwLV7zzeLo/TviL3OECjJMngo.2raf.v/APOaci', 17, 'Nothsor', 'active', '0000-00-00 00:00:00'),
(28, 'Tim', 'Tom', 'tt@hotmail.com', '', '$2y$10$e6eMhSE3dqHBKcR5fba5WeAe0aREcz/EZatMe0251JRvf5QV59UKi', 50, '', 'active', '0000-00-00 00:00:00'),
(29, 'Audoson', 'Boraski', 'Au{var}doson@hotmail.com', '', '$2y$10$qb1vduu32hTdgeEC0Jjamu7h7AFFGRRBfYfzfBLEREKxSLFxB.WrW', 17, '', 'active', ''),
(30, 'Joe', 'Dee', 'goooooooooooooooooooooooooooooooooooooooo@nothsor.com', '', '$2y$10$p122o4i0AJkFVWrNn3AhLeiE5/Ar0stuCEFKlu0h5Zb1c0Ph7pGkO', 17, '', 'active', ''),
(31, 'Bud', 'Buddy', 'bud@nothsor.com', '', '$2y$10$EGPmxx.x8EVAp502ZSYMKu54l9U9i0uTZifrd3qKatH3dKms9VUqO', 17, '', 'active', ''),
(32, 'James', 'H', 'jamesh@hotmail.com', '', '$2y$10$0lhWZWAzyNrCmxg2gmGM7e3i1mCkH0VxYlDS3wnaJcfTzVGgxzSoe', 17, '', 'deleted', ''),
(33, 'hello', 'test', 'dasdf2@jj.com', '', '$2y$10$rKfTohbcPdx2TcK.3D2O0.yc4cbD6cS6BsUrM7P4mt7X7ywnHhzZ.', 17, '', 'deleted', ''),
(34, 'Jake', 'Doe', 'jaked@hotmail.com', '', '$2y$10$PdOiZlzyZJC8TcGXUpQ/G.CXAncDANUEiThtJddCEj0QK4.wCAdx2', 54, '', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  `emp_id` int(11) NOT NULL,
  `location` varchar(256) NOT NULL,
  `project` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `dow` text NOT NULL,
  `org_id` varchar(256) NOT NULL,
  `project_id` int(11) NOT NULL,
  `color` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_event`, `end_event`, `emp_id`, `location`, `project`, `description`, `dow`, `org_id`, `project_id`, `color`) VALUES
(409, '', '2018-05-29 00:00:00', '2018-06-01 00:00:00', 55, '', '', '', '', '17', 69, ''),
(410, '', '2018-06-05 00:00:00', '2018-06-10 00:00:00', 0, '', '', '', '', '17', 69, ''),
(411, 'Create DR45 Plans', '2018-06-25 09:30:00', '2018-06-28 09:30:00', 0, '', '', '', '', '17', 171, ''),
(412, '', '2018-06-05 00:00:00', '2018-06-06 00:00:00', 94, '', '', '', '', '17', 69, ''),
(413, '', '2018-06-11 00:00:00', '2018-06-13 00:00:00', 55, '', '', '', '', '17', 174, ''),
(414, '', '2018-06-19 00:00:00', '2018-06-23 00:00:00', 0, '', '', '', '', '17', 69, ''),
(415, '', '2018-06-25 03:00:00', '2018-06-29 03:00:00', 13, '', '', '', '', '17', 69, ''),
(416, 'Create H9', '2018-05-28 00:00:00', '2018-05-29 00:00:00', 13, '', '', '', '', '17', 69, ''),
(417, '', '2018-06-06 00:00:00', '2018-06-07 00:00:00', 13, '', '', '', '', '17', 69, ''),
(418, '', '2018-05-29 00:00:00', '2018-06-02 00:00:00', 13, '', '', '', '', '17', 69, ''),
(421, 'Create H9', '2018-06-24 02:30:00', '2018-06-25 02:30:00', 13, '', '', '', '', '17', 69, ''),
(422, '', '2018-06-19 00:00:00', '2018-06-22 00:00:00', 13, '', '', '', '', '17', 69, ''),
(423, '', '2018-06-18 00:00:00', '2018-06-21 00:00:00', 13, '', '', '', '', '17', 172, ''),
(424, 'Finish The 34W Screen', '2018-07-09 00:00:00', '2018-07-12 00:00:00', 23, '', '', 'Buy me some money.', '', '17', 69, ''),
(427, 'Tree 34 Pir Le Function', '2018-07-09 00:00:00', '2018-07-12 00:00:00', 13, '', '', '', '', '17', 69, ''),
(428, 'Website Run Check', '2018-07-03 00:00:00', '2018-07-07 00:00:00', 13, '', '', '', '', '17', 69, ''),
(429, 'ASReaklsj', '2018-07-04 00:00:00', '2018-07-07 00:00:00', 13, '', '', '', '', '17', 174, ''),
(431, '', '2018-07-03 00:00:00', '2018-07-04 00:00:00', 13, '', '', '', '', '17', 69, ''),
(432, '', '2018-07-02 00:00:00', '2018-07-03 00:32:00', 13, '', '', '', '', '17', 69, ''),
(434, '', '2018-07-04 00:00:00', '2018-07-15 00:00:00', 13, '', '', '', '', '17', 71, ''),
(436, '', '2018-07-26 10:00:00', '2018-07-27 02:00:00', 13, '', '', '', '', '17', 69, ''),
(437, '', '2018-07-27 10:00:00', '2018-07-28 02:00:00', 13, '', '', '', '', '17', 69, ''),
(438, '', '2018-07-24 10:00:00', '2018-07-26 02:00:00', 13, '', '', '', '', '17', 69, ''),
(439, 'Bobby', '2018-07-27 10:00:00', '2018-07-28 02:00:00', 13, '', '', '', '', '17', 69, ''),
(440, 'Bobby', '2018-07-24 10:00:00', '2018-07-26 02:00:00', 13, '', '', '', '', '17', 69, ''),
(441, '', '2018-07-04 10:00:00', '2018-07-05 02:00:00', 13, '', '', '', '', '17', 69, ''),
(442, '', '2018-07-26 10:00:00', '2018-07-27 02:00:00', 13, '', '', '', '', '17', 69, ''),
(443, '', '2018-07-20 10:00:00', '2018-07-21 02:00:00', 13, '', '', '', '', '17', 69, ''),
(444, '', '2018-07-25 10:00:00', '2018-07-26 02:00:00', 13, '', '', '', '', '17', 69, ''),
(445, '', '2018-08-02 00:00:00', '2018-08-03 00:00:00', 13, '', '', '', '', '17', 69, ''),
(446, '', '2018-08-01 09:00:00', '2018-08-01 13:00:00', 13, '', '', '', '', '17', 69, ''),
(447, '', '2018-08-12 00:00:00', '2018-08-17 00:00:00', 13, '', '', '', '', '17', 69, ''),
(448, '', '2018-08-12 00:00:00', '2018-08-15 00:00:00', 13, '', '', '', '', '17', 69, '');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `manager_id` int(11) NOT NULL,
  `manager_first` varchar(256) NOT NULL,
  `manager_last` varchar(256) NOT NULL,
  `manager_email` varchar(256) NOT NULL,
  `manager_uid` varchar(256) NOT NULL,
  `manager_pwd` varchar(256) NOT NULL,
  `manager_org_id` int(11) NOT NULL,
  `manager_org_name` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `date_deleted` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`manager_id`, `manager_first`, `manager_last`, `manager_email`, `manager_uid`, `manager_pwd`, `manager_org_id`, `manager_org_name`, `status`, `date_deleted`) VALUES
(6, 'Austin', 'Yates', 'austin555@hotmail.com', 'austinbarbie', '$2y$10$mckcwlK6AEzkxJGhYjxuKOajXEGOkm9JJ6Lf9prlOAcOEtEm3P0oy', 20, 'Barbie Doll', '', '0000-00-00 00:00:00'),
(7, 'Aubrey', 'Yates', 'aubrey@nothsor.com', 'aubrey@nothsor.com', '$2y$10$r/ZG1tDttbPP7hBXzs1l8eEFif94wOpTqlIcxi.xnTaWw.SwymSci', 17, 'Nothsor', 'active', '0000-00-00 00:00:00'),
(8, 'John', 'Fast', 'jf@hotmail.com', 'jf', '$2y$10$4QdajPgBdF8xWmoZXRi6qudJN6cjO4Xf6Nde1SFFmakpuxZPQ0Y8S', 21, 'Aubrey Company 2', '', '0000-00-00 00:00:00'),
(9, 'TimsToolytooler', 'Tooltime', 'timtool@nothsor.com', 'timnothsor', '$2y$10$ueCJgfzHcQdCxLy0IMUXHO7y2YDv0IilQR7OZzvloj7eooSP0y862', 17, 'Nothsor', 'active', '0000-00-00 00:00:00'),
(10, 'AuWWWWWWWWWWWWWWWWWWWWWWWWWW', 'WWERWERWERWERwwwerwerrwerwer', 'asdfe@hotmail.com', '', '$2y$10$hBmvpeRahOq18pLC76h/FOI58GrheCqFhOtpJzmeX9SbiH6WsFOBG', 17, '', 'active', '0000-00-00 00:00:00'),
(11, 'bob', 'joy', 'bobjoy@hotmail.com', '', '$2y$10$6DLtAMXZXMwODh4ShxWG7OAtadOg7FyE5pur6A0JC20mx0lyeYINS', 17, '', 'active', '0000-00-00 00:00:00'),
(12, 'Man', 'Ager', 'manager@hotmail.com', '', '$2y$10$L5NXutnfUOUK61QVyHsXXuFZPreIRTo.WKTQNX5FXdDK/0uLYCUAm', 17, '', 'active', ''),
(13, 'funny', 'run', 'funrun@fn.com', '', '$2y$10$Qi5xPuDxx0LRLyObbUNmauLFHdo0pP3a1bVq9hm/ywJFqZ1Q9TnvC', 17, '', 'active', ''),
(14, 'Ron', 'Domicue', 'DeeeRon99Domicue3333333333333333333333333@yahoo.com', '', '$2y$10$aqoE17flPyQ5yVDD2cX/oeQFTN7j6ea5Ij0/9my8I/0IHp8R9JH0K', 17, '', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `read_status` varchar(256) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_email` varchar(256) NOT NULL,
  `old_date` varchar(256) NOT NULL,
  `new_date` varchar(256) NOT NULL,
  `message` varchar(256) NOT NULL,
  `org_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `read_status`, `emp_id`, `emp_email`, `old_date`, `new_date`, `message`, `org_id`, `event_id`) VALUES
(26, '', 'Yes', 13, '', '', '', 'sd', 17, 417),
(27, '', 'Yes', 13, '', '', '', 'sd', 17, 415),
(28, '', 'Yes', 13, '', '', '', 'How is it going? I would like to ask you to go away. You are a mean man. Go away. You mean.', 17, 423),
(29, '', 'Yes', 13, '', '', '', 'Hi, I will be giving birth to 12 kids on this day. Please pray for me.', 17, 429),
(30, '', 'Yes', 13, '', '', '', 'joe boe hoe toe', 17, 427),
(31, '', 'Yes', 13, '', '', '', 'bjkkj', 17, 428),
(32, '', 'Yes', 13, '', '', '', 'Bob. Yeah.', 17, 17),
(33, '', 'Yes', 13, '', '', '', 'Hey I', 17, 428),
(34, '', 'Yes', 13, '', '', '', 'Go away. you are a pony.', 17, 16),
(35, '', 'Yes', 13, '', '', '2019', '', 17, 428),
(36, '', 'Yes', 13, '', '', '2018-07-26 1:00 AM', '', 17, 428),
(37, '', 'Yes', 13, '', '', ' 1:00 AM', '', 17, 428),
(38, '', 'Yes', 13, '', '', ' 1:00 AM', '', 17, 428),
(39, '', 'Yes', 13, '', '', '2018-07-18 1:00 AM', '', 17, 428),
(40, '', 'No', 13, '', '', '2018-07-05 1:00 AM', '', 17, 436),
(41, '', 'Yes', 13, '', '', '2018-07-31 1:00 AM', '', 17, 438),
(42, '', 'Yes', 13, '', '', '2018-07-31 1:00 AM', 'Goog', 17, 438);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `hours` decimal(11,6) NOT NULL,
  `project_name` varchar(256) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `org_id` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `date_deleted` varchar(256) NOT NULL,
  `job_code` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `hours`, `project_name`, `uid`, `date`, `org_id`, `description`, `status`, `date_deleted`, `job_code`) VALUES
(69, '0.000000', 'Project Freedom 2 3 5 8 9 8', 0, '2018-08-11 00:00:00', 17, 'eeeeee', 'active', '2018-07-06', 'JOB_TEST'),
(72, '0.000000', 'Get Database Backup', 0, '2018-07-18 00:00:00', 17, 'bobby was a man from the moon. \"\" \'', 'active', '2018-06-12 00:00:00', ''),
(73, '0.000000', 'Secret World Domination 2', 0, '2045-06-07 00:00:00', 32, 'Hacked!', 'active', '0000-00-00 00:00:00', 'this is a highly secret code'),
(74, '0.000000', 'Move All T45 Parts ', 17, '2018-06-20 00:00:00', 17, 'AJ likes purple!', 'active', '2018-06-20 00:00:00', 'hands01'),
(128, '0.000000', 'Project Fun Stuff', 17, '0000-00-00 00:00:00', 17, 'Hello, I really love you.', 'active', '2018-06-17 00:00:00', 'fun project'),
(214, '0.000000', 'food from the moon', 17, '0000-00-00 00:00:00', 17, 'Save the homos', 'active', '2018-07-22', ''),
(215, '0.000000', 'Bosten', 17, '0000-00-00 00:00:00', 17, '', 'active', '2018-07-11', ''),
(216, '0.000000', 'WWWWWWWWWWWWWWWWWWWWWWWW6WWWWWWWWWWWWWWWWWWWWWWW', 17, '0000-00-00 00:00:00', 17, '', 'active', '', ''),
(217, '0.000000', 'asdfss', 17, '0000-00-00 00:00:00', 17, '', 'active', '', ''),
(218, '0.000000', 'Eat some bananas', 53, '0000-00-00 00:00:00', 53, '', 'active', '', ''),
(219, '0.000000', 'Create food', 17, '0000-00-00 00:00:00', 17, '', 'active', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `time_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `emp_last` varchar(256) NOT NULL,
  `emp_first` varchar(256) NOT NULL,
  `hours` decimal(11,6) NOT NULL,
  `des` varchar(256) NOT NULL,
  `date` varchar(256) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `p_id`, `emp_last`, `emp_first`, `hours`, `des`, `date`, `emp_id`) VALUES
(231, 18, 'Builder', 'Bob', '1.200000', '0.2', '2018-03-21', 13),
(244, 18, 'Builder', 'Bob', '4.000000', '', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `timeGeneral`
--

CREATE TABLE `timeGeneral` (
  `time_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_org_id` int(11) NOT NULL,
  `time_start` varchar(256) NOT NULL,
  `time_end` varchar(256) NOT NULL,
  `time_stamp` int(11) NOT NULL,
  `date` varchar(256) NOT NULL,
  `hoursTotal` decimal(11,5) NOT NULL,
  `submitted` varchar(256) NOT NULL,
  `breakstart` int(11) NOT NULL,
  `breakend` int(11) NOT NULL,
  `break_id` int(11) NOT NULL,
  `project_name` varchar(256) NOT NULL,
  `project_id` int(11) NOT NULL,
  `time` varchar(256) NOT NULL,
  `des` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `date_deleted` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timeGeneral`
--

INSERT INTO `timeGeneral` (`time_id`, `emp_id`, `emp_org_id`, `time_start`, `time_end`, `time_stamp`, `date`, `hoursTotal`, `submitted`, `breakstart`, `breakend`, `break_id`, `project_name`, `project_id`, `time`, `des`, `status`, `date_deleted`) VALUES
(2185, 13, 17, '', '', 0, '2018-07-15', '0.00000', 'yes', 0, 0, 0, '', 69, '00:00:00', '', 'deleted', '2018-07-15'),
(2186, 13, 17, '1531607703', '1531658400', 0, '2018-07-15', '0.00000', 'yes', 0, 0, 0, '', 69, '14:04.95:00', '', 'deleted', '2018-07-15'),
(2187, 13, 17, '1531647240', '1531656540', 0, '2018-07-15', '0.00000', 'yes', 0, 0, 0, '', 69, '02:35:00', 'Hello`s I want to eat your`s bana` asdf', 'active', ''),
(2188, 13, 17, '1531606980', '1531651500', 0, '2018-07-15', '0.00000', 'yes', 0, 0, 0, '', 69, '12:22:00', '', 'active', ''),
(2189, 13, 17, '1531606980', '', 0, '2018-07-15', '0.00000', 'yes', 0, 0, 0, '', 69, '0-425447:37:00', '', 'deleted', '2018-07-15'),
(2190, 13, 17, '1531728000', '1531742400', 0, '2018-07-16', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2191, 13, 17, '1531728000', '1531742400', 0, '2018-07-16', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2192, 13, 17, '1531728000', '', 0, '2018-07-16', '0.00000', 'yes', 0, 0, 0, '', 69, '0-425480:00:00', '', 'deleted', '2018-07-17'),
(2193, 23, 17, '1531728000', '1531742400', 0, '2018-07-16', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2194, 23, 17, '1531728000', '1531742400', 0, '2018-07-16', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2195, 23, 17, '1531728000', '1531742400', 0, '2018-07-16', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2196, 13, 17, '1531814400', '1531828800', 0, '2018-07-17', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2197, 13, 17, '1531814400', '1531828800', 0, '2018-07-17', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2198, 23, 17, '1531814400', '1531821660', 0, '2018-07-17', '0.00000', 'yes', 0, 0, 0, '', 69, '02:01:00', '', 'active', ''),
(2199, 23, 17, '1531814400', '1531839600', 0, '2018-07-17', '0.00000', 'yes', 0, 0, 0, '', 69, '07:00:00', '', 'active', ''),
(2200, 23, 17, '1531814400', '1531829340', 0, '2018-07-17', '0.00000', 'yes', 0, 0, 0, '', 69, '04:09:00', '', 'active', ''),
(2201, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2202, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2203, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2204, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2205, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2206, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2207, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2208, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2209, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2210, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2211, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2212, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2213, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2214, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2215, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2216, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2217, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2218, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2219, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2220, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2221, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2222, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2223, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2224, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2225, 13, 17, '1531987200', '1532001600', 0, '2018-07-19', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'active', ''),
(2226, 32, 17, '1532295851', '1532295861', 0, '2018-07-22', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:10', '', 'active', ''),
(2227, 32, 17, '1532295910', '1532295927', 0, '2018-07-22', '0.00000', 'yes', 0, 0, 0, '', 74, '00:00:17', '', 'active', ''),
(2228, 32, 17, '1532257200', '1532257260', 0, '2018-07-22', '0.00000', 'yes', 0, 0, 0, '', 74, '00:01:00', '', 'active', ''),
(2230, 29, 17, '1532419200', '1532433600', 0, '2018-07-24', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', 'Hello', 'active', ''),
(2231, 29, 17, '1532419200', '1532433600', 0, '2018-07-24', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', 'Hello \"I really want to eat your face do \" you love me?', 'active', ''),
(2232, 29, 17, '1532419200', '1532433600', 0, '2018-07-24', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', 'Hello \"I really want to eat your face do \" you love me\"', 'active', ''),
(2233, 13, 17, '1532419650', '1532419712', 0, '2018-07-24', '0.00000', 'yes', 0, 0, 0, '', 128, '00:00:51', 'I really want to eat some pink bagels!\" \"', 'active', ''),
(2234, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1532419687, 1532419692, 2233, '', 0, '', '', '', ''),
(2235, 13, 0, '', '', 0, '', '0.00000', 'breakdone', 1532419702, 1532419708, 2233, '', 0, '', '', '', ''),
(2236, 13, 17, '1532419713', '1532419715', 0, '2018-07-24', '0.00000', 'yes', 0, 0, 0, '', 74, '00:00:02', '', 'active', ''),
(2237, 31, 17, '1532592000', '1532606400', 0, '2018-07-26', '0.00000', 'yes', 0, 0, 0, '', 69, '04:00:00', '', 'deleted', '2018-07-26'),
(2238, 13, 17, '1533083623', '1533083819', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 0, '00:03:15', '', 'active', ''),
(2239, 13, 17, '1533083823', '1533083836', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:12', '', 'active', ''),
(2240, 13, 17, '1533083836', '1533083843', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 74, '00:00:07', '', 'active', ''),
(2241, 13, 17, '1533083844', '1533083946', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 128, '00:01:42', '', 'active', ''),
(2242, 13, 17, '1533083947', '1533083966', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 216, '00:00:19', '', 'active', ''),
(2243, 13, 17, '1533083969', '1533083973', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 216, '00:00:04', '', 'active', ''),
(2244, 13, 17, '1533083976', '1533083979', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 216, '00:00:03', '', 'active', ''),
(2245, 13, 17, '1533083997', '1533083999', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:02', '', 'active', ''),
(2246, 13, 17, '1533084000', '1533084009', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 216, '00:00:08', '', 'active', ''),
(2247, 34, 54, '1533148797', '1533148801', 0, '2018-08-01', '0.00000', 'yes', 0, 0, 0, '', 0, '00:00:03', '', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_date` varchar(256) NOT NULL,
  `user_hours` int(11) NOT NULL,
  `org_name` varchar(256) NOT NULL,
  `org_id` int(11) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_date`, `user_hours`, `org_name`, `org_id`, `status`) VALUES
(17, 'Abram', 'Nothnagle', 'abram@hotmail.com', 'abram', '$2y$10$yJ/OEztI7xHMDb0aQCputuRQYR4qn9LCaQ2XnBNUeqe9yEuqHYMui', '', 0, 'Nothsor', 17, 'active'),
(18, 'Aubrey', 'Yates', 'aub@hotmail.com', 'aubrey', '$2y$10$BHy3mCllsrqo/XSAicC8IO/ghcy7MWUXQuukwU2T9PDZNYHdvcCwC', '', 0, 'Nothsor', 17, 'active'),
(19, 'Jake', 'Milder', 'test@gmail.com', 'jmilder', '$2y$10$YIdaGNPaLPWtc2UauAmr/.ce4Qj0qRbVaJfhL1gCmje./HNEysD6y', '', 0, 'jmilder coop', 0, ''),
(20, 'Jake', 'Milder', 'milder@gmail.com', 'New User', '$2y$10$jyDmnZMeUtVnv8n3m8/JceR0Jo9.wDzb9rPtwpirLzoD3ifbHIrzy', '', 0, '<i>Jork</i>', 0, ''),
(21, 'Gore', 'Fore', 'afi@hotmail.com', 'gorefore', '$2y$10$qih4pbd5oDvYFo/F12tDseWySOS2/Qad4pha5YcYkLtjMGA09LPvi', '', 0, '', 17, ''),
(22, 'Je', 'On', 'jeon@oh.com', 'dsiiw', '$2y$10$DnSDPIdLz9.EAcpZ8pi4ZuaJTlApj1sS47GrjENxUCV3cITUaK1fK', '', 0, '', 17, ''),
(23, 'Cosmos', 'Lional', 'cs@hotmail.com', 'fuqboi', '$2y$10$Q7ATUb7Ucbc4kVnxEuzUeeWB4kHoqPG248kdZBmQvq/iijLFkH5ZO', '', 0, 'tinderpluscompany', 21, ''),
(24, 'goog', 'lle', 'asd@htma.com', 'gllit', '$2y$10$mhpZVeyvXetbKRB7RxfSnenLlFt2.Ddc7j14RhCLzJvFDOAZMogUC', '', 0, 'coie', 0, ''),
(25, 'asda', 'sds', 'asiojwi@ho.com', 'akjs', '$2y$10$VXYqyRMjum15mBwOznM3meu0DDWEDkpi6AtY482Cb6TSpiodP385G', '', 0, 'gera', 0, ''),
(26, 'asd', 'asdaa', 'ask@hoam.com', 'kja', '$2y$10$LLxuW0a2rwCpTVnDKQNtzOtr1BPyMP5JIDsfkQ19QVIxznEe1AuC2', '', 0, '', 26, ''),
(27, 'asda', 'asdw', 'asd@jo.com', 'jkah', '$2y$10$QmMj.GnmolEGF/OyO0.F4ubWvXMW/GCwdlRSarOvt.9rOG4c9OeEy', '', 0, '', 27, ''),
(28, 'asda', 'asdw', 'asd@jo.com', 'sdfsfd', '$2y$10$nKiQNRk.EOEsGDh76h7/POGL.6Kh9hUSNQoIfvlCEYE12hwQapj2q', '', 0, '', 28, ''),
(29, 'asda', 'asdw', 'asd@jo.com', 'sdsaa', '$2y$10$bIzmKgwmnhlBPHx4tGme2umX7vgIoQIvITQb1r3sqRnYsImM.Jghi', '', 0, '', 29, ''),
(30, 'zfd', 'ads', 'as22@joijo.com', 'foo', '$2y$10$95AOH3o/3cEfXaVMY40pm.7LKoy0.9w8llP3wZlCqDuconieuuE9y', '', 0, '', 30, ''),
(31, 'dfdsds', 'sdfdsdf', 'sdf@hotmail.com', 'ak', '$2y$10$E5ILaaIaqsAu59ijuIC.eeJYb3ODy70BBwIOm4wCsxfPTZ2JE9cDa', '', 0, '', 31, ''),
(32, 'Kit', 'Kat', 'kitkat@kit.com', 'life_ruler', '$2y$10$ULOVnCDypomunz3FXwxho.iX5sV56xLBQ..E7vLoUlZkPJH88OyZC', '', 0, '', 32, ''),
(33, 'saf', 'fasds', 'w2asf@joh.ee.com', '', '$2y$10$vrPjxxb32kpmLdHvWFU5H.HKlnOXPOfAZEplvhzkj5G1MGvfHfJ6O', '', 0, '', 17, ''),
(34, 'Ron', 'Bee', 'dee@dee.com', '', '$2y$10$LqVAVst05eTJ0yYSLSuG0u5IuHhrS51dgzMqYsD5w1f4.1cPPkEDG', '', 0, '', 34, ''),
(35, 'Bobby', 'Booob', 'boby@hotmail.com', '', '$2y$10$TpPz8pDtbfzuHft/shi/LuagHqGTxqtYqzClRbJey6LJpYUyzmxmy', '', 0, '', 35, ''),
(36, 'Boob', 'asdf', 't@ds.com', '', '$2y$10$q0sEJx.dHGwQAOpDfDyi2O/it38zbtYfVwy2QHQBK8O7jgtiHAZAe', '', 0, '', 36, ''),
(41, 'asdf', 'asdf', 'abram@hotmasil.com', '', '$2y$10$o.Iky4AcPPZ84sSar53p4OP0mZG.MmtVBRsIMbbeDGfpqtaWNxqP6', '', 0, '', 41, ''),
(42, 'asdfasdf', 'asdfasd', 'adfasdf@homtail.com', '', '$2y$10$Q7vNPy7ZEsRhtSctPixrAekM4RS42ZxvK8eVmibIHX3tSpcRw0n46', '', 0, '', 42, ''),
(43, 'asdfasdf', 'asdfasd', 'adfasdf@homstail.com', '', '$2y$10$1Tr57SfIFiF2GR5fEH4OJu56kpsMCtUI3RuF3vJHE1kOSoeX2VCsm', '', 0, '', 43, ''),
(44, 'Bob', 'Yates', 'hugs@hugs.com', '', '$2y$10$9yzVmxtwNagmEBSCPj7ZU.7idYxIMSRX30WY80Dsaiq95FdGCjWdm', '', 0, '', 44, ''),
(45, 'asdf', 'asdf', 'asdfs-asd@jos.com', '', '$2y$10$AxHBbVkdUiZEQA.Qv72ZMOVlOeqhN3OTKIaVh1Y2ubp0OsSTyvrVy', '', 0, '', 45, ''),
(46, 'Chris', 'Ron', 'cr@hotmail.com', '', '$2y$10$2TfKGmHAvX.uEdNuLTbZOO8xYbUN8hfAD7RjiSjrwZGLwsopZADnS', '', 0, '', 46, 'active'),
(47, 'God', 'TheCreator', 'god@nothsor.com', '', '$2y$10$scH0I1.ftSjorIaksRyqbee2C0DVtj2CB7sZQpkKZqN4kgO2cY7Fq', '', 0, '', 17, 'active'),
(48, 'Booooortitnitsssss', 'YYYWWWASDFASDFASDFASDFASDF', 'SDSDSdsdsdsdsmkdlmksmdklmdksmdk@mms.com', '', '$2y$10$ZZTn2krioeJBI66eApkAcOHJWOnwVUUkwB0Rhtl/D3e6CLepIWea2', '', 0, '', 17, 'active'),
(49, 'asdfsadfasfasdfasdfasdfasdf', 'asfdsadfasdfasdfasdfasdfasdf', 'wwwwwwwwwfwwwwwwwQQQQQQQWWWWWW@JOC.COM', '', '$2y$10$eTmXGZ.1ewIhC0osR9I7LeMYplX84Zc.GuuP1NZxu5bbXjsRf7Ry.', '', 0, '', 17, 'deleted'),
(50, 'Josh', 'Doe', 'joshdoe@hotmail.com', '', '$2y$10$OEjGYH5ml4bYkfCFbiPVJeYX4jSvUrKoKtyhs9.Vze680rhWH1FNu', '', 0, '', 50, 'active'),
(51, 'god', 'good', 'goood@god.com', '', '$2y$10$IikNRPju7CMc8IbnIpfpv.wO3BJTGUV4ZxOoqrRS9/ksh3JO/rdEW', '', 0, '', 17, 'active'),
(52, 'Admin', 'Admin', 'admin@nothsor.com', '', '$2y$10$T2I/Xt/utaPtjFx0mG8DwOG4oEonD0W6bqvp32KF2fjHZ0jX4.50e', '', 0, '', 17, 'deleted'),
(53, 'asdf', 'go', 'we@hotmail.com', '', '$2y$10$rgHZ/2a7wmoQqo5.7MIB4OdfznZgaxWlHUqHtNflwIr7AfxaL903.', '', 0, '', 53, 'active'),
(54, 'John', 'Doe', 'johnd@hotmail.com', '', '$2y$10$Fyga1Tz6s09OxO3NL66i4OdBluDAD/vTyFeBU5mSuAWH5TG6tso/i', '', 0, '', 54, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_employees`
--
ALTER TABLE `assignment_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_managers`
--
ALTER TABLE `assignment_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_events`
--
ALTER TABLE `company_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_info_and_settings`
--
ALTER TABLE `company_info_and_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `timeGeneral`
--
ALTER TABLE `timeGeneral`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment_employees`
--
ALTER TABLE `assignment_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `assignment_managers`
--
ALTER TABLE `assignment_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;
--
-- AUTO_INCREMENT for table `company_events`
--
ALTER TABLE `company_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `company_info_and_settings`
--
ALTER TABLE `company_info_and_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;
--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;
--
-- AUTO_INCREMENT for table `timeGeneral`
--
ALTER TABLE `timeGeneral`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2248;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;";

$conn->query($sql);