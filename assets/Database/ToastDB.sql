-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 10:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

CREATE DATABASE ToastDB;

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

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

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
(1, 'Post Title 1', 'Recipe description for post 1', 'Post content for post 1', 21, 0, '../data/postImages/GPID-1.png', 1, 1),
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
(21, 'Post Title 21', 'Recipe description for post 21', 'Post content for post 21', 60, 0, '../data/postImages/GPID-1.png', 5, 0),
(22, 'Post Title 22', 'Recipe description for post 22', 'Post content for post 22', 45, 0, '../data/postImages/GPID-1.png', 5, 0),
(23, 'Post Title 23', 'Recipe description for post 23', 'Post content for post 23', 29, 0, '../data/postImages/GPID-1.png', 5, 0),
(24, 'Post Title 24', 'Recipe description for post 24', 'Post content for post 24', 32, 0, '../data/postImages/GPID-1.png', 5, 0),
(25, 'Post Title 25', 'Recipe description for post 25', 'Post content for post 25', 36, 0, '../data/postImages/GPID-1.png', 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Post_ID`),
  ADD KEY `Profile_ID` (`Profile_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `Post_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`Profile_ID`) REFERENCES `profile` (`Profile_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
