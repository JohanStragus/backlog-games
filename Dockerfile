# --- STAGE 1: Build de Node (Vite) ---
FROM node:20-alpine AS node_builder
WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build   # ← genera public/build correctamente


# --- STAGE 2: Instalar dependencias de PHP (Composer) ---
FROM composer:2 AS composer_builder
WORKDIR /app

COPY --from=node_builder /app /app
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction


# --- STAGE 3: Imagen final de PHP-FPM ---
FROM php:8.3-fpm-alpine

# Instalar extensiones necesarias para Laravel
RUN set -eux; \
    apk update; \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev oniguruma-dev libzip-dev; \
    apk add --no-cache icu git unzip; \
    docker-php-ext-configure intl; \
    docker-php-ext-install -j"$(nproc)" pdo_mysql bcmath intl mbstring; \
    docker-php-ext-enable opcache; \
    apk del .build-deps

WORKDIR /var/www/html

# Copiar el código, vendor y public/build desde los stages anteriores
COPY --from=composer_builder /app /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache public

# Borrar linea si algo falla
VOLUME /var/www/html 

USER www-data

EXPOSE 9000
