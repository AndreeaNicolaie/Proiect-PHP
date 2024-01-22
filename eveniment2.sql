-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: nov. 21, 2023 la 09:55 AM
-- Versiune server: 8.0.31
-- Versiune PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `eveniment2`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `ID_Administrator` int NOT NULL AUTO_INCREMENT,
  `Nume` varchar(255) NOT NULL,
  `Prenume` varchar(255) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Parola` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_Administrator`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `administrator`
--

INSERT INTO `administrator` (`ID_Administrator`, `Nume`, `Prenume`, `Email`, `Parola`) VALUES
(15, 'Negrea', 'Florina', 'negreaflorina3@gmail.com', '$2y$10$Dz5d9ZzPLpMMLdGmgd16MOGMIZ4SaBZR/xhWnQxfo/kbAbeG6g/52'),
(16, 'Negrea', 'Catalin', 'negreacatalin27@gmail.com', '$2y$10$oAwL1wgpNVfBduxsg7G/AOtwg0YtaE5h3pHJe/A/KROAfaJsfzF6.');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `ID_Agenda` int NOT NULL AUTO_INCREMENT,
  `ID_Eveniment` int NOT NULL,
  `Nume_Sesiune` varchar(255) NOT NULL,
  `Ora_Inceput` time NOT NULL,
  `Ora_Sfarsit` time NOT NULL,
  `Descriere` text,
  PRIMARY KEY (`ID_Agenda`),
  KEY `agenda_id_eveniment_foreign` (`ID_Eveniment`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `agenda`
--

INSERT INTO `agenda` (`ID_Agenda`, `ID_Eveniment`, `Nume_Sesiune`, `Ora_Inceput`, `Ora_Sfarsit`, `Descriere`) VALUES
(1, 1, 'Vizionare Film', '13:30:00', '15:30:00', 'Vizionarea Filmului Hunger Games'),
(2, 1, 'Q&amp;A Session', '15:30:00', '17:30:00', 'Q&amp;A Session with the actors of The Hunger Games'),
(3, 1, 'Poze Session', '17:30:00', '19:30:00', 'Poze Session with the The Hunger Games Casts');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `bilet`
--

DROP TABLE IF EXISTS `bilet`;
CREATE TABLE IF NOT EXISTS `bilet` (
  `ID_Bilet` int NOT NULL AUTO_INCREMENT,
  `Tip_Bilet` varchar(50) NOT NULL,
  `Pret` decimal(10,2) NOT NULL,
  `ID_Eveniment` int NOT NULL,
  `ID_Participant` int NOT NULL,
  PRIMARY KEY (`ID_Bilet`),
  KEY `bilet_id_eveniment_foreign` (`ID_Eveniment`),
  KEY `bilet_id_participant_foreign` (`ID_Participant`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `bilet`
--

INSERT INTO `bilet` (`ID_Bilet`, `Tip_Bilet`, `Pret`, `ID_Eveniment`, `ID_Participant`) VALUES
(13, 'Movie', '200.00', 1, 1),
(14, 'Movie+Q&amp;A', '300.00', 1, 1),
(15, 'Movie+Q&amp;A+Poze', '400.00', 1, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `eveniment`
--

DROP TABLE IF EXISTS `eveniment`;
CREATE TABLE IF NOT EXISTS `eveniment` (
  `ID_Eveniment` int NOT NULL AUTO_INCREMENT,
  `Nume_Eveniment` varchar(255) NOT NULL,
  `Descriere` text,
  `Image_path` varchar(255) NOT NULL,
  `Data_Start` datetime NOT NULL,
  `Data_Finish` datetime NOT NULL,
  `Locatie` varchar(255) NOT NULL,
  `Numar_Participant_Maxim` int NOT NULL,
  PRIMARY KEY (`ID_Eveniment`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `eveniment`
--

INSERT INTO `eveniment` (`ID_Eveniment`, `Nume_Eveniment`, `Descriere`, `Image_path`, `Data_Start`, `Data_Finish`, `Locatie`, `Numar_Participant_Maxim`) VALUES
(1, 'The Hunger Games: The Ballad of Songbirds & Snakes', 'Don\'t miss the new Hunger Game movie! Enjoy a special screening, a Q&A session with the actors, and a chance for a photo with them', 'event-image.jpg', '2023-12-14 13:30:00', '2023-12-14 19:30:00', 'Cluj-Napoca Cineplexx', 150),
(2, 'Anyone but you', 'Don&#039;t miss the new movie Anyone but you! Enjoy a special screening, a Q&amp;A session with the actors, and a chance for a photo with them', 'event-image1.jpg', '2023-11-24 12:00:00', '2023-11-24 18:00:00', 'Targu Mures Cineplexx', 200);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `pachet`
--

DROP TABLE IF EXISTS `pachet`;
CREATE TABLE IF NOT EXISTS `pachet` (
  `ID_Pachet` int NOT NULL AUTO_INCREMENT,
  `Nume_Pachet` varchar(100) NOT NULL,
  `Descriere` text,
  `Pret` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_Pachet`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `pachet`
--

INSERT INTO `pachet` (`ID_Pachet`, `Nume_Pachet`, `Descriere`, `Pret`) VALUES
(1, 'Gold', 'Pachetul Gold', '1500.00'),
(2, 'Silver', 'Pachetul Silver', '1000.00'),
(3, 'Platinum', 'Pachetul Platinum', '2000.00');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `partener`
--

DROP TABLE IF EXISTS `partener`;
CREATE TABLE IF NOT EXISTS `partener` (
  `ID_Partener` int NOT NULL AUTO_INCREMENT,
  `Nume_Partener` varchar(255) NOT NULL,
  `Descriere` text,
  `Contact_Nume` varchar(255) NOT NULL,
  `Contact_Email` varchar(320) NOT NULL,
  `Contact_Telefon` varchar(15) NOT NULL,
  `ID_Eveniment` int NOT NULL,
  `ID_Pachet` int NOT NULL,
  PRIMARY KEY (`ID_Partener`),
  KEY `partener_id_pachet_foreign` (`ID_Pachet`),
  KEY `partener_id_eveniment_foreign` (`ID_Eveniment`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `partener`
--

INSERT INTO `partener` (`ID_Partener`, `Nume_Partener`, `Descriere`, `Contact_Nume`, `Contact_Email`, `Contact_Telefon`, `ID_Eveniment`, `ID_Pachet`) VALUES
(1, 'Cineplexx', 'Cinematograf', 'Alina Stoica', 'alina.stoica@gmail.com', '0722640356', 1, 3),
(2, 'Radio Romania Cluj', 'Radio Station', 'Carmen Muresan', 'carmen.muresan@gmail.com', '0726341298', 1, 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `ID_Participant` int NOT NULL AUTO_INCREMENT,
  `Nume` varchar(255) NOT NULL,
  `Prenume` varchar(255) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Telefon` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_Participant`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `participant`
--

INSERT INTO `participant` (`ID_Participant`, `Nume`, `Prenume`, `Email`, `Telefon`) VALUES
(1, 'Negrea', 'Florina', 'negreaflorina366@yahoo.com', '0740537649'),
(2, 'Florea', 'Maria', 'floreamaria@gmail.com', '0722345612');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `sesiune`
--

DROP TABLE IF EXISTS `sesiune`;
CREATE TABLE IF NOT EXISTS `sesiune` (
  `ID_Sesiune` int NOT NULL AUTO_INCREMENT,
  `ID_Eveniment` int NOT NULL,
  `Nume_Sesiune` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Sesiune`),
  KEY `sesiune_id_eveniment_foreign` (`ID_Eveniment`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `sesiune`
--

INSERT INTO `sesiune` (`ID_Sesiune`, `ID_Eveniment`, `Nume_Sesiune`) VALUES
(1, 1, 'Movie session'),
(2, 1, 'Movie + Q&A'),
(3, 1, 'Movie +  Q&A + Poze');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `speaker`
--

DROP TABLE IF EXISTS `speaker`;
CREATE TABLE IF NOT EXISTS `speaker` (
  `ID_Speaker` int NOT NULL AUTO_INCREMENT,
  `Nume` varchar(255) NOT NULL,
  `Prenume` varchar(255) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Telefon` varchar(15) NOT NULL,
  `Bio` text,
  PRIMARY KEY (`ID_Speaker`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `speaker`
--

INSERT INTO `speaker` (`ID_Speaker`, `Nume`, `Prenume`, `Email`, `Telefon`, `Bio`) VALUES
(1, 'Zegler', 'Rachel', 'rachel.zegler@gmail.com', '0740761239', 'Rachel Zegler is a singer and songwriter, raised in New Jersey by her American father and Colombian mother.'),
(2, 'Blyth', 'Tom ', 'tom.blyth@gmail.com', '0740238745', 'Tom Keir Blyth is an English actor. His films include Scott and Sid (2018), Benediction (2021), The Hunger Games, Ballad of Songbirds and Snakes (2023).');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `speaker_sesiune`
--

DROP TABLE IF EXISTS `speaker_sesiune`;
CREATE TABLE IF NOT EXISTS `speaker_sesiune` (
  `ID_Speaker_Sesiune` int NOT NULL AUTO_INCREMENT,
  `ID_Speaker` int NOT NULL,
  `ID_Sesiune` int NOT NULL,
  PRIMARY KEY (`ID_Speaker_Sesiune`),
  KEY `speaker_sesiune_id_sesiune_foreign` (`ID_Sesiune`),
  KEY `speaker_sesiune_id_speaker_foreign` (`ID_Speaker`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `speaker_sesiune`
--

INSERT INTO `speaker_sesiune` (`ID_Speaker_Sesiune`, `ID_Speaker`, `ID_Sesiune`) VALUES
(3, 1, 3),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `sponsor`
--

DROP TABLE IF EXISTS `sponsor`;
CREATE TABLE IF NOT EXISTS `sponsor` (
  `ID_Sponsor` int NOT NULL AUTO_INCREMENT,
  `Nume_Sponsor` varchar(255) NOT NULL,
  `Descriere` text,
  `Contact_Nume` varchar(255) NOT NULL,
  `Contact_Email` varchar(320) NOT NULL,
  `Contact_Telefon` varchar(15) NOT NULL,
  `ID_Eveniment` int NOT NULL,
  PRIMARY KEY (`ID_Sponsor`),
  KEY `sponsor_id_eveniment_foreign` (`ID_Eveniment`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `sponsor`
--

INSERT INTO `sponsor` (`ID_Sponsor`, `Nume_Sponsor`, `Descriere`, `Contact_Nume`, `Contact_Email`, `Contact_Telefon`, `ID_Eveniment`) VALUES
(2, 'Banca Transilvania', 'Suntem cea mai mare bancă din România și din Europa de Sud-Est și credem că, dacă România merge bine, și BT merge bine.', 'Togorean Ionut', 'ionut.togorean@btdirect.ro', '0755844137', 1),
(3, 'Audi', 'AUDI AG este un producător de automobile din Germania, cu sediul în Ingolstadt, landul Bavaria.', 'Taurean Raul', 'raul.taurean@audi.ro', '0743659841', 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `Cart_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int NOT NULL,
  `Ticket_ID` int NOT NULL,
  `Quantity` int NOT NULL,
  PRIMARY KEY (`Cart_ID`),
  KEY `fk_ticket_id` (`Ticket_ID`),
  KEY `fk_user_id` (`User_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `tbl_cart`
--

INSERT INTO `tbl_cart` (`Cart_ID`, `User_ID`, `Ticket_ID`, `Quantity`) VALUES
(9, 1, 14, 3),
(10, 1, 15, 2),
(11, 1, 13, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_User` int NOT NULL AUTO_INCREMENT,
  `Nume` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
