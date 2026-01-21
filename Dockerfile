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

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install
RUN npm run build

# Create SQLite DB
RUN touch /var/www/html/database.sqlite \
    && chown -R www-data:www-data /var/www/html/database.sqlite

# Create Laravel storage directories
RUN mkdir -p storage/framework/sessions \
    storage/framework/cache \
    storage/framework/views \
    && chown -R www-data:www-data storage \
    && chmod -R 775 storage

EXPOSE 10000

CMD php artisan key:generate --force \
 && php artisan migrate --force || true \
 && php artisan session:table || true \
 && php artisan cache:table || true \
 && php artisan migrate --force || true \
 && php artisan db:seed --force || true \
 && php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan optimize:clear \
 && php artisan serve --host=0.0.0.0 --port=10000
