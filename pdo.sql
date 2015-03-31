--
-- Base de Dados: `pdo`
--
CREATE DATABASE IF NOT EXISTS `pdo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pdo`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE IF NOT EXISTS `alunos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `nota` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`nome`, `nota`) VALUES
('Aluno 1', 10),
('Aluno 2', 6),
('Aluno 3', 2),
('Aluno 4', 9),
('Aluno 5', 1),
('Aluno 6', 0),
('Aluno 7', 10),
('Aluno 8', 6),
('Aluno 9', 7),
('Aluno 10', 8),
('Aluno 11', 4),
('Aluno 12', 3),
('Aluno 13', 10),
('Aluno 14', 8),
('Aluno 15', 8),
('Aluno 16', 1),
('Aluno 17', 0),
('Aluno 18', 9),
('Aluno 19', 10),
('Aluno 20', 2);