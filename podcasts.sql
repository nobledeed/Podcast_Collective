-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2022 at 05:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `podcast_collective`
--

-- --------------------------------------------------------

--
-- Table structure for table `podcasts`
--

CREATE TABLE `podcasts` (
  `id` int(128) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `podcasts`
--

INSERT INTO `podcasts` (`id`, `title`, `content`) VALUES
(2, 'Daily Dad Jokes 3', ' 3 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Id porta nibh venenatis cras sed felis eget. Dignissim enim sit amet venenatis urna. Quisque egestas diam in arcu cursus euismod. Est lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque. Augue neque gravida in fermentum et sollicitudin ac orci. Ac tincidunt vitae semper quis lectus nulla at volutpat diam. Pellentesque pulvinar pellentesque habitant morbi tristique senectus et netus et. Turpis egestas integer eget aliquet nibh. Nunc consequat interdum varius sit. Ipsum faucibus vitae aliquet nec ullamcorper sit amet. Non enim praesent elementum facilisis leo vel. Quam id leo in vitae turpis. Suscipit adipiscing bibendum est ultricies integer quis auctor elit sed. Quisque sagittis purus sit amet volutpat consequat mauris nunc. Amet nulla facilisi morbi tempus iaculis. Faucibus interdum posuere lorem ipsum dolor. Adipiscing elit pellentesque habitant morbi tristique senectus et.'),
(3, 'The Problem with Jon Stewart', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Etiam erat velit scelerisque in dictum non consectetur a erat. Feugiat in fermentum posuere urna nec tincidunt. Vulputate mi sit amet mauris commodo. Tortor condimentum lacinia quis vel eros donec ac. Sed libero enim sed faucibus turpis in eu mi bibendum. Fringilla ut morbi tincidunt augue interdum. Purus in mollis nunc sed id. Et odio pellentesque diam volutpat commodo sed. Quis viverra nibh cras pulvinar mattis nunc sed. Eleifend mi in nulla posuere sollicitudin aliquam.'),
(11, 'New podcast', 'asdfasdf stghetyj tuukgfsdhdsfg   ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `podcasts`
--
ALTER TABLE `podcasts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `podcasts`
--
ALTER TABLE `podcasts`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
