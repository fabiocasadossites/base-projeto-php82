FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.2-bz2 \ 
        php8.2-http \ 
        php8.2-mysql \ 
        php8.2-oauth \ 
        php8.2-pgsql \ 
        php8.2-soap \ 
        php8.2-sqlite3 \ 
        php8.2-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
