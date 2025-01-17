# Utiliser une image PHP-FPM légère basée sur Alpine
FROM php:8.2-fpm-alpine

LABEL maintainer="C4DEV <contact@c4dev.fr>"

# Installer les dépendances nécessaires
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
    opcache \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir l'environnement de production par défaut
ENV APP_ENV=prod

# Copier les fichiers de configuration PHP et PHP-FPM
COPY symfony.ini /usr/local/etc/php/conf.d/
COPY symfony.pool.conf /usr/local/etc/php-fpm.d/

# Ajouter le script d'entrée
COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Définir le répertoire de travail
WORKDIR /var/www/symfony

# Copier les fichiers du projet Symfony dans l'image
COPY . /var/www/symfony

# Ajuster les permissions pour www-data
RUN chown -R www-data:www-data /var/www/symfony

# Exposer le port PHP-FPM
EXPOSE 9001

# Commande par défaut
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["php-fpm"]