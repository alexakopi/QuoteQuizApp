-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 10:12 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quote_quiz_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `is_right` tinyint(1) NOT NULL,
  `answer` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `is_right`, `answer`) VALUES
(1, 1, 1, 'Nelson Mandela'),
(2, 1, 0, 'Mahatma Gandhi'),
(3, 1, 0, 'Che Guevara'),
(4, 2, 0, 'Coco Chanel'),
(5, 2, 1, 'Mother Teresa'),
(6, 2, 0, 'Joan of Arc'),
(7, 5, 1, 'Oscar Wilde'),
(8, 5, 0, 'Erich Maria Remarque'),
(9, 5, 0, 'Honoré de Balzac'),
(10, 6, 1, 'John Lennon'),
(11, 6, 0, 'Paul McCartney'),
(12, 6, 0, 'George Harrison'),
(13, 7, 1, 'Bob Marley'),
(14, 7, 0, 'Mick Jagger'),
(15, 7, 0, 'Jimi Hendrix'),
(16, 8, 1, 'Thomas A. Edison'),
(17, 8, 0, 'Nikola Tesla'),
(18, 8, 0, 'Niels Bohr'),
(19, 9, 1, 'Winston S. Churchill'),
(20, 9, 0, 'Joseph Stalin'),
(21, 9, 0, 'Franklin D. Roosevelt'),
(22, 10, 1, 'Albert Einstein'),
(23, 10, 0, 'Isaac Newton'),
(24, 10, 0, 'Ernest Rutherford'),
(25, 11, 1, 'Abraham Lincoln'),
(26, 11, 0, 'Theodore Roosevelt'),
(27, 11, 0, 'George Washington'),
(28, 12, 1, 'Henry Ford'),
(29, 12, 0, 'Karl Benz'),
(30, 12, 0, 'Alexander Graham Bell'),
(31, 13, 1, 'Walt Disney'),
(32, 13, 0, 'Steve Jobs'),
(33, 13, 0, 'Charlie Chaplin');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`) VALUES
(1, 'The greatest glory in living lies not in never falling, but in rising every time we fall.'),
(2, 'Spread love everywhere you go. Let no one ever come to you without leaving happier.'),
(5, 'Life is never fair, and perhaps it is a good thing for most of us that it is not'),
(6, 'Life is what happens when you\'re busy making other plans.'),
(7, 'Love the life you live. Live the life you love.'),
(8, 'Many of life\'s failures are people who did not realize how close they were to success when they gave up.'),
(9, 'Success is not final; failure is not fatal: It is the courage to continue that counts.'),
(10, 'Try not to become a man of success. Rather become a man of value.'),
(11, 'Always bear in mind that your own resolution to success is more important than any other one thing.'),
(12, 'Whether you think you can or you think you can\'t, you\'re right.'),
(13, 'The way to get started is to quit talking and begin doing.');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'binary', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
