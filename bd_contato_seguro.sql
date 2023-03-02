-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Tempo de geração: 02/03/2023 às 10:51
-- Versão do servidor: 8.0.32
-- Versão do PHP: 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `contato_seguro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `companies`
--

CREATE TABLE `companies` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `cnpj` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `companies`
--

INSERT INTO `companies` (`id`, `name`, `cnpj`, `address`, `active`) VALUES
(1, 'Alameda Quality LTDA', '12.999.999/0001-02', 'Av Camboja, 3-870', 1),
(3, 'Tayu LTDA', '12.123.123/0003-03', 'R Domiciano Silva, 5-13', 0),
(4, 'Tauste LTDA', '12.123.123/1111-03', 'R Domiciano Silva, 5-13', 1),
(5, 'Brazuka LTDA', '12.123.123/1111-03', 'R Domiciano Silva, 5-13', 0),
(6, 'Cantinho LTDA', '12.123.123/1111-03', 'R Domiciano Silva, 5-13', 1),
(7, 'DDDDDDD LTDA', '12.123.123/1111-03', 'R Domiciano Silva, 5-13', 1),
(8, '||||||||||||||| LTDA', '12.123.123/1111-03', 'R Domiciano Silva, 5-13', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_city` varchar(100) DEFAULT NULL,
  `birth_state` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `birth_date`, `birth_city`, `birth_state`, `active`) VALUES
(1, 'Aloha', 'rangel@gmail.com', '(14)99645-6031', '2016-04-01', 'Bauru', 'SP', 0),
(15, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 0),
(16, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(19, 'a', 'a@a.com', '(14)99645-6031', '1991-08-19', 'Bauru', 'SP', 1),
(20, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(21, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(22, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(23, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(24, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(25, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(26, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(27, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(28, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(29, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(30, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(31, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(32, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(33, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(34, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(35, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(36, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(37, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(38, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(41, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(42, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(45, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(46, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 1),
(51, ' Gui', 'gui@gmail.com', '(14)99333-2222', '2017-04-01', 'Bauru', 'SP', 0),
(54, 'asdasd', '', '', NULL, '', '', 1),
(55, ' Gui', 'gui@gmail.com', '', '1991-08-19', 'Bauru', 'SP', 1),
(56, ' Gui', '', '', '1991-08-19', 'Bauru', 'SP', 1),
(57, 'null', 'null', 'null', NULL, 'null', 'null', 1),
(58, ' Gui', '', '', '1991-08-19', 'Bauru', 'SP', 1),
(59, 'asdasdasd', 'email@email.com', '', NULL, 'Bauru', 'SP', 0),
(60, 'asdasdasd', 'email@email.com', '', NULL, 'Bauru', 'SP', 1),
(61, 'asdasdasd', 'email@email.com', '', NULL, 'Bauru', 'SP', 1),
(62, 'asdasdasd', 'email@email.com', '', NULL, 'Bauru', 'SP', 1),
(63, 'Guigui', '123@123.com', '', NULL, '', '', 0),
(64, 'asdasdasd', 'email@email.com', '', NULL, 'Bauru', 'SP', 1),
(65, 'asdasdasd', 'email@email.com', '', NULL, 'Bauru', 'SP', 1),
(66, 'Guigui', '123@123.com', '', NULL, '', '', 1),
(68, 'gui', 'gui@gui.com', '', NULL, '', '', 1),
(69, 'gui', 'gui@gui.com', '', NULL, '', '', 1),
(70, 'gui', 'gui@gui.com', '', NULL, '', '', 1),
(71, 'gui', 'gui@gui.com', '', NULL, '', '', 1),
(72, 'asd', 'adasdas', '', NULL, '', '', 1),
(73, 'asdasd', 'asdasd', '', NULL, '', '', 1),
(74, 'sd', 'asd', '', NULL, '', '', 1),
(75, 'teste', 'teste@teste.com', '', NULL, '', '', 1),
(76, 'Guilherme', 'Felipe@teste.com', '(11)99872-2030', '1991-08-19', 'Bauru', 'SP', 0),
(77, 'Bruna da Silva Marques', 'bruna@gmail.com', '(18)98278-2039', '1991-08-19', 'Bauru', 'SP', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users_companies`
--

CREATE TABLE `users_companies` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `company_id` int NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `users_companies`
--

INSERT INTO `users_companies` (`id`, `user_id`, `company_id`, `active`) VALUES
(2, 1, 1, 1),
(4, 1, 3, 1),
(24, 15, 1, 1),
(28, 15, 3, 1),
(30, 15, 4, 1),
(40, 15, 5, 1),
(49, 51, 1, 1),
(50, 51, 4, 1),
(58, 54, 4, 1),
(59, 54, 5, 1),
(60, 55, 1, 1),
(61, 55, 4, 1),
(62, 56, 1, 1),
(63, 56, 4, 1),
(64, 58, 1, 1),
(65, 58, 4, 1),
(66, 59, 1, 1),
(67, 59, 4, 1),
(68, 60, 1, 1),
(69, 60, 4, 1),
(70, 61, 1, 1),
(71, 61, 4, 1),
(72, 62, 1, 1),
(73, 62, 4, 1),
(74, 63, 1, 1),
(75, 63, 4, 1),
(76, 64, 1, 1),
(77, 64, 4, 1),
(78, 65, 1, 1),
(79, 65, 4, 1),
(80, 66, 1, 1),
(81, 66, 4, 1),
(82, 66, 5, 1),
(83, 66, 6, 1),
(84, 68, 1, 1),
(85, 68, 4, 1),
(86, 68, 5, 1),
(87, 68, 6, 1),
(88, 69, 1, 1),
(89, 69, 4, 1),
(90, 69, 5, 1),
(91, 69, 6, 1),
(92, 70, 1, 1),
(93, 70, 4, 1),
(94, 70, 5, 1),
(95, 70, 6, 1),
(96, 71, 1, 1),
(97, 71, 4, 1),
(98, 71, 5, 1),
(99, 71, 6, 1),
(100, 72, 5, 1),
(101, 73, 4, 1),
(102, 74, 4, 1),
(103, 75, 4, 1),
(104, 75, 5, 1),
(105, 1, 6, 1),
(106, 76, 4, 1),
(107, 76, 6, 1),
(108, 76, 7, 1),
(109, 77, 4, 1),
(110, 77, 6, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users_companies`
--
ALTER TABLE `users_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_company` (`user_id`,`company_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `users_companies`
--
ALTER TABLE `users_companies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `users_companies`
--
ALTER TABLE `users_companies`
  ADD CONSTRAINT `users_companies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_companies_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
