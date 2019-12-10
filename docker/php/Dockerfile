FROM php:7.3-fpm

MAINTAINER Lauan Guermandi <lauanguermandi@gmail.com>

# Update and install dependences
RUN apt-get update && apt-get install -y \
    git \
    libmcrypt-dev \
    unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set timezone to UTC
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/UTC /etc/localtime
RUN "date"

# Type docker-php-ext-install to see available extensions
RUN pecl install mcrypt
RUN docker-php-ext-install pdo pdo_mysql

# Define workdir
WORKDIR /var/www/html
