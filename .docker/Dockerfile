#https://github.com/sebastianskurnog/docker-php-development-environment
FROM php:8.2-apache

# Copy application files to the container
COPY . /var/www/html

# Create necessary directories and set permissions
RUN mkdir -p /var/www/html/var/cache/ \
    && mkdir -p /var/www/html/var/cache/dev \
    && mkdir -p /var/www/html/var/cache/prod \
    && mkdir -p /var/www/html/var/log \
    && chmod -R 777 /var/www/html/var/ \
    && chmod -R 777 /var/www/html/var/log \
    && chmod -R 777 /var/www/html/var/cache/ \
    && chmod -R 777 /var/www/html/var/cache/dev \
    && chmod -R 777 /var/www/html/var/cache/prod

# Copy Apache configuration files
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/
COPY .docker/apache/apache2.conf /etc/apache2/

# Copy PHP configuration file
COPY .docker/php/php.ini /usr/local/etc/php/

# Install required packages
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip

# Enable mod rewrite
RUN a2enmod rewrite

# Install APCu and make it available
RUN pecl install apcu \
    && echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version
    
RUN curl -sS https://get.symfony.com/cli/installer | bash
# Set file ownership to the Apache user
RUN chown -R www-data:www-data /var/www/html
