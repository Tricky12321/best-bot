FROM php:7.4-cli

RUN mkdir /best-bot
WORKDIR /best-bot

ADD src /best-bot/src
ADD vendor /best-bot/vendor


VOLUME /best-bot/storage
CMD php src/main.php