FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip libpq-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www