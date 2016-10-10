<?php

namespace App\DAL\Publishing\ContentManagement\Actions;

use App\DAL\Common\Actions;

trait PublisherAction
{
    use Actions\DefaultSelector,
        Actions\DefaultModifier,
        Actions\DefaultDeleter;
}
