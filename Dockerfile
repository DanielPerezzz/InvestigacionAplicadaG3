FROM php:8.2-apache

# activamos mod_rewrite útil para apis
RUN a2enmod rewrite

#copiar proyecto al servidor web
COPY . /var/www/html/

COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

#permisos 
RUN chown -R www-data:www-data /var/www/html

#Exponer puerto
EXPOSE 80

