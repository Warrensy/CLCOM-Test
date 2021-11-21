-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2021 at 04:54 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment_text` varchar(512) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_text`, `date`, `user_id`, `post_id`) VALUES
(0, 'great', '2021-01-23 16:15:20', 40, 81),
(1, 'Some comment text ...', '2021-01-21 00:16:24', 1, 0),
(2, 'stufffdkfsö', '2021-01-21 00:40:36', 40, 0),
(3, 'Kommentar', '2021-01-21 16:18:52', 40, 0),
(4, 'ne mogu da vjerujem', '2021-01-23 14:03:16', 40, 78),
(5, 'Ni ja', '2021-01-23 14:07:22', 40, 78),
(6, 'Sta je ovo bokte jebo??!?', '2021-01-23 14:07:35', 40, 78),
(7, 'Ne znam i ja sam se isto zapitao, nego, po dr. Jovanu Dereticu ...', '2021-01-23 14:07:59', 40, 78),
(8, 'O jest lijepa suma wooooow', '2021-01-23 14:11:13', 40, 77),
(9, 'Kanistu viniga?', '2021-01-23 14:11:33', 40, 78),
(10, 'Kanistu viniga?', '2021-01-23 14:13:26', 40, 78),
(11, 'Kanistu viniga?', '2021-01-23 14:19:19', 40, 78),
(12, 'Kanistu viniga?', '2021-01-23 14:20:29', 40, 78),
(13, '', '2021-01-23 15:19:26', 40, 79),
(14, 'Fino!', '2021-01-23 15:19:38', 40, 81);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(6) NOT NULL,
  `friendId` int(6) NOT NULL,
  `accepted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `friendId`, `accepted`) VALUES
(39, 40, 0),
(39, 42, 0),
(39, 43, 0),
(39, 44, 0),
(39, 45, 0),
(39, 47, 0),
(39, 49, 0),
(39, 50, 0),
(39, 51, 0),
(39, 52, 0),
(46, 39, 1),
(46, 40, 0),
(46, 42, 0),
(46, 43, 0),
(46, 44, 0),
(46, 45, 0),
(46, 47, 0),
(46, 48, 1),
(46, 51, 0),
(46, 52, 0),
(46, 53, 0),
(46, 54, 0),
(46, 55, 0),
(46, 56, 0),
(46, 57, 0),
(46, 58, 0),
(46, 59, 0),
(46, 60, 0),
(46, 61, 1),
(48, 39, 1),
(48, 40, 0),
(48, 42, 0),
(48, 43, 0),
(48, 44, 0),
(48, 45, 0),
(48, 47, 0),
(48, 49, 0),
(48, 50, 0),
(48, 51, 0),
(48, 52, 0),
(48, 53, 0),
(48, 54, 0),
(48, 55, 0),
(48, 56, 0),
(48, 57, 0),
(48, 58, 0),
(48, 59, 0),
(48, 60, 0),
(48, 61, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `tags` varchar(255) DEFAULT '#NoTag',
  `image_path` varchar(255) DEFAULT NULL,
  `likes` int(255) DEFAULT NULL,
  `dislikes` int(255) DEFAULT NULL,
  `private` tinyint(1) DEFAULT NULL,
  `post_text` varchar(512) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `tags`, `image_path`, `likes`, `dislikes`, `private`, `post_text`, `date`) VALUES
(119, 40, '#cool', 'public/posts/elonMusk.jpg', NULL, NULL, 0, 'Was ist cool?', '2021-01-23 22:41:25'),
(120, 40, '#cool', 'public/posts/Elvis_Presley.jpeg', 2, 2, 0, 'sehr cool.', '2021-01-23 22:41:36'),
(121, 39, '#test', 'public/posts/Bill_Gates.jpg', NULL, NULL, 0, 'test', '2021-01-24 12:21:34'),
(122, 39, '#tutorial', 'public/posts/editporfileinfo.png', NULL, NULL, 0, 'mankind', '2021-01-24 12:21:51'),
(123, 39, '#test', 'public/posts/editprofilepicture.png', NULL, NULL, 0, 'Hey test', '2021-01-24 12:22:05'),
(133, 40, '#private', 'public/posts/admin2.JPG', NULL, NULL, 1, 'privat posts rule. My friends', '2021-01-24 14:13:43'),
(134, 40, '#femalepower', 'public/posts/amiliaErhart.jpg', NULL, NULL, 1, 'Hello PlainGirl!!!!', '2021-01-24 14:19:08'),
(135, 47, '#private', 'public/posts/admin1.JPG', NULL, NULL, 1, 'private post from plain gril', '2021-01-24 14:32:41'),
(136, 47, '#private', 'public/posts/', NULL, NULL, 0, 'cool', '2021-01-24 15:37:16'),
(137, 47, '#cool', 'public/posts/', NULL, NULL, 0, 'test', '2021-01-24 15:44:24'),
(138, 48, '#cool#summer#test', 'public/posts/Dorian.png', NULL, NULL, 0, 'test text user gold train', '2021-01-24 16:18:47'),
(139, 48, '#cool #summer #test', 'public/posts/', NULL, NULL, 0, 'more tags', '2021-01-24 16:19:35'),
(140, 48, '#cool,#summer,#test', 'public/posts/', NULL, NULL, 0, '', '2021-01-24 16:19:53'),
(148, 48, '', 'public/posts/', NULL, NULL, 0, 'asd', '2021-01-24 16:41:42'),
(149, 48, '', 'public/posts/', NULL, NULL, 0, 'asd', '2021-01-24 16:47:45'),
(150, 48, '', 'public/posts/Elvis_Presley.jpeg', NULL, NULL, 0, '', '2021-01-24 16:48:00'),
(151, 48, '', 'public/posts/Elvis_Presley.jpeg', NULL, NULL, 0, '', '2021-01-24 16:48:47'),
(152, 48, '', 'public/posts/elonMusk.jpg', NULL, NULL, 0, 'asdasd', '2021-01-24 16:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `anrede` char(1) NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `lastLogin` datetime NOT NULL,
  `profilePicture` varchar(200) NOT NULL DEFAULT 'defaultProfilePicture.JPG',
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `anrede`, `vorname`, `nachname`, `username`, `password`, `email`, `admin`, `lastLogin`, `profilePicture`, `active`) VALUES
(39, 'f', 'admin', 'admin', 'admin', '$2y$10$hMhOV/ie1CA9q2adwuuc1OUo4AEDrCDpUikRx2YsX6mHUqttf.pV6', 'admin@e.com', 1, '2021-01-15 18:05:50', 'defaultProfilePicture.JPG', 1),
(40, 'f', 'Mensch', 'Maurich', 'user', '$2y$10$7CWLbCVM9noMxBJCbDIVn.m7c3ig/CuHhXk3kTQmlTB18OdLza9PG', 'tester@tester.com', 0, '2021-01-16 13:57:33', 'defaultProfilePicture.JPG', 1),
(42, 'f', 'Jody', 'Wagner', 'Joderich', '$2y$10$LmsFtuFwe95jpnSAMOY5RezSSvJvu17lUjijEG2yoVGXTkG0kA6PO', 'jfdjz@gnjrsxnhgfrx.com', 0, '0000-00-00 00:00:00', 'defaultProfilePicture.JPG', 1),
(43, 'f', 'Jelena', 'Bla', 'Jelena', '$2y$10$G9tMb8KoW7FFhXMh3vvM1uu6LeDAHRRoLlIGDm9hnVb7Biy/uTKti', 'jelena@user.com', 0, '0000-00-00 00:00:00', 'defaultProfilePicture.JPG', 1),
(44, 'm', 'Martin', 'Müller', 'Martin', '$2y$10$Swqe2LS8AaHYoA48K5jC.e6ktcTU58BxL4ORfeJsTePPYKBrDr.d.', 'martin@müller.com', 0, '0000-00-00 00:00:00', 'defaultProfilePicture.JPG', 1),
(45, 'f', 'Martina', 'Meyer', 'Martina', '$2y$10$4KBtTgxgmBN09H/xxAe5HeFWd/59eWU7Z0JkKyvzV0.xHkFMjpE0O', 'mar@meyer.com', 0, '0000-00-00 00:00:00', 'defaultProfilePicture.JPG', 1),
(46, 'm', 'Elon', 'Musk', 'Elon', '$2y$10$3tjIrfeWrie6strDF0xpcOD83Tt.CIwju67WGgUciRA5Gx4oi.Jxe', 'elon@musk.com', 0, '0000-00-00 00:00:00', 'elonMusk.jpg', 1),
(47, 'f', 'Amelia', 'Earhart', 'PlainGirl', '$2y$10$q5dsZCM6b71JT6EXeufPneaq/FcBMTVoKGMIw0mQ1WJ2Hjd8X5ps.', 'plainGirl@fly.com', 0, '0000-00-00 00:00:00', 'amiliaErhart.jpg', 1),
(48, 'm', 'Albert', 'Einstein', 'Einstein', '$2y$10$F9RuEmWhQy4d5c1yzaorc.euWGeDy9yeDHBAq8ur9Cc0pKtw.FoIO', 'albert@steiniger.com', 0, '0000-00-00 00:00:00', 'einstein.jpg', 1),
(49, 'm', 'Raid', 'Shadowlegends', 'Raid', '$2y$10$RzsiumyIzAenBN/giDBeYe7RhP08W7bIKfeJn7ihvpB9WBQs2znSO', 'raid@shadowlegends.com', 0, '0000-00-00 00:00:00', 'raidshadow.jpg', 1),
(50, 'm', 'Abraham', 'Lincoln', 'Lincinator', '$2y$10$ARza2UnyaJTLxONaXiROO.RaSLRilxOwkopo8XUhmCpZLgmtsAkYu', 'lincoln@abra.com', 0, '0000-00-00 00:00:00', 'Abraham_Lincoln.jpg', 1),
(51, 'm', 'Martin Luther', 'King', 'FreeBee', '$2y$10$4cz7xfECw1vIf/DkFmWb.ukbwW6I68TCPYt3aFClv3zzlMsXdUEiO', 'freebee@king.com', 0, '0000-00-00 00:00:00', 'Martin_Luther_King.jpg', 1),
(52, 'm', 'Elizabeth', 'II', 'realQueen', '$2y$10$7JvW4btfO7loELVARxhV..FyWpLVd5BmkFbEg.UHOWlVb3YCvHgo.', 'queen@royal.com', 0, '0000-00-00 00:00:00', 'Queen_Elizabeth_II.jpg', 1),
(53, 'm', 'Bill', 'Gates', 'ComputerGuy', '$2y$10$k6PlSqjJoXuyIAavNGNkTeqUNPFrBjw8qJ0QAhasm7ta3mXUsp4oC', 'billiy@thekid.com', 0, '0000-00-00 00:00:00', 'Bill_Gates.jpg', 1),
(54, 'm', 'Elvis', 'Presley', 'RollitBabay', '$2y$10$OBQ50mnwmJtGtm4arJsJ..Cw5JcCcvg72MhwH49jvSveHYnRVN9GS', 'rockn@roll.com', 0, '0000-00-00 00:00:00', 'Elvis_Presley.jpeg', 1),
(55, 'm', 'Leonardo', 'da Vinci', 'YouChill', '$2y$10$n1s/WmLtCvzK9kCrBOKXlOy12mYYajZked6nG2.nHMBX/69IuTv5W', 'leonardo@art.com', 0, '0000-00-00 00:00:00', 'leonardo-da-vinci.jpg', 1),
(56, 'm', 'Florian', 'Hulahup', 'Florian', '$2y$10$jZOQo5uFbmnj4PMFFrD/C.3OeS.VtsfoXKiK3iCLTlhvOELZDxDwK', 'florian@gmx.at', 0, '0000-00-00 00:00:00', 'Bill_Gates.jpg', 1),
(57, 'm', 'Dorian', 'Admin', 'TheBoss', '$2y$10$ma3HmF8M5aaYfhmLX2XX6ujJRgBflax.BWEgclKfRh5YEmmmDFYSy', 'dorian@admin.com', 1, '0000-00-00 00:00:00', 'dorian_fetty.jpg', 1),
(58, 'm', 'Lisa', 'Parabiliana', 'FlowerGeek', '$2y$10$Zf0T.j47hB6wuT8ISpHhkutmJNcH2ix2kl90yCpRPSiFd2vND0PdC', 'lisa@flowie.com', 0, '0000-00-00 00:00:00', 'defaultProfilePicture.JPG', 1),
(59, 'm', 'dorianasd', 'Adminasd', 'Florianasd', '$2y$10$rufOTfmeGabwUXSMpy5b0uHaBRl/Q94c4jqOOSvpby9LQj2e417YC', 'admin@cads.com', 0, '0000-00-00 00:00:00', 'defaultProfilePicture.JPG', 1),
(60, 'm', 'figth', 'bee', 'FightBee', '$2y$10$dJ4ZHW17jktXfo.1HkMXoOxKeHWRBObNA1Ye0x9j4NVK3OGr3EWwm', 'fight@bee.com', 0, '0000-00-00 00:00:00', 'defaultProfilePicture.JPG', 1),
(61, 'f', 'Julia ', 'Steiner', 'Julia', '$2y$10$DJFjCwxbYfaXoj8Pmi1uQ.IXDKfs8cwEdIVYueejz.uFBTzYeadsu', 'juliasteiner@gmx.at', 0, '0000-00-00 00:00:00', 'defaultProfilePicture.JPG', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`,`friendId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
