# STAGE 1: Build Frontend Assets
FROM node:20-alpine AS frontend_builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY resources ./resources
COPY vite.config.js ./
COPY tailwind.config.js ./ 
RUN npm run build

# STAGE 2: Install PHP Dependencies
FROM composer:2.8 AS php_vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# STAGE 3: Final Production Image
# Using an image that bundles PHP-FPM + Nginx for a single-container host like Render
FROM richarvey/nginx-php-fpm:php83-alpine 

WORKDIR /var/www/html

# Copy only the necessary files from the previous stages
COPY --from=php_vendor /app/vendor ./vendor
COPY --from=frontend_builder /app/public/build ./public/build
COPY . .

# Image Configuration for Production
ENV WEBROOT /var/www/html/public
ENV APP_ENV production
ENV APP_DEBUG false

# Ensure the database folder is writable for your SQLite file
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Final cleanup to keep it light
RUN rm -rf /var/www/html/tests