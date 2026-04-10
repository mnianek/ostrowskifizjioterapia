# 1. Zmieniamy na obraz z Apache - on ma wbudowany serwer WWW
FROM php:8.4-apache

# 2. Instalujemy zależności systemowe
RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip exif bcmath pdo pdo_mysql pdo_pgsql

# 3. Włączamy mod_rewrite dla Apache (kluczowe dla Laravela!)
RUN a2enmod rewrite

# 4. Zmieniamy DocumentRoot w Apache na folder /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Konfigurujemy Apache, żeby słuchał na porcie z Railway
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g' /etc/apache2/sites-available/000-default.conf

# 6. Pobieramy Composera
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 7. Kopiujemy kod
WORKDIR /var/www/html
COPY . .

# 8. Instalujemy biblioteki PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 9. Ustawiamy uprawnienia
RUN chown -R www-data:www-data storage bootstrap/cache

# 10. Startujemy Apache w trybie "foreground"
CMD php artisan migrate --force && apache2-foreground