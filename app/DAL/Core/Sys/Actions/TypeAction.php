<?php

namespace App\DAL\Core\Sys\Actions;

use App\DAL\Common\Actions as CommonActions;

trait TypeAction
{
    use CommonActions\DefaultDeleter,
        CommonActions\DefaultSelector,
        CommonActions\DefaultModifier;
}
