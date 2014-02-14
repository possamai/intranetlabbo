-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Fev 14, 2014 as 04:38 PM
-- Versão do Servidor: 5.1.37
-- Versão do PHP: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `intranet_labbo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE IF NOT EXISTS `arquivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_arquivo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text,
  `arquivo` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_arquivos_categoria_arquivos1_idx` (`categoria_arquivo_id`),
  KEY `fk_arquivos_usuarios1_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `arquivos`
--

INSERT INTO `arquivos` (`id`, `categoria_arquivo_id`, `usuario_id`, `titulo`, `descricao`, `arquivo`, `filename`, `created`, `modified`) VALUES
(1, 2, 1, 'teste', '', 'teste.pdf', '52eb2d201260a.pdf', '2014-01-31 02:57:04', '2014-01-31 02:59:06'),
(2, 1, 1, 'Teste Permissão', '', 'teste.pdf', '52eba1da0258c.pdf', '2014-01-31 11:15:06', '2014-01-31 11:15:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_arquivos`
--

CREATE TABLE IF NOT EXISTS `categoria_arquivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `categoria_arquivos`
--

INSERT INTO `categoria_arquivos` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Word', '2014-01-15 02:37:53', '2014-01-15 02:37:53'),
(2, 'Planilhas', '2014-01-15 02:38:08', '2014-01-15 02:38:08'),
(3, 'Pdf', '2014-01-15 02:38:14', '2014-01-15 02:38:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_produtos`
--

CREATE TABLE IF NOT EXISTS `categoria_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `categoria_produtos`
--

INSERT INTO `categoria_produtos` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Fitas Adesivas', '2014-01-22 22:42:54', '2014-01-22 22:42:54'),
(2, 'Lâminas', '2014-01-22 22:43:01', '2014-01-22 22:43:01'),
(3, 'Chapas de Fotopolímeros', '2014-01-22 22:43:24', '2014-01-22 22:43:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cores`
--

CREATE TABLE IF NOT EXISTS `cores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `cores`
--

INSERT INTO `cores` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Transparente', '2014-01-23 00:48:05', '2014-01-23 00:48:05'),
(2, 'Âmbar', '2014-01-23 00:48:10', '2014-01-23 00:48:22'),
(4, 'Alumínio', '2014-01-23 00:48:53', '2014-01-23 00:48:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cotacao_produtos`
--

CREATE TABLE IF NOT EXISTS `cotacao_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cotacao_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `observacao` text,
  `largura_solicitada` varchar(200) DEFAULT NULL,
  `quantidade_solicitada` double(12,1) DEFAULT NULL,
  `unidade_medida_solicitada` varchar(200) DEFAULT NULL,
  `valor_unitario` double(12,2) DEFAULT NULL,
  `largura_disponivel` varchar(200) DEFAULT NULL,
  `quantidade_disponivel` double(12,1) DEFAULT NULL,
  `unidade_medida_disponivel` varchar(200) DEFAULT NULL,
  `quantidade_aproximada` double(12,1) DEFAULT NULL,
  `unidade_medida_aproximada` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`,`cotacao_id`,`produto_id`),
  KEY `fk_cotacao_has_produtos_produtos1_idx` (`produto_id`),
  KEY `fk_cotacao_has_produtos_cotacao_idx` (`cotacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `cotacao_produtos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_endereco_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `endereco` varchar(200) NOT NULL,
  `bairro` varchar(200) DEFAULT NULL,
  `cidade` varchar(200) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enderecos_usuarios1_idx` (`usuario_id`),
  KEY `fk_enderecos_tipo_enderecos1_idx` (`tipo_endereco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `enderecos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `titulo` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grupo_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id`, `usuario_id`, `parent_id`, `lft`, `rght`, `titulo`, `created`, `modified`) VALUES
(1, NULL, NULL, 1, 6, 'Teste', '0000-00-00 00:00:00', '2014-01-17 02:22:29'),
(3, NULL, NULL, 9, 12, 'Teste 2', '0000-00-00 00:00:00', '2014-01-17 02:22:37'),
(4, NULL, NULL, 13, 14, 'Teste 3', '0000-00-00 00:00:00', '2014-01-17 02:22:45'),
(5, 9, 1, 2, 3, 'Sub-1', '0000-00-00 00:00:00', '2014-01-30 13:58:34'),
(6, 9, 1, 4, 5, 'Sub-2', '0000-00-00 00:00:00', '2014-01-30 13:58:55'),
(7, 8, 3, 10, 11, 'Sub-3', '0000-00-00 00:00:00', '2014-01-22 10:42:56'),
(9, NULL, NULL, 15, 16, 'Teste 4', '0000-00-00 00:00:00', '2014-01-17 02:22:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos_usuarios`
--

CREATE TABLE IF NOT EXISTS `grupos_usuarios` (
  `grupo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`grupo_id`,`usuario_id`),
  KEY `fk_grupo_has_usuario_usuario1_idx` (`usuario_id`),
  KEY `fk_grupo_has_usuario_grupo1_idx` (`grupo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupos_usuarios`
--

INSERT INTO `grupos_usuarios` (`grupo_id`, `usuario_id`) VALUES
(5, 1),
(5, 2),
(6, 2),
(5, 7),
(6, 7),
(5, 8),
(7, 8),
(6, 11),
(7, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lado_adesivos`
--

CREATE TABLE IF NOT EXISTS `lado_adesivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `lado_adesivos`
--

INSERT INTO `lado_adesivos` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Central', '2014-01-23 00:47:21', '2014-01-23 00:47:21'),
(2, 'Direito', '2014-01-23 00:47:27', '2014-01-23 00:47:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE IF NOT EXISTS `materiais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Latão', '2014-01-23 00:46:08', '2014-01-23 00:46:08'),
(2, 'Aço', '2014-01-23 00:46:13', '2014-01-23 00:46:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis`
--

CREATE TABLE IF NOT EXISTS `niveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
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
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE IF NOT EXISTS `notificacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_acao_id` int(11) NOT NULL,
  `criado_id` int(11) NOT NULL,
  `para_id` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `model_registro` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notificacoes_tipo_acoes1_idx` (`tipo_acao_id`),
  KEY `fk_notificacoes_usuarios1_idx` (`criado_id`),
  KEY `fk_notificacoes_usuarios2_idx` (`para_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `tipo_acao_id`, `criado_id`, `para_id`, `id_registro`, `model_registro`, `created`) VALUES
(7, 1, 1, 1, 1, 'Arquivo', '2014-01-31 02:59:07'),
(8, 1, 1, 2, 1, 'Arquivo', '2014-01-31 02:59:08'),
(9, 1, 1, 11, 2, 'Arquivo', '2014-01-31 11:15:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE IF NOT EXISTS `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `criou_id` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `model_registro` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_permissoes_usuarios1_idx` (`usuario_id`),
  KEY `fk_permissoes_usuarios2_idx` (`criou_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `usuario_id`, `criou_id`, `id_registro`, `model_registro`, `created`) VALUES
(6, 1, 1, 1, 'Arquivo', '2014-01-31 02:59:07'),
(7, 2, 1, 1, 'Arquivo', '2014-01-31 02:59:07'),
(8, 11, 1, 2, 'Arquivo', '2014-01-31 11:15:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_produto_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `rebaixo_id` int(11) DEFAULT NULL,
  `cor_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `lado_adesivo_id` int(11) DEFAULT NULL,
  `referencia` varchar(45) NOT NULL,
  `derivacao` varchar(200) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `comprimento` double(12,2) DEFAULT NULL,
  `valor` double(12,2) DEFAULT NULL,
  `ipi` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produtos_grupo1_idx` (`grupo_id`),
  KEY `fk_produtos_categoria1_idx` (`categoria_produto_id`),
  KEY `fk_produtos_rebaixos1_idx` (`rebaixo_id`),
  KEY `fk_produtos_cores1_idx` (`cor_id`),
  KEY `fk_produtos_materiais1_idx` (`material_id`),
  KEY `fk_produtos_lado_adesivos1_idx` (`lado_adesivo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `categoria_produto_id`, `grupo_id`, `rebaixo_id`, `cor_id`, `material_id`, `lado_adesivo_id`, `referencia`, `derivacao`, `descricao`, `comprimento`, `valor`, `ipi`, `created`, `modified`) VALUES
(1, 1, 1, 2, 4, 2, 2, '123', 'Fas-AS', 'Descrição qualquer', 234234.90, 24234.02, 23, '2014-01-23 01:35:23', '2014-01-23 01:39:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_unidade_medidas`
--

CREATE TABLE IF NOT EXISTS `produtos_unidade_medidas` (
  `produto_id` int(11) NOT NULL,
  `unidade_medida_id` int(11) NOT NULL,
  PRIMARY KEY (`produto_id`,`unidade_medida_id`),
  KEY `fk_produtos_has_unidade_medida_unidade_medida1_idx` (`unidade_medida_id`),
  KEY `fk_produtos_has_unidade_medida_produtos1_idx` (`produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos_unidade_medidas`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `rebaixos`
--

CREATE TABLE IF NOT EXISTS `rebaixos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `rebaixos`
--

INSERT INTO `rebaixos` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Padrão', '2014-01-23 00:49:46', '2014-01-23 00:49:46'),
(2, 'Flexotip', '2014-01-23 00:49:58', '2014-01-23 00:49:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_acoes`
--

CREATE TABLE IF NOT EXISTS `tipo_acoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tipo_acoes`
--

INSERT INTO `tipo_acoes` (`id`, `titulo`) VALUES
(1, 'Criou'),
(2, 'Reservou'),
(3, 'Retirou'),
(4, 'Agendou'),
(5, 'Editou'),
(6, 'Excluiu');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_enderecos`
--

CREATE TABLE IF NOT EXISTS `tipo_enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipo_enderecos`
--

INSERT INTO `tipo_enderecos` (`id`, `titulo`) VALUES
(1, 'Residencial'),
(2, 'Trabalho');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade_medidas`
--

CREATE TABLE IF NOT EXISTS `unidade_medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `unidade_medidas`
--

INSERT INTO `unidade_medidas` (`id`, `titulo`, `created`, `modified`) VALUES
(1, 'Metros', '2014-01-22 22:16:11', '2014-01-22 22:16:11'),
(2, 'Peças', '2014-01-22 22:16:18', '2014-01-22 22:16:18'),
(3, 'Unidades', '2014-01-22 22:16:24', '2014-01-22 22:16:24'),
(4, 'Quilos', '2014-01-22 22:16:30', '2014-01-22 22:16:30'),
(5, 'teste', '2014-02-05 15:14:05', '2014-02-05 15:14:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `login` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `ramal` varchar(45) DEFAULT NULL,
  `foto` varchar(200) NOT NULL,
  `assinatura` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nivel_id` (`nivel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nivel_id`, `status`, `login`, `nome`, `email`, `password`, `data_nascimento`, `telefone`, `celular`, `ramal`, `foto`, `assinatura`, `created`, `modified`) VALUES
(1, 1, 2, 'admin', 'Anderson Possamai', 'anderson@labbo.com.br', '87405bee18dedad74a532b425e16795b5a615f6f', '1985-09-15', '(12) 3123-1231', '(12) 3141-2312', '123123', '52ea95c302990.jpg', '52ea95f584628.jpg', '2013-10-28 00:50:07', '2014-01-31 02:39:35'),
(2, 3, 1, 'marcio', 'Márcio da Silva', 'marcio@email.com', '26d5e06be6e8967a98b894a2ec6469ecbc545769', '1980-01-07', '', '', '3532', '', '', '2013-10-28 01:13:50', '2014-01-31 01:06:29'),
(7, 3, 2, 'pedro', 'Pedro Paulo', 'pedro@email.com', '26d5e06be6e8967a98b894a2ec6469ecbc545769', '1983-01-12', '', '', '1212', '52f1bc9396a2f.jpg', '', '2013-11-11 16:57:04', '2014-02-05 02:22:43'),
(8, 2, 2, 'marcos', 'Marcos da Silva', 'marcos@marcos.com', '87405bee18dedad74a532b425e16795b5a615f6f', '1978-01-08', '', '', '4586', '', '', '2014-01-10 11:42:16', '2014-01-17 02:49:18'),
(9, 2, 2, 'gerente', 'Gerente Silva', 'gerente@gerente.com', '87405bee18dedad74a532b425e16795b5a615f6f', '1980-01-30', '', '', '1734', '52eaa03b22d6f.jpg', '', '2014-01-17 01:45:46', '2014-01-31 10:45:52'),
(11, 3, 2, 'teste', 'teste', 'teste@teste.com', '26d5e06be6e8967a98b894a2ec6469ecbc545769', '1982-01-26', '(12) 3456-7890', '(09) 8765-4321', '1111', '52ebb868c7575.jpg', '52ebb3b2e2484.jpg', '2014-01-17 03:14:12', '2014-01-31 12:51:20'),
(12, 1, 2, 'teste1', 'Teste', 'teste1@teste.com', '26d5e06be6e8967a98b894a2ec6469ecbc545769', NULL, '', '', '', '', '', '2014-02-05 10:37:27', '2014-02-05 10:37:27');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `fk_arquivos_categoria_arquivos1` FOREIGN KEY (`categoria_arquivo_id`) REFERENCES `categoria_arquivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_arquivos_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `cotacao_produtos`
--
ALTER TABLE `cotacao_produtos`
  ADD CONSTRAINT `fk_cotacao_has_produtos_cotacao` FOREIGN KEY (`cotacao_id`) REFERENCES `cotacoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cotacao_has_produtos_produtos1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `fk_enderecos_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_enderecos_tipo_enderecos1` FOREIGN KEY (`tipo_endereco_id`) REFERENCES `tipo_enderecos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `fk_grupo_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
  ADD CONSTRAINT `fk_grupo_has_usuario_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupo_has_usuario_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `fk_notificacoes_tipo_acoes1` FOREIGN KEY (`tipo_acao_id`) REFERENCES `tipo_acoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notificacoes_usuarios1` FOREIGN KEY (`criado_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notificacoes_usuarios2` FOREIGN KEY (`para_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD CONSTRAINT `fk_permissoes_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissoes_usuarios2` FOREIGN KEY (`criou_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categoria1` FOREIGN KEY (`categoria_produto_id`) REFERENCES `categoria_produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_cores1` FOREIGN KEY (`cor_id`) REFERENCES `cores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_lado_adesivos1` FOREIGN KEY (`lado_adesivo_id`) REFERENCES `lado_adesivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_materiais1` FOREIGN KEY (`material_id`) REFERENCES `materiais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_rebaixos1` FOREIGN KEY (`rebaixo_id`) REFERENCES `rebaixos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `produtos_unidade_medidas`
--
ALTER TABLE `produtos_unidade_medidas`
  ADD CONSTRAINT `fk_produtos_has_unidade_medida_produtos1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_has_unidade_medida_unidade_medida1` FOREIGN KEY (`unidade_medida_id`) REFERENCES `unidade_medidas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`nivel_id`) REFERENCES `niveis` (`id`);
