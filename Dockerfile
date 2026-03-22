FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev \
    && docker-php-ext-install pdo zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install deps WITHOUT scripts
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy full project
COPY . .

# Now Symfony is complete → scripts will work
RUN php bin/console cache:clear || true

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]