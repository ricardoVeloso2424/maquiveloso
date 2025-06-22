FROM php:8.2-apache

# Instalar dependências e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar todos os ficheiros do projeto
COPY . .

# Instalar Node.js + dependências do Laravel
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install && npm run build

# Instalar dependências PHP com Composer
RUN composer install --no-dev --optimize-autoloader

# Corrigir permissões de pasta
RUN chown -R www-data:www-data storage bootstrap/cache

# Expor a porta 80 (HTTP)
EXPOSE 80

# Comando para migrar a DB e arrancar o servidor Apache
CMD php artisan migrate --force && apache2-foreground