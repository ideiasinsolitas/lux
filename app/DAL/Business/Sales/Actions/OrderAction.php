<?php

namespace App\DAL\Business\Sales\Actions;

use App\DAL\Common\Actions;

trait OrderAction
{
    use Actions\DefaultDeleter,
        Actions\DefaultSelector,
        Actions\DefaultModifier;
}
