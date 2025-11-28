# ===== base image =====
FROM php:8.2-fpm

# make noninteractive
ENV DEBIAN_FRONTEND=noninteractive

# ===== system deps =====
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    build-essential \
    ca-certificates \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
 && docker-php-ext-install pdo pdo_mysql zip pcntl

# ===== install node (for vite build) =====
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs

# ===== composer (copy from official composer image) =====
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ===== set working dir =====
WORKDIR /var/www/html

# ===== copy project files =====
COPY . .

# ===== ensure sqlite db file exists and correct DB config for build =====
# create database directory & file if using sqlite
RUN touch database/database.sqlite \
 # make sure .env exists for artisan commands during build (copy example if missing)
 && if [ ! -f .env ]; then cp .env.example .env; fi

# ensure .env has sqlite path (optional safety — only works if .env uses DB_DATABASE env var)
# (If you already have proper DB_DATABASE in .env, you can skip manipulation)
# RUN sed -i "s|DB_CONNECTION=.*|DB_CONNECTION=sqlite|" .env
# RUN sed -i "s|DB_DATABASE=.*|DB_DATABASE=/var/www/html/database/database.sqlite|" .env

# ===== install node deps and build front-end =====
RUN npm config set unsafe-perm true \
 && npm install --legacy-peer-deps \
 && npm run build

# ===== install php deps & optimize autoloader =====
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# ===== generate app key, migrate DB, cache config =====
# run migrations in build so database/tables exist inside image (suitable for sqlite)
RUN php artisan key:generate --ansi \
 && php artisan migrate --force --no-interaction \
 && php artisan config:cache \
 && php artisan route:cache || true \
 && php artisan view:cache || true

# ===== permissions =====
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
 && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ===== expose port and start server =====
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]