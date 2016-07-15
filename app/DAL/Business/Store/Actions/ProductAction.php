<?php

namespace App\DAL\Business\Store\Actions;

use App\DAL\Common\Actions;

trait ProductAction
{
    use Actions\DefaultDeleter,
        Actions\DefaultSelector,
        Actions\DefaultModifier;
}
