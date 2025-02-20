# Используем официальный образ PHP с Apache
FROM php:7.4-apache

# Устанавливаем необходимые модули
RUN apt-get update && apt-get install -y \
    nano \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Включаем mod_rewrite
RUN a2enmod rewrite

# Разрешаем использование .htaccess
#RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

RUN mkdir -p /var/www/html/uploads/

# Устанавливаем разрешения для загрузки файлов
RUN chown -R www-data:www-data /var/www/html/uploads/
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/
RUN chmod -R 777 /var/www/html/uploads/

# Добавляем кастомную конфигурацию Apache
RUN echo "<Directory /var/www/html/> \n\
    Options Indexes FollowSymLinks \n\
    AllowOverride All \n\
    Require all granted \n\
</Directory>" > /etc/apache2/conf-available/custom.conf

RUN a2enconf custom

EXPOSE 80

CMD ["apache2-foreground"]
