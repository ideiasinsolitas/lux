<?php

namespace App\Services\Interaction;

class InteractionDAOFactory
{
    protected static $avaiable = [
        'ticket' => 'App\DAL\Business\ProjectManagement\TicketDAO',
    ];

    public static function make($name)
    {
        return new self::$avaiable[$name];
    }
}
