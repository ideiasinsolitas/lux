<?php

namespace App\Repositories\Business\Logistics\Actions;

use App\Repositories\Common\Actions;

trait ShippingAction
{
    use Actions\ActivityDeleter,
        Actions\ActivitySelector,
        Actions\ActivityUpdater;
}
