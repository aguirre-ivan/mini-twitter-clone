FROM php:8.1-apache-buster

RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo pdo_mysql