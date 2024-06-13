CREATE DATABASE karangas;
-- Use o banco de dados recém-criado
USE karangas;

CREATE TABLE `funcionarios` (
  `idfun` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(50) NOT NULL,
  `email` varchar(50) default NULL,
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime NOT NULL,
  `situacao` char(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/* drop table funcionarios; */

CREATE TABLE `logins` (
  `idlogin` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `idfun` int not null,
  `usuario` varchar(50) NOT NULL UNIQUE,
  `senha` tinytext NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `data_alteracao` datetime NOT NULL,
  `situacao` char(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/* drop table logins; */

INSERT INTO `karangas`.`funcionarios` 
			(`nome_completo`, `email`, `data_cadastro`, `data_alteracao`, `situacao`) 
  VALUES 
            ('Ze Ruela', 'ze@acme.com', NOW(), NOW(), '1');

INSERT INTO `karangas`.`logins` 
			( `idfun`, `usuario`, `senha`, `data_cadastro`, `data_alteracao`, `situacao`) 
  VALUES 
            ('1', 'zeruela', '$2y$10$ruM6z1XfKD40ugKAFUJuuu4ybaUV5U6bzd/MyyJefek/T3eKkiVcm', NOW(), NOW(), '1');


select * from funcionarios;