# Imagem do Composer
FROM composer:2.7 AS vendor

# BASE IMAGE
FROM php:8.2-fpm-alpine AS base

    ARG TZ=UTC
    ARG APP_DIR=/var/www/html

    ENV PHP_CPPFLAGS="$PHP_CPPFLAGS -std=c++11" \
        COMPOSER_ALLOW_SUPERUSER=1 \
        ROOT=${APP_DIR} \
        COMPOSER_FUND=0 \
        COMPOSER_MAX_PARALLEL_HTTP=24

    SHELL ["/bin/sh", "-eou", "pipefail", "-c"]

    RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime \
        && echo ${TZ} > /etc/timezone
        
    RUN apk add --no-cache freetype \
        libjpeg-turbo \
        libpng \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libzip-dev \
        libpq-dev \
        iputils-ping \
        zip \
        unzip \
        openssh-client \
        && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-enable gd \
        && docker-php-ext-install pdo pdo_mysql zip exif pcntl bcmath \ 
        && docker-php-ext-install opcache \
        && apk del --no-cache \
        && rm -rf /tmp/*

    RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/php-opocache-cfg.ini

    COPY --from=vendor /usr/bin/composer /usr/bin/composer

    RUN apk update \
        && apk add nginx \
        && mkdir -p /run/nginx

# GENERATE BUILDER IMAGE
FROM base AS builder

    COPY --from=vendor /usr/bin/composer /usr/bin/composer
    RUN chmod +x /usr/bin/composer

    ENV COMPOSER_ALLOW_SUPERUSER=1

    WORKDIR /var/www/html

    COPY composer.json ./

    RUN composer install \
        --no-interaction \
        --no-ansi \
        --no-scripts \
        --classmap-authoritative

    RUN mkdir -p \
        storage/framework/sessions \
        storage/framework/views \
        storage/framework/cache \
        storage/framework/testing \
        storage/logs \
        bootstrap/cache && chmod -R a+rw storage
    

# GENERATE PRODUCTION IMAGE
FROM base AS prod

    COPY ./infrastructure/nginx-site.conf /etc/nginx/http.d/default.conf
    COPY ./infrastructure/entrypoint.sh /etc/entrypoint.sh

    RUN chmod +x /etc/entrypoint.sh

    COPY --from=builder /var/www/html /var/www/html

    WORKDIR /var/www/html
    
    ADD . /var/www/html

    RUN chown -R www-data:www-data /var/www/html
    RUN chmod -R 775 /var/www/html
    
    EXPOSE 80
    EXPOSE 9003

    CMD ["php", "-S", "0.0.0.0:9000", "-t", "public/"]

    ENTRYPOINT ["/etc/entrypoint.sh"]

    HEALTHCHECK --start-period=5s --interval=2s --timeout=5s --retries=8 CMD php || exit 1