# Używamy wersji z Apache, która jest stabilna na produkcji
FROM php:8.4-apache

# Instalujemy dodatki systemowe
RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip exif bcmath pdo pdo_mysql pdo_pgsql

# Włączamy mod_rewrite dla Laravela
RUN a2enmod rewrite

# Ustawiamy Apache tak, aby patrzył na folder /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Konfigurujemy Apache pod port Railway
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g' /etc/apache2/sites-available/000-default.conf

# Instalujemy Composera
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Instalujemy paczki Laravela
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Uprawnienia
RUN chown -R www-data:www-data storage bootstrap/cache

# Startujemy serwer Apache (to zastępuje problematyczne 'php artisan serve')
CMD php artisan migrate --force && apache2-foreground