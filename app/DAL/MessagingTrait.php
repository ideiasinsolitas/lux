<?php

namespace App\DAL;

use Log;

trait MessagingTrait
{
    protected $messages = null;

    protected $messagesLoggable = true;

    protected function addMessage($type, $message)
    {
        if (!isset($this->messages[$type])) {
            $this->messages[$type] = [];
        }
        $this->messages[$type][] = $message;

        if ($this->messagesLoggable) {
            $message .= " in class: " . __CLASS__;

            $class = "Log";
            if (method_exists($class, $type)) {
                Log::$type($message);
            } else {
                Log::info($message);
            }
        }
    }

    public function getMessages($type = null)
    {
        if ($type) {
            return $this->messages[$type];
        }
        return $this->messages;
    }
}
