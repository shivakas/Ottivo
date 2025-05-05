# Use an official PHP image with Composer
FROM php:8.3-cli

# Set working directory
WORKDIR /app

# Install system dependencies if needed
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Copy app files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist

# Set default command (optional CLI entry)
CMD [ "php", "bin/calculate_vacation_days.php", "2024" ]
