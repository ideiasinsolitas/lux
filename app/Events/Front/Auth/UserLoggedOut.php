<?php namespace App\Events\Front\Auth;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserLoggedOut
 * @package App\Events\Front\Auth
 */
class UserLoggedOut extends Event implements UserAccessInterface
{

    use SerializesModels;

    /**
     * @var $user
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
