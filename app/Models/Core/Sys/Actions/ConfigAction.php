<?php

namespace App\Models\Core\Sys\Actions;

use App\Models\Common\Actions as CommonActions;

trait ConfigAction
{
    use CommonActions\ActivityDeleter,
        CommonActions\ActivityUpdater,
        CommonActions\DefaultModifier;
}
