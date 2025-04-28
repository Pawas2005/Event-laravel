# Use the official PHP image from Docker Hub
FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy the existing application directory contents
COPY . .

# Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies using Composer
RUN composer install --no-dev

# Expose port 80
EXPOSE 80

# Start PHP server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
