FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.json

RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY . .

RUN mkdir -p /app/output

CMD ["php", "run.php"]
