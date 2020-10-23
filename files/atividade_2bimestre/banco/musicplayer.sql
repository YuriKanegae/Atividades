-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 22-Out-2020 às 21:47
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicplayer`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `banda`
--

CREATE TABLE `banda` (
  `id_banda` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cod_genero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `banda`
--

INSERT INTO `banda` (`id_banda`, `nome`, `cod_genero`) VALUES
(6, 'Johann Sebastina Bach', 6),
(7, 'Georg Friedrich HÃ¤ndel', 6),
(8, ' Domenico Scarlatti', 6),
(9, 'Cartola', 5),
(10, 'DemÃ´nios da garoa', 5),
(11, 'Elizeth Cardoso', 5),
(12, ' Ludwig van Beethoven', 7),
(13, ' Wolfgang Amadeus Mozart', 7),
(14, ' NiccolÃ² Paganini', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`id_genero`, `nome`) VALUES
(5, 'Samba raiz'),
(6, 'Barroco'),
(7, 'Classico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `musica`
--

CREATE TABLE `musica` (
  `id_musica` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cod_banda` int(11) DEFAULT NULL,
  `youtube` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `musica`
--

INSERT INTO `musica` (`id_musica`, `nome`, `cod_banda`, `youtube`) VALUES
(6, 'ManhÃ£ de Carnaval', 11, 'vEdVkWDFJYQ'),
(7, 'Preciso Me Encontrar', 9, 'fUjOfsoBhMY'),
(8, 'Bom dia Tristeza', 10, 'WMFI5kWMqXU'),
(9, 'Toccata and Fugue in D Minor', 6, 'ho9rZjlsyYY'),
(10, 'Sarabande', 7, 'klPZIGQcrHA'),
(11, 'Fandango', 8, 'QQbW75y3P9g'),
(12, 'Sonata No. 8 Op. 13 (Pathetique)', 12, 'SrcOcKYQX3c'),
(13, 'Lacrimosa', 13, 'k1-TrAvp_xs'),
(14, '24th caprice', 14, '7WuPlIx47gw');

-- --------------------------------------------------------

--
-- Estrutura da tabela `musica_playlist`
--

CREATE TABLE `musica_playlist` (
  `id_musica_playlist` int(11) NOT NULL,
  `cod_musica` int(11) DEFAULT NULL,
  `cod_playlist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `musica_playlist`
--

INSERT INTO `musica_playlist` (`id_musica_playlist`, `cod_musica`, `cod_playlist`) VALUES
(19, 9, 26),
(20, 10, 26),
(21, 11, 26),
(22, 7, 26),
(23, 8, 26),
(24, 6, 26),
(25, 12, 26),
(26, 13, 26),
(27, 14, 26),
(28, 7, 27),
(29, 8, 27),
(30, 6, 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `playlist`
--

CREATE TABLE `playlist` (
  `id_playlist` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `playlist`
--

INSERT INTO `playlist` (`id_playlist`, `nome`) VALUES
(26, 'MÃºsicas para o professor escutar'),
(27, 'MÃºsicas brasileiras');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banda`
--
ALTER TABLE `banda`
  ADD PRIMARY KEY (`id_banda`),
  ADD KEY `cod_genero` (`cod_genero`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indexes for table `musica`
--
ALTER TABLE `musica`
  ADD PRIMARY KEY (`id_musica`),
  ADD KEY `cod_banda` (`cod_banda`);

--
-- Indexes for table `musica_playlist`
--
ALTER TABLE `musica_playlist`
  ADD PRIMARY KEY (`id_musica_playlist`),
  ADD KEY `cod_musica` (`cod_musica`),
  ADD KEY `cod_playlist` (`cod_playlist`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id_playlist`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banda`
--
ALTER TABLE `banda`
  MODIFY `id_banda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `musica`
--
ALTER TABLE `musica`
  MODIFY `id_musica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `musica_playlist`
--
ALTER TABLE `musica_playlist`
  MODIFY `id_musica_playlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id_playlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `banda`
--
ALTER TABLE `banda`
  ADD CONSTRAINT `banda_ibfk_1` FOREIGN KEY (`cod_genero`) REFERENCES `genero` (`id_genero`);

--
-- Limitadores para a tabela `musica`
--
ALTER TABLE `musica`
  ADD CONSTRAINT `musica_ibfk_1` FOREIGN KEY (`cod_banda`) REFERENCES `banda` (`id_banda`);

--
-- Limitadores para a tabela `musica_playlist`
--
ALTER TABLE `musica_playlist`
  ADD CONSTRAINT `musica_playlist_ibfk_1` FOREIGN KEY (`cod_musica`) REFERENCES `musica` (`id_musica`),
  ADD CONSTRAINT `musica_playlist_ibfk_2` FOREIGN KEY (`cod_playlist`) REFERENCES `playlist` (`id_playlist`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
