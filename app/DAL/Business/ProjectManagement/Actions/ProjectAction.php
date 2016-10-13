<?php

namespace App\DAL\Business\ProjectManagement\Actions;

use App\DAL\Common\Actions;

trait ProjectAction
{
    use Actions\DefaultDeleter,
        Actions\DefaultSelector,
        Actions\DefaultModifier;
}
