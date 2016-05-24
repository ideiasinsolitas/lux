<?php

namespace App\Repositories\Business\Sales\Actions;

use App\Repositories\Common\Actions;

trait InvoiceAction
{
    use Actions\ActivityDeleter,
        Actions\ActivitySelector,
        Actions\ActivityUpdater;
}
