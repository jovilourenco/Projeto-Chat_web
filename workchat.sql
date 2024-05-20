-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/05/2024 às 02:56
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `workchat`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `Sender` int(11) NOT NULL,
  `Receiver` int(11) NOT NULL,
  `Message` varchar(500) NOT NULL,
  `Image` varchar(1000) NOT NULL,
  `Creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chat`
--

INSERT INTO `chat` (`id`, `Sender`, `Receiver`, `Message`, `Image`, `Creation`) VALUES
(1, 9, 10, 'Oi', '', '2024-04-21 15:12:06'),
(2, 9, 10, 'Tudo bem?', '', '2024-04-21 15:13:46'),
(3, 9, 10, 'Meu nome é João.', '', '2024-04-21 15:13:56'),
(4, 10, 9, 'Oi. Meu nome é Larissa', '', '2024-04-21 15:14:13'),
(5, 9, 10, 'Oi, Larissa', '', '2024-04-21 15:14:41'),
(6, 10, 9, 'Tudo bem com você?', '', '2024-04-21 15:16:32'),
(7, 9, 10, 'Teste', '', '2024-04-21 21:12:32'),
(8, 9, 10, 'teste2', '', '2024-04-22 17:15:53'),
(9, 9, 10, '', 'jolouren_MESSAGE_304211image.png', '2024-04-29 01:12:31'),
(10, 9, 10, '', 'jolouren_MESSAGE_765485teste.jpg', '2024-04-29 01:17:19'),
(11, 9, 10, 'Nossa, olha que fofo', '', '2024-04-29 01:17:28'),
(12, 9, 10, 'É seu?7', '', '2024-04-29 01:19:45'),
(13, 9, 10, 'Nossa', '', '2024-04-29 01:30:22'),
(14, 9, 10, 'oi', '', '2024-04-29 02:05:02'),
(15, 10, 9, 'Oi', '', '2024-05-05 02:33:02'),
(16, 10, 9, 'f', '', '2024-05-05 02:42:56'),
(17, 10, 9, 'gf', '', '2024-05-05 02:42:58'),
(18, 10, 9, 'Oi', '', '2024-05-06 17:00:59'),
(19, 10, 9, 'Oi', '', '2024-05-06 17:01:00'),
(20, 10, 9, 'Teste de implementação', '', '2024-05-06 17:01:11'),
(21, 10, 9, '', 'lartorre_MESSAGE_868509teste_ai.png', '2024-05-06 17:01:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `MainUser` int(11) NOT NULL,
  `OtherUser` int(11) NOT NULL,
  `Unread` varchar(1) NOT NULL DEFAULT 'n',
  `Modification` timestamp NOT NULL DEFAULT current_timestamp(),
  `Creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `conversations`
--

INSERT INTO `conversations` (`id`, `MainUser`, `OtherUser`, `Unread`, `Modification`, `Creation`) VALUES
(17, 9, 10, 'y', '2024-04-21 15:12:06', '2024-04-21 15:12:06'),
(18, 10, 9, 'n', '2024-04-21 15:12:06', '2024-04-21 15:12:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Username` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Picture` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user.jpg',
  `Online` datetime NOT NULL,
  `Token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Secure` bigint(20) NOT NULL,
  `Creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`Id`, `Username`, `Password`, `Email`, `Picture`, `Online`, `Token`, `Secure`, `Creation`) VALUES
(9, 'jolouren', '$2y$10$osvi3UpSLF/.QborU57lxOPLRkA5Aml/KWT5kbpCFWx4cqxscE70C', 'pessoal.jvls@gmail.com', 'jolouren_359283teste2.jpg', '2024-04-29 02:27:40', '0a93c92b18d2eec6b41ff3b41052887aae485582f4bce2ff6dafd3d4', 838044, '2024-04-11 03:54:38'),
(10, 'lartorre', '$2y$10$x8OAJzzQ8Qzw3NY67sMLg.Qy7dx4mjGnBLupzbAnHw4x82tOtSkde', 'larissatt.araruna@gmail.com', 'lartorre_50993120231117_095130.jpg', '2024-05-07 01:22:39', '07702d171303efc2c2f5f0b50c71edb04c11aea5d76f7d7d6904d0aa', 143932, '2024-04-18 21:48:07');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
