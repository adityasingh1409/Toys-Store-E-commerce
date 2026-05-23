# ─────────────────────────────────────────────
#  Stage 1: Build Stage
#  Install all dependencies and build assets
# ─────────────────────────────────────────────
FROM php:8.2-fpm AS build

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions needed by Laravel
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Install Composer (PHP package manager — like Maven for Java)
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory inside container
WORKDIR /var/www

# Copy composer files first (for better Docker layer caching)
COPY composer.json composer.lock ./

# Install PHP dependencies (production only, skip dev tools)
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# Copy package.json for npm
COPY package.json package-lock.json ./

# Install Node dependencies
RUN npm ci --omit=dev

# Copy the rest of the application code
COPY . .

# Build frontend assets (Vite/CSS/JS)
RUN npm run build

# Generate optimized autoloader
RUN composer dump-autoload --optimize

# ─────────────────────────────────────────────
#  Stage 2: Production Stage
#  Lean final image — no build tools included
# ─────────────────────────────────────────────
FROM php:8.2-fpm AS production

# Install only runtime system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP runtime extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Set working directory
WORKDIR /var/www

# Copy built application from build stage
COPY --from=build /var/www /var/www

# Set correct file permissions for Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# PHP-FPM config tuning
RUN echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/custom.ini

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
