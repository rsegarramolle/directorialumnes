# Utilitzem la imatge oficial de PHP amb Apache
FROM php:8.2-apache

# Instal·lem extensions PHP necessàries
RUN docker-php-ext-install pdo pdo_mysql

# Habilitem el mod_rewrite d'Apache
RUN a2enmod rewrite

# Configurem Apache per servir fitxers PHP
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/sites-available/000-default.conf

# Copiem el codi de l'aplicació
COPY ../src/ /var/www/html/

# Establim els permisos correctes
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Exposem el port 80
EXPOSE 80

# Iniciem Apache
CMD ["apache2-foreground"]
