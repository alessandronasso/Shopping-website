-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 22, 2018 at 05:51 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progetto`
--
CREATE DATABASE IF NOT EXISTS `progetto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `progetto`;

-- --------------------------------------------------------

--
-- Table structure for table `Carrello`
--

DROP TABLE IF EXISTS `Carrello`;
CREATE TABLE IF NOT EXISTS `Carrello` (
  `id_prodotto` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `QTA` int(11) NOT NULL,
  PRIMARY KEY (`email`,`id_prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
CREATE TABLE IF NOT EXISTS `Categoria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Categoria`
--

INSERT INTO `Categoria` (`ID`, `Nome`) VALUES
(1, 'Televisori'),
(2, 'Fotocamere'),
(3, 'Cellulari'),
(4, 'Computer'),
(5, 'Console');

-- --------------------------------------------------------

--
-- Table structure for table `Prodotto`
--

DROP TABLE IF EXISTS `Prodotto`;
CREATE TABLE IF NOT EXISTS `Prodotto` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(30) NOT NULL,
  `Prezzo` float NOT NULL,
  `Descrizione` text NOT NULL,
  `QTA` int(11) NOT NULL,
  `Categoria` varchar(30) NOT NULL,
  `Immagine` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Prodotto`
--

INSERT INTO `Prodotto` (`ID`, `Nome`, `Prezzo`, `Descrizione`, `QTA`, `Categoria`, `Immagine`) VALUES
(1, 'Sony KD55XF8577', 999.99, 'TV QLED 55\'\' Ultra HD 4K - Risoluzione: 3840x2160\r\nTecnologia 2600 PQI - DLNA - WI-Fi\r\nTuner Digitale Terrestre DVB-T2 HEVC e Sintonizzatore DVB-S2\r\nClasse efficienza energetica: A++', 0, '1', 'KD55XF8577.jpg'),
(2, 'Samsung QE49Q6FNATXZT', 699.99, 'TV QLED 49\'\' Ultra HD 4K - Risoluzione: 3840x2160\r\nTecnologia 2600 PQI - DLNA - WI-Fi - Ethernet\r\nTuner Digitale Terrestre DVB-T2 HEVC e Sintonizzatore DVB-S2\r\nClasse efficienza energetica: B\r\nDistribuito da Samsung Italia', 3, '1', 'QE49Q6FNATXZT.jpg'),
(3, 'LG 55SK8000PLB', 499.99, 'SMART TV LED 55\'\' Ultra HD 4K - Risoluzione: 3840x2160 pixel\r\nTuner Digitale Terrestre: DVB-T2 HEVC e Satellitare DVB-S2\r\nCasse integrate - Potenza in uscita: 20 W - WiFi\r\nClasse efficienza energetica: A+\r\nDistribuito da Lg Italia', 2, '1', '55SK8000PLB.jpg'),
(4, 'NIKON D3400', 349.99, 'Fotocamera Reflex digitale - Sensore da 24 Megapixel\r\nLCD da 3\" - Flash TTL - Slot SD/SDHC/SDXC - Filmati Full HD\r\nObiettivo AF-P DX NIKKOR 18-55MM F/3.5-5.6G\r\nOttica stabilizzata - Peso 450 g.\r\nTecnologia Bluetooth low energy integrata\r\nGaranzia ufficiale 4 anni Nital Italia', 1, '2', 'D3400.jpg'),
(5, 'Canon EOS 200D', 479.99, 'Fotocamera Reflex digitale - Sensore CMOS da 24 Megapixel\r\nLCD touchscreen da 3\" orientabile - Filmati Full HD\r\nSlot SD/SDHC/SDXC - Peso: 430 g.\r\nObiettivo 18-55 IS - Ottica stabilizzata\r\nGaranzia ufficiale Canon Italia', 4, '2', 'EOS200D.jpg'),
(6, 'POLAROID SNAP', 188.99, 'Sensore 13 Megapixel\r\nMemoria MicroSD - Display LCD 3,5 Touchscreen\r\nUSB - Bluetooth \r\nStampe istantanee a colori ZINK 2x3\"\r\nStampe pronte in un minuto', 2, '2', 'POLAROIDSNAP.jpg'),
(7, 'ASUS Zenfone 3', 199.99, 'Penta Band - 4G-LTE - Wi-Fi\r\nFotocamera da 23 Megapixel\r\nAndroid 6 Marshmallows - GPS integrato\r\nDisplay 5,7\", Super AMOLED Touchscreen - Memoria interna 64GB\r\nProcessore Quad-Core da 2.15GHz\r\nDistribuito da Asus Italia', 2, '3', 'ZENFONE3.jpg'),
(8, 'Honor 10', 359.99, 'Quadri Band - 3G - 4G-LTE - Wi-Fi\r\nDoppia fotocamera posteriore da 16 Megapixel + 24 MP\r\nProcessore Huawei Kirin 970 Octa-Core da 2.3 GHz\r\nAndroid Oreo + EMUI 8.1 - Memoria 64GB - GPS\r\nDisplay 5.84\" Full HD+ - Dual SIM\r\nRAM 4 GB - Lettore impronte digitali\r\nDistribuito da Honor Italia', 2, '3', 'HONOR10.jpg'),
(9, 'HUAWEI P20 Lite', 339.99, 'Quadri Band - 4G-LTE - Wi-Fi - NFC\r\nDoppia fotocamera posteriore 16 MP/2 MP\r\nAndroid 8.0 EMUI 8.0 - Processore: 8-Core da 2,36 GHz \r\nMemoria interna: 64 GB - RAM: 4 GB\r\nRiconoscimento facciale 3D\r\nDisplay 5,84\'\' LCD Full HD+\r\nDistribuito da HUAWEI Italia', 1, '3', 'P20LITE.jpg'),
(10, 'LENOVO Ideapad 320-15ABR', 449.99, 'Processore AMD A12-Series A12-9720P - Grafica CPU: AMD Radeon R7\r\nArchitettura del processore: Bristol Ridge (2,7 GHz - 2 MB L2)\r\nHDD: 1000 GB - RAM: 16 GB - Display 15,6\'\' LCD \r\nWiFi IEEE 802.11a/b/g/n/ac - Bluetooth 4.1 \r\nWindows 10 Home 64-bit\r\nScheda grafica AMD Radeon 530, 2 GB dedicata', 2, '4', 'LENOVO.jpg'),
(11, 'APPLE Macbook Pro 13,3', 1349.99, 'Processore Intel® Core™ i5 (2.3 / 3.8 GHz)\r\nHD 256GB SSD - RAM 8GB - Display 13.3\" Retina IPS\r\nWi-Fi 802.11 a/b/g/n - Bluetooth 5.0 - Mac OS High Sierra\r\nScheda grafica Intel Iris Plus Graphics 655\r\nTrackpad Force Touch', 2, '4', 'MACBOOK.jpg'),
(12, 'MSI Vortex G25 8RE-036IT', 1999.99, 'Processore Intel® Core™ I7-8700 (3,2 GHz - 12 MB L3)\r\nHDD 1000 GB - SSD 256 GB - RAM 16 GB\r\nWiFi IEEE 802.11a/b/g/n/ac - Bluetooth 4.1\r\nWindows 10 Home 64-bit\r\nScheda grafica nVidia GeForce GTX 1070(8 GB dedicata)', 1, '4', 'MSI.jpg'),
(13, 'Playstation 4', 299.99, 'Console fissa - Capacità: 500 GB\r\nLettore BD/ DVD - Bluetooth 4.0 - HDMI\r\n1 DualShock 4 Wireless Controller Black', 2, '5', 'PS4.jpg'),
(14, 'Xbox One ', 399.99, 'Console Xbox One - Wi-Fi - Disco Rigido da 1000GB\r\nProcessore x86 a 8 core - Memoria 8 GB di RAM\r\nLettore Blu-ray 4k Ultra HD - HDR - IR Blaster \r\n3 USB - Cavo HDMI - 14 Giorni di abbonamento\r\na Xbox Live Gold + 1 Mese a Xbox Game Pass\r\n+ Gioco Forza Horizon 4', 3, '5', 'XBOX.jpg'),
(15, 'Nintendo SWITCH', 359.99, 'Schermo 6,2\'\' capacitivo multi touch\r\nRisoluzione massima: 1920 x 1080, 60 fps\r\nTelecamera IR movimento\r\nJoy-Con Rosso Neon e Blu Neon (destro+ sinistro)\r\nPossibilità di giocare fino a 8 giocatori in wi-fi\r\nMemoria interna: 32 GB', 2, '5', 'SWITCH.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Transazione`
--

DROP TABLE IF EXISTS `Transazione`;
CREATE TABLE IF NOT EXISTS `Transazione` (
  `email` varchar(30) NOT NULL,
  `id_prodotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Transazione`
--

INSERT INTO `Transazione` (`email`, `id_prodotto`) VALUES
('admin@admin.it', 1),
('admin@admin.it', 6),
('admin@admin.it', 13),
('admin@admin.it', 15),
('admin@admin.it', 2),
('admin@admin.it', 1),
('admin@admin.it', 2),
('admin@admin.it', 2),
('admin@admin.it', 3),
('admin@admin.it', 5),
('admin@admin.it', 13),
('admin@admin.it', 1),
('admin@admin.it', 10),
('admin@admin.it', 4);

-- --------------------------------------------------------

--
-- Table structure for table `Utente`
--

DROP TABLE IF EXISTS `Utente`;
CREATE TABLE IF NOT EXISTS `Utente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `citta` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Utente`
--

INSERT INTO `Utente` (`ID`, `email`, `password`, `nome`, `cognome`, `citta`, `telefono`) VALUES
(6, 'admin@admin.it', 'f6fdffe48c908deb0f4c3bd36c032e72', 'Admin', 'Admin', '3490000001', 'Torino');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
