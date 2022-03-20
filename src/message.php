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

    function remove_emoji($string)
    {
        // Match Enclosed Alphanumeric Supplement
        $regex_alphanumeric = '/[\x{1F100}-\x{1F1FF}]/u';
        $clear_string = preg_replace($regex_alphanumeric, '', $string);

        // Match Miscellaneous Symbols and Pictographs
        $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clear_string = preg_replace($regex_symbols, '', $clear_string);

        // Match Emoticons
        $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clear_string = preg_replace($regex_emoticons, '', $clear_string);

        // Match Transport And Map Symbols
        $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clear_string = preg_replace($regex_transport, '', $clear_string);

        // Match Supplemental Symbols and Pictographs
        $regex_supplemental = '/[\x{1F900}-\x{1F9FF}]/u';
        $clear_string = preg_replace($regex_supplemental, '', $clear_string);

        // Match Miscellaneous Symbols
        $regex_misc = '/[\x{2600}-\x{26FF}]/u';
        $clear_string = preg_replace($regex_misc, '', $clear_string);

        // Match Dingbats
        $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
        $clear_string = preg_replace($regex_dingbats, '', $clear_string);

        return $clear_string;
    }

    public function getOriginalMessage() {
        return $this->remove_emoji($this->originalMessage);
    }
}