FROM php:8.2-fpm-alpine

# ── System dependencies ──────────────────────────────────────────
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    oniguruma-dev \
    libxml2-dev \
    icu-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        gd \
        opcache \
        bcmath \
        pcntl \
        mbstring \
        xml \
        intl \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

# ── Composer ─────────────────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ── App ──────────────────────────────────────────────────────────
WORKDIR /var/www/html

COPY . .

RUN composer install \
        --no-dev \
        --optimize-autoloader \
        --no-interaction \
        --no-scripts

# إنشاء مجلدات storage المطلوبة (Git لا يرفع المجلدات الفاضية)
RUN mkdir -p \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/testing \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ── Config files ─────────────────────────────────────────────────
COPY docker/nginx.conf      /etc/nginx/http.d/default.conf
COPY docker/php.ini         /usr/local/etc/php/conf.d/custom.ini
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh   /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s \
    CMD curl -f http://localhost/up || exit 1

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
