<?php

namespace App\DAL\Business\Logistics\Actions;

use App\DAL\Common\Actions;

trait StorageAction
{
    use Actions\DefaultDeleter,
        Actions\DefaultSelector,
        Actions\DefaultModifier;
}
