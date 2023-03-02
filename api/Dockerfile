FROM php:8.2.3-apache

RUN apt-get update && \
    apt-get install -y curl git unzip libzip-dev libonig-dev && \
    docker-php-ext-install pdo pdo_mysql zip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html/ && \
    chmod -R 755 /var/www/html/

RUN apt update && apt install git

RUN composer install && composer dump-autoload

RUN echo "DocumentRoot /var/www/html/public" > /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite

EXPOSE 81

CMD ["apache2-foreground"]
