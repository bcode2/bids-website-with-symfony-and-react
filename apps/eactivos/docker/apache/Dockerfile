FROM ubuntu:xenial as bids_apache

ENV OS_LOCALE="es_ES.UTF-8"
RUN apt-get update && apt-get install -y locales && locale-gen es_ES.UTF-8
ENV LANG=${OS_LOCALE} \
    LANGUAGE=${OS_LOCALE} \
    LC_ALL=${OS_LOCALE} \
    DEBIAN_FRONTEND=noninteractive

ENV APACHE_CONF_DIR=/etc/apache2 \
    PHP_CONF_DIR=/etc/php/7.2 \
    PHP_DATA_DIR=/var/lib/php

RUN	BUILD_DEPS='software-properties-common python-software-properties' \
    && dpkg-reconfigure locales \
	&& apt-get install --no-install-recommends -y $BUILD_DEPS \
	&& add-apt-repository -y ppa:ondrej/php \
	&& add-apt-repository -y ppa:ondrej/apache2 \
	&& apt-get update \
    && apt-get install -y curl apache2 libapache2-mod-php7.2

# Apache settings
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY bids.local.conf /etc/apache2/sites-enabled/bids.local.conf

RUN a2enmod proxy proxy_fcgi proxy_http proxy_balancer lbmethod_byrequests rewrite

WORKDIR /var/www/html

CMD ["apachectl", "-D", "FOREGROUND"]
EXPOSE 80
