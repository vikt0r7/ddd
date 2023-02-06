# Use an official PHP image as the base image
FROM php:7.4-apache

# Copy the code into the image
COPY . /var/www/html/

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
