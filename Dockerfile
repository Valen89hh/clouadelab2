# Usamos una imagen base de PHP con Apache
FROM php:8.1-apache
# Instalamos las extensiones necesarias para PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

#ahora copiamos el código de la aplicación al contenedor
COPY . /var/www/html/
# Exponemos el puerto 80 para que el servidor web sea accesible
EXPOSE 80
