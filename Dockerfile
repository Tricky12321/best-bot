FROM php:8.0-zts

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

RUN docker-php-ext-install sockets
RUN pecl install event
RUN docker-php-ext-install zip
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

WORKDIR /parallel

RUN git clone https://github.com/krakjoe/parallel.git
WORKDIR /parallel/parallel
RUN phpize
RUN ./configure --enable-parallel
RUN make
RUN make test
RUN make install

RUN docker-php-ext-enable parallel


ADD vendor /best-bot/vendor

VOLUME /best-bot/storage
ADD src /best-bot/src
CMD php src/main.php