FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    sqlite3 \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

# Laravel permissions + session dirs
RUN mkdir -p storage/framework/sessions \
    storage/framework/cache \
    storage/framework/views \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache \
    && rm -rf storage/framework/views/*

EXPOSE 10000

CMD sh -c "\
  touch /var/www/html/database.sqlite && \
  php artisan migrate --force && \
  php artisan db:seed --force && \
  php artisan config:clear && \
  php artisan cache:clear && \
  php artisan route:clear && \
  php artisan view:clear && \
  php artisan optimize:clear && \
  php artisan serve --host=0.0.0.0 --port=10000 \
"