<?php

namespace App\Listeners\Common;

trait Mailable
{
    public function email($event)
    {
        return \Mail::send($event->getTemplate(), $event->getUser(), function ($event) {
            $from = $event->getFrom();
            $message->from($from['email'], $from['name']);
            $message->sender($from['email'], $from['name']);
            $to = $event->getTo();
            $message->to($to['email'], $to['name']);
            $message->subject($event->getSubject());
        });
    }
}
