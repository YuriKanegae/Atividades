SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nivel_permissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `perfil` (`id`, `nome`, `nivel_permissao`) VALUES
(1, 'Administrador', 3),
(2, 'Professor', 2),
(3, 'Aluno', 1);

CREATE TABLE `permissao` (
  `nivel` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `permissao` (`nivel`, `descricao`) VALUES
(1, 'Permissão básica'),
(2, 'Permissão média'),
(3, 'Permissão alta');

CREATE TABLE `usuario` (
  `cpf` varchar(14) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `usuario` (`cpf`, `email`, `senha`, `id_perfil`) VALUES
('32397985810', 'deniszaniro@ifsp.edu.br', 'aa1bf4646de67fd9086cf6c79007026c', 2),
('51339432889', 'pauloholanda@aluno.ifsp.edu.br', '4e411f3d0d972c6761f9648ef5ed2a98', 3),
('78635220803', 'maria@ifsp.edu.br', 'ab56b4d92b40713acc5af89985d4b786', 1),
('83384464168', 'matheus@aluno.ifsp.edu.br', '168d1b7a9535fe6803ef1cad01272145', 3);

ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nivel_permissao_fk` (`nivel_permissao`);

ALTER TABLE `permissao`
  ADD PRIMARY KEY (`nivel`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `id_perfil_fk` (`id_perfil`);

ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `perfil`
  ADD CONSTRAINT `nivel_permissao_fk` FOREIGN KEY (`nivel_permissao`) REFERENCES `permissao` (`nivel`);

ALTER TABLE `usuario`
  ADD CONSTRAINT `id_perfil_fk` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`);
COMMIT;
