-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14 Feb 2015 la 11:55
-- Versiune server: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mnd3db1`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `grupv`
--

CREATE TABLE IF NOT EXISTS `grupv` (
`codgrupv` smallint(6) NOT NULL,
  `dengrupv` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `grupv`
--

INSERT INTO `grupv` (`codgrupv`, `dengrupv`) VALUES
(1, 'Varsta intre 10 si 19 ani'),
(2, 'Varsta intre 20 si 29 de ani'),
(3, 'Varsta intre 30 si 39 de ani'),
(4, 'Varsta intre 40 si 49 de ani'),
(5, 'Varsta intre 50 si 59 de ani'),
(6, 'Varsta intre 60 si 69 de ani'),
(7, 'Varsta peste 70 de ani');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tipuser`
--

CREATE TABLE IF NOT EXISTS `tipuser` (
`codtipu` smallint(6) NOT NULL,
  `dentipu` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `tipuser`
--

INSERT INTO `tipuser` (`codtipu`, `dentipu`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `codtipu` smallint(6) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` char(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `codgrupv` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `user`
--

INSERT INTO `user` (`username`, `codtipu`, `password`, `name`, `email`, `phone`, `description`, `codgrupv`) VALUES
('boca_v', 2, '477193ec2d91442ab341a5c58d49e488', 'Boca Vasile', 'boca_vasile@yahoo.com', '3455551234', 'vecinul din spatele casei parintesti', 5),
('caluser_g', 2, '70611e00c7fec1893e8933ce34951aca', 'Caluser Gheorghe', 'caluser_gheorghe@yahoo.com', '2344441234', 'prieten bun si vecin ', 4),
('stanciu_a', 2, '982d5b65d2980c0c53ca43e30777df31', 'Stanciu Adrian', 'adrianstanciu08@yahoo.com', '2003331234', 'fiul cel mic', 2),
('stanciu_e', 1, '84e31691b3568a9d7a4dd8b6ad54e7ad', 'Stanciu Eugenia', 'stanciu.eugenia61@yahoo.com', '2344441234', 'my wife', 4),
('stanciu_i', 1, '7044bffa1cf23c875a31404dbb135e6b', 'Stanciu Ioan', 'stanciu_ioan@yahoo.com', '2335551234', 'junior web developer ', 5),
('suciu_i', 2, '7044bffa1cf23c875a31404dbb135e6b', 'Suciu Ioan', 'suciu_ioan@yahoo.com', '2344441234', 'varul meu', 5),
('tasnady_e', 1, 'b95a4f968bcb11d92adb51fc093cf031', 'Tasnady Erzsebet', 'tasnady_e@yahoo.com', '2127919900', 'out of orderr', 3),
('todoran_m', 2, 'c8fe87574444d496ccc1f17a6012e460', 'Todoran Maria', 'todoran_maria@yahoo.com', '2344441234', 'socra mea', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grupv`
--
ALTER TABLE `grupv`
 ADD PRIMARY KEY (`codgrupv`);

--
-- Indexes for table `tipuser`
--
ALTER TABLE `tipuser`
 ADD PRIMARY KEY (`codtipu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`), ADD KEY `codtipu` (`codtipu`), ADD KEY `codgrupv` (`codgrupv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grupv`
--
ALTER TABLE `grupv`
MODIFY `codgrupv` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tipuser`
--
ALTER TABLE `tipuser`
MODIFY `codtipu` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `grupv_fk` FOREIGN KEY (`codgrupv`) REFERENCES `grupv` (`codgrupv`),
ADD CONSTRAINT `tipuser_fk` FOREIGN KEY (`codtipu`) REFERENCES `tipuser` (`codtipu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
