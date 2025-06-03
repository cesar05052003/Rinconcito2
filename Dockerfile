# Etapa 1: Instalación de dependencias
FROM php:8.2-fpm

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    npm \
    nodejs \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia los archivos del proyecto
COPY . .

# Instala dependencias PHP y Node
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm install && npm run build

# Permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Usa el servidor de Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
