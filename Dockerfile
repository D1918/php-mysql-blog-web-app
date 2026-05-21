FROM php:8.4-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    nodejs \
    npm \
    inotify-tools

RUN npm install -g sass

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
	/etc/apache2/sites-available/*.conf \
	/etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

COPY *.json *.lock ./

RUN composer install --no-dev --optimize-autoloader

COPY . .

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
