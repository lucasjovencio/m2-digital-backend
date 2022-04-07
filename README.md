# M2 Digital

## Inicialização com docker
na raiz do projeto clonado execute os comandos

- cp .env.example .env && docker-compose up -d
- docker exec -it jovencio_m2 bash
- composer install --no-dev --optimize-autoloader && php artisan dev:install

## Instruções

- API: http://127.0.0.1:8083/api
- Documentação Swagger: http://127.0.0.1:8083/
