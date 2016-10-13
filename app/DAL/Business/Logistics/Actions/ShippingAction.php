<?php

namespace App\DAL\Business\Logistics\Actions;

use App\DAL\Common\Actions;

trait ShippingAction
{
    use Actions\DefaultDeleter,
        Actions\DefaultSelector,
        Actions\DefaultModifier;
}
