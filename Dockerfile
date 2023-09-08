FROM php:8.0-apache
WORKDIR /var/www/html

RUN apt update
RUN apt-get install -y build-essential re2c libaio1 unzip wget
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update && \
apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
docker-php-ext-install gd
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN a2enmod rewrite
EXPOSE 8000
