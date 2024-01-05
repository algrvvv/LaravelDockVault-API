@echo off

COPY  ".env.example" ".env"
docker "compose" "up" "-d"
docker "exec" "-it" "ldv_app" "bash"
composer "install"
php "artisan" "key:generate"
php "artisan" "cache:clear" && php "artisan" "config:clear"
php "artisan" "jwt:secret"
php "artisan" "migrate"
php "artisan" "migrate" "--seed"
chmod "777" "-R" "%CD%\storage"
docker "compose" "down"
docker "compose" "up" "-d"
