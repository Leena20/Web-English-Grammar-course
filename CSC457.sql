-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 11:20 AM
-- Server version: 8.0.23
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CSC457`
--

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `quizTitle` varchar(200) NOT NULL,
  `ranking` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id`, `title`, `content`, `quizTitle`, `ranking`) VALUES
(1, 'Proper Nouns And Common Nouns', '\r\n              <p>You have learnt about <a href=\"https://www.kidsworldfun.com/learn-english/nouns.php\" title=\"Learn English Grammar - Nouns\">nouns,</a> haven’t you? There are different types of nouns. One classification of nouns is as <strong>proper nouns</strong> and <strong>common nouns.</strong></p>\r\n              <p> A <strong>proper noun</strong> is the name of a particular person, event, place or thing. Examples are Freddie, Canada, Coca Cola, Christmas etc. Proper nouns begin with a capital letter. They are not preceded by articles such as ‘a’, or ‘an’ but are sometimes preceded by ‘the’ when it is part of the proper name, as in ‘The Philippines’.</p>\r\n              <p> A <strong>common noun,</strong> on the other hand, is not the name of a particular person, thing or place, but is a word that is used to refer to the class or group to which the proper nouns belong. For example, Freddie is a proper noun, but boy is a common noun. Canada is a proper noun whereas country is a common noun. Generally common nouns do not start with a capital letter, unless it is the first word of a sentence. </p>\r\n              <p> In contrast to a proper noun, a common noun can be preceded by an article such as ‘a’, ‘an’ or ‘the’. It is perfectly correct to say ‘a boy’ but not ‘a Freddie’.</p>', 'Proper Nouns And Common Nouns Quiz', 1),
(2, 'Singular Nouns and Plural Nouns', 'You\'ve already learnt about common nouns and pronouns, now let\'s dive deeper into the world of nouns! <br>There are different types of nouns. One classification of nouns is as singular nouns and plural nouns.</p><h2>What are singular nouns?</h2><p>Singular means one. A singular noun refers to <strong>only one</strong> person, place, or thing.<br><strong>For example:</strong> <br><strong>Person:</strong> Mother<br><strong>Place:</strong> School<br><strong>Thing:</strong> Pencil </p><h2>What are plural nouns?</h2><p>Plural means two or more than two. A plural noun refers to <strong>more than one</strong> person, place, or thing.<br><strong>For example:</strong> <br><strong>Person:</strong> Mother<strong>s</strong><br><strong>Place:</strong> School<strong>s</strong><br><strong>Thing:</strong> Pencil<strong>s</strong></p><p>Plural nouns are a little trickier than singular, there are more variations. But don\'t get discouraged, we\'ll take it step by step.<br></p><h3>1. Words that end in Y add IES</h3><p><strong>Examples:</strong><br>Baby &#8594 Babies<br>Cherry &#8594 Cherries<br>Puppy &#8594 Puppies</p><h3>2. Words that end in X, S, SH, CH add ES</h3><p><strong>Examples:</strong><br>Box &#8594 Boxes<br>Bus &#8594 Busses<br>Bush &#8594 Bushes<br>Couch &#8594 Couches</p><h3>3. Words that end in F add VES</h3><p><strong>Examples:</strong><br>Leaf &#8594 Leaves<br>Wolf &#8594 Wolves<br>Scarf &#8594 Scarves</p><p>Excellent job! Now you\'re ready to take the quiz.</p>', 'Singular Nouns and Plural Nouns Quiz', 2),
(3, 'Countable and Uncountable Nouns', '<p>Nouns name people, animals, places, things, and ideas. In English, there are different types or classes of nouns. In this lesson, you will learn about <strong>countable</strong> and <strong>uncountable</strong> nouns!</p>\r\n\r\n<h4>WHAT IS A COUNTABLE NOUN?</h4>\r\n<p><strong>Countable nouns</strong> are for things we can count using numbers. They have a singular and a plural form. <br>\r\nLook around you. How many books can you see? How many pens? Let\'s count! <br>\r\nThese are examples of countable nouns.</p>\r\n\r\n<h4>WHAT IS AN UNCOUNTABLE NOUN?</h4>\r\n<p><strong>Uncountable nouns</strong> are for the things that we cannot count with numbers. They have no plural form. <br>\r\nImagine you have some bread in the basket, cheese on the plate and milk in the jug. We can\'t count bread itself, but we can count slices of bread. We can\'t count cheese, but we can count pieces of cheese. We can\'t count milk, but we can count jugs of milk.</p>\r\n\r\n<h4>QUESTIONS</h4>\r\n<p>\r\n	In questions we use a/an, any or how many with countable nouns.\r\n	<ul>\r\n		<li>Is there an email address to write to?</li>\r\n		<li>Are there any chairs?</li>\r\n		<li>How many chairs are there?</li>\r\n	</ul>\r\n\r\n	And we use any or how much with uncountable nouns.\r\n	<ul>\r\n		<li>Is there any sugar?</li>\r\n		<li>How much orange juice is there?</li>\r\n	</ul>\r\n\r\n	But when we are offering something or asking for something, we normally use some.\r\n	<ul>\r\n		<li>Do you want some chocolate?</li>\r\n		<li>Can we have some more chairs, please?</li>\r\n	</ul>\r\n\r\n	We also use some in a question when we think the answer will be \'yes\'.\r\n	<ul>\r\n		<li>Have you got some new glasses?</li>\r\n	</ul>\r\n\r\n</p>', 'Countable and Uncountable Nouns', 3);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int NOT NULL,
  `lessonId` int NOT NULL,
  `question` varchar(200) NOT NULL,
  `option1` varchar(200) NOT NULL,
  `option2` varchar(200) NOT NULL,
  `option3` varchar(200) NOT NULL,
  `option4` varchar(200) NOT NULL,
  `correctOption` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `lessonId`, `question`, `option1`, `option2`, `option3`, `option4`, `correctOption`) VALUES
(1, 1, 'My sister is coming home next week\", In this sentence, \"sister\" is a', 'Common noun', 'Proper noun', 'not a noun ', 'both ', 1),
(2, 1, 'Mr. John likes to go cycling to work\",  In this sentence, \"Mr. John\" is a', 'Common noun', 'Proper noun', 'not a noun ', 'both ', 2),
(3, 1, 'Do we have to attend the wedding\",  In this sentence, \"wedding\" is a', 'Common noun', 'Proper noun', 'not a noun ', 'both ', 1),
(4, 1, 'The World Health Organisation is organising a health workshop in our capital city\", In this sentence, \" World Health Organisation\" is a', 'Common noun', 'Proper noun', 'not a noun ', 'both ', 2),
(5, 2, 'What is the plural of box?', 'boxs', 'boxes', 'boxess', 'box', 2),
(6, 2, 'Which sentence has a singular noun?', 'The dogs played together.', 'My parents are happy.', 'The table is dirty.', 'The students studied hard.', 3),
(7, 2, 'This shop has a lot of different ___.', 'potato', 'potatoess', 'potatos', 'potatoes', 4),
(8, 2, 'What does a singular noun represent?', '1 thing', 'more than 1 thing', 'Nothing', 'More than 3 things', 1),
(9, 3, 'I don\'t like black coffee. I usually have it with______', 'many milk', 'milk and sugar', 'two pieces of sugar', 'All of the above', 2),
(10, 3, 'The receptionist at the front desk gave me two______', 'pieces of information', 'information', 'informations', 'All of the above', 1),
(11, 3, 'My cousin is very beautiful. She has green eyes and______', 'long hair', 'long hairs', 'a long hair', 'All of the above', 1),
(12, 3, 'What would you like in your sandwich? I\'ll have______, lettuce and mayonaise.', 'some chickens', 'a chickens', 'some chicken', 'All of the above', 3);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_score`
--

CREATE TABLE `quiz_score` (
  `usersId` int NOT NULL,
  `lessonId` int NOT NULL,
  `score` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quiz_score`
--

INSERT INTO `quiz_score` (`usersId`, `lessonId`, `score`) VALUES
(1, 1, 2),
(1, 2, 0),
(2, 1, 1),
(2, 2, 1),
(3, 1, 0),
(3, 2, 1),
(1, 1, 2),
(1, 2, 1),
(1, 3, 1),
(7, 1, 3),
(7, 2, 4),
(7, 3, 4),
(1, 1, 0),
(1, 1, 0),
(1, 1, 3),
(1, 1, 3),
(1, 2, 2),
(1, 1, 0),
(1, 1, 0),
(1, 1, 0),
(9, 1, 2),
(9, 2, 1),
(9, 3, 1),
(1, 1, 2),
(1, 2, 0),
(1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Nora aqeeli', 'n@n.com', '1234'),
(2, 'noara ', 'n@k.com', '1234'),
(3, 'deema', 'd@d.com', '1234'),
(4, 'meme', 'm@m.com', '12'),
(5, 'fofa', 'f@f.com', 'kaskfkhf'),
(6, 'asd', 'root@FGDH.CWF', ''),
(7, 'SSW', 's@s.com', '123'),
(8, 'g', 'g@g.com', '1'),
(9, 'Nora aqeeli', 'nn@n.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lesson_ranking_uindex` (`ranking`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_lesson_id_fk` (`lessonId`);

--
-- Indexes for table `quiz_score`
--
ALTER TABLE `quiz_score`
  ADD KEY `quiz_score_lesson_id_fk` (`lessonId`),
  ADD KEY `quiz_score_users_id_fk` (`usersId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_uindex` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_lesson_id_fk` FOREIGN KEY (`lessonId`) REFERENCES `lesson` (`id`);

--
-- Constraints for table `quiz_score`
--
ALTER TABLE `quiz_score`
  ADD CONSTRAINT `quiz_score_lesson_id_fk` FOREIGN KEY (`lessonId`) REFERENCES `lesson` (`id`),
  ADD CONSTRAINT `quiz_score_users_id_fk` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
