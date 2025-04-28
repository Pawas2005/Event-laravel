# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the existing project files to the container
COPY . .

# Give permissions to Laravel folders
RUN chmod -R 775 bootstrap/cache storage

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Set the command to run Laravel
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
