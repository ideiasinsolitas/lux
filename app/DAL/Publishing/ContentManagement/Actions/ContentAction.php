<?php

namespace App\DAL\Publishing\ContentManagement\Actions;

use App\DAL\Common\Actions;

trait ContentAction
{
    use Actions\DefaultDeleter,
        Actions\DefaultSelector,
        Actions\DefaultModifier,
        Actions\Hierachical,
        Actions\TypeSelector;
}
