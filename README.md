# Sobre o Projeto

- Projeto realizado para exercitar conhecimentos principalmente para as tecnologias PHP e Laravel.
- Projeto Olx Clone é uma Api feita em Laravel podendo ser consumida em algum projeto que foi utilizado os
frameworks React, Angular, Vue ou qualquer outro framework de Front-end.

## Tecnologias Utilizadas

- PHP 8.2.4
- Laravel 10.14.1
- Eloquent ORM
- MySQL
- Insomnia

## Pré-requisitos antes de utilizar o sistema

- Crie o banco de dados que se chama olx;
- Abra o terminal do computador, vá até a pasta do projeto e execute o comando: php artisan migrate,
para assim criar todas as tabelas correspondentes as migrates criadas;
- Execute o comando php artisan db:seed para ser executado a seed de Categories e States para ser gerado dados fictícios para utilizar como base de dados.
- Para testar as respostas das requisições foi utilizado a ferramenta Insomnia, podendo ser utilizado o Postman ou qualquer outra ferramenta que consiga fazer chamadas de requisições Rest.
- Crie as requisições no Insomnia (por exemplo) levando como base as rotas do arquivo web.php
- Ex.: http://127.0.0.1/8000/user/all - Rota do tipo Get