<?php

namespace App\Services\Interaction;

class InteractionDAOFactory
{
    protected static $avaiable = [
        'comment' => 'App\DAL\Core\Interaction\CommentDAO',
    ];

    public static function make($name)
    {
        if (isset($avaiable[$name])) {
            return new $avaiable[$name];
        }
        throw new \Exception("Error Processing Request", 1);
    }
}
