FROM php:fpm-alpine

RUN printf "\n%s\n%s" "@edge http://dl-cdn.alpinelinux.org/alpine/edge/main" "@testing http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories \
    && apk --update upgrade \
    &&  apk add autoconf automake make gcc g++ libtool pkgconfig libmcrypt-dev re2c libressl@edge libressl-dev@edge git zlib-dev xdg-utils libpng-dev freetype-dev libjpeg-turbo-dev openssh-client libxslt-dev ca-certificates gmp-dev \
    && update-ca-certificates

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apk --update --no-cache add git

RUN docker-php-ext-install pdo_mysql

RUN apk add rabbitmq-c@testing rabbitmq-c-dev@testing \
    && docker-php-ext-install bcmath sockets \
    && pecl install amqp \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable amqp

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer install ; wait-for-it database:3306 -- bin/console doctrine:migrations:migrate ;  php-fpm 

EXPOSE 9000
