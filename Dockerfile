##############################
# Stage 1: Build dos Assets #
##############################
FROM node:18 AS node_builder

WORKDIR /app

# 1) Copia apenas o package.json e package-lock para instalar dependências
COPY package*.json ./

# 2) Instala as deps do front-end
RUN npm ci

# 3) Copia o resto do código (inclui vite.config.js, tailwind.config.js, resources/, etc)
COPY . .

# 4) Executa o build (garante que gera em public/build se estiver configurado assim no vite.config.js)
RUN npm run build


###################################
# Stage 2: PHP + Apache (Laravel) #
###################################
FROM php:8.2-apache

# 1) Instala extensões e utilitários do SO
RUN apt-get update \
 && apt-get install -y libzip-dev zip unzip curl git \
 && docker-php-ext-install pdo pdo_mysql

# 2) Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# 3) Define o DocumentRoot para public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
       /etc/apache2/sites-available/000-default.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
       /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4) Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
      --install-dir=/usr/local/bin --filename=composer

# 5) Copia o código PHP/Laravel para o container
COPY . /var/www/html

# 6) Copia os assets gerados no node_builder para public/build
COPY --from=node_builder /app/public/build /var/www/html/public/build

# 7) Define o diretório de trabalho
WORKDIR /var/www/html

# 8) Garante que todas as pastas de storage existem e têm permissões
RUN mkdir -p \
      storage/framework/cache \
      storage/framework/sessions \
      storage/framework/testing \
      storage/framework/views \
      storage/logs \
      bootstrap/cache \
 && chown -R www-data:www-data /var/www/html \
 && chmod -R 775 storage bootstrap/cache

# 9) Se usares SQLite, garante que o ficheiro existe
RUN touch database/database.sqlite

# 10) Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# 11) No arranque, corrige as permissões e levanta o Apache
CMD chmod -R 775 storage bootstrap/cache \
 && apache2-foreground
