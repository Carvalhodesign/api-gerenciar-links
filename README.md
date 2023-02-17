# API de gerenciamento de links

Esta API permite o gerenciamento de links, incluindo a adição, remoção e listagem de links cadastrados.

## Tecnologias utilizadas

-   PHP 7.4.21
-   MySQL 8.0.26
-   Apache 2.4.48
-   Bootstrap 5.3.0

## Configuração do ambiente

1.  Clone este repositório em sua máquina:

bashCopy code

`git clone https://github.com/seu-usuario/api-links.git` 

2.  Crie um banco de dados MySQL e execute o script `banco.sql` contido na pasta `/sql` para criar a tabela necessária para o armazenamento dos links.
    
3.  Faça as configurações necessárias no arquivo `conexao.php` para que o PHP possa se conectar ao banco de dados.
    

## Utilização da API

### Adicionar um link

Para adicionar um novo link, envie uma requisição POST para a URL `http://localhost/api-links/inserir.php` contendo os seguintes parâmetros no corpo da requisição:

-   `url`: URL do link a ser adicionado.
-   `title`: título do link a ser adicionado.

Exemplo de requisição:

jsonCopy code

`POST http://localhost/api-links/inserir.php

{
    "url": "https://www.google.com",
    "title": "Google"
}` 

### Listar links

Para listar todos os links cadastrados, envie uma requisição GET para a URL `http://localhost/api-links/listar.php`.

Exemplo de requisição:

javascriptCopy code

`GET http://localhost/api-links/listar.php` 

### Remover um link

Para remover um link cadastrado, envie uma requisição DELETE para a URL `http://localhost/api-links/remover.php` contendo o seguinte parâmetro na URL da requisição:

-   `id`: ID do link a ser removido.

Exemplo de requisição:

bashCopy code

`DELETE http://localhost/api-links/remover.php?id=1` 

## Interface para gerenciamento de links

Além da API, também foi desenvolvida uma interface para gerenciamento dos links cadastrados. Acesse a URL `http://localhost/api-links/` em seu navegador para acessá-la.

## Autor

Luan Carvalho - [designer.carvalhoo@gmail.com]
