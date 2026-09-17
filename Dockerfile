FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache modules needed for Laravel routing
RUN a2enmod rewrite headers ssl


WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Copy clean Apache site config
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Install Composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Create start script entrypoint
RUN printf '#!/bin/bash\n\
cp -n .env.example .env || true\n\
php artisan key:generate --force\n\
mkdir -p /var/www/html/storage/app/public\n\
mkdir -p /var/www/html/storage/framework/cache/data\n\
mkdir -p /var/www/html/storage/framework/sessions\n\
mkdir -p /var/www/html/storage/framework/views\n\
mkdir -p /var/www/html/storage/logs\n\
mkdir -p /var/www/html/bootstrap/cache\n\
mkdir -p /var/www/html/database\n\
touch /var/www/html/database/database.sqlite\n\
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database\n\
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database\n\
php artisan migrate:fresh --seed --force\n\
php artisan storage:link --force || true\n\
php artisan view:cache\n\
exec apache2-foreground\n' > /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/entrypoint.sh


EXPOSE 80

CMD ["/usr/local/bin/entrypoint.sh"]
