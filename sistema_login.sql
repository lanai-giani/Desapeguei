-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/07/2025 às 07:56
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_login`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `estado` enum('novo','usado') NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagens` text DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `subcategoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `usuario_id`, `titulo`, `descricao`, `estado`, `categoria`, `preco`, `imagens`, `data_criacao`, `subcategoria`) VALUES
(12, 1, 'Body Infantil azul', 'Body Infantil azul de algodão', 'novo', 'kids', 23.90, '685f0bc3989ef_body_bebe_algodao_manga_curta_gola_americana_branco_comfort_13973_1_507729b51520db4858a4d6e93a55282d_20250610141955.webp', '2025-06-27 18:23:15', 'body'),
(13, 1, 'Notebook Acer Aspire 3 ', 'Notebook Acer Aspire 3 Intel Pentium 4417U 4GB 500GB HD A315-53-P884', 'usado', 'eletronicos', 875.99, '685f0da88bdee_notebook_acer_aspire_3_intel_pentium_4417u_4gb_500gb_hd_a315_53_p884_usado_9049_1_c5a78ac9a4c78421d7d76a576e905a97.webp', '2025-06-27 18:31:20', 'notebook'),
(14, 1, 'Salto alto ', 'Salto alto preto em ótimas condições', 'usado', 'calcados', 45.99, '685f0eea4cda7_29-1_640x640+fill_ffffff.png', '2025-06-27 18:36:42', 'salto'),
(15, 1, 'Bolsa bege nova', 'nunca usada, de couro sintético', 'novo', 'bolsas', 22.50, '685f117f190b1_br-11134207-7r98o-lzexsnpqcyf5fe.jpg', '2025-06-27 18:47:43', 'carteira'),
(16, 1, 'Gloss Romand', 'Gloss Romand cor 01 Peony Ballet\r\nUsado apenas uma vez', 'usado', 'beleza', 50.00, '685f132613e08_6abc028a8b9a3a68849e77e9ef6f05d951e89f5e_original.jpeg', '2025-06-27 18:54:46', 'maquiagem'),
(18, 1, 'O corvo', 'Livro de Edgar Allan Poe', 'usado', 'livros', 20.00, '6866f11690e64_1xg.avif', '2025-07-03 18:07:34', 'terror'),
(20, 1, 'Top de alça xadrez', 'Top tamanho M', 'usado', 'vestuario', 49.99, '68677a684ed08_Design sem nome.jpg', '2025-07-04 03:53:28', 'camisa'),
(22, 1, 'Anel Life Maxi IV Vivara', 'Anel Life Maxi IV Ondas em Prata 925 com Pedras Incolores, 7.3mm\r\ntamanho 20', 'usado', 'acessorios', 219.99, '6869e3ad72444_d74cf30a-e8f3-48ae-9654-29145d4909f0.jpg', '2025-07-05 23:47:09', 'joias'),
(23, 1, 'Colar Life Colors Romanel', 'Colar Life Colors II em Prata 925 com Cristais Rosas e Roxos, 40cm', 'usado', 'acessorios', 132.99, '6869e42e5a9cf_71a98cee-86b7-41f4-8222-31badad6fbdd.jpg', '2025-07-05 23:49:18', 'colar'),
(25, 3, 'Tênis Adidas', 'Tênis Adidas Campus 00s tamanho 42', 'usado', 'calcados', 98.00, '686b5e60c5e2b_campus.jpg', '2025-07-07 02:42:56', 'tenis');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `google_id` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expira` datetime DEFAULT NULL,
  `apelido` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`, `google_id`, `reset_token`, `reset_expira`, `apelido`) VALUES
(1, 'Lanai Giani Lima Oliveira', 'lanaigiani10@gmail.com', '$2y$10$mj9ATAObdTHWG20fYniW0uzfjnceEZupNBbKSqzLxxfFMcbsnx6Oy', '2025-06-17 21:28:49', NULL, NULL, NULL, NULL),
(2, 'Kauai Enzo', 'kauaienzo@gmail.com', '$2y$10$vmKCy3gseXoIf/IQeb4geeZqjDuSRUGYH8BQGcQluw2X0MtZZROf2', '2025-06-17 21:30:43', NULL, NULL, NULL, NULL),
(3, 'Lanai Giani Lima Oliveira', 'lanaigiani11@gmail.com', '$2y$10$iFsQiUAD/tRxZ8/jsYlWqeZmZ80v8gsL6gaiQ15Ye6axqQK8t4K.6', '2025-06-17 23:02:01', NULL, '406a07b83febb7888be98ba6a95e6af9d1219d0eb488bff6588ea2ddf281cebe', '2025-07-06 06:49:11', NULL),
(4, 'Kauai Enzo', 'kauaienzo10@gmail.com', '$2y$10$6Vb2nr9nrfxicZvYbdg7M.oT6NbXtRsbkvtYfiFbxcxKJ19rnlFpG', '2025-06-28 00:10:36', NULL, NULL, NULL, NULL),
(5, 'Lanai Giani Lima Oliveira', 'giani.lanai08@aluno.ifce.edu.br', '', '2025-07-04 01:36:41', NULL, NULL, NULL, 'Lanai');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
