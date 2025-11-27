-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/11/2025 às 22:41
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sus`
--
CREATE DATABASE IF NOT EXISTS `sus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sus`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `cpf` char(11) NOT NULL,
  `susnum` char(15) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nasc` date NOT NULL,
  `senha` varchar(8) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`cpf`, `susnum`, `nome`, `nasc`, `senha`, `email`) VALUES
('', '', '', '0000-00-00', '', ''),
('09612746893', '123456789', 'Mauri de Souza', '1969-12-22', '12', 'f@etec22'),
('12222', '111111', 'clara', '1111-11-11', '11', 'clara@etec11'),
('123', '123', 'clara', '3333-03-13', '12', 'clara@etec3'),
('123445', '12344444', 'maria C', '2009-03-02', '12', 'f@etec'),
('12345678910', '123456', 'clara', '1111-10-10', '12', 'f@etec11'),
('41560020806', '0000000000000', 'maria', '2008-12-09', '123', 'clara@etec'),
('999333333', '123', 'f', '0000-00-00', '12', 'abc@etec');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
