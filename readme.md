# Projeto upload XML

## Minimundo:
```
Um gestor deseja gerenciar as notas ficais dos seus clientes.
```

## Requisitos:
```
- O sistema deve ter uma tela para realizar upload de um arquivo na extensão .xml;
- O sistema deve validar se o arquivo é uma extensão .xml;
- O sistema deve permitir somente o upload do arquivo xml se o campo CNPJ do emitente(emit) for 09066241000884;
- O sistema deve validar se a nota possui protocolo de autorização preenchido (campo nProt);
- O sistema deve exibir em uma tela os seguintes dados: Número da nota Fiscal, Data da nota Fiscal,
dados completos do destinatário e valor total da nota fiscal;
- Os dados que serão exibidos na tela deverão ser armazenados em um banco de dados MySQL;
- Deverá ser desenvolvido em linguagem PHP 7;
- Não utilizar Framework.
```

## Tecnologias ultilizadas
```
- Php
- Javascrip
- Css
- Html
- Bootstrap
- Console-log-html
- Jquery
- Toast
```

## Rodar o projeto
```
- Entrar no diretorio raiz do projeto e executar php -S localhost:8000(Pode utilizar o xampp caso queira)
- Conectar ao serviço do mysql
- Criar o banco de dados(execute o comando presente no ./docs/script.sql)
- Criar a tabela no banco de dados(execute o comando presente no ./docs/script.sql)
- Alterar o host, banco, usuário e senha no arquivo ./src/config/db.php
- Acessar http://localhost:8000(Caso esteja utilizando o Xamp : acesse http://localhost)
```

## Imagens do projeto

## Obs
```
Para realizar testes existe o diretorio /xml para realizar upload caso não tenha nenhum arquivo para utilizar
```