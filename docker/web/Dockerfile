FROM php:7.1-fpm

MAINTAINER Alexander Harchenko <morontt@gmail.com>

ARG HOST_UID=1000

ENV DEBIAN_FRONTEND noninteractive
ENV PHP_CPPFLAGS="$PHP_CPPFLAGS -std=c++11"

RUN echo Europe/Kiev > /etc/timezone && \
    dpkg-reconfigure -f noninteractive tzdata

COPY ./custom-installs.sh /tmp/custom-installs.sh
COPY ./postgresql_pubkey.asc /tmp/postgresql_pubkey.asc
RUN bash /tmp/custom-installs.sh

RUN curl -sS -o /tmp/icu.tar.gz -L http://download.icu-project.org/files/icu4c/59.1/icu4c-59_1-src.tgz \
    && tar -zxf /tmp/icu.tar.gz -C /tmp && cd /tmp/icu/source && ./configure --prefix=/usr/local \
    && make -j$(nproc) \
    && make install \
    && rm -rf /tmp/icu

RUN docker-php-ext-configure intl --with-icu-dir=/usr/local \
    && docker-php-ext-install -j$(nproc) intl zip pgsql pdo_pgsql opcache

RUN yes | pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./.bashrc /root/.bashrc
COPY ./php.ini /usr/local/etc/php/

RUN set -x && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer global require hirak/prestissimo --prefer-dist --no-interaction \
    && curl -sS -o /root/.bash_aliases https://raw.githubusercontent.com/morontt/dotfiles/master/ubuntu/.bash_aliases \
    && sed -i "s/php app\/console/php bin\/console/g" /root/.bash_aliases

RUN usermod -u ${HOST_UID} www-data && groupmod -g ${HOST_UID} www-data

WORKDIR "/var/www/crudTest"
