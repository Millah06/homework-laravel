FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy example env if not present
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generate app key
RUN php artisan key:generate

# Add this to your Dockerfile
RUN touch /var/www/html/database/database.sqlite
RUN chmod 775 /var/www/html/database/database.sqlite

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

 
 
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# this creates the tables
RUN php artisan migrate --force

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000