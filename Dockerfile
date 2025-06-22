FROM php:8.2-apache

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip curl git && \
    docker-php-ext-install pdo pdo_mysql

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Define o DocumentRoot para a pasta 'public'
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Atualiza config do Apache para refletir o novo DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instala o Composer diretamente do site oficial
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia o projeto para dentro da imagem
COPY . /var/www/html

# Define permissões corretas para as pastas necessárias
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Define diretório de trabalho
WORKDIR /var/www/html

# Instala dependências Laravel
RUN touch /var/www/html/database/database.sqlite
RUN composer install --no-dev --optimize-autoloader
