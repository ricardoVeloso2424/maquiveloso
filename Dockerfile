FROM php:8.2-apache

# 1) Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip curl git && \
    docker-php-ext-install pdo pdo_mysql

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

# 5) Copia o projeto e define o diretório de trabalho
COPY . /var/www/html
WORKDIR /var/www/html

# 6) Garante que todas as pastas de cache/exceções existem
RUN mkdir -p storage/framework/{cache,sessions,testing,views} \
    storage/logs bootstrap/cache

# 7) Ajusta permissões para o www-data
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 775 storage bootstrap/cache

# 8) Cria o ficheiro SQLite
RUN touch database/database.sqlite

# 9) Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# 10) No arranque, re-corrige permissões e inicia o Apache
CMD chmod -R 775 storage bootstrap/cache && apache2-foreground

