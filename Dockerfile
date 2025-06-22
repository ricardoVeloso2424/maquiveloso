##############################
# Stage 1: Build de Assets  #
##############################
FROM node:18 AS node_builder

# Define a pasta de trabalho
WORKDIR /app

# Copia apenas o package.json, lock e configs do Vite/Tailwind
COPY package*.json vite.config.js tailwind.config.js postcss.config.js ./

# Instala dependências Node
RUN npm ci

# Copia os recursos (CSS/JS)
COPY resources resources

# Executa o build — por defeito gera em /app/public/build
RUN npm run build


###################################
# Stage 2: PHP + Apache (Laravel) #
###################################
FROM php:8.2-apache

# 1) Instala extensões e utilitários necessários
RUN apt-get update \
 && apt-get install -y libzip-dev zip unzip curl git \
 && docker-php-ext-install pdo pdo_mysql

# 2) Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# 3) Aponta o DocumentRoot para public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# 4) Atualiza configs do Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5) Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# 6) Copia o código da aplicação
COPY . /var/www/html

# 7) Copia os assets construídos no primeiro stage
COPY --from=node_builder /app/public/build /var/www/html/public/build

# 8) Define o diretório de trabalho
WORKDIR /var/www/html

# 9) Cria as pastas que o Laravel precisa (cache, sessions, views, logs, etc)
RUN mkdir -p \
      storage/framework/cache \
      storage/framework/sessions \
      storage/framework/testing \
      storage/framework/views \
      storage/logs \
      bootstrap/cache \
 && chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# 10) Se usares SQLite, garante que o ficheiro existe
RUN touch database/database.sqlite

# 11) Instala as dependências PHP
RUN composer install --no-dev --optimize-autoloader

# 12) Entry-point: corrige permissões e arranca o Apache
CMD chmod -R 775 storage bootstrap/cache \
 && apache2-foreground
