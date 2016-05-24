<?php

namespace App\Repositories\Business\ProjectManagement\Actions;

use App\Repositories\Common\Actions;

trait ProjectAction
{
    use Actions\ActivityDeleter,
        Actions\ActivitySelector,
        Actions\ActivityUpdater;
}
