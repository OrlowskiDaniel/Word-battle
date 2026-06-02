FROM php:8.4-fpm AS production

# Install system libs + PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev libonig-dev libzip-dev libxml2-dev git unzip \
    && docker-php-ext-install pdo_pgsql pgsql zip bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Get Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy composer files and install (dev dependencies included for now)
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-scripts --no-interaction

# Copy the rest of the app
COPY . .
RUN composer dump-autoload --optimize

# ---- Development stage (adds Xdebug on top) ----
FROM production AS development

ARG UID=1000
ARG GID=1000

USER root

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN if getent group ${GID}; then \
      useradd -m -u ${UID} -g ${GID} -s /bin/bash www; \
    else \
      groupadd -g ${GID} www && useradd -m -u ${UID} -g www -s /bin/bash www; \
    fi

COPY ./docker/development/php-fpm/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

USER www-data
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
EXPOSE 9000
CMD ["php-fpm"]