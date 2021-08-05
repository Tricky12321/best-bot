<?php
include __DIR__ . '/../vendor/autoload.php';

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Channel\Message;
use Discord\Parts\Guild\Guild;
use Discord\WebSockets\Intents;
use Tricky\BestBot\event;

$config = require __DIR__ . "/config/config.php";

$discord = new Discord([
    'token' => $config["key"],
    'intents' => Intents::getDefaultIntents()
]);

$discord->on('ready', function (Discord $discord) {
    $message = MessageBuilder::new()->setContent('Hello, world! @Tricky!');
    $discord->getChannel(872831985603731456)->sendMessage($message)->done(function (Message $message) {
        echo "Message sent!";
    });;

});

$discord->run();