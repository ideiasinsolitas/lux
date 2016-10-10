<?php

namespace App\DAL\Intel\Timeline\Actions;

use App\DAL\Common\Actions;

trait CalendarAction
{
    use Actions\DefaultSelector,
        Actions\DefaultModifier,
        Actions\DefaultDeleter;
}
