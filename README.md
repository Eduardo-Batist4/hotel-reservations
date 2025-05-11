
# Reservation Hotel

Este projeto é uma aplicação backend desenvolvida em Laravel com foco no gerenciamento de reservas de hotéis.

O sistema foi estruturado com boas práticas de desenvolvimento, incluindo:

- Autenticação de usuários com diferenciação entre admin e cliente.

- CRUD completo para hotéis, quartos e reservas.

- Lógica de verificação de disponibilidade por data para garantir reservas consistentes.

- Uso de camadas de serviço para separar regras de negócio e manter o código organizado.

- Implementação de exceptions customizadas para tratamento de erros de forma clara e padronizada.

- Validação de dados com Form Requests personalizados, garantindo entrada de dados segura e validada.

- Projeto containerizado com Docker para facilitar a configuração e execução em qualquer ambiente.

- População do banco com dados de teste utilizando Seeders e Factories.

## Requisitos

- Docker 28.0.4
- Docker Compose


## Instalação

Clonar o Projeto

1. Clone este repositório usando esse comando:
```bash
  git clone https://github.com/Eduardo-Batist4/hotel-reservations

```
2. Acesse a pasta do projeto em seu terminal:
```bash
    cd hotel-reservations
```
3. Subir os containers:
```bash
    docker compose up --build -d
```
4. Crie o arquivo .env
```bash
"Entre na pasta /src"
    cd src
"rode esse comando"
    cp .env.example .env
"saia da pasta"
    cd ..
```
Para rodar esse projeto, você tem que configurar suas variaveis de ambiente no arquivo .env

```bash
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=0000
    DB_DATABASE=nome_do_banco
    DB_USERNAME=root
    DB_PASSWORD=root
```
5. Acessar container PHP:
```bash
    docker compose exec php sh
```
6. Instalar dependências:
```bash
    composer update
```
7. Gerar a chave da aplicação:
```bash
    php artisan key:generate
```
8. Rodar as migrações:
```bash
    php artisan migrate
```
9. Rodar os seeders e factories:
Vai gerar dados para:
- User
- Hotel
- Room

```bash
    php artisan db:seed
```

## Acessar o phpMyAdmin

Com o Docker rodando, é possível acessar o phpMyAdmin pelo link:

http://localhost:8075

Usuário: root
 
Senha: root

## Rotas

[Ver todas as rotas](routes.md)


## Stack utilizada

**Front-end:** React, Redux, TailwindCSS

**Back-end:** Node, Express


