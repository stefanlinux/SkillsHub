-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2015 at 11:37 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skillshub`
--

-- --------------------------------------------------------

--
-- Table structure for table `markt`
--

CREATE TABLE IF NOT EXISTS `markt` (
`id` int(11) NOT NULL,
  `opdrachtgever` varchar(40) NOT NULL,
  `voornaam` varchar(40) NOT NULL,
  `achternaam` varchar(40) NOT NULL,
  `tel` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `plaats` varchar(30) NOT NULL,
  `straat` varchar(30) NOT NULL,
  `postcode` varchar(30) NOT NULL,
  `website` varchar(30) NOT NULL,
  `linkedin` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `markt`
--

INSERT INTO `markt` (`id`, `opdrachtgever`, `voornaam`, `achternaam`, `tel`, `email`, `plaats`, `straat`, `postcode`, `website`, `linkedin`) VALUES
(2, 'Welzin', 'Jolande', 'Koelewijn', '12356546', 'Jolande.Koelewijn@welzin.nl', 'Amersfoort', 'Drentsestraat 14', '3812 EH', 'http://www.welzin.nl', 'nl.linkedin.com/pub/jolande-koelewijn/31'),
(6, 'Rabia', 'Rabia', '', '', '', '', '', '', '', ''),
(10, 'Pimpelpaars', '', '', 'o3834i563i4756', '', '', '', '', '', ''),
(11, 'Testbedrijf123', '', '', '033-1234568', '', 'Amersfoort', 'Stationsplein 12', '3811AB', 'www.test123.nl', '');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
`id` int(11) NOT NULL,
  `project` text NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `opdrachtgever`
--

CREATE TABLE IF NOT EXISTS `opdrachtgever` (
`id` int(11) NOT NULL,
  `voornaam` varchar(30) NOT NULL,
  `tussenvoegsel` varchar(30) NOT NULL,
  `achternaam` varchar(30) NOT NULL,
  `volledigenaam` varchar(40) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `opdrachtgever` varchar(30) NOT NULL,
  `mail` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `opdrachtgever`
--

INSERT INTO `opdrachtgever` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `volledigenaam`, `tel`, `opdrachtgever`, `mail`) VALUES
(9, 'Jantje', 'puk', 'pak', 'Jantje puk pak', '12356546', '2', 'dffgh@hotmail.com'),
(16, 'hjk', 'hjk', 'hjk', 'hjk hjk hjk', 'hjk', '10', 'hkj');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
`id` int(11) NOT NULL,
  `naam` varchar(80) NOT NULL,
  `omschrijving` text NOT NULL,
  `evaluatie` text NOT NULL,
  `skills` text NOT NULL,
  `startdatum` date NOT NULL,
  `einddatum` date NOT NULL,
  `projectleider` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `opdrachtgever` varchar(30) NOT NULL,
  `bedrijf` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `naam`, `omschrijving`, `evaluatie`, `skills`, `startdatum`, `einddatum`, `projectleider`, `status`, `opdrachtgever`, `bedrijf`) VALUES
(18, 'Test', 'Het project test gaat over het testen van bepaalde test situaties, die we met z&#39;n allen kunnen testen :o', '', 'Sociaal, fotograferen, Hoi, hallo', '2014-11-14', '2014-11-30', 9, 2, '9', '2'),
(22, 'D66 animatie', 'Het verkiezingsprogramma van D66 voor de gemeenteraadsverkiezingen 2014 moet omgezet worden naar een animatiefilmpje van 2 a 3 minuten', '', 'film\r\nanimeren\r\n', '2013-11-13', '2013-11-28', 13, 0, '9', '2'),
(24, 'Belgenmonument', 'Belgenmonument\r\n\r\nOnderzoek functies met de aanleiding ...', '', '', '2013-11-25', '2013-12-10', 31, 0, '9', '2'),
(25, 'Help Syrië de winter', 'Is ontwerpen en/of programmeren echt jouw ding, bied je aan om mij te helpen! Ik heb Jullie hulp nodig!', '', 'Programmeren, Indesign, Illustrator, Photoshop', '2013-11-28', '2013-12-02', 9, 1, '9', '2'),
(31, 'Tafelpoot', 'sdjhfksdgf', '', 'oranje', '0000-00-00', '0000-00-00', 15, 0, '9', '2'),
(32, 'TestingmetF', 'DIt is een test', '', 'sociaal, fotograsfsfsdf,', '0000-00-00', '0000-00-00', 6, 0, '9', '2'),
(33, 'testp', 'test', '', '', '0000-00-00', '0000-00-00', 0, 0, '', ''),
(34, 'Testp1', 'test123', '', '', '0000-00-00', '0000-00-00', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `projectskills`
--

CREATE TABLE IF NOT EXISTS `projectskills` (
`id` int(11) NOT NULL,
  `projectid` int(11) NOT NULL,
  `skillid` int(11) NOT NULL,
  `lvl` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `projectskills`
--

INSERT INTO `projectskills` (`id`, `projectid`, `skillid`, `lvl`) VALUES
(1, 32, 19, 0),
(2, 32, 17, 0),
(49, 24, 17, 0),
(51, 24, 22, 0),
(52, 24, 26, 0),
(53, 24, 27, 0),
(54, 24, 28, 0),
(56, 31, 17, 0),
(57, 22, 17, 0),
(58, 18, 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projectsusers`
--

CREATE TABLE IF NOT EXISTS `projectsusers` (
`id` int(11) NOT NULL,
  `project` varchar(100) NOT NULL,
  `usersid` varchar(20) NOT NULL,
  `omschrijving` varchar(500) NOT NULL,
  `functie` varchar(30) NOT NULL,
  `accept` varchar(10) NOT NULL,
  `projectid` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=190 ;

--
-- Dumping data for table `projectsusers`
--

INSERT INTO `projectsusers` (`id`, `project`, `usersid`, `omschrijving`, `functie`, `accept`, `projectid`) VALUES
(103, 'Test', '9', 'Deze jongen heeft zijn uiterste best gedaan het project op de rails te krijgen', '', '3', 18),
(106, 'Test', '8', '', 'Vormgever', '3', 18),
(111, 'Test', '6', '', '', '3', 18),
(135, 'Test', '7', '', '', '3', 18),
(139, 'Charles', '9', '', '', '3', 24),
(141, 'Help Syrië de winter', '9', '', '', '3', 25),
(154, 'Test', '10', '', '', '3', 18),
(157, 'Belgenmonument', '31', '', '', '3', 24),
(164, 'Help Syrië de winter', '10', '', '', '3', 25),
(166, 'Sponsowworld', '6', '', '', '3', 0),
(168, 'D66 animatie', '15', '', '', '3', 22),
(171, 'Belgenmonument', '6', '', 'Nitwit', '3', 24),
(172, 'Belgenmonument', '15', '', '', '3', 24),
(173, 'Tafelpoot', '15', '', '', '3', 31),
(174, 'D66 animatie', '10', '', '', '1', 22),
(175, 'Belgenmonument', '10', '', '', '1', 24),
(176, 'D66 animatie', '6', '', 'Leider', '3', 22),
(177, 'TestingmetF', '6', '', '', '3', 32),
(178, 'TestingmetF', '9', '', '', '2', 32),
(179, 'TestingmetF', '10', '', '', '3', 32),
(180, 'D66 animatie', '34', '', '', '1', 22),
(182, '24', '27', '', '', '2', 24),
(184, '24', '36', '', '', '3', 24),
(187, '22', '36', '', '', '1', 0),
(188, 'testp', '', '', '', '3', 0),
(189, 'Testp1', '', '', '', '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
`id` int(11) NOT NULL,
  `skill` varchar(20) NOT NULL,
  `divisie` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill`, `divisie`) VALUES
(17, 'Fotograferen', 1),
(18, 'PHP', 2),
(19, 'Sociaal', 3),
(20, 'Fantasierijk', 3),
(21, 'WordPress', 2),
(22, 'Creabea', 4),
(23, 'Indesign', 5),
(24, 'Illustrator', 5),
(25, 'Positief', 3),
(26, 'Hulpvaardig', 3),
(27, 'Photoshop', 5),
(28, '3D MAX', 7),
(29, 'Leuk zijn', 3),
(30, 'Webdesign', 5),
(31, 'Vormgeving', 5);

-- --------------------------------------------------------

--
-- Table structure for table `skillsusers`
--

CREATE TABLE IF NOT EXISTS `skillsusers` (
`id` int(11) NOT NULL,
  `usersid` int(11) NOT NULL,
  `skill` int(11) NOT NULL,
  `lvl` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `skillsusers`
--

INSERT INTO `skillsusers` (`id`, `usersid`, `skill`, `lvl`) VALUES
(101, 7, 17, 2),
(102, 9, 17, 2),
(104, 10, 18, 2),
(106, 10, 19, 1),
(107, 10, 21, 0),
(108, 9, 19, 0),
(109, 9, 18, 2),
(110, 9, 20, 2),
(111, 9, 21, 2),
(112, 8, 17, 2),
(113, 8, 19, 2),
(114, 8, 20, 2),
(115, 6, 17, 0),
(116, 6, 19, 1),
(117, 6, 21, 2),
(120, 7, 22, 2),
(122, 7, 20, 2),
(123, 9, 22, 1),
(126, 7, 23, 1),
(127, 7, 25, 1),
(128, 7, 27, 0),
(130, 29, 26, 0),
(131, 29, 20, 0),
(132, 29, 19, 0),
(134, 15, 23, 2),
(135, 15, 24, 2),
(136, 15, 27, 2),
(138, 23, 17, 1),
(139, 6, 29, 2),
(140, 10, 27, 2),
(141, 10, 24, 2),
(142, 10, 25, 2),
(168, 36, 18, 2),
(169, 36, 17, 0),
(170, 36, 19, 0),
(171, 36, 20, 1),
(172, 36, 21, 2),
(173, 36, 22, 1),
(174, 36, 24, 1),
(175, 36, 25, 1),
(176, 36, 26, 2),
(177, 36, 27, 2),
(179, 36, 30, 2),
(180, 36, 31, 1),
(181, 34, 17, 2),
(182, 34, 18, 1),
(183, 34, 21, 2),
(184, 34, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `tussenvoegsel` varchar(30) NOT NULL,
  `achternaam` varchar(30) NOT NULL,
  `volledigenaam` varchar(40) NOT NULL,
  `age` int(3) NOT NULL,
  `adres` varchar(30) NOT NULL,
  `woonplaats` varchar(30) NOT NULL,
  `functie` varchar(30) NOT NULL,
  `beschikbaarheid` text NOT NULL,
  `motivatie` text NOT NULL,
  `leerdoel` text NOT NULL,
  `tel` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `linkedin` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL,
  `accounttype` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `naam`, `tussenvoegsel`, `achternaam`, `volledigenaam`, `age`, `adres`, `woonplaats`, `functie`, `beschikbaarheid`, `motivatie`, `leerdoel`, `tel`, `email`, `linkedin`, `site`, `accounttype`, `status`) VALUES
(6, 'Mels', 'd55b21b80d6f96f43dfa2342e2d32c202d56918897af892341d7fe51fac4b1375aa4ab670b76a2ef4ec52fcb4a15a02cfad09122c12622d95c5d1233c1ad2c3a', 'Mels', '', 'Niessen ', 'Mels  Niessen ', 0, '', '', '', '', '', '', '', '', '', '', 2, 0),
(7, 'Lesley', '8ff87b05bde618c5096899a8658bfe874cf18f270521f1f1c97d0d4dc827a02d71fe87746e788098e426001b95c7b05fae65fd0dc9a527305932b523fe7762c6', 'Lesley', '', 'Simon', 'Lesley  Simon', 17, '', 'Putten', 'Media vormgever', '', 'Veel nieuwe dingen willen leren.', 'Omgaan met stress.\r\nTegen druk en tegenslagen kunnen.\r\nGoed kunnen omgaan met kritiek.\r\nEen eigen stijl krijgen.\r\nRuimer denken.\r\nMeer inzicht krijgen op goede en minder goede punten.', '', 'Lesley', '', '', 0, 1),
(8, 'Judith', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 'Judith', '', 'Maas', 'Judith  Maas', 20, '', 'Amersfoort', 'Grafischvormgever', '', '', 'Ik wil haar mooier proberen te krijgen\r\n', '', '', '', '', 0, 0),
(9, 'Marijn', '4dff4ea340f0a823f15d3f4f01ab62eae0e5da579ccb851f8db9dfe84c58b2b37b89903a740e1ee172da793a6e79d560e5f7f9bd058a12a280433ed6fa46510a', 'Marijn', '', 'Wiltenburg', 'Marijn  Wiltenburg', 19, 'Hof der Liefde 5', 'Amersfoort', '??', 'Altijd en overal', 'Mijn motivatie is hoog! wil graag leren.', 'Persoonlijke leerdoelen\r\n1. Betere communicatie met medewerkers.\r\n2. Tot 10 tellen op sommige momenten.\r\n\r\nZakelijke leerdoelen:\r\n1. Presenteren.\r\n2. Afmaken waar ik aan begonnen ben.', '06-24798308', 'mar.wiltenburg@gmail.com', 'http://www.linkedin.com/nhome/', 'http://www.ishetalweekend.nl', 0, 0),
(10, 'Jari', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Jari', 'van den', 'Brink', 'Jari van den Brink', 19, '', '', 'Programmeur', '', 'Nieuwe programmeer technieken leren', 'Beter cummuniceren\r\n', '', '', '', '', 0, 0),
(15, 'Willemijn', 'a49bf89bc8c30e70677a0aa01e163b8312748dcf49f25a327144bb8cd750eeeeac5faec29bde897ddff1109d952f53745d4609bde5441dc251b2ebf6df3ad0d6', 'Willemijn', '', 'Wüthrich', 'Willemijn  Wüthrich', 27, '', 'Amersfoort', 'Grafisch ontwerper', 'In overleg', '', '', '0620089227', 'willemijnwuthrich@xs4all.nl', 'nl.linkedin.com/in/willemijnwu', 'www.willemijnwuthrich.nl', 0, 0),
(17, 'Giovannie', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Giovannie', '', 'Werdmüller von Elgg', 'Giovannie  Werdmüller von Elgg', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(18, 'Guus', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Guus', '', 'Schambergen', 'Guus  Schambergen', 22, '', '', '', '', '', '', '0615875315', 'guusschambergen@gmail.com', '', '', 0, 0),
(19, 'Pim', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Pim', '', 'Voormeulen', 'Pim  Voormeulen', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(20, 'Roel', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Roel', '', 'Schuring', 'Roel  Schuring', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(21, 'Nick', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Nick', '', 'Bajens', 'Nick  Bajens', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(22, 'Rico', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Rico', '', 'Mevissen', 'Rico  Mevissen', 19, '', 'Deventer', 'Cameraman toch?', '', '', '', '', '', '', '', 0, 0),
(23, 'JariJonas', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Jari', '', 'Jonas', 'Jari  Jonas', 18, '', '', '', '', '', '', '', '', '', '', 0, 0),
(25, 'Maxim', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Maxim', 'van', 'Soelen', 'Maxim van Soelen', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(26, 'Tom', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Tom', '', 'Dam', 'Tom  Dam', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(27, 'Chantal', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Chantal', '', 'Groen', 'Chantal  Groen', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(28, 'Elianne', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Elianne', '', 'Essayan', 'Elianne  Essayan', 0, '', '', '', '', '', '', '', '', '', '', 0, 0),
(29, 'Eleanor', 'b7b17ed3244b9d2b30eb3ee692adb253d91dcd719fb6a78fc5f29eaa2ef226259f8577c2f81a8d5f2a132ca90b3de9701647b5ddc28922aa555b8dbac4579c5b', 'Eleanor', '', 'Dingemans', 'Eleanor  Dingemans', 16, '', 'Amersfoort', 'Marketing', '', '', '', '', 'bettina.eleanor@hotmail.com ', '', '', 0, 0),
(31, 'Charles', '3d99e3a3bb9f11e5fe8963a3290b65a383e186440f669395ac853f2a0ffc8c30603e58b7370aa80410d4a1aead34c85030639c7adc6c09e586ecf2366a159f9b', 'Charles', '', 'katipana', 'Charles  katipana', 22, 'Leusderweg 19d', 'Amersfoort ', '', 'Altijd', '', 'Ik kom om te leren', '06 28647896', 'mauta59@gmail.com', 'nl.linkedin.com/in/charleskati', '', 0, 0),
(32, 'Zadean', '6b1d78a7519e38f1990de1f8c54075365d9f6ca0f41b3865464175c22007d411281d5c2f156015298f3c1dca80f4b5cd619db237dd81728422642fb313342df3', 'Zadean', '', 'Sukardi', 'Zadean  Sukardi', 21, 'Linneaushof 50 HS 1098 KN', 'Amsterdam', '3d Artist', 'Hele week van maandag t/m vrijdag.', 'Ik zou graag meer willen leren over werken in een echte werkomgeving en wat daar allemaal bij komt kijken.', 'Ik ben hier om meer te leren over 3d en samenwerken in teamverband.', '06-16892705', 'zettavk@gmail.com', '', '', 0, 0),
(33, 'marcokolkman', 'f461df040e55c04dd79fb59dbf4b19fe4e2033293967bdfd187fa811da80425d163fcb44dac6786ced6695d49fa26b3c285c5d7cc5aa099d565d59b9feb7b062', 'Marco', '', 'Kolkman', 'Marco  Kolkman', 25, 'Gerrit van der Veenlaan 14', 'Baarn', 'Loopbaanbegeleider', '', '', '', '0636429805', '', '', '', 0, 0),
(34, 'Admin', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 'Administrator', '', '', 'Administrator  ', 0, 'Daam Fockemalaan 22', 'Amersfoort', 'SkillsHub Beheerder', 'n.v.t.', 'fdhgfdhgfdgdf', 'gfjhgfjhgfjkgf', '', '', '', '', 2, 0),
(36, 'Feike', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 'Feike', '', 'Brouwer', 'Feike  Brouwer', 34, '', 'Amersfoort', 'Webdesigner/developer', 'di. t/m do.', '', '', '0648642533', 'feike.fof@gmail.com', '', 'feikebrouwer.nl', 0, 0),
(37, 'Bas', '6c7f148c05c7cb2282ca4cc395f97fdda366e7b337b041bedabb21e54685b7cdd92c4c821f00f5e816f77cb207f7376f94abcd806d89a25662d1279fe9e8b42b', 'Bas', '', 'Giskes', 'Bas  Giskes', 0, '', '', '', '', '', '', '', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vakgebieden`
--

CREATE TABLE IF NOT EXISTS `vakgebieden` (
`id` int(11) NOT NULL,
  `vakgebied` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `vakgebieden`
--

INSERT INTO `vakgebieden` (`id`, `vakgebied`) VALUES
(7, '3D'),
(4, 'Creatief'),
(1, 'Fotografie'),
(8, 'Organisatie'),
(2, 'Programmeren'),
(3, 'Sociaal'),
(6, 'Techniek'),
(5, 'Vormgeving');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `markt`
--
ALTER TABLE `markt`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opdrachtgever`
--
ALTER TABLE `opdrachtgever`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectskills`
--
ALTER TABLE `projectskills`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectsusers`
--
ALTER TABLE `projectsusers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skillsusers`
--
ALTER TABLE `skillsusers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vakgebieden`
--
ALTER TABLE `vakgebieden`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `divisie` (`vakgebied`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `markt`
--
ALTER TABLE `markt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opdrachtgever`
--
ALTER TABLE `opdrachtgever`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `projectskills`
--
ALTER TABLE `projectskills`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `projectsusers`
--
ALTER TABLE `projectsusers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `skillsusers`
--
ALTER TABLE `skillsusers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=185;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `vakgebieden`
--
ALTER TABLE `vakgebieden`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
