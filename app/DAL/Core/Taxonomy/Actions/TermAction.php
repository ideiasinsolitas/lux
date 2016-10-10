<?php

namespace App\DAL\Core\Taxonomy\Actions;

use App\DAL\Common\Actions as CommonActions;

trait TermAction
{
    use CommonActions\DefaultSelector,
        CommonActions\DefaultDeleter,
        CommonActions\DefaultModifier;
}
