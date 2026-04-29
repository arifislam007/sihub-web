FROM php:8.3-apache

WORKDIR /var/www/html

# Install required extensions
RUN apt-get update && apt-get install -y \
    postgresql-client \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql \
    && apt-get clean

# Enable Apache modules
RUN a2enmod rewrite

COPY . /var/www/html

# Create necessary directories
RUN mkdir -p /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html

# Set proper permissions
RUN chmod -R 755 /var/www/html/storage

EXPOSE 80

CMD ["apache2-foreground"]
