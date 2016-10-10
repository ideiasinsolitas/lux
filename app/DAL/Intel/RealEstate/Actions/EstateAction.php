<?php

namespace App\DAL\Intel\RealEstate\Actions;

use App\DAL\Common\Actions;

trait EstateAction
{
    use Actions\DefaultDeleter,
        Actions\DefaultSelector,
        Actions\DefaultModifier,
        Actions\TypeSelector;
}
