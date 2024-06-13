-- Criação do banco de dados karangas, se não existir
CREATE DATABASE IF NOT EXISTS karangas;

-- Selecionando o banco de dados karangas para operações subsequentes
USE karangas;

-- Criação da tabela de Tipos de Veículos
CREATE TABLE IF NOT EXISTS TIPOSVEICULOS (
    IdTipo INT PRIMARY KEY,
    Tipo_Veiculo VARCHAR(50)
);

-- Inserção de dados na tabela de Tipos de Veículos
INSERT INTO TIPOSVEICULOS (IdTipo, Tipo_Veiculo) VALUES
(1, 'Carros'),
(2, 'Motos'),
(3, 'MotorHome'),
(4, 'Caminhao'),
(5, 'JetSki');

-- Criação da tabela de Marcas
CREATE TABLE IF NOT EXISTS MARCAS_VEICULOS (
    IdMarca INT PRIMARY KEY,
    Marca VARCHAR(50)
);

-- Inserção de dados na tabela de Marcas
INSERT INTO MARCAS_VEICULOS (IdMarca, Marca) VALUES
(1, 'Honda'),
(2, 'Fiat'),
(3, 'Volkswagen'),
(4, 'Ford'),
(5, 'BMW'),
(6, 'GM');

-- Criação da tabela de Clientes
CREATE TABLE IF NOT EXISTS CLIENTES (
    IdCli INT PRIMARY KEY,
    Tipo_Cliente VARCHAR(2),
    Documento VARCHAR(20),
    Nome VARCHAR(100),
    Email VARCHAR(100),
    Telefone VARCHAR(20),
    Endereco VARCHAR(255),
    Complemento VARCHAR(100),
    Bairro VARCHAR(50),
    Obs TEXT,
    Dt_Criacao DATETIME,
    Dt_Alt DATETIME,
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

-- Inserção de dados na tabela de Clientes
INSERT INTO CLIENTES (IdCli, Tipo_Cliente, Documento, Nome) VALUES
(1, 'PF', 'CPF', 'Ze Ruela');

-- Criação da tabela de Veículos
CREATE TABLE IF NOT EXISTS VEICULOS (
    IdVeic INT PRIMARY KEY,
    IdTipo INT,
    IdMarca INT,
    IdCli INT,
    Modelo VARCHAR(50),
    Ano_Fab INT,
    Ano_Mod INT,
    Renavan VARCHAR(11),
    Placa VARCHAR(7),
    Cor CHAR(20),
    Combustivel CHAR(20),
    Cambio CHAR(20),
    Categoria CHAR(20),
    Portas INT,
    ValorIn DECIMAL(10,2),
    ValorOut DECIMAL(10,2),
    FOREIGN KEY (IdTipo) REFERENCES TIPOSVEICULOS(IdTipo),
    FOREIGN KEY (IdMarca) REFERENCES MARCAS_VEICULOS(IdMarca),
    FOREIGN KEY (IdCli) REFERENCES CLIENTES(IdCli)
);

-- Inserção de dados na tabela de Veículos
INSERT INTO VEICULOS (IdVeic, IdTipo, IdMarca, IdCli, Modelo, Renavan, Placa, Cor, Combustivel, Cambio, Categoria, Portas, Ano_Fab, Ano_Mod, ValorIn, ValorOut) VALUES
(1, 1, 2, 1, 'Linga', '12345678911', 'XXX9X99', 'Preto', 'Gasolina', 'Manual', 'Sedan', 4, 2014, 2014, 29000.00, 35000.00),
(2, 2, 1, 1, 'Linga', '32165498799', 'XXX0X00', 'Cinza', 'Flex', 'Automático', 'SUV', 5, 2014, 2014, 29000.00, 35000.00);

-- Criação da tabela de Acessórios de Veículos
CREATE TABLE IF NOT EXISTS VEICULOS_ACESSORIO (
    Idvc INT PRIMARY KEY,
    IdVeic INT,
    Vidro_eletrico CHAR(2),
    Ar_Condicionado CHAR(2),
    Bancos CHAR(2),
    FOREIGN KEY (IdVeic) REFERENCES VEICULOS(IdVeic)
);

-- Selecionando todos os dados da tabela de Marcas
SELECT * FROM MARCAS_VEICULOS;

-- Selecionando todos os dados da tabela de Tipos de Veículos
SELECT * FROM TIPOSVEICULOS;

-- Selecionando todos os dados da tabela de Veículos
SELECT * FROM VEICULOS;

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