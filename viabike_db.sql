-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Set-2015 às 22:00
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `viabike_db`
--
CREATE DATABASE IF NOT EXISTS `viabike_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `viabike_db`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mapa`
--

DROP TABLE IF EXISTS `mapa`;
CREATE TABLE IF NOT EXISTS `mapa` (
`id_mapa` int(11) NOT NULL,
  `kml` varchar(45) DEFAULT NULL,
  `data_envio` date DEFAULT NULL,
  `versao_kml` char(4) DEFAULT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ponto_interesse`
--

DROP TABLE IF EXISTS `ponto_interesse`;
CREATE TABLE IF NOT EXISTS `ponto_interesse` (
`id_ponto` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `rua` varchar(45) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `cep` char(8) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `hr_inicio` time DEFAULT NULL,
  `hr_fecha` time DEFAULT NULL,
  `categoria` char(2) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sinalizacao`
--

DROP TABLE IF EXISTS `sinalizacao`;
CREATE TABLE IF NOT EXISTS `sinalizacao` (
`id_sinal` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descricao` text,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `categoria` char(2) DEFAULT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `senha` char(40) DEFAULT NULL,
  `tipo_usuario` char(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `sobrenome`, `username`, `senha`, `tipo_usuario`) VALUES
(1, 'adminvb', 'adminvb', 'adminvb', 'd7bbcbafd82ad717cda09fb58d06a7173dc197b5', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mapa`
--
ALTER TABLE `mapa`
 ADD PRIMARY KEY (`id_mapa`), ADD KEY `fk_mapa_usuario` (`fk_id_usuario`);

--
-- Indexes for table `ponto_interesse`
--
ALTER TABLE `ponto_interesse`
 ADD PRIMARY KEY (`id_ponto`), ADD KEY `fk_ponto_interesse_usuario` (`fk_id_usuario`);

--
-- Indexes for table `sinalizacao`
--
ALTER TABLE `sinalizacao`
 ADD PRIMARY KEY (`id_sinal`), ADD KEY `fk_sinalizacao_usuario_id` (`fk_id_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mapa`
--
ALTER TABLE `mapa`
MODIFY `id_mapa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ponto_interesse`
--
ALTER TABLE `ponto_interesse`
MODIFY `id_ponto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `sinalizacao`
--
ALTER TABLE `sinalizacao`
MODIFY `id_sinal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `mapa`
--
ALTER TABLE `mapa`
ADD CONSTRAINT `fk_mapa_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `ponto_interesse`
--
ALTER TABLE `ponto_interesse`
ADD CONSTRAINT `fk_ponto_interesse_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `sinalizacao`
--
ALTER TABLE `sinalizacao`
ADD CONSTRAINT `fk_sinalizacao_usuario_id` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
