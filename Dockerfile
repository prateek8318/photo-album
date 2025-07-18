# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite (optional, for pretty URLs)
RUN a2enmod rewrite

# Copy all project files to Apache's public folder
COPY . /var/www/html/

# Set correct permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
