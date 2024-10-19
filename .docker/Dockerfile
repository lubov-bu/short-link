FROM php:8.3.4-fpm

ENV LANG=C.UTF-8
ENV TERM=xterm-256color

WORKDIR /var/www

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get update && apt-get upgrade -y \
    && apt-get install apt-utils -y

RUN apt-get update && apt-get install -y \
    build-essential \
    libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libzip-dev libpq-dev libgmp-dev libffi-dev libssl-dev \
    libfreetype6 libfreetype6-dev \
    locales \
    jpegoptim optipng pngquant gifsicle \
    nano \
    zip unzip \
    git \
    curl

RUN docker-php-ext-install pdo pdo_mysql mysqli gd \
      && docker-php-ext-configure gd --with-freetype --with-jpeg \
	  && docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-source delete
RUN apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

USER www
