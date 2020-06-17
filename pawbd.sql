-- --------------------------------------------------------
-- Server:                       127.0.0.1
-- Versiune server:              10.1.38-MariaDB - mariadb.org binary distribution
-- SO server:                    Win32
-- HeidiSQL Versiune:            10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Descarcă structura bazei de date pentru paw
CREATE DATABASE IF NOT EXISTS `paw` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `paw`;

-- Descarcă structura pentru tabelă paw.bilet
CREATE TABLE IF NOT EXISTS `bilet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) NOT NULL,
  `dataPlasarii` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bilet_client` (`idClient`),
  CONSTRAINT `FK_bilet_client` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.bilet: ~2 rows (aproximativ)
/*!40000 ALTER TABLE `bilet` DISABLE KEYS */;
/*!40000 ALTER TABLE `bilet` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.bilet_client
CREATE TABLE IF NOT EXISTS `bilet_client` (
  `idBilet` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `FK_bilet_client_bilet` (`idBilet`),
  KEY `FK_bilet_client_client` (`idClient`),
  CONSTRAINT `FK_bilet_client_bilet` FOREIGN KEY (`idBilet`) REFERENCES `bilet` (`id`),
  CONSTRAINT `FK_bilet_client_client` FOREIGN KEY (`idClient`) REFERENCES `client` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.bilet_client: ~0 rows (aproximativ)
/*!40000 ALTER TABLE `bilet_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `bilet_client` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.bilet_pariuri
CREATE TABLE IF NOT EXISTS `bilet_pariuri` (
  `idBilet` int(11) DEFAULT NULL,
  `idOptiuni` int(11) DEFAULT NULL,
  `indice` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`indice`),
  KEY `FK__bilet` (`idBilet`),
  KEY `FK__optiuni_pariu_tip` (`idOptiuni`),
  CONSTRAINT `FK__bilet` FOREIGN KEY (`idBilet`) REFERENCES `bilet` (`id`),
  CONSTRAINT `FK__optiuni_pariu_tip` FOREIGN KEY (`idOptiuni`) REFERENCES `optiuni_pariu_tip` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.bilet_pariuri: ~0 rows (aproximativ)
/*!40000 ALTER TABLE `bilet_pariuri` DISABLE KEYS */;
/*!40000 ALTER TABLE `bilet_pariuri` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.campionat
CREATE TABLE IF NOT EXISTS `campionat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) DEFAULT NULL,
  `tara` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.campionat: ~0 rows (aproximativ)
/*!40000 ALTER TABLE `campionat` DISABLE KEYS */;
INSERT INTO `campionat` (`id`, `nume`, `tara`) VALUES
	(1, 'Premier League', 'Anglia'),
	(2, 'Primera Division', 'Spania');
/*!40000 ALTER TABLE `campionat` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.clasament
CREATE TABLE IF NOT EXISTS `clasament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCampionat` int(11) NOT NULL,
  `idEchipa` int(11) NOT NULL,
  `clasare` int(11) NOT NULL,
  `numarPuncte` int(11) NOT NULL,
  `goluriMarcate` int(11) NOT NULL,
  `goluriPrimite` int(11) NOT NULL,
  `golaveraj` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_clasament_campionat` (`idCampionat`),
  KEY `FK_clasament_echipe` (`idEchipa`),
  CONSTRAINT `FK_clasament_campionat` FOREIGN KEY (`idCampionat`) REFERENCES `campionat` (`id`),
  CONSTRAINT `FK_clasament_echipe` FOREIGN KEY (`idEchipa`) REFERENCES `echipe` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.clasament: ~40 rows (aproximativ)
/*!40000 ALTER TABLE `clasament` DISABLE KEYS */;
INSERT INTO `clasament` (`id`, `idCampionat`, `idEchipa`, `clasare`, `numarPuncte`, `goluriMarcate`, `goluriPrimite`, `golaveraj`) VALUES
	(1, 1, 1, 1, 82, 66, 21, 45),
	(2, 1, 2, 2, 57, 68, 31, 37),
	(3, 1, 3, 3, 53, 58, 28, 30),
	(4, 1, 4, 4, 48, 51, 39, 12),
	(5, 1, 5, 5, 44, 30, 14, 16),
	(6, 1, 6, 6, 43, 34, 7, 9),
	(7, 1, 7, 7, 43, 30, 25, 5),
	(8, 1, 8, 8, 41, 47, 40, 7),
	(9, 1, 9, 9, 40, 40, 36, 4),
	(10, 1, 10, 10, 39, 34, 40, -6),
	(11, 1, 11, 11, 39, 26, 32, -6),
	(12, 1, 12, 12, 37, 37, 46, -9),
	(13, 1, 13, 13, 35, 25, 41, -16),
	(14, 1, 14, 14, 34, 35, 52, -17),
	(15, 1, 15, 15, 29, 32, 40, -8),
	(16, 1, 16, 16, 27, 35, 50, -15),
	(17, 1, 17, 17, 27, 27, 44, -17),
	(18, 1, 18, 18, 27, 29, 47, -18),
	(19, 1, 19, 19, 25, 34, 56, -22),
	(20, 1, 20, 20, 21, 25, 52, -27),
	(21, 2, 22, 1, 58, 63, 31, 32),
	(22, 2, 21, 2, 56, 49, 19, 30),
	(23, 2, 23, 3, 47, 39, 29, 10),
	(24, 2, 24, 4, 46, 45, 33, 12),
	(25, 2, 25, 5, 46, 37, 25, 12),
	(26, 2, 26, 6, 45, 31, 21, 10),
	(27, 2, 27, 7, 42, 38, 39, -1),
	(28, 2, 28, 8, 38, 44, 38, 6),
	(29, 2, 29, 9, 38, 33, 32, 1),
	(30, 2, 30, 10, 37, 29, 23, 6),
	(31, 2, 31, 11, 34, 34, 38, -4),
	(32, 2, 32, 12, 33, 38, 43, -5),
	(33, 2, 33, 13, 33, 32, 40, -8),
	(34, 2, 34, 14, 32, 29, 37, -8),
	(35, 2, 35, 15, 29, 23, 33, -10),
	(36, 2, 36, 16, 27, 27, 41, -14),
	(37, 2, 37, 17, 26, 22, 34, -12),
	(38, 2, 38, 18, 25, 28, 44, -16),
	(39, 2, 39, 19, 23, 21, 39, -18),
	(40, 2, 40, 20, 20, 23, 46, -23);
/*!40000 ALTER TABLE `clasament` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.client
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passwordd` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.client: ~2 rows (aproximativ)
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`id`, `username`, `passwordd`) VALUES
	(1, 'admin', 'admin');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.echipe
CREATE TABLE IF NOT EXISTS `echipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.echipe: ~40 rows (aproximativ)
/*!40000 ALTER TABLE `echipe` DISABLE KEYS */;
INSERT INTO `echipe` (`id`, `nume`) VALUES
	(1, 'Liverpool'),
	(2, 'Manchester City'),
	(3, 'Leicester'),
	(4, 'Chelsea'),
	(5, 'Manchester United'),
	(6, 'Wolverhampton Wnaderers'),
	(7, 'Sheffield United'),
	(8, 'Tottenham'),
	(9, 'Arsenal'),
	(10, 'Burnley'),
	(11, 'Crystal Palace'),
	(12, 'Everton'),
	(13, 'Newcastle United'),
	(14, 'Southampton'),
	(15, 'Brighton'),
	(16, 'West Ham'),
	(17, 'Watford'),
	(18, 'Bournemouth'),
	(19, 'Aston Villa'),
	(20, 'Norwich'),
	(21, 'Real Madrid'),
	(22, 'Barcelona'),
	(23, 'Sevilla'),
	(24, 'Real Sociedad'),
	(25, 'Getafe'),
	(26, 'Atl.Madrid'),
	(27, 'Valencia'),
	(28, 'Villareal'),
	(29, 'Granada'),
	(30, 'Atl.Bilbao'),
	(31, 'Osasuna'),
	(32, 'Betis'),
	(33, 'Levante'),
	(34, 'Alaves'),
	(35, 'Valladolid'),
	(36, 'Eibar'),
	(37, 'Celta Vigo'),
	(38, 'Mallorca'),
	(39, 'Leganes'),
	(40, 'Espanyol');
/*!40000 ALTER TABLE `echipe` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.meciuri
CREATE TABLE IF NOT EXISTS `meciuri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEchipa1` int(11) NOT NULL,
  `idEchipa2` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_meciuri_echipe` (`idEchipa1`),
  KEY `FK_meciuri_echipe_2` (`idEchipa2`),
  CONSTRAINT `FK_meciuri_echipe` FOREIGN KEY (`idEchipa1`) REFERENCES `echipe` (`id`),
  CONSTRAINT `FK_meciuri_echipe_2` FOREIGN KEY (`idEchipa2`) REFERENCES `echipe` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.meciuri: ~3 rows (aproximativ)
/*!40000 ALTER TABLE `meciuri` DISABLE KEYS */;
INSERT INTO `meciuri` (`id`, `idEchipa1`, `idEchipa2`) VALUES
	(1, 3, 19),
	(2, 5, 2),
	(3, 26, 23);
/*!40000 ALTER TABLE `meciuri` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.optiuni_pariu_tip
CREATE TABLE IF NOT EXISTS `optiuni_pariu_tip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPariuTip` int(11) NOT NULL,
  `idMeci` int(11) NOT NULL,
  `cota` float DEFAULT NULL,
  `aditionalText` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_optiuni_pariu_tip_pariu_tip` (`idPariuTip`),
  KEY `FK_optiuni_pariu_tip_meciuri` (`idMeci`),
  CONSTRAINT `FK_optiuni_pariu_tip_meciuri` FOREIGN KEY (`idMeci`) REFERENCES `meciuri` (`id`),
  CONSTRAINT `FK_optiuni_pariu_tip_pariu_tip` FOREIGN KEY (`idPariuTip`) REFERENCES `pariu_tip` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.optiuni_pariu_tip: ~99 rows (aproximativ)
/*!40000 ALTER TABLE `optiuni_pariu_tip` DISABLE KEYS */;
INSERT INTO `optiuni_pariu_tip` (`id`, `idPariuTip`, `idMeci`, `cota`, `aditionalText`) VALUES
	(1, 1, 1, 1.56, 'Leicester'),
	(2, 1, 1, 4.5, 'Lei-Villa EGAL'),
	(3, 1, 1, 6.25, 'Aston Villa'),
	(4, 2, 1, 2.25, 'Lei/Lei'),
	(5, 2, 1, 15, 'Lei/Egal'),
	(6, 2, 1, 46, 'Lei/Villa'),
	(7, 2, 1, 4.6, 'Egal/Lei'),
	(8, 2, 1, 6.75, 'Egal/Egal (l-a)'),
	(9, 2, 1, 12.5, 'Egal/Villa'),
	(10, 2, 1, 19, 'Villa/Lei'),
	(11, 2, 1, 15, 'Villa/Egal'),
	(12, 2, 1, 9.5, 'Villa/Villa'),
	(13, 3, 1, 1.26, 'PR-Lei'),
	(14, 3, 1, 3.45, 'PR-Villa'),
	(15, 3, 1, 2.17, 'PR-Egal(l-a)'),
	(16, 4, 1, 1.24, 'DR-Lei'),
	(17, 4, 1, 3.6, 'DR-Villa'),
	(18, 4, 1, 2.1, 'DR-Egal(l-a)'),
	(19, 5, 1, 1.38, 'PSF-Lei'),
	(20, 5, 1, 3, 'PSF-Villa'),
	(21, 5, 1, 2.2, 'PSF-Egal(l-a)'),
	(22, 1, 2, 4.9, 'Man.Utd'),
	(23, 1, 2, 4, 'Utd-City EGAL'),
	(24, 1, 2, 1.8, 'Man.City'),
	(25, 2, 2, 7.2, 'Utd/Utd'),
	(26, 2, 2, 14, 'Utd/Egal'),
	(27, 2, 2, 24, 'Utd/City'),
	(28, 2, 2, 9.5, 'Egal/Utd'),
	(29, 2, 2, 5.2, 'Egal/Egal (u-c)'),
	(30, 2, 2, 4.65, 'Egal/City'),
	(31, 2, 2, 43, 'City/Utd'),
	(32, 2, 2, 13, 'City/Egal'),
	(33, 2, 2, 2.63, 'City/City'),
	(34, 3, 2, 4.5, 'PR-Utd'),
	(35, 3, 2, 2.3, 'PR-Egal(u-c)'),
	(36, 3, 2, 2.28, 'PR-City'),
	(37, 4, 2, 4.3, 'DR-Utd'),
	(38, 4, 2, 2.63, 'DR-Egal(u-c)'),
	(39, 4, 2, 2.07, 'DR-City'),
	(40, 5, 2, 2.5, 'PSF-Utd'),
	(41, 5, 2, 2, 'PSF-Egal(u-c)'),
	(42, 5, 2, 1.4, 'PSF-City'),
	(43, 6, 1, 13.25, 'H(-4,5) - Lei'),
	(44, 6, 1, 1.02, 'H(-4,5) - Villa'),
	(45, 7, 1, 1.45, 'W-Lei'),
	(46, 7, 1, 3.5, 'W-Villa'),
	(47, 8, 1, 1.19, 'Lei-Villa 2+'),
	(50, 8, 1, 1.62, 'Lei-Villa 3+'),
	(51, 8, 1, 2.6, 'Lei-Villa 4+'),
	(52, 8, 1, 4.7, 'Lei-Villa 5+'),
	(53, 9, 1, 1.68, 'Lei-Villa GG'),
	(54, 9, 1, 2.12, 'Lei-Villa NGG'),
	(55, 10, 1, 1.5, 'Lei>Villa'),
	(58, 10, 1, 2, 'Lei<Villa'),
	(59, 6, 2, 17, 'H(-2)-Utd'),
	(60, 6, 2, 1.03, 'H(-2)-City'),
	(61, 7, 2, 3, 'W-Utd'),
	(62, 7, 2, 1.35, 'W-City'),
	(63, 8, 2, 1.24, 'Utd-City 2+'),
	(64, 8, 2, 1.82, 'Utd-City 3+'),
	(67, 8, 2, 3.15, 'Utd-City 4+'),
	(68, 8, 2, 5.9, 'Utd-City 5+'),
	(69, 9, 2, 1.74, 'Utd-City GG'),
	(70, 9, 2, 2.05, 'Utd-City NGG'),
	(71, 10, 2, 3.83, 'Utd>City'),
	(72, 10, 2, 2, 'Utd<City'),
	(73, 1, 3, 2.02, 'Atl.Madrid'),
	(74, 1, 3, 3.2, 'Atl-Sev Egal'),
	(75, 1, 3, 4.3, 'Sevilla'),
	(76, 2, 3, 3.3, 'Atl/Atl'),
	(77, 2, 3, 15.75, 'Atl/Egal'),
	(78, 2, 3, 37, 'Atl/Sev'),
	(79, 2, 3, 4.75, 'Egal/Atl'),
	(80, 2, 3, 4.6, 'Egal/Egal(a-s)'),
	(81, 2, 3, 7.25, 'Egal/Sev'),
	(82, 2, 3, 30, 'Sev/Atl'),
	(83, 2, 3, 17, 'Sev/Egal'),
	(84, 2, 3, 6.45, 'Sev/Sev'),
	(85, 3, 3, 2.8, 'PR-Atl'),
	(86, 3, 3, 1.98, 'PR-Egal(a-s)'),
	(87, 3, 3, 4.7, 'PR-Sev'),
	(88, 4, 3, 2.38, 'DR-Atl'),
	(89, 4, 3, 2.28, 'DR-Egal(a-s)'),
	(90, 4, 3, 4.25, 'DR-Sev'),
	(91, 5, 3, 1.58, 'PSF-Atl'),
	(92, 5, 3, 2.33, 'PSF-Egal(a-s)'),
	(93, 5, 3, 3.16, 'PSF-Sev'),
	(94, 6, 3, 30, 'H(-3)-Atl'),
	(95, 6, 3, 1.01, 'H(-3)-Sev'),
	(96, 7, 3, 1.49, 'W-Atl'),
	(97, 7, 3, 2.35, 'W-Sev'),
	(98, 8, 3, 1.42, 'Atl-Sev 2+'),
	(99, 8, 3, 2.32, 'Atl-Sev 3+'),
	(100, 8, 3, 4.45, 'Atl-Sev 4+'),
	(101, 8, 3, 9.33, 'Atl-Sev 5+'),
	(102, 9, 3, 1.98, 'Atl-Sev GG'),
	(103, 9, 3, 1.79, 'Atl-Sev NGG'),
	(104, 10, 3, 1.5, 'Atl>Sev'),
	(105, 10, 3, 1.77, 'Atl<Sev');
/*!40000 ALTER TABLE `optiuni_pariu_tip` ENABLE KEYS */;

-- Descarcă structura pentru tabelă paw.pariu_tip
CREATE TABLE IF NOT EXISTS `pariu_tip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Descarcă datele pentru tabela paw.pariu_tip: ~9 rows (aproximativ)
/*!40000 ALTER TABLE `pariu_tip` DISABLE KEYS */;
INSERT INTO `pariu_tip` (`id`, `nume`) VALUES
	(1, 'Final'),
	(2, 'Pauza-Final'),
	(3, 'Prima repriza'),
	(4, 'A doua repriza'),
	(5, 'Pauza sau Final'),
	(6, 'Handicap'),
	(7, 'Winner'),
	(8, 'Total Goluri Meci'),
	(9, 'GG Combo'),
	(10, 'Mai multe goluri');
/*!40000 ALTER TABLE `pariu_tip` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
