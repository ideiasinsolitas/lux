<?php

namespace App\Repositories\Business\Store\Actions;

use App\Repositories\Common\Actions;

trait ProductAction
{
    use Actions\ActivityDeleter,
        Actions\ActivitySelector,
        Actions\ActivityUpdater;
}
