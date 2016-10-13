<?php

namespace App\DAL\Business\Sales\Actions;

use App\DAL\Common\Actions;

trait PaymentAction
{
    use Actions\DefaultDeleter,
        Actions\DefaultSelector,
        Actions\DefaultModifier;
}
