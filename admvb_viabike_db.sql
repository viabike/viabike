-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Versão do servidor: 5.6.28
-- Versão do PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `admvb_viabike_db`
--
CREATE DATABASE IF NOT EXISTS `admvb_viabike_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `admvb_viabike_db`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mapa`
--

DROP TABLE IF EXISTS `mapa`;
CREATE TABLE IF NOT EXISTS `mapa` (
  `id_mapa` int(11) NOT NULL AUTO_INCREMENT,
  `kml` varchar(45) DEFAULT NULL,
  `data_envio` date DEFAULT NULL,
  `versao_kml` char(4) DEFAULT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mapa`),
  KEY `fk_mapa_usuario` (`fk_id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `mapa`
--

INSERT INTO `mapa` (`id_mapa`, `kml`, `data_envio`, `versao_kml`, `fk_id_usuario`) VALUES
(1, 'mapa-das-ciclovias-v2.kml', '2015-08-11', '0002', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ponto_interesse`
--

DROP TABLE IF EXISTS `ponto_interesse`;
CREATE TABLE IF NOT EXISTS `ponto_interesse` (
  `id_ponto` int(11) NOT NULL AUTO_INCREMENT,
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
  `fk_id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ponto`),
  KEY `fk_ponto_interesse_usuario` (`fk_id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Fazendo dump de dados para tabela `ponto_interesse`
--

INSERT INTO `ponto_interesse` (`id_ponto`, `nome`, `bairro`, `rua`, `num`, `cep`, `telefone`, `hr_inicio`, `hr_fecha`, `categoria`, `latitude`, `longitude`, `fk_id_usuario`) VALUES
(23, 'Ciclo Shazan', 'Porto Novo', 'Avenida JosÃ© Herculano', 5684, '11673-04', '12 3887-279', '08:00:00', '18:00:00', 'BC', -23.6844425628824, -45.4396895138278, NULL),
(24, 'Auto Posto Tarley', 'Jardim BritÃ¢nia', 'Dilson N Funaro', 235, '11660-00', '12 3888-3545', '08:00:00', '21:00:00', 'PG', -23.6610040975745, -45.434772846538195, NULL),
(25, 'Farol GÃ¡s Station', 'Jardim Primavera', 'Av Miguel Varlez', 182, '11660-65', '12 3882-3153', '08:00:00', '22:00:00', 'PG', -23.6240425844188, -45.4153887252832, NULL),
(26, 'Bicicletaria Ciclo Norte', 'Rio do Ouro', 'Rua Francisco Ribeiro', 344, '11675-69', '12 3883-5443', '08:00:00', '18:00:00', 'BC', -23.6107946535129, -45.424185111148994, NULL),
(27, 'Auto Posto Praia Flecheira', 'Praia Palmeiras', 'Av Gaspar de Souza', 450, '11666-25', '12 3887-9925', '08:00:00', '22:00:00', 'PG', -23.665980707034098, -45.435713257853, NULL),
(28, 'Auto Posto Joti', 'Jaraguazinho', 'Av Presidente Campos Salles', 450, '11672-14', '12 3882-5121', '07:00:00', '23:00:00', 'PG', -23.6193553472558, -45.430034842990004, NULL),
(29, 'J. Bike', 'IndaiÃ¡', 'Avenida Rio Branco', 1187, '11665-60', '12 3887-1010', '09:00:00', '18:00:00', 'BC', -23.6332679712811, -45.4276172615932, NULL),
(30, 'Auto Posto Praia Center', 'Centro', 'Av Arthur Costa Filho', 841, '11660-00', '12 3883-1900', '08:00:00', '20:00:00', 'PG', -23.624509041067, -45.410905916302404, NULL),
(31, 'Auto Posto Asa Delta', 'Pontal Santa Marina', 'Benedito Roque dos Santos Filho', 34, '11672-14', '12 3887-2240', '08:00:00', '22:00:00', 'PG', -23.6604715892592, -45.4354111400761, NULL),
(32, 'Auto Posto Frango Japa', 'IndaiÃ¡', 'MassaguaÃ§u', 185, '11665-55', '12 3884-2504', '08:00:00', '22:00:00', 'PG', -23.598752781957696, -45.3442583867004, NULL),
(33, 'J. Bike', 'Jardim Primavera', 'Avenida Miguel Varlez', 281, '11660-65', '12 3822-2989', '08:00:00', '18:00:00', 'BC', -23.6243092809418, -45.416200615487, NULL),
(34, 'Auto Posto Mareli', 'Centro', 'Altino Arantes', 586, '11660-02', '12 3882-1153', '08:00:00', '22:00:00', 'PG', -23.621089806630003, -45.4086740271505, NULL),
(35, 'Posto Okapi', 'SumarÃ©', 'Av Presidente Castelo Branco', 614, '11661-30', '12 3882-2306', '08:00:00', '22:00:00', 'PG', -23.619073122308, -45.4010461159637, NULL),
(36, 'Ciclogiro', 'SumarÃ©', 'Avenida Presidente Castelo Branco', 615, '11667-00', '12-3883-4553', '08:00:00', '18:00:00', 'BC', -23.618767, -45.400971, NULL),
(37, 'Oseias Bike', 'Porto Novo', 'Avenida JosÃ© Herculano', 5995, '11668-60', '12-3887-6391', '08:00:00', '18:00:00', 'BC', -23.6869196876044, -45.4404743468301, NULL),
(38, 'Na Trilha Bike', 'TravessÃ£o', 'Avenida JosÃ© Herculano', 7025, '11668-60', '12 3887-8153', '08:00:00', '18:00:00', 'BC', -23.6943701186021, -45.4416028090598, NULL),
(39, 'Auto Posto Rota do Sol', 'IndaiÃ¡', 'Avenida Rio Branco', 383, '11674-21', '12-3882-1395', '00:00:00', '00:00:00', 'PG', -23.6255415450684, -45.4246975820779, NULL),
(40, 'Auto Posto Shell', 'IndaiÃ¡', 'Avenida Rio Branco', 383, '11665-60', '000000000000', '00:00:00', '00:00:00', 'PG', -23.6265614746958, -45.4240805293167, NULL),
(41, 'Auto Posto Petrobras', 'IndaiÃ¡', 'Avenida Rio Branco', 1435, '11667-00', '12-3887-1970', '00:00:00', '00:00:00', 'PG', -23.6349559245464, -45.4284214341225, NULL),
(42, 'PrÃ³ Bike', 'IndaiÃ¡', 'Avenida Rio Branco', 1524, '11667-00', '12-3883-2083', '08:00:00', '18:00:00', 'BC', -23.63580688547605, -45.4291938516169, NULL),
(43, 'Auto Posto Aguia do Litoral', 'Jaraguazinho', 'Avenida Rio Branco', 265, '11675-05', '12-3882-3725', '00:00:00', '00:00:00', 'PG', -23.63984094442617, -45.43116354019924, NULL),
(44, 'Centro Automotivo BP', 'Porto Novo', 'Avenida Jose Herculano', 5437, '11667-00', '12-3912-5939', '00:00:00', '00:00:00', 'PG', -23.682364052127745, -45.43900264613285, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sinalizacao`
--

DROP TABLE IF EXISTS `sinalizacao`;
CREATE TABLE IF NOT EXISTS `sinalizacao` (
  `id_sinal` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descricao` text,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `categoria` char(2) DEFAULT NULL,
  `data_public` date NOT NULL,
  `fk_id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sinal`),
  KEY `fk_sinalizacao_usuario_id` (`fk_id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;


--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `senha` char(40) DEFAULT NULL,
  `tipo_usuario` char(1) DEFAULT NULL,
  `usuario_ativo` tinyint(1) NOT NULL,
  `foto` varchar(40) NOT NULL DEFAULT 'nouser.png',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `mapa`
--
ALTER TABLE `mapa`
  ADD CONSTRAINT `fk_mapa_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `ponto_interesse`
--
ALTER TABLE `ponto_interesse`
  ADD CONSTRAINT `fk_ponto_interesse_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `sinalizacao`
--
ALTER TABLE `sinalizacao`
  ADD CONSTRAINT `fk_sinalizacao_usuario_id` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
