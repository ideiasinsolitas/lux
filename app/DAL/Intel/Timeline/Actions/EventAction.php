<?php

namespace App\DAL\Intel\Timeline\Actions;

use App\DAL\Common\Actions;

trait EventAction
{
    use Actions\DefaultSelector,
        Actions\DefaultModifier,
        Actions\DefaultDeleter;
}
