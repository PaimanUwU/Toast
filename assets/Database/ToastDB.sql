-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 03:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

DROP DATABASE IF EXISTS `toastdb`;

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

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Email` varchar(255) NOT NULL,
  `Admin_Password` varchar(255) NOT NULL,
  `Admin_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `Post_Comment_ID` int(11) NOT NULL,
  `Post_Comment_Content` text NOT NULL,
  `Profile_ID` int(11) DEFAULT NULL,
  `Post_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_history`
--

CREATE TABLE `post_history` (
  `Post_History_ID` int(11) NOT NULL,
  `Post_History_Date` date NOT NULL,
  `Post_History_Time` time NOT NULL,
  `Post_ID` int(11) DEFAULT NULL,
  `Profile_ID` int(11) DEFAULT NULL,
  `Post_isLike` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_report`
--

CREATE TABLE `post_report` (
  `post_report_ID` int(11) NOT NULL,
  `post_report_reason` text NOT NULL,
  `profile_ID` int(11) NOT NULL,
  `post_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `Profile_ID` int(11) NOT NULL,
  `Profile_Name` varchar(255) DEFAULT NULL,
  `Profile_Email` varchar(255) NOT NULL,
  `Profile_Desc` text DEFAULT NULL,
  `Profile_Password` varchar(255) NOT NULL,
  `Profile_Image_Path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `Tag_ID` int(11) NOT NULL,
  `Tag_Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `post_report`
--
ALTER TABLE `post_report`
  ADD PRIMARY KEY (`post_report_ID`),
  ADD KEY `Profile_ID` (`profile_ID`) USING BTREE,
  ADD KEY `Post_ID` (`post_ID`) USING BTREE;

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
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follower`
--
ALTER TABLE `follower`
  MODIFY `Follower_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `Post_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `Post_Comment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_history`
--
ALTER TABLE `post_history`
  MODIFY `Post_History_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_report`
--
ALTER TABLE `post_report`
  MODIFY `post_report_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `Profile_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `Tag_ID` int(11) NOT NULL AUTO_INCREMENT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



INSERT INTO `profile` (`Profile_ID`, `Profile_Name`, `Profile_Email`, `Profile_Desc`, `Profile_Password`, `Profile_Image_Path`) VALUES
(1, 'Mark Lee', 'markspace@gmail.com', 'Singer of a korean boy band', 'NCT', '../data/profileImages/GUID-1.jpeg'),
(2, 'Leeyana Rahman', 'leeyanarahman@example.com', 'Founder of the LeeyanaRahmans Baju Kurung', 'asdf', '../data/profileImages/GUID-2.jpeg'),
(3, 'Ivy Martines', 'ivy.martinez@example.com', 'Chef specializing in breakfast pastries and baked goods.', 'asdf', '../data/profileImages/GUID-3.jpeg'),
(4, 'Khairul Aming', 'khairulaming@yahoo.com', 'An influencer and blogger who loves sharing creative and fun recipes', 'asdf', '../data/profileImages/GUID-4.jpg'),
(5, 'Farah Izzati', 'farahizzati04@gmail.com', 'A housewife that loves to explore new recipes that are quick and easy!', 'asdf', '../data/profileImages/GUID-5.jpg'),
(6, 'Muhammad Hazrif', 'm.hazrif@example.com', 'Culinary student experimenting with diverse breakfast recipes.', 'asdf', '../data/profileImages/GUID-6.jpeg'),
(7, 'Laura Belle', 'laura.belle@example.com', 'Nutritionist promoting balanced and healthy breakfast options.', 'asdf', '../data/profileImages/GUID-7.jpeg'),
(8, 'Aisy Rose', 'aisy.rose@yahoo.com', 'A university student who loves to explore new recipes that are quick and easy!', 'asdf', '../data/profileImages/GUID-8.jpg'),
(9, 'Riaz Altair', 'riaz.altair@example.com', 'Barista and breakfast lover sharing coffee pairings and recipes.', 'asdf', '../data/profileImages/GUID-9.jpeg'),
(10, 'Zafriel Anaqi', 'zafrielanaqi@example.com', 'Influencer and food photographer loves capturing beautiful and aesthetically breakfast dishes.', 'asdf', '../data/profileImages/GUID-10.jpg'),
(11, 'Wan Hafiz', 'wanhafiz@gmail.com', 'A teacher who cooks during free time.', 'asdf', '../data/profileImages/GUID-11.jpeg'),
(12, 'Afiq Shazwan', 'afiqshazwan@yahoo.com', 'A part time student and cafe barista.', 'asdf', '../data/profileImages/GUID-12.jpg'),
(13, 'Muhammad Ahnaf', 'muhammadahnaf@gmail.com', 'A fireman who cook for their team.', 'asdf', '../data/profileImages/GUID-13.jpg'),
(14, 'Shamer Hidayat', 'syamerhidayat@gmail.com', 'A math teacher exploring food recipes with specific measurements.', 'asdf', '../data/profileImages/GUID-14.jpg'),
(15, 'Nurul Sakinah', 'nurulsakinah@gmail.com', 'A medical student who bakes during free time', 'asdf', '../data/profileImages/GUID-15.jpg'),
(16, 'Hanis Suraya', 'hanissuraya@yahoo.com', 'A chef in war camp', 'asdf', '../data/profileImages/GUID-16.jpg'),
(17, 'Syarifah Kirana', 'syarifahkirana@yahoo.com', 'A full-time wife who loves to discover authentic food recipes', 'asdf', '../data/profileImages/GUID-17.jpeg'),
(18, 'Zalikha Yuhanis', 'zalikhayuhanis@gmail.com', 'Traditional midwife', 'asdf', '../data/profileImages/GUID-18.jpg'),
(19, 'Muhammad Yunus', 'muhdyunus@example.com', 'Single father trying to learn how to cook', 'asdf', '../data/profileImages/GUID-19.jpg'),
(20, 'Zamirul Shahrin', 'zamirul@example.com', 'Exploring new things', 'asdf', '../data/profileImages/GUID-20.jpg'),
(21, 'Fahmi Haiqal', 'fahmihql@example.com', 'Foodie', 'asdf', '../data/profileImages/GUID-21.jpg'),
(22, 'Ariffin', 'ipin@example.com', 'Breakfast enthusiast', 'asdf', '../data/profileImages/GUID-22.jpg'),
(23, 'Faiz', 'faiz@example.com', 'A chef at a cafe experimenting with new recipes', 'asdf', '../data/profileImages/GUID-23.jpg'),
(24, 'Kamalrudin', 'kamalrudin@gmail.com', 'A veteran soldier', 'asdf', '../data/profileImages/GUID-24.jpg'),
(25, 'Farryn Anastasia', 'farrynanastasia@gmail.com', 'Mathematics degree student that cooks often to save money', 'asdf', '../data/profileImages/GUID-25.jpg'),
(26, 'Fikri Izwan', 'fikriizwan@gmail.com', 'Gym coach who practices eat clean', 'asdf', '../data/profileImages/GUID-26.jpg'),
(27, 'Vivy Ishak', 'vivyishak@gmail.com', 'Hijab founder', 'asdf', '../data/profileImages/GUID-27.jpg'),
(28, 'Caca Jauhari', 'cacajauhari@gmail.com', 'Female singer on diet', 'asdf', '../data/profileImages/GUID-28.jpg'),
(29, 'Durrani Jasmine', 'durranijasmine@gmail.com', 'Third year degree student in fashion', 'asdf', '../data/profileImages/GUID-29.jpg'),
(30, 'Nayli Wahidah', 'nayliwahidah@gmail.com', 'Anti-Childabuse TikTok Influencer', 'asdf', '../data/profileImages/GUID-30.jpg');



-- post data



INSERT INTO `post_comment` (`Post_Comment_ID`, `Post_Comment_Content`, `Profile_ID`, `Post_ID`) VALUES
(1,'Classic French toast with a twist. Loved it!','1','29'),
(2,'I love these hash brown omelets. So yummy!','2','35'),
(3,'This peanut butter banana smoothie is so refreshing and easy to make.','3','56'),
(4,'Crepes with Nutella? Yes, please!','4','26'),
(5,'This the best scrambled eggs I have ever had!','5','1'),
(6,'The tomatoes and basil soup was delicious and easy to make.','6','10'),
(7,'This on-the-run breakfast bar is now my go-to recipe.','7','34'),
(8,'The pancakes were delicious and fluffy. Perfect!','8','44'),
(9,'The breakfast burrito was hearty and filling. Great recipe!','9','11'),
(10,'The homemade casserole was a hit with my family.','10','14'), 
(11,'This is the best breakfast recipe!','11','1'),
(12,'Yummy!','12','2'),
(13,'Try it today and it turned out really well! Savory avocado spread really match with the poached egg on top! ','13','2'),
(14,'Perfect combination of crispy chicken bacon with creamy potato skillet!','14','4'),
(15,'Forever my favorite breakfast wrap idea.','15','3'),
(16,'This recipe is 100% worth trying! But dont expect success on the first try, the process of perfect bagel does take time but is really worth it!','16','5'),
(17,'Simple yet so delicious!','17','6'),
(18,'Rich buttery taste with a good smell that makes you quickly look for it!','18','7'),
(19,'Thick creamy texture with strong mushroom flavor wasss super good!! Perfect if eat this with garlic bread ^_^','19','9'),
(20,'These cookies turn out so crunchy! Quick breakfast snack for me.','20','8'),
(21,'Melted cheese boosts my appetite!','21','15'),
(22,'As a breakfast enthusiast, cant believe this healthy pizza recipe has such great taste even though its loaded with vegetables! ','22','6'),
(23,'Perfect cooked turkey meat!','23','11'),
(24,'As a veteran, I really enjoy making this quiche. Make me remembered the last time me and my team cooked it at Bosnia camp back then in 1992','24','45'),
(25,'This crispy waffle tasted just like the one at my Uni! Sooo good!!!! ','25','58'),
(26,'Perfect protein smoothie to start your day before gym.','26','55'),
(27,'Perfect sour taste with fresh fruit!','27','60'),
(28,'The most satisfying salad Ive ever made!','28','18'),
(29,'Crunchy outside, soft buttery inside! This recipe is suitable for me to make a business in college.','29','27'),
(30,'Cant believe this turned out so good?? Ahhh yess! ','30','48');



INSERT INTO `follower` (`Follower_ID`, `Follower_Profile_ID`, `Followee_Profile_ID`,`Follow_Date`) VALUES
(1,2,3,"2024-03-03"),
(2,4,5,"2024-03-02"),
(3,6,7,"2024-03-01"),
(4,8,9,"2024-04-04"),
(5,10,11,"2024-04-04"),
(6,12,13,"2024-04-17"),
(7,14,15,"2024-05-26"),
(8,16,17,"2024-05-18"),
(9,18,19,"2024-06-28"),
(10,20,21,"2024-06-09"),
(11,22,23,"2024-06-27"),
(12,24,25,"2024-04-09"),
(13,26,27,"2024-10-11"),
(14,28,29,"2024-05-29"),
(15,30,31,"2024-02-12"),
(16,32,33,"2024-12-11"),
(17,34,35,"2024-08-25"),
(18,36,37,"2024-01-19"),
(19,38,39,"2024-04-30"),
(20,40,31,"2024-09-25");


INSERT INTO `Post_History` (`Post_History_ID`, `Post_History_Date`, `Post_History_Time`, `Post_ID`, `Profile_ID`, `Post_isLike`) VALUES
(1,"2024-05-01","01:19:01",2,2,0),
(2,"2024-04-03","01:20:06",1,1,1),
(3,"2024-05-02","04:30:29",3,1,1),
(4,"2024-05-16","08:30:07",4,2,0),
(5,"2024-05-30","10:40:19",5,3,0),
(6,"2024-06-01","11:34:02",6,4,1),
(7,"2024-06-02","15:40:10",7,3,1),
(8,"2024-04-02","14:20:15",8,4,1),
(9,"2024-04-13","09:00:00",9,5,0),
(10,"2024-04-06","10:30:45",10,6,0),
(11,"2024-05-25","07:30:25",11,5,0),
(12,"2024-04-24","08:40:45",12,6,0),
(13,"2024-03-03","16:30:20",13,7,1),
(14,"2024-03-23","17:46:00",14,8,1),
(15,"2024-03-29","13:30:29",15,7,0),
(16,"2024-03-30","12:40:43",16,8,0),
(17,"2024-04-27","07:56:01",17,9,1),
(18,"2024-04-09","17:58:59",18,10,1),
(19,"2024-03-29","06:30:39",19,9,1),
(20,"2024-03-17","09:30:05",26,14,0);


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



INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(1, 'Avocado Toast', 'Authentic flavored smash avocado with soft bread.', 'Toast your slice of bread until golden and firm. Remove the pit from your avocado. Use a big spoon to scoop out the flesh. Put it in a bowl and mash it up with a fork until its as smooth as you like it. Mix in a pinch of salt (about ⅛ teaspoon) and add more to taste, if desired. Spread avocado on top of your toast. Enjoy as-is or top with any extras offered in this post (I highly recommend a light sprinkle of flaky sea salt, if you have it).', 200, 5, '../data/postImages/GPID-1.jpg', 1, 15);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(2, 'Poached Avocado Toast', 'Avocado toast topped with a perfectly poached egg offers a creamy, savory, and wholesome breakfast delight.', 'Use a fork to smash the avocado down onto the toasted bread slice. Scatter a small squeeze of lemon juice over the avocado. Put a little pepper, salt, and shredded parmesan cheese into avocado and mix them together. You can adjust the taste with seasonings. For the poached egg, bring 6 cups of water and the vinegar to a gentle simmer in a large saucepan. Optionally, for neater eggs, first crack each egg into a fine mesh sieve over a bowl, allowing the watery part of the white to drain for about 30 seconds. Carefully slide the eggs into the simmering water. Cook for 3 to 4 minutes until the whites are set but yolks are still runny. Use a slotted spoon to transfer them onto the avocado.', 100, 4, '../data/postImages/GPID-2.jpg', 2, 15);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(3, 'Chicken bacon and spinach breakfast wrap', 'Nutritious and tasty wrap filled with cooked chicken bacon, fresh spinach, scrambled eggs, and a creamy spread.', 'In a bowl, whisk together eggs, milk, salt, and pepper. Heat a non-stick skillet over medium heat and add butter. Pour the egg mixture into the skillet and cook, stirring gently, until scrambled and just set. Remove from heat. Lay each tortilla flat on a clean surface. Spread a tablespoon of cream cheese or avocado spread onto each tortilla. Divide the scrambled eggs evenly among the tortillas. Place two slices of cooked chicken bacon and a handful of fresh spinach leaves on top of the eggs. Sprinkle with shredded cheese if desired. Fold in the sides of the tortilla and then roll it up tightly from the bottom to secure the filling. Slice in half and serve immediately.', 160, 10, '../data/postImages/GPID-3.jpg', 1, 24);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(4, 'Chicken Bacon and Potato Breakfast Skillet', 'Hearty and flavorful dish featuring crispy potatoes, savory chicken bacon, and eggs cooked to perfection in a single pan.', 'Heat a large skillet over medium heat. Add chopped chicken bacon and cook until crispy. Remove and set aside, leaving the drippings in the skillet. Add olive oil to the skillet with the bacon drippings. Add diced potatoes and cook for about 10-15 minutes, stirring occasionally, until golden and tender. Add diced onion and bell pepper to the skillet. Cook for another 5 minutes until vegetables are softened. Season with salt, pepper, and smoked paprika. Return the cooked chicken bacon to the skillet and mix well. Make four small wells in the mixture and crack an egg into each well. Cover the skillet and cook for 3-5 minutes, or until the eggs are cooked to your liking. Garnish with fresh parsley.', 100, 9, '../data/postImages/GPID-4.jpg', 2, 24);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(5, 'Blueberry Bagel', 'Homemade Blueberry Bagel', 'In a small saucepan over low heat, add the blueberries. Let the berries heat up, stirring occasionally until they release their juices. Take it off the heat and let them cool down. In a large bowl or the bowl of your stand mixer fitted with a dough hook, combine water, yeast, and sugar and stir. Add in the flour, salt, blueberries, and vanilla. Use a fork or switch the stand mixer onto low speed, to combine it into a thick dough. The dough should be very thick but also slightly sticky. Keep it kneading or mixing for around 10 minutes for optimal gluten development. Once the dough is kneaded and strong, form it into a ball. Place the dough ball into a large oiled bowl and cover it with plastic wrap or a damp towel. Let the dough rise in a warm place until doubled in size. Punch the dough down and pull it from the bowl onto a lightly floured surface. Cut the dough into 8 equal pieces (a kitchen scale works well to ensure even bagels) and shape each piece into a ball. Let these dough balls rest for 5 minutes. Use your thumb and index finger of both hands to push a hole into the center of each ball of dough, then roll the dough ball around your fingers in a circular motion to widen the hole. Aim for a large hole as it will shrink back in size once it sits. Place the shaped bagels on a prepared sheet pan lined with parchment paper and let them puff out a bit, for around 30 minutes while the oven preheats and a pot of water is brought to a boil. Bring a large pot of water to a boil and preheat the oven to 428°F/220°C and line a large baking sheet with parchment paper. Once the water is boiling, stir in honey or brown sugar. Dust any excess flour off the bagels and drop them in the boiling water one at a time. Boil 2-3 bagels at a time. Let them poach in the water for 1-minute total, flipping them after 30 seconds. Remove the bagels from the water using a slotted spoon. Drain the boiled bagels on a wire rack and continue with the rest of the bagels. Place the bagels on the lined baking sheet. Bake them in the oven for 20-25 minutes or until deep golden brown. If they are baking unevenly or your oven has hot spots, turn the oven tray around after 15 minutes of baking. Remove the baked bagels from the tray and let them cool on a cooling rack for 30 minutes before slicing and serving. The bagels will initially feel hard as they come from the oven but will soften as they cool to room temperature.', 150, 2, '../data/postImages/GPID-5.jpg', 3, 13);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(6, 'Sandwich Bagel', 'Simple yet perfect recipe for a quick and satisfying breakfast', 'Lightly toast the bagel halves in a toaster or on a skillet until golden brown. Heat the butter or oil in a small non-stick skillet over medium heat. Crack the egg into the skillet and cook it to your preferred doneness (sunny-side up, over-easy, or scrambled). Season with salt and pepper. If desired, place the slice of cheese on top of the egg in the skillet during the last minute of cooking, allowing it to melt slightly. Place the cooked egg (with melted cheese, if using) on the bottom half of the toasted bagel. Add the slice of chicken on top of the egg (optional). Add any additional toppings you like, such as avocado slices, tomato slices, spinach, or arugula. Top with the other half of the bagel.', 160, 2, '../data/postImages/GPID-6.jpg', 4, 13);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(7, 'Butter biscuit', 'Flaky, tender, and buttery baked goods, perfect for breakfast or as a snack.', 'Preheat your oven to 425°F (220°C). In a large bowl, whisk together the flour, baking powder, salt, and sugar (if using). Add the cold butter pieces to the flour mixture. Use a pastry cutter or your fingers to cut the butter into the flour until the mixture resembles coarse crumbs. Pour in the cold milk and stir until just combined. Do not overmix, the dough should be slightly sticky. Turn the dough out onto a floured surface. Gently pat it into a 1-inch thick rectangle. Use a biscuit cutter or a glass to cut out biscuits and place them on an ungreased baking sheet. Bake for 12-15 minutes, or until the biscuits are golden brown on top. Enjoy warm with butter, jam, or your favorite toppings.', 118, 0, '../data/postImages/GPID-7.jpg', 3, 29);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(8, 'Cornflakes crunchy biscuit', 'Crunchy, sweet treats made with crushed cornflakes', 'Preheat your oven to 350°F (175°C). Line a baking sheet with parchment paper. In a large bowl, cream together the softened butter and granulated sugar until light and fluffy. Beat in the egg and vanilla extract until well combined. In another bowl, whisk together the flour and baking powder. Gradually add this to the butter mixture, mixing until just combined. Gently fold in 2 cups of the crushed cornflakes, leaving 1 cup for coating. Scoop tablespoon-sized portions of dough, roll them into balls, and then roll each ball in the remaining crushed cornflakes to coat. Place the coated dough balls on the prepared baking sheet, spacing them about 2 inches apart. Bake for 12-15 minutes, or until the cookies are lightly golden. Allow the cookies to cool on the baking sheet for a few minutes before transferring them to a wire rack to cool completely.', 190, 2, '../data/postImages/GPID-8.jpg', 4, 29);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(9, 'Creamy mushroom soup', 'Velvety blend of mushrooms, onions, and cream, offering a rich and comforting flavor.', 'In a large pot or Dutch oven, melt the butter over medium heat. Add the chopped onion and sauté until translucent, about 3-4 minutes. Add the minced garlic and cook for another 1-2 minutes until fragrant. Add the sliced mushrooms to the pot and cook until they release their moisture and start to brown, about 5-7 minutes. Sprinkle the flour over the mushrooms and stir well to coat. Cook for 1-2 minutes to remove the raw flour taste. Gradually pour in the vegetable or chicken broth, stirring constantly to incorporate the flour mixture. Bring to a simmer and cook for 10-15 minutes, stirring occasionally, until the mushrooms are tender and the soup has slightly thickened. For a smoother texture, use an immersion blender to puree some or all of the soup directly in the pot. Alternatively, transfer a portion of the soup to a blender and blend until smooth, then return it to the pot. Stir in the heavy cream or half-and-half, and heat through for a few minutes. Season with salt and pepper to taste. Ladle the creamy mushroom soup into bowls, garnish with fresh parsley or thyme if desired, and serve hot with crusty bread or crackers.', 120, 13, '../data/postImages/GPID-9.jpg', 5, 17);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(10, 'Tomatoes and basil soup', 'Combine fruity sundried tomatoes with tinned tomatoes to make this rich tomato soup with a homemade basil pesto.', 'Heat the butter or oil in a large pan, then add the garlic and soften for a few minutes over a low heat. Add the sundried tomatoes, canned tomatoes, stock, sugar and seasoning, then bring to a simmer. Let the soup bubble for 10 mins until the tomatoes have broken down a little. Whizz with a stick blender, adding half the pot of soured cream as you go. Taste and adjust the seasoning – add more sugar if you need to. Serve in bowls with 1 tbsp or so of the pesto swirled on top, a little more soured cream and scatter with basil leaves.', 200, 4, '../data/postImages/GPID-10.jpeg', 6, 17);



INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(11, "Turkey Burritos", "Savory wraps filled with seasoned turkey, beans, cheese, and vegetables, providing a hearty and satisfying meal.", "In a large skillet over medium heat, cook the ground turkey until browned and cooked through, breaking it up with a spoon as it cooks. Add the diced onion, minced garlic, and diced bell pepper to the skillet with the meat. Cook for 3-4 minutes until the vegetables are softened. Stir in the chili powder, ground cumin, paprika, salt, and pepper. Cook for another minute until fragrant. Add the cooked rice and drained black beans to the skillet. Stir well to combine and cook for 2-3 minutes until heated through. Warm the flour tortillas in a microwave or skillet until soft and pliable. Divide the meat mixture evenly among the tortillas. Sprinkle shredded cheese evenly over the meat mixture in each tortilla. Fold the sides of each tortilla over the filling, then roll from the bottom up to enclose the filling. Optionally, garnish with diced tomatoes, shredded lettuce, sour cream, salsa, or guacamole. Serve the meat burritos warm and enjoy!", 200, 13, "../data/postImages/GPID-11.jpg", 5, 5);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(12, "Breakfast Burrito", "Fill a nutritious wholemeal wrap with lots of healthy breakfast ingredients to make this veggie burrito!", "Whisk the chipotle paste with the egg and some seasoning in a jug. Heat the oil in a large frying pan, add the kale and tomatoes. Cook until the kale is wilted and the tomatoes have softened, then push everything to the side of the pan. Pour the beaten egg into the cleared half of the pan and scramble. Layer everything into the center of your wrap, topping with the avocado, then wrap up and eat immediately.", 90, 5, "../data/postImages/GPID-12.jpg", 6, 5);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(13, "Tomato Eggs Casserole", "Comforting dish made with layers of sliced tomatoes, eggs, cheese, and herbs, baked to perfection.", "Preheat your oven to 375°F (190°C). Grease a 9x9 inch baking dish with butter or cooking spray. In a bowl, whisk together the eggs, milk, salt, pepper, dried basil, dried oregano, and garlic powder until well combined. Spread half of the shredded cheese evenly on the bottom of the prepared baking dish. Arrange half of the tomato slices over the cheese in a single layer. Pour half of the egg mixture evenly over the tomatoes and cheese. Repeat the layers with the remaining cheese, tomato slices, and egg mixture. Bake in the preheated oven for 25-30 minutes, or until the eggs are set and the top is lightly golden brown. Allow the casserole to cool for a few minutes before slicing. Optionally, garnish with fresh basil leaves before serving. Slice into squares and serve warm as a delicious breakfast or brunch dish.", 150, 3, "../data/postImages/GPID-13.jpg", 7, 11);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(14, "Breakfast Casserole", "A hearty breakfast casserole with eggs, sausage, and hash browns.", "Mix eggs, cooked sausage, hash browns, and cheese. Pour into a baking dish and bake until golden and bubbly. Serve warm.", 115, 2, "../data/postImages/GPID-14.jpg", 8, 11);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(15, "Loaded Cheese Pizza", "Classic indulgence topped generously with mozzarella, cheddar, and parmesan cheeses, complemented with savory toppings", "Preheat your oven to the temperature specified on the pizza crust package (usually around 400-450°F or 200-230°C). Place the pizza crust on a baking sheet or pizza stone. If using homemade dough, roll it out to your desired thickness. Spread the pizza sauce evenly over the crust, leaving a small border around the edges. Sprinkle the shredded mozzarella cheese over the sauce. Arrange the assorted vegetables evenly on top of the cheese. Carefully crack the eggs onto the pizza, spacing them apart. Try to keep the yolks intact. Season the pizza with salt and pepper to taste. Drizzle lightly with olive oil. Bake in the preheated oven according to the crust package instructions, typically for 12-15 minutes or until the crust is golden brown and the cheese is melted and bubbly. Remove the pizza from the oven and sprinkle with chopped fresh parsley.", 200, 0, "../data/postImages/GPID-15.jpg", 7, 25);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(16, "Healthy Pizza", "Loaded with vegetables, eggs, and fresh parsley, offering a nutritious twist on a classic favorite.", "Preheat your oven to the temperature specified on the pizza crust package (usually around 400-450°F or 200-230°C). Place the pizza crust on a baking sheet or pizza stone. If using homemade dough, roll it out to your desired thickness. Spread the pizza sauce evenly over the crust, leaving a small border around the edges. Sprinkle the shredded mozzarella cheese over the sauce. Arrange the assorted vegetables evenly on top of the cheese. Carefully crack the eggs onto the pizza, spacing them apart. Try to keep the yolks intact. Season the pizza with salt and pepper to taste. Drizzle lightly with olive oil. Bake in the preheated oven according to the crust package instructions, typically for 12-15 minutes or until the crust is golden brown and the cheese is melted and bubbly. Remove the pizza from the oven and sprinkle with chopped fresh parsley.", 200, 0, "../data/postImages/GPID-16.jpg", 8, 25);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(17, "Avocado Salad", "Refreshing and creamy dish made with ripe avocados, fresh vegetables, and a light dressing, perfect for a healthy meal.", "In a large bowl, combine the diced avocados, halved cherry tomatoes, diced cucumber, and thinly sliced red onion. Add the chopped cilantro or parsley to the bowl. In a small bowl, whisk together the olive oil, lime juice, salt, and pepper until well combined. Pour the dressing over the salad and gently toss to coat all the ingredients evenly. Serve the avocado salad immediately as a refreshing side dish or light meal.", 160, 2, "../data/postImages/GPID-17.jpg", 9, 30);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(18, "Classic Salad", "Simple and fresh dish featuring a mix of crisp lettuce, tomatoes, cucumbers, and a light vinaigrette.", "In a large salad bowl, combine the mixed salad greens, cherry tomatoes, cucumber slices, thinly sliced red onion, shredded carrots, and black olives (if using). In a small bowl, whisk together the olive oil, vinegar or lemon juice, Dijon mustard, honey or maple syrup, salt, and pepper until well combined. Pour the vinaigrette over the salad and toss gently to coat all the ingredients evenly. Sprinkle it with croutons and cheese if desired. Serve the classic salad immediately as a fresh and healthy side dish or starter.", 100, 5, "../data/postImages/GPID-18.jpg", 10, 30);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(19, "Simple sandwich with cheddar slice", "Quick and easy meal featuring fresh bread, crisp lettuce, and creamy cheddar cheese.", "If desired, toast the bread slices until golden brown. Spread a thin layer of mayonnaise or butter on one or both slices of bread. Place the slice of cheddar cheese on one slice of bread, add the tomato slices on top of the cheddar cheese, layer the lettuce leaves over the tomatoes. Sprinkle with a pinch of salt and pepper if desired. Place the second slice of bread on top to complete the sandwich. Cut the sandwich in half if desired and serve immediately.", 100, 5, "../data/postImages/GPID-19.jpg", 9, 8);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(20, "Chicken bacon sandwich", "Flavorful meal featuring grilled chicken, crispy chicken bacon, lettuce, and tomato on toasted bread.", "Season the chicken breast with salt and pepper. Heat a grill pan or skillet over medium heat and add a drizzle of olive oil. Cook the chicken breast for 6-7 minutes per side, or until fully cooked and no longer pink inside. Remove from heat and let it rest for a few minutes, then slice it thinly. Cook the chicken bacon in a skillet over medium heat until crispy. Remove and drain on paper towels. Lightly toast the bread slices in a toaster or on a skillet until golden brown. Spread mayonnaise on one slice of toasted bread. If desired, spread Dijon mustard on the other slice. Layer the sliced chicken breast on the bottom slice of bread. Add the cheddar cheese slices on top of the chicken (if using). Place the cooked chicken bacon slices over the cheese. Add the tomato slices and lettuce leaves. Top with the other slice of bread to complete the sandwich.", 300, 6, "../data/postImages/GPID-20.jpeg", 10, 8);



INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(21, "Chorizo and Egg Tacos", "Savory breakfast tacos filled with spicy chorizo sausage, scrambled eggs, and cheese, perfect for a flavorful start to the day.", "In a skillet over medium heat, cook the chorizo sausage, breaking it up with a spatula, until fully cooked and browned. Remove from the skillet and set aside. In a bowl, whisk together the eggs, milk, salt, and pepper. If needed, add a little olive oil to the skillet. Pour in the egg mixture and cook, stirring gently, until the eggs are scrambled and just set. Return the cooked chorizo to the skillet with the scrambled eggs and mix well to combine. Warm the tortillas in a dry skillet over medium heat, or wrap them in a damp paper towel and microwave for 20-30 seconds until soft and pliable. Divide the chorizo and egg mixture evenly among the warm tortillas. Sprinkle with shredded cheese. Add any optional toppings you like, such as diced tomatoes, avocado slices, chopped cilantro, salsa, or sour cream. Serve the chorizo and egg tacos immediately while warm.", 200, 0, "../data/postImages/GPID-21.jpg", 11, 20);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(22, "Sweet Potato and Black Bean Tacos", "Healthy and flavorful vegetarian option featuring roasted sweet potatoes, black beans, and fresh toppings in warm tortillas.", "Preheat the oven to 425°F (220°C). In a large bowl, toss the diced sweet potatoes with olive oil, chili powder, cumin, salt, and pepper. Spread the sweet potatoes in a single layer on a baking sheet and roast for 20-25 minutes, or until tender and slightly caramelized, stirring halfway through. In a small saucepan over medium heat, warm the black beans until heated through. Season with salt and pepper to taste. Warm the tortillas in a dry skillet over medium heat, or wrap them in a damp paper towel and microwave for 20-30 seconds until soft and pliable. Divide the roasted sweet potatoes and black beans evenly among the warm tortillas. Sprinkle each taco with crumbled feta or cotija cheese. Add optional toppings such as diced avocado, chopped cilantro, salsa, lime wedges, and diced red onion. Serve the sweet potato and black bean tacos immediately.", 150, 2, "../data/postImages/GPID-22.jpg", 12, 20);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(23, "Berries Chia", "Healthy and refreshing dessert made with chia seeds, almond milk, and mixed berries, creating a creamy and nutritious treat.", "In a medium bowl, combine the chia seeds, almond milk, honey or maple syrup, and vanilla extract. Stir well to ensure the chia seeds are evenly distributed. Cover the bowl and refrigerate for at least 4 hours or overnight, allowing the chia seeds to absorb the liquid and thicken to a pudding-like consistency. Wash and slice the mixed berries if needed. Reserve some whole berries for garnish. Once the chia pudding has set, give it a good stir to break up any clumps. Layer the chia pudding and mixed berries in serving glasses or bowls. Garnish with the reserved whole berries and fresh mint leaves if desired. Serve immediately or keep refrigerated until ready to serve.", 130, 0, "../data/postImages/GPID-23.jpg", 11, 26);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(24, "3 Layer chia pudding", "Features colorful and nutritious layers of chia seed pudding made with different fruits or flavors, creating a visually appealing and tasty treat.", "Starting from the first layer which is mango, followed by blueberry and lastly raspberry. For each layer, in a separate bowl or container, combine chia seeds, almond milk, maple syrup or honey, vanilla extract, and the respective fruit (diced mango for bottom layer, mashed blueberries for middle layer, mashed raspberries for top layer). Mix well until all ingredients are thoroughly combined. Cover each bowl or container and refrigerate for at least 4 hours or overnight, allowing the chia seeds to absorb the liquid and thicken. Once each layer has set and thickened to a pudding-like consistency, start assembling. Begin with the mango layer at the bottom of serving glasses or jars, followed by the blueberry layer, and finish with the raspberry layer on top. Optionally, garnish with additional fruit or a sprinkle of chia seeds on top. Serve chilled and enjoy the colorful and nutritious three-layered chia pudding as a delightful breakfast, snack, or dessert.", 180, 2, "../data/postImages/GPID-24.jpg", 12, 26);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(25, "Chicken Slice Crepe", "Delicate French-style pancakes filled with seasoned chicken, creamy sauce, and fresh vegetables, creating a savory and elegant dish.", "Crepe. In a mixing bowl, whisk together flour, eggs, milk, and salt until smooth. Heat a non-stick skillet or crepe pan over medium heat. Brush lightly with melted butter. Pour about 1/4 cup of batter into the skillet, swirling to coat the bottom evenly. Cook for about 1-2 minutes until the edges start to lift. Flip and cook for another 1 minute. Repeat with remaining batter. You should get about 8 crepes. Filling. In a skillet, heat olive oil over medium heat. Add chopped onion and cook until softened, about 3-4 minutes. Add minced garlic and cook for another 1 minute until fragrant. Stir in sliced mushrooms and cook until they release their juices and become tender. Add shredded chicken and chopped spinach. Season with salt and pepper. Cook for another 2-3 minutes until spinach wilts. Remove from heat. Cream Sauce. In a small saucepan, melt butter over medium heat. Stir in flour and cook for 1 minute to make a roux.,Gradually whisk in milk, stirring constantly until the sauce thickens. Season with salt, pepper, and nutmeg if using. Remove from heat. Lay each crepe flat on a serving plate. Spoon some of the chicken and vegetable mixture onto one half of each crepe. Sprinkle shredded cheese over the filling. Fold the crepe in half over the filling, then fold in half again to form a triangle. Drizzle the warm cream sauce over the stuffed crepes. Optionally, garnish with chopped parsley or chives.", 190, 4, "../data/postImages/GPID-25.jpeg", 13, 12);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(26, "Crepes with Nutella", "Thin and delicate crepes filled with Nutella.", "Cook thin crepe batter on a hot griddle. Spread Nutella on each crepe and fold. Serve warm.", 90, 5, "../data/postImages/GPID-26.jpeg", 14, 12);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(27, "Classic Butter Croissant", "Flaky, golden pastry made with layers of buttery dough, creating a light and airy texture.", "Dough. In a large bowl, mix the flour, sugar, and salt. In a separate bowl, dissolve the yeast in warm water and let it sit for 5 minutes until frothy. Add the warm milk to the yeast mixture. Pour the liquid ingredients into the dry ingredients and mix until a dough forms. Knead the dough on a floured surface for about 10 minutes until smooth and elastic. Place the dough in a greased bowl, cover, and let it rise in a warm place for about 1 hour or until doubled in size. Butter Block. While the dough is rising, cut the cold butter into thin slices. Arrange the slices on a sheet of parchment paper to form a 7x7-inch square. Cover with another sheet of parchment paper and roll it gently to flatten. Refrigerate the butter block. Incorporate Butter. Roll the risen dough into a 10x20-inch rectangle on a floured surface. Place the cold butter block in the center of the dough rectangle. Fold the dough edges over the butter, enclosing it completely. Laminate Dough. Roll the dough-butter package into a 10x20-inch rectangle. Fold the dough into thirds (like a letter). This is the first turn. Rotate the dough 90 degrees, roll it out again, and fold it into thirds. This is the second turn. Wrap the dough in plastic wrap and refrigerate for 30 minutes. Repeat the rolling, folding, and chilling process two more times for a total of four turns. Shape Croissants. After the final chill, roll the dough into a 10x30-inch rectangle. Cut the dough into triangles with a base of about 4 inches. Make a small slit at the base of each triangle, then roll the dough from the base to the tip to form a crescent shape. Place the shaped croissants on a baking sheet lined with parchment paper. Proof and Bake. Cover the croissants loosely with plastic wrap and let them proof at room temperature for about 1-2 hours, or until doubled in size. Preheat the oven to 375°F (190°C). Brush the croissants with a beaten egg for a glossy finish. Bake for 20-25 minutes or until golden brown and puffed.", 200, 2, "../data/postImages/GPID-27.jpeg", 13, 21);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(28, "Pain Au Chocolat", "Buttery, flaky pastry filled with rich chocolate, perfect for a sweet breakfast or snack.", "Dough. In a large bowl, combine flour, sugar, and salt. In a separate bowl, dissolve the yeast in warm water and let sit for 5 minutes until frothy. Add warm milk to the yeast mixture. Pour the liquid ingredients into the dry ingredients and mix until a dough forms. Knead the dough on a floured surface for about 10 minutes until smooth and elastic. Place the dough in a greased bowl, cover, and let it rise in a warm place for about 1 hour or until doubled in size. Butter Block. Cut the cold butter into thin slices and arrange them on a sheet of parchment paper to form a 7x7-inch square. Cover with another sheet of parchment paper and gently roll it to flatten. Refrigerate the butter block. Incorporate Butter. Roll the risen dough into a 10x20-inch rectangle on a floured surface. Place the cold butter block in the center of the dough rectangle. Fold the dough edges over the butter, enclosing it completely. Laminate Dough. Roll the dough-butter package into a 10x20-inch rectangle. Fold the dough into thirds (like a letter). This is the first turn. Rotate the dough 90 degrees, roll it out again, and fold it into thirds. This is the second turn. Wrap the dough in plastic wrap and refrigerate for 30 minutes. Repeat the rolling, folding, and chilling process two more times for a total of four turns. Shape Chocolate Croissants. After the final chill, roll the dough into a 10x30-inch rectangle. Cut the dough into 4x6-inch rectangles. Place a chocolate baton or a piece of chopped chocolate at one end of each rectangle. Roll the dough tightly around the chocolate, tucking the ends underneath. Proof and Bake. Place the shaped croissants on a baking sheet lined with parchment paper. Cover loosely with plastic wrap and let them proof at room temperature for about 1-2 hours, or until doubled in size. Preheat the oven to 375°F (190°C). Brush the croissants with beaten egg for a glossy finish. Bake for 15-20 minutes or until golden brown and the chocolate has melted", 150, 0, "../data/postImages/GPID-7.jpeg", 14, 21);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(29, "French Toast", "Classic French toast with a hint of cinnamon and vanilla.", "Dip bread slices in a mixture of eggs, milk, cinnamon, and vanilla. Cook on a hot griddle.", 130, 3, "../data/postImages/GPID-29.jpg", 15, 6);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(30, "Strawberry French Toast", "Delicious breakfast dish made with thick slices of bread soaked in a sweet egg mixture, then cooked until golden brown and topped with fresh strawberries and syrup.", "In a shallow bowl, whisk together the eggs, milk, vanilla extract, sugar, cinnamon, and salt until well combined. Dip each slice of bread into the egg mixture, allowing it to soak for about 20-30 seconds on each side. In a large skillet or griddle, heat the butter over medium heat. Once the butter is melted and bubbling, add the soaked bread slices to the skillet. Cook for 2-3 minutes on each side, or until the bread is golden brown and cooked through. Place the cooked French toast on a serving plate. Top with fresh sliced strawberries. Drizzle with maple syrup or sprinkle with powdered sugar.", 150, 1, "../data/postImages/GPID-30.jpeg", 16, 6);



INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(31, "Spinach and Feta Frittatas", "Healthy food that can make your day.","Start by preheating your oven to 375°F (190°C). In a large bowl, whisk together 8 large eggs and 1/4 cup of milk until well combined, then season with salt and pepper. Heat 2 tablespoons of olive oil in an ovenproof skillet over medium heat, and add one finely chopped small onion and a minced clove of garlic. Sauté until the onion becomes translucent, which should take about 5 minutes. Add 1 cup of fresh chopped spinach to the skillet and cook until it wilts, about 2 minutes. Pour the egg mixture into the skillet, stirring gently to combine with the spinach and onions. Sprinkle 1/2 cup of crumbled feta cheese and 1/4 cup of grated Parmesan cheese evenly over the top. Transfer the skillet to the preheated oven and bake for 20-25 minutes, or until the frittata is set in the center and lightly browned on top. Allow the frittata to cool slightly before slicing and serving.", 30, 19, "../data/postImages/GPID-31.jpg", 14, 25);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(32, "Mushroom and Bell Pepper Frittatas", "Best mushroom breakfast ever.","Preheat your oven to 375°F (190°C). In a large bowl, whisk together 8 large eggs and 1/4 cup of milk until well combined, then season with salt and pepper. Heat 2 tablespoons of butter or olive oil in an ovenproof skillet over medium heat. Add 1 cup of sliced mushrooms and 1/2 cup of diced bell peppers, sautéing until the vegetables are tender, which should take about 5-7 minutes. Add 2 chopped green onions to the skillet and cook for an additional minute. Pour the egg mixture into the skillet, stirring gently to combine with the vegetables. Sprinkle 1/2 cup of shredded cheddar cheese and 1/4 cup of grated Parmesan cheese evenly over the top. Transfer the skillet to the preheated oven and bake for 20-25 minutes, or until the frittata is set in the center and lightly browned on top. Allow the frittata to cool slightly before slicing and serving. Enjoy these frittatas as a hearty breakfast, brunch, or even a light dinner!", 77, 15, "../data/postImages/GPID-32.jpg", 14, 12);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(33, "Almond and Cranberry Granola", "Almond breakfast","Preheat your oven to 300°F (150°C). In a large bowl, combine 3 cups of old-fashioned oats, 1 cup of chopped almonds, and 1 cup of dried cranberries. In a separate bowl, mix 1/2 cup of honey, 1/4 cup of melted coconut oil, and 1 teaspoon of vanilla extract until well combined. Pour the wet mixture over the dry ingredients and stir until everything is evenly coated. Spread the mixture evenly on a baking sheet lined with parchment paper. Bake for 25-30 minutes, stirring halfway through, until the granola is golden brown. Allow the granola to cool completely on the baking sheet before breaking it into clusters and storing it in an airtight container.", 90, 12, "../data/postImages/GPID-33.jpg", 7, 23);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(34, "Chocolate and Coconut Granola", "Start your day with a sweetness", "Preheat your oven to 300°F (150°C). In a large bowl, mix together 3 cups of old-fashioned oats, 1 cup of shredded coconut, and 1/2 cup of chopped dark chocolate. In another bowl, whisk together 1/2 cup of maple syrup, 1/4 cup of melted coconut oil, and 1 teaspoon of vanilla extract until smooth. Pour the wet mixture over the oat mixture and stir until everything is thoroughly combined. Spread the granola mixture on a baking sheet lined with parchment paper. Bake for 25-30 minutes, stirring halfway through, until the granola is golden and crispy. Let the granola cool completely on the baking sheet before breaking it into pieces and storing it in an airtight container.", 90, 20, "../data/postImages/GPID-34.jpg", 7, 14);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(35, "Hash Brown Omelette", "A satisfying combination of crispy hash browns with fluffy eggs and vegetables.", "Grate potatoes and mix it with the eggs, cup powder. Fry in a heated pan with oil and add with any vegetables you prefer!. Serve warm, but its hot, so use a fork!", 75, 13, "../data/postImages/GPID-35.jpg", 19, 6);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(36, "Hash Brown", "Crispy and golden hash browns served as a delicious breakfast side.", "Grate 4 large potatoes and 1 small onion, squeeze out excess moisture, mix with 1 beaten egg, 2 tablespoons of flour, salt, and pepper, then form into patties and cook in a hot skillet with oil until golden brown and crispy on both sides.", 75, 6, "../data/postImages/GPID-36.jpg", 19, 18);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(37, "Oat Breakfast Muffins", "Healthy and delicious oat muffins.", "In a large bowl, mix 1 1/2 cups of whole wheat flour, 1 cup of rolled oats, 1/2 cup of brown sugar, 1 teaspoon of baking powder, 1/2 teaspoon of baking soda, and 1/2 teaspoon of salt. In a separate bowl, whisk together 1 cup of milk, 1/2 cup of unsweetened applesauce, 1/4 cup of vegetable oil, 2 beaten eggs, and 1 teaspoon of vanilla extract. Combine the wet and dry ingredients until just mixed. Divide the batter evenly into a greased muffin tin and bake at 375°F (190°C) for 20-25 minutes, until a toothpick inserted into the center comes out clean.", 85, 8, "../data/postImages/GPID-37.jpg", 9, 3);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(38, "Baked Egg Breakfast Muffins", "Savory breakfast muffins with eggs and vegetables.", "Preheat your oven to 350°F (175°C). In a bowl, whisk together 6 large eggs, 1/4 cup of milk, salt, and pepper. Grease a muffin tin and place a mixture of chopped vegetables (such as spinach, bell peppers, and tomatoes) and shredded cheese in each cup. Pour the egg mixture evenly over the veggies and cheese, filling each cup about three-quarters full. Bake for 20-25 minutes, or until the eggs are set and slightly golden on top. Allow the muffins to cool slightly before removing them from the tin and serving.", 70, 6, "../data/postImages/GPID-38.jpg", 9, 8);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(39, "Classic Oatmeal", "Simple and hearty classic oatmeal.", "In a pot, bring 3 cups of water or milk to a boil. Add 1 1/2 cups of rolled oats and reduce heat to medium. Cook, stirring occasionally, for about 5 minutes until the oats are tender and the mixture is creamy. Add a pinch of salt, and serve hot with your favorite toppings such as fresh mushroom,half cooked egg and veggies.", 95, 12, "../data/postImages/GPID-39.jpg", 16, 9);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(40, "Apple Cinnamon Oatmeal", "A warm and comforting apple cinnamon oatmeal.", "In a pot, bring 3 cups of water or milk to a boil. Add 1 1/2 cups of rolled oats, 1 teaspoon of cinnamon, and 1 diced apple. Reduce heat to medium and cook, stirring occasionally, for about 5-7 minutes until the oats are tender and the apples are soft. Serve hot, topped with a drizzle of maple syrup and a sprinkle of nuts if desired.", 90, 9, "../data/postImages/GPID-40.jpg", 16, 7);



INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(41, "Cheese and Vegetable Omelette", "A fluffy omelette filled with cheese and vegetables.", "Whisk together 3 large eggs with salt and pepper. Heat a nonstick skillet over medium heat and add a little butter. Pour in the eggs and cook until they start to set. Add 1/2 cup of shredded cheese and 1/2 cup of diced vegetables (such as bell peppers, tomatoes, and spinach) on one half of the omelette. Fold the other half over the fillings and cook until the cheese is melted and the omelette is fully cooked. Serve warm.", 80, 7, "../data/postImages/GPID-41.jpg", 3, 22);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(42, "Herb and Mushroom Omelette", "A savory omelette with fresh herbs and mushrooms.", "Whisk together 3 large eggs with salt and pepper. Heat a nonstick skillet over medium heat and add a little butter. Add 1/2 cup of sliced mushrooms and cook until softened. Pour in the eggs and cook until they start to set. Sprinkle with 2 tablespoons of chopped fresh herbs (such as parsley, chives, and thyme) and continue cooking until the omelette is fully set. Fold the omelette in half and serve warm.", 75, 8, "../data/postImages/GPID-42.jpeg", 3, 10);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(43, "Classic Buttermilk Pancakes", "Fluffy and delicious buttermilk pancakes.", "In a large bowl, whisk together 2 cups of all-purpose flour, 2 tablespoons of sugar, 2 teaspoons of baking powder, 1 teaspoon of baking soda, and 1/2 teaspoon of salt. In another bowl, whisk together 2 cups of buttermilk, 2 large eggs, and 1/4 cup of melted butter. Pour the wet ingredients into the dry ingredients and stir until just combined. Heat a griddle or nonstick skillet over medium heat and grease with butter or oil. Pour 1/4 cup of batter for each pancake and cook until bubbles form on the surface, then flip and cook until golden brown. Serve with maple syrup.", 100, 5, "../data/postImages/GPID-43.jpg", 1, 19);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(44, "Blueberry Pancakes", "Fluffy pancakes with fresh blueberries.", "In a large bowl, whisk together 2 cups of all-purpose flour, 2 tablespoons of sugar, 2 teaspoons of baking powder, 1 teaspoon of baking soda, and 1/2 teaspoon of salt. In another bowl, whisk together 2 cups of buttermilk, 2 large eggs, and 1/4 cup of melted butter. Pour the wet ingredients into the dry ingredients and stir until just combined. Fold in 1 cup of fresh blueberries. Heat a griddle or nonstick skillet over medium heat and grease with butter or oil. Pour 1/4 cup of batter for each pancake and cook until bubbles form on the surface, then flip and cook until golden brown. Serve with maple syrup.", 90, 6, "../data/postImages/GPID-44.jpg", 1, 29);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(45, "Classic Quiche Lorraine", "A rich and savory quiche with bacon and cheese.", "Preheat your oven to 375°F (190°C). In a skillet, cook 6 slices of chopped bacon until crispy. In a large bowl, whisk together 4 large eggs, 1 1/2 cups of heavy cream, 1/2 teaspoon of salt, 1/4 teaspoon of black pepper, and a pinch of nutmeg. Stir in 1 cup of shredded Gruyère cheese and the cooked bacon. Pour the mixture into a pre-baked pie crust and bake for 35-40 minutes until the quiche is set and lightly browned on top. Let cool slightly before slicing and serving.", 110, 7, "../data/postImages/GPID-45.jpg", 10, 14);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(46, "Spinach and Mushroom Quiche", "A flavorful quiche with spinach and mushrooms.", "Preheat your oven to 375°F (190°C). In a skillet, cook 1 cup of sliced mushrooms until softened, then add 2 cups of fresh spinach and cook until wilted. In a large bowl, whisk together 4 large eggs, 1 1/2 cups of heavy cream, 1/2 teaspoon of salt, 1/4 teaspoon of black pepper, and a pinch of nutmeg. Stir in 1 cup of shredded Swiss cheese, the cooked mushrooms, and spinach. Pour the mixture into a pre-baked pie crust and bake for 35-40 minutes until the quiche is set and lightly browned on top. Let cool slightly before slicing and serving.", 105, 6, "../data/postImages/GPID-48.jpg", 10, 8);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(47, "Homemade Breakfast Sausages", "Tasty homemade breakfast sausages with herbs.", "In a large bowl, combine 1 pound of ground chicken, 1 tablespoon of finely chopped fresh sage, 1 tablespoon of finely chopped fresh thyme, 1 teaspoon of salt, 1/2 teaspoon of black pepper, 1/4 teaspoon of ground nutmeg, and 1/4 teaspoon of red pepper flakes. Mix until well combined. Form the mixture into small patties and cook in a hot skillet over medium heat until browned and cooked through, about 4-5 minutes per side.", 95, 8, "../data/postImages/GPID-47.jpg", 23, 2);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(48, "Maple Apple Sausages", "Sweet and savory sausages with maple syrup and apples.", "In a large bowl, combine 1 pound of ground pork, 1/2 cup of finely chopped apple, 1/4 cup of maple syrup, 1 teaspoon of salt, 1/2 teaspoon of black pepper, and 1/4 teaspoon of ground cinnamon. Mix until well combined. Form the mixture into small patties and cook in a hot skillet over medium heat until browned and cooked through, about 4-5 minutes per side.", 90, 9, "../data/postImages/GPID-48.jpg", 23, 17);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(49, "Classic Scones", "Tender and flaky classic scones.", "Preheat your oven to 400°F (200°C). In a large bowl, whisk together 2 cups of all-purpose flour, 1/4 cup of sugar, 1 tablespoon of baking powder, and 1/2 teaspoon of salt. Cut in 1/2 cup of cold butter until the mixture resembles coarse crumbs. Stir in 1/2 cup of heavy cream and 1 beaten egg until just combined. Turn the dough out onto a floured surface and knead gently a few times. Pat into a 1-inch thick circle and cut into wedges. Place the wedges on a baking sheet lined with parchment paper and bake for 15-18 minutes until golden brown.", 100, 10, "../data/postImages/GPID-49.jpeg", 28, 18);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(50, "Blueberry Lemon Scones", "Fresh scones with blueberries and a hint of lemon.", "Preheat your oven to 400°F (200°C). In a large bowl, whisk together 2 cups of all-purpose flour, 1/4 cup of sugar, 1 tablespoon of baking powder, 1/2 teaspoon of salt, and the zest of 1 lemon. Cut in 1/2 cup of cold butter until the mixture resembles coarse crumbs. Stir in 1/2 cup of heavy cream, 1 beaten egg, and 1 cup of fresh blueberries until just combined. Turn the dough out onto a floured surface and knead gently a few times. Pat into a 1-inch thick circle and cut into wedges. Place the wedges on a baking sheet lined with parchment paper and bake for 15-18 minutes until golden brown.", 95, 8, "../data/postImages/GPID-50.jpg", 28, 1);



INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(51, "Classic Scrambled Eggs", "Fluffy and creamy scrambled eggs.", "In a bowl, whisk together 4 large eggs with salt and pepper. Heat a nonstick skillet over medium-low heat and add 1 tablespoon of butter. Pour in the eggs and cook, stirring gently with a spatula, until the eggs are softly set and slightly runny in places. Remove from heat and let the eggs finish cooking off the heat for a few moments. Serve immediately.", 85, 5, "../data/postImages/GPID-51.jpeg", 18, 17);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(52, "Cheesy Scrambled Eggs", "Scrambled eggs with melted cheese.", "In a bowl, whisk together 4 large eggs with salt and pepper. Heat a nonstick skillet over medium-low heat and add 1 tablespoon of butter. Pour in the eggs and cook, stirring gently with a spatula, until the eggs start to set. Sprinkle in 1/2 cup of shredded cheese and continue to cook until the eggs are softly set and the cheese is melted. Remove from heat and let the eggs finish cooking off the heat for a few moments. Serve immediately.", 80, 6, "../data/postImages/GPID-52.jpg", 18, 29);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(53, "Tropical Smoothie Bowl", "A refreshing smoothie bowl with tropical fruits.", "In a blender, combine 1 cup of frozen mango, 1 cup of frozen pineapple, 1 banana, and 1 cup of coconut milk. Blend until smooth and pour into a bowl. Top with sliced kiwi, shredded coconut, granola, and chia seeds.", 90, 4, "../data/postImages/GPID-53.jpg", 27, 12);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(54, "Berry Smoothie Bowl", "A vibrant smoothie bowl with mixed berries.", "In a blender, combine 1 cup of frozen mixed berries, 1 banana, 1/2 cup of Greek yogurt, and 1/2 cup of almond milk. Blend until smooth and pour into a bowl. Top with fresh berries, granola, sliced almonds, and a drizzle of honey.", 85, 5, "../data/postImages/GPID-54.jpeg", 27, 4);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(55, "Green Smoothie", "A nutritious green smoothie with spinach and banana.", "In a blender, combine 1 cup of fresh spinach, 1 banana, 1/2 cup of frozen mango, 1/2 cup of Greek yogurt, and 1 cup of almond milk. Blend until smooth and creamy. Serve immediately.", 95, 6, "../data/postImages/GPID-55.jpeg", 4, 24);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(56, "Peanut Butter Banana Smoothie", "A vegan, dairy-free, gluten-free and absolutely delicious smoothie!", "Peel a ripe frozen bananas and cut into 1-inch chunks. Mix bananas and peanut butter and place them in a blender. Blend them just until combined. Add a plant-based milk, you can also add a vanilla extract (optional). Customize your smoothie with some chocolate chips or maybe a chocolate chunks. Your Peanut Butter Banana Smoothie is ready to be served!", 90, 5, "../data/postImages/GPID-56.jpg", 4, 6);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(57, "Classic Waffles", "Light and crispy classic waffles.", "In a large bowl, whisk together 2 cups of all-purpose flour, 2 tablespoons of sugar, 1 tablespoon of baking powder, and 1/2 teaspoon of salt. In another bowl, whisk together 2 cups of milk, 2 large eggs, and 1/4 cup of melted butter. Pour the wet ingredients into the dry ingredients and stir until just combined. Preheat your waffle iron and grease it with butter or oil. Pour the batter into the waffle iron and cook until golden brown and crispy. Serve with syrup and your favorite toppings.", 100, 7, "../data/postImages/GPID-57.jpg", 2, 21);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(58, "Chocolate Chip Waffles", "Decadent waffles with chocolate chips.", "In a large bowl, whisk together 2 cups of all-purpose flour, 2 tablespoons of sugar, 1 tablespoon of baking powder, and 1/2 teaspoon of salt. In another bowl, whisk together 2 cups of milk, 2 large eggs, and 1/4 cup of melted butter. Pour the wet ingredients into the dry ingredients and stir until just combined. Fold in 1/2 cup of chocolate chips. Preheat your waffle iron and grease it with butter or oil. Pour the batter into the waffle iron and cook until golden brown and crispy. Serve with syrup and additional chocolate chips.", 95, 8, "../data/postImages/GPID-58.jpg", 2, 14);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(59, "Fruit and Yogurt Parfait", "A light and refreshing fruit and yogurt parfait.", "In a glass or bowl, layer 1/2 cup of Greek yogurt, 1/4 cup of granola, and 1/2 cup of mixed fresh fruits such as berries, kiwi, and strawberries. Repeat the layers until the glass is filled. Drizzle with honey and sprinkle with nuts or seeds if desired. Serve immediately.", 90, 5, "../data/postImages/GPID-59.jpg", 22, 13);

INSERT INTO `post` (`Post_ID`, `Post_Title`, `Post_Desc`, `Post_Content`, `Post_Likes`, `Post_Dislikes`, `Post_Image_Path`, `Profile_ID`, `Post_Tag_ID`) VALUES
(60, "Tropical Yogurt Parfait", "A tropical twist on a classic yogurt parfait.", "In a glass or bowl, layer 1/2 cup of Greek yogurt, 1/4 cup of granola, and 1/2 cup of diced tropical fruits such as mango, pineapple, and papaya. Repeat the layers until the glass is filled. Drizzle with honey and sprinkle with shredded coconut if desired. Serve immediately.", 85, 6, "../data/postImages/GPID-60.jpeg", 22, 16);

COMMIT;