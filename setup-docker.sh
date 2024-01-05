#!/bin/bash

cp .env.example .env

docker compose up -d

docker exec -it ldv_app composer install

docker exec -it ldv_app php artisan key:generate

docker exec -it ldv_app php artisan cache:clear && php artisan config:clear

docker exec -it ldv_app php artisan jwt:secret

docker exec -it ldv_app php artisan migrate

docker exec -it ldv_app php artisan migrate --seed

docker exec -it ldv_app chmod 777 -R ./storage

docker compose down

docker compose up -d
