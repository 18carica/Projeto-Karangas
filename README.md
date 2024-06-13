# Projeto Karanga

![Logo da Karanga](imagens/logo_karanga.png)

Bem-vindo ao repositório do projeto Karanga! Este projeto simula um sistema de gerenciamento de uma loja de carros, onde é possível cadastrar, modificar e listar veículos, clientes, funcionários, entre outros. Este README fornece uma visão geral do projeto, incluindo como configurar e executar localmente.

## Funcionalidades

- Cadastro, modificação e listagem de veículos, clientes, funcionários, tipos de veículos, marcas, etc.
- Interface para navegação entre diferentes seções do sistema.

## Tecnologias Utilizadas

- PHP
- MySQL (ou Oracle, dependendo da configuração)
- HTML
- CSS (Bootstrap para estilos)

## Pré-requisitos

Para executar este projeto localmente, você precisa ter instalado:

- Servidor web (como Apache, Nginx)
- PHP
- MySQL (ou Oracle)
- Git (opcional, se você deseja clonar o repositório)

## Instalação e Configuração

1. **Clonar o repositório:**

   ```bash
   git clone https://github.com/seu-usuario/karanga.git

2. **Configurar o Banco de Dados:**

   - Importe o esquema do banco de dados a partir do arquivo database.sql.
   - Configure as credenciais do banco de dados no arquivo console/oracle.php.

3. **Configurar o Ambiente Web:**

   - Certifique-se de que seu servidor web está configurado para servir arquivos PHP.
   - Verifique as configurações de permissões e caminhos dentro do projeto, conforme necessário.

4. **Acessar o Projeto:**

Abra seu navegador e vá para <http://localhost/karanga> (ou o caminho correspondente configurado no seu servidor web).

## Estrutura de Arquivos

- console/: Contém os scripts PHP para interação com o banco de dados.
- css/: Arquivos CSS para estilização personalizada.
- imagens/: Contém imagens utilizadas no projeto, como o logotipo da Karanga.
- index.php: Página principal do projeto que lista os veículos cadastrados.
- modificar-cadastros-veiculos.php: Página para modificar detalhes de veículos.
- modificar-funcionarios.php: Página para modificar detalhes de funcionários.
- modificar-clientes.php: Página para modificar detalhes de clientes.
- modificar-tipos.php: Página para modificar tipos de veículos.
- modificar-marcas.php: Página para modificar marcas de veículos.

## Como Usar

### Listar Veículos

Acesse a página principal (index.php) para visualizar uma lista de veículos cadastrados com os seguintes dados:

- Marca
- Modelo
- Ano de Fabricação
- Quilometragem
- Valor de Saída

## Modificar Veículos

Na página de modificação de veículos (modificar-cadastros-veiculos.php), você pode pesquisar um veículo por ID ou modelo e atualizar seus dados.

## Modificar Funcionários, Clientes, Tipos e Marcas

Cada um desses elementos possui sua própria página de modificação, acessível a partir do menu de navegação.

## Contribuições

Contribuições são bem-vindas! Se você deseja melhorar este projeto:

1. Faça um fork do repositório.
2. Crie uma branch com sua feature (git checkout -b feature/nova-feature).
3. Faça commit de suas mudanças (git commit -am 'Adiciona nova feature').
4. Faça push para a branch (git push origin feature/nova-feature).
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE] para mais detalhes.

© 2024 Karanga. Desenvolvido como parte de uma aula demo.

### Explicação do README.md

- **Descrição do Projeto**: Uma breve introdução ao projeto e uma imagem do logo, se disponível.
  
- **Funcionalidades**: Lista das principais funcionalidades do projeto.

- **Tecnologias Utilizadas**: Enumeração das tecnologias principais utilizadas no desenvolvimento do projeto.

- **Pré-requisitos**: Informações sobre o que é necessário para configurar e executar o projeto localmente.

- **Instalação e Configuração**: Passos detalhados para clonar o repositório, configurar o banco de dados, configurar o ambiente web e acessar o projeto.

- **Estrutura de Arquivos**: Descrição sucinta da organização dos principais diretórios e arquivos do projeto.

- **Como Usar**: Orientações sobre como usar as principais funcionalidades do sistema.

- **Contribuições**: Instruções para contribuir com o projeto, caso seja um projeto de código aberto.

- **Licença**: Informação sobre a licença sob a qual o projeto está disponível.
