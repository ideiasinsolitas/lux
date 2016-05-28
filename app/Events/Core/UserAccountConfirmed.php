<?php

namespace App\Events\Core;

class UserAccountConfirmed
{
    use UserEventTrait;

    public function getNotification()
    {
        return "Sua conta foi confirmada com sucesso.";
    }
}
