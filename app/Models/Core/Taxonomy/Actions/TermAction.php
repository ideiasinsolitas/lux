<?php

namespace App\Models\Core\Taxonomy\Actions;

use App\Models\Common\Actions as CommonActions;

trait TermAction
{
    use CommonActions\ActivityDeleter,
        CommonActions\ActivitySelector,
        CommonActions\DefaultSelector,
        CommonActions\DefaultModifier,
        CommonActions\TypeSelector;
}
