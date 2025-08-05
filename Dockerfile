FROM php:8.2-apache

# Instala dependencias para pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

# Habilita mod_rewrite (opcional, útil para rutas amigables)
RUN a2enmod rewrite
