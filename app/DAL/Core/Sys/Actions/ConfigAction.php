<?php

namespace App\DAL\Core\Sys\Actions;

use App\DAL\Common\Actions as CommonActions;

trait ConfigAction
{
    use CommonActions\ActivityRestorer,
        CommonActions\ActivityUpdater,
        CommonActions\DefaultModifier,
        CommonActions\DefaultDeleter;
}
