FROM php:7.1.3-fpm-alpine

RUN apk add --update --no-cache --virtual .ext-deps freetype-dev libmcrypt-dev autoconf g++ make icu-dev

RUN apk add --no-cache --virtual .mongodb-ext-build-deps pcre-dev
    
RUN pecl install redis && \
    pecl install mongodb && \
    apk del .mongodb-ext-build-deps && \
    pecl clear-cache && \
    docker-php-ext-enable redis mongodb && \
    docker-php-source delete

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Clean build
RUN  rm -rf /var/lib/apt/lists/* /var/tmp/*

WORKDIR /var/www

# Export PHP-FPM port
EXPOSE 9000