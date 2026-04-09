# Wybieramy system z PHP 8.4
FROM php:8.4-fpm

# Instalujemy dodatki, których brakowało w błędach (intl, zip, bcmath, exif)
RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip exif bcmath pdo pdo_mysql

# Pobieramy Composera
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Kopiujemy Twój kod do serwera
WORKDIR /var/www/html
COPY . .

# Instalujemy biblioteki (bez tych testowych, żeby było szybciej)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Ustawiamy uprawnienia, żeby Laravel mógł zapisywać logi
RUN chown -R www-data:www-data storage bootstrap/cache

# Startujemy aplikację (Railway sam poda port)
EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}