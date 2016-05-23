<?php

namespace App\DAL\Core\Taxonomy\Actions;

use App\DAL\Common\Actions as CommonActions;

trait TermAction
{
    use CommonActions\ActivityRestorer,
        CommonActions\ActivitySelector,
        CommonActions\DefaultSelector,
        CommonActions\DefaultModifier,
        CommonActions\TypeSelector;
}
