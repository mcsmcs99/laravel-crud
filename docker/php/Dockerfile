# Use a imagem base do PHP com a versão desejada
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    libpng-dev libonig-dev libxml2-dev \
    libcurl4-openssl-dev \
    libpq-dev \
    libjpeg-dev \
    libfreetype6-dev \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql mysqli
# Baixe o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho
WORKDIR /var/www

# Copie o arquivo composer.json e composer.lock para o container
COPY composer.json composer.lock /var/www/

# Instale as dependências do Composer (será feito apenas se composer.json ou composer.lock mudarem)
RUN composer install --no-autoloader --no-scripts

# Copie o restante do código da aplicação para o container
COPY . /var/www/

# Certifique-se de que o .env seja copiado corretamente para o container
COPY .env /var/www/.env

# Gere o autoloader e otimize a instalação
RUN composer dump-autoload --optimize


# Altere as permissões das pastas de armazenamento e cache para o usuário www-data
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Garanta permissões adequadas de escrita
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Comando padrão para iniciar o servidor PHP
CMD ["php-fpm"]
