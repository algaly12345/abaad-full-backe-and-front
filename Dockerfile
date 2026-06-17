# ═══════════════════════════════════════════════════════
# الخيار 1 (مقترح): Debian — أستقر وأسهل في الـ packages
# ═══════════════════════════════════════════════════════
FROM php:8.2-fpm

# ── System packages ──────────────────────────────────
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    supervisor \
    curl \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
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
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ── Composer ─────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ── App ──────────────────────────────────────────────
WORKDIR /var/www/html
COPY . .

RUN composer install \
        --no-dev \
        --optimize-autoloader \
        --no-interaction \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ── Configs ──────────────────────────────────────────
COPY docker/nginx.conf       /etc/nginx/sites-enabled/default
COPY docker/php.ini          /usr/local/etc/php/conf.d/custom.ini
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=15s \
    CMD curl -f http://localhost/up || exit 1

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]