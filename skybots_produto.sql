-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 24-Jan-2019 às 23:38
-- Versão do servidor: 5.5.61-cll
-- versão do PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skybots_produto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `codigo_cliente` bigint(20) NOT NULL,
  `cpf_cliente` varchar(11) DEFAULT NULL,
  `nome_cliente` varchar(400) NOT NULL,
  `email_cliente` varchar(400) DEFAULT NULL,
  `id_facebook_cliente` varchar(400) NOT NULL,
  `telefone_cliente` varchar(11) NOT NULL,
  `cep_cliente` varchar(10) DEFAULT NULL,
  `endereco_cliente` varchar(400) NOT NULL,
  `complemento_endereco_cliente` varchar(400) DEFAULT NULL,
  `cidade_cliente` bigint(20) NOT NULL,
  `uf_cliente` varchar(2) NOT NULL COMMENT 'MT - Mato Grosso, MS - Mato Grosso do Sul, DF - Distrito Federal, GO - Goiânia...',
  `sexo_cliente` varchar(1) DEFAULT NULL COMMENT 'F - Feminino, M - Masculino',
  `referencia_endereco_cliente` varchar(400) DEFAULT NULL,
  `empresa_cliente` bigint(20) NOT NULL,
  `bairro_cliente` bigint(20) NOT NULL,
  `ativo_cliente` tinyint(4) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 - nao ativo, 1 - sim ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`codigo_cliente`, `cpf_cliente`, `nome_cliente`, `email_cliente`, `id_facebook_cliente`, `telefone_cliente`, `cep_cliente`, `endereco_cliente`, `complemento_endereco_cliente`, `cidade_cliente`, `uf_cliente`, `sexo_cliente`, `referencia_endereco_cliente`, `empresa_cliente`, `bairro_cliente`, `ativo_cliente`) VALUES
(1, NULL, 'Sayuri Arake Joazeiro', NULL, '1629902203729414', '16164646464', '78056606', 'iasidhaosguoas', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.5625495%252C%2B-56.0321178%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATPw_bCYvk1bXs9a16P6QzeIht3coDUE1gLT2InrqgB5KKe4gQxO3eCI4bT5TdVtoYBHF3HfPGYICkkNADds74ZZvLyuo1dLec4oWjIvngwjYKanCw&s=1&enc=AZMog3Na_aS4UiVGR334buuV1rEh4qtzo1CScUqHN3tGonrQ2QjBMkwJC50ATEgRJ6JntG-NXWISJEOMjE9Nwhf8', 1, 'MT', 'F', '', 1, 3, 1),
(2, NULL, 'Alexandre Tomasi', NULL, '1407907162662679', '45646456456', '78056606', 'sanfkosd', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.5626437%252C%2B-56.0510741%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATOlBlKxGFZLCUjeQvOwc9jnExFJwI_MQYkEzcQBQjugoZ92vUpJTsoBE88Rbxc9fp7yPXF3_aRnDIrP0fjyyynaahM6O9CSLu5YXt7SDt96u6AE7w&s=1&enc=AZOWpXHYVjg_zqVQFpI3LKIiqncdZvAR12dP6J9W-lS4n8dQdfqq54jUgwx3dKGlPFfI47HijQoeAErfGTjbDa9w', 1, 'MT', 'M', '', 1, 1, 1),
(3, NULL, 'Gustavo Lima Franco', NULL, '1747460208612046', '65999898645', '78010-500', 'Av Miguel Sutil, 3271', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3DAv.%2BMiguel%2BSutil%252C%2B3271%252C%2B78015%2BCuiab%25C3%25A1%252C%2BBrazil%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNWgBryezeJkgY8CrZRFAwIhuctx90nt3AxO_rVTpe1quhjLqY4p75zC9C5lg2yZgMVo35edWeU9QIAhowti-17ZZZCTBSejRNA4mXKBVqa8HRhPw&s=1&enc=AZMxxP9W3FI2JOvDVkVo6s5R9iJ5D1bTiWgZDoVjr', 1, 'MT', 'M', '', 1, 89, 1),
(4, NULL, 'Alexandre Tomasi', NULL, '1333648083413071', '35465468468', '78050-923', 'dfgfh', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.573033%252C%2B-56.073012%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNHKEdZcx5Kd1L1kjxsAay2nJ7UeyGwSWjtKwJX-dnL5skv8rTFlcluw-whbvqFZ0TeDFMqVaOzTr7RSRAU-t6Eo7l-fwi76Vk05rdBgtIrCQ-v8Q&s=1&enc=AZPNDPp60TrhCjrx45YyEGZr_--2H3DgR4R6y_Zst7kuNww1vd1KPBVCYZ5nR8melYmJNFW-1pBGk1E3Z3mfdchh', 1, 'MT', 'M', '', 1, 4, 1),
(5, NULL, 'Marcela Silvério', NULL, '1656825574366887', '992537026', '78000000', 'Rua M Qd 67 Casa 01', '', 1, 'MT', 'F', '', 1, 152, 1),
(6, NULL, 'Gisely Santiago', NULL, '1651877814934845', '999375058', '78000000', 'Avenida Miguel sutil, número 3271', '', 1, 'MT', 'F', '', 1, 89, 1),
(10, NULL, 'Viviane Santos', NULL, '1833463506780484', '999998888', '78000000', 'teste  3271', '', 1, 'MT', 'F', '', 1, 89, 1),
(11, NULL, 'Evilyn Weimer', NULL, '2400133993338019', '992334473', '78000000', 'Gonçalo Botelho 2004', '', 2, 'MT', 'F', '', 2, 281, 1),
(12, NULL, 'Gustavo Lima Franco', NULL, '1823903187731415', '65999898645', '78000000', 'Av Miguel sutil 3271', '', 1, 'MT', 'M', '', 2, 11, 1),
(13, NULL, 'Alexandre Tomasi', NULL, '2684546591571132', '343453534', '78000000', 'casa verde', '', 2, 'MT', 'M', '', 2, 309, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracao`
--

CREATE TABLE `configuracao` (
  `codigo_configuracao` bigint(20) NOT NULL,
  `descricao_configuracao` varchar(400) DEFAULT NULL COMMENT 'descricao tipo bot_id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `configuracao`
--

INSERT INTO `configuracao` (`codigo_configuracao`, `descricao_configuracao`) VALUES
(1, 'tipo_formato_de_impressao'),
(2, 'tempo_entrega_empresa'),
(3, 'primeiros_passos_empresa'),
(4, 'permissao_envio_email'),
(5, 'permissao_envio_sms');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `codigo_empresa` bigint(20) NOT NULL,
  `cnpj_empresa` varchar(14) NOT NULL,
  `razao_social_empresa` varchar(400) NOT NULL,
  `nome_fantasia_empresa` varchar(400) NOT NULL,
  `email_empresa` varchar(400) NOT NULL,
  `perfil_facebook_empresa` varchar(400) NOT NULL,
  `telefone_empresa` varchar(11) NOT NULL,
  `celular_whats_empresa` bigint(12) DEFAULT NULL COMMENT 'celular que tem whatsApp',
  `celular_empresa` bigint(12) DEFAULT NULL COMMENT 'celular para receber ligações',
  `cep_empresa` varchar(10) NOT NULL,
  `endereco_empresa` varchar(400) NOT NULL,
  `numero_endereco_empresa` bigint(20) UNSIGNED NOT NULL,
  `complemento_endereco_empresa` varchar(400) DEFAULT NULL,
  `cidade_empresa` bigint(20) NOT NULL,
  `uf_empresa` varchar(2) NOT NULL,
  `token_facebook_empresa` varchar(400) NOT NULL,
  `data_hora_inclusao_empresa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bairro_empresa` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`codigo_empresa`, `cnpj_empresa`, `razao_social_empresa`, `nome_fantasia_empresa`, `email_empresa`, `perfil_facebook_empresa`, `telefone_empresa`, `celular_whats_empresa`, `celular_empresa`, `cep_empresa`, `endereco_empresa`, `numero_endereco_empresa`, `complemento_endereco_empresa`, `cidade_empresa`, `uf_empresa`, `token_facebook_empresa`, `data_hora_inclusao_empresa`, `bairro_empresa`) VALUES
(1, '86604830000143', 'Lanche do metrô', 'Lanche do metrô', 'skybots@skybots.com.br', '12', '25415236584', NULL, 66992217482, '52555555', 'Rua do metro', 20, 'quadra 4', 1, 'MT', '123', '2018-09-25 04:44:56', 1),
(2, '86807484000109', 'STALO COMERCIO GÁS LTDA', 'STALO COMERCIO GÁS LTDA', 'wellitongweimer@gmail.com', 'https://www.facebook.com/Distribuidora-Skybots-316228109136354/', '6536915000', NULL, NULL, '78110798', 'Avenida coronel julião Sérgio Brito - Qd 5, Lt 1 - Jardim Maringa', 1, 'Em frente a praça do parque do lago', 2, 'MT', 'mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD', '2018-09-04 15:57:26', 313);

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `codigo_forma_pagamento` bigint(20) NOT NULL,
  `descricao_forma_pagamento` varchar(400) NOT NULL,
  `empresa_forma_pagamento` bigint(20) NOT NULL,
  `ativo_forma_pagamento` tinyint(4) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 - nao ativo, 1 - sim ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `forma_pagamento`
--

INSERT INTO `forma_pagamento` (`codigo_forma_pagamento`, `descricao_forma_pagamento`, `empresa_forma_pagamento`, `ativo_forma_pagamento`) VALUES
(1, 'Dinheiro', 1, 1),
(2, 'Cartão', 1, 1),
(3, 'Alelo refeição', 1, 1),
(4, 'Sodexo refeição', 1, 1),
(5, 'novo', 1, 0),
(6, 'Dinheiro', 2, 1),
(7, 'Cartão de Débito', 2, 1),
(8, 'Cartão de Crédito', 2, 1),
(9, 'Vale Gás', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario_atendimento`
--

CREATE TABLE `horario_atendimento` (
  `codigo_horario_atendimento` bigint(20) NOT NULL,
  `dia_semana_horario_atendimento` tinyint(4) UNSIGNED NOT NULL COMMENT '1 - segunda2 - terça3 - quarta4 - quinta5 - sexta6 - sábado7 - domingo',
  `inicio_horario_atendimento` time NOT NULL,
  `fim_horario_atendimento` time NOT NULL,
  `empresa_horario_atendimento` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `horario_atendimento`
--

INSERT INTO `horario_atendimento` (`codigo_horario_atendimento`, `dia_semana_horario_atendimento`, `inicio_horario_atendimento`, `fim_horario_atendimento`, `empresa_horario_atendimento`) VALUES
(1, 1, '00:00:00', '23:59:00', 1),
(2, 2, '00:00:00', '23:59:59', 1),
(3, 3, '00:00:00', '23:59:59', 1),
(4, 4, '00:00:00', '23:59:59', 1),
(5, 5, '00:00:00', '23:59:59', 1),
(6, 6, '00:00:00', '23:59:59', 1),
(7, 7, '00:00:00', '23:59:59', 1),
(8, 1, '07:00:00', '19:00:00', 2),
(9, 2, '07:00:00', '19:00:00', 2),
(10, 3, '07:00:00', '19:00:00', 2),
(11, 4, '07:00:00', '19:00:00', 2),
(12, 5, '07:00:00', '19:00:00', 2),
(13, 6, '07:00:00', '19:00:00', 2),
(14, 7, '08:00:00', '12:00:00', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario_especial`
--

CREATE TABLE `horario_especial` (
  `codigo_horario_especial` bigint(20) NOT NULL,
  `data_horario_especial` datetime NOT NULL,
  `inicio_horario_especial` time DEFAULT NULL,
  `fim_horario_especial` time DEFAULT NULL,
  `empresa_horario_especial` bigint(20) NOT NULL,
  `aberto_horario_especial` tinyint(2) UNSIGNED DEFAULT '0' COMMENT '0 - fechado, 1 - aberto, 2 pausado',
  `ativo_horario_especial` tinyint(4) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 - nao ativo, 1 - sim ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `horario_especial`
--

INSERT INTO `horario_especial` (`codigo_horario_especial`, `data_horario_especial`, `inicio_horario_especial`, `fim_horario_especial`, `empresa_horario_especial`, `aberto_horario_especial`, `ativo_horario_especial`) VALUES
(1, '2017-10-03 00:00:00', '18:00:00', '20:20:00', 1, 1, 0),
(2, '2017-10-03 00:00:00', '10:00:00', '20:00:00', 1, 1, 1),
(3, '2018-08-23 00:00:00', '22:48:14', '22:58:14', 1, 2, 1),
(4, '2018-08-24 00:00:00', '01:06:51', '01:14:51', 1, 2, 0),
(5, '2018-08-24 00:00:00', '10:31:04', '11:31:04', 1, 2, 0),
(6, '2018-09-07 00:00:00', '08:00:00', '12:00:00', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_pedido`
--

CREATE TABLE `item_pedido` (
  `codigo_item_pedido` bigint(20) NOT NULL,
  `quantidade_item_pedido` decimal(10,2) UNSIGNED NOT NULL DEFAULT '1.00',
  `valor_subtotal_item_pedido` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `pedido_item_pedido` bigint(20) NOT NULL,
  `produto_item_pedido` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_pedido`
--

INSERT INTO `item_pedido` (`codigo_item_pedido`, `quantidade_item_pedido`, `valor_subtotal_item_pedido`, `pedido_item_pedido`, `produto_item_pedido`) VALUES
(1, '3.00', '18.00', 1, 2),
(2, '1.00', '8.00', 1, 10),
(3, '1.00', '10.00', 1, NULL),
(4, '2.00', '14.00', 2, 6),
(5, '1.00', '4.00', 2, 11),
(6, '1.00', '10.00', 2, NULL),
(7, '3.00', '18.00', 3, 2),
(8, '1.00', '10.00', 3, NULL),
(9, '1.00', '5.00', 4, 18),
(10, '1.00', '6.00', 4, 2),
(11, '9.00', '72.00', 4, 10),
(12, '1.00', '6.00', 4, 3),
(13, '2.00', '13.00', 4, 5),
(14, '1.00', '7.00', 4, 6),
(15, '2.00', '10.00', 4, 19),
(16, '3.00', '22.50', 4, 8),
(17, '3.00', '12.00', 4, 11),
(18, '8.00', '64.00', 4, 13),
(19, '1.00', '5.00', 4, NULL),
(20, '1.00', '6.00', 5, 2),
(21, '1.00', '5.00', 5, 18),
(22, '1.00', '5.00', 5, NULL),
(23, '2.00', '12.00', 6, 3),
(24, '1.00', '10.00', 6, NULL),
(25, '8.00', '56.00', 7, 6),
(26, '10.00', '80.00', 7, 13),
(27, '1.00', '10.00', 7, NULL),
(28, '3.00', '18.00', 8, 3),
(29, '2.00', '16.00', 8, 10),
(30, '3.00', '19.50', 8, 4),
(31, '4.00', '26.00', 8, 5),
(32, '3.00', '21.00', 8, 6),
(33, '2.00', '15.00', 8, 8),
(34, '8.00', '64.00', 8, 13),
(35, '3.00', '15.00', 8, 18),
(36, '2.00', '14.00', 8, 7),
(37, '6.00', '30.00', 8, 19),
(38, '1.00', '5.00', 8, NULL),
(39, '3.00', '21.00', 9, 27),
(40, '1.00', '10.00', 9, NULL),
(41, '15.00', '112.50', 10, 8),
(42, '2.00', '190.00', 10, 29),
(43, '1.00', '10.00', 10, NULL),
(44, '2.00', '6.00', 11, 12),
(45, '1.00', '10.00', 11, NULL),
(46, '1.00', '95.00', 12, 29),
(47, '1.00', '10.00', 12, NULL),
(48, '1.00', '95.00', 13, 29),
(49, '1.00', '10.00', 13, NULL),
(50, '1.00', '7.00', 14, 6),
(51, '1.00', '4.00', 14, 11),
(52, '1.00', '10.00', 14, NULL),
(63, '1.00', '100.00', 19, 30),
(64, '1.00', '8.00', 19, 10),
(65, '1.00', '10.00', 19, NULL),
(66, '1.00', '8.00', 20, 10),
(67, '1.00', '10.00', 20, NULL),
(74, '2.00', '12.00', 24, 3),
(75, '1.00', '8.00', 24, 10),
(76, '1.00', '10.00', 24, NULL),
(77, '3.00', '19.50', 25, 4),
(78, '1.00', '10.00', 25, NULL),
(79, '3.00', '18.00', 26, 3),
(80, '1.00', '10.00', 26, NULL),
(81, '3.00', '18.00', 27, 3),
(82, '1.00', '10.00', 27, NULL),
(83, '2.00', '12.00', 28, 3),
(84, '1.00', '10.00', 28, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `codigo_pedido` bigint(20) NOT NULL,
  `data_hora_pedido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cliente_pedido` bigint(20) NOT NULL,
  `valor_total_pedido` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `forma_pagamento_pedido` bigint(20) NOT NULL DEFAULT '0' COMMENT 'fk para forma_pagamento',
  `observacao_pedido` varchar(400) DEFAULT NULL COMMENT 'campo para adicionar observações como, por exemplo: sem azeitona na pizza.',
  `empresa_pedido` bigint(20) NOT NULL,
  `telefone_pedido` varchar(11) NOT NULL,
  `endereco_pedido` varchar(400) NOT NULL,
  `numero_endereco_pedido` bigint(20) UNSIGNED DEFAULT NULL COMMENT '0 - sem número.',
  `complemento_endereco_pedido` varchar(500) DEFAULT NULL,
  `cidade_pedido` bigint(20) NOT NULL,
  `uf_pedido` varchar(2) NOT NULL,
  `referencia_endereco_pedido` varchar(400) DEFAULT NULL,
  `bairro_pedido` bigint(20) NOT NULL,
  `cep_pedido` varchar(10) DEFAULT NULL,
  `mapa_url_pedido` varchar(600) DEFAULT NULL COMMENT 'url que leva posição no mapa do Bing',
  `status_pedido` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 - CANCELADO, 1 - SOLICITADO, 2 - PEDIDO ATENDIDO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`codigo_pedido`, `data_hora_pedido`, `cliente_pedido`, `valor_total_pedido`, `forma_pagamento_pedido`, `observacao_pedido`, `empresa_pedido`, `telefone_pedido`, `endereco_pedido`, `numero_endereco_pedido`, `complemento_endereco_pedido`, `cidade_pedido`, `uf_pedido`, `referencia_endereco_pedido`, `bairro_pedido`, `cep_pedido`, `mapa_url_pedido`, `status_pedido`) VALUES
(1, '2018-04-10 02:03:59', 2, '36.00', 2, ' Observação do cliente: nenhuma obg', 1, '66992299988', 'av brasil, cpa 2 casa 13', NULL, NULL, 1, 'MT', '', 140, '78056606', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.5626437%252C%2B-56.0510741%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATOlBlKxGFZLCUjeQvOwc9jnExFJwI_MQYkEzcQBQjugoZ92vUpJTsoBE88Rbxc9fp7yPXF3_aRnDIrP0fjyyynaahM6O9CSLu5YXt7SDt96u6AE7w&s=1&enc=AZOWpXHYVjg_zqVQFpI3LKIiqncdZvAR12dP6J9W-lS4n8dQdfqq54jUgwx3dKGlPFfI47HijQoeAErfGTjbDa9w', 2),
(2, '2018-04-10 02:03:54', 4, '28.00', 2, ' Observação do cliente: ', 1, '66998596633', 'casa verde', NULL, NULL, 1, 'MT', '', 4, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.573033%252C%2B-56.073012%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNHKEdZcx5Kd1L1kjxsAay2nJ7UeyGwSWjtKwJX-dnL5skv8rTFlcluw-whbvqFZ0TeDFMqVaOzTr7RSRAU-t6Eo7l-fwi76Vk05rdBgtIrCQ-v8Q&s=1&enc=AZPNDPp60TrhCjrx45YyEGZr_--2H3DgR4R6y_Zst7kuNww1vd1KPBVCYZ5nR8melYmJNFW-1pBGk1E3Z3mfdchh', 2),
(3, '2018-04-16 18:48:52', 4, '28.00', 2, ' Observação do cliente: ', 1, '66998596633', 'casa verde', NULL, NULL, 1, 'MT', '', 4, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.573033%252C%2B-56.073012%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNHKEdZcx5Kd1L1kjxsAay2nJ7UeyGwSWjtKwJX-dnL5skv8rTFlcluw-whbvqFZ0TeDFMqVaOzTr7RSRAU-t6Eo7l-fwi76Vk05rdBgtIrCQ-v8Q&s=1&enc=AZPNDPp60TrhCjrx45YyEGZr_--2H3DgR4R6y_Zst7kuNww1vd1KPBVCYZ5nR8melYmJNFW-1pBGk1E3Z3mfdchh', 0),
(4, '2018-05-11 12:51:10', 1, '222.50', 1, 'Levar troco para R$2.  Observação do cliente: ', 1, '65981150626', 'rua gravateiro, 11, cpa 4,  etapa', NULL, NULL, 1, 'MT', '', 3, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.57299%252C%2B-56.072917%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATPL5VIbCiV1gcwq6FlFvSMn-Z_NF1KSzztdxEizsYIwfn4xJvT2PxVhJjPJ_mOuWG6VuTG5d1-0Av5zb2BKYb8wi0m6j0BvDWR62WpHXJ7VrccClw&s=1&enc=AZPLDKyOrusUfKzJcVv3VfjUMZiJPEHkY3LKdTYDqLHP7jmHNSUmrhzIQC4rlSGU_0SoeDYO46JpUAjNaWpy5tta', 0),
(5, '2018-05-11 12:58:29', 1, '16.00', 4, ' Observação do cliente: ', 1, '65981150626', 'rua gravateiro, 11, cpa 4,  etapa', NULL, NULL, 1, 'MT', '', 3, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.57299%252C%2B-56.072917%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATPL5VIbCiV1gcwq6FlFvSMn-Z_NF1KSzztdxEizsYIwfn4xJvT2PxVhJjPJ_mOuWG6VuTG5d1-0Av5zb2BKYb8wi0m6j0BvDWR62WpHXJ7VrccClw&s=1&enc=AZPLDKyOrusUfKzJcVv3VfjUMZiJPEHkY3LKdTYDqLHP7jmHNSUmrhzIQC4rlSGU_0SoeDYO46JpUAjNaWpy5tta', 2),
(6, '2018-05-14 14:49:52', 4, '22.00', 1, 'Levar troco para R$10 reais.  Observação do cliente: ', 1, '66998596633', 'casa verde', NULL, NULL, 1, 'MT', '', 4, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.573033%252C%2B-56.073012%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNHKEdZcx5Kd1L1kjxsAay2nJ7UeyGwSWjtKwJX-dnL5skv8rTFlcluw-whbvqFZ0TeDFMqVaOzTr7RSRAU-t6Eo7l-fwi76Vk05rdBgtIrCQ-v8Q&s=1&enc=AZPNDPp60TrhCjrx45YyEGZr_--2H3DgR4R6y_Zst7kuNww1vd1KPBVCYZ5nR8melYmJNFW-1pBGk1E3Z3mfdchh', 0),
(7, '2018-05-14 14:58:45', 4, '146.00', 1, 'Levar troco para R$150.  Observação do cliente: ', 1, '66998596633', 'casa verde', NULL, NULL, 1, 'MT', '', 4, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.573033%252C%2B-56.073012%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNHKEdZcx5Kd1L1kjxsAay2nJ7UeyGwSWjtKwJX-dnL5skv8rTFlcluw-whbvqFZ0TeDFMqVaOzTr7RSRAU-t6Eo7l-fwi76Vk05rdBgtIrCQ-v8Q&s=1&enc=AZPNDPp60TrhCjrx45YyEGZr_--2H3DgR4R6y_Zst7kuNww1vd1KPBVCYZ5nR8melYmJNFW-1pBGk1E3Z3mfdchh', 2),
(8, '2018-05-16 12:30:21', 1, '243.50', 1, 'Levar troco para R$300.  Observação do cliente: ', 1, '65981150626', 'rua gravateiro, 11, cpa 4,  etapa', NULL, NULL, 1, 'MT', '', 3, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.57299%252C%2B-56.072917%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATPL5VIbCiV1gcwq6FlFvSMn-Z_NF1KSzztdxEizsYIwfn4xJvT2PxVhJjPJ_mOuWG6VuTG5d1-0Av5zb2BKYb8wi0m6j0BvDWR62WpHXJ7VrccClw&s=1&enc=AZPLDKyOrusUfKzJcVv3VfjUMZiJPEHkY3LKdTYDqLHP7jmHNSUmrhzIQC4rlSGU_0SoeDYO46JpUAjNaWpy5tta', 1),
(9, '2018-08-17 00:52:20', 4, '31.00', 2, ' Observação do cliente: ', 1, '66998596633', 'casa verde', NULL, NULL, 1, 'MT', '', 4, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.573033%252C%2B-56.073012%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNHKEdZcx5Kd1L1kjxsAay2nJ7UeyGwSWjtKwJX-dnL5skv8rTFlcluw-whbvqFZ0TeDFMqVaOzTr7RSRAU-t6Eo7l-fwi76Vk05rdBgtIrCQ-v8Q&s=1&enc=AZPNDPp60TrhCjrx45YyEGZr_--2H3DgR4R6y_Zst7kuNww1vd1KPBVCYZ5nR8melYmJNFW-1pBGk1E3Z3mfdchh', 1),
(10, '2018-08-23 23:41:15', 4, '312.50', 2, ' Observação do cliente: ', 1, '66998596633', 'casa verde', NULL, NULL, 1, 'MT', '', 4, '78050-923', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.573033%252C%2B-56.073012%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNHKEdZcx5Kd1L1kjxsAay2nJ7UeyGwSWjtKwJX-dnL5skv8rTFlcluw-whbvqFZ0TeDFMqVaOzTr7RSRAU-t6Eo7l-fwi76Vk05rdBgtIrCQ-v8Q&s=1&enc=AZPNDPp60TrhCjrx45YyEGZr_--2H3DgR4R6y_Zst7kuNww1vd1KPBVCYZ5nR8melYmJNFW-1pBGk1E3Z3mfdchh', 2),
(11, '2018-08-24 01:38:38', 6, '16.00', 1, ' Observação do cliente: ', 1, '999375058', 'Avenida Miguel sutil, número 3271', NULL, NULL, 1, 'MT', '', 89, '78000000', '', 2),
(12, '2018-08-24 01:41:48', 6, '105.00', 1, 'Levar troco para R$150.  Observação do cliente: ', 1, '999375058', 'Avenida Miguel sutil, número 3271', NULL, NULL, 1, 'MT', '', 89, '78000000', '', 0),
(13, '2018-08-24 12:23:17', 3, '105.00', 1, 'Levar troco para R$120.  Observação do cliente: ', 1, '999898645', 'A. Miguel sutil, 3271', NULL, NULL, 1, 'MT', '', 89, '78010-500', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3DAv.%2BMiguel%2BSutil%252C%2B3271%252C%2B78015%2BCuiab%25C3%25A1%252C%2BBrazil%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNWgBryezeJkgY8CrZRFAwIhuctx90nt3AxO_rVTpe1quhjLqY4p75zC9C5lg2yZgMVo35edWeU9QIAhowti-17ZZZCTBSejRNA4mXKBVqa8HRhPw&s=1&enc=AZMxxP9W3FI2JOvDVkVo6s5R9iJ5D1bTiWgZDoVjr19JmQSZpf5RwLS9nhjaLMIqGWjV0xuT8XpwyQHBpfxAgn1C', 1),
(14, '2018-08-24 17:54:55', 3, '21.00', 1, 'Levar troco para R$100.  Observação do cliente: Caprinha no bacon', 1, '999898645', 'A. Miguel sutil, 3271', NULL, NULL, 1, 'MT', '', 89, '78010-500', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3DAv.%2BMiguel%2BSutil%252C%2B3271%252C%2B78015%2BCuiab%25C3%25A1%252C%2BBrazil%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNWgBryezeJkgY8CrZRFAwIhuctx90nt3AxO_rVTpe1quhjLqY4p75zC9C5lg2yZgMVo35edWeU9QIAhowti-17ZZZCTBSejRNA4mXKBVqa8HRhPw&s=1&enc=AZMxxP9W3FI2JOvDVkVo6s5R9iJ5D1bTiWgZDoVjr19JmQSZpf5RwLS9nhjaLMIqGWjV0xuT8XpwyQHBpfxAgn1C', 2),
(19, '2018-08-30 13:39:37', 3, '118.00', 1, 'Levar troco para R$150.  Observação do cliente: ', 1, '999898645', 'A. Miguel sutil, 3271', NULL, NULL, 1, 'MT', '', 89, '78010-500', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3DAv.%2BMiguel%2BSutil%252C%2B3271%252C%2B78015%2BCuiab%25C3%25A1%252C%2BBrazil%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATNWgBryezeJkgY8CrZRFAwIhuctx90nt3AxO_rVTpe1quhjLqY4p75zC9C5lg2yZgMVo35edWeU9QIAhowti-17ZZZCTBSejRNA4mXKBVqa8HRhPw&s=1&enc=AZMxxP9W3FI2JOvDVkVo6s5R9iJ5D1bTiWgZDoVjr19JmQSZpf5RwLS9nhjaLMIqGWjV0xuT8XpwyQHBpfxAgn1C', 2),
(20, '2018-09-01 20:07:24', 10, '18.00', 1, 'Levar troco para R$50.  Observação do cliente: ', 1, '999998888', 'teste  3271', NULL, NULL, 1, 'MT', '', 89, '78000000', '', 2),
(24, '2018-09-25 03:43:48', 2, '30.00', 2, ' Observação do cliente: ', 1, '66992299988', 'av brasil, cpa 2 casa 13', NULL, NULL, 1, 'MT', '', 140, '78056606', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.5626437%252C%2B-56.0510741%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATOlBlKxGFZLCUjeQvOwc9jnExFJwI_MQYkEzcQBQjugoZ92vUpJTsoBE88Rbxc9fp7yPXF3_aRnDIrP0fjyyynaahM6O9CSLu5YXt7SDt96u6AE7w&s=1&enc=AZOWpXHYVjg_zqVQFpI3LKIiqncdZvAR12dP6J9W-lS4n8dQdfqq54jUgwx3dKGlPFfI47HijQoeAErfGTjbDa9w', 2),
(25, '2018-09-25 03:45:55', 2, '29.50', 2, ' Observação do cliente: ', 1, '66992299988', 'av brasil, cpa 2 casa 13', NULL, NULL, 1, 'MT', '', 140, '78056606', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.5626437%252C%2B-56.0510741%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATOlBlKxGFZLCUjeQvOwc9jnExFJwI_MQYkEzcQBQjugoZ92vUpJTsoBE88Rbxc9fp7yPXF3_aRnDIrP0fjyyynaahM6O9CSLu5YXt7SDt96u6AE7w&s=1&enc=AZOWpXHYVjg_zqVQFpI3LKIiqncdZvAR12dP6J9W-lS4n8dQdfqq54jUgwx3dKGlPFfI47HijQoeAErfGTjbDa9w', 2),
(26, '2018-09-26 00:41:03', 2, '28.00', 2, ' Observação do cliente: ', 1, '66992299988', 'av brasil, cpa 2 casa 13', NULL, NULL, 1, 'MT', '', 140, '78056606', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.5626437%252C%2B-56.0510741%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATOlBlKxGFZLCUjeQvOwc9jnExFJwI_MQYkEzcQBQjugoZ92vUpJTsoBE88Rbxc9fp7yPXF3_aRnDIrP0fjyyynaahM6O9CSLu5YXt7SDt96u6AE7w&s=1&enc=AZOWpXHYVjg_zqVQFpI3LKIiqncdZvAR12dP6J9W-lS4n8dQdfqq54jUgwx3dKGlPFfI47HijQoeAErfGTjbDa9w', 1),
(27, '2018-09-26 00:46:04', 2, '28.00', 2, ' Observação do cliente: ', 1, '66992299988', 'av brasil, cpa 2 casa 13', NULL, NULL, 1, 'MT', '', 140, '78056606', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.5626437%252C%2B-56.0510741%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATOlBlKxGFZLCUjeQvOwc9jnExFJwI_MQYkEzcQBQjugoZ92vUpJTsoBE88Rbxc9fp7yPXF3_aRnDIrP0fjyyynaahM6O9CSLu5YXt7SDt96u6AE7w&s=1&enc=AZOWpXHYVjg_zqVQFpI3LKIiqncdZvAR12dP6J9W-lS4n8dQdfqq54jUgwx3dKGlPFfI47HijQoeAErfGTjbDa9w', 1),
(28, '2018-09-26 01:43:14', 2, '22.00', 2, ' Observação do cliente: ', 1, '66992299988', 'av brasil, cpa 2 casa 13', NULL, NULL, 1, 'MT', '', 140, '78056606', 'https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.bing.com%2Fmaps%2Fdefault.aspx%3Fv%3D2%26pc%3DFACEBK%26mid%3D8100%26where1%3D-15.5626437%252C%2B-56.0510741%26FORM%3DFBKPL1%26mkt%3Den-US&h=ATOlBlKxGFZLCUjeQvOwc9jnExFJwI_MQYkEzcQBQjugoZ92vUpJTsoBE88Rbxc9fp7yPXF3_aRnDIrP0fjyyynaahM6O9CSLu5YXt7SDt96u6AE7w&s=1&enc=AZOWpXHYVjg_zqVQFpI3LKIiqncdZvAR12dP6J9W-lS4n8dQdfqq54jUgwx3dKGlPFfI47HijQoeAErfGTjbDa9w', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `codigo_produto` bigint(20) NOT NULL,
  `nome_produto` varchar(400) NOT NULL COMMENT 'nome que aparecerá no título do cartão',
  `produto_pai_produto` bigint(20) DEFAULT NULL COMMENT 'produto pai o qual o subproduto se refere.',
  `produto_irmao_produto` bigint(10) DEFAULT NULL COMMENT 'nó direito irmão do produto.',
  `preco_produto` decimal(10,2) DEFAULT NULL,
  `descricao_produto` varchar(400) DEFAULT NULL COMMENT 'descrição que aparecerá no subtítulo do cartão',
  `apresenta_resumo_pedido_produto` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - não, 1 - sim. Coluna que controla se o produto é apresentado como item de pedido no resumo do pedido.',
  `quantidade_minima_produto` int(3) NOT NULL DEFAULT '0' COMMENT '0 - não obrigatório',
  `quantidade_maxima_produto` int(3) NOT NULL DEFAULT '1' COMMENT '-1 - ilimitado',
  `empresa_produto` bigint(20) NOT NULL,
  `ativo_produto` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - nao ativo, 1 - sim ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo_produto`, `nome_produto`, `produto_pai_produto`, `produto_irmao_produto`, `preco_produto`, `descricao_produto`, `apresenta_resumo_pedido_produto`, `quantidade_minima_produto`, `quantidade_maxima_produto`, `empresa_produto`, `ativo_produto`) VALUES
(1, 'Lanches', NULL, NULL, NULL, 'Lanches feitos com os melhores produtos <3', 0, 0, 1, 1, 1),
(2, 'X-BURGUER', 1, NULL, '6.00', 'Pão, Hambúrguer, presunto, mussarela e batata frita.', 0, 0, 20, 1, 0),
(3, 'X-SALADA', 1, NULL, '6.00', 'pão, hambúrguer, presunto, mussarela, alface, tomate e batata palha.', 0, 0, 99, 1, 1),
(4, 'X-EGG', 1, NULL, '6.50', 'pão, hambúrguer, presunto, mussarela, ovo e batata palha', 0, 0, 99, 1, 1),
(5, 'X-SALADA EGG', 1, NULL, '6.50', 'pão, hambúrguer, presunto, mussarela, ovo, alface, tomate e Batata palha', 0, 0, 99, 1, 1),
(6, 'X-BACON', 1, NULL, '7.00', 'pão, hambúrguer, presunto, mussarela, bacon e batata palha', 0, 0, 99, 1, 1),
(7, 'X-SALADA BACON', 1, NULL, '7.00', 'pão, hambúrguer, presunto, mussarela, bacon alface tomate e batata palha', 0, 0, 99, 1, 1),
(8, 'X-TUDO', 1, NULL, '7.50', 'pão, hambúrguer, presunto, mussarela, ovo, bacon, alface, tomate, e batata palha', 0, 0, 99, 1, 1),
(9, 'Bebidas', NULL, NULL, NULL, 'Bebidas que oferecemos', 0, 0, 1, 1, 1),
(10, 'Coca Cola 2lts', 9, NULL, '8.00', 'Coca Cola 2lts', 0, 0, 10, 1, 1),
(11, 'Coca Cola 600ml', 9, NULL, '4.00', 'Coca Cola 600 ml', 0, 0, 10, 1, 1),
(12, 'Coca Cola lata', 9, NULL, '3.00', 'Coca Cola lata', 0, 0, 10, 1, 1),
(13, 'Fanta 2lts', 9, NULL, '8.00', 'Fanta 2lts', 0, 0, 10, 1, 1),
(14, 'Fanta lata', 9, NULL, '3.00', 'Fanta lata', 0, 0, 10, 1, 1),
(15, 'Guarana 2 lts', 9, NULL, '8.00', 'Guarana 2 lts', 0, 0, 10, 1, 1),
(16, 'Água 500 ml', 9, NULL, '3.00', 'Água 500 ml', 0, 0, 10, 1, 1),
(17, 'Sobremesa', NULL, NULL, NULL, 'A vida é curta para não comer doces', 0, 0, 1, 1, 1),
(18, 'Brownie de chocolate', 17, NULL, '5.00', 'Brownie chocolatudo delicioso e cremoso', 0, 0, 99, 1, 1),
(19, 'Ninho com nutella', 17, NULL, '5.00', 'Bolo de leite ninho com nutella', 0, 0, 99, 1, 1),
(20, 'Bombom', 17, NULL, '1.00', 'Bombom sonho de valsa', 0, 0, 99, 1, 1),
(21, 'Prestigio', 17, NULL, '2.00', 'Prestigio barrinha de chocolate', 0, 0, 99, 1, 1),
(22, 'Ouro branco bombom', 17, NULL, '1.00', 'Ouro branco bombom', 0, 0, 99, 1, 1),
(23, 'Diamante negro', 17, NULL, '4.00', 'Diamante negro barra', 0, 0, 99, 1, 1),
(24, 'Barra Alpino 300g', 17, NULL, '7.00', 'Barra Alpino 300g', 0, 0, 99, 1, 1),
(25, 'Água', NULL, NULL, NULL, 'Galão com 20 litros', 0, 0, 1, 1, 1),
(26, 'Lebrinha', 25, NULL, '8.00', 'Garrafão Lebrinha', 0, 1, 3, 1, 1),
(27, 'Cristalina', 25, NULL, '7.00', 'Garrafão de 20 litros', 0, 1, 5, 1, 1),
(28, 'Gás', NULL, NULL, NULL, 'Botijão de gás', 0, 0, 1, 1, 1),
(29, 'Liquigás', 28, NULL, '95.00', 'Botijão de cozinha', 0, 1, 3, 1, 1),
(30, 'Ultragás', 28, NULL, '100.00', 'Botijão de cozinha', 0, 1, 4, 1, 1),
(31, 'Camisa Polo', NULL, NULL, NULL, 'Camisetas de Marcas diversas com botao', 0, 0, 1, 1, 0),
(32, 'Camiseta BLM', 31, NULL, '100.00', 'Tamanho P', 0, 1, 2, 1, 1),
(33, 'Camiseta Armani', 31, NULL, '500.00', 'Tamanho G', 0, 1, 5, 1, 1),
(34, 'Botijão de Gás', NULL, NULL, NULL, 'Botijão de gás', 0, 0, 1, 2, 1),
(35, 'Gás Copagaz', 34, NULL, '100.00', 'Marca Copagaz.', 0, 1, 3, 2, 1),
(36, 'Ultragaz', 34, NULL, '90.00', 'Marca Ultragaz', 0, 1, 4, 2, 1),
(37, 'Água mineral 20L', NULL, NULL, NULL, 'Galão com 20 litros', 0, 0, 1, 2, 1),
(38, 'Água Lebrinha', 37, NULL, '8.00', 'Galão lebrinha 20 litros', 0, 1, 4, 2, 1),
(39, 'Água Brunado', 37, NULL, '7.00', 'Água mineral Brunado 20L', 0, 1, 4, 2, 1),
(40, 'Água Puríssima', 37, NULL, '9.00', 'Galão de água mineral Puríssima', 0, 1, 4, 2, 1),
(41, 'Registro e mangueira', NULL, NULL, NULL, 'Registro com mangueira 1,25m', 0, 0, 1, 2, 1),
(42, 'Registro e mangueira', 41, NULL, '40.00', 'Registro com mangueira 1,25m', 0, 1, 1, 2, 1),
(43, 'Água Excelência', 37, NULL, '6.50', 'Água mineral Excelência 20L', 0, 1, 4, 2, 1),
(44, 'Água Cristalina', 37, NULL, '8.00', 'Galão 20 Litros', 0, 1, 800, 2, 1);

--
-- Acionadores `produto`
--
DELIMITER $$
CREATE TRIGGER `validacao_produto_bi` BEFORE INSERT ON `produto` FOR EACH ROW if new.descricao_produto = null or new.descricao_produto='' THEN
	SET NEW.descricao_produto := NEW.nome_produto;
end if
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `validacao_produto_bu` BEFORE UPDATE ON `produto` FOR EACH ROW if new.descricao_produto = null or new.descricao_produto='' THEN
	SET NEW.descricao_produto := NEW.nome_produto;
end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_gerencia`
--

CREATE TABLE `solicitacao_gerencia` (
  `codigo_solicitacao_gerencia` bigint(20) NOT NULL,
  `empresa_solicitacao_gerencia` bigint(20) NOT NULL,
  `nome_cliente_solicitacao_gerencia` varchar(400) NOT NULL COMMENT 'nome do cliente que solicitou o gerente',
  `cliente_id_facebook_solicitacao_gerencia` varchar(400) NOT NULL COMMENT 'identificador do cliente que é usado pelo chatfuel',
  `data_solicitacao_gerencia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'data da solicitação para falar com gerente',
  `data_fim_solicitacao_gerencia` timestamp NULL DEFAULT NULL COMMENT 'data hora fim da solicitação do gerente',
  `status_solicitacao_gerencia` int(2) NOT NULL DEFAULT '1' COMMENT '0 terminou, 1 solicitou'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solicitacao_gerencia`
--

INSERT INTO `solicitacao_gerencia` (`codigo_solicitacao_gerencia`, `empresa_solicitacao_gerencia`, `nome_cliente_solicitacao_gerencia`, `cliente_id_facebook_solicitacao_gerencia`, `data_solicitacao_gerencia`, `data_fim_solicitacao_gerencia`, `status_solicitacao_gerencia`) VALUES
(28, 1, 'Alexandre', '1333648083413071', '2018-04-02 15:44:34', '2018-04-02 14:44:34', 0),
(29, 1, 'Alexandre', '1333648083413071', '2018-04-07 00:07:07', '2018-04-06 23:07:07', 0),
(30, 2, 'Evilyn', '2400133993338019', '2018-09-04 15:18:45', '2018-09-04 14:18:45', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `taxa_entrega`
--

CREATE TABLE `taxa_entrega` (
  `codigo_taxa_entrega` bigint(20) NOT NULL,
  `bairro_taxa_entrega` bigint(20) NOT NULL,
  `preco_taxa_entrega` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `ativo_taxa_entrega` tinyint(4) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 - não entrega, 1 - sim entrega',
  `empresa_taxa_entrega` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `taxa_entrega`
--

INSERT INTO `taxa_entrega` (`codigo_taxa_entrega`, `bairro_taxa_entrega`, `preco_taxa_entrega`, `ativo_taxa_entrega`, `empresa_taxa_entrega`) VALUES
(1, 3, '5.00', 1, 1),
(3, 1, '5.00', 2, 1),
(37, 47, '10.00', 1, 1),
(38, 51, '10.00', 1, 1),
(39, 102, '10.00', 1, 1),
(40, 4, '10.00', 2, 1),
(41, 5, '10.00', 2, 1),
(42, 6, '10.00', 1, 1),
(43, 56, '10.00', 1, 1),
(44, 57, '10.00', 1, 1),
(45, 58, '10.00', 1, 1),
(46, 59, '10.00', 1, 1),
(47, 60, '10.00', 1, 1),
(48, 1, '9.00', 2, 1),
(49, 63, '10.00', 1, 1),
(50, 63, '10.00', 0, 1),
(51, 64, '10.00', 1, 1),
(52, 7, '10.00', 1, 1),
(53, 2, '10.00', 1, 1),
(54, 8, '10.00', 1, 1),
(55, 9, '10.00', 1, 1),
(56, 10, '10.00', 1, 1),
(57, 103, '10.00', 1, 1),
(58, 11, '10.00', 1, 1),
(59, 104, '10.00', 1, 1),
(60, 105, '10.00', 1, 1),
(61, 81, '10.00', 1, 1),
(62, 12, '10.00', 1, 1),
(63, 53, '10.00', 1, 1),
(64, 55, '10.00', 1, 1),
(65, 89, '10.00', 1, 1),
(66, 100, '10.00', 1, 1),
(67, 65, '10.00', 1, 1),
(68, 66, '10.00', 1, 1),
(69, 52, '10.00', 1, 1),
(70, 54, '10.00', 1, 1),
(71, 46, '10.00', 1, 1),
(72, 13, '10.00', 1, 1),
(73, 14, '10.00', 1, 1),
(74, 67, '10.00', 1, 1),
(75, 68, '10.00', 1, 1),
(76, 37, '10.00', 1, 1),
(77, 15, '10.00', 1, 1),
(78, 50, '10.00', 1, 1),
(79, 70, '10.00', 1, 1),
(80, 106, '10.00', 1, 1),
(81, 16, '10.00', 1, 1),
(82, 69, '10.00', 1, 1),
(83, 112, '10.00', 1, 1),
(84, 110, '10.00', 1, 1),
(85, 71, '10.00', 1, 1),
(86, 72, '10.00', 1, 1),
(87, 34, '10.00', 1, 1),
(88, 107, '10.00', 1, 1),
(89, 73, '10.00', 1, 1),
(90, 108, '10.00', 1, 1),
(91, 109, '10.00', 1, 1),
(92, 74, '10.00', 1, 1),
(93, 75, '10.00', 1, 1),
(94, 17, '10.00', 1, 1),
(95, 20, '10.00', 1, 1),
(96, 111, '10.00', 1, 1),
(97, 113, '10.00', 1, 1),
(98, 76, '10.00', 1, 1),
(99, 77, '10.00', 1, 1),
(100, 114, '10.00', 1, 1),
(101, 21, '10.00', 1, 1),
(102, 18, '10.00', 1, 1),
(103, 78, '10.00', 1, 1),
(104, 79, '10.00', 1, 1),
(105, 19, '10.00', 1, 1),
(106, 48, '10.00', 1, 1),
(107, 35, '10.00', 1, 1),
(108, 80, '10.00', 1, 1),
(109, 36, '10.00', 1, 1),
(110, 138, '10.00', 0, 1),
(111, 115, '10.00', 1, 1),
(112, 116, '10.00', 1, 1),
(113, 3, '10.00', 2, 1),
(114, 38, '10.00', 1, 1),
(115, 82, '10.00', 1, 1),
(116, 117, '10.00', 1, 1),
(117, 49, '10.00', 1, 1),
(118, 39, '10.00', 1, 1),
(119, 118, '10.00', 1, 1),
(120, 22, '10.00', 1, 1),
(121, 84, '10.00', 1, 1),
(122, 83, '10.00', 1, 1),
(123, 119, '10.00', 1, 1),
(124, 40, '10.00', 1, 1),
(125, 23, '10.00', 1, 1),
(126, 120, '10.00', 1, 1),
(127, 43, '10.00', 1, 1),
(128, 86, '10.00', 1, 1),
(129, 121, '10.00', 1, 1),
(130, 122, '10.00', 1, 1),
(131, 123, '10.00', 1, 1),
(132, 125, '10.00', 1, 1),
(133, 124, '10.00', 1, 1),
(134, 24, '10.00', 1, 1),
(135, 126, '10.00', 1, 1),
(136, 126, '10.00', 1, 1),
(137, 127, '10.00', 1, 1),
(138, 87, '10.00', 1, 1),
(139, 88, '10.00', 1, 1),
(140, 85, '10.00', 1, 1),
(141, 41, '10.00', 1, 1),
(142, 92, '10.00', 1, 1),
(143, 25, '10.00', 1, 1),
(144, 26, '10.00', 1, 1),
(145, 90, '10.00', 1, 1),
(146, 91, '10.00', 1, 1),
(147, 27, '10.00', 1, 1),
(148, 128, '10.00', 1, 1),
(149, 93, '10.00', 1, 1),
(150, 44, '10.00', 1, 1),
(151, 94, '10.00', 1, 1),
(152, 95, '10.00', 1, 1),
(153, 28, '10.00', 1, 1),
(154, 29, '10.00', 1, 1),
(155, 96, '10.00', 1, 1),
(156, 129, '10.00', 1, 1),
(157, 30, '10.00', 1, 1),
(158, 31, '10.00', 1, 1),
(159, 135, '10.00', 1, 1),
(160, 130, '10.00', 1, 1),
(161, 131, '10.00', 1, 1),
(162, 132, '10.00', 1, 1),
(163, 133, '10.00', 1, 1),
(164, 62, '10.00', 1, 1),
(165, 97, '10.00', 0, 1),
(166, 134, '10.00', 1, 1),
(167, 45, '10.00', 1, 1),
(168, 98, '10.00', 1, 1),
(169, 32, '10.00', 1, 1),
(170, 99, '10.00', 1, 1),
(171, 136, '10.00', 1, 1),
(172, 42, '10.00', 1, 1),
(173, 101, '10.00', 1, 1),
(174, 33, '10.00', 1, 1),
(175, 137, '10.00', 0, 1),
(176, 1, '10.00', 1, 1),
(177, 138, '10.00', 1, 1),
(178, 137, '10.00', 1, 1),
(279, 4, '10.00', 1, 1),
(280, 140, '10.00', 1, 1),
(281, 139, '10.00', 1, 1),
(282, 141, '10.00', 1, 1),
(283, 152, '10.00', 1, 1),
(533, 309, '0.00', 1, 2),
(534, 330, '0.00', 1, 2),
(535, 273, '0.00', 1, 2),
(536, 265, '0.00', 1, 2),
(537, 264, '0.00', 1, 2),
(538, 263, '0.00', 1, 2),
(539, 244, '0.00', 1, 2),
(540, 312, '0.00', 1, 2),
(541, 313, '0.00', 1, 2),
(542, 314, '0.00', 1, 2),
(543, 337, '0.00', 1, 2),
(544, 348, '0.00', 1, 2),
(545, 284, '0.00', 1, 2),
(546, 302, '0.00', 1, 2),
(547, 324, '0.00', 1, 2),
(548, 281, '0.00', 1, 2),
(549, 355, '0.00', 1, 2),
(550, 356, '0.00', 1, 2),
(551, 357, '0.00', 1, 2),
(552, 11, '0.00', 1, 2),
(553, 358, '0.00', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `valor_configuracao`
--

CREATE TABLE `valor_configuracao` (
  `codigo_valor_configuracao` int(11) NOT NULL,
  `descricao_valor_configuracao` varchar(400) NOT NULL,
  `configuracao_valor_configuracao` bigint(20) NOT NULL,
  `empresa_valor_configuracao` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `valor_configuracao`
--

INSERT INTO `valor_configuracao` (`codigo_valor_configuracao`, `descricao_valor_configuracao`, `configuracao_valor_configuracao`, `empresa_valor_configuracao`) VALUES
(1, '1', 1, 1),
(2, '0', 3, 1),
(3, '30', 2, 1),
(34, '2', 1, 2),
(35, '10', 2, 2),
(36, '0', 3, 2),
(41, '0', 4, 1),
(42, '1', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigo_cliente`),
  ADD UNIQUE KEY `cliente_cpf_uk` (`cpf_cliente`),
  ADD KEY `cliente_uf_fk` (`uf_cliente`) USING BTREE,
  ADD KEY `cliente_cidade_fk` (`cidade_cliente`) USING BTREE,
  ADD KEY `cliente_bairro_fk` (`bairro_cliente`) USING BTREE,
  ADD KEY `cliente_empresa_fk` (`empresa_cliente`) USING BTREE;

--
-- Indexes for table `configuracao`
--
ALTER TABLE `configuracao`
  ADD PRIMARY KEY (`codigo_configuracao`),
  ADD UNIQUE KEY `descricao_configuracao_uk` (`descricao_configuracao`(250));

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`codigo_empresa`),
  ADD UNIQUE KEY `empresa_cnpj_uk` (`cnpj_empresa`),
  ADD KEY `empresa_cidade_fk` (`cidade_empresa`),
  ADD KEY `empresa_bairro_fk` (`bairro_empresa`),
  ADD KEY `empresa_uf_fk` (`uf_empresa`);

--
-- Indexes for table `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`codigo_forma_pagamento`,`empresa_forma_pagamento`) USING BTREE,
  ADD KEY `forma_pagamento_empresa_fk` (`empresa_forma_pagamento`);

--
-- Indexes for table `horario_atendimento`
--
ALTER TABLE `horario_atendimento`
  ADD PRIMARY KEY (`codigo_horario_atendimento`),
  ADD KEY `horario_atendimento_empresa_fk` (`empresa_horario_atendimento`);

--
-- Indexes for table `horario_especial`
--
ALTER TABLE `horario_especial`
  ADD PRIMARY KEY (`codigo_horario_especial`),
  ADD KEY `horario_especial_empresa_fk` (`empresa_horario_especial`);

--
-- Indexes for table `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`codigo_item_pedido`),
  ADD KEY `item_pedido_pedido_fk` (`pedido_item_pedido`) USING BTREE,
  ADD KEY `item_pedido_produto_fk` (`produto_item_pedido`) USING BTREE;

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`codigo_pedido`),
  ADD KEY `pedido_cliente_fk` (`cliente_pedido`),
  ADD KEY `pedido_bairro_fk` (`bairro_pedido`),
  ADD KEY `pedido_cidade_fk` (`cidade_pedido`),
  ADD KEY `pedido_uf_fk` (`uf_pedido`),
  ADD KEY `pedido_forma_pagamento_fk` (`forma_pagamento_pedido`),
  ADD KEY `pedido_empresa_fk` (`empresa_pedido`) USING BTREE;

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigo_produto`),
  ADD KEY `produto_empresa_fk` (`empresa_produto`),
  ADD KEY `produto_produto_pai_fk` (`produto_pai_produto`),
  ADD KEY `produto_produto_irmao_fk` (`produto_irmao_produto`);

--
-- Indexes for table `solicitacao_gerencia`
--
ALTER TABLE `solicitacao_gerencia`
  ADD PRIMARY KEY (`codigo_solicitacao_gerencia`),
  ADD KEY `pizzaria_fk` (`empresa_solicitacao_gerencia`);

--
-- Indexes for table `taxa_entrega`
--
ALTER TABLE `taxa_entrega`
  ADD PRIMARY KEY (`codigo_taxa_entrega`),
  ADD KEY `taxa_entrega_empresa_fk` (`empresa_taxa_entrega`),
  ADD KEY `taxa_entrega_bairro_fk` (`bairro_taxa_entrega`);

--
-- Indexes for table `valor_configuracao`
--
ALTER TABLE `valor_configuracao`
  ADD PRIMARY KEY (`codigo_valor_configuracao`),
  ADD KEY `valor_configuracao_configuracao_fk` (`configuracao_valor_configuracao`),
  ADD KEY `valor_configuracao_cliente_fk` (`empresa_valor_configuracao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigo_cliente` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `configuracao`
--
ALTER TABLE `configuracao`
  MODIFY `codigo_configuracao` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `codigo_empresa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `codigo_forma_pagamento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `horario_atendimento`
--
ALTER TABLE `horario_atendimento`
  MODIFY `codigo_horario_atendimento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `horario_especial`
--
ALTER TABLE `horario_especial`
  MODIFY `codigo_horario_especial` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `codigo_item_pedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `codigo_pedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `codigo_produto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `solicitacao_gerencia`
--
ALTER TABLE `solicitacao_gerencia`
  MODIFY `codigo_solicitacao_gerencia` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `taxa_entrega`
--
ALTER TABLE `taxa_entrega`
  MODIFY `codigo_taxa_entrega` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=554;

--
-- AUTO_INCREMENT for table `valor_configuracao`
--
ALTER TABLE `valor_configuracao`
  MODIFY `codigo_valor_configuracao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_bairro_fk` FOREIGN KEY (`bairro_cliente`) REFERENCES `skybots_gerencia`.`bairro` (`codigo_bairro`),
  ADD CONSTRAINT `cliente_cidade_fk` FOREIGN KEY (`cidade_cliente`) REFERENCES `skybots_gerencia`.`cidade` (`codigo_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cliente_empresa_fk` FOREIGN KEY (`empresa_cliente`) REFERENCES `empresa` (`codigo_empresa`),
  ADD CONSTRAINT `cliente_uf_fk` FOREIGN KEY (`uf_cliente`) REFERENCES `skybots_gerencia`.`uf` (`codigo_uf`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_bairro_fk` FOREIGN KEY (`bairro_empresa`) REFERENCES `skybots_gerencia`.`bairro` (`codigo_bairro`),
  ADD CONSTRAINT `empresa_cidade_fk` FOREIGN KEY (`cidade_empresa`) REFERENCES `skybots_gerencia`.`cidade` (`codigo_cidade`),
  ADD CONSTRAINT `empresa_uf_fk` FOREIGN KEY (`uf_empresa`) REFERENCES `skybots_gerencia`.`uf` (`codigo_uf`);

--
-- Limitadores para a tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD CONSTRAINT `forma_pagamento_empresa_fk` FOREIGN KEY (`empresa_forma_pagamento`) REFERENCES `empresa` (`codigo_empresa`);

--
-- Limitadores para a tabela `horario_atendimento`
--
ALTER TABLE `horario_atendimento`
  ADD CONSTRAINT `horario_atendimento_empresa_fk` FOREIGN KEY (`empresa_horario_atendimento`) REFERENCES `empresa` (`codigo_empresa`);

--
-- Limitadores para a tabela `horario_especial`
--
ALTER TABLE `horario_especial`
  ADD CONSTRAINT `horario_especial_empresa_fk` FOREIGN KEY (`empresa_horario_especial`) REFERENCES `empresa` (`codigo_empresa`);

--
-- Limitadores para a tabela `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `item_pedido_pedido_fk` FOREIGN KEY (`pedido_item_pedido`) REFERENCES `pedido` (`codigo_pedido`),
  ADD CONSTRAINT `item_pedido_produto_fk` FOREIGN KEY (`produto_item_pedido`) REFERENCES `produto` (`codigo_produto`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_bairro_fk` FOREIGN KEY (`bairro_pedido`) REFERENCES `skybots_gerencia`.`bairro` (`codigo_bairro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedido_cidade_fk` FOREIGN KEY (`cidade_pedido`) REFERENCES `skybots_gerencia`.`cidade` (`codigo_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedido_cliente_fk` FOREIGN KEY (`cliente_pedido`) REFERENCES `cliente` (`codigo_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedido_empresa_fk` FOREIGN KEY (`empresa_pedido`) REFERENCES `empresa` (`codigo_empresa`),
  ADD CONSTRAINT `pedido_forma_pagamento_fk` FOREIGN KEY (`forma_pagamento_pedido`) REFERENCES `forma_pagamento` (`codigo_forma_pagamento`),
  ADD CONSTRAINT `pedido_uf_fk` FOREIGN KEY (`uf_pedido`) REFERENCES `skybots_gerencia`.`uf` (`codigo_uf`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_empresa_fk` FOREIGN KEY (`empresa_produto`) REFERENCES `empresa` (`codigo_empresa`),
  ADD CONSTRAINT `produto_produto_irmao_fk` FOREIGN KEY (`produto_irmao_produto`) REFERENCES `produto` (`codigo_produto`),
  ADD CONSTRAINT `produto_produto_pai_fk` FOREIGN KEY (`produto_pai_produto`) REFERENCES `produto` (`codigo_produto`);

--
-- Limitadores para a tabela `taxa_entrega`
--
ALTER TABLE `taxa_entrega`
  ADD CONSTRAINT `taxa_entrega_bairro_fk` FOREIGN KEY (`bairro_taxa_entrega`) REFERENCES `skybots_gerencia`.`bairro` (`codigo_bairro`),
  ADD CONSTRAINT `taxa_entrega_empresa_fk` FOREIGN KEY (`empresa_taxa_entrega`) REFERENCES `empresa` (`codigo_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `valor_configuracao`
--
ALTER TABLE `valor_configuracao`
  ADD CONSTRAINT `valor_configuracao_configuracao_fk` FOREIGN KEY (`configuracao_valor_configuracao`) REFERENCES `configuracao` (`codigo_configuracao`),
  ADD CONSTRAINT `valor_configuracao_empresa_fk` FOREIGN KEY (`empresa_valor_configuracao`) REFERENCES `empresa` (`codigo_empresa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
