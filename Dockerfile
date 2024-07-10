FROM php:7.4.33-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install pdo pdo_pgsql mbstring

COPY . /usr/src/magenta-web
WORKDIR /usr/src/magenta-web
EXPOSE 8080
CMD [ "php", "artisan", "serve", "--host=172.18.0.3", "--port=8080"]