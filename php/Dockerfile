FROM php:8.2-fpm-alpine3.18

RUN docker-php-ext-install pdo pdo_mysql

# Redis is installed, enable it
#RUN pecl install redis && docker-php-ext-enable redis

# Composer configurations
# Set composes as a super user since usage in docker container is not restricted
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy composer from image to current image container (using multi-stage build) to avoid composer running on it's
# own container
COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

# Copy composer.json and composer.lock files to allow docker caching and avoid re-installing if no changes have occurred.
COPY ./app/composer.* ./

# Install Composer
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

# Copy application files to the working directory
COPY ./app .

# Run composer dump-autoload --optimize
RUN composer dump-autoload --optimize


# TODO::Add cron script to the image for redis worker