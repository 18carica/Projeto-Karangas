-- Criação do banco de dados karangas, se não existir
CREATE DATABASE IF NOT EXISTS karangas;

-- Selecionando o banco de dados karangas para operações subsequentes
USE karangas;

-- Criação da tabela de Tipos de Veículos
CREATE TABLE IF NOT EXISTS TIPOSVEICULOS (
    IdTipo INT AUTO_INCREMENT PRIMARY KEY,
    Tipo_Veiculo VARCHAR(50)
);

-- Criação da tabela de Marcas
CREATE TABLE IF NOT EXISTS MARCAS_VEICULOS (
    IdMarca INT AUTO_INCREMENT PRIMARY KEY,
    Marca VARCHAR(255) NOT NULL
);

-- Criação da tabela de Clientes
CREATE TABLE IF NOT EXISTS CLIENTES (
    IdCli INT AUTO_INCREMENT PRIMARY KEY,
    Tipo_Cliente VARCHAR(2) NULL,
    Documento VARCHAR(20) NULL,
    Nome VARCHAR(100) NULL,
    Email VARCHAR(100) NULL,
    Telefone VARCHAR(20) NULL,
    Endereco VARCHAR(255) NULL,
    Complemento VARCHAR(100) NULL,
    Bairro VARCHAR(50) NULL,
    Obs TEXT NULL,
    Dt_Criacao DATETIME NULL,
    Dt_Alt DATETIME NULL,
    Situacao TINYINT
);

-- Adicionando uma restrição de verificação para TipoCliente para garantir que só pode ser 'PJ' ou 'PF'
ALTER TABLE CLIENTES ADD CONSTRAINT CHK_TipoCliente CHECK (Tipo_Cliente IN ('PJ', 'PF'));

-- Adicionando uma restrição de verificação para Documento para garantir que só pode ser 'CPF' ou 'CNPJ' dependendo do TipoCliente
ALTER TABLE CLIENTES ADD CONSTRAINT CHK_Documento CHECK (
    (Tipo_Cliente = 'PF' AND Documento = 'CPF') OR 
    (Tipo_Cliente = 'PJ' AND Documento = 'CNPJ')
);

-- Adicionando uma restrição de verificação para Situacao para garantir que só pode ser 0 (INATIVO) ou 1 (ATIVO)
ALTER TABLE CLIENTES ADD CONSTRAINT CHK_Situacao CHECK (Situacao IN (0, 1));

-- Criação da tabela de Veículos
CREATE TABLE IF NOT EXISTS VEICULOS (
    IdVeic INT AUTO_INCREMENT PRIMARY KEY,
    IdTipo INT NULL,
    IdMarca INT NULL,
    IdCli INT NULL,
    Modelo VARCHAR(50) NULL,
    Ano_Fab INT NULL,
    Ano_Mod INT NULL,
    km INT NULL,
    Renavan VARCHAR(11) NULL,
    Placa VARCHAR(7) NULL,
    Cor CHAR(20) NULL,
    Combustivel CHAR(20) NULL,
    Cambio CHAR(20) NULL,
    Categoria CHAR(20) NULL,
    Portas INT NULL,
    ValorIn DECIMAL(10,2),
    ValorOut DECIMAL(10,2)
);

-- Criação da tabela de Acessórios de Veículos
CREATE TABLE IF NOT EXISTS VEICULOS_ACESSORIO (
    Idvc INT AUTO_INCREMENT PRIMARY KEY,
    IdVeic INT NULL,
    Vidro_eletrico CHAR(2) NULL,
    Ar_Condicionado CHAR(2) NULL,
    Bancos CHAR(2) NULL
);

-- Criação da tabela de Fotos dos Veículos
CREATE TABLE IF NOT EXISTS VEICULOS_FOTOS (
    IdFoto INT AUTO_INCREMENT PRIMARY KEY,
    IdVeic INT,
    Caminho_Foto VARCHAR(255),
    FOREIGN KEY (IdVeic) REFERENCES VEICULOS(IdVeic)
);

-- Inserção de dados na tabela de Tipos de Veículos
INSERT INTO TIPOSVEICULOS (IdTipo, Tipo_Veiculo) VALUES
(1, 'Carros'),
(2, 'Motos'),
(3, 'MotorHome'),
(4, 'Caminhao'),
(5, 'JetSki');

-- Inserção de dados na tabela de Marcas
INSERT INTO MARCAS_VEICULOS (IdMarca, Marca) VALUES
(1, 'Honda'),
(2, 'Fiat'),
(3, 'Volkswagen'),
(4, 'Ford'),
(5, 'BMW'),
(6, 'GM');

-- Inserção de dados na tabela de Clientes
INSERT INTO CLIENTES (IdCli, Tipo_Cliente, Documento, Nome) VALUES
(1, 'PF', 'CPF', 'Ze Ruela');

-- Inserção de dados na tabela de Veículos
INSERT INTO VEICULOS (IdVeic, IdTipo, IdMarca, IdCli, Modelo, Renavan, Placa, Cor, Combustivel, Cambio, Categoria, Portas, Ano_Fab, Ano_Mod, ValorIn, ValorOut) VALUES
(1, 1, 2, 1, 'Linga', '12345678911', 'XXX9X99', 'Preto', 'Gasolina', 'Manual', 'Sedan', 4, 2014, 2014, 29000.00, 35000.00),
(2, 2, 1, 1, 'Linga', '32165498799', 'XXX0X00', 'Cinza', 'Flex', 'Automático', 'SUV', 5, 2014, 2014, 29000.00, 35000.00);

-- Selecionando todos os dados da tabela de Tipos de Veículos
SELECT * FROM TIPOSVEICULOS;

-- Selecionando todos os dados da tabela de Marcas
SELECT * FROM MARCAS_VEICULOS;

-- Selecionando todos os dados da tabela de Veículos
SELECT * FROM VEICULOS;

-- Selecionando todos os dados da tabela de Fotos Veículos
SELECT * FROM VEICULOS_FOTOS;

-- Selecionando todos os dados da tabela de Clientes
SELECT * FROM CLIENTES;

-- Selecionando todos os dados da tabela de Acessórios de Veículos
SELECT * FROM VEICULOS_ACESSORIO;

-- Selecionando dados específicos da tabela de Veículos, juntamente com informações relacionadas de Marcas, Tipos de Veículos, Clientes e Acessórios de Veículos
SELECT V.IdVeic, 
       TV.Tipo_Veiculo, 
       MV.Marca, 
       V.Modelo, 
       V.Ano_Fab, 
       V.Ano_Mod, 
       V.ValorIn, 
       V.ValorOut, 
       C.Nome AS NomeCliente,
       VA.Vidro_eletrico,
       VA.Ar_Condicionado,
       VA.Bancos
FROM VEICULOS V
JOIN TIPOSVEICULOS TV ON V.IdTipo = TV.IdTipo
JOIN MARCAS_VEICULOS MV ON V.IdMarca = MV.IdMarca
JOIN CLIENTES C ON V.IdCli = C.IdCli
LEFT JOIN VEICULOS_ACESSORIO VA ON V.IdVeic = VA.IdVeic;



