<?php

namespace App\DAL\Core\Sys\Actions;

use App\DAL\Common\Actions as CommonActions;

trait UserAction
{
    use CommonActions\ActivityUpdater,
        CommonActions\DefaultSelector,
        CommonActions\ActivityRestorer,
        CommonActions\DefaultDeleter;
}
