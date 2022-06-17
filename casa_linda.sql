-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 17/06/2022 às 21:23
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `Movements`
--

CREATE TABLE IF NOT EXISTS `Movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` int(11) NOT NULL,
  `price` float NOT NULL,
  `id_product` int(11) NOT NULL,
  `type` enum('Entrada','Saída') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_movement_id_product` (`id_product`)
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

CREATE TABLE IF NOT EXISTS `ProductAmount` (
  `id_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  KEY `fk_id_product` (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` tinytext NOT NULL,
  `price_in` double NOT NULL DEFAULT 0,
  `price_out` double NOT NULL DEFAULT 0,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `Users`
--

INSERT INTO `Users` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'Administrador', 'jmsistemas2018@gmail.com', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

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
