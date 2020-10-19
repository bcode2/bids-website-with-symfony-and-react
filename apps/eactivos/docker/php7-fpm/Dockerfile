FROM php:7.2-fpm as bids_php-fpm
ARG TIMEZONE

MAINTAINER BCODE

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    openssl \
    unzip \
    wget \
    curl \
    ssh

# Install libs
RUN apt-get install -y --no-install-recommends \
        zlib1g-dev \
        libpq-dev \
        libc-client-dev \
        libkrb5-dev \
        libedit-dev \
        libxml2-dev \
        libmcrypt-dev \
        libcurl4-openssl-dev \
        libbz2-dev \
        libxslt-dev \
        libpng-dev \
        libtidy-dev \
        libmcrypt-dev \
        libmagick++-dev \
        librabbitmq-dev \
        libmagickwand-dev \
        libmemcached-dev \
        libssh2-1-dev

# Configure php extensions
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl
RUN docker-php-ext-configure intl

RUN apt-get install -y apt-transport-https ca-certificates
RUN apt-get update && apt-get install -y gnupg gnupg2 gnupg1
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && apt-get install -y nodejs

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install -y yarn

# Install php extensions
RUN docker-php-ext-install \
        opcache \
        readline \
        json \
        bcmath \
        bz2 \
        soap \
        xsl \
        dom \
        zip \
        session \
        pdo \
        mbstring \
        pdo_pgsql \
        pdo_mysql \
        mysqli \
        pgsql \
        imap \
        curl \
        xmlrpc \
        xmlwriter \
        xml \
        gd \
        sockets \
        intl

RUN pecl channel-update pecl.php.net

RUN pecl install imagick-3.4.3
RUN docker-php-ext-enable --ini-name pecl.ini imagick

RUN pecl install memcached-3.0.4
RUN docker-php-ext-enable --ini-name pecl.ini memcached

RUN pecl install apcu \
    && pecl install apcu_bc \
    && docker-php-ext-enable apcu --ini-name 10-docker-php-ext-apcu.ini \
    && docker-php-ext-enable apc --ini-name 20-docker-php-ext-apc.ini

# Install phpunit
RUN wget  https://phar.phpunit.de/phpunit-7.2.7.phar > phpunit.phar && \
        chmod +x phpunit.phar && cp phpunit.phar /usr/local/lib/php

# Configure system TimeZone
RUN ln -snf /usr/share/zoneinfo/Europe/Madrid /etc/localtime && echo "Europe/Madrid" > /etc/timezone

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

RUN apt-get update && apt-get install -y nano

#Configuración para symfony
RUN echo 'alias sf="php bin/console"' >> ~/.bashrc
RUN echo 'alias ll="ls -lah"' >> ~/.bashrc

COPY bids.ini /usr/local/etc/php/conf.d/

#Directorio trabajo.
WORKDIR /var/www/html/bids

RUN set -eux; \
	mkdir -p var/cache && chmod -R 777 var/cache; \
	mkdir -p var/logs && chmod -R 777 var/logs;
