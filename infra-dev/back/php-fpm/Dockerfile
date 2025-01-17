FROM php:8.2-fpm-alpine

LABEL maintainer="C4DEV <contact@c4dev.fr>"

# Installer les dépendances de compilation et les bibliothèques nécessaires
# Installer les dépendances de compilation et les bibliothèques nécessaires
RUN apk update && apk add --no-cache --virtual .build-deps \
    gcc \
    g++ \
    make \
    autoconf \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    imagemagick-dev \
    bash \
    curl \
    git \
    unzip \
    && apk add --no-cache \
    icu-libs \
    libpng \
    libjpeg-turbo \
    libwebp \
    libxpm \
    freetype \
    libzip \
    oniguruma \
    imagemagick \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
    gd \
    pdo \
    pdo_mysql \
    mbstring \
    intl \
    zip \
    exif \
    && apk del .build-deps

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier les fichiers de configuration
COPY symfony.ini /usr/local/etc/php/conf.d/
COPY symfony.pool.conf /usr/local/etc/php-fpm.d/
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
COPY xdebug.ini  /usr/local/etc/php7/conf.d/

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Définir le répertoire de travail
WORKDIR /var/www/symfony

# Exposer le port PHP-FPM
EXPOSE 9001

# Commande par défaut
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["php-fpm"]