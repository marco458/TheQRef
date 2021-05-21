-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2021 at 11:30 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theqref`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `QuizId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `QuizName` varchar(30) NOT NULL,
  `QuizDescription` varchar(200) NOT NULL,
  `QuizQuestions` varchar(5000) NOT NULL,
  `isPublic` int(11) NOT NULL,
  `enableComments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`QuizId`, `UserId`, `QuizName`, `QuizDescription`, `QuizQuestions`, `isPublic`, `enableComments`) VALUES
(23, 13, 'RealQuiz', 'This is the description for Real Quiz!!!', 'koliko nogu ima stol{1}:jednu,dvije,tri,cetiri=cetiri;\r\nkoje godisnje doba dolazi nakon proljeca{1}:zima,jesen,ljeto,proljece=ljeto;\r\nna kojoj strani zalazi Sunce{1}:istok,zapad,jug,sjever=zapad;\r\nsvakih koliko godina dolazi prijestupna godina{1}:2,3,4,5=4;\r\nkoje od navedenih boja su tople boje{2}:plava,zelena,zuta,crvena=crvena,zuta;\r\nodaberite dijelove ljudskog tijela{2}:noge,carape,ruke,mobitel=ruke,noge;\r\nkoji brojevi su prosti i neparni{2}:2,82,13,23=13,23;\r\nASCII vrijednosti kojih znakova su parne{2}:a,b,c,d=b,d;\r\nkako se zove programski jezik u kojemu je ovaj kviz napisan{3}:php;\r\nkako se zove grad koji u sebi sadrzi 3 slova \"lj\"{3}:trilj;', 1, 1),
(24, 13, 'ReallyHardQuiz', 'I said it will be hard one so i decided to turn off comments :)', 'Italian Football Club A.S. Bari plays their matches at{1}:Stadio Enzo Ricci,Stadio San Paolo,Stadio San Nicola,Stadio Delle Alpi=Stadio San Nicola;\r\nThe best scorer in the English Football League is{1}:Thierry Henry,Andrew Cole,Alan Shearer,Gary Lineker=Alan Shearer;\r\nBjorn Borg won Wimbledon _ times in a row{1}:3,7,9,5=5;\r\nIn what year did the Croatian men\'s basketball team win silver at the OG{1}:1992,1996,2000,2004=1992;\r\nThe height of the tennis net at the edges is{1}:92 cm,107 cm,124 cm,147 cm=107 cm;\r\nWhich team won the NBA title in 2011{1}:Dallas Mavericks,Miami Heat,Houston Rockets,Boston Celtics=Dallas Mavericks;\r\nWhat is the perimeter of the football ball (in cm){1}:56-58,60-62,68-70,74-76=68-70;\r\nWho was the most famous Croatian basketball player in the NBA{1}:Dario Saric,Drazen Petrovic,Bojan Bogdanovic,Dino Radja=Drazen Petrovic;\r\nThe first season of the Formula 1 race was in...{1}:1948,1950,1952,1954=1950;\r\nWhat year did the Mediterranean Games take place in Split{1}:1977,1978,1979,1980=1979;', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `UniqueQuizAttempt` int(20) NOT NULL,
  `QuizId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  `Comment` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`UniqueQuizAttempt`, `QuizId`, `UserId`, `Score`, `Comment`) VALUES
(26, 24, 15, 100, ''),
(27, 23, 15, 70, 'Good work Marko!'),
(28, 24, 15, 30, ''),
(29, 24, 15, 30, ''),
(30, 24, 15, 30, ''),
(31, 23, 15, 10, 'This was too easy :)'),
(32, 23, 14, 90, 'Great content, keep it up!!!'),
(33, 24, 14, 90, ''),
(34, 23, 14, 90, '90 percent, can you do better than me?'),
(35, 23, 15, 90, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Name`, `Surname`, `DateOfBirth`, `Email`, `Password`) VALUES
(13, 'Marko', 'Car', '2000-10-18', 'malinoj4321@gmail.com', '$2y$10$nVX6dyQHbw/PSO6fN/KzNOY7znA1uF6fiiejYSY6Iaj5oAzRfWfFC'),
(14, 'Matija', 'Car', '2005-04-01', 'malinoj321@gmail.com', '$2y$10$AxbQe8nYBdVPcPFC322DjODi/giWH9SKFGCUP16WUVX0DikNWSEOe'),
(15, 'Karlo', 'Knežević', '1989-12-11', 'kknezevic@gmail.com', '$2y$10$fNgvFTuva7rPXNtaLN9H1e7/h74ok5RQSPyvpu6DrqlVz5FvEkptu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`QuizId`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`UniqueQuizAttempt`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `QuizId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `UniqueQuizAttempt` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
