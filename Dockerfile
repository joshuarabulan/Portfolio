FROM php:8.2-apache

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy your app files
COPY . /var/www/html/

# Install PHPMailer via Composer
RUN composer require phpmailer/phpmailer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set permissions
RUN chown -R www-data:www-data /var/www/html