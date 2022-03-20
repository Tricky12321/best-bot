<?php

namespace Tricky\BestBot;

class message
{
    public $originalMessage;
    public $translateToLang;
    public $translatedMessage;
    public $channel_id;
    public $message_id;

    public function __construct($originalMessage, $translateToLang, $channel_id, $message_id) {
        $this->originalMessage = $originalMessage;
        $this->translateToLang = $translateToLang;
        $this->channel_id = $channel_id;
        $this->message_id = $message_id;
    }

    public function setTranslated($message) {
        $this->translatedMessage = $message;
    }

    public function getTranslationUrl() {
        return "https://translate.google.com/?sl=auto&tl=".$this->translateToLang."&op=translate";
    }

    public function getOriginalMessage() {
        return $this->originalMessage;
    }
}