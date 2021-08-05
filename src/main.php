<?php

include __DIR__ . '/../vendor/autoload.php';

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Channel\Message;
use Discord\Parts\Guild\Guild;
use Discord\WebSockets\Intents;
use React\EventLoop\Loop;
use Tricky\BestBot\event;

$config = require __DIR__ . "/config/config.php";
/** @var Discord $discord */
$discord = new Discord([
    'token' => $config["key"],
    'intents' => Intents::getDefaultIntents(),
]);

$discord->on('ready', function ($discord) {
    echo "Bot is ready!", PHP_EOL;
    // Listen for messages.
    $discord->on('message', function ($message, $discord) {
        echo "{$message->author->username}: {$message->content}", PHP_EOL;
    });
});

/** @var array event $events */
//$events[] = new event(new DateTime("2021-08-02T20:00:00+02:00"), "Trap in 1 hour! <@&784532360887664670>", 172800, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-02T20:30:00+02:00"), "Trap in 30 minutes! <@&784532360887664670>", 172800, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-02T20:55:00+02:00"), "Trap in 5 minutes! <@&784532360887664670>", 172800, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-02T21:00:00+02:00"), "Trap now! <@&784532360887664670>", 172800, 736237365600845915);
//
//$events[] = new event(new DateTime("2021-08-05T20:00:00+02:00"), "Horde in 1 hour! <@&784532360887664670>", 1209600, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-05T20:30:00+02:00"), "Horde in 30 minutes! <@&784532360887664670>", 1209600, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-05T20:55:00+02:00"), "Horde in 5 minutes! <@&784532360887664670>", 1209600, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-05T21:00:00+02:00"), "Horde now! <@&784532360887664670>", 1209600, 736237365600845915);
//
//$events[] = new event(new DateTime("2021-08-03T20:00:00+02:00"), "Horde in 1 hour! <@&784532360887664670>", 1209600, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-03T20:30:00+02:00"), "Horde in 30 minutes! <@&784532360887664670>", 1209600, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-03T20:55:00+02:00"), "Horde in 5 minutes! <@&784532360887664670>", 1209600, 736237365600845915);
//$events[] = new event(new DateTime("2021-08-03T21:00:00+02:00"), "Horde now! <@&784532360887664670>", 1209600, 736237365600845915);

$events[] = new event(new DateTime("2021-08-05T21:30:00+02:00"), "Testing", 10, 872831985603731456);



$discord->on('ready', function (Discord $discord) {
    Loop::addPeriodicTimer(10, function () {
        loop();
    });

});

function loop() {
    global $events,$discord;
    echo "loop\n";
    /** @var event $event */
    foreach ($events as $event) {
        // If the current timestamp is greater than the NextPlay timestamp the message needs to be sent
        $timeToNext = (new DateTime("now"))->getTimestamp() - $event->nextPlay->getTimestamp();
        if ($timeToNext >= 0) {
            echo "Sending message\n";
            //784532360887664670 StateOfSurvivalPlayer
            $message = MessageBuilder::new()->setContent($event->message);
            $discord->getChannel($event->channel)->sendMessage($message)->done(function (Message $message) {
                echo "Message sent!\n";
            });
            $event->calculateNext();
        }
    }
}

$discord->run();