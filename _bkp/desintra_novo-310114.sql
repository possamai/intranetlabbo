-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 31-Jan-2014 às 13:06
-- Versão do servidor: 5.0.96-community
-- versão do PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `desintra_novo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE IF NOT EXISTS `arquivos` (
  `id` int(11) NOT NULL auto_increment,
  `categoria_arquivo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text,
  `arquivo` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_arquivos_categoria_arquivos1_idx` (`categoria_arquivo_id`),
  KEY `fk_arquivos_usuarios1_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `arquivos`
--

INSERT INTO `arquivos` (`id`, `categoria_arquivo_id`, `usuario_id`, `titulo`, `descricao`, `arquivo`, `filename`, `created`, `modified`) VALUES
(1, 3, 1, 'Modelo de Ofício (Circulação Externa)', 'Modelo de Ofício para circulação fora da empresa', 'teste.pdf', '52ea514d34000.pdf', '2014-01-30 11:19:09', '2014-01-30 11:19:09'),
(2, 4, 1, 'Relatório de Justificativa de Atraso e/ou Falta', '', 'teste.pdf', '52ea517798cba.pdf', '2014-01-30 11:19:51', '2014-01-30 11:19:51'),
(3, 5, 1, 'Requerimento de Solicitação de Férias', '', 'teste.pdf', '52ea518db3d85.pdf', '2014-01-30 11:20:13', '2014-01-30 11:20:13'),
(4, 1, 1, 'Apresentação Nova Intranet - Labbo', '', 'teste.pdf', '52ea568036f5f.pdf', '2014-01-30 11:41:20', '2014-01-30 11:41:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_arquivos`
--

CREATE TABLE IF NOT EXISTS `categoria_arquivos` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(200) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `categoria_arquivos`
--

INSERT INTO `categoria_arquivos` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Apresentação PPT', '2014-01-23 08:26:22', '2014-01-30 10:33:06'),
(2, 'Estatuto', '2014-01-23 08:27:01', '2014-01-30 10:35:47'),
(3, 'Ofício', '2014-01-30 10:34:48', '2014-01-30 10:34:48'),
(4, 'Relatório', '2014-01-30 10:34:56', '2014-01-30 10:34:56'),
(5, 'Requerimento', '2014-01-30 10:35:00', '2014-01-30 10:35:00'),
(6, 'Atas ', '2014-01-30 10:35:15', '2014-01-30 10:35:15'),
(7, 'Planejamento Estratégico', '2014-01-30 10:35:24', '2014-01-30 10:35:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_produtos`
--

CREATE TABLE IF NOT EXISTS `categoria_produtos` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(200) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `categoria_produtos`
--

INSERT INTO `categoria_produtos` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Fitas Adesivas', '2014-01-23 09:42:45', '2014-01-23 09:42:45'),
(2, 'Lâminas', '2014-01-23 09:42:52', '2014-01-23 09:42:52'),
(3, 'Manutenção de Cilindros', '2014-01-23 09:43:01', '2014-01-23 09:43:01'),
(4, 'Chapas de Fotopolímero', '2014-01-23 09:43:13', '2014-01-23 09:43:13'),
(5, 'Instrumentos Técnicos', '2014-01-23 09:43:24', '2014-01-23 09:43:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cores`
--

CREATE TABLE IF NOT EXISTS `cores` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(200) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `cores`
--

INSERT INTO `cores` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Transparente', '2014-01-23 09:42:03', '2014-01-23 09:42:03'),
(2, 'Âmbar', '2014-01-23 09:42:10', '2014-01-23 09:42:10'),
(3, 'Vermelho', '2014-01-23 09:42:24', '2014-01-23 09:42:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cotacao_produtos`
--

CREATE TABLE IF NOT EXISTS `cotacao_produtos` (
  `id` int(11) NOT NULL auto_increment,
  `cotacao_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `observacao` text,
  `largura_solicitada` varchar(200) default NULL,
  `quantidade_solicitada` double(12,1) default NULL,
  `unidade_medida_solicitada` varchar(200) default NULL,
  `valor_unitario` double(12,2) default NULL,
  `largura_disponivel` varchar(200) default NULL,
  `quantidade_disponivel` double(12,1) default NULL,
  `unidade_medida_disponivel` varchar(200) default NULL,
  `quantidade_aproximada` double(12,1) default NULL,
  `unidade_medida_aproximada` varchar(200) default NULL,
  PRIMARY KEY  (`id`,`cotacao_id`,`produto_id`),
  KEY `fk_cotacao_has_produtos_produtos1_idx` (`produto_id`),
  KEY `fk_cotacao_has_produtos_cotacao_idx` (`cotacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL auto_increment,
  `usuario_id` int(11) default NULL,
  `parent_id` int(11) default NULL,
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  `titulo` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_grupo_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id`, `usuario_id`, `parent_id`, `lft`, `rght`, `titulo`, `created`, `modified`) VALUES
(1, NULL, NULL, 1, 6, 'Financeiro', '0000-00-00 00:00:00', '2014-01-23 09:44:29'),
(3, NULL, NULL, 9, 12, 'Produção', '0000-00-00 00:00:00', '2014-01-23 09:44:38'),
(4, NULL, NULL, 13, 14, 'Vendas', '0000-00-00 00:00:00', '2014-01-23 09:44:48'),
(5, 8, 1, 2, 3, 'Administrativo', '0000-00-00 00:00:00', '2014-01-30 10:31:51'),
(6, 8, 1, 4, 5, 'Pagamentos', '0000-00-00 00:00:00', '2014-01-30 10:32:00'),
(7, 2, 3, 10, 11, 'Suporte', '0000-00-00 00:00:00', '2014-01-15 10:39:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos_usuarios`
--

CREATE TABLE IF NOT EXISTS `grupos_usuarios` (
  `grupo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY  (`grupo_id`,`usuario_id`),
  KEY `fk_grupo_has_usuario_usuario1_idx` (`usuario_id`),
  KEY `fk_grupo_has_usuario_grupo1_idx` (`grupo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupos_usuarios`
--

INSERT INTO `grupos_usuarios` (`grupo_id`, `usuario_id`) VALUES
(5, 1),
(6, 1),
(7, 1),
(5, 2),
(6, 2),
(5, 8),
(7, 8),
(7, 12),
(7, 13),
(7, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lado_adesivos`
--

CREATE TABLE IF NOT EXISTS `lado_adesivos` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(200) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `lado_adesivos`
--

INSERT INTO `lado_adesivos` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Direito', '2014-01-23 09:40:11', '2014-01-23 09:40:11'),
(2, 'Central', '2014-01-23 09:40:15', '2014-01-23 09:40:15'),
(3, 'Esquerdo', '2014-01-23 09:40:21', '2014-01-23 09:40:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE IF NOT EXISTS `materiais` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(200) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Latão', '2014-01-23 09:40:53', '2014-01-23 09:40:53'),
(2, 'Aço', '2014-01-23 09:40:57', '2014-01-23 09:40:57'),
(3, 'Sintético', '2014-01-23 09:41:02', '2014-01-23 09:41:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis`
--

CREATE TABLE IF NOT EXISTS `niveis` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `niveis`
--

INSERT INTO `niveis` (`id`, `titulo`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Operador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE IF NOT EXISTS `permissoes` (
  `id` int(11) NOT NULL auto_increment,
  `usuario_id` int(11) NOT NULL,
  `criou_id` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `model_registro` varchar(200) default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_permissoes_usuarios1_idx` (`usuario_id`),
  KEY `fk_permissoes_usuarios2_idx` (`criou_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `usuario_id`, `criou_id`, `id_registro`, `model_registro`, `created`) VALUES
(1, 1, 1, 1, 'Arquivo', '2014-01-30 11:19:09'),
(2, 2, 1, 1, 'Arquivo', '2014-01-30 11:19:09'),
(3, 8, 1, 1, 'Arquivo', '2014-01-30 11:19:09'),
(4, 12, 1, 1, 'Arquivo', '2014-01-30 11:19:09'),
(5, 13, 1, 1, 'Arquivo', '2014-01-30 11:19:09'),
(6, 14, 1, 1, 'Arquivo', '2014-01-30 11:19:09'),
(7, 1, 1, 2, 'Arquivo', '2014-01-30 11:19:51'),
(8, 8, 1, 2, 'Arquivo', '2014-01-30 11:19:51'),
(9, 12, 1, 2, 'Arquivo', '2014-01-30 11:19:51'),
(10, 13, 1, 2, 'Arquivo', '2014-01-30 11:19:51'),
(11, 1, 1, 4, 'Arquivo', '2014-01-30 11:41:20'),
(12, 2, 1, 4, 'Arquivo', '2014-01-30 11:41:20'),
(13, 8, 1, 4, 'Arquivo', '2014-01-30 11:41:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL auto_increment,
  `categoria_produto_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `rebaixo_id` int(11) default NULL,
  `cor_id` int(11) default NULL,
  `material_id` int(11) default NULL,
  `lado_adesivo_id` int(11) default NULL,
  `referencia` varchar(45) NOT NULL,
  `derivacao` varchar(200) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `comprimento` double(12,2) default NULL,
  `valor` double(12,2) default NULL,
  `ipi` int(11) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_produtos_grupo1_idx` (`grupo_id`),
  KEY `fk_produtos_categoria1_idx` (`categoria_produto_id`),
  KEY `fk_produtos_rebaixos1_idx` (`rebaixo_id`),
  KEY `fk_produtos_cores1_idx` (`cor_id`),
  KEY `fk_produtos_materiais1_idx` (`material_id`),
  KEY `fk_produtos_lado_adesivos1_idx` (`lado_adesivo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_unidade_medidas`
--

CREATE TABLE IF NOT EXISTS `produtos_unidade_medidas` (
  `produto_id` int(11) NOT NULL,
  `unidade_medida_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rebaixos`
--

CREATE TABLE IF NOT EXISTS `rebaixos` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(200) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `rebaixos`
--

INSERT INTO `rebaixos` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Padrão', '2014-01-23 09:41:40', '2014-01-23 09:41:40'),
(2, 'Flexotip', '2014-01-23 09:41:45', '2014-01-23 09:41:45'),
(3, 'Stable', '2014-01-23 09:41:49', '2014-01-23 09:41:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade_medidas`
--

CREATE TABLE IF NOT EXISTS `unidade_medidas` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `unidade_medidas`
--

INSERT INTO `unidade_medidas` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Metro', '2014-01-23 09:30:03', '2014-01-23 09:39:52'),
(2, 'Peça', '2014-01-23 09:30:08', '2014-01-23 09:39:58'),
(3, 'Unidade', '2014-01-23 09:30:15', '2014-01-23 09:30:15'),
(4, 'Quilo', '2014-01-23 09:30:21', '2014-01-23 09:30:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL auto_increment,
  `nivel_id` int(11) NOT NULL,
  `status` int(11) default NULL,
  `login` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `data_nascimento` date default NULL,
  `telefone` varchar(14) default NULL,
  `celular` varchar(14) default NULL,
  `ramal` varchar(45) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `nivel_id` (`nivel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nivel_id`, `status`, `login`, `nome`, `email`, `password`, `data_nascimento`, `telefone`, `celular`, `ramal`, `created`, `modified`) VALUES
(1, 1, 2, 'admin', 'Anderson Possamai', 'anderson@labbo.com.br', '87405bee18dedad74a532b425e16795b5a615f6f', '1985-09-15', '(12) 3123-1231', '(12) 3141-2312', '123123', '2013-10-28 00:50:07', '2014-01-30 10:32:18'),
(2, 2, 2, 'giovane', 'Giovane Pasa', 'labbo@labbo.com.br', '26d5e06be6e8967a98b894a2ec6469ecbc545769', NULL, '', '', '', '2013-10-28 01:13:50', '2014-01-30 10:27:43'),
(7, 0, 3, 'pedro', 'Pedro Paulo', 'pedro@email.com', '26d5e06be6e8967a98b894a2ec6469ecbc545769', NULL, '', '', '', '2013-11-11 16:57:04', '2013-11-14 00:03:58'),
(8, 2, 2, 'maira', 'Maíra Scirea', 'maira@labbo.com.br', '87405bee18dedad74a532b425e16795b5a615f6f', NULL, '', '', '', '2014-01-10 11:42:16', '2014-01-30 10:31:35'),
(12, 3, 2, 'rogic', 'Rógic Alan', 'rogic@labbo.com.br', '87405bee18dedad74a532b425e16795b5a615f6f', NULL, '', '', '', '2014-01-30 10:27:30', '2014-01-30 10:29:57'),
(13, 3, 2, 'felipe', 'Felipe Tomaz Silva', 'felipe@labbo.com.br', '87405bee18dedad74a532b425e16795b5a615f6f', NULL, '', '', '', '2014-01-30 10:30:26', '2014-01-30 10:30:26'),
(14, 3, 2, 'leonardo', 'Leonardo Machado', 'leonardo@labbo.com.br', '87405bee18dedad74a532b425e16795b5a615f6f', NULL, '', '', '', '2014-01-30 10:30:51', '2014-01-30 10:30:51');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `fk_arquivos_categoria_arquivos1` FOREIGN KEY (`categoria_arquivo_id`) REFERENCES `categoria_arquivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_arquivos_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD CONSTRAINT `fk_permissoes_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissoes_usuarios2` FOREIGN KEY (`criou_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
