-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tempo de Geração: 05/11/2015 às 15:23
-- Versão do servidor: 5.1.73-cll
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Fazendo dump de dados para tabela `ponto_interesse`
--

INSERT INTO `ponto_interesse` (`id_ponto`, `nome`, `bairro`, `rua`, `num`, `cep`, `telefone`, `hr_inicio`, `hr_fecha`, `categoria`, `latitude`, `longitude`, `fk_id_usuario`) VALUES
(23, 'Ciclo Shazan', 'Porto Novo', 'Avenida JosÃ© Herculano', 5684, '11668-60', '12 3887-279', '08:00:00', '18:00:00', 'BC', -23.6844425628824, -45.4396895138278, NULL),
(24, 'Auto Posto Tarley', 'Jardim BritÃ¢nia', 'Dilson N Funaro', 235, '11660-00', '12 3888-3545', '08:00:00', '21:00:00', 'PG', -23.6610040975745, -45.4347728465382, NULL),
(25, 'Farol GÃ¡s Station', 'Jardim Primavera', 'Av Miguel Varlez', 182, '11660-65', '12 3882-3153', '08:00:00', '22:00:00', 'PG', -23.6240425844188, -45.4153887252832, NULL),
(26, 'Bicicletaria Ciclo Norte', 'Rio do Ouro', 'Rua Francisco Ribeiro', 344, '11675-69', '12 3883-5443', '08:00:00', '18:00:00', 'BC', -23.6107946535129, -45.424185111149, NULL),
(27, 'Auto Posto Praia Flecheira', 'Praia Palmeiras', 'Av Gaspar de Souza', 450, '11666-25', '12 3887-9925', '08:00:00', '22:00:00', 'PG', -23.6659807070341, -45.435713257853, NULL),
(28, 'Auto Posto Joti', 'Jaraguazinho', 'Av Presidente Campos Salles', 450, '11672-14', '12 3882-5121', '07:00:00', '23:00:00', 'PG', -23.6193553472558, -45.43003484299, NULL),
(29, 'J. Bike', 'IndaiÃ¡', 'Avenida Rio Branco', 1187, '11665-60', '12 3887-1010', '09:00:00', '18:00:00', 'BC', -23.6332679712811, -45.4276172615932, NULL),
(30, 'Auto Posto Praia Center', 'Centro', 'Av Arthur Costa Filho', 841, '11660-00', '12 3883-1900', '08:00:00', '20:00:00', 'PG', -23.624509041067, -45.4109059163024, NULL),
(31, 'Auto Posto Asa Delta', 'Pontal Santa Marina', 'Benedito Roque dos Santos Filho', 34, '11672-14', '12 3887-2240', '08:00:00', '22:00:00', 'PG', -23.6604715892592, -45.4354111400761, NULL),
(32, 'Auto Posto Frango Japa', 'IndaiÃ¡', 'MassaguaÃ§u', 185, '11665-55', '12 3884-2504', '08:00:00', '22:00:00', 'PG', -23.5987527819577, -45.3442583867004, NULL),
(33, 'J. Bike', 'Jardim Primavera', 'Avenida Miguel Varlez', 281, '11660-65', '12 3822-2989', '08:00:00', '18:00:00', 'BC', -23.6243092809418, -45.416200615487, NULL),
(34, 'Auto Posto Mareli', 'Centro', 'Altino Arantes', 586, '11660-02', '12 3882-1153', '08:00:00', '22:00:00', 'PG', -23.62108980663, -45.4086740271505, NULL),
(35, 'Posto Okapi', 'SumarÃ©', 'Av Presidente Castelo Branco', 614, '11661-30', '12 3882-2306', '08:00:00', '22:00:00', 'PG', -23.619073122308, -45.4010461159637, NULL),
(36, 'Ciclogiro', 'SumarÃ©', 'Avenida Presidente Castelo Branco', 615, '11667-00', '12-3883-4553', '08:00:00', '18:00:00', 'BC', -23.618767, -45.400971, NULL),
(37, 'Oseias Bike', 'Porto Novo', 'Avenida JosÃ© Herculano', 5995, '11668-60', '12-3887-6391', '08:00:00', '18:00:00', 'BC', -23.6869196876044, -45.4404743468301, NULL),
(38, 'Na Trilha Bike', 'TravessÃ£o', 'Avenida JosÃ© Herculano', 7025, '11668-60', '12 3887-8153', '08:00:00', '18:00:00', 'BC', -23.6943701186021, -45.4416028090598, NULL);

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
  `fk_id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sinal`),
  KEY `fk_sinalizacao_usuario_id` (`fk_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `tipo_usuario`, `usuario_ativo`, `foto`) VALUES
(1, 'adminvb', 'adminvb', 'd7bbcbafd82ad717cda09fb58d06a7173dc197b5', 'a', 0, 'nouser.png'),
(10, 'William de Melo Lima', 'william@hexadc.com.br', 'c5d7b16aee0a32764dcc79ce64f18dcd9a79ea06', 'u', 0, 'nouser.png'),
(11, 'Marquinhos Crazy Dog', 'Marcos@marcos.com', 'dfadc855249b015fd2bb015c0b099b2189c58748', 'u', 0, 'nouser.png'),
(12, 'Marquinhos Crazy Dog', 'Marcos@marcos.com', 'dfadc855249b015fd2bb015c0b099b2189c58748', 'u', 0, 'nouser.png'),
(13, 'Marquinhos Crazy Dog', 'Marcos@marcos.com', 'dfadc855249b015fd2bb015c0b099b2189c58748', 'u', 0, 'nouser.png'),
(15, 'Lucas Perrotta Barbosa', 'perrotta.lucas@gmail.com', '8105b5252c4f2e9d1ddd2674686252c7784671c4', 'u', 0, 'nouser.png'),
(16, 'Haryel', 'haryel@user.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'u', 0, 'nouser.png'),
(17, 'LUCAS MARQUES DE OLIVEIRA', 'lukkeemarxs@gmail.com', '12dea96fec20593566ab75692c9949596833adc9', 'u', 0, 'nouser.png'),
(18, 'Lucas Marques', 'lucas@user.com', '12dea96fec20593566ab75692c9949596833adc9', 'u', 0, 'nouser.png'),
(19, 'Lucas Marques de Oliveira', 'Lucas_marques@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'u', 0, 'nouser.png'),
(20, 'will', 'will@will.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'u', 1, 'nouser.png'),
(21, 'Renan', 'renancavichi@ifsp.com', '601f1889667efaebb33b8c12572835da3f027f78', 'u', 0, '86fa414993b9de3bf4d3415c87a7ed32.jpg');

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
