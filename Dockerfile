FROM php:8.2-apache

# 1) Instala extensões e utilitários do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip curl git \
 && docker-php-ext-install pdo pdo_mysql

# 2) Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# 3) Define o DocumentRoot para a pasta 'public'
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4) Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# 5) Copia todo o projeto para o container
COPY . /var/www/html

# 6) Define o diretório de trabalho
WORKDIR /var/www/html

# 7) Cria manualmente todas as pastas que o Laravel precisa para cache, views, sessões e logs
RUN mkdir -p \
      storage/framework/cache \
      storage/framework/sessions \
      storage/framework/testing \
      storage/framework/views \
      storage/logs \
      bootstrap/cache \
 && chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# 8) Cria o ficheiro para SQLite (caso uses SQLite)
RUN touch database/database.sqlite

# 9) Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# 10) Ao iniciar o container, garante permissões corretas e arranca o Apache
CMD chmod -R 775 storage bootstrap/cache \
 && apache2-foreground

