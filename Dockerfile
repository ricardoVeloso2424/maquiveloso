FROM php:8.2-apache

# Instala extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Ativa o mod_rewrite
RUN a2enmod rewrite

# Define a DocumentRoot correta
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Atualiza a config do Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copia o código da aplicação
COPY . /var/www/html

# Define permissões corretas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Define diretório de trabalho
WORKDIR /var/www/html

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala dependências Laravel
RUN composer install --no-dev --optimize-autoloader