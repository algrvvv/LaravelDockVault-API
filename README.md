<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About LaravelDockVault-API

LaravelDockVault-API - простенький REST API на основе Laravel
и с применением технологии контейнеризации Docker и с использованием nginx в качестве веб-сервера.

## Описание стека технологий

- Laravel Framework
  - Версия: 10.x
  - Элегантный синтаксис для удобного и быстрого программирования.
- Docker
  - Контейнеризация приложения для изолированного и консистентного развертывания.
  - Управление зависимостями и окружением в контейнерах для обеспечения переносимости.
- nginx
    - Использование nginx в качестве веб-сервера для обеспечения эффективного проксирования запросов.
- JWT Аутентификация
  - JSON Web Token для безопасной и эффективной аутентификации.
  - Обмен данных между сервером и клиентом с использованием подписанных токенов.
- PostgreSQL
  - Реляционная база данных.
  - Высокая производительность и надежность для хранения и управления данными.
- REST API
  - Разработка API, следующего принципам REST.

## Установка

```bash
$ git clone https://github.com/algrvvv/LaravelDockVault-API

$ cd LaravelDockVault-API

$ docker compose up --build -d
```

Сам сервер находиться по адресу: `localhost:8876`.

Чтобы перенести миграции воспользуйтесь:

Переход в консоль в контейнере php:
```bash
$ make php
# либо напишите
$ docker exec -it ldv_app bash
```

Затем:

```bash
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan cache:clear && php artisan config:clear 
```

```dotenv
DB_CONNECTION=pgsql
DB_HOST=ldv_db #название контейнера
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

```bash
# генерация secret для JWT
$ php artisan jwt:secret
# перенос миграций
$ php artisan migrate
# заполнение бд с помощью фабрик
$ php artisan migrate --seed
```

## Работа с API

```http request
GET http://localhost:8876/api/auth/login
```
Данные для входа:
```json
{
    "email": "test@example.com",
    "password": "password"
}
```

После этого вам будет выдан JWT токен, а вместе с ним доступ
к следующим запросам:

| Method |       Path       | Action  |         Description         |
|:------:|:----------------:|:-------:|:---------------------------:|
|  GET   |   /api/movies    |  index  |     Вывод всех фильмов      |
|  GET   | /api/movies/{id} |  show   |    Вывод фильма по айди     |
|  POST  |   /api/movies    |  store  |      Добавление фильма      |
| PATCH  | /api/movies/{id} | update  | Частичное обновление данных |
|  PUT   | /api/movies/{id} | update  |  Полное обновление данных   |
| DELETE | /api/movies/{id} | destroy |       Удаление фильма       |
 
