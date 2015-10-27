-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Out-2015 às 19:49
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `mapa`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ponto_interesse`
--

INSERT INTO `ponto_interesse` (`id_ponto`, `nome`, `bairro`, `rua`, `num`, `cep`, `telefone`, `hr_inicio`, `hr_fecha`, `categoria`, `latitude`, `longitude`, `fk_id_usuario`) VALUES
(20, 'Ponto', 'Ponto', 'Ponto', 100, '00000-00', '00-0000-0000', '00:00:00', '00:00:00', 'BC', -23.62838187270207, -45.42247160157467, NULL),
(21, 'Ponto 2', 'Ponto', 'Ponto', 101, '11111-11', '11-1111-1111', '11:11:00', '11:11:00', 'PG', -23.62614075566465, -45.42852266511227, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sinalizacao`
--

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

CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `senha` char(40) DEFAULT NULL,
  `tipo_usuario` char(1) DEFAULT NULL,
  `usuario_ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `tipo_usuario`, `usuario_ativo`) VALUES
(1, 'adminvb', 'adminvb', 'd7bbcbafd82ad717cda09fb58d06a7173dc197b5', 'a', 0);

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
MODIFY `id_ponto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `sinalizacao`
--
ALTER TABLE `sinalizacao`
MODIFY `id_sinal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
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
