FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl libpq-dev nodejs npm

RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer --version

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

EXPOSE 10000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
CMD sh -c "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000"
