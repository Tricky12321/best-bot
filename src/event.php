<?php


namespace Tricky\BestBot;



use DateInterval;
use DateTime;

class event
{
    public DateTime $first;
    public string $message;
    public $repeatEvery;
    public DateTime $nextPlay;
    public $channel;

    public function __construct($first, $message, $repeatEvery, $channel)
    {
        $this->first = $first;
        $this->message = $message;
        $this->repeatEvery = $repeatEvery;
        $this->channel = $channel;
        $this->calculateNext();
    }

    public function calculateNext()
    {
        if ($this->repeatEvery > 0) {
            $now = (new DateTime("now"))->getTimestamp();

            $first = $this->first->getTimestamp();
            if ($first > $now) {
                $this->nextPlay = $this->first;
            } else {
                $difference = $now - $first;
                $cycles = ceil($difference / $this->repeatEvery);
                $this->nextPlay = $this->first;
                $timeToAdd = $this->repeatEvery * $cycles;
                $this->nextPlay->add(new DateInterval("PT{$timeToAdd}S"));
            }
        }
    }
}