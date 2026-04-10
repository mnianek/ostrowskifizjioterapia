FROM php:8.4-apache

# 1. Instalujemy zależności
RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip exif bcmath pdo pdo_mysql pdo_pgsql

# 2. Włączamy mod_rewrite
RUN a2enmod rewrite

# 3. FIX dla błędu "More than one MPM loaded"
# Wyłączamy moduł 'event' i 'worker', włączamy 'prefork' (wymagany przez PHP)
RUN a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork

# 4. DocumentRoot na /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Konfiguracja Portu pod Railway
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g' /etc/apache2/sites-available/000-default.conf

# 6. Composer i kod
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs
WORKDIR /var/www/html
COPY . .
RUN npm install && npm run build
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN chown -R www-data:www-data storage bootstrap/cache

# 7. Start aplikacji
CMD php artisan migrate --force && apache2-foreground