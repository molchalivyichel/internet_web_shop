# Берём готовый образ PHP с веб-сервером Apache
FROM php:8.2-apache

# Устанавливаем расширения PHP для работы с MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Включаем модуль mod_rewrite (нужен для .htaccess и красивых URL)
RUN a2enmod rewrite

# Меняем корневую папку веб-сервера на `public`
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Копируем все файлы из текущей папки внутрь контейнера
COPY . /var/www/html/

# Назначаем правильного владельца файлов (для безопасности)
RUN chown -R www-data:www-data /var/www/html