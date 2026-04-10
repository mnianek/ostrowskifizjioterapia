FROM php:8.4-apache

# 1. Instalacja zależności systemowych + Node.js w jednej warstwie
RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev libzip-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip exif bcmath pdo pdo_mysql pdo_pgsql \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Apache config (MPM fix + DocumentRoot)
RUN a2dismod mpm_event mpm_worker || true && a2enmod mpm_prefork
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g' /etc/apache2/sites-available/000-default.conf

# 3. Kopiowanie plików definicji (dla cache)
WORKDIR /var/www/html
COPY composer.json composer.lock package.json package-lock.json* ./

# 4. Instalacja Composera i Node
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --no-scripts --no-autoloader

# 5. Kopiowanie reszty kodu i budowanie
COPY . .
RUN composer dump-autoload --optimize --no-dev

# 6. Budowanie assetów (Jeśli nie masz własnych, usuń te dwie linie poniżej!)
RUN npm install
RUN npm run build

# 7. Uprawnienia
RUN chown -R www-data:www-data storage bootstrap/cache

# 8. Start
CMD php artisan migrate --force && apache2-foreground