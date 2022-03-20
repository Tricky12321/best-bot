<?php


namespace Tricky\BestBot;


use DateInterval;
use DateTime;

class event
{
    public DateTime $first;
    public string $message;
    public $repeatEvery;
    public ?DateTime $nextPlay;
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
        $now = (new DateTime("now"))->getTimestamp();
        $now += 300; // Add 5 minutes to avoid duplicate messages

        $first = $this->first->getTimestamp();
        if ($first > $now) {
            $this->nextPlay = $this->first;
        } else {
            if ($this->repeatEvery > 0) {
                $difference = $now - $first;
                $cycles = ceil($difference / $this->repeatEvery);
                $this->nextPlay = $this->first;
                $timeToAdd = $this->repeatEvery * $cycles;
                $this->nextPlay->add(new DateInterval("PT{$timeToAdd}S"));
            } else {
                $this->nextPlay = null;
            }
        }
    }

    /**
     * @param $a event
     * @param $b event
     * @return int
     */
    public static function cmp($a, $b) {
        return $a->nextPlay->getTimestamp() - $b->nextPlay->getTimestamp();
    }
}