# Use official PHP-Apache image
FROM php:8.2-apache

# Enable Apache Rewrite Module (very important for Laravel routes)
RUN a2enmod rewrite

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip libpng-dev libonig-dev libjpeg-dev libfreetype6-dev \
 && docker-php-ext-configure gd \
 && docker-php-ext-install pdo pdo_mysql zip gd mbstring bcmath exif

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set permissions (important for Laravel storage and bootstrap)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# No CMD needed — Apache will start automatically
