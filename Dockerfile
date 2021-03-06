# syntax=docker/dockerfile:1
FROM mattrayner/lamp:latest-1604

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
RUN rm index.php

COPY . .

RUN composer install

CMD ["/run.sh"]
