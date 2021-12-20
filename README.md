# Página de produtos + API de consumo de produtos

### Status do projeto
*Em fase de estruturação e criação* :construction:

## Descrição

Devido à necessidade de criação de páginas com listagem de produtos, para campanhas e demais necessidades, presentes no Grupo Oficial, teve-se a ideia de criar este projeto com o intuito de ter uma base contendo as principais informações dos produtos para exibição ao usuário e, dessa forma, agilizar o processo de criação de landing pages para diversas campanhas, dentro da plataforma VTEX, alterando apenas os devidos SKUS de produtos que devem estar na página da listagem de produtos.

## Objetivo

O principal objetivo do projeto é criar uma base de dados com as informações de produtos existentes, fazendo atualização contínua das informações (preço de/por, url da imagem, url detalhada do produto, categoria etc.) para que, quando necessário, conseguir consumir as informações sem a necessidade de inserção manual das informações por quem estiver criando o front ou, até mesmo, realizar a codificação de requisições para as APIs da VTEX a cada projeto recriando arquivos com todos os SKUs, EANs e etc.

## Entregáveis

- Base de dados de produtos; :construction:
- Aplicação responsável por baixar e atualizar as informações dos produtos com base na lista de SKUs existentes; :construction:
- CronJob para rodar as atualizações conforme a necessidade do projeto; :construction:
- API REST responsável por servir as informações para o front
Layout sugerido da página de produtos; :construction:

## Features

- **Back**
    - [ ] Download de informações de produtos
    - [ ] Atualização das informações dos produtos
    - [ ] Cronjob para executar atualizações automaticamente
    - [ ] API Rest com paginação e seleção múltipla de filtro através de query string
- **Front sugerido**
    - [ ] Compartilhamento de estado entre componentes utilizando Context API
    - [ ] Seleção de filtros

## Pré-requisitos

Para o desenvolvimento do projeto, primeiramente é necessário ter em sua máquina o [Composer](https://getcomposer.org/), alguma servidor apache como, por exemplo, [XAMPP](https://www.apachefriends.org/pt_br/index.html) ou o [PHP](https://www.php.net/downloads.php) instalado.

## Inicialização

### API - Server

Com o projeto já na máquina local, acesse a pasta server, pelo terminal e, então, instale as dependências utilizando o composer

>cd server && php composer.phar install

Também será necessário criar as variáveis de ambiente - na raíz da pasta server - para inicialização do banco de dados. Para criar o arquivo .env basta seguir o exemplo presente no arquivo **_.env.example_** preenchendo com as informações necessárias.

Para utilizar o formato da tabela como a criada no projeto, basta importar o Schema presenta na pasta **database** dentro do MySQL para que seja criado a base de dados com a mesma estrutura.

### Servidor de desenvolvimento

Para dar início ao servidor de desenvolvimento basta seguir os passos do servidor utilizado ou, caso utilize o servidor embutido do PHP, basta rodar, no terminal, o comando para que seja iniciado o servidor em modo de desenvolvimento.

>composer server

Com o servidor iniciado já será possível acessar o conteúdo através das seguintes rotas:

- (Rotas ainda serão definidas)

## Tecnologias e Ferramentas

- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [Composer](https://getcomposer.org/)

## Autores

- [Alessandro Miranda](https://github.com/Alessandro-Miranda) - _Ideia inicial e desenvolvimento_

## Licença
Este projeto está sob a licença MIT - veja o arquivo [LICENSE.md](https://github.com/Alessandro-Miranda/pagina-produtos/blob/main/LICENSE.md) para detalhes