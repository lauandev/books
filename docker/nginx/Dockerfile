FROM debian:jessie

MAINTAINER Lauan Guermandi <lauanguermandi@gmail.com>

# Update and install nginx
RUN apt-get update && apt-get install -y \
    nginx

# Add nginx config files
ADD docker/nginx/nginx.conf /etc/nginx/
ADD docker/nginx/laravel.conf /etc/nginx/sites-available/

# Create alias to configs
RUN ln -s /etc/nginx/sites-available/laravel.conf /etc/nginx/sites-enabled/laravel
RUN ln -s /etc/nginx/sites-available/kibana.conf /etc/nginx/sites-enabled/kibana
RUN rm /etc/nginx/sites-enabled/default

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 www-data

CMD ["nginx"]

EXPOSE 80
EXPOSE 443
