-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 31-Out-2021 às 13:35
-- Versão do servidor: 8.0.17
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `registro_progress`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `aluno_id` int(11) NOT NULL,
  `aluno_nome` varchar(200) NOT NULL,
  `aluno_cpf` varchar(20) NOT NULL,
  `aluno_rg` varchar(20) NOT NULL,
  `aluno_email` varchar(100) NOT NULL,
  `aluno_celular` varchar(15) NOT NULL,
  `aluno_senha` varchar(20) NOT NULL,
  `aluno_end` varchar(200) NOT NULL,
  `aluno_num` varchar(10) NOT NULL,
  `aluno_bairro` varchar(100) NOT NULL,
  `aluno_cidade` varchar(100) NOT NULL,
  `aluno_estado` varchar(100) NOT NULL,
  `aluno_cep` varchar(20) NOT NULL,
  `aluno_esc_id` int(11) DEFAULT NULL,
  `aluno_status` tinyint(4) NOT NULL,
  `aluno_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`aluno_id`, `aluno_nome`, `aluno_cpf`, `aluno_rg`, `aluno_email`, `aluno_celular`, `aluno_senha`, `aluno_end`, `aluno_num`, `aluno_bairro`, `aluno_cidade`, `aluno_estado`, `aluno_cep`, `aluno_esc_id`, `aluno_status`, `aluno_registro`) VALUES
(1, 'Fabio Valeri', '11111111111', '1111111', 'valerio.fabio@gmail.com', '12552122', '123', '1', '1', '1', '1', '1', '0', 1, 1, '2021-10-29 00:00:00'),
(2, 'Fabio Valerio', '222.222.222-22', '3333333333333', 'fabio@agenciasupermkt.com.br', '(12) 97410-5202', '123456', 'Avenida Dom Pedro I', '123', 'Bosque da Saúde', 'Taubaté', 'SP', '12082-000', 0, 1, '2021-10-30 13:26:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_cursos`
--

CREATE TABLE `aluno_cursos` (
  `cursos_id` int(11) NOT NULL,
  `cursos_id_curso` int(11) NOT NULL,
  `curso_valor` float(10,2) DEFAULT NULL,
  `cursos_id_aluno` int(11) NOT NULL,
  `cursos_registro` datetime NOT NULL,
  `cursos_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aluno_cursos`
--

INSERT INTO `aluno_cursos` (`cursos_id`, `cursos_id_curso`, `curso_valor`, `cursos_id_aluno`, `cursos_registro`, `cursos_status`) VALUES
(1, 1, 299.99, 1, '2021-10-29 00:00:00', 1),
(2, 1, 299.99, 2, '2021-10-30 15:51:26', 0),
(3, 1, 299.90, 2, '2021-10-30 15:55:06', 1),
(4, 1, 299.90, 2, '2021-10-30 16:10:13', 1),
(5, 1, 299.90, 2, '2021-10-31 09:38:49', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `curso_id` int(11) NOT NULL,
  `curso_nome` varchar(250) NOT NULL,
  `curso_valor` float(10,2) DEFAULT NULL,
  `curso_status` tinyint(4) NOT NULL,
  `curso_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`curso_id`, `curso_nome`, `curso_valor`, `curso_status`, `curso_registro`) VALUES
(1, 'Pós Educação Financeira', 299.90, 1, '2021-10-22 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `esc_id` int(11) NOT NULL,
  `esc_nome` varchar(200) NOT NULL,
  `esc_fantasia` varchar(200) NOT NULL,
  `esc_cnpj` varchar(200) NOT NULL,
  `esc_end` varchar(100) NOT NULL,
  `esc_num` varchar(10) NOT NULL,
  `esc_bairro` varchar(100) NOT NULL,
  `esc_cidade` varchar(100) NOT NULL,
  `esc_estado` varchar(100) NOT NULL,
  `esc_cep` varchar(10) NOT NULL,
  `esc_responsavel` varchar(200) NOT NULL,
  `esc_cpf` varchar(15) NOT NULL,
  `esc_rg` varchar(15) NOT NULL,
  `esc_email` varchar(200) NOT NULL,
  `esc_senha` varchar(20) NOT NULL,
  `esc_telefone` varchar(20) DEFAULT NULL,
  `esc_celular` varchar(20) DEFAULT NULL,
  `esc_status` tinyint(4) NOT NULL DEFAULT '1',
  `esc_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`esc_id`, `esc_nome`, `esc_fantasia`, `esc_cnpj`, `esc_end`, `esc_num`, `esc_bairro`, `esc_cidade`, `esc_estado`, `esc_cep`, `esc_responsavel`, `esc_cpf`, `esc_rg`, `esc_email`, `esc_senha`, `esc_telefone`, `esc_celular`, `esc_status`, `esc_registro`) VALUES
(1, 'Escola do Futuro ', 'Escola do Futuro ', '000000000000', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'valerio.fabio@gmail.com', '1q2w3e5t9o', '0', '0', 1, '2021-10-27 00:00:00'),
(2, 'Progress Educacional LTDA ME', 'Progress Educacional', '11.111.111/1111-11', 'Avenida Dom Pedro I', '1', 'Bosque da Saúde', 'Taubaté', 'SP', '12082-000', 'Valerio', '111.111.111-11', '1', 'fabio@agenciasupermkt.com.br', '123456', '(11) 1111-1111', '(11) 11111-1111', 1, '2021-10-28 19:50:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `pag_id` int(11) NOT NULL,
  `pag_registro` tinyint(4) NOT NULL,
  `pag_id_aulo` int(11) NOT NULL,
  `pag_id_curso` int(11) NOT NULL,
  `pag_forma_pagamento` varchar(200) DEFAULT NULL,
  `pag_parcelas` int(11) NOT NULL,
  `pag_valor` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `prof_id` int(11) NOT NULL,
  `prof_esc_id` int(11) NOT NULL,
  `prof_nome` varchar(200) NOT NULL,
  `prof_cpf` varchar(20) NOT NULL,
  `prof_registro` datetime NOT NULL,
  `prof_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`prof_id`, `prof_esc_id`, `prof_nome`, `prof_cpf`, `prof_registro`, `prof_status`) VALUES
(1, 1, 'Fabio Valerio', '3429814040', '2021-10-27 00:00:00', 1),
(2, 2, 'Fafa', '222.222.222-22', '2021-10-29 17:48:30', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `user_id` int(11) NOT NULL,
  `user_tipo` int(11) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_senha` varchar(255) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `user_nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`user_id`, `user_tipo`, `user_email`, `user_senha`, `user_status`, `user_nivel`) VALUES
(1, 1, 'fabio@agenciasupermkt.com.br', '123456', 1, 1),
(2, NULL, 'valerio.fabio@gmail.com', 'Teste123', 1, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`aluno_id`);

--
-- Índices para tabela `aluno_cursos`
--
ALTER TABLE `aluno_cursos`
  ADD PRIMARY KEY (`cursos_id`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`curso_id`);

--
-- Índices para tabela `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`esc_id`);

--
-- Índices para tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`pag_id`);

--
-- Índices para tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`prof_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `aluno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `aluno_cursos`
--
ALTER TABLE `aluno_cursos`
  MODIFY `cursos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `curso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `esc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `pag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
