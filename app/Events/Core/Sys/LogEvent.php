<?php namespace App\Events\Front\Auth;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class LogEvent
 * usage: event(new LogEvent());
 * @package App\Events\Front\Auth
 */
class LogEvent extends Event
{

    use SerializesModels;

    /**
     * @var $user
     */
    public $action;

    /**
     * @param $user
     */
    public function __construct($action)
    {
        $this->action = $action;
    }
}
