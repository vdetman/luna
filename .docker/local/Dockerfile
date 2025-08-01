FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        libzip-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        zip \
        curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache \
    && docker-php-ext-enable opcache

# Установка Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Создание пользователя для приложения
RUN useradd -G www-data,root -u 1000 -d /home/laravel laravel \
    && mkdir -p /home/laravel/.composer \
    && chown -R laravel:laravel /home/laravel

# Установка прав доступа
RUN chown -R www-data:www-data /var/www

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
