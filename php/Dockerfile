FROM php:8.0-apache

# Install Node.js
RUN apt-get update && apt-get install -y curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql

# Update and upgrade packages
RUN apt-get update && apt-get upgrade -y
