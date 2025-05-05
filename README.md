# laravel-api

## Pré-requisitos

- Docker
- Docker Compose

## Configuração e Execução

1. Clone o repositório e acesse a pasta do projeto:
```bash
git clone <repository-url>
cd laravel-api
```

2. Construa e inicie os containers:
```bash
docker compose build
docker compose up -d
```

3. Instale as dependências do PHP e NPM:
```bash
docker compose exec -it {nameApp}-dev-php-fpm sh

cmp install

php artisan migrate

npm i

npm run build
```

4. Inicialize o servidor de desenvolvimento
```bash
cmp dev
```

5. Acesse a aplicação:
   - Abra seu navegador e acesse [http://localhost:8086](http://localhost:8086)

## Serviços disponíveis

A aplicação conta com os seguintes serviços:
- Aplicação PHP (porta 8086)
- Nginx (porta 8080)
- PostgreSQL (porta 5439)

