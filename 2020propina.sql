-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Abr-2020 às 20:26
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2020propina`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_classe`
--

CREATE TABLE `tbl_classe` (
  `id_classe` bigint(20) NOT NULL,
  `classe` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_classe`
--

INSERT INTO `tbl_classe` (`id_classe`, `classe`) VALUES
(15, 'Nenhum'),
(16, 'Iniciação'),
(17, '1ª'),
(18, '2ª'),
(19, '3ª'),
(20, '4ª'),
(21, '5ª'),
(22, '6ª'),
(23, '7ª'),
(24, '8ª'),
(25, '9ª'),
(26, '10ª'),
(27, '11ª'),
(28, '12ª'),
(29, '13ª');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_comparticipadores`
--

CREATE TABLE `tbl_comparticipadores` (
  `id_comparticipadores` bigint(20) NOT NULL,
  `nome_comparticipador` varchar(100) NOT NULL,
  `genero` char(1) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_comparticipadores`
--

INSERT INTO `tbl_comparticipadores` (`id_comparticipadores`, `nome_comparticipador`, `genero`, `telefone`) VALUES
(1, 'Terêncio da Cruz', 'M', '926164222'),
(2, 'Beatriz Bula', 'F', ''),
(3, 'David Francisco Pala', 'M', '923290392'),
(4, 'Rita Gaspar', 'F', '929249131'),
(5, 'Aurora Benedito', 'F', ''),
(6, 'Teodoro Cadidi', 'M', ''),
(7, 'Miguel Manuel', 'M', ''),
(8, 'Anastácio José', 'M', '9904785947'),
(9, 'Magno Afonso', 'M', ''),
(10, 'Silas Viriato', 'M', ''),
(11, 'Humberto da Silva', 'M', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_curso`
--

CREATE TABLE `tbl_curso` (
  `id_curso` bigint(20) NOT NULL,
  `curso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_curso`
--

INSERT INTO `tbl_curso` (`id_curso`, `curso`) VALUES
(2, 'Nenhum'),
(3, 'Básico'),
(4, 'C. Físicas e Biológicas'),
(5, 'C. Humanas'),
(6, 'C. Economicas e Jurídicas'),
(7, 'C. Artes Plásticas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_estcomparticipadores`
--

CREATE TABLE `tbl_estcomparticipadores` (
  `id_comparticipadores` bigint(20) NOT NULL,
  `id_estudante` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_estcomparticipadores`
--

INSERT INTO `tbl_estcomparticipadores` (`id_comparticipadores`, `id_estudante`) VALUES
(1, 5),
(1, 10),
(7, 18),
(7, 9),
(3, 16),
(3, 14),
(8, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_estudante`
--

CREATE TABLE `tbl_estudante` (
  `id_estudante` bigint(20) NOT NULL,
  `id_pessoa` bigint(20) NOT NULL,
  `id_turma` bigint(20) DEFAULT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_estudante`
--

INSERT INTO `tbl_estudante` (`id_estudante`, `id_pessoa`, `id_turma`, `ano_lectivo`) VALUES
(5, 11, 3, 2021),
(6, 12, 3, 2020),
(7, 13, 3, 2020),
(8, 14, 3, 2020),
(9, 15, 3, 2020),
(10, 16, 3, 2020),
(11, 17, 3, 2020),
(12, 18, 3, 2020),
(13, 19, 3, 2020),
(14, 20, 3, 2020),
(15, 21, 3, 2020),
(16, 22, 3, 2020),
(17, 23, 3, 2020),
(18, 24, 5, 2021),
(19, 25, 4, 2020),
(20, 26, 5, 2020),
(21, 30, 6, 2020);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_extra`
--

CREATE TABLE `tbl_extra` (
  `id_extra` bigint(20) NOT NULL,
  `id_tipoPagamento` bigint(20) NOT NULL,
  `id_curso` bigint(20) NOT NULL,
  `id_classe` bigint(20) NOT NULL,
  `id_turno` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_extra`
--

INSERT INTO `tbl_extra` (`id_extra`, `id_tipoPagamento`, `id_curso`, `id_classe`, `id_turno`) VALUES
(1, 2, 3, 16, 5),
(2, 2, 3, 17, 5),
(3, 2, 3, 18, 5),
(4, 2, 3, 19, 5),
(5, 2, 3, 20, 5),
(6, 2, 3, 21, 5),
(7, 2, 3, 22, 5),
(8, 2, 3, 16, 6),
(9, 2, 3, 17, 6),
(10, 2, 3, 18, 6),
(11, 2, 3, 19, 6),
(12, 2, 3, 20, 6),
(13, 2, 3, 21, 6),
(14, 2, 3, 22, 6),
(15, 2, 3, 16, 7),
(16, 2, 3, 17, 7),
(17, 2, 3, 18, 7),
(18, 2, 3, 19, 7),
(19, 2, 3, 20, 7),
(20, 2, 3, 21, 7),
(21, 2, 3, 22, 7),
(22, 3, 3, 23, 5),
(23, 3, 3, 24, 5),
(24, 3, 3, 25, 5),
(25, 3, 3, 23, 6),
(26, 3, 3, 24, 6),
(27, 3, 3, 25, 6),
(28, 3, 3, 23, 7),
(29, 3, 3, 24, 7),
(30, 3, 3, 25, 7),
(31, 3, 4, 26, 5),
(32, 3, 4, 27, 5),
(33, 10, 4, 26, 5),
(34, 10, 4, 27, 5),
(35, 10, 4, 28, 5),
(36, 10, 4, 29, 5),
(37, 10, 4, 26, 6),
(38, 10, 4, 27, 6),
(39, 10, 4, 28, 6),
(40, 10, 4, 29, 6),
(41, 10, 4, 26, 7),
(42, 10, 4, 27, 7),
(43, 10, 4, 28, 7),
(44, 10, 4, 29, 7),
(45, 3, 7, 26, 5),
(46, 3, 7, 27, 5),
(47, 3, 7, 28, 5),
(48, 3, 7, 29, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_historico`
--

CREATE TABLE `tbl_historico` (
  `id_estudante` bigint(20) NOT NULL,
  `id_turma` bigint(20) DEFAULT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_historico`
--

INSERT INTO `tbl_historico` (`id_estudante`, `id_turma`, `ano_lectivo`) VALUES
(5, 3, 2020),
(6, 3, 2020),
(7, 3, 2020),
(8, 3, 2020),
(9, 3, 2020),
(10, 3, 2020),
(11, 3, 2020),
(12, 3, 2020),
(13, 3, 2020),
(14, 3, 2020),
(15, 3, 2020),
(16, 3, 2020),
(17, 3, 2020),
(18, 4, 2020),
(19, 4, 2020),
(20, 5, 2020),
(18, 5, 2021),
(5, 3, 2021),
(21, 6, 2020);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_listapagamento`
--

CREATE TABLE `tbl_listapagamento` (
  `id_listaPagamento` bigint(20) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_listapagamento`
--

INSERT INTO `tbl_listapagamento` (`id_listaPagamento`, `descricao`) VALUES
(1, 'Propina'),
(2, 'Matrícula'),
(3, 'Comparticipação de Pais'),
(4, 'Declaração'),
(5, 'Transferência'),
(6, 'Folha de Prova'),
(7, 'Certificado'),
(8, 'Transporte'),
(9, 'Estágio'),
(10, 'Uniforme'),
(11, 'Recurso'),
(12, 'Exame Especial'),
(13, 'Reconfirmação de Matrícula');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_meses`
--

CREATE TABLE `tbl_meses` (
  `id_mes` bigint(20) NOT NULL,
  `mes` varchar(30) NOT NULL,
  `tipo` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_meses`
--

INSERT INTO `tbl_meses` (`id_mes`, `mes`, `tipo`) VALUES
(1, 'Janeiro', 1),
(2, 'Fevereiro', 1),
(3, 'Março', 1),
(4, 'Abril', 1),
(5, 'Maio', 1),
(6, 'Junho', 1),
(7, 'Julho', 1),
(8, 'Agosto', 1),
(9, 'Setembro', 1),
(10, 'Outubro', 1),
(11, 'Novembro', 1),
(12, 'Dezembro', 1),
(13, '1º Trimestre', 2),
(14, '2º Trimestre', 2),
(15, '3º Trimestre', 2),
(16, '1º Semestre', 3),
(17, '2º Semestre', 3),
(18, 'Anual', 4),
(19, 'Nenhum', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_modalidade`
--

CREATE TABLE `tbl_modalidade` (
  `id_modalidade` bigint(20) NOT NULL,
  `modalidade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_modalidade`
--

INSERT INTO `tbl_modalidade` (`id_modalidade`, `modalidade`) VALUES
(1, 'Mensal'),
(2, 'Trimestral'),
(3, 'Semestral'),
(4, 'Anual'),
(5, 'Nenhum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pagamentos`
--

CREATE TABLE `tbl_pagamentos` (
  `id_pagamento` bigint(20) NOT NULL,
  `id_estudante` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `id_tipoPagamento` bigint(20) NOT NULL,
  `id_mes` bigint(20) DEFAULT NULL,
  `valor_pago` decimal(12,2) NOT NULL,
  `data_pagamento` date NOT NULL,
  `hora_pagamento` varchar(12) NOT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_pagamentos`
--

INSERT INTO `tbl_pagamentos` (`id_pagamento`, `id_estudante`, `id_usuario`, `id_tipoPagamento`, `id_mes`, `valor_pago`, `data_pagamento`, `hora_pagamento`, `ano_lectivo`) VALUES
(4, 10, 1, 4, 13, '1000.00', '2020-03-17', '08:10:05', 2020),
(5, 10, 1, 4, 14, '1000.00', '2020-03-17', '08:10:05', 2020),
(6, 10, 1, 7, 18, '2000.00', '2020-03-17', '08:10:54', 2020),
(7, 10, 1, 4, 15, '1000.00', '2020-03-17', '08:43:05', 2020),
(8, 13, 1, 4, 13, '1000.00', '2020-03-17', '10:16:46', 2020),
(9, 20, 1, 4, 13, '1000.00', '2020-03-17', '10:54:56', 2020),
(10, 20, 1, 4, 14, '1000.00', '2020-03-17', '10:54:56', 2020),
(11, 18, 1, 4, 13, '1000.00', '2020-03-17', '14:38:17', 2020),
(12, 9, 1, 4, 13, '1000.00', '2020-03-20', '16:30:29', 2020),
(13, 9, 1, 4, 14, '1000.00', '2020-03-20', '16:30:29', 2020),
(14, 6, 1, 4, 13, '1000.00', '2020-03-21', '08:45:02', 2020),
(15, 6, 1, 4, 14, '1000.00', '2020-03-21', '08:45:02', 2020),
(16, 13, 1, 5, 1, '2000.00', '2020-03-26', '12:02:10', 2020),
(17, 13, 1, 5, 2, '2000.00', '2020-03-26', '12:02:10', 2020),
(18, 13, 1, 5, 3, '2000.00', '2020-03-26', '12:02:10', 2020),
(19, 18, 1, 4, 14, '1000.00', '2020-03-26', '12:03:49', 2020),
(20, 5, 1, 4, 13, '1000.00', '2020-03-26', '17:56:26', 2020),
(21, 5, 1, 4, 14, '1000.00', '2020-03-26', '17:56:26', 2020),
(22, 21, 1, 10, 16, '1200.00', '2020-03-28', '22:53:25', 2020),
(23, 18, 1, 4, 15, '1000.00', '2020-04-01', '20:53:13', 2020);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_permicao`
--

CREATE TABLE `tbl_permicao` (
  `id_usuario` bigint(20) NOT NULL,
  `id_tipoPermicao` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_permicao`
--

INSERT INTO `tbl_permicao` (`id_usuario`, `id_tipoPermicao`) VALUES
(1, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pessoa`
--

CREATE TABLE `tbl_pessoa` (
  `id_pessoa` bigint(20) NOT NULL,
  `bi` varchar(25) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `genero` char(1) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_cadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_pessoa`
--

INSERT INTO `tbl_pessoa` (`id_pessoa`, `bi`, `nome`, `genero`, `data_nascimento`, `data_cadastro`) VALUES
(1, '0083777NE098', 'Maria da Conceição', 'F', '2020-03-02', '2020-03-07'),
(2, '8348886NE091', 'Gelson Calala', 'M', '2016-08-10', '2020-03-07'),
(11, '000000HUQ094', 'Marina Cardoso', 'F', '2007-03-07', '2020-03-26'),
(12, '', 'Henrique Tchilanda', 'M', '2010-06-16', '2020-03-08'),
(13, '', 'Vanuza Nhanga', 'F', '2003-02-04', '2020-03-08'),
(14, '787348934HY096', 'Gustavo Macuva', 'M', '2006-02-07', '2020-03-08'),
(15, '', 'Ester Catane', 'F', '2011-02-08', '2020-03-08'),
(16, '', 'Bejamim Ndala', 'M', '1998-06-16', '2020-03-08'),
(17, '', 'Viriato da Cruz', 'M', '1984-06-13', '2020-03-08'),
(18, '', 'Ricardo Vilolo', 'M', '2009-02-10', '2020-03-09'),
(19, '', 'Ana Maria das Dores', 'F', '2009-03-02', '2020-03-09'),
(20, '', 'Alfredo Viti', 'M', '2009-06-09', '2020-03-09'),
(21, '', 'Rainha Clara', 'F', '2006-02-07', '2020-03-09'),
(22, '', 'Joaquina Raul', 'F', '2001-06-12', '2020-03-09'),
(23, '', 'João Batista', 'M', '2007-01-16', '2020-03-09'),
(24, '', 'Anita Borges', 'F', '2009-02-17', '2020-03-26'),
(25, '', 'Matias Calandula', 'M', '2003-05-13', '2020-03-16'),
(26, '', 'Marcos Lyon', 'M', '2008-02-05', '2020-03-16'),
(27, '787348934HY111', 'Martes Aniel', 'M', '2010-02-09', '2020-03-28'),
(28, '002838HU921', 'Kid MC', 'M', '2010-03-16', '2020-03-28'),
(29, '006571136NE099', 'Ana Carolina Bonga', 'F', '2010-01-05', '2020-03-28'),
(30, '', 'José Calitoco', 'M', '2004-02-10', '2020-03-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_tipopagamento`
--

CREATE TABLE `tbl_tipopagamento` (
  `id_tipoPagamento` bigint(20) NOT NULL,
  `id_listaPagamento` bigint(20) NOT NULL,
  `id_modalidade` bigint(20) NOT NULL,
  `valor` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_tipopagamento`
--

INSERT INTO `tbl_tipopagamento` (`id_tipoPagamento`, `id_listaPagamento`, `id_modalidade`, `valor`) VALUES
(2, 2, 4, '2000.00'),
(3, 2, 4, '3500.00'),
(4, 3, 2, '1000.00'),
(5, 1, 1, '2000.00'),
(6, 1, 2, '2500.00'),
(7, 13, 4, '2000.00'),
(8, 5, 5, '500.00'),
(9, 5, 5, '1000.00'),
(10, 6, 3, '1200.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_tipopermicao`
--

CREATE TABLE `tbl_tipopermicao` (
  `id_tipoPermicao` bigint(20) NOT NULL,
  `descricao_permicao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_tipopermicao`
--

INSERT INTO `tbl_tipopermicao` (`id_tipoPermicao`, `descricao_permicao`) VALUES
(1, 'all'),
(2, 'restrit 1'),
(3, 'restrit 2'),
(4, 'restrit 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_turma`
--

CREATE TABLE `tbl_turma` (
  `id_turma` bigint(20) NOT NULL,
  `id_curso` bigint(20) NOT NULL,
  `id_classe` bigint(20) NOT NULL,
  `id_turno` bigint(20) NOT NULL,
  `turma` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_turma`
--

INSERT INTO `tbl_turma` (`id_turma`, `id_curso`, `id_classe`, `id_turno`, `turma`) VALUES
(3, 2, 15, 4, 'Nenhum'),
(4, 3, 25, 5, '9ª A'),
(5, 3, 25, 5, '9ª B'),
(6, 4, 26, 5, 'CFB_A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_turno`
--

CREATE TABLE `tbl_turno` (
  `id_turno` bigint(20) NOT NULL,
  `turno` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_turno`
--

INSERT INTO `tbl_turno` (`id_turno`, `turno`) VALUES
(4, 'Nenhum'),
(5, 'Manhã'),
(6, 'Tarde'),
(7, 'Noite');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` bigint(20) NOT NULL,
  `id_pessoa` bigint(20) NOT NULL,
  `nome_usuario` varchar(30) NOT NULL,
  `palavra_passe` varchar(50) NOT NULL,
  `estado_usuario` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `id_pessoa`, `nome_usuario`, `palavra_passe`, `estado_usuario`) VALUES
(1, 1, 'maria.conceicao', 'olaola', 'on'),
(2, 2, 'jelson', '123ola', 'on'),
(3, 27, 'martes.ani', '787348934HY111', 'on'),
(4, 28, 'kid.mc', '002838HU921', 'on'),
(5, 29, 'carolina.bg', '006571136NE099', 'off');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_estcomparticipadores`
--
CREATE TABLE `view_estcomparticipadores` (
`id_comparticipadores` bigint(20)
,`id_estudante` bigint(20)
,`nome_comparticipador` varchar(100)
,`nome` varchar(100)
,`genero` char(1)
,`data_nascimento` date
,`turma` varchar(20)
,`ano_lectivo` int(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_estudante`
--
CREATE TABLE `view_estudante` (
`id_estudante` bigint(20)
,`id_pessoa` bigint(20)
,`bi` varchar(25)
,`nome` varchar(100)
,`genero` char(1)
,`data_nascimento` date
,`turma` varchar(20)
,`turno` varchar(20)
,`curso` varchar(50)
,`classe` varchar(20)
,`ano_lectivo` int(6)
,`data_cadastro` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_extra`
--
CREATE TABLE `view_extra` (
`id_extra` bigint(20)
,`id_curso` bigint(20)
,`id_classe` bigint(20)
,`id_turno` bigint(20)
,`id_tipoPagamento` bigint(20)
,`id_listaPagamento` bigint(20)
,`curso` varchar(50)
,`classe` varchar(20)
,`turno` varchar(20)
,`id_modalidade` bigint(20)
,`descricao` varchar(60)
,`modalidade` varchar(50)
,`valor` decimal(12,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_historico`
--
CREATE TABLE `view_historico` (
`id_estudante` bigint(20)
,`id_turma` bigint(20)
,`ano_lectivo` int(6)
,`bi` varchar(25)
,`nome` varchar(100)
,`genero` char(1)
,`data_nascimento` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pagamentos`
--
CREATE TABLE `view_pagamentos` (
`id_pagamento` bigint(20)
,`id_estudante` bigint(20)
,`nome` varchar(100)
,`id_tipoPagamento` bigint(20)
,`id_mes` bigint(20)
,`valor_pago` decimal(12,2)
,`data_pagamento` date
,`hora_pagamento` varchar(12)
,`ano_lectivo` int(6)
,`descricao` varchar(60)
,`mes` varchar(30)
,`tipo` int(4)
,`nome_usuario` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_tipopagamento`
--
CREATE TABLE `view_tipopagamento` (
`id_tipoPagamento` bigint(20)
,`id_listaPagamento` bigint(20)
,`id_modalidade` bigint(20)
,`descricao` varchar(60)
,`modalidade` varchar(50)
,`valor` decimal(12,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_turma`
--
CREATE TABLE `view_turma` (
`id_turma` bigint(20)
,`turma` varchar(20)
,`curso` varchar(50)
,`classe` varchar(20)
,`turno` varchar(20)
,`id_classe` bigint(20)
,`id_curso` bigint(20)
,`id_turno` bigint(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_usuario`
--
CREATE TABLE `view_usuario` (
`id_usuario` bigint(20)
,`nome` varchar(100)
,`bi` varchar(25)
,`genero` char(1)
,`data_nascimento` date
,`nome_usuario` varchar(30)
,`palavra_passe` varchar(50)
,`estado_usuario` char(3)
);

-- --------------------------------------------------------

--
-- Structure for view `view_estcomparticipadores`
--
DROP TABLE IF EXISTS `view_estcomparticipadores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_estcomparticipadores`  AS  select `ec`.`id_comparticipadores` AS `id_comparticipadores`,`ec`.`id_estudante` AS `id_estudante`,`c`.`nome_comparticipador` AS `nome_comparticipador`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`data_nascimento` AS `data_nascimento`,`t`.`turma` AS `turma`,`e`.`ano_lectivo` AS `ano_lectivo` from ((((`tbl_estcomparticipadores` `ec` join `tbl_estudante` `e` on((`ec`.`id_estudante` = `e`.`id_estudante`))) join `tbl_comparticipadores` `c` on((`ec`.`id_comparticipadores` = `c`.`id_comparticipadores`))) join `tbl_pessoa` `p` on((`e`.`id_pessoa` = `p`.`id_pessoa`))) join `tbl_turma` `t` on((`e`.`id_turma` = `t`.`id_turma`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_estudante`
--
DROP TABLE IF EXISTS `view_estudante`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_estudante`  AS  select `e`.`id_estudante` AS `id_estudante`,`p`.`id_pessoa` AS `id_pessoa`,`p`.`bi` AS `bi`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`data_nascimento` AS `data_nascimento`,`t`.`turma` AS `turma`,`tur`.`turno` AS `turno`,`c`.`curso` AS `curso`,`cla`.`classe` AS `classe`,`e`.`ano_lectivo` AS `ano_lectivo`,`p`.`data_cadastro` AS `data_cadastro` from (((((`tbl_pessoa` `p` join `tbl_estudante` `e` on((`p`.`id_pessoa` = `e`.`id_pessoa`))) join `tbl_turma` `t` on((`e`.`id_turma` = `t`.`id_turma`))) join `tbl_classe` `cla` on((`t`.`id_classe` = `cla`.`id_classe`))) join `tbl_turno` `tur` on((`t`.`id_turno` = `tur`.`id_turno`))) join `tbl_curso` `c` on((`t`.`id_curso` = `c`.`id_curso`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_extra`
--
DROP TABLE IF EXISTS `view_extra`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_extra`  AS  select `ex`.`id_extra` AS `id_extra`,`c`.`id_curso` AS `id_curso`,`cla`.`id_classe` AS `id_classe`,`t`.`id_turno` AS `id_turno`,`tp`.`id_tipoPagamento` AS `id_tipoPagamento`,`lp`.`id_listaPagamento` AS `id_listaPagamento`,`c`.`curso` AS `curso`,`cla`.`classe` AS `classe`,`t`.`turno` AS `turno`,`m`.`id_modalidade` AS `id_modalidade`,`lp`.`descricao` AS `descricao`,`m`.`modalidade` AS `modalidade`,`tp`.`valor` AS `valor` from ((((((`tbl_extra` `ex` join `tbl_curso` `c` on((`ex`.`id_curso` = `c`.`id_curso`))) join `tbl_classe` `cla` on((`ex`.`id_classe` = `cla`.`id_classe`))) join `tbl_turno` `t` on((`ex`.`id_turno` = `t`.`id_turno`))) join `tbl_tipopagamento` `tp` on((`ex`.`id_tipoPagamento` = `tp`.`id_tipoPagamento`))) join `tbl_listapagamento` `lp` on((`tp`.`id_listaPagamento` = `lp`.`id_listaPagamento`))) join `tbl_modalidade` `m` on((`tp`.`id_modalidade` = `m`.`id_modalidade`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_historico`
--
DROP TABLE IF EXISTS `view_historico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_historico`  AS  select `h`.`id_estudante` AS `id_estudante`,`h`.`id_turma` AS `id_turma`,`h`.`ano_lectivo` AS `ano_lectivo`,`p`.`bi` AS `bi`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`data_nascimento` AS `data_nascimento` from ((`tbl_historico` `h` join `tbl_estudante` `e` on((`h`.`id_estudante` = `e`.`id_estudante`))) join `tbl_pessoa` `p` on((`e`.`id_pessoa` = `p`.`id_pessoa`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_pagamentos`
--
DROP TABLE IF EXISTS `view_pagamentos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pagamentos`  AS  select `p`.`id_pagamento` AS `id_pagamento`,`e`.`id_estudante` AS `id_estudante`,`pe`.`nome` AS `nome`,`p`.`id_tipoPagamento` AS `id_tipoPagamento`,`p`.`id_mes` AS `id_mes`,`p`.`valor_pago` AS `valor_pago`,`p`.`data_pagamento` AS `data_pagamento`,`p`.`hora_pagamento` AS `hora_pagamento`,`p`.`ano_lectivo` AS `ano_lectivo`,`lp`.`descricao` AS `descricao`,`m`.`mes` AS `mes`,`m`.`tipo` AS `tipo`,`u`.`nome_usuario` AS `nome_usuario` from ((((((`tbl_pagamentos` `p` join `tbl_meses` `m` on((`p`.`id_mes` = `m`.`id_mes`))) join `tbl_usuario` `u` on((`p`.`id_usuario` = `u`.`id_usuario`))) join `tbl_estudante` `e` on((`p`.`id_estudante` = `e`.`id_estudante`))) join `tbl_pessoa` `pe` on((`e`.`id_pessoa` = `pe`.`id_pessoa`))) join `tbl_tipopagamento` `tp` on((`p`.`id_tipoPagamento` = `tp`.`id_tipoPagamento`))) join `tbl_listapagamento` `lp` on((`tp`.`id_listaPagamento` = `lp`.`id_listaPagamento`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_tipopagamento`
--
DROP TABLE IF EXISTS `view_tipopagamento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tipopagamento`  AS  select `tp`.`id_tipoPagamento` AS `id_tipoPagamento`,`lp`.`id_listaPagamento` AS `id_listaPagamento`,`m`.`id_modalidade` AS `id_modalidade`,`lp`.`descricao` AS `descricao`,`m`.`modalidade` AS `modalidade`,`tp`.`valor` AS `valor` from ((`tbl_tipopagamento` `tp` join `tbl_listapagamento` `lp` on((`tp`.`id_listaPagamento` = `lp`.`id_listaPagamento`))) join `tbl_modalidade` `m` on((`tp`.`id_modalidade` = `m`.`id_modalidade`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_turma`
--
DROP TABLE IF EXISTS `view_turma`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_turma`  AS  select `t`.`id_turma` AS `id_turma`,`t`.`turma` AS `turma`,`c`.`curso` AS `curso`,`cla`.`classe` AS `classe`,`tur`.`turno` AS `turno`,`cla`.`id_classe` AS `id_classe`,`c`.`id_curso` AS `id_curso`,`tur`.`id_turno` AS `id_turno` from (((`tbl_turma` `t` join `tbl_curso` `c` on((`t`.`id_curso` = `c`.`id_curso`))) join `tbl_classe` `cla` on((`t`.`id_classe` = `cla`.`id_classe`))) join `tbl_turno` `tur` on((`t`.`id_turno` = `tur`.`id_turno`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_usuario`
--
DROP TABLE IF EXISTS `view_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_usuario`  AS  select `u`.`id_usuario` AS `id_usuario`,`p`.`nome` AS `nome`,`p`.`bi` AS `bi`,`p`.`genero` AS `genero`,`p`.`data_nascimento` AS `data_nascimento`,`u`.`nome_usuario` AS `nome_usuario`,`u`.`palavra_passe` AS `palavra_passe`,`u`.`estado_usuario` AS `estado_usuario` from (`tbl_pessoa` `p` join `tbl_usuario` `u` on((`p`.`id_pessoa` = `u`.`id_pessoa`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_classe`
--
ALTER TABLE `tbl_classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Indexes for table `tbl_comparticipadores`
--
ALTER TABLE `tbl_comparticipadores`
  ADD PRIMARY KEY (`id_comparticipadores`);

--
-- Indexes for table `tbl_curso`
--
ALTER TABLE `tbl_curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indexes for table `tbl_estcomparticipadores`
--
ALTER TABLE `tbl_estcomparticipadores`
  ADD KEY `id_comparticipadores` (`id_comparticipadores`),
  ADD KEY `id_estudante` (`id_estudante`);

--
-- Indexes for table `tbl_estudante`
--
ALTER TABLE `tbl_estudante`
  ADD PRIMARY KEY (`id_estudante`),
  ADD KEY `id_pessoa` (`id_pessoa`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Indexes for table `tbl_extra`
--
ALTER TABLE `tbl_extra`
  ADD PRIMARY KEY (`id_extra`),
  ADD KEY `id_tipoPagamento` (`id_tipoPagamento`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_turno` (`id_turno`);

--
-- Indexes for table `tbl_historico`
--
ALTER TABLE `tbl_historico`
  ADD KEY `id_estudante` (`id_estudante`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Indexes for table `tbl_listapagamento`
--
ALTER TABLE `tbl_listapagamento`
  ADD PRIMARY KEY (`id_listaPagamento`);

--
-- Indexes for table `tbl_meses`
--
ALTER TABLE `tbl_meses`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `tbl_modalidade`
--
ALTER TABLE `tbl_modalidade`
  ADD PRIMARY KEY (`id_modalidade`);

--
-- Indexes for table `tbl_pagamentos`
--
ALTER TABLE `tbl_pagamentos`
  ADD PRIMARY KEY (`id_pagamento`),
  ADD KEY `id_estudante` (`id_estudante`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_tipoPagamento` (`id_tipoPagamento`),
  ADD KEY `fk_id_mes` (`id_mes`);

--
-- Indexes for table `tbl_permicao`
--
ALTER TABLE `tbl_permicao`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_tipoPermicao` (`id_tipoPermicao`);

--
-- Indexes for table `tbl_pessoa`
--
ALTER TABLE `tbl_pessoa`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Indexes for table `tbl_tipopagamento`
--
ALTER TABLE `tbl_tipopagamento`
  ADD PRIMARY KEY (`id_tipoPagamento`),
  ADD KEY `id_listaPagamento` (`id_listaPagamento`),
  ADD KEY `id_modalidade` (`id_modalidade`);

--
-- Indexes for table `tbl_tipopermicao`
--
ALTER TABLE `tbl_tipopermicao`
  ADD PRIMARY KEY (`id_tipoPermicao`);

--
-- Indexes for table `tbl_turma`
--
ALTER TABLE `tbl_turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_turno` (`id_turno`);

--
-- Indexes for table `tbl_turno`
--
ALTER TABLE `tbl_turno`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indexes for table `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_pessoa` (`id_pessoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_classe`
--
ALTER TABLE `tbl_classe`
  MODIFY `id_classe` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tbl_comparticipadores`
--
ALTER TABLE `tbl_comparticipadores`
  MODIFY `id_comparticipadores` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_curso`
--
ALTER TABLE `tbl_curso`
  MODIFY `id_curso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_estudante`
--
ALTER TABLE `tbl_estudante`
  MODIFY `id_estudante` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_extra`
--
ALTER TABLE `tbl_extra`
  MODIFY `id_extra` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tbl_listapagamento`
--
ALTER TABLE `tbl_listapagamento`
  MODIFY `id_listaPagamento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_meses`
--
ALTER TABLE `tbl_meses`
  MODIFY `id_mes` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_modalidade`
--
ALTER TABLE `tbl_modalidade`
  MODIFY `id_modalidade` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_pagamentos`
--
ALTER TABLE `tbl_pagamentos`
  MODIFY `id_pagamento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_pessoa`
--
ALTER TABLE `tbl_pessoa`
  MODIFY `id_pessoa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_tipopagamento`
--
ALTER TABLE `tbl_tipopagamento`
  MODIFY `id_tipoPagamento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_tipopermicao`
--
ALTER TABLE `tbl_tipopermicao`
  MODIFY `id_tipoPermicao` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_turma`
--
ALTER TABLE `tbl_turma`
  MODIFY `id_turma` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_turno`
--
ALTER TABLE `tbl_turno`
  MODIFY `id_turno` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbl_estcomparticipadores`
--
ALTER TABLE `tbl_estcomparticipadores`
  ADD CONSTRAINT `tbl_estcomparticipadores_ibfk_1` FOREIGN KEY (`id_comparticipadores`) REFERENCES `tbl_comparticipadores` (`id_comparticipadores`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_estcomparticipadores_ibfk_2` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_estudante`
--
ALTER TABLE `tbl_estudante`
  ADD CONSTRAINT `tbl_estudante_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `tbl_pessoa` (`id_pessoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_estudante_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `tbl_turma` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_extra`
--
ALTER TABLE `tbl_extra`
  ADD CONSTRAINT `id_turno` FOREIGN KEY (`id_turno`) REFERENCES `tbl_turno` (`id_turno`),
  ADD CONSTRAINT `tbl_extra_ibfk_1` FOREIGN KEY (`id_tipoPagamento`) REFERENCES `tbl_tipopagamento` (`id_tipoPagamento`),
  ADD CONSTRAINT `tbl_extra_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `tbl_curso` (`id_curso`),
  ADD CONSTRAINT `tbl_extra_ibfk_3` FOREIGN KEY (`id_classe`) REFERENCES `tbl_classe` (`id_classe`);

--
-- Limitadores para a tabela `tbl_historico`
--
ALTER TABLE `tbl_historico`
  ADD CONSTRAINT `tbl_historico_ibfk_1` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_historico_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `tbl_turma` (`id_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_pagamentos`
--
ALTER TABLE `tbl_pagamentos`
  ADD CONSTRAINT `fk_id_mes` FOREIGN KEY (`id_mes`) REFERENCES `tbl_meses` (`id_mes`),
  ADD CONSTRAINT `tbl_pagamentos_ibfk_1` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pagamentos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pagamentos_ibfk_3` FOREIGN KEY (`id_tipoPagamento`) REFERENCES `tbl_tipopagamento` (`id_tipoPagamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_permicao`
--
ALTER TABLE `tbl_permicao`
  ADD CONSTRAINT `tbl_permicao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_permicao_ibfk_2` FOREIGN KEY (`id_tipoPermicao`) REFERENCES `tbl_tipopermicao` (`id_tipoPermicao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_tipopagamento`
--
ALTER TABLE `tbl_tipopagamento`
  ADD CONSTRAINT `tbl_tipopagamento_ibfk_1` FOREIGN KEY (`id_listaPagamento`) REFERENCES `tbl_listapagamento` (`id_listaPagamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_tipopagamento_ibfk_2` FOREIGN KEY (`id_modalidade`) REFERENCES `tbl_modalidade` (`id_modalidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_turma`
--
ALTER TABLE `tbl_turma`
  ADD CONSTRAINT `tbl_turma_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `tbl_curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_turma_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `tbl_classe` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_turma_ibfk_3` FOREIGN KEY (`id_turno`) REFERENCES `tbl_turno` (`id_turno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `tbl_pessoa` (`id_pessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
