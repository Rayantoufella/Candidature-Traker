FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd bcmath

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN sed -i 's|<Directory /var/www/>|<Directory /var/www/html/public/>|g' /etc/apache2/apache2.conf

RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf

RUN sed -i 's/APACHE_RUN_USER=www-data/APACHE_RUN_USER=#1000/' /etc/apache2/envvars
RUN sed -i 's/APACHE_RUN_GROUP=www-data/APACHE_RUN_GROUP=#1000/' /etc/apache2/envvars

USER 1000:1000
