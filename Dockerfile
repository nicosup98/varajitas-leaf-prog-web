FROM php:8.2-cli

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY . .


RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    wget \
    git \
    unzip

RUN docker-php-ext-install zip pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require leafs/cli

RUN ln -s /root/.composer/vendor/bin/leaf /usr/local/bin/leaf

# If you have a custom PHP ini file you can uncomment this line
# COPY ./php.ini /usr/local/etc/php/php.ini

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/*


RUN chown -R www-data:www-data /var/www

CMD ["php","leaf", "serve"]