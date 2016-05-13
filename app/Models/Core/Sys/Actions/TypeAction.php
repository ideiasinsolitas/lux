<?php

namespace App\Models\Core\Sys\Actions;

use App\Models\Common\Actions as CommonActions;

trait TypeAction
{
    use CommonActions\DefaultDeleter,
        CommonActions\DefaultSelector,
        CommonActions\DefaultModifier;
}
