FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
#    && docker-php-ext-install pdo pdo_pgsql \
    libpq-dev \
    apt-utils \
    libpq-dev \
    libmcrypt-dev \
    libpng-dev \
    libzip-dev \
    zip unzip \
    git && \
    docker-php-ext-install pdo pdo_pgsql && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install gd && \
    docker-php-ext-install zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#COPY . .


ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www

RUN chmod 777 -R /var/www
