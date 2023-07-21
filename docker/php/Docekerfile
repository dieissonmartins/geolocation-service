FROM php:8.0-fpm-alpine

LABEL maintainer="Dieisson <dieisson.martins.santos@gmail.com>"

RUN apk update
RUN apk add wget

RUN apk add --no-cache --virtual .phpize_deps $PHPIZE_DEPS

RUN pecl install xdebug-3.1.5

RUN docker-php-ext-enable xdebug \
&& echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.log=/var/www/html/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& touch /var/www/html/xdebug.log

# Install system dependencies
RUN apk add git
RUN apk add zip
RUN apk add unzip
RUN apk add curl
RUN apk add procps
RUN apk add net-tools
RUN apk add nginx
RUN apk add libpng-dev
RUN apk add libmcrypt-dev
RUN apk add libzip-dev
RUN apk add libxml2-dev
RUN apk add libaio-dev
RUN apk add libpq-dev
RUN apk add libsodium-dev

RUN docker-php-ext-install pdo pdo_mysql mysqli zip exif

#RUN pecl install redis
#RUN docker-php-ext-enable redis
#RUN rm -rf /tmp/pear

RUN docker-php-ext-install bcmath

RUN echo "@v3.4 http://nl.alpinelinux.org/alpine/v3.4/main" >> /etc/apk/repositories && \
apk update

RUN docker-php-ext-install gd
RUN apk add jq git

RUN ln -s /var/www/meucuidador/artisan /usr/local/bin/artisan

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pcntl

RUN apk add openjdk8
RUN apk add ttf-dejavu

RUN apk add --update npm

RUN addgroup -g 1000 -S www
RUN adduser -u 1000 -S www -G www

RUN mkdir -p /home/www/.composer
RUN chown -R www:www /home/www

RUN composer self-update

RUN apk del .phpize_deps
