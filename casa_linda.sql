-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 01/06/2022 às 19:18
-- Versão do servidor: 10.4.21-MariaDB
-- Versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `casa_linda`
--
CREATE DATABASE IF NOT EXISTS `casa_linda` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `casa_linda`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Movements`
--

CREATE TABLE `Movements` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL,
  `id_product` int(11) NOT NULL,
  `type` enum('Entrada','Saída') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gatilhos `Movements`
--
DELIMITER $$
CREATE TRIGGER `update_product_amount` AFTER INSERT ON `Movements` FOR EACH ROW IF NEW.type = 'Entrada' THEN
	UPDATE ProductAmount SET amount = (amount + NEW.amount) WHERE id_product = NEW.id_product;
ELSE
	UPDATE ProductAmount SET amount = (amount - NEW.amount) WHERE id_product = NEW.id_product; 
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ProductAmount`
--

CREATE TABLE `ProductAmount` (
  `id_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `ProductAmount`
--

INSERT INTO `ProductAmount` (`id_product`, `amount`) VALUES
(4, 0),
(6, 0),
(7, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Products`
--

CREATE TABLE `Products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `Products`
--

INSERT INTO `Products` (`id`, `name`, `description`, `category`, `image`) VALUES
(4, 'Pipoquinha', 'Pipipipipipopopopoca', 'Banheiro', NULL),
(6, 'Bicicleta', 'Bicicleta Description', 'Sala', ''),
(7, 'Pica de Madeira', 'Uma majestosa Pica de Madeira', 'Sala', '');

--
-- Gatilhos `Products`
--
DELIMITER $$
CREATE TRIGGER `create_product_on_productamount` AFTER INSERT ON `Products` FOR EACH ROW INSERT INTO ProductAmount (id_product) VALUES(NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `Users`
--

INSERT INTO `Users` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'Administrador', 'joaoroberto.gc.01@gmail.com', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Movements`
--
ALTER TABLE `Movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movement_id_product` (`id_product`);

--
-- Índices de tabela `ProductAmount`
--
ALTER TABLE `ProductAmount`
  ADD KEY `fk_id_product` (`id_product`);

--
-- Índices de tabela `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Movements`
--
ALTER TABLE `Movements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `Products`
--
ALTER TABLE `Products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Movements`
--
ALTER TABLE `Movements`
  ADD CONSTRAINT `fk_movement_id_product` FOREIGN KEY (`id_product`) REFERENCES `Products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `ProductAmount`
--
ALTER TABLE `ProductAmount`
  ADD CONSTRAINT `fk_id_product` FOREIGN KEY (`id_product`) REFERENCES `Products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
