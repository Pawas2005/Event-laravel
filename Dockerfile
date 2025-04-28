# Use the official PHP image from the Docker Hub
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the existing project files to the container
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80 (standard HTTP port)
EXPOSE 80

# Set the command to run Laravel
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
