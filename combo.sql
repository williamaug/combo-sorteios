-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 09:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `combo`
--

-- --------------------------------------------------------

--
-- Table structure for table `inscricao`
--

CREATE TABLE `inscricao` (
  `id_inscricao` int(10) UNSIGNED NOT NULL,
  `id_sorteio` int(10) UNSIGNED NOT NULL,
  `documento_participante` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sorteio`
--

CREATE TABLE `sorteio` (
  `id_sorteio` int(10) UNSIGNED NOT NULL,
  `nome_sorteio` varchar(255) NOT NULL,
  `maximo_participantes` int(10) UNSIGNED DEFAULT NULL,
  `restricao_maioridade` bit(1) DEFAULT NULL,
  `administrador` varchar(18) NOT NULL,
  `data` date NOT NULL,
  `contato` varchar(255) DEFAULT NULL,
  `formato` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `nome_usuario` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `documento` varchar(18) NOT NULL,
  `senha` char(60) NOT NULL,
  `maioridade` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`id_inscricao`),
  ADD KEY `id_sorteio` (`id_sorteio`),
  ADD KEY `documento_participante` (`documento_participante`);

--
-- Indexes for table `sorteio`
--
ALTER TABLE `sorteio`
  ADD PRIMARY KEY (`id_sorteio`),
  ADD KEY `administrador` (`administrador`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`documento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `id_inscricao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sorteio`
--
ALTER TABLE `sorteio`
  MODIFY `id_sorteio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`id_sorteio`) REFERENCES `sorteio` (`id_sorteio`),
  ADD CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`documento_participante`) REFERENCES `usuario` (`documento`);

--
-- Constraints for table `sorteio`
--
ALTER TABLE `sorteio`
  ADD CONSTRAINT `sorteio_ibfk_1` FOREIGN KEY (`administrador`) REFERENCES `usuario` (`documento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
