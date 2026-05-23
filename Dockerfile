FROM php:8.4-apache

# Устанавливаем системные зависимости (если нужны)
RUN apt-get update && apt-get install -y unzip git

# Устанавливаем Composer из официального образа
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка PHP-расширений
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite

# Меняем DocumentRoot на public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Копируем исходники (НО исключаем vendor через .dockerignore!)
COPY . /var/www/html/

# Переходим в папку system и устанавливаем зависимости
WORKDIR /var/www/html/system

# Возвращаем рабочую директорию для Apache
WORKDIR /var/www/html