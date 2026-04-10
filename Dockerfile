FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libpq-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip exif bcmath pdo pdo_mysql pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY composer.json composer.lock package.json package-lock.json* ./

RUN composer install --no-dev --no-interaction --no-scripts --optimize-autoloader

COPY . .

RUN composer dump-autoload --optimize --no-dev

RUN npm install && npm run build

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}