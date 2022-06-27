FROM php:8.0-zts

RUN apt update && apt install -y \
    zsh \
    vim \
    git \
    lsof \
    psmisc \
    zip \
    libzip-dev \
    procps \
    dlang-libevent \
    chromium

RUN mkdir /best-bot
WORKDIR /best-bot
RUN docker-php-ext-configure pcntl --enable-pcntl
RUN docker-php-ext-install sockets
RUN pecl install event
RUN docker-php-ext-install zip
RUN docker-php-ext-install pcntl
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install shmop

WORKDIR /parallel

RUN git clone https://github.com/krakjoe/parallel.git
WORKDIR /parallel/parallel
RUN phpize
RUN ./configure --enable-parallel
RUN make
RUN make test
RUN make install

RUN docker-php-ext-enable parallel
COPY --from=composer /usr/bin/composer /usr/bin/composer

ADD vendor /best-bot/vendor
ADD . /best-bot
WORKDIR /best-bot
VOLUME /best-bot/storage
ADD src /best-bot/src
RUN mkdir -p /screenshots
CMD php src/main.php