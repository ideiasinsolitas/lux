<?php

namespace App\Repositories\Business\ProjectManagement\Actions;

use App\Repositories\Common\Actions;

trait TicketAction
{
    use Actions\ActivityDeleter,
        Actions\ActivitySelector,
        Actions\ActivityUpdater;
}
