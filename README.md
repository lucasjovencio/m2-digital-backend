# M2 Digital

## Inicialização com docker
na raiz do projeto clonado execute os comandos

- cp .env.example .env && docker-compose up -d
- docker exec -it laravel bash
- composer install --no-dev --optimize-autoloader && php artisan dev:install