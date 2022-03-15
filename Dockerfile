FROM php:8.0-cli

RUN apt update && apt install -y \
    htop \
    zsh \
    vim \
    git \
    lsof \
    psmisc \
    zip \
    libzip-dev \
    procps \
    dlang-libevent

RUN mkdir /best-bot
WORKDIR /best-bot

RUN pecl install xdebug
RUN docker-php-ext-install sockets
RUN pecl install event
RUN docker-php-ext-install zip
RUN docker-php-ext-enable xdebug
RUN pear config-set preferred_state beta


ADD src /best-bot/src
ADD vendor /best-bot/vendor

COPY --from=composer /usr/bin/composer /usr/bin/composer
VOLUME /best-bot/storage
CMD php src/main.php