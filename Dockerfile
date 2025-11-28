# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip zip git curl \
    libpq-dev libzip-dev libonig-dev \
    nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html

WORKDIR /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install dependencies
RUN composer install      # ❗ removed `--no-dev` to avoid failure
RUN npm install
RUN npm run build

# Generate APP_KEY
RUN php artisan key:generate --force

# Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose Render port
EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000



# Use official PHP image with Apache
FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zlib1g-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy source code
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Give permissions (important for Render)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]


docker-php-ext-install mysqli
