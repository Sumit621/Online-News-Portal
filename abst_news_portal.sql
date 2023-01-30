-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2022 at 03:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abst_news_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `NID` int(11) NOT NULL,
  `Comment` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CID`, `UID`, `NID`, `Comment`) VALUES
(1, 1, 2, 'Do not use any bad words in the comments'),
(3, 2, 2, 'Nice news'),
(4, 3, 2, 'good information'),
(5, 4, 4, 'I can fix this'),
(6, 5, 4, 'Leave it be'),
(7, 5, 5, 'Good day everyone');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `NID` int(11) NOT NULL,
  `Headline` varchar(200) NOT NULL,
  `Body` varchar(2000) NOT NULL,
  `Thumbnail` varchar(100) NOT NULL,
  `Img_paths` varchar(1000) NOT NULL,
  `Time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`NID`, `Headline`, `Body`, `Thumbnail`, `Img_paths`, `Time`) VALUES
(2, 'Students hate exams', 'Due to the extreme things happening in exam halls as well as the unwillingness to study, the students are facing huge difficulties in the exam halls. Students are often found overwhelmed at the exam hall. More updates on the matter has to be made as soon as possible as things are turning almost intolerable. ', 'static/mrbeanexam.jpg', 'static/exam_crt.jpg,static/examstats.jpg', '2022-09-04 23:48:25'),
(4, 'PCs at the university often found unusable', 'The Desktop Computers used in the classrooms are often found to be very problematic. The processors of the PCs are very slow and often drivers are not updated. Even the display was found not to work at certain times leaving the teachers frustrated but the students amused.', 'static/slowing-down-pc.jpg', 'static/bckgrndapps.jpg,static/cmp.gif,static/dels32.jpg', '2022-09-05 13:51:57'),
(5, 'Students are confused about their career', 'While the prospect of sitting all day in front of a cool desktop setup and living the hacker life earning tons of money, may sound very alluring, the students studying computer science are starting to realize that the grass is not always greener on the other side. The supposed dream of living the dream IT life quickly turned into a nightmare for them. Many students are losing interest in the subject and as a result are left frustrated and confused about their career.', 'static/5oue1y.jpg', 'static/progsheldon.jpg,static/Spongebob.jpg', '2022-09-05 00:23:59'),
(6, 'University location is in a hub of traffic', 'The location of the university in a very traffic heavy region of the city has been a concern for some time. The roads leading to the university are the routes of multiple Bus Poribohons which is the main cause of such intolerable traffic. Both the teachers and students are facing difficulties with travelling to the university as a result.', 'static/jambd.jpg', 'static/teslaAP.jpg,static/traffic-jam-stuck-in-traffic.gif', '2022-09-05 13:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `is_Admin` tinyint(1) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Img_path` varchar(100) DEFAULT 'static/defaultpfp.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `User_Name`, `Password`, `is_Admin`, `DOB`, `Img_path`) VALUES
(1, 'admin', '$2y$10$EhJFmC4DSqKp.quC6mA1eurKSBfy1c.dE3MAXQdEtaE.yCnzwoz0G', 1, NULL, ''),
(2, 'Sumit', '$2y$10$bNAeqwEqHap4AfVR.Wdb7OUzO5io0/eKR09qR7Yngp7ifF7ExyRBi', 0, '1999-07-03', 'static/Formal sq.jpg'),
(3, 'tom', '$2y$10$RniRRJNSt5sVUXMofALJGeYk/bdLYpPlHv/9JbLdGlfuJK9JqDMCO', 0, '1995-05-06', 'static/defaultpfp.jpg\r\n'),
(4, 'Chad', '$2y$10$ieP6dDkWJY7pLWHSXhwobOtfFhIqJjgcZVyiFSvBfaD19iqlG15om', 0, '0000-00-00', 'static/GigaChad.png'),
(5, 'Peter', '$2y$10$itcfhTv1LcpI/QVYP./YWOiuYsfg8fMc6cMpo0RCLaFFiJeUM1nEG', 0, '0000-00-00', 'static/Peter_Griffin_sq.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CID`),
  ADD UNIQUE KEY `CID` (`CID`),
  ADD KEY `uid_foreign_key` (`UID`),
  ADD KEY `nid_foreign_key` (`NID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`NID`),
  ADD UNIQUE KEY `NID` (`NID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `User_Name` (`User_Name`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `nid_foreign_key` FOREIGN KEY (`NID`) REFERENCES `news` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uid_foreign_key` FOREIGN KEY (`UID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
