# Use the official PHP 8.2 Apache image as a base
FROM php:8.2-apache

# Install system dependencies required for extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install required PHP extensions
RUN docker-php-ext-install mysqli zip

# Get the Composer installer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy composer dependency definitions
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-scripts --no-autoloader

# Copy application source
COPY . .

# Re-generate autoloader
RUN composer dump-autoload --optimize