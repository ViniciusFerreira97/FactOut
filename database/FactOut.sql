-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 28/03/2019 às 21:07
-- Versão do servidor: 5.7.25-0ubuntu0.18.04.2
-- Versão do PHP: 7.3.3-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `FactOut`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_usuario` int(11) NOT NULL,
  `curso` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `codigo_turma` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` int(11) NOT NULL,
  `codigo_turma` int(11) NOT NULL,
  `lider` int(11) NOT NULL,
  `id_jf` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fato`
--

CREATE TABLE `fato` (
  `id_fato` int(11) NOT NULL,
  `orderm_fato` int(11) NOT NULL,
  `texto_fato` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `resposta_fato` tinyint(1) NOT NULL,
  `id_jf` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `julgamento_fatos`
--

CREATE TABLE `julgamento_fatos` (
  `id_jf` int(11) NOT NULL,
  `codigo_turma` int(11) NOT NULL,
  `tamanho_equipe` int(1) NOT NULL,
  `tempo_fato` time NOT NULL,
  `status_jf` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `resposta`
--

CREATE TABLE `resposta` (
  `id_lider` int(11) NOT NULL,
  `id_fato` int(11) NOT NULL,
  `resposta` tinyint(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `codigo_turma` int(11) NOT NULL,
  `disciplina` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `curso` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `unidade_universidade` int(11) NOT NULL,
  `id_professor` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `login` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `senha` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `tipo_usuario` varchar(9) COLLATE utf8mb4_bin NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `aluno_ibfk_2` (`codigo_turma`);

--
-- Índices de tabela `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `codigo_turma` (`codigo_turma`),
  ADD KEY `id_jf` (`id_jf`),
  ADD KEY `lider` (`lider`);

--
-- Índices de tabela `fato`
--
ALTER TABLE `fato`
  ADD PRIMARY KEY (`id_fato`),
  ADD KEY `id_jf` (`id_jf`);

--
-- Índices de tabela `julgamento_fatos`
--
ALTER TABLE `julgamento_fatos`
  ADD PRIMARY KEY (`id_jf`),
  ADD KEY `codigo_turma` (`codigo_turma`);

--
-- Índices de tabela `resposta`
--
ALTER TABLE `resposta`
  ADD KEY `resposta_ibfk_1` (`id_lider`),
  ADD KEY `id_fato` (`id_fato`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`codigo_turma`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `fato`
--
ALTER TABLE `fato`
  MODIFY `id_fato` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `julgamento_fatos`
--
ALTER TABLE `julgamento_fatos`
  MODIFY `id_jf` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `codigo_turma` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`codigo_turma`) REFERENCES `turma` (`codigo_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_1` FOREIGN KEY (`codigo_turma`) REFERENCES `turma` (`codigo_turma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipe_ibfk_3` FOREIGN KEY (`id_jf`) REFERENCES `julgamento_fatos` (`id_jf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipe_ibfk_4` FOREIGN KEY (`lider`) REFERENCES `aluno` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `fato`
--
ALTER TABLE `fato`
  ADD CONSTRAINT `fato_ibfk_1` FOREIGN KEY (`id_jf`) REFERENCES `julgamento_fatos` (`id_jf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `julgamento_fatos`
--
ALTER TABLE `julgamento_fatos`
  ADD CONSTRAINT `julgamento_fatos_ibfk_1` FOREIGN KEY (`codigo_turma`) REFERENCES `turma` (`codigo_turma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`id_lider`) REFERENCES `aluno` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resposta_ibfk_2` FOREIGN KEY (`id_fato`) REFERENCES `fato` (`id_fato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
