-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/11/2023 às 14:10
-- Versão do servidor: 10.4.25-MariaDB
-- Versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `combo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscricao`
--

CREATE TABLE `inscricao` (
  `id_inscricao` int(10) UNSIGNED NOT NULL,
  `id_sorteio` int(10) UNSIGNED NOT NULL,
  `documento_participante` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sorteio`
--

CREATE TABLE `sorteio` (
  `id_sorteio` int(10) UNSIGNED NOT NULL,
  `nome_sorteio` varchar(255) DEFAULT NULL,
  `maximo_participantes` int(10) UNSIGNED DEFAULT NULL,
  `restricao_maioridade` bit(1) DEFAULT NULL,
  `administrador` varchar(18) NOT NULL,
  `data` date NOT NULL,
  `formato` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `nome_usuario` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `documento` varchar(18) NOT NULL,
  `senha` char(60) NOT NULL,
  `maioridade` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`id_inscricao`),
  ADD KEY `id_sorteio` (`id_sorteio`),
  ADD KEY `documento_participante` (`documento_participante`);

--
-- Índices de tabela `sorteio`
--
ALTER TABLE `sorteio`
  ADD PRIMARY KEY (`id_sorteio`),
  ADD KEY `administrador` (`administrador`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`documento`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `id_inscricao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sorteio`
--
ALTER TABLE `sorteio`
  MODIFY `id_sorteio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`id_sorteio`) REFERENCES `sorteio` (`id_sorteio`),
  ADD CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`documento_participante`) REFERENCES `usuario` (`documento`);

--
-- Restrições para tabelas `sorteio`
--
ALTER TABLE `sorteio`
  ADD CONSTRAINT `sorteio_ibfk_1` FOREIGN KEY (`administrador`) REFERENCES `usuario` (`documento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
