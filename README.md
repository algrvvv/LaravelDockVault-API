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

> ВАЖНО ОТМЕТИТЬ!

Если вы запускаете проект с ОС WINDOWS, то скорее всего
у вас будет достаточная задержка между запросам и командами artisan.
Решением будет использование WSL и развертывание проект там

```bash
$ git clone https://github.com/algrvvv/LaravelDockVault-API.git
$ cd LaravelDockVault-API
$ cp .env.example .env
$ docker compose up -d
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
$ php artisan key:generate
$ php artisan cache:clear && php artisan config:clear 
```
В файле `.env` DB_HOST должен быть равен названию контейнера с бд.
По умолчанию `ldv_db`, поэтому его можно не трогать.

```dotenv
DB_CONNECTION=pgsql
DB_HOST=ldv_db
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

После этого у вас может появиться ошибка<br>
`The stream or file /logs/laravel.log could not be opened ...`
<br> В таком случае будет достаточно просто изменить права

```bash
$ chmod 777 -R ./storage
```
Если после этого у вас появиться ошибка с генерацией ключа приложения,
то просто перезапустите контейнер.

```bash
docker compose restart
# либо
docker compose down
docker compose up -d
```

## Подключение к базе данных

Для подключения к бд и проверки всех ваших записей есть два способа.

Первый:

```bash
$ make psql
# либо
$ docker exec -it ldv_db psql -U <username>
# по дефолту username = postgres
```
После этого в консоли можно написать, к примеру, `\dt`, чтобы 
увидеть все зависимости или <br> `select * from movies;`, чтобы
вывести все фильмы.

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

| Method |       Path        | Action  |           Description           |
|:------:|:-----------------:|:-------:|:-------------------------------:|
|  GET   |  /api/auth/user   |  user   | Вывод информации о пользователе |
|  POST  | /api/auth/refresh | refresh |        Обновление токена        |
|  POST  | /api/auth/logout  | logout  |        Выход из аккаунта        |
|  GET   |    /api/movies    |  index  |       Вывод всех фильмов        |
|  GET   | /api/movies/{id}  |  show   |      Вывод фильма по айди       |
|  POST  |    /api/movies    |  store  |        Добавление фильма        |
| PATCH  | /api/movies/{id}  | update  |   Частичное обновление данных   |
|  PUT   | /api/movies/{id}  | update  |    Полное обновление данных     |
| DELETE | /api/movies/{id}  | destroy |         Удаление фильма         |
