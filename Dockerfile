FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    && docker-php-ext-install pdo zip intl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/html
COPY . .

RUN if [ -f composer.json ]; then composer install; fi

EXPOSE 8000

# Symfony internal server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
