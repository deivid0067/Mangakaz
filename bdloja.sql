-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Nov-2022 às 15:54
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdloja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

CREATE TABLE `tbcategoria` (
  `idcategoria` int(11) NOT NULL,
  `nomecategoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcategoria`
--

INSERT INTO `tbcategoria` (`idcategoria`, `nomecategoria`) VALUES
(3, 'ação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcliente`
--

CREATE TABLE `tbcliente` (
  `idcliente` int(11) NOT NULL,
  `nomecliente` varchar(60) DEFAULT NULL,
  `cpfcliente` varchar(15) DEFAULT NULL,
  `emailcliente` varchar(50) DEFAULT NULL,
  `senhacliente` varchar(255) DEFAULT NULL,
  `logradourocliente` varchar(40) DEFAULT NULL,
  `numlogcliente` int(11) DEFAULT NULL,
  `compcliente` varchar(50) DEFAULT NULL,
  `bairrocliente` varchar(50) DEFAULT NULL,
  `cidadecliente` varchar(50) DEFAULT NULL,
  `ufcliente` varchar(50) DEFAULT NULL,
  `cepcliente` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcliente`
--

INSERT INTO `tbcliente` (`idcliente`, `nomecliente`, `cpfcliente`, `emailcliente`, `senhacliente`, `logradourocliente`, `numlogcliente`, `compcliente`, `bairrocliente`, `cidadecliente`, `ufcliente`, `cepcliente`) VALUES
(16, 'Vanessa Ferraz', '111.222.333-96', 'vanessa@gmail.com', '$2y$10$eN5kR07IdSczWMd3iNd7..wyP6Ko.y/mPbFDZS0IykwnlzMDsn3D2', 'Rua Feliciano de Mendonça', 290, '', 'Jardim São Paulo(Zona Leste)', 'São Paulo', 'SP', '08460-365');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbitemvenda`
--

CREATE TABLE `tbitemvenda` (
  `iditemvenda` int(11) NOT NULL,
  `idvenda` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `qtdeitemvenda` int(20) DEFAULT NULL,
  `subtotalitemvenda` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbitemvenda`
--

INSERT INTO `tbitemvenda` (`iditemvenda`, `idvenda`, `idproduto`, `qtdeitemvenda`, `subtotalitemvenda`) VALUES
(2, 25, 21, 1, 50),
(3, 25, 15, 1, 50),
(4, 26, 15, 1, 50),
(5, 26, 23, 1, 8),
(6, 26, 22, 1, 50),
(7, 27, 13, 1, 50),
(8, 27, 15, 1, 50),
(9, 27, 16, 2, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `idproduto` int(11) NOT NULL,
  `nomeproduto` varchar(60) DEFAULT NULL,
  `precoproduto` float DEFAULT NULL,
  `idcategoria` int(11) NOT NULL,
  `fotoproduto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`idproduto`, `nomeproduto`, `precoproduto`, `idcategoria`, `fotoproduto`) VALUES
(13, 'Chainsaw Man Vol 1', 50, 3, 'images/products/51BeRXEKuWL.jpg'),
(15, 'Chainsaw Man Vol 5', 50, 3, 'images/products/9119ST+olGL.jpg'),
(16, 'Chainsaw Man Vol 3', 50, 3, 'images/products/51T3BA1TRHL.jpg'),
(21, 'Chainsaw Man Vol 2', 50, 3, 'images/products/aaa.jpg'),
(22, 'Chainsaw Man Vol 4', 50, 3, 'images/products/81ww5rFJirL.jpg'),
(23, 'Naruto', 8, 3, 'images/products/naruto.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvenda`
--

CREATE TABLE `tbvenda` (
  `idVenda` int(11) NOT NULL,
  `datavenda` date DEFAULT NULL,
  `valortotalvenda` float DEFAULT NULL,
  `statusvenda` varchar(30) NOT NULL,
  `idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbvenda`
--

INSERT INTO `tbvenda` (`idVenda`, `datavenda`, `valortotalvenda`, `statusvenda`, `idcliente`) VALUES
(25, '2022-11-29', 100, '5', 16),
(26, '2022-11-29', 108, '4', 16),
(27, '2022-11-29', 200, '3', 16);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Índices para tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Índices para tabela `tbitemvenda`
--
ALTER TABLE `tbitemvenda`
  ADD PRIMARY KEY (`iditemvenda`),
  ADD KEY `fk_idvenda` (`idvenda`),
  ADD KEY `fk_idproduto` (`idproduto`);

--
-- Índices para tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`idproduto`),
  ADD KEY `fk_idcategoria` (`idcategoria`);

--
-- Índices para tabela `tbvenda`
--
ALTER TABLE `tbvenda`
  ADD PRIMARY KEY (`idVenda`),
  ADD KEY `fk_idcliente` (`idcliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tbitemvenda`
--
ALTER TABLE `tbitemvenda`
  MODIFY `iditemvenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tbvenda`
--
ALTER TABLE `tbvenda`
  MODIFY `idVenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
