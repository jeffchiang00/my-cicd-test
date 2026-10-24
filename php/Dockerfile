FROM php:5.6-fpm-alpine

# 安裝舊版 CI 必備的舊型 MySQL 驅動與基礎套件
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    bash \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mysql mysqli pdo pdo_mysql

WORKDIR /var/www/html

