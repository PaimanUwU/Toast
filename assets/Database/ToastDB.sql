-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 09:24 AM
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
-- Database: `toastdb`
--
CREATE DATABASE IF NOT EXISTS `toastdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `toastdb`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Email` varchar(255) NOT NULL,
  `Admin_Password` varchar(255) NOT NULL,
  `Admin_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Email`, `Admin_Password`, `Admin_Name`) VALUES
(1, 'admin1@example.com', 'admin', 'Adi'),
(2, 'admin2@example.com', 'admin', 'Zuhayr');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

DROP TABLE IF EXISTS `follower`;
CREATE TABLE `follower` (
  `Follower_ID` int(11) NOT NULL,
  `Follower_Profile_ID` int(11) DEFAULT NULL,
  `Followee_Profile_ID` int(11) DEFAULT NULL,
  `Follow_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `Post_ID` int(11) NOT NULL,
  `Post_Title` varchar(255) NOT NULL,
  `Post_Desc` text DEFAULT NULL,
  `Post_Content` text NOT NULL,
  `Post_Likes` int(11) DEFAULT 0,
  `Post_Dislikes` int(11) DEFAULT 0,
  `Post_Image_Path` text DEFAULT NULL,
  `Profile_ID` int(11) DEFAULT NULL,
  `Post_Tag_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(1, 'Post Title 1', 'Recipe description for post 1', 'Post content for post 1', 103, 0, '../data/postImages/GPID-1.png', 1, 1),
(2, 'Post Title 2', 'Recipe description for post 2', 'Post content for post 2', 16, 0, '../data/postImages/GPID-1.png', 1, 1),
(3, 'Post Title 3', 'Recipe description for post 3', 'Post content for post 3', 30, 0, '../data/postImages/GPID-1.png', 1, 2),
(4, 'Post Title 4', 'Recipe description for post 4', 'Post content for post 4', 10, 0, '../data/postImages/GPID-1.png', 1, 2),
(5, 'Post Title 5', 'Recipe description for post 5', 'Post content for post 5', 25, 0, '../data/postImages/GPID-1.png', 1, 3),
(6, 'Post Title 6', 'Recipe description for post 6', 'Post content for post 6', 19, 0, '../data/postImages/GPID-1.png', 2, 3),
(7, 'Post Title 7', 'Recipe description for post 7', 'Post content for post 7', 22, 0, '../data/postImages/GPID-1.png', 2, 0),
(8, 'Post Title 8', 'Recipe description for post 8', 'Post content for post 8', 27, 0, '../data/postImages/GPID-1.png', 2, 0),
(9, 'Post Title 9', 'Recipe description for post 9', 'Post content for post 9', 35, 0, '../data/postImages/GPID-1.png', 2, 0),
(10, 'Post Title 10', 'Recipe description for post 10', 'Post content for post 10', 40, 0, '../data/postImages/GPID-1.png', 2, 0),
(11, 'Post Title 11', 'Recipe description for post 11', 'Post content for post 11', 33, 0, '../data/postImages/GPID-1.png', 3, 0),
(12, 'Post Title 12', 'Recipe description for post 12', 'Post content for post 12', 28, 0, '../data/postImages/GPID-1.png', 3, 0),
(13, 'Post Title 13', 'Recipe description for post 13', 'Post content for post 13', 17, 0, '../data/postImages/GPID-1.png', 3, 0),
(14, 'Post Title 14', 'Recipe description for post 14', 'Post content for post 14', 19, 0, '../data/postImages/GPID-1.png', 3, 0),
(15, 'Post Title 15', 'Recipe description for post 15', 'Post content for post 15', 24, 0, '../data/postImages/GPID-1.png', 3, 0),
(16, 'Post Title 16', 'Recipe description for post 16', 'Post content for post 16', 38, 0, '../data/postImages/GPID-1.png', 4, 0),
(17, 'Post Title 17', 'Recipe description for post 17', 'Post content for post 17', 42, 0, '../data/postImages/GPID-1.png', 4, 0),
(18, 'Post Title 18', 'Recipe description for post 18', 'Post content for post 18', 31, 0, '../data/postImages/GPID-1.png', 4, 0),
(19, 'Post Title 19', 'Recipe description for post 19', 'Post content for post 19', 27, 0, '../data/postImages/GPID-1.png', 4, 0),
(20, 'Post Title 20', 'Recipe description for post 20', 'Post content for post 20', 37, 0, '../data/postImages/GPID-1.png', 4, 0),
(21, 'Post Title 21', 'Recipe description for post 21', 'Post content for post 21', 61, 0, '../data/postImages/GPID-1.png', 5, 0),
(22, 'Post Title 22', 'Recipe description for post 22', 'Post content for post 22', 45, 0, '../data/postImages/GPID-1.png', 5, 0),
(23, 'Post Title 23', 'Recipe description for post 23', 'Post content for post 23', 29, 0, '../data/postImages/GPID-1.png', 5, 0),
(24, 'Post Title 24', 'Recipe description for post 24', 'Post content for post 24', 32, 0, '../data/postImages/GPID-1.png', 5, 0),
(25, 'Post Title 25', 'Recipe description for post 25', 'Post content for post 25', 36, 0, '../data/postImages/GPID-1.png', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

DROP TABLE IF EXISTS `post_comment`;
CREATE TABLE `post_comment` (
  `Post_Comment_ID` int(11) NOT NULL,
  `Post_Comment_Content` text NOT NULL,
  `Profile_ID` int(11) DEFAULT NULL,
  `Post_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`Post_Comment_ID`, `Post_Comment_Content`, `Profile_ID`, `Post_ID`) VALUES
(1, 'Comment 1 for post 1', 1, 1),
(2, 'Comment 2 for post 1', 2, 1),
(3, 'Comment 3 for post 1', 3, 1),
(4, 'Comment 1 for post 2', 1, 2),
(5, 'Comment 2 for post 2', 2, 2),
(6, 'Comment 3 for post 2', 3, 2),
(7, 'Comment 1 for post 3', 1, 3),
(8, 'Comment 2 for post 3', 2, 3),
(9, 'Comment 3 for post 3', 3, 3),
(10, 'Comment 1 for post 4', 1, 4),
(11, 'Comment 2 for post 4', 2, 4),
(12, 'Comment 3 for post 4', 3, 4),
(13, 'Comment 1 for post 5', 1, 5),
(14, 'Comment 2 for post 5', 2, 5),
(15, 'Comment 3 for post 5', 3, 5),
(16, 'Comment 1 for post 6', 2, 6),
(17, 'Comment 2 for post 6', 3, 6),
(18, 'Comment 3 for post 6', 4, 6),
(19, 'Comment 1 for post 7', 2, 7),
(20, 'Comment 2 for post 7', 3, 7),
(21, 'Comment 3 for post 7', 4, 7),
(22, 'Comment 1 for post 8', 2, 8),
(23, 'Comment 2 for post 8', 3, 8),
(24, 'Comment 3 for post 8', 4, 8),
(25, 'Comment 1 for post 9', 2, 9),
(26, 'Comment 2 for post 9', 3, 9),
(27, 'Comment 3 for post 9', 4, 9),
(28, 'Comment 1 for post 10', 2, 10),
(29, 'Comment 2 for post 10', 3, 10),
(30, 'Comment 3 for post 10', 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `post_history`
--

DROP TABLE IF EXISTS `post_history`;
CREATE TABLE `post_history` (
  `Post_History_ID` int(11) NOT NULL,
  `Post_History_Date` date NOT NULL,
  `Post_History_Time` time NOT NULL,
  `Post_ID` int(11) DEFAULT NULL,
  `Profile_ID` int(11) DEFAULT NULL,
  `Post_isLike` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_history`
--

INSERT INTO `post_history` (`Post_History_ID`, `Post_History_Date`, `Post_History_Time`, `Post_ID`, `Profile_ID`, `Post_isLike`) VALUES
(9, '2024-06-20', '18:06:41', 21, 1, 1),
(10, '2024-06-20', '18:24:08', 1, 1, 1),
(11, '2024-06-20', '18:24:21', 17, 1, 0),
(12, '2024-06-20', '18:24:24', 22, 1, 1),
(13, '2024-06-20', '18:31:13', 24, 1, 0),
(14, '2024-06-20', '18:33:12', 19, 1, 1),
(15, '2024-06-20', '19:05:21', 11, 1, 0),
(16, '2024-06-20', '19:24:17', 15, 1, 0),
(17, '2024-06-20', '19:24:42', 2, 1, 1),
(18, '2024-06-20', '19:24:49', 3, 1, 0),
(19, '2024-06-20', '19:25:21', 10, 1, 0),
(20, '2024-06-20', '19:26:01', 16, 1, 0),
(21, '2024-06-20', '19:39:15', 13, 1, 0),
(22, '2024-06-20', '20:29:54', 9, 1, 0),
(34, '2024-06-27', '18:50:00', 1, 8, 1),
(35, '2024-06-29', '07:07:24', 21, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `Profile_ID` int(11) NOT NULL,
  `Profile_Name` varchar(255) DEFAULT NULL,
  `Profile_Email` varchar(255) NOT NULL,
  `Profile_Desc` text DEFAULT NULL,
  `Profile_Password` varchar(255) NOT NULL,
  `Profile_Image_Path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`Profile_ID`, `Profile_Name`, `Profile_Email`, `Profile_Desc`, `Profile_Password`, `Profile_Image_Path`) VALUES
(1, 'Jimi Hendrix', 'jimi@example.com', 'Legendary guitarist known for his iconic performances.', 'asdf', '../data/profileImages/GUID-1.png'),
(2, 'Eric Clapton', 'eric@example.com', 'Renowned guitarist with a distinguished career spanning decades.', 'asdf', '../data/profileImages/GUID-1.png'),
(3, 'Jimmy Page', 'jimmy@example.com', 'Legendary guitarist and founder of Led Zeppelin.', 'asdf', '../data/profileImages/GUID-1.png'),
(4, 'Slash', 'slash@example.com', 'Iconic guitarist known for his work with Guns N Roses and Velvet Revolver.', 'asdf', '../data/profileImages/GUID-1.png'),
(5, 'Eddie Van Halen', 'eddie@example.com', 'Innovative guitarist known for his technical prowess and influential style.', 'asdf', '../data/profileImages/GUID-1.png'),
(8, 'Kucing :3', 'asdf@example.com', 'saya seekor kucing yang sedang membaca buku meow meow :3', 'asdf', '../data/profileImages/GPID-8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `Tag_ID` int(11) NOT NULL,
  `Tag_Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`Tag_ID`, `Tag_Category`) VALUES
(15, '#Avocado Toast'),
(24, '#Bacon'),
(13, '#Bagels'),
(29, '#Biscuits'),
(17, '#Breakfast Bowls'),
(5, '#Breakfast Burritos'),
(11, '#Breakfast Casseroles'),
(25, '#Breakfast Pizza'),
(30, '#Breakfast Salad'),
(8, '#Breakfast Sandwiches'),
(20, '#Breakfast Tacos'),
(26, '#Chia Pudding'),
(12, '#Crepes'),
(21, '#Croissants'),
(6, '#French Toast'),
(14, '#Frittatas'),
(7, '#Granola'),
(19, '#Hash Browns'),
(9, '#Muffins'),
(16, '#Oatmeal'),
(3, '#Omelettes'),
(1, '#Pancakes'),
(10, '#Quiche'),
(23, '#Sausages'),
(28, '#Scones'),
(18, '#Scrambled Eggs'),
(27, '#Smoothie Bowls'),
(4, '#Smoothies'),
(2, '#Waffles'),
(22, '#Yogurt Parfaits');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`Follower_ID`),
  ADD KEY `Follower_Profile_ID` (`Follower_Profile_ID`),
  ADD KEY `Followee_Profile_ID` (`Followee_Profile_ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Post_ID`),
  ADD KEY `Profile_ID` (`Profile_ID`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`Post_Comment_ID`),
  ADD KEY `Profile_ID` (`Profile_ID`),
  ADD KEY `Post_ID` (`Post_ID`);

--
-- Indexes for table `post_history`
--
ALTER TABLE `post_history`
  ADD PRIMARY KEY (`Post_History_ID`),
  ADD KEY `Post_ID` (`Post_ID`),
  ADD KEY `Profile_ID` (`Profile_ID`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`Profile_ID`),
  ADD UNIQUE KEY `Profile_Email` (`Profile_Email`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`Tag_ID`),
  ADD UNIQUE KEY `Tag_Category` (`Tag_Category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `follower`
--
ALTER TABLE `follower`
  MODIFY `Follower_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `Post_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `Post_Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `post_history`
--
ALTER TABLE `post_history`
  MODIFY `Post_History_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `Profile_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `Tag_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `follower_ibfk_1` FOREIGN KEY (`Follower_Profile_ID`) REFERENCES `profile` (`Profile_ID`),
  ADD CONSTRAINT `follower_ibfk_2` FOREIGN KEY (`Followee_Profile_ID`) REFERENCES `profile` (`Profile_ID`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`);

--
-- Constraints for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`),
  ADD CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`Post_ID`) REFERENCES `post` (`Post_ID`);

--
-- Constraints for table `post_history`
--
ALTER TABLE `post_history`
  ADD CONSTRAINT `post_history_ibfk_1` FOREIGN KEY (`Post_ID`) REFERENCES `post` (`Post_ID`),
  ADD CONSTRAINT `post_history_ibfk_2` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
