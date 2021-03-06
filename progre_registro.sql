-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Dez-2021 às 17:58
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `progre_registro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `aluno_id` int(11) NOT NULL,
  `aluno_id_onepay` int(11) DEFAULT NULL,
  `aluno_nome` varchar(200) NOT NULL,
  `aluno_nascimento` date NOT NULL,
  `aluno_sexo` varchar(1) NOT NULL,
  `aluno_cpf` varchar(20) NOT NULL,
  `aluno_rg` varchar(20) DEFAULT NULL,
  `aluno_email` varchar(100) NOT NULL,
  `aluno_celular` varchar(15) DEFAULT NULL,
  `aluno_telefone` varchar(20) DEFAULT NULL,
  `aluno_senha` varchar(20) NOT NULL,
  `aluno_end` varchar(200) DEFAULT NULL,
  `aluno_num` varchar(10) DEFAULT NULL,
  `aluno_complemento` varchar(150) DEFAULT NULL,
  `aluno_bairro` varchar(100) DEFAULT NULL,
  `aluno_cidade` varchar(100) DEFAULT NULL,
  `aluno_estado` varchar(100) DEFAULT NULL,
  `aluno_cep` varchar(20) DEFAULT NULL,
  `aluno_status` tinyint(4) DEFAULT NULL,
  `aluno_registro` datetime DEFAULT NULL,
  `aluno_tipo` tinyint(1) DEFAULT NULL COMMENT '0 - professor / 1 - aluno',
  `aluno_esc_id` int(11) DEFAULT NULL,
  `classe_class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_cursos`
--

CREATE TABLE `aluno_cursos` (
  `cursos_id` int(11) NOT NULL,
  `curso_valor` float(10,2) DEFAULT NULL,
  `cursos_registro` datetime NOT NULL,
  `cursos_data_inicio` date DEFAULT NULL,
  `cursos_data_fim` date DEFAULT NULL,
  `cursos_data_dias` int(5) DEFAULT NULL,
  `cursos_status` tinyint(4) NOT NULL,
  `cursos_id_curso` int(11) NOT NULL,
  `aluno_aluno_id` int(11) NOT NULL,
  `cursos_codigo` varchar(100) NOT NULL COMMENT 'sales_order',
  `cursos_tipo_pagamento` int(11) NOT NULL COMMENT '1-cartao / 2-boleto',
  `cursos_pagmento_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe`
--

CREATE TABLE `classe` (
  `class_id` int(11) NOT NULL,
  `class_nome` varchar(200) DEFAULT NULL,
  `escola_esc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

CREATE TABLE `cupom` (
  `cup_id` int(11) NOT NULL,
  `cup_nome` varchar(45) NOT NULL,
  `cup_data` date DEFAULT NULL,
  `cup_validade` date DEFAULT NULL,
  `cup_registro` datetime NOT NULL,
  `cup_valor` int(11) NOT NULL,
  `cup_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom_usado`
--

CREATE TABLE `cupom_usado` (
  `cup_user_id` int(11) NOT NULL,
  `cup_utilizado` datetime NOT NULL,
  `cup_id` int(11) NOT NULL,
  `cup_aulo_cursos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `curso_id` int(11) NOT NULL,
  `curso_nome` varchar(250) NOT NULL,
  `curso_descricao` longtext DEFAULT NULL,
  `curso_valor` float(10,2) DEFAULT NULL,
  `curso_status` tinyint(4) NOT NULL,
  `curso_registro` datetime NOT NULL,
  `curso_validade_dias` int(11) DEFAULT NULL,
  `curso_validade_data_inicio` date DEFAULT NULL,
  `curso_validade_data_fim` date DEFAULT NULL,
  `curso_tipo` tinyint(1) DEFAULT NULL COMMENT '0 - professor / 1 - aluno',
  `curso_categoria_cat_curso_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_categoria`
--

CREATE TABLE `curso_categoria` (
  `cat_curso_id` int(10) UNSIGNED NOT NULL,
  `cat_curso_nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `esc_complemento` varchar(150) DEFAULT NULL,
  `esc_bairro` varchar(100) NOT NULL,
  `esc_cidade` varchar(100) NOT NULL,
  `esc_estado` varchar(100) NOT NULL,
  `esc_cep` varchar(10) NOT NULL,
  `esc_responsavel` varchar(200) NOT NULL,
  `esc_cargo` varchar(200) DEFAULT NULL,
  `esc_cpf` varchar(15) NOT NULL,
  `esc_rg` varchar(15) NOT NULL,
  `esc_email` varchar(200) NOT NULL,
  `esc_senha` varchar(20) NOT NULL,
  `esc_telefone` varchar(20) DEFAULT NULL,
  `esc_celular` varchar(20) DEFAULT NULL,
  `esc_status` tinyint(4) NOT NULL DEFAULT 1,
  `esc_registro` datetime NOT NULL
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
(3, 1, 'fabio@agenciasupermkt.com.br', '123456', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`aluno_id`),
  ADD KEY `fk_aluno_escola1_idx` (`aluno_esc_id`),
  ADD KEY `fk_aluno_classe1_idx` (`classe_class_id`);

--
-- Índices para tabela `aluno_cursos`
--
ALTER TABLE `aluno_cursos`
  ADD PRIMARY KEY (`cursos_id`),
  ADD KEY `fk_aluno_cursos_curso1_idx` (`cursos_id_curso`),
  ADD KEY `fk_aluno_cursos_aluno1_idx` (`aluno_aluno_id`);

--
-- Índices para tabela `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_id_UNIQUE` (`class_id`),
  ADD KEY `fk_classe_escola1_idx` (`escola_esc_id`);

--
-- Índices para tabela `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`cup_id`);

--
-- Índices para tabela `cupom_usado`
--
ALTER TABLE `cupom_usado`
  ADD PRIMARY KEY (`cup_user_id`),
  ADD KEY `cup_id` (`cup_id`),
  ADD KEY `cup_aulo_cursos_id` (`cup_aulo_cursos_id`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`curso_id`),
  ADD KEY `fk_curso_curso_categoria1_idx` (`curso_categoria_cat_curso_id`);

--
-- Índices para tabela `curso_categoria`
--
ALTER TABLE `curso_categoria`
  ADD PRIMARY KEY (`cat_curso_id`);

--
-- Índices para tabela `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`esc_id`);

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
  MODIFY `aluno_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `aluno_cursos`
--
ALTER TABLE `aluno_cursos`
  MODIFY `cursos_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `classe`
--
ALTER TABLE `classe`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cupom`
--
ALTER TABLE `cupom`
  MODIFY `cup_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cupom_usado`
--
ALTER TABLE `cupom_usado`
  MODIFY `cup_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `curso_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso_categoria`
--
ALTER TABLE `curso_categoria`
  MODIFY `cat_curso_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `esc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_classe1` FOREIGN KEY (`classe_class_id`) REFERENCES `classe` (`class_id`),
  ADD CONSTRAINT `fk_aluno_escola1` FOREIGN KEY (`aluno_esc_id`) REFERENCES `escola` (`esc_id`);

--
-- Limitadores para a tabela `aluno_cursos`
--
ALTER TABLE `aluno_cursos`
  ADD CONSTRAINT `fk_aluno_cursos_aluno1` FOREIGN KEY (`aluno_aluno_id`) REFERENCES `aluno` (`aluno_id`),
  ADD CONSTRAINT `fk_aluno_cursos_curso1` FOREIGN KEY (`cursos_id_curso`) REFERENCES `curso` (`curso_id`);

--
-- Limitadores para a tabela `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `fk_classe_escola1` FOREIGN KEY (`escola_esc_id`) REFERENCES `escola` (`esc_id`);

--
-- Limitadores para a tabela `cupom_usado`
--
ALTER TABLE `cupom_usado`
  ADD CONSTRAINT `cupom_usado_ibfk_1` FOREIGN KEY (`cup_id`) REFERENCES `cupom` (`cup_id`),
  ADD CONSTRAINT `cupom_usado_ibfk_2` FOREIGN KEY (`cup_aulo_cursos_id`) REFERENCES `aluno_cursos` (`cursos_id`);

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_curso_categoria1` FOREIGN KEY (`curso_categoria_cat_curso_id`) REFERENCES `curso_categoria` (`cat_curso_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
