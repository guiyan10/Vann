-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2024 às 14:27
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
-- Banco de dados: `banco_vann`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunocondutor`
--

CREATE TABLE `alunocondutor` (
  `id_aluno` int(11) NOT NULL,
  `nome_aluno` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `horarioentrada` varchar(20) NOT NULL,
  `horariosaida` varchar(20) NOT NULL,
  `destinoinicial` varchar(50) NOT NULL,
  `destinofinal` varchar(50) NOT NULL,
  `telefone_responsavel` varchar(20) NOT NULL,
  `valor_mensalidade` varchar(10) NOT NULL,
  `data_registro` varchar(10) NOT NULL,
  `status_rota` enum('Em andamento','Entregue') NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `fk_id_condutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunocondutor`
--

INSERT INTO `alunocondutor` (`id_aluno`, `nome_aluno`, `data_nasc`, `horarioentrada`, `horariosaida`, `destinoinicial`, `destinofinal`, `telefone_responsavel`, `valor_mensalidade`, `data_registro`, `status_rota`, `id_responsavel`, `fk_id_condutor`) VALUES
(40, 'Matheus Moreira de Souza ', '2024-06-17', '12:00', '18:00', '12050-720', '12050420', '12997116023', '500', '2024-05-20', 'Entregue', 51, 48),
(49, 'Guilherme', '2024-11-21', '06:00', '13:00', '12050-720', '12050-520', '12991992477', '500', '2024-11-27', 'Entregue', 51, 46),
(50, 'teste', '2024-11-07', '06:00', '12:00', '12050-720', '12050-520', '12991992477', '200', '2024-11-07', 'Entregue', 51, 52);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_usuario` int(100) NOT NULL,
  `nome_usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `imagem_perfil` varchar(255) NOT NULL,
  `nivel` enum('Condutor','Usuário','Administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `imagem_perfil`, `nivel`) VALUES
(46, 'Condutor', 'condutor@gmail.com', '$2y$10$PIyx2TNp0YPhAfxeQE7Z4eyLqhpj2TynlvpJnwk1Ta3wreurnOdZ2', '', 'Condutor'),
(48, 'sss', 'sss@gmail.com', '$2y$10$liMjZ8zN.Nq/axFsDbbrc.sY6laZdCf7tgCbV0xW1Jy2l2YBRsmoG', '', 'Condutor'),
(50, 'yan', 'adm@gmail.com', '$2y$10$v9NtjsIrlkGJTfkkx6xZcOnsHYoPeYeuijc0NOdq71inJRGU4PKCG', '', 'Administrador'),
(51, 'caue', 'usuario@gmail.com', '$2y$10$xDC/AeShX2CajPD8a1sVJuH5Ud5dIMwrDxkDnF56rD92WrEPE3Mm6', '', 'Usuário'),
(52, 'wilber', 'wilber@gmail.com', '$2y$10$XxSYAmnZwY8EWUdZRHkbvOgsLgOEStBVgtcPweDQhoaiP8xz8chIC', '', 'Condutor'),
(53, 'caue-teste', 'testecaue@gmail.com', '$2y$10$lhbCeq3lb1eQjWjAgX.iAu5ddLvIQ3TvUvZDLleKOtUnxJ9Z5p9Le', '', 'Condutor'),
(54, 'Wilber', 'Wilber@gmail.com', '$2y$10$Yt/w7U3fnoLLEa0801Z9JumIsI1hwz4S7PGHQNo3bXlHBLt5q67TO', '', 'Usuário');

-- --------------------------------------------------------

--
-- Estrutura para tabela `condutor`
--

CREATE TABLE `condutor` (
  `id_condutor` int(100) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cnh` varchar(50) NOT NULL,
  `documento_veiculo` varchar(50) NOT NULL,
  `comprovante_taxas` varchar(50) NOT NULL,
  `data_condutor` varchar(15) NOT NULL,
  `cpf_condutor` varchar(11) NOT NULL,
  `rg_condutor` varchar(20) NOT NULL,
  `vistoria_condutor` varchar(50) NOT NULL,
  `bairro_condutor` varchar(50) NOT NULL,
  `escola_condutor` varchar(50) NOT NULL,
  `cidade_condutor` varchar(50) NOT NULL,
  `telefone_condutor` varchar(11) NOT NULL,
  `fk_id_condutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `condutor`
--

INSERT INTO `condutor` (`id_condutor`, `nome`, `cnh`, `documento_veiculo`, `comprovante_taxas`, `data_condutor`, `cpf_condutor`, `rg_condutor`, `vistoria_condutor`, `bairro_condutor`, `escola_condutor`, `cidade_condutor`, `telefone_condutor`, `fk_id_condutor`) VALUES
(4, 'caue', '12345678', '1212121221', '12312321', '12', '123232', '2121212', '121', 'estiva', 'sesi', 'o', '', 46),
(5, 'Matheus Moreira de Souza ', '4312', '3123sdfs', 'sdfs', '4334-03', '234', '2342', '42', 'estiva', 'sesi', 'taubate', '4234', 48),
(6, 'Yan', '12254568774', '125478451', '125478965', '2024-09-10', '12207895825', '569911072', '12545', 'São Gonçalo', 'Sedes', '', '12991992477', 46);

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncia`
--

CREATE TABLE `denuncia` (
  `id_denuncia` int(11) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `descricao_usuario` enum('Mal comportamento','Problemas na plataforma','Problemas com condutor','Rotas diferentes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `denuncia`
--

INSERT INTO `denuncia` (`id_denuncia`, `nome_usuario`, `email_usuario`, `descricao_usuario`) VALUES
(2, 'kleber', 'soteocaue@gmail.com', 'Mal comportamento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `info_usuario`
--

CREATE TABLE `info_usuario` (
  `endereco_condutor` varchar(50) NOT NULL,
  `cidade_condutor` varchar(50) NOT NULL,
  `pais_condutor` varchar(50) NOT NULL,
  `sobre_condutor` varchar(50) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `info_usuario`
--

INSERT INTO `info_usuario` (`endereco_condutor`, `cidade_condutor`, `pais_condutor`, `sobre_condutor`, `fk_id_usuario`) VALUES
('Rua Doutor Adélio da Silva, 90', 'Taubaté-SP', 'Brasil', 'Sou um bom condutor', 46),
('ss', 'ss', 'Sudão do Sul', 'sss', 48),
('ss', 'ss', 'Brasil', 'sou adm e adoro a vann', 50),
('ss', 'ss', 'sss', 'sss', 51),
('Rua senai', 'Taubaté-SP', 'Brasil', 'sensacional', 52);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunocondutor`
--
ALTER TABLE `alunocondutor`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `alunocondutor_ibfk_1` (`fk_id_condutor`);

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices de tabela `condutor`
--
ALTER TABLE `condutor`
  ADD PRIMARY KEY (`id_condutor`),
  ADD KEY `fk_id_condutor` (`fk_id_condutor`);

--
-- Índices de tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`id_denuncia`);

--
-- Índices de tabela `info_usuario`
--
ALTER TABLE `info_usuario`
  ADD KEY `fk_id_usuario` (`fk_id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunocondutor`
--
ALTER TABLE `alunocondutor`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `condutor`
--
ALTER TABLE `condutor`
  MODIFY `id_condutor` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alunocondutor`
--
ALTER TABLE `alunocondutor`
  ADD CONSTRAINT `alunocondutor_ibfk_1` FOREIGN KEY (`fk_id_condutor`) REFERENCES `cadastro` (`id_usuario`);

--
-- Restrições para tabelas `condutor`
--
ALTER TABLE `condutor`
  ADD CONSTRAINT `condutor_ibfk_1` FOREIGN KEY (`fk_id_condutor`) REFERENCES `cadastro` (`id_usuario`);

--
-- Restrições para tabelas `info_usuario`
--
ALTER TABLE `info_usuario`
  ADD CONSTRAINT `info_usuario_ibfk_1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `cadastro` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
