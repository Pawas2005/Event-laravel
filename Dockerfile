FROM php:8.2-apache

# Install system packages and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libonig-dev zip unzip \
 && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install -j$(nproc) gd mbstring zip exif pcntl bcmath pdo_mysql \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy Composer (dependency manager) from the official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory inside the container
WORKDIR /var/www/html

# Copy application files to the container
COPY . .

# Allow Composer to run as root without warnings
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install PHP dependencies (Laravel vendor directory)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set the application port (Laravel default is 8000)
ENV PORT=8000
EXPOSE 8000

# Start the Laravel development server on the correct port
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
