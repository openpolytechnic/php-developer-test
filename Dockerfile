FROM php:8.1-apache
RUN docker-php-ext-install mysqli
RUN apt update && apt install -y libicu-dev && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install intl
RUN ["apt-get", "update"]
RUN ["apt-get", "install", "-y", "zip"]
RUN ["apt-get", "install", "-y", "unzip"]
