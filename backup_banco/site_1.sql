-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Abr-2023 às 22:54
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `site_1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.usuarios`
--

DROP TABLE IF EXISTS `tb_admin.usuarios`;
CREATE TABLE IF NOT EXISTS `tb_admin.usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cargo` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `capa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `nome`, `sobrenome`, `password`, `cargo`, `img`, `capa`) VALUES
(1, 'admin', 'Administrador', '', 'admin', 2, '641f3a2026522.jpg', '641f3a2c26d58.jpg'),
(39, 'himym', 'How I Met', 'Your Mother', '123', 0, '641a370d212fa.jpg', '641a3718e1b3d.jpeg'),
(40, 'tec', 'Olhos', 'Tech', '123', 0, '641a393a9b327.jpg', '641a392fe062f.jpg'),
(41, 'mark', 'Mark', 'Zuckerberg', '123', 0, '641a3c2e6fa12.png', '641a3cf9cbd37.png'),
(42, 'ramon', 'Ramon', 'Teste', '123', 0, '641a3e9be7570.jpg', '641a3ea284f42.jpg'),
(43, 'mon', 'Ramon', 'Barbosa', '123', 0, '641a4d2b44b9f.jpg', '641a4d342b76c.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.categoria`
--

DROP TABLE IF EXISTS `tb_site.categoria`;
CREATE TABLE IF NOT EXISTS `tb_site.categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(11) NOT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.categoria`
--

INSERT INTO `tb_site.categoria` (`id`, `nome`, `slug`, `order_id`) VALUES
(2, 'Tech', 'tech', 0),
(3, 'Outros', 'outros', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.comentario`
--

DROP TABLE IF EXISTS `tb_site.comentario`;
CREATE TABLE IF NOT EXISTS `tb_site.comentario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_noticia` int NOT NULL,
  `id_user` int NOT NULL,
  `nome_user` varchar(255) NOT NULL,
  `img_user` varchar(255) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.comentario`
--

INSERT INTO `tb_site.comentario` (`id`, `id_noticia`, `id_user`, `nome_user`, `img_user`, `comentario`, `data`) VALUES
(65, 56, 43, 'Ramon', '641a4d2b44b9f.jpg', 'Não acho isso.', '2023-03-22'),
(66, 56, 39, 'How I Met', '641a370d212fa.jpg', 'Ironicio viu kkkkk', '2023-03-23'),
(67, 56, 43, 'Ramon', '641a4d2b44b9f.jpg', 'Hahah', '2023-03-25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.noticias`
--

DROP TABLE IF EXISTS `tb_site.noticias`;
CREATE TABLE IF NOT EXISTS `tb_site.noticias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `capa` varchar(255) NOT NULL,
  `order_id` int NOT NULL,
  `slug` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_site.noticias`
--

INSERT INTO `tb_site.noticias` (`id`, `categoria_id`, `titulo`, `conteudo`, `capa`, `order_id`, `slug`, `data`, `id_user`) VALUES
(50, 0, '', 'Frase para começar o dia!', '641a387793597.jpg', 0, '', '2023-03-21', 39),
(51, 0, '', 'GPT-4 é nova plataforma do ChatGPT que aceita imagens', '641a39949648a.jpg', 0, '', '2023-03-21', 40),
(52, 0, '', 'Essa frase é muito boa', '641a3a9b8fc5e.jpeg', 0, '', '2023-03-21', 39),
(54, 0, '', 'Como funcionam as pulseiras eletrônicas dos shows do Coldplay?', '641a3b5f78c4e.jpg', 0, '', '2023-03-21', 40),
(56, 0, '', 'Esse site é muito familiar, não acham?', '', 0, '', '2023-03-21', 41),
(57, 0, '', 'GTA 6 tem imagem vazada; veja como pode ser o gráfico final', '641a3df103203.jpg', 0, '', '2023-03-21', 40),
(59, 0, '', 'Testando pelo celular ', '', 0, '', '2023-03-25', 43),
(60, 0, '', 'Eu sou gato', '', 0, '', '2023-03-30', 43);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
