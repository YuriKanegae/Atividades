create database taxonomia;
use taxonomia;

CREATE TABLE `especie` (
  `id_especie` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_cientifico` varchar(100) NOT NULL,
  `cod_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `especie` (`id_especie`, `nome`, `nome_cientifico`, `cod_genero`) VALUES
(1, 'Cachorro', 'Canis lupus familiaris', 1),
(2, 'Leão', 'Panthera leo', 3),
(3, 'Tigre', 'Panthera tigris', 3),
(4, 'Lobo', 'Canis lupus lupus', 1),
(5, 'Cachorro do Mato', 'Cerdocyon thous', 2),
(6, 'Leopardo', 'Panthera pardus', 3),
(7, 'Onça Pintada', 'Panthera onca', 3);

CREATE TABLE `familia` (
  `id_familia` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_cientifico` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `familia` (`id_familia`, `nome`, `nome_cientifico`) VALUES
(1, 'Canídeos', 'canidae'),
(2, 'Felinos', 'Felidae');

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nome_cientifico` varchar(100) NOT NULL,
  `cod_familia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `genero` (`id_genero`, `nome_cientifico`, `cod_familia`) VALUES
(1, 'Canis', 1),
(2, 'Cerdocyon', 1),
(3, 'Panthera', 2);

ALTER TABLE `especie`
  ADD PRIMARY KEY (`id_especie`),
  ADD KEY `cod_genero` (`cod_genero`);

ALTER TABLE `familia`
  ADD PRIMARY KEY (`id_familia`);

ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`),
  ADD KEY `cod_familia` (`cod_familia`);

ALTER TABLE `especie`
  ADD CONSTRAINT `especie_ibfk_1` FOREIGN KEY (`cod_genero`) REFERENCES `genero` (`id_genero`) ON UPDATE CASCADE;

ALTER TABLE `genero`
  ADD CONSTRAINT `genero_ibfk_1` FOREIGN KEY (`cod_familia`) REFERENCES `familia` (`id_familia`) ON UPDATE CASCADE;
COMMIT;